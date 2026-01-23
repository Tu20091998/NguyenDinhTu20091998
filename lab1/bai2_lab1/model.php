<?php
function register_user($user, $pass) {

    if (empty($user) || empty($pass)) {
        return "Vui lòng nhập đầy đủ thông tin!";
    }

    return "Đăng ký thành công tài khoản: " . htmlspecialchars($user);
}
?>