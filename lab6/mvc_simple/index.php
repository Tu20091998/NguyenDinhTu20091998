

<nav>
    <a href="upload">Upload</a> |
    <a href="login">Đăng nhập</a> |
    <a href="register">Đăng ký</a>
</nav>
<hr>

<?php
    //khai báo composer autoload
    require_once __DIR__ . "/vendor/autoload.php";

    //sử dụng các lớp cần thiết
    use app\core\Route;
    use app\Home;
    use app\Login;
    use app\Register;

    //tạo đối tượng router
    $router = new Route();

    //đăng ký các route

    //hiển thị trang upload
    $router->get("/upload", [Home::class, "index"]);
    $router->post("/upload", [Home::class, "upload"]);


    //đăng ký các route liên quan đến đăng nhập
    $router->get("/login", [Login::class, "index"]);
    $router->post("/login", [Login::class, "loginUser"]);
    $router->get("/logout", [Login::class, "logout"]);

    //đăng ký các route liên quan đến đăng ký
    $router->get("/register", [Register::class, "index"]);
    $router->post("/register", [Register::class, "registerUser"]);


    //xử lý route
    try {
        // Lấy URI và method thực tế từ hệ thống
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // Loại bỏ phần thư mục dự án để chỉ lấy phần route phía sau
        $projectPath = '/Php2/lab6/mvc_simple';
        $relativeUri = str_replace($projectPath, '', $uri);

        echo $router->resolve($relativeUri ?: '/', $method);
    } catch (\Exception $e) {
        echo "Route '" . $_SERVER['REQUEST_URI'] . "' không tồn tại.";
    }
?>

