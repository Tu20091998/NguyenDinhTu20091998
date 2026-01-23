<?php
    //nạp file model
    include 'model.php';

    //kiểm tra nếu người dùng đã nhấn nút đăng nhập
    $user = null;

    if(isset($_POST["email"])){
        $email = $_POST["email"];
        $user = get_user($email);
    }

    //nạp view để hiển thị
    include 'view.php';
?>
