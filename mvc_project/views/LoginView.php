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
                $message = "<div>❌ Bạn không phải admin !</div><br>";
            break;

            case "admin_logout":
                $message = "<div>✅ Bạn đã đăng xuất thành công !</div><br>";
            break;
        }
    }
    echo $message;
?>


<form method="POST" action="login">
    <input type="text" name="email" placeholder="Nhập địa chỉ email">
    <br><br>
    <input type="password" name="password" placeholder="Nhập mật khẩu">
    <br><br>
    <button type="submit">Login</button>
</form>

<span>Bạn chưa có tài khoản ?</span> <a href="register_display">Đăng ký ngay</a>