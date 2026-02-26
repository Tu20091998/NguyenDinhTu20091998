
<style>
    .carousel-inner img {
        border-radius: 1rem;
    }

    h1{
        text-align: center;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .product-box {
        transition: all 0.3s ease;
        background-color: #fff;
    }
    .product-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    /* Chỉnh nút Warning lúc hover cho đẹp hơn */
    .btn-warning:hover {
        background-color: #e5ac00;
        border-color: #e5ac00;
    }

    .animate-pulse {
        animation: pulse-red 2s infinite;
    }

    @keyframes pulse-red {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 15px rgba(220, 53, 69, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }
</style>
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-uppercase fw-bold"><?php echo $title; ?></h1>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/16/f0/16f0d5cdc06be79a8021d42b8a7a652f.png" class="d-block w-100" alt="Banner PolyXShop 1">
                </div>
                <div class="carousel-item">
                    <img src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/f2/11/f211d09ae538f0998ee3f33314aaa8b7.png" class="d-block w-100" alt="Banner PolyXShop 2">
                </div>
                <div class="carousel-item">
                    <img src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/b4/a2/b4a2e300d8e9a48aabafb85e7170b5de.jpg" class="d-block w-100" alt="Banner PolyXShop 3">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="container mt-5 bg-white shadow-sm rounded-4 p-4">
        <h2 class="text-center mb-4 text-uppercase fw-bold">Danh sách sản phẩm</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 rounded-3 product-box">
                            <div class="position-relative overflow-hidden">
                                <img src="/Php2/Assm2/mvc_simple/storage/product_images/<?= $product['image'] ?>" 
                                    class="card-img-top p-3" 
                                    alt="<?= $product['name'] ?>"
                                    style="height: 250px; object-fit: contain;">
                                <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2 fw-bold">NEW</span>
                            </div>

                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title fs-6 fw-bold"><?= $product['name'] ?></h5>
                                <p class="card-text text-danger fw-bold fs-5 mb-2">
                                    <?= number_format($product['price'], 0, ',', '.') ?>đ
                                </p>
                                <div class="mt-auto">
                                    <a href="product_detail?id=<?= $product['id'] ?>" class="btn btn-outline-dark btn-sm w-100 rounded-pill mb-2">
                                        <i class="fa-solid fa-eye me-1"></i> Xem chi tiết
                                    </a>

                                    <a href="add_to_cart?id=<?= $product['id'] ?>" class="btn btn-outline-dark btn-sm w-100 rounded-pill mb-2">
                                        <i class="fa-solid fa-cart-plus me-1"></i>
                                        Thêm vào giỏ
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Hiện chưa có sản phẩm nào được bày bán tại PolyXShop.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!--Cam kết-->
    <div class="container mt-5 py-4 bg-light rounded-4">
        <h2 class="text-center mb-4 fw-bold text-uppercase">Cam kết của Shop</h2>
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="p-3">
                    <i class="fa-solid fa-truck-fast fa-3x text-warning mb-3"></i>
                    <h6 class="fw-bold">Giao hàng siêu tốc</h6>
                    <p class="small text-muted">Miễn phí giao hàng nội thành Đà Nẵng trong 1h.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <i class="fa-solid fa-shield-halved fa-3x text-warning mb-3"></i>
                    <h6 class="fw-bold">Bảo hành 12 tháng</h6>
                    <p class="small text-muted">Cam kết hàng chính hãng, lỗi 1 đổi 1 trong 30 ngày.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <i class="fa-solid fa-headset fa-3x text-warning mb-3"></i>
                    <h6 class="fw-bold">Hỗ trợ 24/7</h6>
                    <p class="small text-muted">Đội ngũ kỹ thuật viên luôn sẵn sàng giải đáp thắc mắc.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <i class="fa-solid fa-hand-holding-dollar fa-3x text-warning mb-3"></i>
                    <h6 class="fw-bold">Giá cả cạnh tranh</h6>
                    <p class="small text-muted">Luôn có chương trình trả góp 0% và thu cũ đổi mới.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Đánh giá của khách hàng -->
    <div class="container mt-5 mb-5 bg-light rounded-4 p-4">
        <h2 class="text-center mb-5 text-uppercase fw-bold">Khách hàng nói về PolyXShop</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <div class="card-body">
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="card-text italic">"Tôi rất hài lòng với chiếc iPhone mua tại đây. Nhân viên tư vấn nhiệt tình, ship hàng ở Liên Chiểu cực nhanh!"</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://ui-avatars.com/api/?name=Anh+Minh&background=random" class="rounded-circle me-2" width="40" alt="User">
                            <span class="fw-bold">Anh Minh (Hòa Khánh)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 border-top border-warning border-4">
                    <div class="card-body">
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="card-text">"Giá tốt nhất khu vực Đà Nẵng. Chế độ bảo hành rõ ràng nên mình rất yên tâm khi mua tặng em trai."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://ui-avatars.com/api/?name=Chi+Yen&background=random" class="rounded-circle me-2" width="40" alt="User">
                            <span class="fw-bold">Chị Yến (Hải Châu)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <div class="card-body">
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="card-text">"Máy dùng mượt, dịch vụ thu cũ đổi mới giá cao giúp mình lên đời điện thoại tiết kiệm được rất nhiều."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://ui-avatars.com/api/?name=Quoc+Tuan&background=random" class="rounded-circle me-2" width="40" alt="User">
                            <span class="fw-bold">Quốc Tuấn (Cẩm Lệ)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Nút liên hệ nhanh -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div class="d-flex flex-column gap-2">
            <a href="https://zalo.me/0336620188" class="btn btn-primary rounded-circle p-3 shadow-lg" style="width: 60px; height: 60px;">
                <i class="fa-solid fa-comment-dots fa-xl"></i>
            </a>
            <a href="tel:0336620188" class="btn btn-danger rounded-circle p-3 shadow-lg animate-pulse" style="width: 60px; height: 60px;">
                <i class="fa-solid fa-phone-volume fa-xl"></i>
            </a>
        </div>
    </div>

    <div class="container mt-5 py-5 border-top">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0 text-center">
            <img src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/d1/02/d10256aa180524e900b52d52234a4ae4.png" 
                class="img-fluid rounded-4 shadow w-75 h-75" alt="Về PolyXShop">
        </div>
        <div class="col-md-6 ps-md-5">
            <h6 class="text-warning fw-bold text-uppercase">Về chúng tôi</h6>
            <h2 class="fw-bold mb-4">PolyXShop – Trải nghiệm công nghệ đỉnh cao tại Đà Nẵng</h2>
            <p class="text-muted">
                Được thành lập từ niềm đam mê công nghệ, <strong>PolyXShop</strong> tự hào là hệ thống bán lẻ điện thoại, máy tính bảng và phụ kiện uy tín hàng đầu. Chúng tôi không chỉ bán sản phẩm, chúng tôi trao đi sự tin tâm.
            </p>
            <ul class="list-unstyled mb-4">
                <li class="mb-2"><i class="fa-solid fa-check-double text-warning me-2"></i> Sản phẩm chính hãng, nguồn gốc rõ ràng.</li>
                <li class="mb-2"><i class="fa-solid fa-check-double text-warning me-2"></i> Đội ngũ kỹ thuật viên giàu kinh nghiệm từ FPT Polytechnic.</li>
                <li class="mb-2"><i class="fa-solid fa-check-double text-warning me-2"></i> Chính sách hậu mãi tận tâm, bảo hành nhanh chóng.</li>
            </ul>
            <a href="contact" class="btn btn-dark rounded-pill px-4 py-2 fw-bold">Tìm hiểu thêm</a>
        </div>
    </div>
</div>