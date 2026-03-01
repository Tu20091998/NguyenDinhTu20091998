<div class="d-flex align-items-center mb-4 gap-3">
    <h3 class="fw-bold mb-0 text-uppercase"><i class="fa-solid fa-star me-2 text-warning"></i> Quản lý đánh giá</h3>
    <select class="form-select form-select-sm rounded-pill border-0 bg-light w-auto" 
            onchange="location.href = 'admin_reviews?rating=' + this.value;">
        <option value="">-- Tất cả sao --</option>
        <?php for($i=5; $i>=1; $i--): ?>
            <option value="<?= $i ?>" <?= (isset($_GET['rating']) && $_GET['rating'] == $i) ? 'selected' : '' ?>>
                <?= $i ?> <i class="fa-solid fa-star text-warning">Sao</i>
            </option>
        <?php endfor; ?>
    </select>
</div>

<table class="table align-middle">
    <thead>
        <tr>
            <th>Khách hàng</th>
            <th>Tên sản phẩm</th>
            <th>Nội dung</th>
            <th>Sao</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reviews as $r): ?>
        <tr>
            <td><?= $r['firstname'] ?></td>
            <td><?= $r['product_name'] ?></td>
            <td class="small"><?= $r['comment'] ?></td>
            <td><?= $r['rating'] ?> <i class="fa-solid fa-star text-warning"></i></td>
            <td>
                <span class="badge rounded-pill <?= $r['status'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                    <?= $r['status'] == 1 ? 'Hiển thị' : 'Đã ẩn' ?>
                </span>
            </td>
            <td>
                <a href="toggle_review?id=<?= $r['id'] ?>&status=<?= $r['status'] == 1 ? 0 : 1 ?>" 
                    class="btn btn-sm <?= $r['status'] == 1 ? 'btn-outline-danger' : 'btn-outline-success' ?> rounded-pill">
                    <?= $r['status'] == 1 ? 'Ẩn đi' : 'Hiện lại' ?>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>