<?php
    //khai báo composer autoload
    require_once __DIR__ . "/vendor/autoload.php";

    //sử dụng các lớp cần thiết
    use app\Home;
    use app\Invoices;
    use app\core\Route;
    use app\Controller\UserController;

    //tạo đối tượng router
    $router = new Route();

    // Khớp với /product/123 hoặc /product/abc
    $router->register('/product/{id}', function($id) {
        return "Bạn đang xem sản phẩm có ID là: " . $id;
    });

    // Đăng ký route dạng lớp và phương thức
    $router->register('/home', [Home::class, 'index']);
    $router->register('/invoices', [Invoices::class, 'index']);
    $router->register('/invoices/create', [Invoices::class, 'create']);

    //đăng ký route cho user controller
    $router->register('/getAllUsers', [UserController::class, 'getAllUsers']);
    $router->register('/register', [UserController::class, 'register_user_confirm']);

    try {
        // Lấy URI thực tế
        $uri = $_SERVER['REQUEST_URI'];

        // Loại bỏ phần thư mục dự án để chỉ lấy phần route phía sau
        $projectPath = '/Php2/lab4/mvc_simple';
        $relativeUri = str_replace($projectPath, '', $uri);

        echo $router->resolve($relativeUri ?: '/');
    } catch (\Exception $e) {
        echo "Route '" . $_SERVER['REQUEST_URI'] . "' không tồn tại.";
    }
?>