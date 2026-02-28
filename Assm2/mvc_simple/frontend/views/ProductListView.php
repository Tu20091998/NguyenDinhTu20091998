<div class="container mt-5 mb-5 animate__animated animate__fadeIn">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <h2 class="fw-bold mb-4 px-2 text-uppercase">
                    <i class="fa-solid fa-layer-group text-warning me-2"></i>Danh mục
                </h2>
                <div class="list-group list-group-flush shadow-none">
                    <a href="products" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= !isset($_GET['cat']) ? 'bg-warning fw-bold' : '' ?>">
                        <i class="fa-solid fa-border-all me-2"></i> Tất cả sản phẩm
                    </a>
                    
                    <?php foreach ($categories as $cat): ?>
                        <a href="products?cat=<?= $cat['id'] ?>" 
                            class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= (isset($_GET['cat']) && $_GET['cat'] == $cat['id']) ? 'bg-warning fw-bold' : '' ?>">
                            <i class="fa-solid fa-mobile-screen-button me-2"></i> <?= $cat['name'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-dark text-white mt-4 text-center">
                <h6 class="text-warning fw-bold">ƯU ĐÃI SINH VIÊN</h6>
                <p class="small mb-0">Giảm ngay 500k cho tân sinh viên FPT Polytechnic!</p>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                <h2 class="fw-bold text-dark mb-0 text-uppercase"><i class="fa-solid fa-list me-2 text-warning"></i>Danh sách sản phẩm</h2>
                <!--đếm số sản phẩm-->
                <span class="badge bg-warning text-dark rounded-pill">Hiện đang có <?= count($products) ?> sản phẩm</span>
            </div>

            <div class="row g-4">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="card h-100 border-0 shadow-sm rounded-4 product-card overflow-hidden">
                                <div class="position-relative">
                                    <img src="storage/product_images/<?= $product['image'] ?>" 
                                        class="card-img-top p-3" alt="<?= $product['name'] ?>" 
                                        style="height: 200px; object-fit: contain;">
                                    <span class="badge bg-danger position-absolute top-0 end-0 m-3 rounded-pill">Hot</span>
                                </div>
                                <div class="card-body text-center p-4">
                                    <h5 class="card-title fw-bold text-dark mb-2"><?= $product['name'] ?></h5>
                                    <p class="text-danger fw-bold fs-5 mb-3"><?= number_format($product['price'], 0, ',', '.') ?>đ</p>
                                    <div class="d-grid gap-2">
                                        <a href="product_detail?id=<?= $product['id'] ?>" class="btn btn-outline-dark rounded-pill btn-sm fw-bold">Chi tiết</a>
                                        <a href="add_to_cart?id=<?= $product['id'] ?>" class="btn btn-warning rounded-pill btn-sm fw-bold shadow-sm">Thêm vào giỏ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="100" class="mb-3 opacity-50">
                        <p class="text-muted">Hiện chưa có sản phẩm nào thuộc danh mục này.</p>
                    </div>
                <?php endif; ?>

                <div class="col-12 mt-5">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center border-0">
                            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link rounded-circle me-2 border-0 shadow-sm" href="?page=<?= $currentPage - 1 ?><?= isset($_GET['cat']) ? '&cat='.$_GET['cat'] : '' ?>">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </a>
                            </li>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($currentPage == $i) ? 'active' : '' ?>">
                                    <a class="page-link rounded-circle me-2 border-0 shadow-sm <?= ($currentPage == $i) ? 'bg-warning text-dark fw-bold' : 'text-dark' ?>" 
                                        href="?page=<?= $i ?><?= isset($_GET['cat']) ? '&cat='.$_GET['cat'] : '' ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            
                            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link rounded-circle border-0 shadow-sm" href="?page=<?= $currentPage + 1 ?><?= isset($_GET['cat']) ? '&cat='.$_GET['cat'] : '' ?>">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .product-card { transition: all 0.3s ease; }
    .product-card:hover { transform: translateY(-10px); box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important; }
    .list-group-item-action:hover { background-color: #fff3cd; }
</style>