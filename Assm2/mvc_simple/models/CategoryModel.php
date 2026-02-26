<?php
    //khai báo namespace
    namespace models;

    //khai báo composer
    require_once __DIR__ . "/../vendor/autoload.php";

    //nạp vào kết nối database
    use core\Database;

    //nạp vào PDO
    use PDO;

    //khai báo class CategoryModel
    class CategoryModel {
        protected $conn;

        //hàm khởi tạo kết nối database
        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        //hàm lấy danh sách danh mục
        public function get_all_categories() {
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm lấy thông tin danh mục theo id
        public function getCategoryById($id) {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //hàm thêm mới danh mục vào database
        public function insert_category($name, $description = null) {
            $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':description' => $description
            ]);
        }

        //hàm cập nhật danh mục
        public function update_category($id, $name, $description = null) {
            $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':id' => $id
            ]);
        }

        //hàm xóa danh mục
        public function delete_category($id) {
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }
    }
?>