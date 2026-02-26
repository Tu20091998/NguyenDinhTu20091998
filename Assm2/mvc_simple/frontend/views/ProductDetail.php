<div class="container mt-5 mb-5">
    <nav aria-label="breadcrumb">
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
                <button class="btn btn-primary btn-lg px-5 rounded-pill">MUA NGAY</button>
                <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Thêm vào giỏ</button>
            </div>
            
            <hr class="my-4">
            <p><i class="fas fa-check-circle text-success"></i> Hàng chính hãng 100%</p>
            <p><i class="fas fa-truck text-primary"></i> Giao hàng miễn phí tại Đà Nẵng</p>
        </div>
    </div>
</div>