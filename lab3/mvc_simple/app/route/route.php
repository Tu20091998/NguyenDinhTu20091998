<?php
    //nạp vào composer
    require_once __DIR__ . "/../../vendor/autoload.php";

    //nạp vào usercontroller
    use app\Controller\UserController;
    $user = new UserController();

    //nhận action từ index.php
    $action = $_GET['action'] ?? "get_all_users";

    switch ($action) {
        case 'register_user_confirm':
            $user->register_user_confirm();
            break;

        case 'get_all_users':
            $user->getAllUsers();
            break;
        default:
            echo "Action không hợp lệ";
            break;
    }
?>