<?php
    //khai báo namespace
    namespace backend\controllers;

    //nạp vào product model
    use models\ProductModel;

    //nạp vào order model
    use models\OrderModel;

    //nạp vào view
    use core\View;

    //khai báo class OrderController cho admin quản lý đơn hàng
    class OrderController {
        protected $orderModel;

        protected $productModel;

        //hàm khởi tạo
        public function __construct()
        {
            $this->orderModel = new OrderModel();
            $this->productModel = new ProductModel();
        }

        //hàm hiển thị trang quản lý đơn hàng
        public function show_orders_page() {
            $orders = $this->orderModel->getAllOrders();

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");

            return View::render("AdminOrderViewList", ["orders" => $orders]);
        }

        //hàm hiển thị chi tiết đơn hàng
        public function show_order_detail() {
            $orderId = $_GET['id'];
            $order = $this->orderModel->getOrderById($orderId);

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");

            return View::render("AdminOrderViewDetail", ["order" => $order]);
        }

        //hàm cập nhật trạng thái đơn hàng
        public function update_order_status() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $orderId = $_POST['order_id'];
                $status = $_POST['status'];

                $this->orderModel->updateOrderStatus($orderId, $status);

                // Chuyển hướng về trang danh sách đơn hàng sau khi cập nhật
                header("Location: admin_orders");
                exit();
            }
        }
    }
?>