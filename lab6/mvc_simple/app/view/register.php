<?php
    //khai báo namespace và sử dụng các lớp cần thiết
    namespace app\view;

    //khai báo sử dụng composer autoload
    require_once __DIR__ . "/../../vendor/autoload.php";

    //lấy lớp database
    use app\Models\RegisterModel;

    //khai báo class register
    class Register
    {
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
    }
?>