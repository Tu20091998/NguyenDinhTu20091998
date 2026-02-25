<?php
namespace core;

use PDO;
use PDOException;

class Database
{
    protected $conn;

    public function __construct()
    {
        // Lấy thông tin từ file .env thông qua mảng $_ENV
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $db   = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Trả về mảng kết hợp mặc định
            ]);
        } catch (PDOException $e) {
            die("Lỗi kết nối Database: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}