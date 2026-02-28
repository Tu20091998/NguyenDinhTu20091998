<div class="container mt-5 mb-5 animate__animated animate__fadeIn">
    <h2 class="fw-bold text-uppercase mb-4"><i class="fa-solid fa-cart-shopping text-warning me-2"></i>Giỏ hàng của bạn</h2>
    <p><?= $message ?></p>
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <table class="table align-middle mb-0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="ps-4">Sản phẩm</th>
                            <th>Giá</th>
                            <th style="width: 150px;">Số lượng</th>
                            <th>Tổng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalBill = 0;
                        if (!empty($cartItems)): 
                            foreach ($cartItems as $item): 
                                $subTotal = $item['price'] * $item['quantity'];
                                $totalBill += $subTotal;
                        ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="/Php2/Assm2/mvc_simple/storage/product_images/<?= $item['image'] ?>" 
                                        width="60" class="rounded-3 me-3 border">
                                    <span class="fw-bold"><?= $item['name'] ?></span>
                                </div>
                            </td>
                            <td class="text-danger fw-bold"><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                            <td>
                                <span  class="form-control form-control-sm rounded-pill text-center" 
                                    style="width: 80px; margin: auto;">
                                    <?= $item['quantity'] ?>
                                </span>
                            </td>
                            <td class="fw-bold"><?= number_format($subTotal, 0, ',', '.') ?>đ</td>
                            
                            <td>
                                <a href="remove_cart?id=<?= isset($item['cart_id']) ? $item['cart_id'] : '' ?>" 
                                    class="btn btn-sm btn-outline-danger" 
                                    onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?')">
                                    <i class="fa-solid fa-trash-can"></i> Xóa
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <p class="text-muted">Giỏ hàng trống. <a href="home" class="text-warning fw-bold">Mua sắm ngay!</a></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h5 class="fw-bold mb-4">Tóm tắt đơn hàng</h5>
                <!--Hiển thị tên sản phẩm và giá trong tóm tắt đơn hàng-->
                <?php foreach ($cartItems as $item): ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span><?= $item['name'] ?></span>
                        <span class="fw-bold"><?= number_format($item['price'], 0, ',', '.') ?>đ</span>
                    </div>
                <?php endforeach; ?>

                <div class="d-flex justify-content-between mb-3">
                    <span>Tạm tính:</span>
                    <span class="fw-bold"><?= number_format($totalBill, 0, ',', '.') ?>đ</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Phí vận chuyển:</span>
                    <span class="text-success fw-bold">Miễn phí</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="fs-5 fw-bold">Tổng cộng:</span>
                    <span class="fs-4 fw-bold text-danger"><?= number_format($totalBill, 0, ',', '.') ?>đ</span>
                </div>
                <a href="checkout" class="btn btn-warning w-100 fw-bold rounded-pill py-3 shadow-sm text-uppercase">
                    Tiến hành đặt hàng
                </a>
            </div>
        </div>
    </div>
</div>