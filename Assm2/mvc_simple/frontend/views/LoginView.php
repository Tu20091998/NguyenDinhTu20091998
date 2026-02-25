<?php 
use core\Form; 
?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4 fw-bold text-primary"><?= $title ?></h2>

                <?php if (!empty($message)): ?>
                    <?= $message ?>
                <?php endif; ?>

                <?php if ($isLogin): ?>
                    <div class="text-center py-3">
                        <div class="alert alert-success">
                            <i class="bi bi-person-check-fill"></i> Xin chào <strong><?= $lastname ?> <?= $firstname ?></strong>
                        </div>
                        <a href="logout" class="btn btn-outline-danger w-100 mt-2">Đăng xuất</a>
                    </div>
                <?php else: ?>
                    
                    <?php $form = Form::begin('login', 'post'); ?>
                        
                        <?= $form->field('email')
                                ->placeholder('name@example.com'); ?>

                        <?= $form->field('password')
                                ->passwordField()
                                ->placeholder('••••••••'); ?>

                        <div class="d-grid gap-2 mt-4">
                            <?= $form->submitButton('Đăng nhập', 'btn btn-primary shadow-sm'); ?>
                        </div>

                    <?php echo Form::end(); ?>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">Chưa có tài khoản? <a href="register" class="text-decoration-none">Đăng ký ngay</a></small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>