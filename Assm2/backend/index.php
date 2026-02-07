
    <?php
        //khởi tạo session
        session_start();

        //khai báo composer autoload
        require_once __DIR__ . "/vendor/autoload.php";

        // Khởi tạo Dotenv
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        //sử dụng các lớp cần thiết
        use app\controller\LoginController;
        use app\controller\RegisterController;
        use app\controller\UploadController;
        use app\core\Route;

        //tạo đối tượng router
        $router = new Route();

        //đăng ký các route

        //hiển thị trang upload
        $router->get("/upload", [UploadController::class, "index"]);
        $router->post("/upload", [UploadController::class, "upload"]);


        //đăng ký các route liên quan đến đăng nhập
        $router->get("/login", [LoginController::class, "index"]);
        $router->post("/login", [LoginController::class, "loginUser"]);
        $router->get("/logout", [LoginController::class, "logout"]);

        //đăng ký các route liên quan đến đăng ký
        $router->get("/register", [RegisterController::class, "index"]);
        $router->post("/register", [RegisterController::class, "registerUser"]);


        //xử lý route
        try {
            // Lấy URI và method thực tế từ hệ thống
            $uri = $_SERVER['REQUEST_URI'];
            $method = $_SERVER['REQUEST_METHOD'];

            // Loại bỏ phần thư mục dự án để chỉ lấy phần route phía sau
            $projectPath = '/Php2/Assm2/backend';
            $relativeUri = str_replace($projectPath, '', $uri);

            echo $router->resolve($relativeUri ?: '/', $method);
        } catch (\Exception $e) {
            echo "Route '" . $_SERVER['REQUEST_URI'] . "' không tồn tại.";
        }
    ?>





