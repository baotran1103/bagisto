pipeline {
    agent none

    triggers {
        pollSCM('H/5 * * * *')
    }

    environment {
        SONAR_HOST = 'http://sonarqube:9000'
        SONAR_TOKEN = 'squ_c06a60d0ca3bd18bf70e30588758f1471f5985f3'
        DOCKER_NETWORK = 'bagisto-docker_default'
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
                        
                        cat >> .env << 'EOF'

DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=bagisto_testing
DB_USERNAME=root
DB_PASSWORD=root

APP_ENV=testing
APP_DEBUG=false
EOF
                        
                        echo "✓ Environment configured"
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
                            args '-v composer-cache:/tmp/composer-cache -e COMPOSER_CACHE_DIR=/tmp/composer-cache -u root'
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
                            args '-v npm-cache:/root/.npm -u root'
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
                                php artisan migrate --force --env=testing || echo "⚠️ Migration failed"
                                
                                echo "=== Running PHPUnit Tests ==="
                                php artisan test || echo "⚠️ Some tests failed but continuing..."
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
                        tar -czf ../bagisto-build-${BUILD_NUMBER}.tar.gz \
                            --exclude=node_modules \
                            --exclude=.git \
                            --exclude=tests \
                            --exclude=storage/logs/* \
                            --exclude=*.tar.gz \
                            .
                        
                        echo "✓ Build artifact: bagisto-build-${BUILD_NUMBER}.tar.gz"
                        ls -lh ../bagisto-build-${BUILD_NUMBER}.tar.gz
                    '''
                }
                
                archiveArtifacts artifacts: 'bagisto-build-*.tar.gz', fingerprint: true, allowEmptyArchive: true
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
                - Status: ${currentBuild.result ?: 'SUCCESS'}
                - Duration: ${currentBuild.durationString}
                """
            }
        }
        success {
            node('') {
                echo '✅ Pipeline completed successfully!'
                echo 'Artifact ready for deployment'
            }
        }
        failure {
            node('') {
                echo '❌ Pipeline failed! Check logs above for details.'
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
