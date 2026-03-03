<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng ký</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="container">
        <h2>Đăng ký tài khoản</h2>
        <?php
            $message = "";

            if(isset($_GET["status"])){
                switch($_GET["status"]){

                    case "register_error":
                        $message = "<div>❌ Đăng ký không thành công !</div><br>";
                    break;

                    case "register_success":
                        $message = "<div>✅ Bạn đã đăng ký thành công ! Đăng nhập ngay !</div><br>";
                    break;

                    case "form_empty":
                        $message = "<div>❌ Ô nhập không được để trống !</div><br>";
                    break;
                }
            }
            echo $message;
        ?>
        <form action="register_confirm" method="POST">
                    
            <label for="email">Email đăng ký:</label><br>
            <input type="email" id="email" name="email" placeholder="Nhập email" required><br><br>

            <label for="password">Mật khẩu:</label><br>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu đăng ký" required><br><br>

            <label for="password_confirm">Nhập lại mật khẩu:</label><br>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Nhập mật khẩu xác nhận" required><br><br>

            <button type="submit">Đăng ký</button>

        </form>

        <p>Đã có tài khoản? <a href="login">Đăng nhập</a></p>
    </div>
    
</body>
</html>