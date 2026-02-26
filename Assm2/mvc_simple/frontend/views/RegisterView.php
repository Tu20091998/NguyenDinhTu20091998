<?php 
use core\Form; 
?>

<div class="row justify-content-center animate__animated animate__fadeIn">
    <div class="col-md-7">
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-user-plus fa-4x text-warning mb-3"></i>
                    <h2 class="card-title fw-bold text-dark text-uppercase">Đăng ký thành viên</h2>
                    <p class="text-muted small">Gia nhập cộng đồng PolyXShop để nhận nhiều ưu đãi</p>
                </div>

                <?php if (!empty($message)): ?>
                    <div class="mb-3">
                        <?= $message ?>
                    </div>
                <?php endif; ?>

                <?php $form = Form::begin('register', 'post'); ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $form->field('lastname')->placeholder('Họ của bạn...'); ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $form->field('firstname')->placeholder('Tên của bạn...'); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <?= $form->field('email')->placeholder('example@gmail.com'); ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $form->field('password')
                                    ->passwordField()
                                    ->placeholder('Nhập mật khẩu'); ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $form->field('confirmPassword')
                                    ->passwordField()
                                    ->placeholder('Xác nhận mật khẩu'); ?>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <?= $form->submitButton('Tạo tài khoản ngay', 'btn btn-warning btn-lg shadow-sm fw-bold rounded-pill py-2'); ?>
                    </div>

                <?php echo Form::end(); ?>

                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Đã là thành viên của PolyXShop?</p>
                    <a href="login" class="text-warning fw-bold text-decoration-none">Quay lại Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Đồng bộ kiểu dáng input cho cả trang Register */
    .form-control {
        border-radius: 10px;
        padding: 10px 15px;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }
    .card {
        background-color: #ffffff;
    }
    /* Hiệu ứng cho icon khi load trang */
    .fa-user-plus {
        filter: drop-shadow(0 4px 6px rgba(255, 193, 7, 0.2));
    }
</style>