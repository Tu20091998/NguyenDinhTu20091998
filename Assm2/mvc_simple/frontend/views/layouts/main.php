<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
    <style>
        /* Hiệu ứng hover cho link */
        .nav-link {
            transition: color 0.3s ease;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #ffc107 !important; /* Màu vàng cảnh báo của Bootstrap */
        }
        /* Làm mượt thanh navbar khi cuộn */
        .sticky-top {
            z-index: 1020;
        }
    </style>
<body>
    <!-- Header với navbar -->
    <header class="sticky-top shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="home">
                    <i class="fa-solid fa-mobile-screen-button text-warning me-2"></i>
                    <span class="text-white text-uppercase">Poly</span><span class="text-warning text-uppercase">X</span><span class="text-uppercase">Shop</span>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu điều hướng -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Form tìm kiếm -->
                    <form class="d-flex mx-auto my-2 my-lg-0 col-lg-5" action="search" method="GET">
                        <div class="input-group">
                            <input class="form-control border-0 rounded-start-pill ps-4" type="search" name="keyword" 
                                placeholder="Tìm iPhone, Samsung..." aria-label="Search">
                            <button class="btn btn-warning rounded-end-pill px-4" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>

                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link px-3 active" href="cart"><i class="fa-solid fa-cart-shopping me-1"></i> Giỏ hàng</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link px-3 active" href="home"><i class="fa-solid fa-house me-1"></i> Trang chủ</a>
                        </li>

                        <div class="d-none d-lg-block border-start border-secondary mx-2" style="height: 20px;"></div>

                        <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle fw-bold text-warning" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Chào <?= $_SESSION['user']['firstname'] ?> </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="profile"><i class="fa-solid fa-id-card me-2"></i>Thông tin cá nhân</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                            <div class="d-flex gap-2">
                                <a href="login" class="btn btn-outline-warning btn-sm px-3 rounded-pill">Đăng nhập</a>
                                <a href="register" class="btn btn-warning btn-sm px-3 rounded-pill fw-bold">Đăng ký</a>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Nội dung chính -->
    <main class="container py-5">
        {{content}}
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 border-top mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h2 class="text-uppercase fw-bold mb-4 text-warning">
                        <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="home">
                            <i class="fa-solid fa-mobile-screen-button text-warning me-2"></i>
                            <span class="text-white">Poly</span><span class="text-warning">X</span><span>Shop</span>
                        </a>
                    </h2>
                    <p class="small text-secondary">
                        Hệ thống bán lẻ điện thoại di động, phụ kiện chính hãng tại Đà Nẵng. 
                        Cam kết chất lượng và dịch vụ bảo hành tốt nhất cho khách hàng.
                    </p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-tiktok fa-lg"></i></a>
                        <a href="admin"><i class="fa-solid fa-user-gear me-1"></i> Quản trị</a>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="text-uppercase fw-bold mb-4">Hỗ trợ khách hàng</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Chính sách bảo hành</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Trả góp 0% lãi suất</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Giao hàng tận nơi</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Chính sách đổi trả</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="text-uppercase fw-bold mb-4">Liên kết nhanh</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">iPhone chính hãng</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Samsung Galaxy</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Phụ kiện giá rẻ</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Tin công nghệ</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h6 class="text-uppercase fw-bold mb-4">Thông tin liên hệ</h6>
                    <p class="small text-secondary mb-2">
                        <i class="fas fa-map-marker-alt me-2 text-warning"></i> Quận Liên Chiểu, TP. Đà Nẵng
                    </p>
                    <p class="small text-secondary mb-2">
                        <i class="fas fa-phone-alt me-2 text-warning"></i> Hotline: 0336 620 188
                    </p>
                    <p class="small text-secondary mb-2">
                        <i class="fas fa-envelope me-2 text-warning"></i> Email: support@polyxshop.site
                    </p>
                    <div class="mt-3">
                        <p class="small fw-bold mb-2 text-uppercase">Chấp nhận thanh toán</p>
                        <img src="https://img.vietqr.io/image/970422-000000000-compact.jpg" alt="Visa" style="height: 25px; filter: grayscale(1);">
                        <img src="https://img.vietqr.io/image/970422-000000000-compact.jpg" alt="MoMo" class="ms-2" style="height: 25px; filter: grayscale(1);">
                    </div>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0 text-secondary">&copy; 2026 PolyXShop. Thiết kế bởi Nguyễn Đình Tú.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <span class="small text-secondary">Đồ án Web Programming - FPT Polytechnic</span>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>