<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - PolyXShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #2c3e50;
            --accent-color: #ffc107;
        }
        body {
            background-color: #f8f9fa;
        }
        /* Sidebar Styles */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--primary-color);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
        }
        #sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            margin: 4px 10px;
            border-radius: 8px;
            transition: 0.3s;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: var(--accent-color) !important;
        }
        /* Main Content Styles */
        #main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }
        .admin-header {
            background: white;
            padding: 15px 30px;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <nav id="sidebar">
        <div class="p-4 text-center">
            <h4 class="fw-bold"><i class="fa-solid fa-user-shield me-2"></i>ADMIN</h4>
            <hr class="border-secondary">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="admin" class="nav-link"><i class="fa-solid fa-gauge me-2"></i> Bảng điều khiển</a>
            </li>
            <li class="nav-item">
                <a href="categories" class="nav-link"><i class="fa-solid fa-list me-2"></i> Quản lý danh mục</a>
            </li>
            <li class="nav-item">
                <a href="admin_products" class="nav-link"><i class="fa-solid fa-mobile-screen me-2"></i> Quản lý sản phẩm</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fa-solid fa-cart-shopping me-2"></i> Quản lý đơn hàng</a>
            </li>
            <li class="nav-item">
                <a href="users" class="nav-link"><i class="fa-solid fa-users me-2"></i>Quản lý khách hàng</a>
            </li>
            <hr class="border-secondary mx-3">
            <li class="nav-item">
                <a href="home" class="nav-link"><i class="fa-solid fa-arrow-left me-2"></i> Quay lại Shop</a>
            </li>
        </ul>
    </nav>

    <div id="main-content">
        <header class="admin-header">
            <h5 class="mb-0 fw-bold text-uppercase">Hệ thống quản trị PolyXShop</h5>
            <div class="d-flex align-items-center">
                <span class="me-3 small">Xin chào, <strong>Nguyễn Đình Tú</strong></span>
                <a href="logout" class="btn btn-sm btn-outline-danger rounded-pill px-3">Đăng xuất</a>
            </div>
        </header>

        <main class="card card-custom p-4">
            {{content}}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>