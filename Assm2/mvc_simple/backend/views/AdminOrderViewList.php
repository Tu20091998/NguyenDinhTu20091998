<div class="container-fluid mt-4 animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase"><i class="fa-solid fa-clipboard-list text-warning me-2"></i>Quản lý đơn hàng</h2>
        <span class="badge bg-dark rounded-pill px-3 py-2">Tổng cộng: <?= count($orders) ?> đơn hàng</span>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="ps-4 py-3">ID</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td class="ps-4 fw-bold">#<?= $order['id'] ?></td>
                            <td>
                                <div class="fw-bold"><?= $order['full_name'] ?></div>
                                <small class="text-muted"><i class="fa-solid fa-phone fa-xs"></i> <?= $order['phone'] ?></small>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                            <td class="text-danger fw-bold"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                            <td>
                                <form action="update_order_status" method="POST" class="d-flex gap-2">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <select name="status" class="form-select form-select-sm rounded-pill border-0 bg-light" onchange="this.form.submit()">
                                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Chờ xác nhận</option>
                                        <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>Đang xử lý</option>
                                        <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>Đang giao</option>
                                        <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Đã giao</option>
                                        <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-center">
                                <a href="admin_order_detail?id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fa-solid fa-eye me-1"></i> Xem
                                </a>
                                <a href="delete_order?id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Xóa đơn hàng này?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>