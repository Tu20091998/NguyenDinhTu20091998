<?php
    //tạo namespace
    namespace app\controller;

    //nạp vào composer
    require_once __DIR__."/../../vendor/autoload.php";

    //nạp vào usermodel
    use app\models\LoginModel;
    use app\core\View;

    //tạo class logincontroller
    class LoginController extends LoginModel
    {
        //khai báo biến user và password
        public $email;
        public $password;
        
        //tạo hàm hiển thị
        public function index() {
            //khai báo các biến liên quan 
            $message = "";
            $isLogin = false;
            $lastname = "";
            $firstname = "";

            //xét trả về thông báo
            if(isset($_GET["status_login"])){
                switch($_GET["status_login"]){
                    case "success": 
                        $message = "<div class='alert alert-success'>✅ Đăng nhập thành công!</div>";
                    break;

                    case "error_password": 
                        $message = "<div class='alert alert-danger'>❌ Mật khẩu không đúng!</div>";
                    break;

                    case "logout": 
                        $message = "<div class='alert alert-success'>✅ Đăng xuất thành công!</div>";
                    break;

                    case "form_empty": 
                        $message = "<div class='alert alert-danger'>❌ Vui lòng nhập đầy đủ thông tin!</div>";
                    break;

                    case "invalid_email": 
                        $message = "<div class='alert alert-danger'>❌ Email không hợp lệ!</div>";
                    break;

                    case "user_not_found": 
                        $message = "<div class='alert alert-danger'>❌ Người dùng không tồn tại!</div>";
                    break;
                }
            }

            //nếu đăng nhập thành công thì lấy phiên đăng nhập và thông tin
            if(isset($_SESSION["user"])){
                $isLogin = true;
                $firstname = $_SESSION["user"]["firstname"];
                $lastname  = $_SESSION["user"]["lastname"];
            }
            
            //trả về giao diện kèm các biến hiển thị
            return
                View::render("LoginView", [
                    "title" => "Trang đăng nhập",
                    "message"   => $message,
                    "isLogin"   => $isLogin,
                    "firstname" => $firstname,
                    "lastname"  => $lastname
                ]);
        }

        //hàm nhận dữ liệu đăng nhập
        public function loginUser()
        {
            //nhận dữ liệu từ form
            $email = $_POST['email'];
            $password = $_POST['password'];

            //xét nếu trống form
            if($this->emptyInput($email, $password) == true){
                header("Location: /Php2/lab8/mvc_simple/login?status_login=form_empty");
                exit();
            }

            //xét email hợp lệ
            if($this->validEmail($email) == false){
                header("Location: /Php2/lab8/mvc_simple/login?status_login=invalid_email");
                exit();
            }

            //gọi hàm kiểm tra đăng nhập
            $user = LoginModel::getUser($email);

            //kiểm tra xem người dùng có tồn tại không
            if(empty($user) || !$user){
                header("Location: /Php2/lab8/mvc_simple/login?status_login=user_not_found");
                exit();
            }

            //kiểm tra mật khẩu
            if(!password_verify($password, $user['password'])){
                header("Location: /Php2/lab8/mvc_simple/login?status_login=error_password");
                exit();
            }

            //nếu đúng thì khởi tạo session
            $_SESSION['user'] = $user;
            header("Location: /Php2/lab8/mvc_simple/login?status_login=success");
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
            header("Location: /Php2/lab8/mvc_simple/login?status_login=logout");
            exit();
        }
    }

?>