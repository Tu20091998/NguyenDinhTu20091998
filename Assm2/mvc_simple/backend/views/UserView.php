<div class="container mt-5 animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-uppercase mb-0">
            <i class="fa-solid fa-users-gear text-warning me-2"></i>Quản lý người dùng
        </h3>
        <span class="badge bg-dark rounded-pill px-3 py-2"><?= count($users ?? []) ?> Thành viên</span>
    </div>

    <?= $message ?? "" ?>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th class="py-3">ID</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Ngày tham gia</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="text-center fw-bold">#<?= $user['id'] ?></td>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fa-solid fa-user text-secondary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?= $user['lastname'] ?> <?= $user['firstname'] ?></div>
                                        <small class="text-muted">ID: <?= $user['id'] ?></small>
                                    </div>
                                </div>
                            </td>

                            <td><?= $user['email'] ?></td>
                            <td class="text-center">
                                <?php if ($user['role'] === 'admin'): ?>
                                    <span class="badge bg-danger rounded-pill px-3">Quản trị viên</span>
                                <?php else: ?>
                                    <span class="badge bg-primary rounded-pill px-3">Khách hàng</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <?php if ($user['status'] == 1): ?>
                                    <span class="badge bg-success rounded-pill">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary rounded-pill">Đã khóa</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center text-muted small">
                                <?= date('d/m/Y', strtotime($user['created_at'])) ?>
                            </td>

                            <td class="text-center">
                                <a href="toggle_user_status?id=<?= $user['id'] ?>&current=<?= $user['status'] ?>" 
                                    class="btn btn-sm <?= $user['status'] == 1 ? 'btn-outline-warning' : 'btn-outline-success' ?> rounded-pill">
                                    <i class="fa-solid <?= $user['status'] == 1 ? 'fa-lock' : 'fa-lock-open' ?>"></i>
                                    <?= $user['status'] == 1 ? 'Khóa' : 'Mở' ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Chưa có người dùng nào trong hệ thống.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(255, 193, 7, 0.05);
        transition: 0.3s;
    }
    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
    }
</style>