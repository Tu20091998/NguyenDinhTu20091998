<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 text-center">
                <div class="mb-4">
                    <i class="bi bi-cloud-arrow-up-fill text-primary" style="font-size: 3rem;"></i>
                    <h2 class="fw-bold mt-2">Tải tệp lên</h2>
                    <p class="text-muted">Chọn tệp hình ảnh hoặc tài liệu để tải lên hệ thống</p>
                </div>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-info alert-dismissible fade show text-start" role="alert">
                        <?= $message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="upload" enctype="multipart/form-data">
                    <div class="mb-4 text-start">
                        <label for="receipt" class="form-label fw-semibold">Chọn file của bạn:</label>
                        <input type="file" class="form-control" name="receipt" id="receipt" required>
                        <div class="form-text">Dung lượng tối đa: 5MB (JPG, PNG, PDF).</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                            Bắt đầu tải lên
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>