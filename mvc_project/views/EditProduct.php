<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang sửa sản phẩm</title>
        <link rel="stylesheet" href="css/edit_product.css">
</head>
<body>
        <div class="container">
                <h2>Sửa sản phẩm</h2>

                <form action="update_product" method="POST" class="edit-form">
                        <input type="hidden" name="id" value="<?= $product['id']; ?>">

                        <label>Tên sản phẩm:</label>
                        <input type="text" name="name" 
                                value="<?= $product['name']; ?>" required>

                        <label>Giá:</label>
                        <input type="number" name="price" 
                                value="<?= $product['price']; ?>" required>

                        <button type="submit" class="update-btn">Cập nhật</button>
                </form>

                <a href="admin" class="back-btn">← Quay lại</a>
        </div>
</body>
</html>

