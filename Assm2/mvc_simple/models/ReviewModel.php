<?php
    //khai báo namespace
    namespace models;

    //khai báo composer
    require_once __DIR__ . "/../vendor/autoload.php";

    //nạp vào kết nối database
    use core\Database;

    //nạp vào PDO
    use PDO;

    class ReviewModel {
        protected $conn;

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        //hàm thêm đánh giá mới vào database
        public function insert_review($data) {
            $sql = "INSERT INTO reviews (product_id, user_id, rating, comment) 
                    VALUES (:product_id, :user_id, :rating, :comment)";
            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':product_id' => $data['product_id'],
                ':user_id'    => $data['user_id'],
                ':rating'     => $data['rating'],
                ':comment'    => $data['comment']
            ]);
        }

        //hàm lấy đánh giá theo sản phẩm
        public function getReviewsByProduct($productId) {
            $sql = "SELECT r.*, u.firstname, u.lastname 
                    FROM reviews r 
                    JOIN users u ON r.user_id = u.id 
                    WHERE r.product_id = :product_id 
                    ORDER BY r.created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':product_id' => $productId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Tú nhớ dùng FETCH_ASSOC để khớp với $review['name'] nhé
        }

        //hàm thêm đánh giá mới vào database
        public function addReview($productId, $userId, $rating, $comment) {
            try {
                $sql = "INSERT INTO reviews (product_id, user_id, rating, comment) 
                        VALUES (:product_id, :user_id, :rating, :comment)";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([
                    ':product_id' => $productId,
                    ':user_id'    => $userId,
                    ':rating'     => $rating,
                    ':comment'    => $comment
                ]);
            } catch (\PDOException $e) {
                if ($e->getCode() == '23000') {
                    die("Lỗi: ID sản phẩm ($productId) hoặc ID người dùng ($userId) không tồn tại trong hệ thống!");
                }
                throw $e;
            }
        }
    }
?>