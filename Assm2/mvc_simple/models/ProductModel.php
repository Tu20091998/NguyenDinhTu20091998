<?php
    //khai báo namespace
    namespace models;

    //khai báo composer
    require_once __DIR__ . "/../vendor/autoload.php";

    //nạp vào kết nối database
    use core\Database;

    //nạp vào PDO
    use PDO;

    class ProductModel {
        protected $conn;

        //hàm khởi tạo kết nối database
        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        //hàm thêm sản phẩm mới vào database
        public function insert_product($data) {
            $sql = "INSERT INTO products (name, price, image, description) 
                    VALUES (:name, :price, :image, :description)";
            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':name'        => $data['name'],
                ':price'       => $data['price'],
                ':image'       => $data['image'],
                ':description' => $data['description']
            ]);
        }

        //hàm lấy danh sách sản phẩm
        public function get_all_products() {
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>