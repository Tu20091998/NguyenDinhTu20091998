<div class="container mt-5 mb-5 animate__animated animate__fadeIn">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-uppercase mb-0"><i class="fas fa-file-invoice me-2 text-warning"></i>Chi tiết đơn hàng #<?= $order['id'] ?></h3>
                <a href="orders" class="btn btn-outline-dark rounded-pill btn-sm">Quay lại danh sách</a>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Thông tin nhận hàng</h5>
                        <p class="mb-1"><strong>Người nhận:</strong> <?= $order['full_name'] ?></p>
                        <p class="mb-1"><strong>Điện thoại:</strong> <?= $order['phone'] ?></p>
                        <p class="mb-0"><strong>Địa chỉ:</strong> <?= $order['address'] ?></p>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <table class="table align-middle mb-0">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="ps-4 py-3">Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end pe-4">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['items'] as $item): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <img src="/Php2/Assm2/mvc_simple/storage/product_images/<?= $item['image'] ?>" 
                                                    width="50" class="rounded border me-3">
                                                <span class="fw-bold small"><?= $item['name'] ?></span>
                                            </div>
                                        </td>
                                        <td class="text-center"><?= $item['quantity'] ?></td>
                                        <td class="text-end pe-4 fw-bold">
                                            <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td colspan="2" class="text-end fw-bold py-3">TỔNG CỘNG:</td>
                                    <td class="text-end pe-4 fs-5 fw-bold text-danger">
                                        <?= number_format($order['total_amount'], 0, ',', '.') ?>đ
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>