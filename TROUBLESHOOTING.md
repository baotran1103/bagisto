# Bagisto Docker Deployment Troubleshooting Guide

## Common Issues and Solutions

### ✅ SOLVED: HTTP 500 Error with Empty Response

**Symptoms:**
- Application returns HTTP 500 status
- Response body is empty (5-10 bytes)
- No Laravel error page shown
- Nginx access logs show "500 5" responses

**Root Cause:**
Laravel cannot write compiled Blade templates to `/var/www/html/storage/framework/views/` due to permission mismatch. PHP-FPM runs as `www-data` user but storage directory is owned by `nginx` user.

**Solution:**
```bash
# Fix permissions immediately
docker-compose exec bagisto chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
docker-compose exec bagisto chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Restart to apply
docker-compose restart bagisto
```

**Permanent Fix:**
The Dockerfile has been updated (commit `05b37b7d`) to:
1. Create `www-data` user (uid 82)
2. Add `nginx` to `www-data` group
3. Set proper ownership: `chown -R www-data:www-data /var/www/html`
4. Set proper permissions: `chmod -R 775 storage bootstrap/cache`

The deployment script now automatically fixes permissions after each deploy.

---

## Debugging Steps for 500 Errors

### 1. Enable PHP Error Display
```bash
docker-compose exec bagisto sh -c 'cat > /usr/local/etc/php/conf.d/99-custom.ini << EOF
display_errors = On
display_startup_errors = On
error_reporting = E_ALL
log_errors = On
EOF'

docker-compose restart bagisto
```

### 2. Enable PHP-FPM Worker Output Capture
```bash
# Edit PHP-FPM pool config
docker-compose exec bagisto sed -i 's/;catch_workers_output = yes/catch_workers_output = yes/' /usr/local/etc/php-fpm.d/www.conf

docker-compose restart bagisto
```

### 3. Check Container Logs
```bash
# View recent logs
docker-compose logs bagisto --tail=50

# Follow logs in real-time
docker-compose logs -f bagisto
```

### 4. Test PHP Execution
```bash
# Test basic PHP
docker-compose exec bagisto sh -c 'echo "<?php echo \"PHP Works!\"; ?>" > /var/www/html/public/test.php'
curl http://localhost/test.php

# Test autoload
docker-compose exec bagisto php -r 'require "/var/www/html/vendor/autoload.php"; echo "Autoload OK\n";'

# Test CLI execution
docker-compose exec bagisto php /var/www/html/public/index.php
```

### 5. Check File Permissions
```bash
# Check ownership
docker-compose exec bagisto ls -la /var/www/html/storage/framework/views/
docker-compose exec bagisto ls -la /var/www/html/bootstrap/cache/

# Check PHP-FPM user
docker-compose exec bagisto ps aux | grep php-fpm

# Check nginx user
docker-compose exec bagisto ps aux | grep nginx
```

### 6. Verify Configuration
```bash
# Check .env file
docker-compose exec bagisto cat /var/www/html/.env | grep -E '(APP_|DB_)'

# Test database connection
docker-compose exec bagisto php artisan tinker --execute='DB::connection()->getPdo(); echo "Database connected\n";'

# Check PHP extensions
docker-compose exec bagisto php -m
```

---

## Post-Deployment Checklist

After deploying to production, verify:

- [ ] HTTP 200 response: `curl -I http://YOUR_VPS_IP`
- [ ] Storage permissions: `ls -la /var/www/html/storage/`
- [ ] Database connection: `php artisan tinker --execute='DB::connection()->getPdo();'`
- [ ] Cache cleared: `php artisan optimize:clear`
- [ ] APP_KEY set: `grep APP_KEY .env` (should not be empty)
- [ ] APP_URL correct: `grep APP_URL .env` (should match your domain/IP)
- [ ] Container status: `docker-compose ps` (all should be "Up")

---

## Environment Configuration

### Production .env Template

See `deploy/.env.production.example` for a complete production configuration template.

**Critical Settings:**
```env
APP_ENV=production          # Use production mode
APP_DEBUG=false            # Disable debug in production
APP_URL=http://YOUR_IP     # Update with your actual IP/domain
DB_HOST=mysql              # Docker service name
REDIS_HOST=redis           # Docker service name
CACHE_STORE=redis          # Use Redis for caching
SESSION_DRIVER=redis       # Use Redis for sessions
```

### Generate APP_KEY
```bash
docker-compose exec bagisto php artisan key:generate --force
```

