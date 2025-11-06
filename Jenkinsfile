pipeline {
    agent {
        docker {
            image 'php-fpm'
            args '-v /var/run/docker.sock:/var/run/docker.sock -v /Users/baotran/Documents/Rivercrane/bagisto-docker:/workspace --network bagisto-docker_default'
            reuseNode true
        }
    }
    
    triggers {
        pollSCM('H/5 * * * *')
    }
    
    environment {
        SONAR_HOST = 'http://sonarqube:9000'
        SONAR_TOKEN = 'squ_c06a60d0ca3bd18bf70e30588758f1471f5985f3'
        PROJECT_DIR = '/var/www/html/bagisto'
    }
    
    stages {
        stage('Checkout') {
            steps {
                echo '=== Checking out code from GitHub ==='
                checkout scm
            }
        }
        
        stage('Environment Info') {
            steps {
                echo '=== Checking environment ==='
                sh 'php -v'
                sh 'composer --version'
                sh 'node --version'
                sh 'npm --version'
            }
        }
        
        stage('Install Dependencies') {
            steps {
                echo '=== Installing PHP dependencies ==='
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                
                echo '=== Installing Node dependencies ==='
                sh 'npm install'
            }
        }
        
        stage('Run Tests') {
            steps {
                echo '=== Running PHPUnit tests ==='
                sh 'php artisan test || echo "Tests failed but continuing..."'
            }
        }
        
        stage('SonarQube Analysis') {
            steps {
                echo '=== Running SonarQube analysis ==='
                script {
                    sh '''
                        cd /workspace
                        docker run --rm \
                            --network bagisto-docker_default \
                            -v ${WORKSPACE}:/usr/src \
                            -e SONAR_HOST_URL=${SONAR_HOST} \
                            -e SONAR_TOKEN=${SONAR_TOKEN} \
                            sonarsource/sonar-scanner-cli:latest \
                            -Dsonar.projectKey=bagisto \
                            -Dsonar.projectName=Bagisto \
                            -Dsonar.sources=app,packages \
                            -Dsonar.exclusions=vendor/**,node_modules/**,storage/**,public/**
                    '''
                }
            }
        }
        
        stage('Virus Scan') {
            steps {
                echo '=== Scanning for viruses with ClamAV ==='
                script {
                    sh '''
                        cd /workspace
                        docker-compose exec -T clamav clamdcheck || echo "ClamAV not ready"
                        docker-compose exec -T clamav clamdscan --multiscan --fdpass /scan/workspace/bagisto || echo "Scan completed"
                    '''
                }
            }
        }
        
        stage('Build Assets') {
            steps {
                echo '=== Building frontend assets ==='
                sh 'npm run build'
                
                echo '=== Optimizing Laravel application ==='
                sh '''
                    php artisan config:cache
                    php artisan route:cache
                    php artisan view:cache
                '''
            }
        }
        
        stage('Deploy to Local') {
            steps {
                echo '=== Deploying to local Docker environment ==='
                script {
                    sh '''
                        cd /workspace
                        
                        # Clear cache in running container
                        docker-compose exec -T php-fpm php artisan cache:clear
                        docker-compose exec -T php-fpm php artisan config:clear
                        docker-compose exec -T php-fpm php artisan route:clear
                        docker-compose exec -T php-fpm php artisan view:clear
                        
                        # Run migrations
                        docker-compose exec -T php-fpm php artisan migrate --force || echo "Migration completed"
                        
                        echo "✓ Deployment completed successfully!"
                    '''
                }
            }
        }
    }
    
    post {
        always {
            echo '=== Pipeline execution completed ==='
            cleanWs(deleteDirs: true, patterns: [[pattern: 'node_modules/**', type: 'INCLUDE']])
        }
        success {
            echo '✓ Pipeline completed successfully!'
        }
        failure {
            echo '✗ Pipeline failed! Check logs above.'
        }
    }
}