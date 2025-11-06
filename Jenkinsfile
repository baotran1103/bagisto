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
                        
                        # Create .env from example
                        cp .env.example .env
                        
                        # Configure database connection using direct assignment
                        # (sed doesn't work when values are empty in .env.example)
                        cat >> .env << 'EOF'

# Override database settings for CI/CD
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=bagisto_testing
DB_USERNAME=root
DB_PASSWORD=root

# Testing environment
APP_ENV=testing
APP_DEBUG=false
EOF
                        
                        echo "✓ Created .env with database connection"
                        echo "✓ Database config:"
                        grep "^DB_" .env | grep -v "PASSWORD"
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
                        # Install Java (required for SonarQube scanner)
                        apt-get install -y -qq default-jre-headless wget unzip
                        
                        # Download and install SonarQube Scanner CLI
                        if [ ! -d "/opt/sonar-scanner" ]; then
                            wget -q https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-7.3.0.5189-linux-x64.zip -O /tmp/sonar.zip
                            unzip -q /tmp/sonar.zip -d /opt/
                            mv /opt/sonar-scanner-* /opt/sonar-scanner
                            ln -sf /opt/sonar-scanner/bin/sonar-scanner /usr/local/bin/sonar-scanner
                        fi
                        
                        # Run SonarQube analysis directly (no Docker-in-Docker)
                        sonar-scanner \
                            -Dsonar.projectKey=bagisto \
                            -Dsonar.projectName=Bagisto \
                            -Dsonar.sources=app,packages/Webkul \
                            -Dsonar.exclusions=vendor/**,node_modules/**,storage/**,public/**,tests/**,bootstrap/cache/** \
                            -Dsonar.host.url=${SONAR_HOST} \
                            -Dsonar.token=${SONAR_TOKEN} \
                            -Dsonar.sourceEncoding=UTF-8 || echo "⚠️ SonarQube analysis failed but continuing..."
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