<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">Trang người dùng</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="upload">Upload</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register">Đăng ký</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin">Trang quản trị</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-5">
        {{content}}
    </main>

    <footer class="bg-light py-4 border-top">
        <div class="container text-center">
            <p class="mb-1">Chào mừng bạn đến với trang người dùng</p>
            <div class="footer-links">
                <a href="#" class="text-decoration-none text-muted mx-2">Giới thiệu</a>
                <span class="text-muted">|</span>
                <a href="#" class="text-decoration-none text-muted mx-2">Liên hệ</a>
                <span class="text-muted">|</span>
                <a href="#" class="text-decoration-none text-muted mx-2">Chính sách</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>