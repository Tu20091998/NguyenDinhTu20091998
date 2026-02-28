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

            View::render("AdminOrderViewList", ["orders" => $orders]);
        }
    }
?>