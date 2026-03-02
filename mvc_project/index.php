<?php
    //bắt session
    session_start();

    //nạp controllers
    require_once __DIR__ . "/controllers/LoginController.php";
    require_once __DIR__ . "/controllers/AdminController.php";

    //sử dụng class
    use controllers\LoginController;
    use controllers\AdminController;

    //đường dẫn gốc
    $basePath = '/Php2/mvc_project';
    $uri = str_replace($basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $uri = rtrim($uri, '/');

    //xét đường dẫn trả về
    switch ($uri) {

        case '/login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new LoginController();
                $controller->loginUser();
            } else {
                require_once __DIR__ . "/views/LoginView.php";
            }
        break;

        case '/admin':
            $controller = new AdminController();
            $controller->index();
        break;

        case '/add-product':
            $controller = new AdminController();
            $controller->addProduct();
        break;

        case '/logout':
            $controller = new LoginController();
            $controller->admin_logout();
        break;

        case "/delete_product":
            $controller = new AdminController();
            $controller->delete_product();
        break;

        case "/edit_product":
            $controller = new AdminController();
            $controller->edit_product();
        break;

        case "/update_product":
            $controller = new AdminController();
            $controller->update_product();
        break;

        case "/register_display":
            $controller = new LoginController();
            $controller->register_display();
        break;

        case "/register_confirm":
            $controller = new LoginController();
            $controller->register_confirm();
        break;

        case '':
            require_once __DIR__ . "/views/LoginView.php";
        break;

        default:
            echo "404 Not Found";
    }