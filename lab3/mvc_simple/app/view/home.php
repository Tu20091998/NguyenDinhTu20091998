<?php

//khai báo composer
require_once __DIR__ . "/../../vendor/autoload.php";

use app\core\Form;

$form = new Form();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register Account</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #9face6);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            background: #fff;
            border-radius: 15px;
            padding: 35px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .auth-card h1 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
        }

        .btn-register {
            background: #6c63ff;
            color: #fff;
            border-radius: 30px;
            padding: 12px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: #554ee0;
            color: #fff;
        }

        .table-wrapper {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            margin-top: 40px;
            margin-bottom: 1rem;
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }
    </style>
</head>

<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <h1>Create Account</h1>

        <!-- Thông báo -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Vui lòng điền đầy đủ thông tin để đăng ký.
            </div>
        <?php endif; ?>

        <!-- Form -->
        <?php $form->begin('route.php?action=register_user_confirm', 'post'); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field('lastname')->placeholder('Nhập họ của bạn') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field('firstname')->placeholder('Nhập tên của bạn') ?>
            </div>
        </div>

        <?= $form->field('email')->placeholder('Nhập email') ?>
        <?= $form->field('password')->passwordField()->placeholder('Nhập mật khẩu') ?>
        <?= $form->field('confirmPassword')->passwordField()->placeholder('Nhập lại mật khẩu') ?>

        <?= $form->submitButton('Đăng Ký') ?>

        <?php $form->end(); ?>

    </div>
</div>

<!-- Danh sách người dùng -->
<div class="container">
    <div class="table-wrapper">
        <h3 class="mb-3">Danh sách người dùng</h3>

        <table class="table table-hover table-bordered">
            <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Họ</th>
                <th>Tên</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['lastname']) ?></td>
                    <td><?= htmlspecialchars($user['firstname']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
