pipeline {
    agent none

    triggers {
        pollSCM('H/5 * * * *')
    }

    environment {
        DOCKER_IMAGE = "bao110304/bagisto"
        BUILD_TAG = "${BUILD_NUMBER}-${GIT_COMMIT}"
    }

    stages {
        stage('Checkout') {
            agent any
            steps {
                git branch: 'main',
                    credentialsId: 'GITHUB_PAT',
                    url: 'https://github.com/baotran1103/bagisto-app.git'
                
                script {
                    env.GIT_COMMIT = sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()
                    env.BUILD_TAG = "${BUILD_NUMBER}-${env.GIT_COMMIT}"
                }
            }
        }
        
        stage('Build Code') {
            parallel {
                stage('Backend Build') {
                    agent {
                        docker {
                            image 'composer:latest'
                            args '-u root'
                        }
                    }
                    steps {
                        sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                    }
                }
                
                stage('Frontend Build') {
                    agent {
                        docker {
                            image 'node:18-alpine'
                            args '-u root'
                        }
                    }
                    steps {
                        sh '''
                            npm ci --prefer-offline
                            npm run build
                        '''
                    }
                }
            }
        }
        
        stage('Tests & Quality') {
            parallel {
                stage('PHPUnit Tests') {
                    agent {
                        docker {
                            image 'php:8.2'
                            args '-u root'
                        }
                    }
                    steps {
                        sh './vendor/bin/pest tests/Unit/CoreHelpersTest.php --stop-on-failure'
                    }
                }
                
                stage('Code Quality') {
                    agent any
                    steps {
                        script {
                            try {
                                def scannerHome = tool 'SonarScanner'
                                withSonarQubeEnv('SonarQube') {
                                    sh """
                                        ${scannerHome}/bin/sonar-scanner \\
                                            -Dsonar.projectKey=bagisto \\
                                            -Dsonar.sources=app,packages/Webkul \\
                                            -Dsonar.exclusions=vendor/**,node_modules/**,storage/**,public/**,tests/**
                                    """
                                }
                                
                                // Wait for quality gate result
                                timeout(time: 5, unit: 'MINUTES') {
                                    def qg = waitForQualityGate()
                                    if (qg.status != 'OK') {
                                        unstable("⚠️ Quality gate failed: ${qg.status} - Review required before merge")
                                    } else {
                                        echo "✅ Quality gate passed"
                                    }
                                }
                            } catch (Exception e) {
                                echo "⚠️ SonarQube skipped: ${e.message}"
                            }
                        }
                    }
                }
                
                stage('ClamAV Malware Scan') {
                    agent any
                    steps {
                        script {
                            def result = sh(
                                script: 'clamscan -r --exclude-dir=vendor --exclude-dir=node_modules .',
                                returnStatus: true
                            )
                            if (result == 1) {
                                error "❌ CRITICAL: Malware/virus detected! Build aborted."
                            } else if (result != 0) {
                                echo "⚠️ ClamAV completed with warnings"
                            } else {
                                echo "✅ No malware detected"
                            }
                        }
                    }
                }
                
                stage('Composer Audit') {
                    agent {
                        docker { 
                            image 'composer:latest'
                            args '-u root'
                        }
                    }
                    steps {
                        script {
                            def result = sh(
                                script: 'composer audit --no-dev',
                                returnStatus: true
                            )
                            if (result != 0) {
                                error "❌ FAILED: PHP dependency vulnerabilities found (MODERATE+). Fix required!"
                            } else {
                                echo "✅ No PHP vulnerabilities"
                            }
                        }
                    }
                }
                
                stage('NPM Audit') {
                    agent {
                        docker { 
                            image 'node:18-alpine'
                            args '-u root'
                        }
                    }
                    steps {
                        script {
                            def result = sh(
                                script: 'npm audit --audit-level=moderate',
                                returnStatus: true
                            )
                            if (result != 0) {
                                error "❌ FAILED: Node dependency vulnerabilities found (MODERATE+). Fix required!"
                            } else {
                                echo "✅ No Node vulnerabilities"
                            }
                        }
                    }
                }
            }
        }
        
        stage('Build Docker Image') {
            agent any
            steps {
                script {
                    def imageName = "${DOCKER_IMAGE}:${BUILD_TAG}"
                    def imageLatest = "${DOCKER_IMAGE}:latest"
                    
                    sh """
                        docker build \
                            -t ${imageName} \
                            -t ${imageLatest} \
                            -f deploy/Dockerfile.production \
                            .
                    """
                    
                    echo "✅ Docker image built: ${imageName}"
                }
            }
        }
        
        stage('Image Security Scan') {
            agent any
            when {
                expression { return false }  // Skip for now
            }
            steps {
                script {
                    echo "⚠️ Image security scan is currently disabled"
                }
            }
        }
        
        stage('Push to Docker Hub') {
            agent any
            steps {
                script {
                    withCredentials([usernamePassword(
                        credentialsId: 'dockerhub-credentials',
                        usernameVariable: 'DOCKER_USER',
                        passwordVariable: 'DOCKER_PASS'
                    )]) {
                        sh """
                            echo \$DOCKER_PASS | docker login -u \$DOCKER_USER --password-stdin
                            docker push ${DOCKER_IMAGE}:${BUILD_TAG}
                            docker push ${DOCKER_IMAGE}:latest
                        """
                    }
                    
                    echo "✅ Image pushed: ${DOCKER_IMAGE}:${BUILD_TAG}"
                }
            }
        }
    }
    
    post {
        always {
            node('') {
                echo """
                ═══════════════════════════════════════
                Build Summary
                ═══════════════════════════════════════
                Build: #${BUILD_NUMBER}
                Commit: ${GIT_COMMIT}
                Status: ${currentBuild.result ?: 'SUCCESS'}
                Duration: ${currentBuild.durationString}
                Image: ${DOCKER_IMAGE}:${BUILD_TAG}
                ═══════════════════════════════════════
                """
            }
        }
        
        success {
            node('') {
                emailext subject: "✅ Build Success: Bagisto #${BUILD_NUMBER}",
                        body: """
                        🎉 Build completed successfully!
                        
                        📦 Docker Image: ${DOCKER_IMAGE}:${BUILD_TAG}
                        📝 Commit: ${GIT_COMMIT}
                        ⏱️ Duration: ${currentBuild.durationString}
                        
                        � Deploy Command:
                        docker pull ${DOCKER_IMAGE}:${BUILD_TAG}
                        docker-compose up -d
                        
                        🔗 Jenkins: ${BUILD_URL}
                        """,
                        to: 'tnqbao11@gmail.com'
            }
        }
        
        failure {
            node('') {
                emailext subject: "❌ Build Failed: Bagisto #${BUILD_NUMBER}",
                        body: """
                        🚨 Build failed!
                        
                        📝 Commit: ${GIT_COMMIT}
                        ⏱️ Duration: ${currentBuild.durationString}
                        
                        🔗 Check logs: ${BUILD_URL}
                        """,
                        to: 'tnqbao11@gmail.com'
            }
        }
        
        cleanup {
            node('') {
                cleanWs(deleteDirs: true, disableDeferredWipeout: true, notFailBuild: true)
            }
        }
    }
}
