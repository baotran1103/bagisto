# Hướng dẫn Khắc phục Sự cố Triển khai Bagisto Docker````markdown

# Hướng dẫn Khắc phục Sự cố Triển khai Bagisto Docker

## Các Vấn đề Thường gặp và Giải pháp

## Các Vấn đề Thường gặp và Giải pháp

### ✅ ĐÃ GIẢI QUYẾT: Lỗi HTTP 500 với Response Rỗng

### ✅ ĐÃ GIẢI QUYẾT: Lỗi HTTP 500 với Response Rỗng

**Triệu chứng:**

- Ứng dụng trả về HTTP 500 status**Triệu chứng:**

- Response body rỗng (5-10 bytes)- Ứng dụng trả về HTTP 500 status

- Không hiển thị trang lỗi Laravel- Response body rỗng (5-10 bytes)

- Nginx access logs hiển thị responses "500 5"- Không hiển thị trang lỗi Laravel

- Nginx access logs hiển thị responses "500 5"

**Nguyên nhân gốc rễ:**

Laravel không thể ghi compiled Blade templates vào `/var/www/html/storage/framework/views/` do quyền không khớp. PHP-FPM chạy với user `www-data` nhưng thư mục storage thuộc sở hữu của user `nginx`.**Nguyên nhân gốc rễ:**

Laravel không thể ghi compiled Blade templates vào `/var/www/html/storage/framework/views/` do quyền không khớp. PHP-FPM chạy với user `www-data` nhưng thư mục storage thuộc sở hữu của user `nginx`.

**Giải pháp:**

```bash**Giải pháp:**

# Sửa quyền ngay lập tức```bash

docker-compose exec bagisto chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache# Sửa quyền ngay lập tức

docker-compose exec bagisto chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cachedocker-compose exec bagisto chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

docker-compose exec bagisto chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Khởi động lại để áp dụng

docker-compose restart bagisto# Khởi động lại để áp dụng

```docker-compose restart bagisto

```

**Sửa lỗi vĩnh viễn:**

Dockerfile đã được cập nhật (commit `05b37b7d`) để:**Sửa lỗi vĩnh viễn:**

1. Tạo user `www-data` (uid 82)Dockerfile đã được cập nhật (commit `05b37b7d`) để:

2. Thêm `nginx` vào group `www-data`1. Tạo user `www-data` (uid 82)

3. Đặt ownership đúng: `chown -R www-data:www-data /var/www/html`2. Thêm `nginx` vào group `www-data`

4. Đặt permissions đúng: `chmod -R 775 storage bootstrap/cache`3. Đặt ownership đúng: `chown -R www-data:www-data /var/www/html`

4. Đặt permissions đúng: `chmod -R 775 storage bootstrap/cache`

Script triển khai hiện tự động sửa permissions sau mỗi lần deploy.

Script triển khai hiện tự động sửa permissions sau mỗi lần deploy.

---

---

## Các Bước Debug cho Lỗi 500

## Các Bước Debug cho Lỗi 500

### 1. Bật Hiển thị Lỗi PHP

```bash### 1. Bật Hiển thị Lỗi PHP

docker-compose exec bagisto sh -c 'cat > /usr/local/etc/php/conf.d/99-custom.ini << EOF```bash

display_errors = Ondocker-compose exec bagisto sh -c 'cat > /usr/local/etc/php/conf.d/99-custom.ini << EOF

display_startup_errors = Ondisplay_errors = On

error_reporting = E_ALLdisplay_startup_errors = On

log_errors = Onerror_reporting = E_ALL

EOF'log_errors = On

EOF'

docker-compose restart bagisto

```docker-compose restart bagisto

```

### 2. Bật Capture Output từ PHP-FPM Worker

```bash### 2. Bật Capture Output từ PHP-FPM Worker

# Sửa config PHP-FPM pool```bash

