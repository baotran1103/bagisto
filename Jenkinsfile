pipeline {
    agent none

    triggers {
        pollSCM('H/15 * * * *')
    }

    environment {
        DOCKER_IMAGE = "bao110304/bagisto"
    }

    stages {
        stage('Checkout') {
            agent any
            steps {
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
        
        stage('Build Test Image') {
            agent any
            steps {
                script {
                    echo "🏗️ Building BUILD stage (has all tools for testing)..."
                    sh """
                        docker build \
                            --target build \
                            -t ${DOCKER_IMAGE}:build-${BUILD_TAG} \
                            -f Dockerfile \
                            .
                    """
                    echo "✅ Build image created with test tools"
                }
            }
        }
        
        stage('Tests & Quality') {
            parallel {
                stage('PHPUnit Tests') {
                    agent any
                    steps {
                        script {
                            echo "🧪 Running tests INSIDE build image (no volume mount!)"
                            sh """
                                docker run --rm \
                                    ${DOCKER_IMAGE}:build-${BUILD_TAG} \
                                    sh -c 'cd /var/www/html && vendor/bin/pest tests/Unit --stop-on-failure'
                            """
                        }
                    }
                }
                
                stage('Code Quality') {
                    agent {
                        docker {
                            image 'sonarsource/sonar-scanner-cli:latest'
                            args '-v jenkins-workspace:/usr/src:ro --network container:sonarqube -e HOME=/tmp'
                            reuseNode true
                        }
                    }
                    steps {
                        script {
                            echo "📊 Running SonarQube scan in Docker container..."
                            echo "📂 Container workspace: ${WORKSPACE}"
                            
                            withSonarQubeEnv('SonarQube') {
                                sh '''
                                    # Navigate to shared volume path where code is located
                                    cd /usr/src/Bagisto
                                    
                                    # Verify files exist
                                    echo "� Checking source files..."
                                    ls -la app/ packages/ || echo "Warning: Source directories not found"
                                    
                                    # Run SonarQube scanner
                                    sonar-scanner \
                                        -Dsonar.projectKey=bagisto \
                                        -Dsonar.sources=app,packages/Webkul \
                                        -Dsonar.exclusions=**/vendor/**,**/node_modules/**,**/storage/**,**/public/**,**/tests/**,**/*.blade.php
                                '''
                            }
                            
                            echo "✅ SonarQube scan completed"
                        }
                    }
                }
                
                stage('ClamAV Malware Scan') {
                    agent any
                    steps {
                        script {
                            echo "🦠 Running ClamAV malware scan using shared volume..."
                            
                            def scanResult = sh(
                                script: """
                                    docker exec clamav \\
                                        clamscan -r -i /scan/\$(basename \${WORKSPACE}) \\
                                        --max-filesize=50M \\
                                        --max-scansize=100M \\
                                        --exclude-dir=vendor \\
                                        --exclude-dir=node_modules \\
                                        --exclude-dir=.git
                                """,
                                returnStatus: true
                            )
                            
                            if (scanResult == 1) {
                                error "❌ CRITICAL: Malware/virus detected! Build aborted."
                            } else if (scanResult != 0) {
                                echo "⚠️ ClamAV completed with warnings (might be updates or non-critical)"
                            } else {
                                echo "✅ No malware detected"
                            }
                        }
                    }
                }
                
                stage('Composer Audit') {
                    agent any
                    steps {
                        script {
                            echo "🔍 Running composer audit INSIDE build image"
                            def auditOutput = sh(
                                script: """
                                    docker run --rm \
                                        ${DOCKER_IMAGE}:build-${BUILD_TAG} \
                                        sh -c 'cd /var/www/html && composer audit --no-dev || true'
                                """,
                                returnStdout: true
                            ).trim()
                            
                            if (auditOutput.contains('security vulnerability advisories found')) {
                                if (auditOutput.contains('Severity: moderate') || auditOutput.contains('Severity: high') || auditOutput.contains('Severity: critical')) {
                                    error "❌ FAILED: PHP dependency vulnerabilities found (MODERATE+)"
                                }
                            } else {
                                echo "✅ No PHP vulnerabilities (moderate+)"
                            }
                        }
                    }
                }
                
            }
        }
        
        stage('Build Production Image') {
            agent any
            steps {
                script {
                    def imageName = "${DOCKER_IMAGE}:${env.BUILD_TAG}"
                    def imageLatest = "${DOCKER_IMAGE}:latest"
                    
                    echo "💡 Using build-${env.BUILD_TAG} as cache (fast build!)"
                    sh """
                        docker build \
                            --target production \
                            --cache-from ${DOCKER_IMAGE}:build-${BUILD_TAG} \
                            -t ${imageName} \
                            -t ${imageLatest} \
                            -f Dockerfile \
                            .
                    """
                    
                    echo "✅ Production image built: ${imageName}"
                }
            }
        }
        
        stage('Image Security Scan') {
            agent any
            steps {
                script {
                    echo "🔍 Scanning production image for vulnerabilities..."
                    
                    def imageName = "${DOCKER_IMAGE}:${env.BUILD_TAG}"
                    
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
                        echo "✅ No critical vulnerabilities found in production image"
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
                    def deployTag = env.BUILD_TAG
                    def deployImage = "${DOCKER_IMAGE}:${deployTag}"
                    
                    echo "🚀 Deploying version ${deployTag} to production VPS..."
                    
                    withCredentials([sshUserPrivateKey(
                        credentialsId: 'vps-ssh-key',
                        keyFileVariable: 'SSH_KEY',
                        usernameVariable: 'SSH_USER'
                    )]) {
                        sh """
                            ssh -o StrictHostKeyChecking=no -i \${SSH_KEY} \${SSH_USER}@139.180.218.27 << 'ENDSSH'
                                set -e
                                cd /root/bagisto
                                
                                echo "📥 Pulling specific version: ${deployImage}"
                                docker pull ${deployImage}
                                
                                echo "📝 Updating .env to use version ${deployTag}..."
                                sed -i 's|DOCKER_IMAGE=.*|DOCKER_IMAGE=${deployImage}|' .env
                                
                                echo "🔄 Deploying version ${deployTag}..."
                                docker-compose down
                                docker-compose up -d
                                
                                echo "📋 Recording deployment..."
                                mkdir -p /var/log
                                echo "\$(date '+%Y-%m-%d %H:%M:%S') - Deployed: ${deployTag}" >> /var/log/bagisto-deployments.log
                                
                                echo "🧹 Cleaning up old images (keeping last 5)..."
                                docker images bao110304/bagisto --format "{{.Tag}}" | grep -v latest | tail -n +6 | xargs -r -I {} docker rmi bao110304/bagisto:{} || true
                                
                                echo "✅ Deployment completed successfully!"
                                echo "📊 Current deployment:"
                                docker-compose ps
                                echo ""
                                echo "📜 Recent deployments:"
                                tail -5 /var/log/bagisto-deployments.log
ENDSSH
                        """
                    }
                    
                    echo """
                    ═══════════════════════════════════════
                    ✅ Deployed to VPS: 139.180.218.27
                    📦 Version: ${deployTag}
                    🔙 Rollback: ssh root@139.180.218.27 'cd /root/bagisto && sed -i "s|image: .*|image: bao110304/bagisto:PREVIOUS_TAG|" docker-compose.yml && docker-compose up -d'
                    ═══════════════════════════════════════
                    """
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
                
                // Cleanup build images
                sh """
                    docker rmi ${DOCKER_IMAGE}:build-${env.BUILD_TAG} || true
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
                        
                        🚀 Deployed to: 139.180.218.27
                        
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
