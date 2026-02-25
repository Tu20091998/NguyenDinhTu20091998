<?php
    namespace backend\controllers;

    use core\View;

    class AdminController{
        public function index() {
            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");

            return View::render("DashboardView", ["title" => "Trang quản trị"]);
        }
    }
?>