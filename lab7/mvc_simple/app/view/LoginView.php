
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div class="container">
        <h2><?= $title ?></h2>

        <!--Hiển thị thông báo-->
        <p class="message"><?= $message ?></p>

        <!--Xét nếu đăng nhập thành công hoặc hiển thị form đăng nhập-->
        <?php if ($isLogin): ?>
                <p class="welcome">Xin chào <strong><?= $lastname ?><?= $firstname ?></strong> |
                    <a href="logout">Đăng xuất</a>
                </p>
        <?php else: ?>
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
        <?php endif; ?>
    </div>
    
</body>
</html>