---

## Known Issues

### Broken Storage Symlink

**Symptom:** 
Symlink `/var/www/html/public/storage` points to wrong path (e.g., `/var/www/html/bagisto/storage/app/public` instead of `/var/www/html/storage/app/public`)

**Solution:**
```bash
docker-compose exec bagisto rm /var/www/html/public/storage
docker-compose exec bagisto ln -s /var/www/html/storage/app/public /var/www/html/public/storage
```

### Nginx "File not found" for .php Files

**Cause:** Incorrect `root` directive in nginx config or missing files.

**Check:**
```bash
# Verify nginx root
docker-compose exec bagisto grep "root" /etc/nginx/nginx.conf

# Should show: root /var/www/html/public;

# Verify index.php exists
docker-compose exec bagisto ls -la /var/www/html/public/index.php
```

### PHP-FPM Connection Refused

**Symptom:** Nginx logs show "connect() failed (111: Connection refused) while connecting to upstream"

**Solution:**
```bash
# Check if PHP-FPM is running
docker-compose exec bagisto ps aux | grep php-fpm

# Check listen address (should be 127.0.0.1:9000)
docker-compose exec bagisto grep "listen =" /usr/local/etc/php-fpm.d/www.conf

# Restart if needed
docker-compose restart bagisto
```

---

## Performance Optimization

### Cache Configuration
```bash
# Cache routes, config, and views
docker-compose exec bagisto php artisan optimize

# For production, always use:
docker-compose exec bagisto php artisan config:cache
docker-compose exec bagisto php artisan route:cache
docker-compose exec bagisto php artisan view:cache
```

### Database Optimization
```bash
# Run migrations with force flag
docker-compose exec bagisto php artisan migrate --force

# Seed sample data (if needed)
docker-compose exec bagisto php artisan db:seed --force
```

---

## Useful Commands

### Container Management
```bash
# View status
docker-compose ps

# View logs
docker-compose logs bagisto
docker-compose logs mysql
docker-compose logs redis

# Restart services
docker-compose restart bagisto
docker-compose restart mysql

# Stop all
docker-compose down

# Start with rebuild
docker-compose up -d --force-recreate
```

### Laravel Artisan
```bash
# Clear all caches
docker-compose exec bagisto php artisan optimize:clear

# Run migrations
docker-compose exec bagisto php artisan migrate --force

# Install Bagisto
docker-compose exec bagisto php artisan bagisto:install --force

# Enter tinker shell
docker-compose exec bagisto php artisan tinker
```

### Debugging
```bash
# SSH into container
docker-compose exec bagisto sh

# Check nginx error log
docker-compose exec bagisto tail -50 /var/log/nginx/error.log

# Check nginx access log  
docker-compose exec bagisto tail -50 /var/log/nginx/access.log

# Check PHP-FPM status
docker-compose exec bagisto php-fpm -t

# Test nginx config
docker-compose exec bagisto nginx -t
```

---

## Emergency Recovery

### Full Reset
If everything is broken:

```bash
# Stop all containers
docker-compose down

# Remove volumes (WARNING: Deletes all data)
docker volume rm bagisto_mysql_data bagisto_storage_data

# Pull latest image
docker pull bao110304/bagisto:latest

# Start fresh
docker-compose up -d

# Wait for MySQL to be ready
sleep 20

# Run setup
docker-compose exec bagisto php artisan migrate --force
docker-compose exec bagisto php artisan bagisto:install --force

# Fix permissions
docker-compose exec bagisto chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
docker-compose exec bagisto chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
```

### Backup Before Reset
```bash
# Backup database
docker-compose exec mysql mysqldump -u bagisto_user -p bagisto > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup storage
docker-compose exec bagisto tar -czf /tmp/storage_backup.tar.gz /var/www/html/storage
docker cp $(docker-compose ps -q bagisto):/tmp/storage_backup.tar.gz ./storage_backup_$(date +%Y%m%d_%H%M%S).tar.gz
```

---

## Resources

- **Bagisto Documentation:** https://devdocs.bagisto.com/
- **Laravel Documentation:** https://laravel.com/docs
- **Docker Documentation:** https://docs.docker.com/
- **Nginx Documentation:** https://nginx.org/en/docs/

---

**Last Updated:** 2025-11-12  
**Version:** 1.0.0  
**Resolved Issues:** HTTP 500 with empty response (storage permissions)
