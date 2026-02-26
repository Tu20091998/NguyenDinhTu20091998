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
            $sql = "INSERT INTO products (name, price, image, description, category_id) 
                    VALUES (:name, :price, :image, :description, :category_id)";
            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':name'        => $data['name'],
                ':price'       => $data['price'],
                ':image'       => $data['image'],
                ':description' => $data['description'],
                ':category_id' => $data['category_id']
            ]);
        }

        //hàm lấy danh sách sản phẩm
        public function get_all_products() {
            $sql = "SELECT p.*, c.name AS category_name FROM products p JOIN categories c ON p.category_id = c.id";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm lấy thông tin sản phẩm theo id
        public function getProductById($id) {
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //hàm cập nhật sản phẩm
        public function update_product($data) {
            // Câu lệnh SQL cập nhật dữ liệu dựa trên ID
            $sql = "UPDATE products 
                    SET name = :name, 
                        price = :price, 
                        image = :image, 
                        description = :description,
                        category_id = :category_id
                        
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // Thực thi và truyền mảng dữ liệu vào
            return $stmt->execute([
                ':id'          => $data['id'],
                ':name'        => $data['name'],
                ':price'       => $data['price'],
                ':image'       => $data['image'],
                ':description' => $data['description'],
                ':category_id' => $data['category_id']
            ]);
        }

        //hàm xóa sản phẩm
        public function delete_product($id) {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }
    }
?>