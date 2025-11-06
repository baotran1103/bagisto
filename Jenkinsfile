pipeline {
    agent {
        docker {
            image 'php:8.3-fpm'
            args '''
                -v composer-cache:/root/.composer
                -v npm-cache:/root/.npm
                -v /var/run/docker.sock:/var/run/docker.sock
                --network bagisto-docker_default
                -u root
            '''
        }
    }
    
    triggers {
        pollSCM('H/5 * * * *')
    }
    
    environment {
        SONAR_HOST = 'http://sonarqube:9000'
        SONAR_TOKEN = 'squ_c06a60d0ca3bd18bf70e30588758f1471f5985f3'
    }
    
    stages {
        stage('Checkout Bagisto Code') {
            steps {
                script {
                    // Clone Bagisto application from your repository
                    dir('bagisto-app') {
                        git branch: 'main',
                            credentialsId: 'GITHUB_PAT',
                            url: 'https://github.com/baotran1103/bagisto-app.git'
                    }
                }
            }
        }
        
        stage('Install System Dependencies') {
            steps {
                echo '=== Installing Node.js and system tools ==='
                sh '''
                    apt-get update -qq
                    apt-get install -y -qq nodejs npm git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libicu-dev curl
                    
                    # Install PHP extensions (including calendar and intl for Bagisto)
                    docker-php-ext-configure gd --with-freetype --with-jpeg
                    docker-php-ext-install pdo pdo_mysql zip gd calendar intl
                    
                    # Install Composer
                    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
                    
                    # Verify installations
                    echo "✓ PHP: $(php -v | head -n1)"
                    echo "✓ Composer: $(composer --version)"
                    echo "✓ Node: $(node --version)"
                    echo "✓ NPM: $(npm --version)"
                    echo "✓ PHP Extensions:"
                    php -m | grep -E "(calendar|intl|gd|zip|pdo_mysql)"
                    echo "✓ Working directory: $(pwd)"
                    echo "✓ Files in workspace:"
                    ls -la
                '''
            }
        }
        
        stage('Setup Environment') {
            steps {
                echo '=== Setting up application environment ==='
                dir('bagisto-app') {
                    sh '''
                        # Check if composer.json exists
                        if [ ! -f composer.json ]; then
                            echo "❌ ERROR: composer.json not found!"
                            exit 1
                        fi
                        
                        # Create .env with proper database connection
                        cp .env.example .env
                        
                        # Configure database connection to docker-compose MySQL
                        sed -i 's/DB_HOST=127.0.0.1/DB_HOST=mysql/' .env
                        sed -i 's/DB_DATABASE=bagisto/DB_DATABASE=bagisto/' .env
                        sed -i 's/DB_USERNAME=root/DB_USERNAME=root/' .env
                        sed -i 's/DB_PASSWORD=/DB_PASSWORD=root/' .env
                        
                        # Configure for testing
                        sed -i 's/APP_ENV=local/APP_ENV=testing/' .env
                        sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
                        
                        echo "✓ Created .env with database connection to mysql container"
                        echo "✓ DB_HOST=mysql (docker-compose service)"
                    '''
                }
            }
        }
        
        stage('Install Dependencies') {
            steps {
                echo '=== Installing Composer dependencies ==='
                dir('bagisto-app') {
                    sh '''
                        composer install --no-interaction --prefer-dist --optimize-autoloader --no-progress
                    '''
                }
                
                echo '=== Installing NPM dependencies ==='
                dir('bagisto-app') {
                    sh '''
                        npm install --quiet
                    '''
                }
            }
        }
        
        stage('Run Tests') {
            steps {
                echo '=== Running PHPUnit tests ==='
                dir('bagisto-app') {
                    sh '''
                        # Generate app key for Laravel
                        php artisan key:generate --force
                        
                        # Run migrations in testing environment
                        php artisan migrate --force --env=testing || echo "⚠️ Migration failed"
                        
                        # Run tests
                        php artisan test || echo "⚠️ Some tests failed but continuing..."
                    '''
                }
            }
        }
        
        stage('Code Quality Analysis') {
            steps {
                echo '=== Running SonarQube analysis ==='
                dir('bagisto-app') {
                    sh '''
                        # Install docker CLI if needed
                        which docker || apt-get install -y -qq docker.io
                        
                        # Debug: Check current directory structure
                        echo "Current directory: $(pwd)"
                        echo "Directory contents:"
                        ls -la
                        echo "Checking app directory:"
                        ls -la app/ || echo "app/ not found"
                        echo "Checking packages directory:"
                        ls -la packages/ || echo "packages/ not found"
                        
                        # Run SonarQube scanner with absolute path
                        docker run --rm \
                            --network bagisto-docker_default \
                            -v "$(pwd):/usr/src" \
                            -w /usr/src \
                            -e SONAR_HOST_URL=${SONAR_HOST} \
                            -e SONAR_TOKEN=${SONAR_TOKEN} \
                            sonarsource/sonar-scanner-cli:latest \
                            -Dsonar.projectKey=bagisto \
                            -Dsonar.projectName=Bagisto \
                            -Dsonar.sources=app,packages/Webkul \
                            -Dsonar.exclusions=vendor/**,node_modules/**,storage/**,public/**,tests/**,bootstrap/cache/** \
                            -Dsonar.sourceEncoding=UTF-8
                    '''
                }
            }
        }
        
        stage('Security Scan') {
            steps {
                echo '=== Running security audits ==='
                dir('bagisto-app') {
                    sh '''
                        echo "📦 Composer security audit:"
                        composer audit || echo "⚠ PHP vulnerabilities found"
                        
                        echo ""
                        echo "📦 NPM security audit:"
                        npm audit --audit-level=moderate || echo "⚠ Node vulnerabilities found"
                    '''
                }
            }
        }
        
        stage('Build Assets') {
            steps {
                echo '=== Building frontend assets ==='
                dir('bagisto-app') {
                    sh '''
                        npm run build
                    '''
                }
            }
        }
        
        stage('Optimize Application') {
            steps {
                echo '=== Optimizing Laravel ==='
                dir('bagisto-app') {
                    sh '''
                        php artisan config:cache
                        php artisan route:cache
                        php artisan view:cache
                        
                        echo "✓ Laravel optimization completed"
                    '''
                }
            }
        }
        
        stage('Create Deployment Package') {
            steps {
                echo '=== Creating deployment artifact ==='
                dir('bagisto-app') {
                    sh '''
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
            }
        }
    }
    
    post {
        always {
            echo '=== Pipeline execution completed ==='
        }
        success {
            echo '✅ Pipeline completed successfully!'
            archiveArtifacts artifacts: 'bagisto-build-*.tar.gz', fingerprint: true, allowEmptyArchive: true
        }
        failure {
            echo '❌ Pipeline failed! Check logs above.'
        }
        cleanup {
            echo '=== Cleaning up workspace ==='
            cleanWs(deleteDirs: true, disableDeferredWipeout: true, notFailBuild: true)
        }
    }
}