<div class="container mt-5 animate__animated animate__fadeIn">
    <h1 class="fw-bold mb-4 text-dark text-center text-uppercase mb-5">
        Quản lý sản phẩm - PolyXShop
    </h1>
    <div class="card shadow border-0 rounded-4 mb-5">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-4 text-dark">
                <i class="fa-solid fa-plus-circle text-warning me-2"></i>Thêm sản phẩm cho PolyXShop
            </h2>
            
            <?php if(isset($message)) echo $message; ?>

            <form action="add_product" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" class="form-control rounded-3" id="name" name="name" placeholder="Ví dụ: iPhone 17 Pro Max" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label fw-bold">Danh mục sản phẩm</label>
                        <select class="form-select rounded-3" id="category_id" name="category_id" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php if(!empty($categories)): ?>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label fw-bold">Giá bán (VNĐ)</label>
                        <input type="number" class="form-control rounded-3" id="price" name="price" placeholder="Nhập giá" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label fw-bold">Hình ảnh</label>
                        <input type="file" class="form-control rounded-3" id="image" name="image" accept="image/*" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Mô tả thông số</label>
                    <textarea class="form-control rounded-3" id="description" name="description" rows="3" placeholder="Nhập chi tiết cấu hình..."></textarea>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill py-2 shadow-sm">
                    <i class="fa-solid fa-save me-1"></i> LƯU SẢN PHẨM MỚI
                </button>
            </form>
        </div>
    </div>

    <h3 class="fw-bold mb-4 text-uppercase">Danh sách sản phẩm hiện có</h3>
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th class="py-3">ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá bán</th>
                    <th style="width: 250px;">Mô tả</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="text-center fw-bold">#<?= $product['id'] ?></td>
                            <td class="text-center">
                                <img src="/Php2/Assm2/mvc_simple/storage/product_images/<?= $product['image'] ?>" 
                                    class="rounded-3 border" 
                                    alt="<?= $product['name'] ?>"
                                    style="width: 70px; height: 70px; object-fit: cover;">
                            </td>
                            <td><span class="fw-bold text-dark"><?= $product['name'] ?></span></td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark"><?= $product['category_name'] ?? 'Chưa phân loại' ?></span>
                            </td>
                            <td class="text-danger fw-bold text-end pe-3"><?= number_format($product['price'], 0, ',', '.') ?>đ</td>
                            <td><small class="text-muted line-clamp"><?= $product['description'] ?></small></td>
                            <td class="text-center">
                                <a href="edit_product?id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill me-1">Sửa</a>
                                <a href="delete_product?id=<?= $product['id'] ?>" 
                                    class="btn btn-sm btn-outline-danger rounded-pill" 
                                    onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Chưa có sản phẩm nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .line-clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>