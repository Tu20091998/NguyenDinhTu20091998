<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm kiếm User</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
        }

        .container {
            width: 420px;
            margin: 80px auto;
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

        input[type="email"] {
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
            background: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        .result {
            background: #e9f5ff;
            border-left: 5px solid #007bff;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .error {
            background: #ffe9e9;
            border-left: 5px solid #dc3545;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tìm kiếm User theo Email</h2>

    <?php if (isset($user) && $user): ?>
        <div class="result">
            <p>Xin chào: <b><?= $user['firstname'] . " " . $user['lastname']; ?></b></p>
            <p>Email của bạn: <b><?= $user['email'] ?></b></p>
        </div>
    <?php elseif (isset($_POST['email'])): ?>
        <div class="error">
            Không tìm thấy user nào!
        </div>
    <?php endif; ?>

    <form method="post" action="controller.php">
        <label>Nhập Email:</label>
        <input type="email" name="email" required>
        <input type="submit" value="Tìm kiếm">
    </form>
</div>

</body>
</html>