docker-compose exec bagisto sed -i 's/;catch_workers_output = yes/catch_workers_output = yes/' /usr/local/etc/php-fpm.d/www.conf# Sửa config PHP-FPM pool

docker-compose exec bagisto sed -i 's/;catch_workers_output = yes/catch_workers_output = yes/' /usr/local/etc/php-fpm.d/www.conf

docker-compose restart bagisto

```docker-compose restart bagisto

```

### 3. Kiểm tra Container Logs

```bash### 3. Kiểm tra Container Logs

# Xem logs gần đây```bash

docker-compose logs bagisto --tail=50# Xem logs gần đây

docker-compose logs bagisto --tail=50

# Theo dõi logs real-time

docker-compose logs -f bagisto# Theo dõi logs real-time

```docker-compose logs -f bagisto

```

### 4. Test Thực thi PHP

```bash### 4. Test Thực thi PHP

# Test PHP cơ bản```bash

docker-compose exec bagisto sh -c 'echo "<?php echo \"PHP Works!\"; ?>" > /var/www/html/public/test.php'# Test PHP cơ bản

curl http://localhost/test.phpdocker-compose exec bagisto sh -c 'echo "<?php echo \"PHP Works!\"; ?>" > /var/www/html/public/test.php'

curl http://localhost/test.php

# Test autoload

docker-compose exec bagisto php -r 'require "/var/www/html/vendor/autoload.php"; echo "Autoload OK\n";'# Test autoload

docker-compose exec bagisto php -r 'require "/var/www/html/vendor/autoload.php"; echo "Autoload OK\n";'

# Test thực thi CLI

docker-compose exec bagisto php /var/www/html/public/index.php# Test thực thi CLI

```docker-compose exec bagisto php /var/www/html/public/index.php

```

### 5. Kiểm tra Quyền File

```bash### 5. Kiểm tra Quyền File

# Kiểm tra ownership```bash

docker-compose exec bagisto ls -la /var/www/html/storage/framework/views/# Kiểm tra ownership

docker-compose exec bagisto ls -la /var/www/html/bootstrap/cache/docker-compose exec bagisto ls -la /var/www/html/storage/framework/views/

docker-compose exec bagisto ls -la /var/www/html/bootstrap/cache/

# Kiểm tra PHP-FPM user

docker-compose exec bagisto ps aux | grep php-fpm# Kiểm tra PHP-FPM user

docker-compose exec bagisto ps aux | grep php-fpm

# Kiểm tra nginx user

docker-compose exec bagisto ps aux | grep nginx# Kiểm tra nginx user

```docker-compose exec bagisto ps aux | grep nginx

```

### 6. Xác minh Cấu hình

```bash### 6. Xác minh Cấu hình

# Kiểm tra file .env```bash

docker-compose exec bagisto cat /var/www/html/.env | grep -E '(APP_|DB_)'# Kiểm tra file .env

docker-compose exec bagisto cat /var/www/html/.env | grep -E '(APP_|DB_)'

# Test kết nối database

docker-compose exec bagisto php artisan tinker --execute='DB::connection()->getPdo(); echo "Database connected\n";'# Test kết nối database

docker-compose exec bagisto php artisan tinker --execute='DB::connection()->getPdo(); echo "Database connected\n";'

# Kiểm tra PHP extensions

docker-compose exec bagisto php -m# Kiểm tra PHP extensions

```docker-compose exec bagisto php -m

```

---

---

## Checklist Sau Triển khai

## Checklist Sau Triển khai

Sau khi triển khai lên production, xác minh:

Sau khi triển khai lên production, xác minh:

- [ ] HTTP 200 response: `curl -I http://YOUR_VPS_IP`

- [ ] Storage permissions: `ls -la /var/www/html/storage/`- [ ] HTTP 200 response: `curl -I http://YOUR_VPS_IP`

- [ ] Database connection: `php artisan tinker --execute='DB::connection()->getPdo();'`- [ ] Storage permissions: `ls -la /var/www/html/storage/`

