<h2>Trang Admin</h2>
<?php
    $message = "";

    if(isset($_GET["status"])){
        switch($_GET["status"]){
            case "login_success":
                $message = "<div>✅ Đăng nhập thành công !</div><br>";
            break;

            case "add_product_success":
                $message = "<div>✅ Thêm sản phẩm thành công!</div><br>";
            break;

            case "add_product_error":
                $message = "<div>❌ Ô nhập thông tin sản phẩm không được để trống !</div><br>";
            break;

            case "delete_product_success":
                $message = "<div>✅ Xoá sản phẩm thành công!</div><br>";
            break;

            case "update_product_success":
                $message = "<div>✅ Sửa sản phẩm thành công !</div><br>";
            break;

            case "":
                $message = "<div>❌ Sửa sản phẩm không thành công !</div><br>";
            break;
        }
    }

    echo $message;
?>


<form method="POST" action="add-product">
    <input type="text" name="name" placeholder="Nhập tên sản phẩm">
    <br><br>
    <input type="number" name="price" placeholder="Nhập giá sản phẩm">
    <br><br>
    <button type="submit">Thêm sản phẩm</button>
</form>

<!--danh sách sản phẩm đã thêm-->
<h2>Danh sách sản phẩm đã thêm vào</h2>

<?php if (!empty($products)) : ?>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Thao tác</th>
        </tr>

        <?php foreach ($products as $item) : ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                <td>
                    <a href="edit_product?product_id=<?= $item['id'] ?>">Sửa</a>
                    <a href="delete_product?product_id=<?= $item['id'] ?>">Xoá</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

<?php else : ?>
    <p>Chưa có sản phẩm nào.</p>
<?php endif; ?>

<br>
<a href="logout">Đăng xuất</a>