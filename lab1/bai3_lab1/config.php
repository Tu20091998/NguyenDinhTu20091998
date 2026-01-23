<?php
    // Cấu hình thông số kết nối
    $host    = "localhost";
    $port    = "3307"; // Cổng bạn đang sử dụng
    $db      = "mvc_demo";
    $user    = "root";
    $pass    = "";
    $charset = "utf8mb4";

    // Tạo chuỗi DSN (Data Source Name)
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

    // Tùy chọn cấu hình PDO (Xử lý lỗi và chế độ lấy dữ liệu)
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        // Khởi tạo kết nối
        $connect = new PDO($dsn, $user, $pass, $options);

    } catch (PDOException $e) {
        // Nếu lỗi, dừng chương trình và thông báo
        die("❌ Lỗi kết nối CSDL: " . $e->getMessage());
    }
?>