- [ ] Cache đã clear: `php artisan optimize:clear`- [ ] Database connection: `php artisan tinker --execute='DB::connection()->getPdo();'`

- [ ] APP_KEY đã set: `grep APP_KEY .env` (không được rỗng)- [ ] Cache đã clear: `php artisan optimize:clear`

- [ ] APP_URL đúng: `grep APP_URL .env` (phải khớp với domain/IP của bạn)- [ ] APP_KEY đã set: `grep APP_KEY .env` (không được rỗng)

- [ ] Container status: `docker-compose ps` (tất cả phải "Up")- [ ] APP_URL đúng: `grep APP_URL .env` (phải khớp với domain/IP của bạn)

- [ ] Container status: `docker-compose ps` (tất cả phải "Up")

---

---

## Cấu hình Environment

## Cấu hình Environment

### Template .env Production

### Template .env Production

Xem `deploy/.env.production.example` để có template cấu hình production đầy đủ.

Xem `deploy/.env.production.example` để có template cấu hình production đầy đủ.

**Cài đặt Quan trọng:**

```env**Cài đặt Quan trọng:**

APP_ENV=production          # Sử dụng chế độ production```env

APP_DEBUG=false            # Tắt debug trong productionAPP_ENV=production          # Sử dụng chế độ production

APP_URL=http://YOUR_IP     # Cập nhật với IP/domain thực tế của bạnAPP_DEBUG=false            # Tắt debug trong production

DB_HOST=mysql              # Tên service DockerAPP_URL=http://YOUR_IP     # Cập nhật với IP/domain thực tế của bạn

REDIS_HOST=redis           # Tên service DockerDB_HOST=mysql              # Tên service Docker

CACHE_STORE=redis          # Sử dụng Redis cho cachingREDIS_HOST=redis           # Tên service Docker

SESSION_DRIVER=redis       # Sử dụng Redis cho sessionsCACHE_STORE=redis          # Sử dụng Redis cho caching

```SESSION_DRIVER=redis       # Sử dụng Redis cho sessions

```

### Tạo APP_KEY

```bash### Tạo APP_KEY

docker-compose exec bagisto php artisan key:generate --force```bash

```docker-compose exec bagisto php artisan key:generate --force

```

---

---

## Các Vấn đề Đã biết

## Các Vấn đề Đã biết

### Symlink Storage Bị lỗi

### Symlink Storage Bị lỗi

**Triệu chứng:** 

Symlink `/var/www/html/public/storage` trỏ tới path sai (ví dụ: `/var/www/html/bagisto/storage/app/public` thay vì `/var/www/html/storage/app/public`)**Triệu chứng:** 

Symlink `/var/www/html/public/storage` trỏ tới path sai (ví dụ: `/var/www/html/bagisto/storage/app/public` thay vì `/var/www/html/storage/app/public`)

**Giải pháp:**

```bash**Giải pháp:**

docker-compose exec bagisto rm /var/www/html/public/storage```bash

docker-compose exec bagisto ln -s /var/www/html/storage/app/public /var/www/html/public/storagedocker-compose exec bagisto rm /var/www/html/public/storage

```docker-compose exec bagisto ln -s /var/www/html/storage/app/public /var/www/html/public/storage

```

### Nginx "File not found" cho Files .php

### Nginx "File not found" cho Files .php

**Nguyên nhân:** Directive `root` không đúng trong nginx config hoặc thiếu files.

**Nguyên nhân:** Directive `root` không đúng trong nginx config hoặc thiếu files.

**Kiểm tra:**

```bash**Kiểm tra:**

# Xác minh nginx root```bash

docker-compose exec bagisto grep "root" /etc/nginx/nginx.conf# Xác minh nginx root

docker-compose exec bagisto grep "root" /etc/nginx/nginx.conf

# Nên hiển thị: root /var/www/html/public;

# Nên hiển thị: root /var/www/html/public;

# Xác minh index.php tồn tại

