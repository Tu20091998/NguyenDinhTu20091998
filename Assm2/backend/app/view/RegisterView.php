<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4 fw-bold text-primary">Đăng ký tài khoản</h2>

                <?php if (!empty($message)): ?>
                    <?= $message ?>
                <?php endif; ?>

                <form action="register" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Họ</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Họ" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tên</label>
                            <input type="text" class="form-control" name="firstname" placeholder="Tên" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="••••••••" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" name="confirmPassword" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg shadow-sm">
                            Tạo tài khoản
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">Đã có tài khoản? <a href="login" class="text-decoration-none">Đăng nhập tại đây</a></small>
                </div>
            </div>
        </div>
    </div>
</div>