<?php
    //khai báo namespace
    namespace models;

    //khai báo composer
    require_once __DIR__ . "/../vendor/autoload.php";

    //nạp vào kết nối database
    use core\Database;

    //nạp vào PDO
    use PDO;

    // Model quản lý các chức năng liên quan đến admin
    class AdminModel {
        protected $conn;

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        //hàm lấy sản phẩm bán chạy nhất
        public function getBestSellingProducts($limit = 4) {
            $sql = "SELECT p.*, SUM(od.quantity) as total_sold 
                    FROM products p 
                    JOIN order_items od ON p.id = od.product_id 
                    GROUP BY p.id 
                    ORDER BY total_sold DESC 
                    LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm lấy khách hàng thân thiết nhất
        public function getTopCustomers($limit = 4) {
            $sql = "SELECT u.*, COUNT(o.id) as total_orders, SUM(o.total_amount) as total_spent 
                    FROM users u 
                    JOIN orders o ON u.id = o.user_id 
                    WHERE o.status = 'delivered'
                    GROUP BY u.id 
                    ORDER BY total_spent DESC 
                    LIMIT :limit";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm tính doanh thu tháng này
        public function getRevenue() {
            $sql = "SELECT SUM(total_amount) as revenue 
                    FROM orders
                    WHERE status = 'delivered'";
            $stmt = $this->conn->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC)['revenue'] ?? 0;
        }

        //hàm lấy đơn hàng cần xử lý
        public function getOrdersNeedProcess(){
            $sql = "SELECT * FROM orders
                    WHERE status = 'pending'";

            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>