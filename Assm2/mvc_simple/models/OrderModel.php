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

        // Lấy đơn hàng theo ID người dùng
        public function getOrdersByUserId($userId) {
            // Lấy danh sách đơn hàng
            $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $orders;
        }

        public function getOrderById($orderId) {
            // Lấy thông tin chung của đơn hàng
            $sqlOrder = "SELECT * FROM orders WHERE id = :id";
            $stmtOrder = $this->conn->prepare($sqlOrder);
            $stmtOrder->execute([':id' => $orderId]);
            $order = $stmtOrder->fetch(PDO::FETCH_ASSOC);

            if ($order) {
                // JOIN với bảng products để lấy tên và ảnh máy
                $sqlItems = "SELECT oi.*, p.name, p.image 
                            FROM order_items oi
                            JOIN products p ON oi.product_id = p.id
                            WHERE oi.order_id = :order_id";
                $stmtItems = $this->conn->prepare($sqlItems);
                $stmtItems->execute([':order_id' => $orderId]);
                $order['items'] = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
            }

            return $order;
        }

        //hàm lấy tất cả đơn hàng để hiển thị cho admin
        public function getAllOrders() {
            $sql = "SELECT o.*, u.username 
                    FROM orders o
                    JOIN users u ON o.user_id = u.id
                    ORDER BY o.created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>