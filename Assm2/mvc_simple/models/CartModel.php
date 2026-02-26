<?php

    //khai báo namespace
    namespace models;

    //khai báo composer
    require_once __DIR__ . "/../vendor/autoload.php";

    //nạp vào kết nối database
    use core\Database;

    //nạp vào PDO
    use PDO;

    class CartModel {

        protected $conn;

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng của User chưa
        public function checkItemExist($userId, $productId) {
            $sql = "SELECT id, quantity FROM cart WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,
                ':product_id' => $productId
            ]);
            // Trả về bản ghi đầu tiên tìm thấy hoặc false nếu không có
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        // Cập nhật số lượng mới cho sản phẩm trong giỏ
        public function updateQuantity($cartId, $newQuantity) {
            $sql = "UPDATE cart SET quantity = :quantity WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':quantity' => $newQuantity,
                ':id' => $cartId
            ]);
        }

        // Thêm mới sản phẩm vào giỏ (nếu chưa tồn tại)
        public function addToCart($userId, $productId) {
            $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, 1)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':user_id' => $userId,
                ':product_id' => $productId
            ]);
        }

        // Lấy danh sách sản phẩm trong giỏ hàng của User
        public function getCartItemsByUserId($userId) {
            $sql = "SELECT c.id as cart_id, p.id as product_id, p.name, p.price, p.image, c.quantity 
                    FROM cart c 
                    JOIN products p ON c.product_id = p.id 
                    WHERE c.user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Xóa sản phẩm khỏi giỏ hàng
        public function removeFromCart($cartId) {
            $sql = "DELETE FROM cart WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':id' => $cartId]);
        }

        // Xóa toàn bộ giỏ hàng của User (sau khi đặt hàng thành công)
        public function clearCart($userId) {
            $sql = "DELETE FROM cart WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':user_id' => $userId]);
        }
    }
?>