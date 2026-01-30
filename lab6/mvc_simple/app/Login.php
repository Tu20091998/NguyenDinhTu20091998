<?php
    //khai báo namespace
    namespace app;

    //kiểm tra nếu đã đăng nhập
    session_start();

    //khai báo sử dụng composer autoload
    require_once __DIR__ . "/../vendor/autoload.php";

    //lấy lớp database
    use app\core\Database;

    //khai báo class login
    class Login
    {
        //khai báo biến user và password
        public $email;
        public $password;

        //hàm hiển thị trang login
        public function index(): string
        {
            $message = '';

            //kiểm tra các trạng thái từ URL
            if (isset($_GET['status_login'])) {
                if ($_GET['status_login'] === 'success') {
                    $message = "<div class='alert alert-success'>✅ Đăng nhập thành công!</div>";
                } 
                else if ($_GET['status_login'] === 'error_password'){
                    $message = "<div class='alert alert-error'>❌ Mật khẩu không đúng!</div>";
                }
                else if($_GET['status_login'] === 'logout'){
                    $message = "<div class='alert alert-success'>✅ Đăng xuất thành công!</div>";
                }
                else if($_GET['status_login'] === 'form_empty'){
                    $message = "<div class='alert alert-error'>❌ Vui lòng nhập đầy đủ thông tin!</div>";
                }
                else if($_GET['status_login'] === 'invalid_email'){
                    $message = "<div class='alert alert-error'>❌ Email không hợp lệ!</div>";
                }
                else if($_GET['status_login'] === 'user_not_found'){
                    $message = "<div class='alert alert-error'>❌ Người dùng không tồn tại!</div>";
                }
            }

            if (isset($_SESSION['user'])) {
                $fname = $_SESSION['user']['firstname'];
                $lname = $_SESSION['user']['lastname'];

                return "
                <!DOCTYPE html>
                <html lang='vi'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Home</title>
                    <link rel='stylesheet' href='public/css/login.css'>
                </head>
                <body>
                    <div class='container'>
                        <h2>Trang chủ</h2>
                        <p class='message'>{$message}</p>
                        <p class='welcome'>
                            Xin chào <strong>{$lname} {$fname}</strong> |
                            <a href='logout'>Đăng xuất</a>
                        </p>
                    </div>
                </body>
                </html>
                ";
            }


            return "
            <!DOCTYPE html>
            <html lang='vi'>
            <head>
                <meta charset='UTF-8'>
                <title>Login</title>
                <link rel='stylesheet' href='public/css/login.css'>
            </head>
            <body>
                <div class='container'>
                    <h2>Trang đăng nhập</h2>

                    <p class='message'>{$message}</p>

                    <form action='login' method='post'>
                        <div class='form-group'>
                            <label>Email</label>
                            <input type='text' class='form-control' name='email'>
                        </div>

                        <div class='form-group'>
                            <label>Mật khẩu</label>
                            <input type='password' class='form-control' name='password'>
                        </div>

                        <button type='submit' name='submit' class='btn btn-primary'>
                            Submit
                        </button>
                    </form>
                </div>
            </body>
            </html>
            ";
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
            $user = $this->getUser($email);

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

        //hàm đăng xuất
        public function logout()
        {
            session_start();
            session_unset();
            session_destroy();
            header("Location: /Php2/lab6/mvc_simple/login?status_login=logout");
            exit();
        }

        //hàm lấy dữ liệu người dùng từ "database"
        protected function getUser($email)
        {
            //khởi tạo đối tượng database để lấy kết nối
            $db = new Database();
            $conn = $db->getConnection();

            //chuẩn bị câu lệnh SQL và thực thi
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            //nếu không tìm thây người dùng
            if ($stmt->rowCount() === 0) {
                $stmt = null;
                header("Location: /Php2/lab6/mvc_simple/login?status_login=user_not_found");
                exit();
            }

            //lấy kết quả
            return $stmt->fetch();
        }
    }
?>