docker-compose exec bagisto ls -la /var/www/html/public/index.php# Xác minh index.php tồn tại

```docker-compose exec bagisto ls -la /var/www/html/public/index.php

```

### PHP-FPM Connection Refused

### PHP-FPM Connection Refused

**Triệu chứng:** Nginx logs hiển thị "connect() failed (111: Connection refused) while connecting to upstream"

**Triệu chứng:** Nginx logs hiển thị "connect() failed (111: Connection refused) while connecting to upstream"

**Giải pháp:**

```bash**Giải pháp:**

# Kiểm tra nếu PHP-FPM đang chạy```bash

docker-compose exec bagisto ps aux | grep php-fpm# Kiểm tra nếu PHP-FPM đang chạy

docker-compose exec bagisto ps aux | grep php-fpm

# Kiểm tra listen address (nên là 127.0.0.1:9000)

docker-compose exec bagisto grep "listen =" /usr/local/etc/php-fpm.d/www.conf# Kiểm tra listen address (nên là 127.0.0.1:9000)

docker-compose exec bagisto grep "listen =" /usr/local/etc/php-fpm.d/www.conf

# Khởi động lại nếu cần

docker-compose restart bagisto# Khởi động lại nếu cần

```docker-compose restart bagisto

```

---

---

## Tối ưu hóa Performance

## Tối ưu hóa Performance

### Cấu hình Cache

```bash### Cấu hình Cache

# Cache routes, config, và views```bash

docker-compose exec bagisto php artisan optimize# Cache routes, config, và views

docker-compose exec bagisto php artisan optimize

# Cho production, luôn sử dụng:

docker-compose exec bagisto php artisan config:cache# Cho production, luôn sử dụng:

docker-compose exec bagisto php artisan route:cachedocker-compose exec bagisto php artisan config:cache

docker-compose exec bagisto php artisan view:cachedocker-compose exec bagisto php artisan route:cache

```docker-compose exec bagisto php artisan view:cache

```

### Tối ưu hóa Database

```bash### Tối ưu hóa Database

# Chạy migrations với force flag```bash

docker-compose exec bagisto php artisan migrate --force# Chạy migrations với force flag

docker-compose exec bagisto php artisan migrate --force

# Seed dữ liệu mẫu (nếu cần)

docker-compose exec bagisto php artisan db:seed --force# Seed dữ liệu mẫu (nếu cần)

```docker-compose exec bagisto php artisan db:seed --force

```

---

---

## Các Lệnh Hữu ích

## Useful Commands

### Quản lý Container

```bash### Container Management

# Xem trạng thái```bash

docker-compose ps# View status

docker-compose ps

# Xem logs

docker-compose logs bagisto# View logs

docker-compose logs mysqldocker-compose logs bagisto

docker-compose logs redisdocker-compose logs mysql

docker-compose logs redis

# Khởi động lại services

docker-compose restart bagisto# Restart services

docker-compose restart mysqldocker-compose restart bagisto

docker-compose restart mysql

# Dừng tất cả

docker-compose down# Stop all

docker-compose down

# Khởi động với rebuild

docker-compose up -d --force-recreate# Start with rebuild

```docker-compose up -d --force-recreate

```

### Laravel Artisan

```bash### Laravel Artisan

# Xóa tất cả caches```bash

docker-compose exec bagisto php artisan optimize:clear# Clear all caches

docker-compose exec bagisto php artisan optimize:clear

# Chạy migrations

docker-compose exec bagisto php artisan migrate --force# Run migrations

docker-compose exec bagisto php artisan migrate --force

# Cài đặt Bagisto

docker-compose exec bagisto php artisan bagisto:install --force# Install Bagisto

docker-compose exec bagisto php artisan bagisto:install --force

# Vào tinker shell

docker-compose exec bagisto php artisan tinker# Enter tinker shell

```docker-compose exec bagisto php artisan tinker

```

### Debug

```bash### Debugging

# SSH vào container```bash

docker-compose exec bagisto sh# SSH into container

