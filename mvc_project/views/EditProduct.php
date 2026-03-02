<h2>Sửa sản phẩm</h2>

<form action="update_product" method="POST">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" 
            value="<?php echo $product['name']; ?>" required><br><br>

    <label>Giá:</label><br>
    <input type="number" name="price" 
            value="<?php echo $product['price']; ?>" required><br><br>

    <button type="submit">Cập nhật</button>
</form>
<br>
<a href="admin">Quay lại</a>