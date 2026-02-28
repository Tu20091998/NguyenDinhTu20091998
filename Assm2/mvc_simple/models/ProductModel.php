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

        //lấy sản phẩm bán chạy nhất (giả sử dựa trên số lượng đã bán trong bảng order_items)
        public function getBestSellingProducts($limit = 8) {
            $sql = "SELECT p.*, c.name AS category_name, SUM(oi.quantity) AS total_sold 
                    FROM products p 
                    JOIN categories c ON p.category_id = c.id 
                    JOIN order_items oi ON p.id = oi.product_id 
                    GROUP BY p.id 
                    ORDER BY total_sold DESC 
                    LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Hàm lấy sản phẩm có phân trang (kết hợp cả danh mục và tìm kiếm)
        public function getProductsPaged($categoryId = null, $keyword = null, $offset = 0, $limit = 6) {
            $sql = "SELECT p.*, c.name AS category_name 
                    FROM products p 
                    JOIN categories c ON p.category_id = c.id 
                    WHERE 1=1";
            $params = [];

            if ($categoryId) {
                $sql .= " AND p.category_id = :cat_id";
                $params[':cat_id'] = $categoryId;
            }
            if ($keyword) {
                $sql .= " AND p.name LIKE :keyword";
                $params[':keyword'] = '%' . $keyword . '%';
            }

            // Thêm LIMIT và OFFSET để phân trang
            $sql .= " ORDER BY p.id DESC LIMIT :limit OFFSET :offset";
            
            $stmt = $this->conn->prepare($sql);
            
            // Ràng buộc giá trị tham số (Phải dùng bindValue cho limit/offset là số nguyên)
            foreach ($params as $key => $val) {
                $stmt->bindValue($key, $val);
            }
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Hàm đếm tổng số sản phẩm để tính toán tổng số trang
        public function countTotalProducts($categoryId = null, $keyword = null) {
            $sql = "SELECT COUNT(*) FROM products WHERE 1=1";
            $params = [];

            if ($categoryId) {
                $sql .= " AND category_id = :cat_id";
                $params[':cat_id'] = $categoryId;
            }
            if ($keyword) {
                $sql .= " AND name LIKE :keyword";
                $params[':keyword'] = '%' . $keyword . '%';
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        }
    }
?>