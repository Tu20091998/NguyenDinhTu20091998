<div class="container mt-5 animate__animated animate__fadeIn">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-pen-to-square fa-3x text-warning mb-3"></i>
                        <h2 class="fw-bold text-dark text-uppercase">Chỉnh sửa danh mục</h2>
                        <p class="text-muted small">Cập nhật thông tin cho hãng điện thoại</p>
                    </div>

                    <?php if(isset($message)) echo $message; ?>

                    <form action="update_category" method="POST">
                        <input type="hidden" name="id" value="<?= $category['id'] ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Tên danh mục</label>
                            <input type="text" class="form-control rounded-3 py-2" id="name" name="name" 
                                value="<?= $category['name'] ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Mô tả danh mục</label>
                            <textarea class="form-control rounded-3" id="description" name="description" 
                                rows="4"><?= $category['description'] ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning fw-bold rounded-pill py-2 shadow-sm">
                                <i class="fa-solid fa-check me-1"></i> CẬP NHẬT THAY ĐỔI
                            </button>
                            <a href="categories" class="btn btn-outline-dark rounded-pill py-2">
                                <i class="fa-solid fa-arrow-left me-1"></i> QUAY LẠI
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }
</style>