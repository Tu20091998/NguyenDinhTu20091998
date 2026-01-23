<?php
namespace Core;

use PDO;
use PDOException;

class Database
{
    protected $conn;

    public function __construct()
    {
        $dsn = "mysql:host=localhost;port=3307;dbname=mvc_demo;charset=utf8mb4";
        $user = "root";
        $pass = "";

        try {
            $this->conn = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            echo "✅ Kết nối CSDL thành công (PDO)<br>";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    //composer dump-autoload
}
