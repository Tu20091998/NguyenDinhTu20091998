<div class="container mt-3 mb-5">
    <nav aria-label="breadcrumb">
        <!--hiển thị thông báo nếu có-->
        <?php if (!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home">Trang chủ</a></li>
            <li class="breadcrumb-item active"><?= $product['name'] ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6 text-center">
            <div class="card shadow-sm p-4">
                <img src="/Php2/Assm2/mvc_simple/storage/product_images/<?= $product['image'] ?>" 
                    class="img-fluid rounded" 
                    alt="<?= $product['name'] ?>"
                    style="max-height: 500px; object-fit: contain;">
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="fw-bold mb-3"><?= $product['name'] ?></h1>
            <h3 class="text-danger fw-bold mb-4">
                <?= number_format($product['price'], 0, ',', '.') ?> VNĐ
            </h3>
            
            <div class="mb-4">
                <h5><strong>Mô tả sản phẩm:</strong></h5>
                <p class="text-muted" style="line-height: 1.8;">
                    <?= nl2br($product['description']) ?>
                </p>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="/Php2/Assm2/mvc_simple/add_to_cart?id=<?= $product['id'] ?>" class="btn btn-outline-none btn-lg px-4 rounded-pill bg-warning text-white ">
                    Thêm vào giỏ hàng ngay
                </a>
            </div>
            
            <hr class="my-4">
            <p><i class="fas fa-check-circle text-success"></i> Hàng chính hãng 100%</p>
            <p><i class="fas fa-truck text-primary"></i> Giao hàng miễn phí tại Đà Nẵng</p>
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        <div class="col-md-5 mb-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Viết đánh giá của bạn</h4>
                
                <?php if (isset($_SESSION['user'])): ?>
                    <form action="add_review" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Chọn số sao:</label>
                            <select name="rating" class="form-select rounded-pill border-0 bg-light" required>
                                <option value="5">⭐⭐⭐⭐⭐ (5 sao - Tuyệt vời)</option>
                                <option value="4">⭐⭐⭐⭐ (4 sao - Tốt)</option>
                                <option value="3">⭐⭐⭐ (3 sao - Bình thường)</option>
                                <option value="2">⭐⭐ (2 sao - Kém)</option>
                                <option value="1">⭐ (1 sao - Rất tệ)</option>
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nội dung bình luận:</label>
                            <textarea name="comment" class="form-control rounded-4 border-0 bg-light" rows="4" placeholder="Chia sẻ cảm nhận của bạn về chiếc máy này..." required></textarea>
                        </div>
                
                        <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill shadow-sm">
                            GỬI ĐÁNH GIÁ NGAY
                        </button>
                    </form>
                <?php else: ?>
                    <div class="text-center py-4">
                        <p class="text-muted">Vui lòng đăng nhập để có thể bình luận về sản phẩm.</p>
                        <a href="login" class="btn btn-outline-warning rounded-pill px-4">Đăng nhập ngay</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
                
        <div class="col-md-7">
            <h4 class="fw-bold mb-4">Khách hàng nói gì về <?= $product['name'] ?></h4>
                
            <div class="review-list" style="max-height: 500px; overflow-y: auto;">
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="card border-0 shadow-sm rounded-4 p-3 mb-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-dark">
                                    <i class="fa-solid fa-circle-user text-secondary me-2"></i>
                                    <?= $review['lastname'] ?> <?= $review['firstname'] ?>
                                </span>
                                <small class="text-muted"><?= date('d/m/Y', strtotime($review['created_at'])) ?></small>
                            </div>
                            <div class="text-warning mb-2">
                                <?= str_repeat('<i class="fa-solid fa-star"></i>', $review['rating']) ?>
                            </div>
                            <p class="mb-0 text-muted small italic">"<?= $review['comment'] ?>"</p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-5 bg-light rounded-4">
                        <i class="fa-regular fa-comments fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>