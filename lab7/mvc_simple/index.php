<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Simple MVC Application</title>
    <link rel="stylesheet" href="public/css/layout.css">
</head>

<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="logo">SimpleMVC</div>
        <div class="nav-links">
            <a href="upload">Upload</a>
            <a href="login">Đăng nhập</a>
            <a href="register">Đăng ký</a>
        </div>
    </div>
</nav>

<hr>

<div class="content">
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
            $projectPath = '/Php2/lab7/mvc_simple';
            $relativeUri = str_replace($projectPath, '', $uri);

            echo $router->resolve($relativeUri ?: '/', $method);
        } catch (\Exception $e) {
            echo "Route '" . $_SERVER['REQUEST_URI'] . "' không tồn tại.";
        }
    ?>
</div>



<footer class="footer">
    <div class="footer-container">
        <p>© 2026 Simple MVC Application</p>
        <p>
            <a href="#">Giới thiệu</a> |
            <a href="#">Liên hệ</a> |
            <a href="#">Chính sách</a>
        </p>
    </div>
</footer>

</body>
</html>
