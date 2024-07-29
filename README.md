# Hướng Dẫn Sử Dụng

## Yêu Cầu

- Đảm bảo rằng đã cài đặt [Composer](https://getcomposer.org/) và phiên bản PHP đúng phiên bản yêu cầu.

## Cài Đặt

### Bước 1: Tải và mở thư mục dự án trong VS Code

1. Clone repository về máy của bạn:
    ```sh
    git clone <URL của dự án>
    ```
2. Mở thư mục dự án trong [VS Code](https://code.visualstudio.com/).

### Bước 2: Cài Đặt XAMPP

1. Tải và cài đặt [XAMPP](https://www.apachefriends.org/index.html).
2. Mở XAMPP Control Panel và khởi động Apache và MySQL.

### Bước 3: Cài Đặt và Chạy Dự Án

1. Mở terminal trong VS Code.
2. Chạy lệnh sau để cài đặt các thư viện cần thiết:
    ```sh
    composer install
    ```
3. Tạo file `.env` từ file mẫu `.env.example` và cấu hình các thông số cần thiết (như database, mail, v.v.).
4. Chạy lệnh sau để tạo khóa ứng dụng:
    ```sh
    php artisan key:generate
    ```
5. Chạy lệnh sau để thực thi các migration và seed database:
    ```sh
    php artisan migrate --seed
    ```
6. Khởi động dự án bằng lệnh:
    ```sh
    php artisan serve
    ```

### Bước 4: Truy Cập Trang Web

- Truy cập [127.0.0.1:8000](http://127.0.0.1:8000) để truy cập trang mua bán.
- Truy cập [127.0.0.1:8000/admin/dashboard](http://127.0.0.1:8000/admin/dashboard) để truy cập trang quản trị.

## Ghi Chú

- Đảm bảo rằng các dịch vụ Apache và MySQL đang chạy trong XAMPP trước khi truy cập trang web.
- Nếu gặp bất kỳ lỗi nào, hãy kiểm tra lại các bước cài đặt và đảm bảo rằng các cấu hình trong file `.env` là chính xác.

