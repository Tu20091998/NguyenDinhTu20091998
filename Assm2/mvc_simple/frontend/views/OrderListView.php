<div class="container mt-5 mb-5">
    <h3 class="fw-bold mb-4"><i class="fas fa-history me-2 text-warning"></i> LỊCH SỬ ĐƠN HÀNG</h3>

    <div class="card border-0 shadow-sm rounded-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="py-3 ps-3">Mã đơn</th>
                    <th>Người nhận</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td class="ps-3 fw-bold">#<?= $order['id'] ?></td>
                            <td>
                                <div><?= $order['full_name'] ?></div>
                                <small class="text-muted"><?= $order['phone'] ?></small>
                            </td>
                            <td class="text-muted"><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                            <td class="text-danger fw-bold"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                            <td>
                                <?php 
                                    $badgeClass = ($order['status'] == 'pending') ? 'bg-warning text-dark' : 'bg-success';
                                    $statusVn = ($order['status'] == 'pending') ? 'Chờ xác nhận' : 'Đã xác nhận';
                                ?>
                                <span class="badge rounded-pill <?= $badgeClass ?>"><?= $statusVn ?></span>
                            </td>
                            <td class="text-center">
                                <a href="order_detail?id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-dark">Chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Bạn chưa có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>