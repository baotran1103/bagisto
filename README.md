# Bagisto Dockerization````markdown

# Bagisto Dockerization

Mục đích chính của repository này là cung cấp workspace cùng với tất cả các dependencies cần thiết cho Bagisto. Trong repository này, chúng tôi bao gồm các dịch vụ sau:

Mục đích chính của repository này là cung cấp workspace cùng với tất cả các dependencies cần thiết cho Bagisto. Trong repository này, chúng tôi bao gồm các dịch vụ sau:

- PHP-FPM

- Nginx- PHP-FPM

- MySQL- Nginx

- Redis- MySQL

- PHPMyAdmin- Redis

- Elasticsearch- PHPMyAdmin

- Kibana- Elasticsearch

- Mailpit- Kibana

- **PostgreSQL** (cho SonarQube)- Mailpit

- **SonarQube** (Phân tích Chất lượng Code & Bảo mật)- **PostgreSQL** (cho SonarQube)

- **Prometheus + Grafana** (Giám sát & Metrics)- **SonarQube** (Phân tích Chất lượng Code & Bảo mật)

- **Loki + Promtail** (Tổng hợp Log)- **Prometheus + Grafana** (Giám sát & Metrics)

- **Loki + Promtail** (Tổng hợp Log)

## Phiên bản Bagisto được hỗ trợ

## Phiên bản Bagisto được hỗ trợ

Hiện tại, tất cả các dịch vụ này được bao gồm để đáp ứng dependencies cho phiên bản Bagisto sau:

Hiện tại, tất cả các dịch vụ này được bao gồm để đáp ứng dependencies cho phiên bản Bagisto sau:

**Phiên bản Bagisto:** v2.3.6 trở lên.

**Phiên bản Bagisto:** v2.3.6 trở lên.

Tuy nhiên, có thể có một số trường hợp cụ thể cần điều chỉnh. Chúng tôi khuyến nghị xem xét file `Dockerfile` hoặc `docker-compose.yml` để biết các thay đổi cần thiết.

Tuy nhiên, có thể có một số trường hợp cụ thể cần điều chỉnh. Chúng tôi khuyến nghị xem xét file `Dockerfile` hoặc `docker-compose.yml` để biết các thay đổi cần thiết.

> [!IMPORTANT]

> Nếu bạn đang sử dụng phiên bản master, có khả năng script setup hiện tại trong repository này được cấu hình cho **Bagisto dev-master**. Các file `.env` nằm trong thư mục `.configs` được căn chỉnh với phiên bản này. Nếu bạn dự định sửa đổi script hoặc chuyển đổi phiên bản Bagisto, vui lòng đảm bảo các thay đổi của bạn vẫn tương thích với phiên bản đã cập nhật.> [!IMPORTANT]

> Nếu bạn đang sử dụng phiên bản master, có khả năng script setup hiện tại trong repository này được cấu hình cho **Bagisto dev-master**. Các file `.env` nằm trong thư mục `.configs` được căn chỉnh với phiên bản này. Nếu bạn dự định sửa đổi script hoặc chuyển đổi phiên bản Bagisto, vui lòng đảm bảo các thay đổi của bạn vẫn tương thích với phiên bản đã cập nhật.

## Yêu cầu Hệ thống

## Yêu cầu Hệ thống

