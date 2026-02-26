<?php 
use core\Form; 
?>

<div class="row justify-content-center animate__animated animate__fadeIn">
    <div class="col-md-5">
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-circle-user fa-4x text-warning mb-3"></i>
                    <h2 class="card-title fw-bold text-dark text-uppercase"><?= $title ?></h2>
                </div>

                <?php if (!empty($message)): ?>
                    <div class="mb-3">
                        <?= $message ?>
                    </div>
                <?php endif; ?>

                <?php if ($isLogin): ?>
                    <div class="text-center py-3">
                        <div class="alert alert-success border-0 shadow-sm rounded-3">
                            <i class="fa-solid fa-circle-check me-2"></i> 
                            Xin chào <strong><?= $lastname ?> <?= $firstname ?></strong>
                        </div>
                        <a href="logout" class="btn btn-outline-danger w-100 mt-2 rounded-pill">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất
                        </a>
                    </div>
                <?php else: ?>
                    
                    <?php $form = Form::begin('login', 'post'); ?>
                        
                        <div class="mb-3">
                            <?= $form->field('email')
                                    ->placeholder('name@example.com'); ?>
                        </div>

                        <div class="mb-3">
                            <?= $form->field('password')
                                    ->passwordField()
                                    ->placeholder('••••••••'); ?>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <?= $form->submitButton('Đăng nhập hệ thống', 'btn btn-warning shadow-sm fw-bold rounded-pill py-2'); ?>
                        </div>

                    <?php echo Form::end(); ?>
                    
                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">Chưa có tài khoản?</p>
                        <a href="register" class="text-warning fw-bold text-decoration-none">Đăng ký thành viên ngay</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tùy chỉnh thêm để các input của class Field trông xịn hơn */
    .form-control {
        border-radius: 10px;
        padding: 10px 15px;
        border: 1px solid #dee2e6;
    }
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }
    .card {
        background-color: #ffffff;
    }
</style>