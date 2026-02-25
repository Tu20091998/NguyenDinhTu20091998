<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">Trang quản trị viên</a>
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

    <main class="container py-5 flex-grow-1">
        <div class="animate__animated animate__fadeIn">
            {{content}}
        </div>
    </main>

    <footer class="bg-white py-4 border-top mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <span class="text-muted">&copy; 2026 <strong>Nguyễn Đình Tú</strong>. Built with PHP MVC.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-decoration-none text-muted me-3">Tài liệu</a>
                    <a href="#" class="text-decoration-none text-muted">Hỗ trợ</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>