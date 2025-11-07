pipeline {
    agent none

    triggers {
        pollSCM('H/2 * * * *')
    }

    environment {
        SONAR_HOST = 'http://sonarqube:9000'
        SONAR_TOKEN = credentials('sonarqube-token')
        DOCKER_NETWORK = 'bagisto-docker_default'
        // Database credentials from Jenkins
        DB_HOST = 'mysql'
        DB_PORT = '3306'
        DB_DATABASE = 'bagisto_testing'
        DB_USERNAME = credentials('db-username')
        DB_PASSWORD = credentials('db-password')
    }

    stages {
        stage('Checkout') {
            agent any
            steps {
                script {
                    echo '=== Cloning Bagisto Application ==='
                    dir('bagisto-app') {
                        git branch: 'main',
                            credentialsId: 'GITHUB_PAT',
                            url: 'https://github.com/baotran1103/bagisto-app.git'
                        
                        env.GIT_COMMIT = sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()
                        env.GIT_BRANCH = sh(script: 'git rev-parse --abbrev-ref HEAD', returnStdout: true).trim()
                    }
                    stash name: 'source-code', includes: 'bagisto-app/**'
                }
            }
        }
        
        stage('Setup Environment') {
            agent any
            steps {
                unstash 'source-code'
                dir('bagisto-app') {
                    sh '''
                        cp .env.example .env
                        
                        cat >> .env << EOF
                        # CI/CD Database Configuration (Injected from Jenkins)
                        DB_HOST=${DB_HOST}
                        DB_PORT=${DB_PORT}
                        DB_DATABASE=${DB_DATABASE}
                        DB_USERNAME=${DB_USERNAME}
                        DB_PASSWORD=${DB_PASSWORD}

                        # Testing Environment
                        APP_ENV=testing
                        APP_DEBUG=false
                        EOF
                        
                        echo "✓ Environment configured with secure credentials"
                    '''
                }
                stash name: 'configured-source', includes: 'bagisto-app/**'
            }
        }
        
        stage('Parallel Build') {
            parallel {
                stage('Backend Dependencies') {
                    agent {
                        docker {
                            image 'php-fpm:latest'
                            args '-u root'
                        }
                    }
                    steps {
                        unstash 'configured-source'
                        dir('bagisto-app') {
                            sh '''
                                echo "=== Installing Composer Dependencies ==="
                                composer install --no-interaction --prefer-dist --optimize-autoloader --no-progress
                                echo "✓ Composer packages installed"
                            '''
                        }
                        stash name: 'backend-deps', includes: 'bagisto-app/vendor/**'
                    }
                }
                
                stage('Frontend Dependencies & Build') {
                    agent {
                        docker {
                            image 'php-fpm:latest'
                            args '-u root'
                        }
                    }
                    steps {
                        unstash 'configured-source'
                        dir('bagisto-app') {
                            sh '''
                                echo "=== Installing NPM Dependencies ==="
                                npm install --quiet
                                
                                echo "=== Building Frontend Assets ==="
                                npm run build
                                
                                echo "✓ Frontend built successfully"
                            '''
                        }
                        stash name: 'frontend-build', includes: 'bagisto-app/public/build/**,bagisto-app/node_modules/**'
                    }
                }
            }
        }
        
        stage('Tests & Quality') {
            parallel {
                stage('PHPUnit Tests') {
                    agent {
                        docker {
                            image 'php-fpm:latest'
                            args """
                                --network ${DOCKER_NETWORK}
                                -u root
                            """
                        }
                    }
                    steps {
                        unstash 'configured-source'
                        unstash 'backend-deps'
                        dir('bagisto-app') {
                            sh '''
                                echo "=== Generating Application Key ==="
                                php artisan key:generate --force
                                
                                echo "=== Running Database Migrations ==="
                                php artisan migrate --force --env=testing
                                
                                echo "=== Running PHPUnit Tests ==="
                                php artisan test
                                
                                echo "✅ All tests passed!"
                            '''
                        }
                    }
                }
                
                stage('Code Quality Analysis') {
                    agent {
                        docker {
                            image 'sonarsource/sonar-scanner-cli:latest'
                            args "--network ${DOCKER_NETWORK}"
                        }
                    }
                    steps {
                        unstash 'configured-source'
                        dir('bagisto-app') {
                            sh """
                                echo "=== Running SonarQube Analysis ==="
                                sonar-scanner \\
                                    -Dsonar.projectKey=bagisto \\
                                    -Dsonar.projectName=Bagisto \\
                                    -Dsonar.sources=app,packages/Webkul \\
                                    -Dsonar.exclusions=vendor/**,node_modules/**,storage/**,public/**,tests/**,bootstrap/cache/** \\
                                    -Dsonar.host.url=${SONAR_HOST} \\
                                    -Dsonar.token=${SONAR_TOKEN} \\
                                    -Dsonar.sourceEncoding=UTF-8 || echo "⚠️ SonarQube analysis failed"
                            """
                        }
                    }
                }
                
                stage('Security Audits') {
                    stages {
                        stage('Composer Audit') {
                            agent {
                                docker { 
                                    image 'php-fpm:latest'
                                    args '-u root'
                                }
                            }
                            steps {
                                unstash 'configured-source'
                                unstash 'backend-deps'
                                dir('bagisto-app') {
                                    sh '''
                                        echo "📦 Composer Security Audit:"
                                        composer audit || echo "⚠️ PHP vulnerabilities found"
                                    '''
                                }
                            }
                        }
                        
                        stage('NPM Audit') {
                            agent {
                                docker { 
                                    image 'php-fpm:latest'
                                    args '-u root'
                                }
                            }
                            steps {
                                unstash 'configured-source'
                                unstash 'frontend-build'
                                dir('bagisto-app') {
                                    sh '''
                                        echo "📦 NPM Security Audit:"
                                        npm audit --audit-level=moderate || echo "⚠️ Node vulnerabilities found"
                                    '''
                                }
                            }
                        }
                    }
                }
            }
        }
        
        stage('Optimize Application') {
            agent {
                docker {
                    image 'php-fpm:latest'
                    args '-u root'
                }
            }
            steps {
                unstash 'configured-source'
                unstash 'backend-deps'
                dir('bagisto-app') {
                    sh '''
                        echo "=== Optimizing Laravel ==="
                        php artisan config:cache
                        php artisan route:cache
                        php artisan view:cache
                        
                        echo "=== Health Check ==="
                        php artisan --version
                        php artisan config:list --env=testing | head -5
                        
                        echo "✓ Laravel optimization completed"
                    '''
                }
                stash name: 'optimized-app', includes: 'bagisto-app/**', excludes: 'bagisto-app/node_modules/**'
            }
        }
        
        stage('Create Deployment Package') {
            agent any
            steps {
                unstash 'optimized-app'
                unstash 'frontend-build'
                
                dir('bagisto-app') {
                    sh '''
                        echo "=== Creating Deployment Artifact ==="
                        ARTIFACT_NAME="bagisto-${BUILD_NUMBER}-${GIT_COMMIT}.tar.gz"
                        tar -czf "../${ARTIFACT_NAME}" \\
                            --exclude=node_modules \\
                            --exclude=.git \\
                            --exclude=tests \\
                            --exclude=storage/logs/* \\
                            --exclude=*.tar.gz \\
                            .
                        
                        echo "✓ Build artifact: ${ARTIFACT_NAME}"
                        ls -lh "../${ARTIFACT_NAME}"
                        echo "📋 Artifact contains:"
                        tar -tzf "../${ARTIFACT_NAME}" | head -10
                    '''
                }
                
                archiveArtifacts artifacts: 'bagisto-*.tar.gz', fingerprint: true, allowEmptyArchive: false
            }
        }
    }
    
    post {
        always {
            node('') {
                echo '=== Pipeline Execution Completed ==='
                echo """
                Build Summary:
                - Build Number: ${BUILD_NUMBER}
                - Git Commit: ${GIT_COMMIT}
                - Git Branch: ${GIT_BRANCH}
                - Status: ${currentBuild.result ?: 'SUCCESS'}
                - Duration: ${currentBuild.durationString}
                - Artifact: bagisto-${BUILD_NUMBER}-${GIT_COMMIT}.tar.gz
                """
            }
        }
        success {
            node('') {
                echo '✅ Pipeline completed successfully!'
                echo '🚀 Artifact ready for deployment'
                echo "📦 Download: bagisto-${BUILD_NUMBER}-${GIT_COMMIT}.tar.gz"
                
                emailext subject: "✅ Build Success: Bagisto ${BUILD_NUMBER}",
                        body: """
                        🎉 Build completed successfully!
                        
                        Build Details:
                        - Build Number: ${BUILD_NUMBER}
                        - Git Commit: ${GIT_COMMIT}
                        - Git Branch: ${GIT_BRANCH}
                        - Duration: ${currentBuild.durationString}
                        
                        📦 Artifact: bagisto-${BUILD_NUMBER}-${GIT_COMMIT}.tar.gz
                        
                        🔗 Jenkins Build: ${BUILD_URL}
                        
                        Ready for deployment!
                        """,
                        to: 'tnqbao11@gmail.com'
            }
        }
        failure {
            node('') {
                echo '❌ Pipeline failed! Check logs above for details.'
                echo '🔄 Rollback: Use previous successful build artifact'
                
                emailext subject: "❌ Build Failed: Bagisto ${BUILD_NUMBER}",
                        body: """
                        🚨 Build failed!
                        
                        Build Details:
                        - Build Number: ${BUILD_NUMBER}
                        - Git Commit: ${GIT_COMMIT}
                        - Git Branch: ${GIT_BRANCH}
                        - Duration: ${currentBuild.durationString}
                        
                        🔗 Jenkins Build: ${BUILD_URL}
                        
                        Please check the build logs for details and fix the issues.
                        """,
                        to: 'tnqbao11@gmail.com'
            }
        }
        cleanup {
            node('') {
                echo '=== Cleaning up workspace ==='
                cleanWs(deleteDirs: true, disableDeferredWipeout: true, notFailBuild: true)
            }
        }
    }
}
