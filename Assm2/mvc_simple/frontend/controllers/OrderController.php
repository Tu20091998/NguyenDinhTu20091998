<?php
    //tạo namespace
    namespace frontend\controllers;

    //nạp vào composer
    require_once __DIR__."/../../vendor/autoload.php";

    //nạp vào view
    use core\View;

    //nạp vào ordermodel
    use models\OrderModel;

    //nạp vào cartmodel để lấy lại giỏ hàng khi hiển thị trang checkout
    use models\CartModel;

    //tạo class ordercontroller
    class OrderController{

        //khởi tạo đối tượng ordermodel
        public $orderModel;
        public $cartModel;

        public function __construct() {
            $this->orderModel = new OrderModel();
            $this->cartModel = new CartModel();
        }

        //hàm hiển thị trang checkout
        public function checkout() {
            // Lấy giỏ hàng hiện tại để hiển thị lại lần cuối
            $cartItems = $this->cartModel->getCartItemsByUserId($_SESSION['user']['id']);

            return View::render("CheckoutView", ["cartItems" => $cartItems]);
        }

        //hàm xử lý đặt hàng
        public function place_order() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userId = $_SESSION['user']['id'];
                $total = $_POST['total_amount'];
                $name = $_POST['full_name'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];

                // Lấy lại giỏ hàng để lưu vào chi tiết
                $cartModel = new CartModel();
                $cartItems = $cartModel->getCartItemsByUserId($userId);

                $orderModel = new OrderModel();
                $orderId = $orderModel->createOrder($userId, $total, $name, $phone, $address, $cartItems);

                if ($orderId) {
                    $cartModel->clearCart($userId); // Xóa giỏ hàng sau khi đặt thành công
                    header("Location: order_success?id=" . $orderId);
                }
            }
        }
        
        //hàm hiển thị trang đặt hàng thành công
        public function order_success() {
            // Lấy ID từ URL để hiển thị mã đơn hàng
            $orderId = $_GET['id'] ?? null;

            // Nếu không có ID đơn hàng, quay về trang chủ
            if (!$orderId) {
                header("Location: home");
                exit();
            }

            return View::render("OrderSuccessView", ["orderId" => $orderId]);
        }

        //hàm hiển thị trang quản lý đơn hàng cho người dùng
        public function orders() {
            $userId = $_SESSION['user']['id'];
            $orders = $this->orderModel->getOrdersByUserId($userId);

            return View::render("OrderListView", ["orders" => $orders]);
        }

        //hàm hiển thị trang chi tiết đơn hàng
        public function order_detail() {
            $orderId = $_GET['id'] ?? null;

            if (!$orderId) {
                header("Location: orders");
                exit();
            }

            $order = $this->orderModel->getOrderById($orderId);

            // Kiểm tra nếu đơn hàng không tồn tại hoặc không thuộc về người dùng hiện tại
            if (!$order || $order['user_id'] != $_SESSION['user']['id']) {
                header("Location: orders");
                exit();
            }

            return View::render("OrderDetailView", ["order" => $order]);
        }
    }
?>