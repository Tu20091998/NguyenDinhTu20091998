<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ Admin</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container">
        <h2>Trang Admin</h2>
        <?php
            $message = "";

            if(isset($_GET["status"])){
                switch($_GET["status"]){
                    case "login_success":
                        $message = "<div>✅ Đăng nhập thành công, Chào mừng bạn đến với trang Admin !</div><br>";
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

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $item) : ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                        <td>
                            <a class="action-btn edit" href="edit_product?product_id=<?= $item['id'] ?>">Sửa</a>
                            <a class="action-btn delete" href="delete_product?product_id=<?= $item['id'] ?>">Xoá</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Chưa có sản phẩm nào.</p>
        <?php endif; ?>

        <br>
        <a href="admin_logout" class="logout-btn">Đăng xuất</a>
    </div>
</body>
</html>

