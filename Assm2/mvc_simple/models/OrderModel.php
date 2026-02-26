<?php
    //khai báo namespace
    namespace models;

    //khai báo composer
    require_once __DIR__ . "/../vendor/autoload.php";

    //nạp vào kết nối database
    use core\Database;

    //nạp vào PDO
    use PDOException;

    use PDO;

    class OrderModel {
        protected $conn;

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        // Lấy danh sách đơn hàng của User
        public function getOrdersByUserId($userId) {
            $sql = "SELECT o.id as order_id, o.created_at, o.total_amount, o.status, 
                    GROUP_CONCAT(p.name SEPARATOR ', ') as product_names
                    FROM orders o
                    JOIN order_items oi ON o.id = oi.order_id
                    JOIN products p ON oi.product_id = p.id
                    WHERE o.user_id = :user_id
                    GROUP BY o.id
                    ORDER BY o.created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //Tạo đơn hàng mới
        public function createOrder($userId, $totalAmount, $fullName, $phone, $address, $cartItems) {
            try {
                $this->conn->beginTransaction();

                // Lưu vào bảng orders
                $sqlOrder = "INSERT INTO orders (user_id, total_amount, full_name, phone, address) 
                            VALUES (:user_id, :total, :name, :phone, :address)";
                $stmtOrder = $this->conn->prepare($sqlOrder);
                $stmtOrder->execute([
                    ':user_id' => $userId,
                    ':total'   => $totalAmount,
                    ':name'    => $fullName,
                    ':phone'   => $phone,
                    ':address' => $address
                ]);

                $orderId = $this->conn->lastInsertId();

                // Lưu chi tiết vào order_items
                $sqlItem = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                            VALUES (:order_id, :product_id, :quantity, :price)";
                $stmtItem = $this->conn->prepare($sqlItem);

                foreach ($cartItems as $item) {
                    $stmtItem->execute([
                        ':order_id'   => $orderId,
                        ':product_id' => $item['product_id'],
                        ':quantity'   => $item['quantity'],
                        ':price'      => $item['price']
                    ]);
                }

                $this->conn->commit();
                return $orderId;
            } catch (PDOException $e) {
                $this->conn->rollBack();
                return false;
            }
        }
    }
?>