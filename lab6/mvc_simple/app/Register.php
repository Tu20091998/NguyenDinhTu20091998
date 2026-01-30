<?php
    //khai báo namespace và sử dụng các lớp cần thiết
    namespace app;

    //khai báo sử dụng composer autoload
    require_once __DIR__ . "/../vendor/autoload.php";

    //lấy lớp database
    use app\core\Database;

    //khai báo class register
    class Register
    {
        //khai báo biến liên quan đến đăng ký
        public $lastname;
        public $firstname;
        public $email;
        public $password;
        public $confirmPassword;

        //hàm hiển thị trang đăng ký
        public function index(): string
        {
            //khai báo biến thông báo
            $message = '';

            //kiểm tra các trạng thái từ URL
            if (isset($_GET['status_register'])) 
            {
                if ($_GET['status_register'] === 'success') {
                    $message = "<div class='alert alert-success'>✅ Đăng ký thành công!</div>";
                }
                else if ($_GET['status_register'] === 'error_password'){
                    $message = "<div class='alert alert-error'>❌ Mật khẩu xác thực không khớp!</div>";
                }
                else if($_GET['status_register'] === 'form_empty'){
                    $message = "<div class='alert alert-error'>❌ Vui lòng nhập đầy đủ thông tin!</div>";
                }
                else if($_GET['status_register'] === 'invalid_email'){
                    $message = "<div class='alert alert-error'>❌ Email không hợp lệ!</div>";
                }
                else if($_GET['status_register'] === 'email_exists'){
                    $message = "<div class='alert alert-error'>❌ Email đã tồn tại!</div>";
                }
                else if($_GET['status_register'] === 'error'){
                    $message = "<div class='alert alert-error'>❌ Đăng ký thất bại!</div>";
                }
            }


            //trả về giao diện đăng ký
            return '
            <!DOCTYPE html>
            <html lang="vi">
                <head>
                    <meta charset="UTF-8">
                    <title>Đăng ký tài khoản</title>
                    <link rel="stylesheet" href="public/css/register.css">
                </head>
                <body>
                <div class="container">
                    <h2>Đăng ký tài khoản</h2>
                    <p class="message">' . $message . '</p>
                    <form action="register" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Họ</label>
                                    <input type="text" class="form-control" name="lastname">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" name="firstname">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirmPassword">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">
                            Đăng ký
                        </button>
                    </form>
                </div>
            </body>
            </html>
            ';
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
                if($this->userExists($this->email) == true)
                {
                    header("Location: /Php2/lab6/mvc_simple/register?status_register=email_exists");
                    exit();
                }

                //nếu thoả mãn tất cả thì đăng ký người dùng
                $isRegistered = $this->insertUser($this->lastname, $this->firstname, $this->email, $this->password);

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

        //hàm đăng ký người dùng
        public function insertUser($lastname, $firstname, $email, $password){
            //mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            //kết nối database
            $db = new Database();
            $conn = $db->getConnection();

            //thêm người dùng vào database
            $sql = "INSERT INTO users (lastname, firstname, email, password) 
                    VALUES (:lastname, :firstname, :email, :password)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            //thực thi câu lệnh
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        //hàm kiểm tra người dùng đã tồn tại
        protected function userExists($email){

            //khởi tạo đối tượng database để lấy kết nối
            $db = new Database();
            $conn = $db->getConnection();

            //chuẩn bị câu lệnh SQL và thực thi
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            //nếu tìm thấy người dùng
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
?>