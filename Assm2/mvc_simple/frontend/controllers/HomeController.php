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
            $products_seller = $productModel->getBestSellingProducts();

            return View::render("HomeView", [
                "title" => "Chào mừng bạn đến với PolyXShop !",
                "products_seller" => $products_seller,
            ]);
        }

        //hàm hiển thị trang liên hệ
        public function contact() {
            // Chuyển hướng thư mục view sang frontend
            View::setBaseDir("frontend/views");

            return View::render("ContactView", [
                "title" => "Liên hệ với chúng tôi"
            ]);
        }
    }
?>