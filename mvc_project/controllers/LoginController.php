<?php
namespace controllers;

require_once __DIR__ . "/../core/Database.php";

use core\Database;

class LoginController
{
    //khai báo biến kết nối
    public $conn;

    //hàm hiển thị khởi tạo
    public function __construct()
    {
        $this->conn = new Database();
    }

    //hàm đăng nhập người dùng
    public function loginUser()
    {
        //nếu form không trống thì..
        if (!empty($_POST['email']) && !empty($_POST['password'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->conn->getUser($email);

            if ($user && password_verify($password,$user["password"])) {

                $_SESSION['user'] = [
                    'email' => $user['email'],
                    'role' => $user['role']
                ];

                //nếu không phải admin thì bắt đăng nhập lại
                if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
                    header("Location: login?status=not_admin_login");
                    exit;
                }

                header("Location: admin?status=login_success");
                exit;
            } else {
                header("Location: login?status=login_error");
                exit;
            }
        } else {
            header("Location: login?status=form_empty");
            exit;
        }
    }

    //hàm đăng xuất admin
    public function admin_logout(){
        session_destroy();
        header("Location: login?status=admin_logout");
    }

    //hàm hiển thị form đăng ký
    public function register_display(){
        //nạo vào trang đăng ký
        require_once __DIR__ . "/../views/RegisterView.php";
    }

    //hàm thực hiện đăng ký người dùng
    public function register_confirm(){

        //xét nếu form trống
        if(!empty($_POST["email"]) || !empty($_POST["password"])){
            //lấy thông tin nhận được từ form
            $email = $_POST["email"];
            $password = $_POST["password"];
            $password_confirm = $_POST["password_confirm"];
            
            //xét nếu mật khẩu xác nhận không trùng
            if($password != $password_confirm){
                header("Location: register_display?status=password_confirm_error");
            }

            //chạy hàm chèn
            if($this->conn->insertUser($email, $password)){
                header("Location: register_display?status=register_success");
                exit;
            }
            else{
                header("Location: register_display?status=register_error");
                exit;
            }
        }
        else{
            header("Location: register_display?status=form_empty");
            exit;
        }
    }

}