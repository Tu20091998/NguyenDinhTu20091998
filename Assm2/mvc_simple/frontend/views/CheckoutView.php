<div class="container mt-5 mb-5">
    <form action="place_order" method="POST">
        <div class="row">
            <h2 class="fw-bold text-uppercase mb-4"><i class="fa-solid fa-truck-fast text-warning me-2"></i>Thanh toán đơn hàng</h2>
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h4 class="fw-bold mb-4 border-bottom pb-2">Thông tin nhận hàng</h4>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ tên người nhận</label>
                        <input type="text" name="full_name" class="form-control rounded-3" 
                            value="<?= $_SESSION['user']['lastname'] . ' ' . $_SESSION['user']['firstname'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control rounded-3" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Địa chỉ giao hàng (Đà Nẵng)</label>
                        <textarea name="address" class="form-control rounded-3" rows="3" required></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
                    <h5 class="fw-bold mb-4">Kiểm tra lại đơn hàng</h5>
                    <?php $total = 0; foreach($cartItems as $item): 
                        $sub = $item['price'] * $item['quantity']; $total += $sub; ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span><?= $item['name'] ?> x <?= $item['quantity'] ?></span>
                            <span><?= number_format($sub, 0, ',', '.') ?>đ</span>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fs-5 fw-bold">Tổng thanh toán:</span>
                        <input type="hidden" name="total_amount" value="<?= $total ?>">
                        <span class="fs-4 fw-bold text-danger"><?= number_format($total, 0, ',', '.') ?>đ</span>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill py-3 text-uppercase">
                        Xác nhận đặt hàng ngay
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>