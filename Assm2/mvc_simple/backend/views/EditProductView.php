<div class="container mt-5 animate__animated animate__fadeIn"> <h2 class="mb-4 text-warning">Chỉnh sửa sản phẩm: <?= $product['name'] ?></h2>

    <form action="update_product" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="mb-3">
            <label class="form-label fw-bold">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" value="<?= $product['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Giá (VNĐ)</label>
            <input type="number" class="form-control" name="price" value="<?= $product['price'] ?>" required>
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

        <div class="mb-3">
            <label class="form-label fw-bold">Hình ảnh hiện tại</label><br>
            <img src="storage/product_images/<?= $product['image'] ?>" width="150" class="mb-2 img-thumbnail">
            <input type="file" class="form-control" name="image" accept="image/*">
            <small class="text-muted">Để trống nếu không muốn thay đổi ảnh.</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Mô tả chi tiết</label>
            <textarea class="form-control" name="description" rows="4"><?= $product['description'] ?></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success flex-grow-1">Cập nhật thay đổi</button>
            <a href="products" class="btn btn-secondary">Hủy bỏ</a>
        </div>
    </form>
</div>