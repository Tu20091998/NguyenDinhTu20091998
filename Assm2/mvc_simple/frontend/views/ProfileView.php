<div class="container mt-5 animate__animated animate__fadeIn">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="avatar-lg mx-auto mb-3 bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-user-gear fa-2x text-dark"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Hồ sơ của tôi</h4>
                        <p class="text-muted small">Cập nhật thông tin cá nhân của bạn</p>
                    </div>

                    <?= $message ?? '' ?>

                    <form action="update_profile" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Họ</label>
                            <input type="text" name="lastname" class="form-control rounded-3" value="<?= $users[0]['lastname'] ?? '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên</label>
                            <input type="text" name="firstname" class="form-control rounded-3" value="<?= $users[0]['firstname'] ?? '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control rounded-3 bg-light" value="<?= $users[0]['email'] ?? '' ?>" required>
                            <small class="text-muted">Vui lòng hạn chế thay đổi email !</small>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill py-2 shadow-sm">CẬP NHẬT HỒ SƠ</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-key text-warning me-2"></i>Đổi mật khẩu</h4>
                    
                    <form action="change_password" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mật khẩu hiện tại</label>
                            <input type="password" name="old_password" class="form-control rounded-3" placeholder="********" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mật khẩu mới</label>
                            <input type="password" name="new_password" class="form-control rounded-3" placeholder="Nhập mật khẩu mới" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Xác nhận mật khẩu</label>
                            <input type="password" name="confirm_password" class="form-control rounded-3" placeholder="Nhập lại mật khẩu mới" required>
                        </div>
                        <button type="submit" class="btn btn-outline-dark w-100 fw-bold rounded-pill py-2">ĐỔI MẬT KHẨU</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>