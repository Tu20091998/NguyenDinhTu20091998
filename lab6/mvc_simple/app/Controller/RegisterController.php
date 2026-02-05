<?php
    //tạo namespace
    namespace app\Controller;

    //nạp vào composer
    require_once __DIR__."/../../vendor/autoload.php";

    //nạp vào usermodel
    use app\Models\RegisterModel;

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
                    header("Location: /Php2/lab6/mvc_simple/register?status_register=form_empty");
                    exit();
                }

                //xét email hợp lệ
                if($this->validEmail($this->email) == false)
                {
                    header("Location: /Php2/lab6/mvc_simple/register?status_register=invalid_email");
                    exit();
                }

                //xét mật khẩu xác thực
                if($this->matchPassword($this->password, $this->confirmPassword) == false)
                {
                    header("Location: /Php2/lab6/mvc_simple/register?status_register=error_password");
                    exit();
                }

                //xét nếu email đã tồn tại
                if($this->registerModel->userExists($this->email) == true)
                {
                    header("Location: /Php2/lab6/mvc_simple/register?status_register=email_exists");
                    exit();
                }

                //nếu thoả mãn tất cả thì đăng ký người dùng
                $isRegistered = $this->registerModel->insertUser($this->lastname, $this->firstname, $this->email, $this->password);

                //nếu đăng ký thành công
                if($isRegistered){
                    header("Location: /Php2/lab6/mvc_simple/register?status_register=success");
                    exit();
                }
                else{
                    header("Location: /Php2/lab6/mvc_simple/register?status_register=error");
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