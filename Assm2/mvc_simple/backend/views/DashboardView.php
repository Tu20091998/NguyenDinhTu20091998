<h3 class="fw-bold mb-4 text-dark text-center text-uppercase mb-5">
    <i class="fa-solid fa-gauge me-2 text-warning"></i>Trang tổng quan - PolyXShop
</h3>
<div class="row g-4 mt-2">
    <!--doanh thu-->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4"><i class="fa-solid fa-wallet text-success me-2"></i>Tổng doanh thu</h5>
            <div class="d-flex align-items-center gap-3">
                <span class="text-danger fw-bold fs-4"><?= number_format($revenue, 0, ',', '.') ?>đ</span>
                <div class="d-flex align-items-center gap-2">
                    <?php if($revenue_change >= 0): ?>
                        <i class="fa-solid fa-arrow-up text-success"></i>
                        <span class="text-success"><?= number_format($revenue_change, 2) ?>%</span>
                    <?php else: ?>
                        <i class="fa-solid fa-arrow-down text-danger"></i>
                        <span class="text-danger"><?= number_format(abs($revenue_change), 2) ?>%</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!--khách hàng thân thiết nhất-->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4"><i class="fa-solid fa-crown text-warning me-2"></i>Khách mua hàng nhiều nhất</h5>
            <ul class="list-group list-group-flush">
                <?php foreach($top_customers as $c): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0 mb-2">
                    <div>
                        <div class="fw-bold"><?= $c['firstname'] ?> <?= $c['lastname'] ?></div>
                        <small class="text-muted"><?= $c['total_orders'] ?> đơn hàng</small>
                    </div>
                    <span class="text-danger fw-bold"><?= number_format($c['total_spent'], 0, ',', '.') ?>đ</span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


<div class="row g-4 mt-2">
    <!--sản phẩm bán chạy nhất-->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4"><i class="fa-solid fa-fire text-danger me-2"></i>Sản phẩm bán chạy</h5>
            <table class="table table-hover align-middle small">
                <thead><tr><th>Sản phẩm</th><th class="text-center">Số lượng</th></tr></thead>
                <tbody>
                    <?php foreach($top_selling as $p): ?>
                    <tr>
                        <td><img src="storage/product_images/<?= $p['image'] ?>" width="30" class="me-2"><?= $p['name'] ?></td>
                        <td class="text-center fw-bold"><?= $p['total_sold'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h5 class="fw-bold mb-4">
                <i class="fa-solid fa-clock-rotate-left text-danger me-2"></i>Đơn hàng cần xử lý
            </h5>
            <ul class="list-group list-group-flush">
                <?php if(!empty($pending_orders)): ?>
                    <?php foreach($pending_orders as $order): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-0 mb-3">
                        <div>
                            <div class="fw-bold text-dark">#<?= $order['id'] ?> - <?= $order['full_name'] ?></div>
                            <small class="text-muted">
                                <i class="fa-regular fa-calendar-check me-1"></i><?= date('H:i d/m', strtotime($order['created_at'])) ?>
                            </small>
                        </div>
                        <div class="text-end">
                            <div class="text-danger fw-bold mb-1"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</div>
                            <a href="admin_order_detail?id=<?= $order['id'] ?>" class="btn btn-sm btn-warning rounded-pill py-0 px-3 fw-bold small">Duyệt</a>
                        </div>
                    </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item px-0 border-0 text-center py-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/5038/5038508.png" width="50" class="opacity-25 mb-2">
                        <p class="text-muted small">Tuyệt vời! Không có đơn hàng nào đang chờ.</p>
                    </li>
                <?php endif; ?>
            </ul>
            <a href="admin_orders" class="btn btn-link btn-sm text-decoration-none text-warning fw-bold mt-auto p-0">Xem tất cả đơn hàng →</a>
        </div>
    </div>
</div>