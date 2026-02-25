<?php
    //khai báo namespace
    namespace frontend\controllers;

    //nạp vào view
    use core\View;

    //nạp vào product model
    use models\ProductModel;

    //controller xử lý hiển thị trang chủ
    class HomeController{

        //hàm hiển thị trang chủ
        public function index() {
            // Chuyển hướng thư mục view sang frontend
            View::setBaseDir("frontend/views");

            $productModel = new ProductModel();
            $products = $productModel->get_all_products();

            return View::render("HomeView", [
                "title" => "Chào mừng đến với Shop Điện thoại!",
                "products" => $products
            ]);
        }
    }
?>