<?php
    //khai báo composer autoload
    require_once __DIR__ . "/vendor/autoload.php";

    use app\Home;
    use app\Invoices;
    use app\core\Route;

    //tạo đối tượng router
    $router = new Route();

    // Đăng ký route dạng hàm
    $router->register('/', function() {
        echo "Chào mừng đến với trang chủ!";
    });

    // Khớp với /product/123 hoặc /product/abc
    $router->register('/product/{id}', function($id) {
        return "Bạn đang xem sản phẩm có ID là: " . $id;
    });

    // Khớp với /product/123 hoặc /product/abc
    $router->register('/users/duy-nguyen', function($id) {
        return "Bạn đang xem sản phẩm có ID là: " . $id;
    });

    // Đăng ký route dạng lớp và phương thức
    $router->register('/home', [Home::class, 'index']);
    $router->register('/invoices', [Invoices::class, 'index']);
    $router->register('/invoices/create', [Invoices::class, 'create']);
    
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