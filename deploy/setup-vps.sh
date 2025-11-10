#!/bin/bash

# Bagisto VPS Setup Script
# Automated setup for Ubuntu VPS (CI/Staging Server)

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Functions
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if running as root
check_root() {
    if [[ $EUID -ne 0 ]]; then
        log_error "This script must be run as root"
        exit 1
    fi
}

# Update system
update_system() {
    log_info "Updating system..."
    apt update && apt upgrade -y
    apt install -y curl wget git unzip software-properties-common apt-transport-https ca-certificates gnupg lsb-release
    log_success "System updated"
}

# Install Docker
install_docker() {
    log_info "Installing Docker..."
    curl -fsSL https://get.docker.com -o get-docker.sh
    sh get-docker.sh
    usermod -aG docker $SUDO_USER
    systemctl enable docker
    systemctl start docker
    log_success "Docker installed"
}

# Install Docker Compose
install_docker_compose() {
    log_info "Installing Docker Compose..."
    curl -L "https://github.com/docker/compose/releases/download/v2.24.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    chmod +x /usr/local/bin/docker-compose
    log_success "Docker Compose installed"
}

# Install Java for Jenkins
install_java() {
    log_info "Installing Java 17..."
    apt install -y openjdk-17-jdk
    log_success "Java 17 installed"
}

# Install Jenkins
install_jenkins() {
    log_info "Installing Jenkins..."
    curl -fsSL https://pkg.jenkins.io/debian-stable/jenkins.io-2023.key | tee /usr/share/keyrings/jenkins-keyring.asc > /dev/null
    echo deb [signed-by=/usr/share/keyrings/jenkins-keyring.asc] https://pkg.jenkins.io/debian-stable binary/ | tee /etc/apt/sources.list.d/jenkins.list > /dev/null
    apt update
    apt install -y jenkins
    systemctl enable jenkins
    systemctl start jenkins
    log_success "Jenkins installed"
}

# Install development tools
install_dev_tools() {
    log_info "Installing development tools..."

    # Composer
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer

    # Node.js 18
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
    apt install -y nodejs

    # ClamAV for security scanning
    apt install -y clamav clamav-daemon
    systemctl stop clamav-freshclam
    freshclam
    systemctl start clamav-freshclam

    log_success "Development tools installed"
}

# Configure firewall
configure_firewall() {
    log_info "Configuring firewall..."
    apt install -y ufw
    ufw --force enable
    ufw allow ssh
    ufw allow 80
    ufw allow 443
    ufw allow 8080  # Jenkins
    ufw allow 3000  # Grafana
    ufw allow 9090  # Prometheus
    ufw allow 9100  # Node Exporter
    log_success "Firewall configured"
}

# Setup swap space for 1GB RAM VPS
setup_swap() {
    log_info "Setting up swap space..."
    fallocate -l 1G /swapfile
    chmod 600 /swapfile
    mkswap /swapfile
    swapon /swapfile
    echo '/swapfile none swap sw 0 0' | tee -a /etc/fstab
    log_success "Swap space configured"
}

# Optimize system for low memory
optimize_system() {
    log_info "Optimizing system for low memory..."

    # Disable unnecessary services
    systemctl disable bluetooth.service
    systemctl disable cups.service

    # Configure sysctl for better performance
    cat >> /etc/sysctl.conf << EOF
vm.swappiness=10
vm.vfs_cache_pressure=50
EOF
    sysctl -p

    log_success "System optimized"
}

# Show completion message
show_completion() {
    JENKINS_PASSWORD=$(cat /var/lib/jenkins/secrets/initialAdminPassword)

    log_success "Setup completed successfully!"
    echo ""
    echo "========================================"
    echo "🎉 Bagisto VPS Setup Complete!"
    echo "========================================"
    echo ""
    echo "📋 Next steps:"
    echo "1. Access Jenkins: http://$(hostname -I | awk '{print $1}'):8080"
    echo "   Initial password: $JENKINS_PASSWORD"
    echo ""
    echo "2. Clone your project:"
    echo "   git clone https://github.com/baotran1103/bagisto-app.git"
    echo "   cd bagisto-app"
    echo ""
    echo "3. Configure environment:"
    echo "   cp deploy/.env.staging .env"
    echo "   nano .env  # Edit database and app settings"
    echo ""
    echo "4. Run initial deployment:"
    echo "   chmod +x deploy/deploy.sh"
    echo "   ./deploy/deploy.sh deploy"
    echo ""
    echo "5. Setup Jenkins pipeline:"
    echo "   - Create new pipeline job"
    echo "   - Point to deploy/Jenkinsfile"
    echo "   - Configure GitHub credentials"
    echo ""
    echo "🔒 Security reminders:"
    echo "• Change default passwords"
    echo "• Setup SSL certificates"
    echo "• Configure domain name"
    echo "• Regular system updates"
    echo ""
    echo "📊 Monitoring URLs:"
    echo "• Grafana: http://$(hostname -I | awk '{print $1}'):3000 (admin/admin)"
    echo "• Prometheus: http://$(hostname -I | awk '{print $1}'):9090"
    echo ""
}

# Main setup
main() {
    check_root

    log_info "Starting Bagisto VPS setup..."
    echo "This will install Docker, Jenkins, and development tools"
    echo "Target: Ubuntu VPS with 1vCPU/1GB RAM"
    echo ""

    update_system
    install_docker
    install_docker_compose
    install_java
    install_jenkins
    install_dev_tools
    configure_firewall
    setup_swap
    optimize_system

    show_completion
}

# Run main function
main "$@"