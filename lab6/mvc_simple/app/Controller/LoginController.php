<?php
    //tạo namespace
    namespace app\Controller;

    //nạp vào composer
    require_once __DIR__."/../../vendor/autoload.php";

    //nạp vào usermodel
    use app\Models\LoginModel;

    //tạo class logincontroller
    class LoginController
    {
        //khai báo biến user và password
        public $email;
        public $password;

        //khởi tạo đối tượng loginmodel
        public $loginModel;

        public function __construct() {
            $this->loginModel = new LoginModel();
        }

        //hàm nhận dữ liệu đăng nhập
        public function loginUser()
        {
            //nhận dữ liệu từ form
            $email = $_POST['email'];
            $password = $_POST['password'];

            //xét nếu trống form
            if($this->emptyInput($email, $password) == true){
                header("Location: /Php2/lab6/mvc_simple/login?status_login=form_empty");
                exit();
            }

            //xét email hợp lệ
            if($this->validEmail($email) == false){
                header("Location: /Php2/lab6/mvc_simple/login?status_login=invalid_email");
                exit();
            }

            //gọi hàm kiểm tra đăng nhập
            $user = $this->loginModel->getUser($email);

            //kiểm tra xem người dùng có tồn tại không
            if(empty($user) || !$user){
                header("Location: /Php2/lab6/mvc_simple/login?status_login=user_not_found");
                exit();
            }

            //kiểm tra mật khẩu
            if(!password_verify($password, $user['password'])){
                header("Location: /Php2/lab6/mvc_simple/login?status_login=error_password");
                exit();
            }

            //nếu đúng thì khởi tạo session
            $_SESSION['user'] = $user;
            header("Location: /Php2/lab6/mvc_simple/login?status_login=success");
            exit();
        }

        //tạo hàm xét nếu trống form
        public function emptyInput($email, $password): bool
        {
            return empty($email) || empty($password);
        }

        //tạo hàm xét email hợp lệ
        public function validEmail($email): bool
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        //hàm đăng xuất
        public function logout()
        {
            session_start();
            session_unset();
            session_destroy();
            header("Location: /Php2/lab6/mvc_simple/login?status_login=logout");
            exit();
        }
    }

?>