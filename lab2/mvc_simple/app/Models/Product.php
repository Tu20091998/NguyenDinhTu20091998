<?php
namespace App\Models;

use Core\Database;

class Product
{
    protected $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();

        echo "Đây là file product_models";
    }
}
