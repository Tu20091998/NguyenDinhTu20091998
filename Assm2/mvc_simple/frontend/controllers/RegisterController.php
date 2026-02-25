<?php
    //tạo namespace
    namespace frontend\controllers;

    //nạp vào composer
    require_once __DIR__."/../../vendor/autoload.php";

    //nạp vào usermodel
    use models\RegisterModel;
    use core\View;

    //tạo class usercontroller
    class RegisterController
    {
        //khai báo biến liên quan đến đăng ký
        public $lastname;
        public $firstname;
        public $email;
        public $password;
        public $confirmPassword;

        public $registerModel;

        public function __construct() {
            $this->registerModel = new RegisterModel();
        }

        //khai báo hàm hiển thị giao diện
        public function index() {
            //khai báo các biến hiển thị
            $message = "";

            //xét trả về thông báo đăng ký
            if(isset($_GET["status_register"])){
                switch($_GET["status_register"]){
                    case "success": 
                        $message = "<div class='alert alert-success'>✅ Đăng ký thành công!</div>";
                    break;

                    case "error_password": 
                        $message = "<div class='alert alert-danger'>❌ Mật khẩu xác thực không khớp!</div>";
                    break;

                    case "form_empty": 
                        $message = "<div class='alert alert-danger'>❌ Vui lòng nhập đầy đủ thông tin!</div>";
                    break;

                    case "invalid_email": 
                        $message = "<div class='alert alert-danger'>❌ Email không hợp lệ!</div>";
                    break;

                    case "email_exists": 
                        $message = "<div class='alert alert-danger'>❌ Email đã tồn tại !</div>";
                    break;

                    case "error": 
                        $message = "<div class='alert alert-danger'>❌ Đăng ký thất bại !</div>";
                    break;
                }
            }

            return View::render("RegisterView",[
                "message" => $message
            ]);
        }

        //hàm xử lý đăng ký người dùng
        public function registerUser(){
            //xét nút nhấn đăng ký
            if(isset($_POST["submit"]))
            {
                $this->lastname = $_POST["lastname"];
                $this->firstname = $_POST["firstname"];
                $this->email = $_POST["email"];
                $this->password = $_POST["password"];
                $this->confirmPassword = $_POST["confirmPassword"];


                //xét nếu trống form
                if($this->emptyInput($this->lastname, $this->firstname, $this->email, $this->password, $this->confirmPassword) == true)
                {
                    header("Location: /Php2/Assm2/mvc_simple/register?status_register=form_empty");
                    exit();
                }

                //xét email hợp lệ
                if($this->validEmail($this->email) == false)
                {
                    header("Location: /Php2/Assm2/mvc_simple/register?status_register=invalid_email");
                    exit();
                }

                //xét mật khẩu xác thực
                if($this->matchPassword($this->password, $this->confirmPassword) == false)
                {
                    header("Location: /Php2/Assm2/mvc_simple/register?status_register=error_password");
                    exit();
                }

                //xét nếu email đã tồn tại
                if($this->registerModel->userExists($this->email) == true)
                {
                    header("Location: /Php2/Assm2/mvc_simple/register?status_register=email_exists");
                    exit();
                }

                //nếu thoả mãn tất cả thì đăng ký người dùng
                $isRegistered = $this->registerModel->insertUser($this->lastname, $this->firstname, $this->email, $this->password);

                //nếu đăng ký thành công
                if($isRegistered){
                    header("Location: /Php2/Assm2/mvc_simple/register?status_register=success");
                    exit();
                }
                else{
                    header("Location: /Php2/Assm2/mvc_simple/register?status_register=error");
                    exit();
                }
            }
        }

        //tạo hàm xét nếu trống form
        public function emptyInput($lastname, $firstname, $email, $password, $confirmPassword): bool
        {
            return empty($lastname) || empty($firstname) || empty($email) || empty($password) || empty($confirmPassword);
        }

        //tạo hàm xét email hợp lệ
        public function validEmail($email): bool{
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        //tạo hàm xét mật khẩu xác thực
        public function matchPassword($password, $confirmPassword): bool{
            return $password === $confirmPassword;
        }
    }
?>