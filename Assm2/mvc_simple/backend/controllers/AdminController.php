<?php
    namespace backend\controllers;

    use core\View;

    //nạp model admin
    use models\AdminModel;

    class AdminController{
        public function index() {
            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");

            // Khởi tạo model admin
            $adminModel = new AdminModel();

            // Lấy danh sách sản phẩm bán chạy
            $top_selling = $adminModel->getBestSellingProducts(5);

            // Lấy danh sách khách hàng thân thiết
            $top_customers = $adminModel->getTopCustomers(5);

            // Lấy doanh thu tháng này
            $revenue = $adminModel->getRevenue();

            //lấy đơn hàng cần xử lý
            $pending_orders = $adminModel->getOrdersNeedProcess();

            // Truyền dữ liệu vào view
            return View::render("DashboardView", [
                "title" => "Trang quản trị",
                "top_selling" => $top_selling,
                "top_customers" => $top_customers,
                "revenue" => $revenue,
                "revenue_change" => 0, // Tạm thời chưa có dữ liệu để tính
                "pending_orders" => $pending_orders
            ]);
        }
    }
?>