- Yêu cầu Hệ thống/Server của Bagisto được đề cập [tại đây](https://devdocs.bagisto.com/getting-started/before-you-start.html#system-requirements). Sử dụng Docker, các yêu cầu này sẽ được đáp ứng bởi các docker images của PHP-FPM & Nginx, và ứng dụng của chúng ta sẽ chạy trong kiến trúc đa tầng.

- Yêu cầu Hệ thống/Server của Bagisto được đề cập [tại đây](https://devdocs.bagisto.com/getting-started/before-you-start.html#system-requirements). Sử dụng Docker, các yêu cầu này sẽ được đáp ứng bởi các docker images của PHP-FPM & Nginx, và ứng dụng của chúng ta sẽ chạy trong kiến trúc đa tầng.

- Cài đặt phiên bản mới nhất của Docker và Docker Compose nếu chưa được cài đặt. Docker hỗ trợ Linux, MacOS và Windows. Nhấp vào [Docker](https://docs.docker.com/install/) và [Docker Compose](https://docs.docker.com/compose/install/) để tìm hướng dẫn cài đặt.

- Cài đặt phiên bản mới nhất của Docker và Docker Compose nếu chưa được cài đặt. Docker hỗ trợ Linux, MacOS và Windows. Nhấp vào [Docker](https://docs.docker.com/install/) và [Docker Compose](https://docs.docker.com/compose/install/) để tìm hướng dẫn cài đặt. 

## Cài đặt

## System Requirements

- Đây là một repository đơn giản không có cấu hình phức tạp. Chỉ cần cập nhật file `docker-compose.yml` nếu cần, và bạn đã sẵn sàng!

- System/Server requirements of Bagisto are mentioned [here](https://devdocs.bagisto.com/getting-started/before-you-start.html#system-requirements). Using Docker, these requirements will be fulfilled by docker images of PHP-FPM & Nginx, and our application will run in a multi-tier architecture.

- Điều chỉnh các services theo nhu cầu của bạn. Ví dụ, hầu hết người dùng Linux có UID là 1000. Nếu UID của bạn khác, hãy đảm bảo cập nhật theo máy chủ của bạn.

- Install latest version of Docker and Docker Compose if it is not already installed. Docker supports Linux, MacOS and Windows Operating System. Click [Docker](https://docs.docker.com/install/) and [Docker Compose](https://docs.docker.com/compose/install/) to find their installation guide.

  ```yml

  services:## Cài đặt

    php-fpm:

      build:- Đây là một repository đơn giản không có cấu hình phức tạp. Chỉ cần cập nhật file `docker-compose.yml` nếu cần, và bạn đã sẵn sàng!

        args:

          container_project_path: /var/www/html/- Điều chỉnh các services theo nhu cầu của bạn. Ví dụ, hầu hết người dùng Linux có UID là 1000. Nếu UID của bạn khác, hãy đảm bảo cập nhật theo máy chủ của bạn.

          uid: 1000 # thêm uid của bạn ở đây

          user: $USER  ```yml

        context: .  services:

        dockerfile: ./Dockerfile    php-fpm:

      image: php-fpm      build:

      ports:        args:

        - "5173:5173" # Cổng Vite dev server          container_project_path: /var/www/html/

      volumes:          uid: 1000 # thêm uid của bạn ở đây

        - ./workspace/:/var/www/html/          user: $USER

        context: .

    nginx:        dockerfile: ./Dockerfile

      image: nginx:latest      image: php-fpm

      ports:      ports:

        - "80:80" # điều chỉnh cổng của bạn ở đây nếu muốn thay đổi        - "5173:5173" # Cổng Vite dev server

      volumes:      volumes:

        - ./workspace/:/var/www/html/        - ./workspace/:/var/www/html/

        - ./.configs/nginx/nginx.conf:/etc/nginx/conf.d/default.conf

      depends_on:    nginx:

        - php-fpm      image: nginx:latest

  ```      ports:

        - "80:80" # điều chỉnh cổng của bạn ở đây nếu muốn thay đổi

- Trong repository này, trọng tâm ban đầu là đáp ứng tất cả các yêu cầu của dự án. Cho dù dự án của bạn là mới hay đã tồn tại, bạn có thể dễ dàng sao chép và dán nó vào thư mục workspace được chỉ định. Nếu bạn không chắc chắn bắt đầu từ đâu, một shell script đã được cung cấp để đơn giản hóa quá trình thiết lập cho bạn. Để cài đặt và thiết lập mọi thứ, chỉ cần chạy:      volumes:

        - ./workspace/:/var/www/html/

  ```sh        - ./.configs/nginx/nginx.conf:/etc/nginx/conf.d/default.conf

  sh setup.sh      depends_on:

  ```        - php-fpm

  ```

## Sau khi cài đặt

- Trong repository này, trọng tâm ban đầu là đáp ứng tất cả các yêu cầu của dự án. Cho dù dự án của bạn là mới hay đã tồn tại, bạn có thể dễ dàng sao chép và dán nó vào thư mục workspace được chỉ định. Nếu bạn không chắc chắn bắt đầu từ đâu, một shell script đã được cung cấp để đơn giản hóa quá trình thiết lập cho bạn. Để cài đặt và thiết lập mọi thứ, chỉ cần chạy:

- Để đăng nhập với quyền admin.

  ```sh

  ```text  sh setup.sh

  http(s)://your_server_endpoint/admin/login  ```



  Email: admin@example.com## Sau khi cài đặt

  Password: admin123

  ```- Để đăng nhập với quyền admin.



- Để đăng nhập với quyền customer. Bạn có thể đăng ký trực tiếp với quyền customer và sau đó đăng nhập.  ```text

  http(s)://your_server_endpoint/admin/login

  ```text

  http(s):/your_server_endpoint/customer/register  Email: admin@example.com

  ```  Password: admin123

  ```

## Phân tích Code với SonarQube

- Để đăng nhập với quyền customer. Bạn có thể đăng ký trực tiếp với quyền customer và sau đó đăng nhập.

- Để truy cập SonarQube cho phân tích chất lượng code:

  ```text

  ```text  http(s):/your_server_endpoint/customer/register

  http://localhost:9000  ```

  

  Thông tin đăng nhập mặc định:## Phân tích Code với SonarQube

  Username: admin

  Password: admin- Để truy cập SonarQube cho phân tích chất lượng code:

  ```

  ```text

- Chạy phân tích code:  http://localhost:9000

  

  ```sh  Thông tin đăng nhập mặc định:

  # Làm cho script có thể thực thi  Username: admin

  chmod +x sonarqube-scan.sh  Password: admin

    ```

  # Chạy phân tích

  ./sonarqube-scan.sh- Chạy phân tích code:

  ```

  ```sh

- Để biết thêm chi tiết về thiết lập và sử dụng SonarQube, xem [SONARQUBE_GUIDE.md](./SONARQUBE_GUIDE.md)  # Làm cho script có thể thực thi

  chmod +x sonarqube-scan.sh

## Giám sát & Observability  

  # Chạy phân tích

- **Grafana Dashboard**: http://localhost:3000 (admin/admin)  ./sonarqube-scan.sh

- **Prometheus**: http://localhost:9090  ```

- **PHPMyAdmin**: http://localhost:8080

- **Mailpit**: http://localhost:8025- Để biết thêm chi tiết về thiết lập và sử dụng SonarQube, xem [SONARQUBE_GUIDE.md](./SONARQUBE_GUIDE.md)



## Triển khai Production## Giám sát & Observability



Repository này bao gồm cấu hình Docker sẵn sàng cho production và CI/CD pipelines:- **Grafana Dashboard**: http://localhost:3000 (admin/admin)

- **Prometheus**: http://localhost:9090

- **Jenkins Pipeline**: Builds tự động với security scans (Trivy, NPM audit) và quality gates- **PHPMyAdmin**: http://localhost:8080

- **Production Dockerfile**: Multi-stage build được tối ưu hóa cho production với PHP 8.3 FPM + Nginx- **Mailpit**: http://localhost:8025

- **VPS Deployment**: Script triển khai tự động cho VPS servers

- **Environment Templates**: Templates cấu hình `.env` cho production## Triển khai Production



### Triển khai nhanh lên VPSRepository này bao gồm cấu hình Docker sẵn sàng cho production và CI/CD pipelines:



```sh- **Jenkins Pipeline**: Builds tự động với security scans (Trivy, NPM audit) và quality gates

# Triển khai phiên bản mới nhất- **Production Dockerfile**: Multi-stage build được tối ưu hóa cho production với PHP 8.3 FPM + Nginx

./deploy-vps.sh- **VPS Deployment**: Script triển khai tự động cho VPS servers

- **Environment Templates**: Templates cấu hình `.env` cho production

# Triển khai phiên bản cụ thể

./deploy-vps.sh 165-a1b2c3d### Triển khai nhanh lên VPS

```

```sh

Để biết hướng dẫn triển khai chi tiết, xem:# Triển khai phiên bản mới nhất

- [DEPLOYMENT.md](./DEPLOYMENT.md) - Hướng dẫn triển khai đầy đủ./deploy-vps.sh

- [TROUBLESHOOTING.md](./TROUBLESHOOTING.md) - Các vấn đề thường gặp và giải pháp

- [VPS_DEPLOYMENT.md](./VPS_DEPLOYMENT.md) - Thiết lập cụ thể cho VPS# Triển khai phiên bản cụ thể

./deploy-vps.sh 165-a1b2c3d

## Bạn đã là Docker Expert?```



- Bạn có thể sử dụng repository này như workspace của bạn. Để build container, chỉ cần chạy lệnh sau:Để biết hướng dẫn triển khai chi tiết, xem:

- [DEPLOYMENT.md](./DEPLOYMENT.md) - Hướng dẫn triển khai đầy đủ

  ```sh- [TROUBLESHOOTING.md](./TROUBLESHOOTING.md) - Các vấn đề thường gặp và giải pháp

  docker-compose build- [VPS_DEPLOYMENT.md](./VPS_DEPLOYMENT.md) - Thiết lập cụ thể cho VPS

  ```

## Bạn đã là Docker Expert?

- Sau khi build, bạn có thể chạy container với:

- Bạn có thể sử dụng repository này như workspace của bạn. Để build container, chỉ cần chạy lệnh sau:

  ```sh

  docker-compose up -d  ```sh

  ```  docker-compose build

  ```

- Bây giờ, bạn có thể truy cập shell của container và cài đặt [Bagisto](https://github.com/bagisto/bagisto).

- Sau khi build, bạn có thể chạy container với:

Trong trường hợp có bất kỳ vấn đề hoặc thắc mắc nào, hãy tạo ticket tại [Webkul Support](https://webkul.uvdesk.com/en/customer/create-ticket/).

  ```sh
  docker-compose up -d
  ```

- Bây giờ, bạn có thể truy cập shell của container và cài đặt [Bagisto](https://github.com/bagisto/bagisto).

Trong trường hợp có bất kỳ vấn đề hoặc thắc mắc nào, hãy tạo ticket tại [Webkul Support](https://webkul.uvdesk.com/en/customer/create-ticket/).
# bagisto

````