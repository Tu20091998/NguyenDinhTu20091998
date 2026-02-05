<?php
    //khai báo namespace
    namespace app\view;

    //khai báo sử dụng composer autoload
    require_once __DIR__ . "/../../vendor/autoload.php";

    //lấy lớp database
    use app\core\Database;

    //khai báo class login
    class Login
    {

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

        
    }
?>