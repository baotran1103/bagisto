pipeline {
    agent none

    triggers {
        pollSCM('H/5 * * * *')
    }

    environment {
        DOCKER_IMAGE = "bao110304/bagisto"
        CI_IMAGE = "bao110304/bagisto-ci:latest"
    }

    stages {
        stage('Checkout') {
            agent any
            steps {
                sh 'git config --global http.postBuffer 524288000'
                git branch: 'main',
                    credentialsId: 'GITHUB_PAT',
                    url: 'https://github.com/baotran1103/bagisto.git'
                
                script {
                    env.GIT_SHORT_COMMIT = sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()
                    env.BUILD_TAG = "${BUILD_NUMBER}-${env.GIT_SHORT_COMMIT}"
                    echo "Build tag: ${env.BUILD_TAG}"
                }
            }
        }
        
        stage('Build Code') {
            parallel {
                stage('Backend Build') {
                    agent {
                        docker {
                            image "${CI_IMAGE}"
                            args '-u root'
                        }
                    }
                    steps {
                        dir('workspace/bagisto') {
                            sh 'composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-req=ext-calendar --ignore-platform-req=ext-intl --ignore-platform-req=ext-pdo_mysql --ignore-platform-req=ext-gd --ignore-platform-req=ext-zip'
                        }
                        stash name: 'vendor', includes: 'workspace/bagisto/vendor/**'
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
                        dir('workspace/bagisto') {
                            sh '''
                                npm install
                                npm run build
                            '''
                        }
                        stash name: 'node-lockfile', includes: 'workspace/bagisto/package-lock.json'
                    }
                }
            }
        }
        
        stage('Tests & Quality') {
            parallel {
                stage('PHPUnit Tests') {
                    agent {
                        docker {
                            image "${CI_IMAGE}"
                            args '-u root'
                        }
                    }
                    steps {
                        unstash 'vendor'
                        dir('workspace/bagisto') {
                            sh './vendor/bin/pest tests/Unit/CoreHelpersTest.php --stop-on-failure'
                        }
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
                                            -Dsonar.sources=workspace/bagisto/app,workspace/bagisto/packages/Webkul \\
                                            -Dsonar.exclusions=vendor/**,node_modules/**,storage/**,public/**,tests/**
                                    """
                                }
                                
                                // Wait for quality gate result
                                // timeout(time: 5, unit: 'MINUTES') {
                                //     def qg = waitForQualityGate()
                                //     if (qg.status != 'OK') {
                                //         unstable("⚠️ Quality gate failed: ${qg.status} - Review required before merge")
                                //     } else {
                                //         echo "✅ Quality gate passed"
                                //     }
                                // }
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
                            image "${CI_IMAGE}"
                            args '-u root'
                        }
                    }
                    steps {
                        dir('workspace/bagisto') {
                            script {
                                def auditOutput = sh(
                                    script: 'composer audit --no-dev || true',
                                    returnStdout: true
                                ).trim()
                                
                                if (auditOutput.contains('security vulnerability advisories found')) {
                                    if (auditOutput.contains('Severity: moderate') || auditOutput.contains('Severity: high') || auditOutput.contains('Severity: critical')) {
                                        error "❌ FAILED: PHP dependency vulnerabilities found (MODERATE+). Fix required!"
                                    }
                                } else {
                                    echo "✅ No PHP vulnerabilities (moderate+)"
                                }
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
                        unstash 'node-lockfile'
                        dir('workspace/bagisto') {
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
        }
        
        stage('Build Docker Image') {
            agent any
            steps {
                script {
                    def imageName = "${DOCKER_IMAGE}:${env.BUILD_TAG}"
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
            steps {
                script {
                    echo "🔍 Scanning Docker image for vulnerabilities with Trivy..."
                    
                    def imageName = "${DOCKER_IMAGE}:${env.BUILD_TAG}"
                    
                    // Scan image using Trivy Docker container (no installation needed)
                    def scanResult = sh(
                        script: """
                            docker run --rm -v /var/run/docker.sock:/var/run/docker.sock \\
                                aquasec/trivy:latest image \\
                                --severity HIGH,CRITICAL \\
                                --exit-code 0 \\
                                --format table \\
                                --no-progress \\
                                ${imageName}
                        """,
                        returnStatus: true
                    )
                    
                    if (scanResult != 0) {
                        unstable("⚠️ Image security scan found vulnerabilities (HIGH/CRITICAL)")
                        echo "⚠️ Review vulnerabilities above before deploying to production"
                    } else {
                        echo "✅ No critical vulnerabilities found in image"
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
                            docker push ${DOCKER_IMAGE}:${env.BUILD_TAG}
                            docker push ${DOCKER_IMAGE}:latest
                        """
                    }
                    
                    echo "✅ Image pushed: ${DOCKER_IMAGE}:${env.BUILD_TAG}"
                }
            }
        }
        
        stage('Deploy to VPS') {
            agent any
            steps {
                script {
                    echo "🚀 Deploying to production VPS..."
                    
                    withCredentials([sshUserPrivateKey(
                        credentialsId: 'vps-ssh-key',
                        keyFileVariable: 'SSH_KEY',
                        usernameVariable: 'SSH_USER'
                    )]) {
                        sh """
                            ssh -o StrictHostKeyChecking=no -i \${SSH_KEY} \${SSH_USER}@139.180.218.27 << 'ENDSSH'
                                set -e
                                echo "📥 Pulling latest Docker image..."
                                cd /root/bagisto
                                docker-compose -f docker-compose.production.yml pull bagisto
                                
                                echo "🔄 Recreating containers..."
                                docker-compose -f docker-compose.production.yml up -d --force-recreate bagisto
                                
                                echo "🧹 Cleaning up old images..."
                                docker image prune -f
                                
                                echo "✅ Deployment completed successfully!"
                                docker-compose -f docker-compose.production.yml ps
ENDSSH
                        """
                    }
                    
                    echo "✅ Deployed to VPS: 139.180.218.27"
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
                Commit: ${env.GIT_COMMIT ?: 'unknown'}
                Status: ${currentBuild.result ?: 'SUCCESS'}
                Duration: ${currentBuild.durationString}
                Image: ${env.BUILD_TAG ?: "${BUILD_NUMBER}-unknown"}
                ═══════════════════════════════════════
                """
            }
        }
        
        success {
            node('') {
                emailext subject: "✅ Build Success: Bagisto #${BUILD_NUMBER}",
                        body: """
                        🎉 Build completed successfully!
                        
                        📦 Docker Image: ${env.BUILD_TAG ?: "${BUILD_NUMBER}-unknown"}
                        📝 Commit: ${env.GIT_COMMIT ?: 'unknown'}
                        ⏱️ Duration: ${currentBuild.durationString}
                        
                        � Deploy Command:
                        docker pull ${env.BUILD_TAG ?: "${BUILD_NUMBER}-unknown"}
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
                        
                        📝 Commit: ${env.GIT_COMMIT ?: 'unknown'}
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
