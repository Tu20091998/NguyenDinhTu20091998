<?php 
use core\Form; 
?>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4 fw-bold text-primary">Đăng ký tài khoản</h2>

                <?php if (!empty($message)): ?>
                    <?= $message ?>
                <?php endif; ?>

                <?php $form = Form::begin('register', 'post'); ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $form->field('lastname')->placeholder('Họ'); ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $form->field('firstname')->placeholder('Tên'); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <?= $form->field('email')->placeholder('example@gmail.com'); ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?= $form->field('password')
                                    ->passwordField()
                                    ->placeholder('••••••••'); ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?= $form->field('confirmPassword')
                                    ->passwordField()
                                    ->placeholder('••••••••'); ?>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <?= $form->submitButton('Tạo tài khoản', 'btn btn-primary btn-lg shadow-sm'); ?>
                    </div>

                <?php echo Form::end(); ?>

                <div class="text-center mt-3">
                    <small class="text-muted">Đã có tài khoản? <a href="login" class="text-decoration-none">Đăng nhập tại đây</a></small>
                </div>
            </div>
        </div>
    </div>
</div>