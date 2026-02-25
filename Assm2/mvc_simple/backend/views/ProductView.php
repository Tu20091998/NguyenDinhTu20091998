
<div class="container mt-5">
    <h2 class="mb-4">Thêm sản phẩm mới cho Shop điện thoại</h2>
    
    <?php if(isset($message)) echo $message; ?>

    <form action="add_product" method="POST" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Ví dụ: iPhone 17 Pro Max" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá (VNĐ)</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá bán" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh sản phẩm</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            <small class="text-muted">Lưu ý: Ảnh sẽ được lưu vào thư mục storage.</small>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả chi tiết</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập thông số kỹ thuật..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Lưu sản phẩm</button>
    </form>
</div>

<hr class="my-5"> <div class="container mb-5">
    <h3 class="mb-4">Danh sách sản phẩm hiện có</h3>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th style="width: 100px;">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá (VNĐ)</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td>
                            <img src="storage/product_images/<?= $product['image'] ?>" 
                                class="img-thumbnail" 
                                alt="<?= $product['name'] ?>"
                                style="width: 80px; height: auto;">
                        </td>
                        <td><strong><?= $product['name'] ?></strong></td>
                        <td class="text-danger fw-bold"><?= number_format($product['price'], 0, ',', '.') ?>đ</td>
                        <td><small><?= $product['description'] ?></small></td>
                        <td>
                            <a href="edit_product?id=<?= $product['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                            <a href="delete_product?id=<?= $product['id'] ?>" 
                                class="btn btn-sm btn-danger" 
                                onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Chưa có sản phẩm nào trong cửa hàng.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>