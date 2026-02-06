
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

            <!--Hiển thị thông báo-->
            <p class="message"><?= $message ?></p>

            <!--Form đăng ký-->
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
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Mật khẩu xác nhận</label>
                    <input type="password" class="form-control" name="confirmPassword">
                </div>

                <button type="submit" name="submit" class="btn btn-primary">
                    Đăng ký
                </button>
            </form>
        </div>
    </body>
</html>