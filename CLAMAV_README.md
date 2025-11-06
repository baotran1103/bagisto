# ClamAV Antivirus Setup

ClamAV đã được tích hợp vào môi trường Docker để quét virus cho các dự án.

## Services

### 1. clamav (Daemon)
- **Port**: 3310
- **Purpose**: Chạy ClamAV daemon để quét real-time
- **Volumes**: 
  - `./.configs/data/clamav-data`: Lưu trữ virus definitions
  - `./workspace`: Mount Bagisto project (read-only)
  - `/Users/baotran/Documents/Rivercrane/training-management-system`: Mount Training project (read-only)

### 2. clamav-scan (On-demand)
- **Profile**: scan
- **Purpose**: Quét theo yêu cầu
- **Usage**: `docker-compose --profile scan run --rm clamav-scan clamscan [options] [path]`

## Cách sử dụng

### 1. Khởi động ClamAV
```bash
docker-compose up -d clamav
```

### 2. Quét virus tự động
```bash
./clamav-scan.sh
```

### 3. Quét thủ công
```bash
# Quét toàn bộ workspace
docker-compose --profile scan run --rm clamav-scan clamscan --recursive --infected /scan/workspace

# Quét training project
docker-compose --profile scan run --rm clamav-scan clamscan --recursive --infected /scan/training

# Quét file upload
docker-compose --profile scan run --rm clamav-scan clamscan --recursive --infected /scan/workspace/storage/app/public
```

### 4. Cập nhật virus definitions
```bash
docker-compose exec clamav freshclam
```

### 5. Kiểm tra trạng thái
```bash
# Kiểm tra daemon
docker-compose ps clamav

# Kiểm tra health
docker-compose exec clamav clamdcheck
```

## Tích hợp vào ứng dụng

### PHP Integration (Laravel)
Thêm vào `config/filesystems.php` hoặc middleware để quét file upload:

```php
// Trong FileUpload middleware hoặc controller
use Symfony\Component\Process\Process;

$process = new Process([
    'docker-compose', 'exec', 'clamav', 
    'clamdscan', '--fdpass', $filePath
]);

$process->run();

if (!$process->isSuccessful()) {
    // Virus found
    throw new Exception('File contains virus');
}
```

## Security Notes

- ClamAV chỉ detect viruses đã biết
- Luôn cập nhật virus definitions hàng tuần
- Combine với other security measures
- Monitor scan logs regularly
