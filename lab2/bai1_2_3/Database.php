<?php
namespace Core;

use PDO;
use PDOException;

class Database
{
    protected $conn;

    public function __construct()
    {
        // Cấu hình thông số kết nối
        $host    = "localhost";
        $port    = "3307";
        $db      = "mvc_demo";
        $user    = "root";
        $pass    = "";
        $charset = "utf8mb4";

        // DSN
        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

        // Options
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->conn = new PDO($dsn, $user, $pass, $options);
            echo "✅ Kết nối CSDL thành công (PDO)<br>";
        } catch (PDOException $e) {
            die("❌ Lỗi kết nối CSDL: " . $e->getMessage());
        }
    }

    // Trả connection để Model dùng
    public function getConnection()
    {
        return $this->conn;
    }
}
