
    <?php
        //khởi tạo session
        session_start();

        //khai báo composer autoload
        require_once __DIR__ . "/vendor/autoload.php";

        // Khởi tạo Dotenv
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        //sử dụng các lớp cần thiết của frontend
        use frontend\controllers\LoginController;
        use frontend\controllers\RegisterController;
        use frontend\controllers\HomeController;
        use frontend\controllers\CartController;
        use frontend\controllers\OrderController;
        use frontend\controllers\ProductController as FrontendProductController;
        use frontend\controllers\UserController as FrontendUserController;
        use frontend\controllers\ContactController;


        //sử dụng các lớp cần thiết của backend
        use backend\controllers\AdminController;
        use backend\controllers\ProductController as BackendProductController;
        use backend\controllers\CategoryController;
        use backend\controllers\UserController as BackendUserController;
        
        use core\Route;

        //tạo đối tượng router
        $router = new Route();

        //--------------------------------------------------------------------------------------------
        //FRONTEND ROUTES

        //hiển thị trang chủ
        $router->get("/", [HomeController::class, "index"]);
        $router->get("/home", [HomeController::class, "index"]);
        $router->get("/contact", [HomeController::class, "contact"]);
        $router->post("/send_contact", [ContactController::class, "sendContact"]);

        //đăng ký route cho giỏ hàng
        $router->get("/cart", [CartController::class, "cart"]);
        $router->get("/add_to_cart", [CartController::class, "add_to_cart"]);
        $router->get("/remove_cart", [CartController::class, "remove_cart"]);

        //đăng ký các route liên quan đến đăng nhập
        $router->get("/login", [LoginController::class, "index"]);
        $router->post("/login", [LoginController::class, "loginUser"]);
        $router->get("/logout", [LoginController::class, "logout"]);

        //đăng ký các route liên quan đến đăng ký
        $router->get("/register", [RegisterController::class, "index"]);
        $router->post("/register", [RegisterController::class, "registerUser"]);

        //đăng ký route cho quản lý người dùng
        $router->get("/profile", [FrontendUserController::class, "profile"]);
        $router->post("/update_profile", [FrontendUserController::class, "update_profile"]);
        $router->post("/change_password", [FrontendUserController::class, "change_password"]);

        //đăng ký route cho đặt hàng
        $router->get("/checkout", [OrderController::class, "checkout"]);
        $router->post("/place_order", [OrderController::class, "place_order"]);
        $router->get("/order_success", [OrderController::class, "order_success"]);

        //đăng ký route cho hiển thị sản phẩm
        $router->get("/products", [FrontendProductController::class, "show_product_list"]);
        $router->get("/product_detail", [FrontendProductController::class, "product_detail"]);
        $router->post("/add_review", [FrontendProductController::class, "add_review"]);
        $router->get("/search", [FrontendProductController::class, "show_product_list"]);

        //đăng ký route cho quản lý đơn hàng
        $router->get("/orders", [OrderController::class, "orders"]);
        $router->get("/order_detail", [OrderController::class, "order_detail"]);

        //--------------------------------------------------------------------------------------------
        //BACKEND ROUTES

        //đăng ký route cho backend
        $router->get("/admin", [AdminController::class, "index"]);

        //đăng ký route cho quản lý sản phẩm
        $router->post("/add_product", [BackendProductController::class, "add_product"]);
        $router->get("/admin_products", [BackendProductController::class, "show_product_page"]);
        $router->get("/edit_product", [BackendProductController::class, "edit_product"]);
        $router->post("/update_product", [BackendProductController::class, "update_product"]);
        $router->get("/delete_product", [BackendProductController::class, "delete_product"]);

        //đăng ký route cho quản lý danh mục
        $router->get("/categories", [CategoryController::class, "show_category_page"]);
        $router->post("/add_category", [CategoryController::class, "add_category"]);
        $router->get("/edit_category", [CategoryController::class, "edit_category"]);
        $router->post("/update_category", [CategoryController::class, "update_category"]);
        $router->get("/delete_category", [CategoryController::class, "delete_category"]);

        //đăng ký route cho quản lý người dùng
        $router->get("/users", [BackendUserController::class, "show_user_page"]);
        $router->get("/toggle_user_status", [BackendUserController::class, "toggle_user_status"]);
        

        //xử lý route
        try {
            // Lấy URI và method thực tế từ hệ thống
            $uri = $_SERVER['REQUEST_URI'];
            $method = $_SERVER['REQUEST_METHOD'];

            // Loại bỏ phần thư mục dự án để chỉ lấy phần route phía sau
            $projectPath = '/Php2/Assm2/mvc_simple';
            $relativeUri = str_replace($projectPath, '', $uri);

            echo $router->resolve($relativeUri ?: '/', $method);
        } catch (\Exception $e) {
            echo "Route '" . $_SERVER['REQUEST_URI'] . "' không tồn tại......";
            echo "Lỗi: " . $e->getMessage();
            echo "<br>Tại file: " . $e->getFile() . " dòng " . $e->getLine();
        }
    ?>





