
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
        use frontend\controllers\UploadController;


        //sử dụng các lớp cần thiết của backend
        use backend\controllers\AdminController;
        
        use core\Route;

        //tạo đối tượng router
        $router = new Route();

        //đăng ký các route

        //hiển thị trang upload
        $router->get("/", [UploadController::class, "index"]);
        $router->get("/upload", [UploadController::class, "index"]);
        $router->post("/upload", [UploadController::class, "upload"]);


        //đăng ký các route liên quan đến đăng nhập
        $router->get("/login", [LoginController::class, "index"]);
        $router->post("/login", [LoginController::class, "loginUser"]);
        $router->get("/logout", [LoginController::class, "logout"]);

        //đăng ký các route liên quan đến đăng ký
        $router->get("/register", [RegisterController::class, "index"]);
        $router->post("/register", [RegisterController::class, "registerUser"]);


        //đăng ký route cho backend
        $router->get("/admin", [AdminController::class, "index"]);

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





