# VPS Deployment Guide

## Prerequisites on VPS (139.180.218.27)
```bash
# 1. Create deployment directory
mkdir -p /root/bagisto
cd /root/bagisto

# 2. Create .env file (if needed for custom config)
# The docker-compose already has basic env vars
```

## Deploy from Local Machine

### Option 1: Deploy Latest Build
```bash
./deploy-vps.sh
```

### Option 2: Deploy Specific Build Tag
```bash
./deploy-vps.sh 165-a1b2c3d
```

## First Time Setup on VPS

SSH to VPS and run:
```bash
ssh root@139.180.218.27

cd /root/bagisto

# First time: Initialize database
docker-compose -f docker-compose.production.yml exec bagisto php artisan migrate:fresh --seed

# Create admin user
docker-compose -f docker-compose.production.yml exec bagisto php artisan bagisto:install
```

## Useful Commands on VPS

### View Logs
```bash
# All logs
docker-compose -f docker-compose.production.yml logs -f

# Bagisto logs only
docker-compose -f docker-compose.production.yml logs -f bagisto

# Last 100 lines
docker-compose -f docker-compose.production.yml logs --tail=100 bagisto
```

### Restart Services
```bash
# Restart all
docker-compose -f docker-compose.production.yml restart

# Restart only Bagisto
docker-compose -f docker-compose.production.yml restart bagisto
```

### Check Status
```bash
docker-compose -f docker-compose.production.yml ps
```

### Run Artisan Commands
```bash
# Clear cache
docker-compose -f docker-compose.production.yml exec bagisto php artisan cache:clear

# Run migrations
docker-compose -f docker-compose.production.yml exec bagisto php artisan migrate --force

# Create admin
docker-compose -f docker-compose.production.yml exec bagisto php artisan bagisto:user:create
```

### Update to New Version
```bash
# Deploy script handles this automatically, or manually:
docker pull bao110304/bagisto:latest
docker-compose -f docker-compose.production.yml up -d
```

### Backup Database
```bash
# Backup
docker-compose -f docker-compose.production.yml exec mysql mysqldump -u bagisto_user -p bagisto > backup_$(date +%Y%m%d).sql

# Restore
docker-compose -f docker-compose.production.yml exec -T mysql mysql -u bagisto_user -p bagisto < backup_20241111.sql
```

## Troubleshooting

### Check Container Health
```bash
docker-compose -f docker-compose.production.yml ps
docker inspect bagisto-app
```

### Access Container Shell
```bash
docker-compose -f docker-compose.production.yml exec bagisto sh
```

### Check Nginx Logs
```bash
docker-compose -f docker-compose.production.yml exec bagisto cat /var/log/nginx/error.log
```

### Permissions Issues
```bash
docker-compose -f docker-compose.production.yml exec bagisto chown -R nginx:nginx /var/www/html/storage
docker-compose -f docker-compose.production.yml exec bagisto chmod -R 755 /var/www/html/storage
```

## Security Notes

⚠️ **Important**: Change these before production:
- `MYSQL_ROOT_PASSWORD` in docker-compose.production.yml
- `MYSQL_PASSWORD` in docker-compose.production.yml
- Generate `APP_KEY` using `php artisan key:generate`

## Access Application

Once deployed, access:
- **Application**: http://139.180.218.27
- **Admin Panel**: http://139.180.218.27/admin
  - Default credentials set during `bagisto:install`
