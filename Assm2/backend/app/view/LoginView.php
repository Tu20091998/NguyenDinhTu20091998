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
                    <form action="login" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="submit" class="btn btn-primary shadow-sm">
                                Đăng nhập
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">Chưa có tài khoản? <a href="register" class="text-decoration-none">Đăng ký ngay</a></small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>