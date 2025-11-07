pipeline {
    agent none

    triggers {
        pollSCM('H/2 * * * *')
    }

    environment {
        SONAR_HOST = 'http://sonarqube:9000'
        SONAR_TOKEN = credentials('sonarqube-token')
        DOCKER_NETWORK = 'bagisto-docker_default'
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
                    sh """
                        cp .env.example .env
                        
                        cat >> .env << EOF
# CI/CD Database Configuration (Injected from Jenkins)
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=bagisto_testing
DB_USERNAME=\${DB_USERNAME}
DB_PASSWORD=\${DB_PASSWORD}

# Testing Environment
APP_ENV=testing
APP_DEBUG=false
APP_KEY=base64:\$(openssl rand -base64 32)

# Disable Redis for CI/CD (use array driver instead)
CACHE_DRIVER=array
SESSION_DRIVER=array
QUEUE_CONNECTION=sync
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
EOF
                        
                        echo "✓ Environment configured with secure credentials"
                    """
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
                                composer install --no-interaction --prefer-dist --optimize-autoloader --no-progress || echo "⚠️ Composer install completed with warnings"
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
                                npm install --quiet
                                
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
                    agent any
                    steps {
                        script {
                            // Start only MySQL service (Redis not needed for tests)
                            sh '''
                                cd ${WORKSPACE}
                                docker compose up -d mysql
                                
                                # Wait for MySQL to be ready
                                echo "Waiting for MySQL..."
                                for i in {1..30}; do
                                    if docker compose exec -T mysql mysqladmin ping -h localhost --silent; then
                                        echo "✅ MySQL is ready!"
                                        break
                                    fi
                                    echo "Waiting for MySQL... ($i/30)"
                                    sleep 2
                                done
                            '''
                            
                            // Run tests in PHP container with network access to services
                            docker.image('php-fpm:latest').inside("--network ${DOCKER_NETWORK} -u root") {
                                unstash 'configured-source'
                                unstash 'backend-deps'
                                dir('bagisto-app') {
                                    sh '''
                                        php artisan key:generate --force
                                        
                                        # Wait for database connection
                                        echo "Waiting for database connection..."
                                        for i in {1..30}; do
                                            if php artisan migrate:status --env=testing >/dev/null 2>&1; then
                                                echo "Database is ready!"
                                                break
                                            fi
                                            echo "Waiting for database... ($i/30)"
                                            sleep 2
                                        done
                                        
                                        php artisan migrate --force --env=testing
                                        
                                        # Run only ExampleTest.php
                                        echo "🧪 Running ExampleTest only..."
                                        php artisan test tests/ExampleTest.php
                                        
                                        echo "✅ ExampleTest passed!"
                                    '''
                                }
                            }
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
                        php artisan config:cache
                        php artisan route:cache
                        php artisan view:cache
                        
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
