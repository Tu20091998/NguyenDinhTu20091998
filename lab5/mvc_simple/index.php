<?php
    //khai báo composer autoload
    require_once __DIR__ . "/vendor/autoload.php";

    //sử dụng các lớp cần thiết
    use app\core\Route;
    use app\Home;
    use app\Login;
    use app\Controller\UserController;

    //tạo đối tượng router
    $router = new Route();

    //đăng ký các route
    $router->get("/", [Home::class, "index"]);
    $router->post("/upload", [Home::class, "upload"]);
    $router->get("/login", [Login::class, "index"]);
    $router->post("/login", [Login::class, "loginUser"]);
    $router->get("/logout", [Login::class, "logout"]);

    //đăng ký người dùng
    $router->get("/register", [UserController::class, "getAllUsers"]);
    $router->post("/register", [UserController::class, "register_user_confirm"]);

    try {
        // Lấy URI và method thực tế từ hệ thống
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // Loại bỏ phần thư mục dự án để chỉ lấy phần route phía sau
        $projectPath = '/Php2/lab5/mvc_simple';
        $relativeUri = str_replace($projectPath, '', $uri);

        echo $router->resolve($relativeUri ?: '/', $method);
    } catch (\Exception $e) {
        echo "Route '" . $_SERVER['REQUEST_URI'] . "' không tồn tại.";
    }
?>