docker-compose exec bagisto sh

# Kiểm tra nginx error log

docker-compose exec bagisto tail -50 /var/log/nginx/error.log# Check nginx error log

docker-compose exec bagisto tail -50 /var/log/nginx/error.log

# Kiểm tra nginx access log  

docker-compose exec bagisto tail -50 /var/log/nginx/access.log# Check nginx access log  

docker-compose exec bagisto tail -50 /var/log/nginx/access.log

# Kiểm tra PHP-FPM status

docker-compose exec bagisto php-fpm -t# Check PHP-FPM status

docker-compose exec bagisto php-fpm -t

# Test nginx config

docker-compose exec bagisto nginx -t# Test nginx config

```docker-compose exec bagisto nginx -t

```

---

---

## Khôi phục Khẩn cấp

## Emergency Recovery

### Reset Hoàn toàn

Nếu mọi thứ bị hỏng:### Full Reset

If everything is broken:

```bash

# Dừng tất cả containers```bash

docker-compose down# Stop all containers

docker-compose down

# Xóa volumes (CẢNH BÁO: Xóa tất cả dữ liệu)

docker volume rm bagisto_mysql_data bagisto_storage_data# Remove volumes (WARNING: Deletes all data)

docker volume rm bagisto_mysql_data bagisto_storage_data

# Pull image mới nhất

docker pull bao110304/bagisto:latest# Pull latest image

docker pull bao110304/bagisto:latest

# Khởi động mới

docker-compose up -d# Start fresh

docker-compose up -d

# Chờ MySQL sẵn sàng

sleep 20# Wait for MySQL to be ready

sleep 20

# Chạy setup

docker-compose exec bagisto php artisan migrate --force# Run setup

docker-compose exec bagisto php artisan bagisto:install --forcedocker-compose exec bagisto php artisan migrate --force

docker-compose exec bagisto php artisan bagisto:install --force

# Sửa permissions

docker-compose exec bagisto chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache# Fix permissions

docker-compose exec bagisto chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cachedocker-compose exec bagisto chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

```docker-compose exec bagisto chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

```

### Backup Trước khi Reset

```bash### Backup Before Reset

# Backup database```bash

docker-compose exec mysql mysqldump -u bagisto_user -p bagisto > backup_$(date +%Y%m%d_%H%M%S).sql# Backup database

docker-compose exec mysql mysqldump -u bagisto_user -p bagisto > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup storage

docker-compose exec bagisto tar -czf /tmp/storage_backup.tar.gz /var/www/html/storage# Backup storage

docker cp $(docker-compose ps -q bagisto):/tmp/storage_backup.tar.gz ./storage_backup_$(date +%Y%m%d_%H%M%S).tar.gzdocker-compose exec bagisto tar -czf /tmp/storage_backup.tar.gz /var/www/html/storage

```docker cp $(docker-compose ps -q bagisto):/tmp/storage_backup.tar.gz ./storage_backup_$(date +%Y%m%d_%H%M%S).tar.gz

```

---

---

## Tài nguyên Tham khảo

## Resources

- **Tài liệu Bagisto:** https://devdocs.bagisto.com/

- **Tài liệu Laravel:** https://laravel.com/docs- **Bagisto Documentation:** https://devdocs.bagisto.com/

- **Tài liệu Docker:** https://docs.docker.com/- **Laravel Documentation:** https://laravel.com/docs

- **Tài liệu Nginx:** https://nginx.org/en/docs/- **Docker Documentation:** https://docs.docker.com/

- **Nginx Documentation:** https://nginx.org/en/docs/

---

---

**Cập nhật Lần cuối:** 2025-11-12  

**Phiên bản:** 1.0.0  **Last Updated:** 2025-11-12  

**Vấn đề Đã giải quyết:** HTTP 500 với response rỗng (quyền storage)**Version:** 1.0.0  

**Resolved Issues:** HTTP 500 with empty response (storage permissions)
