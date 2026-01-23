<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tra cứu sản phẩm</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
        }
        .container {
            width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        input {
            padding: 10px;
            width: 75%;
        }
        button {
            padding: 10px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .error {
            color: red;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tra cứu sản phẩm</h2>

    <form method="get" id="searchForm">
        <input type="text"
            name="keyword"
            placeholder="Nhập tên sản phẩm..."
            value="<?= $_GET['keyword'] ?? '' ?>"
            oninput="debounceSearch()" required>
        <button type="submit">Tìm kiếm</button>
    </form>

    <?php if (!empty($products)): ?>
        <table>
            <tr>
                <th>Tên</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
            </tr>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= $p['name'] ?></td>
                    <td><?= number_format($p['price']) ?> VNĐ</td>
                    <td><img src="<?= $p['image'] ?>" alt="<?= $p['name'] ?>" width="100"></td>
                    <td><?= $p['description'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($message): ?>
        <p class="error"><?= $message ?></p>
    <?php endif; ?>
</div>

<script>
    let timeout = null;

    function debounceSearch() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 1500); // Gửi form sau 1.5s khi người dùng ngừng gõ
    }
</script>

</body>
</html>
