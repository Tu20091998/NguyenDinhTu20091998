<div class="container mt-5 animate__animated animate__fadeIn">
    <div class="row">
        <h1 class="fw-bold mb-4 text-dark text-center text-uppercase mb-5">
            Quản lý danh mục - PolyXShop
        </h1>

        <?php if (!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?>
        
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4 text-dark">
                        <i class="fa-solid fa-folder-plus text-warning me-2"></i>Thêm danh mục
                    </h4>
                    
                    <form action="add_category" method="POST">
                        <div class="mb-3">
                            <label for="cat_name" class="form-label fw-bold">Tên danh mục</label>
                            <input type="text" class="form-control rounded-3" id="cat_name" name="name" 
                                placeholder="Ví dụ: iPhone, Samsung..." required>
                        </div>

                        <div class="mb-3">
                            <label for="cat_desc" class="form-label fw-bold">Mô tả ngắn</label>
                            <textarea class="form-control rounded-3" id="cat_desc" name="description" 
                                rows="3" placeholder="Mô tả về hãng này..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill py-2 shadow-sm">
                            <i class="fa-solid fa-save me-1"></i> LƯU DANH MỤC
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th class="py-3">ID</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <tr>
                                    <td class="text-center fw-bold">#<?= $cat['id'] ?></td>
                                    <td>
                                        <span class="fw-bold text-dark text-uppercase"><?= $cat['name'] ?></span>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= $cat['description'] ?: 'Không có mô tả' ?></small>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit_category?id=<?= $cat['id'] ?>" 
                                            class="btn btn-sm btn-outline-dark rounded me-1 mb-2">
                                            <i class="fa-solid fa-pen-to-square"></i> Sửa
                                        </a>
                                        <a href="delete_category?id=<?= $cat['id'] ?>" 
                                            class="btn btn-sm btn-outline-danger rounded" 
                                            onclick="return confirm('Lưu ý: Xóa danh mục có thể ảnh hưởng đến các sản phẩm thuộc hãng này. Bạn vẫn muốn xóa?')">
                                            <i class="fa-solid fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">Chưa có danh mục nào được tạo.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>