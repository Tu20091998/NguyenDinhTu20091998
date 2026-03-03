<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <h2>Trang đăng nhập admin</h2>
        <?php
            $message = "";

            if(isset($_GET["status"])){
                switch($_GET["status"]){
                    case "login_error":
                        $message = "<div>❌ Tài khoản hoặc mật khẩu không đúng !</div><br>";
                    break;
                    
                    case "form_empty":
                        $message = "<div>❌ Không được bỏ trống các trường !</div><br>";
                    break;
                    
                    case "not_admin_login":
                        $message = "<div>❌ Bạn không phải là Admin !</div><br>";
                    break;
                    
                    case "admin_logout":
                        $message = "<div>✅ Bạn đã đăng xuất thành công !</div><br>";
                    break;
                }
            }
            echo $message;
        ?>

                    
        <form method="POST" action="login">
            <input type="email" name="email" placeholder="Nhập địa chỉ email">
            <br><br>
            <input type="password" name="password" placeholder="Nhập mật khẩu">
            <br><br>
            <button type="submit">Đăng nhập</button>
        </form>
        <br>
        <span >Bạn chưa có tài khoản ?</span> <a href="register_display">Đăng ký ngay</a>
    </div>
</body>
</html>
