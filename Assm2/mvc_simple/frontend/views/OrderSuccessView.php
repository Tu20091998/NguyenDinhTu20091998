<div class="container mt-5 mb-5 text-center animate__animated animate__fadeIn">
    <div class="mb-4">
        <div class="display-1 text-success animate__animated animate__bounceIn">
            <i class="fa-solid fa-circle-check"></i>
        </div>
    </div>

    <h2 class="fw-bold text-dark mb-3 text-uppercase">Đặt hàng thành công!</h2>
    <p class="text-muted fs-5 mb-4">
        Cảm ơn <strong><?= $_SESSION['user']['firstname'] ?></strong> đã tin tưởng lựa chọn PolyXShop Đà Nẵng. <br>
        Mã đơn hàng của bạn là: <span class="text-warning fw-bold">#<?= $_GET['id'] ?? 'N/A' ?></span>
    </p>

    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-light">
                <div class="d-flex justify-content-around">
                    <div class="text-center">
                        <div class="fw-bold">Trạng thái</div>
                        <span class="badge bg-warning text-dark rounded-pill">Đang chờ xác nhận</span>
                    </div>
                    <div class="vr"></div>
                    <div class="text-center">
                        <div class="fw-bold">Thanh toán</div>
                        <span class="badge bg-dark rounded-pill">COD (Khi nhận hàng)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center gap-3">
        <a href="home" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
            <i class="fa-solid fa-house me-2"></i>Về trang chủ
        </a>
        <a href="my_orders" class="btn btn-warning rounded-pill px-4 py-2 fw-bold shadow-sm">
            <i class="fa-solid fa-file-invoice me-2"></i>Xem đơn hàng của tôi
        </a>
    </div>

    <div class="mt-5 py-4">
        <p class="small text-muted italic">Nhân viên sẽ sớm liên hệ với bạn qua số điện thoại để xác nhận địa chỉ giao hàng.</p>
    </div>
</div>

<style>
    .display-1 { font-size: 6rem; }
</style>