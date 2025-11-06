pipeline {
    agent any

    triggers {
        pollSCM('H/5 * * * *')
    }

    environment {
        SONAR_HOST = 'http://sonarqube:9000'
        PROJECT_DIR = '/var/www/html/bagisto'
    }

    stages {
        stage('Checkout') {
            steps {
                echo '=== Checking out code from GitHub ==='
                git branch: 'main',
                    url: 'https://github.com/baotran1103/bagisto.git',
                    credentialsId: 'github-credentials'
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
                sh 'composer install --no-interaction --no-progress --prefer-dist'

                echo '=== Installing Node dependencies ==='
                sh 'npm ci'
            }
        }

        stage('Run Tests') {
            steps {
                echo '=== Running PHPUnit tests ==='
                sh 'php artisan test --parallel'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                echo '=== Running SonarQube analysis ==='
                script {
                    // Call sonar-scanner container
                    sh '''
                        docker-compose exec -T sonar-scanner sonar-scanner \
                            -Dsonar.projectKey=bagisto \
                            -Dsonar.sources=app,packages \
                            -Dsonar.host.url=${SONAR_HOST} \
                            -Dsonar.token=${SONAR_TOKEN}
                    '''
                }
            }
        }

        stage('Virus Scan') {
            steps {
                echo '=== Scanning for viruses ==='
                sh '''
                    docker-compose exec -T clamav clamdscan \
                        --multiscan --fdpass /scan/workspace
                '''
            }
        }

        stage('Build Assets') {
            steps {
                echo '=== Building frontend assets ==='
                sh 'npm run build'

                echo '=== Optimizing application ==='
                sh 'php artisan optimize'
            }
        }
    }

    stage('Deploy to Local') {
        steps {
            echo '=== Deploying to local container ==='
            script {
                // Copy built files to running container
                sh '''
                    # Stop current container
                    docker-compose stop php-fpm
                    
                    # Copy new code
                    docker cp ${WORKSPACE}/. php-fpm:${PROJECT_DIR}
                    
                    # Run migrations
                    docker-compose exec -T php-fpm php artisan migrate --force
                    
                    # Clear cache
                    docker-compose exec -T php-fpm php artisan cache:clear
                    docker-compose exec -T php-fpm php artisan config:clear
                    docker-compose exec -T php-fpm php artisan route:clear
                    
                    # Start container
                    docker-compose start php-fpm
                '''
            }
        }
    }
    post {
        always {
            echo '=== Cleaning up workspace ==='
            cleanWs()
        }
        success {
            echo '✅ Pipeline completed successfully!'
        }
        failure {
            echo '❌ Pipeline failed! Check logs above.'
        }
    }
}
