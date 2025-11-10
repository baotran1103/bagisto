#!/bin/bash

# Bagisto Staging Deployment Script
# Usage: ./deploy.sh [build|deploy|rollback]

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
PROJECT_NAME="bagisto-staging"
DEPLOY_DIR="$HOME/bagisto-staging"
BACKUP_DIR="$HOME/bagisto-backups"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

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
    if [[ $EUID -eq 0 ]]; then
        log_error "This script should not be run as root"
        exit 1
    fi
}

# Create backup
create_backup() {
    log_info "Creating backup..."
    mkdir -p $BACKUP_DIR

    # Backup database
    if docker-compose ps mysql | grep -q "Up"; then
        log_info "Backing up database..."
        docker-compose exec -T mysql mysqldump -u root -p$MYSQL_ROOT_PASSWORD $DB_DATABASE > $BACKUP_DIR/db_backup_$TIMESTAMP.sql
    fi

    # Backup files
    if [ -d "$DEPLOY_DIR" ]; then
        log_info "Backing up application files..."
        tar -czf $BACKUP_DIR/files_backup_$TIMESTAMP.tar.gz -C /opt bagisto-staging
    fi

    log_success "Backup created: $BACKUP_DIR/${TIMESTAMP}"
}

# Build application
build_app() {
    log_info "Building application..."

    # Pull latest changes
    git pull origin main

    # Generate app key if not exists
    if ! grep -q "APP_KEY=" .env.staging; then
        APP_KEY=$(docker run --rm php:8.2-cli php -r "echo 'base64:' . base64_encode(random_bytes(32));")
        sed -i "s/APP_KEY=/APP_KEY=$APP_KEY/" .env.staging
    fi

    # Build and start services
    docker-compose -f deploy/docker-compose.staging.yml build --no-cache
    docker-compose -f deploy/docker-compose.staging.yml up -d

    # Wait for services to be ready
    log_info "Waiting for services to be ready..."
    sleep 30

    # Run migrations and seeders
    docker-compose -f deploy/docker-compose.staging.yml exec -T app php artisan migrate --force
    docker-compose -f deploy/docker-compose.staging.yml exec -T app php artisan db:seed --force
    docker-compose -f deploy/docker-compose.staging.yml exec -T app php artisan storage:link

    # Clear and cache config
    docker-compose -f deploy/docker-compose.staging.yml exec -T app php artisan config:cache
    docker-compose -f deploy/docker-compose.staging.yml exec -T app php artisan route:cache
    docker-compose -f deploy/docker-compose.staging.yml exec -T app php artisan view:cache

    log_success "Application built and deployed successfully"
}

# Deploy application
deploy_app() {
    log_info "Starting deployment..."

    create_backup

    # Stop services
    log_info "Stopping services..."
    docker-compose -f deploy/docker-compose.staging.yml down

    # Deploy new version
    build_app

    # Health check
    log_info "Performing health check..."
    if curl -f http://localhost/health > /dev/null 2>&1; then
        log_success "Health check passed"
    else
        log_warning "Health check failed, but continuing deployment"
    fi

    log_success "Deployment completed successfully"
}

# Rollback
rollback_app() {
    log_info "Starting rollback..."

    # Find latest backup
    LATEST_BACKUP=$(ls -t $BACKUP_DIR/files_backup_*.tar.gz | head -1)
    LATEST_DB_BACKUP=$(ls -t $BACKUP_DIR/db_backup_*.sql | head -1)

    if [ -z "$LATEST_BACKUP" ]; then
        log_error "No backup found for rollback"
        exit 1
    fi

    log_info "Rolling back to backup: $(basename $LATEST_BACKUP)"

    # Stop services
    docker-compose -f deploy/docker-compose.staging.yml down

    # Restore files
    log_info "Restoring files..."
    rm -rf $DEPLOY_DIR
    mkdir -p $HOME
    tar -xzf $LATEST_BACKUP -C $HOME

    # Restore database
    if [ -n "$LATEST_DB_BACKUP" ]; then
        log_info "Restoring database..."
        docker-compose -f deploy/docker-compose.staging.yml up -d mysql
        sleep 10
        docker-compose -f deploy/docker-compose.staging.yml exec -T mysql mysql -u root -p$MYSQL_ROOT_PASSWORD $DB_DATABASE < $LATEST_DB_BACKUP
    fi

    # Start services
    docker-compose -f deploy/docker-compose.staging.yml up -d

    log_success "Rollback completed"
}

# Show status
show_status() {
    log_info "Application Status:"
    docker-compose -f deploy/docker-compose.staging.yml ps

    log_info "Resource Usage:"
    docker stats --no-stream --format "table {{.Container}}\t{{.CPUPerc}}\t{{.MemUsage}}"
}

# Main script
case "${1:-status}" in
    "build")
        check_root
        build_app
        ;;
    "deploy")
        check_root
        deploy_app
        ;;
    "rollback")
        check_root
        rollback_app
        ;;
    "status")
        show_status
        ;;
    "backup")
        check_root
        create_backup
        ;;
    *)
        echo "Usage: $0 [build|deploy|rollback|status|backup]"
        echo ""
        echo "Commands:"
        echo "  build    - Build application without deploying"
        echo "  deploy   - Full deployment with backup"
        echo "  rollback - Rollback to previous version"
        echo "  status   - Show application status"
        echo "  backup   - Create manual backup"
        exit 1
        ;;
esac