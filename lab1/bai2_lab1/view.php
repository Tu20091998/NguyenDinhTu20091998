<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
        }

        .container {
            width: 380px;
            margin: 100px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #218838;
        }

        .message {
            background: #ffe9e9;
            border-left: 5px solid #dc3545;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            color: #dc3545;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Đăng Ký (MVC Demo)</h2>

    <?php if(isset($message)): ?>
        <div class="message">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="post" action="controller.php">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <input type="submit" value="Đăng ký">
    </form>
</div>

</body>
</html>
