<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>
<style>
    .carousel-inner img {
        border-radius: 1rem;
    }

    h1{
        text-align: center;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
</style>
<body>
    <h1 class="text-uppercase"><?php echo $title; ?></h1>
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

    <div class="container mt-5">
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
                                <span class="position-absolute top-0 start-0 badge bg-danger m-2">Mới</span>
                            </div>

                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title fs-6 fw-bold"><?= $product['name'] ?></h5>
                                <p class="card-text text-danger fw-bold fs-5 mb-2">
                                    <?= number_format($product['price'], 0, ',', '.') ?>đ
                                </p>
                                <div class="mt-auto">
                                    <a href="product_detail?id=<?= $product['id'] ?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Xem chi tiết</a>
                                    <button class="btn btn-primary btn-sm w-100 mt-2 rounded-pill">Thêm vào giỏ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>Hiện chưa có sản phẩm nào được bày bán.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>