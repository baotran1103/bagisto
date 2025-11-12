# Hướng dẫn Triển khai VPS# VPS Deployment Guide



## Yêu cầu Tiên quyết trên VPS (139.180.218.27)## Prerequisites on VPS (139.180.218.27)

```bash```bash

# 1. Tạo thư mục triển khai# 1. Create deployment directory

mkdir -p /root/bagistomkdir -p /root/bagisto

cd /root/bagistocd /root/bagisto



# 2. Tạo file .env (nếu cần cho cấu hình tùy chỉnh)# 2. Create .env file (if needed for custom config)

# docker-compose đã có các biến env cơ bản# The docker-compose already has basic env vars

``````



## Triển khai từ Máy Local## Deploy from Local Machine



### Phương án 1: Triển khai Build Mới nhất### Option 1: Deploy Latest Build

```bash```bash

./deploy-vps.sh./deploy-vps.sh

``````



### Phương án 2: Triển khai Build Tag Cụ thể### Option 2: Deploy Specific Build Tag

```bash```bash

./deploy-vps.sh 165-a1b2c3d./deploy-vps.sh 165-a1b2c3d

``````



## Thiết lập Lần đầu trên VPS## First Time Setup on VPS



SSH vào VPS và chạy:SSH to VPS and run:

```bash```bash

ssh root@139.180.218.27ssh root@139.180.218.27



cd /root/bagistocd /root/bagisto



# Lần đầu: Khởi tạo database# First time: Initialize database

docker-compose -f docker-compose.production.yml exec bagisto php artisan migrate:fresh --seeddocker-compose -f docker-compose.production.yml exec bagisto php artisan migrate:fresh --seed



# Tạo admin user# Create admin user

docker-compose -f docker-compose.production.yml exec bagisto php artisan bagisto:installdocker-compose -f docker-compose.production.yml exec bagisto php artisan bagisto:install

``````



## Các Lệnh Hữu ích trên VPS## Useful Commands on VPS



### Xem Logs### View Logs

```bash```bash

# Tất cả logs# All logs

docker-compose -f docker-compose.production.yml logs -fdocker-compose -f docker-compose.production.yml logs -f



# Chỉ Bagisto logs# Bagisto logs only

docker-compose -f docker-compose.production.yml logs -f bagistodocker-compose -f docker-compose.production.yml logs -f bagisto



# 100 dòng cuối# Last 100 lines

docker-compose -f docker-compose.production.yml logs --tail=100 bagistodocker-compose -f docker-compose.production.yml logs --tail=100 bagisto

``````



### Khởi động lại Services### Restart Services

```bash```bash

# Khởi động lại tất cả# Restart all

docker-compose -f docker-compose.production.yml restartdocker-compose -f docker-compose.production.yml restart



# Chỉ khởi động lại Bagisto# Restart only Bagisto

docker-compose -f docker-compose.production.yml restart bagistodocker-compose -f docker-compose.production.yml restart bagisto

``````



### Kiểm tra Trạng thái### Check Status

```bash```bash

docker-compose -f docker-compose.production.yml psdocker-compose -f docker-compose.production.yml ps

``````



### Chạy Lệnh Artisan### Run Artisan Commands

```bash```bash

# Xóa cache# Clear cache

docker-compose -f docker-compose.production.yml exec bagisto php artisan cache:cleardocker-compose -f docker-compose.production.yml exec bagisto php artisan cache:clear



# Chạy migrations# Run migrations

docker-compose -f docker-compose.production.yml exec bagisto php artisan migrate --forcedocker-compose -f docker-compose.production.yml exec bagisto php artisan migrate --force



# Tạo admin# Create admin

docker-compose -f docker-compose.production.yml exec bagisto php artisan bagisto:user:createdocker-compose -f docker-compose.production.yml exec bagisto php artisan bagisto:user:create

``````



### Cập nhật lên Phiên bản Mới### Update to New Version

```bash```bash

# Script deploy tự động xử lý, hoặc thủ công:# Deploy script handles this automatically, or manually:

docker pull bao110304/bagisto:latestdocker pull bao110304/bagisto:latest

docker-compose -f docker-compose.production.yml up -ddocker-compose -f docker-compose.production.yml up -d

``````



### Backup Database### Backup Database

```bash```bash

# Backup# Backup

docker-compose -f docker-compose.production.yml exec mysql mysqldump -u bagisto_user -p bagisto > backup_$(date +%Y%m%d).sqldocker-compose -f docker-compose.production.yml exec mysql mysqldump -u bagisto_user -p bagisto > backup_$(date +%Y%m%d).sql



# Restore# Restore

docker-compose -f docker-compose.production.yml exec -T mysql mysql -u bagisto_user -p bagisto < backup_20241111.sqldocker-compose -f docker-compose.production.yml exec -T mysql mysql -u bagisto_user -p bagisto < backup_20241111.sql

``````



## Khắc phục Sự cố## Troubleshooting



### Kiểm tra Tình trạng Container### Check Container Health

```bash```bash

docker-compose -f docker-compose.production.yml psdocker-compose -f docker-compose.production.yml ps

docker inspect bagisto-appdocker inspect bagisto-app

``````



### Truy cập Shell Container### Access Container Shell

```bash```bash

docker-compose -f docker-compose.production.yml exec bagisto shdocker-compose -f docker-compose.production.yml exec bagisto sh

``````



### Kiểm tra Nginx Logs### Check Nginx Logs

```bash```bash

docker-compose -f docker-compose.production.yml exec bagisto cat /var/log/nginx/error.logdocker-compose -f docker-compose.production.yml exec bagisto cat /var/log/nginx/error.log

``````



### Vấn đề Permissions### Permissions Issues

```bash```bash

docker-compose -f docker-compose.production.yml exec bagisto chown -R www-data:www-data /var/www/html/storagedocker-compose -f docker-compose.production.yml exec bagisto chown -R nginx:nginx /var/www/html/storage

docker-compose -f docker-compose.production.yml exec bagisto chmod -R 775 /var/www/html/storagedocker-compose -f docker-compose.production.yml exec bagisto chmod -R 755 /var/www/html/storage

``````



## Lưu ý Bảo mật## Security Notes



⚠️ **Quan trọng**: Thay đổi những thứ này trước khi production:⚠️ **Important**: Change these before production:

- `MYSQL_ROOT_PASSWORD` trong docker-compose.production.yml- `MYSQL_ROOT_PASSWORD` in docker-compose.production.yml

- `MYSQL_PASSWORD` trong docker-compose.production.yml- `MYSQL_PASSWORD` in docker-compose.production.yml

- Tạo `APP_KEY` sử dụng `php artisan key:generate`- Generate `APP_KEY` using `php artisan key:generate`



## Truy cập Ứng dụng## Access Application



Sau khi triển khai, truy cập:Once deployed, access:

- **Ứng dụng**: http://139.180.218.27- **Application**: http://139.180.218.27

- **Admin Panel**: http://139.180.218.27/admin- **Admin Panel**: http://139.180.218.27/admin

  - Thông tin đăng nhập mặc định được đặt trong quá trình `bagisto:install`  - Default credentials set during `bagisto:install`

