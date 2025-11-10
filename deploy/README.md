# Bagisto Deployment System

Hệ thống deployment cho Bagisto e-commerce platform với CI/CD pipeline.

## Kiến trúc

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Local Dev     │    │   CI/Staging    │    │   Production    │
│   (Mac)         │    │   (VPS Ubuntu)  │    │   (EC2)         │
│                 │    │                 │    │                 │
│ • Docker dev    │    │ • Jenkins CI/CD  │    │ • Production    │
│ • Full services │    │ • Docker staging │    │ • Auto scaling  │
│ • All tools     │    │ • Monitoring     │    │ • Load balance  │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

## Cấu trúc thư mục

```
deploy/
├── docker-compose.staging.yml    # Docker compose cho staging
├── Dockerfile.prod              # Docker image cho production
├── nginx.conf                   # Nginx configuration
├── supervisord.conf            # Process manager config
├── .env.staging                # Environment variables
├── deploy.sh                   # Deployment script
├── Jenkinsfile                 # CI/CD pipeline
└── monitoring/
    └── prometheus.yml          # Monitoring configuration
```

## Setup VPS Ubuntu (CI/Staging Server)

### 1. Cài đặt Docker và Docker Compose

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker $USER

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/download/v2.24.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Restart session
newgrp docker
```

### 2. Cài đặt Jenkins

```bash
# Install Java
sudo apt install openjdk-17-jdk -y

# Add Jenkins repo
curl -fsSL https://pkg.jenkins.io/debian-stable/jenkins.io-2023.key | sudo tee /usr/share/keyrings/jenkins-keyring.asc > /dev/null
echo deb [signed-by=/usr/share/keyrings/jenkins-keyring.asc] https://pkg.jenkins.io/debian-stable binary/ | sudo tee /etc/apt/sources.list.d/jenkins.list > /dev/null

# Install Jenkins
sudo apt update
sudo apt install jenkins -y

# Start Jenkins
sudo systemctl start jenkins
sudo systemctl enable jenkins

# Get initial admin password
sudo cat /var/lib/jenkins/secrets/initialAdminPassword
```

### 3. Cài đặt Git và tools cần thiết

```bash
sudo apt install git curl wget unzip -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install nodejs -y
```

### 4. Clone project và setup

```bash
# Clone project
git clone https://github.com/baotran1103/bagisto-app.git
cd bagisto-app

# Copy deploy files
cp -r deploy/* .

# Setup environment
cp .env.staging .env
nano .env  # Edit database credentials, app key, etc.
```

### 5. Chạy deployment script

```bash
# Make deploy script executable
chmod +x deploy.sh

# Initial deployment
./deploy.sh deploy
```

## CI/CD Pipeline

### Jenkins Setup

1. **Truy cập Jenkins**: `http://your-vps-ip:8080`
2. **Cài đặt plugins cần thiết**:
   - Git Plugin
   - Docker Plugin
   - Pipeline Plugin
   - Email Extension Plugin

3. **Tạo credentials**:
   - `GITHUB_PAT`: GitHub Personal Access Token
   - `DOCKER_REGISTRY`: Docker registry credentials (nếu cần)

4. **Tạo Pipeline Job**:
   - Tên: `bagisto-staging-deploy`
   - Type: Pipeline
   - Definition: Pipeline script from SCM
   - SCM: Git
   - Repository URL: `https://github.com/baotran1103/bagisto-app.git`
   - Script Path: `deploy/Jenkinsfile`

### Pipeline Stages

1. **Checkout & Setup**: Clone code và setup environment
2. **Security & Quality Checks**: Chạy song song
   - Code Quality (PHPStan, PHPCS)
   - Security Scan (Composer/NPM audit, ClamAV)
   - Unit Tests (Pest)
3. **Build Docker Image**: Build production image
4. **Deploy to Staging**: Deploy lên staging server
5. **Integration Tests**: Test chức năng
6. **Performance Test**: Kiểm tra performance

## Monitoring

### Truy cập monitoring services

- **Grafana**: `http://your-vps-ip:3000` (admin/admin)
- **Prometheus**: `http://your-vps-ip:9090`

### Metrics được monitor

- System resources (CPU, Memory, Disk)
- Nginx performance
- MySQL performance
- Redis performance
- Application metrics

## Deployment Commands

```bash
# Status
./deploy.sh status

# Deploy new version
./deploy.sh deploy

# Build only
./deploy.sh build

# Rollback
./deploy.sh rollback

# Manual backup
./deploy.sh backup
```

## Environment Variables

Chỉnh sửa file `.env.staging`:

```bash
# Application
APP_NAME="Bagisto Staging"
APP_ENV=staging
APP_KEY=your-app-key-here
APP_DEBUG=false
APP_URL=http://your-staging-domain.com

# Database
DB_DATABASE=bagisto_staging
DB_USERNAME=bagisto_user
DB_PASSWORD=your-db-password

# Docker
MYSQL_ROOT_PASSWORD=your-mysql-root-password
GRAFANA_PASSWORD=your-grafana-password
```

## Troubleshooting

### Common Issues

1. **Port conflicts**: Kiểm tra ports 80, 443, 3000, 9090, 9100
2. **Permission issues**: Đảm bảo user có quyền Docker
3. **Memory issues**: Với 1GB RAM, monitor memory usage
4. **Database connection**: Kiểm tra DB credentials

### Logs

```bash
# Application logs
docker-compose -f docker-compose.staging.yml logs app

# Nginx logs
docker-compose -f docker-compose.staging.yml logs nginx

# Jenkins logs
sudo journalctl -u jenkins -f
```

## Security Notes

- Thay đổi tất cả default passwords
- Sử dụng HTTPS trong production
- Cấu hình firewall (UFW)
- Regular security updates
- Monitor logs cho suspicious activities

## Performance Optimization (1vCPU/1GB RAM)

- Sử dụng Alpine Linux images
- Enable OPcache
- File-based caching thay Redis (nếu cần)
- Limit concurrent connections
- Optimize MySQL config
- Use CDN cho static assets