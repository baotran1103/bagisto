pipeline {
    agent none

    triggers {
        pollSCM('H/5 * * * *')
    }

    environment {
        DOCKER_IMAGE = "baotran1103/bagisto"
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
                            } catch (Exception e) {
                                echo "⚠️ SonarQube skipped: ${e.message}"
                            }
                        }
                    }
                }
                
                stage('Security Scans') {
                    parallel {
                        stage('ClamAV') {
                            agent any
                            steps {
                                sh 'clamscan -r --exclude-dir=vendor --exclude-dir=node_modules . || echo "⚠️ ClamAV warnings"'
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
                                sh 'composer audit || echo "⚠️ PHP vulnerabilities found"'
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
                                sh 'npm audit --audit-level=moderate || echo "⚠️ Node vulnerabilities found"'
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
                            -f Dockerfile.production \
                            .
                    """
                    
                    echo "✅ Docker image built: ${imageName}"
                }
            }
        }
        
        stage('Image Security Scan') {
            agent any
            steps {
                script {
                    try {
                        sh "docker scan ${DOCKER_IMAGE}:${BUILD_TAG} || echo '⚠️ Security scan completed with warnings'"
                    } catch (Exception e) {
                        echo "⚠️ Image scan skipped: ${e.message}"
                    }
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
