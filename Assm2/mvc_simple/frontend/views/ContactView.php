<div class="container mt-5 mb-5 animate__animated animate__fadeIn">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-5 bg-dark text-white p-5 d-flex flex-column justify-content-between">
                        <div>
                            <h2 class="fw-bold text-warning mb-4 text-uppercase">Trang liên hệ</h2>
                            <p class="opacity-75 mb-5">Bạn cần tư vấn về iPhone, Samsung hay chính sách bảo hành tại Đà Nẵng? Đừng ngần ngại để lại lời nhắn!</p>
                            
                            <div class="contact-info">
                                <div class="d-flex align-items-start mb-4">
                                    <div class="icon-box bg-warning text-dark rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">Địa chỉ:</h6>
                                        <small class="text-white">759/15B Trần Cao Vân, Thanh Khê, Đà Nẵng</small>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start mb-4">
                                    <div class="icon-box bg-warning text-dark rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">Hotline:</h6>
                                        <small class="text-white">0338 620 188 (Hỗ trợ 24/7)</small>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start mb-4">
                                    <div class="icon-box bg-warning text-dark rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">Email:</h6>
                                        <small class="text-white">dinhtu20091998@gmail.com</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="social-links d-flex gap-3 mt-4">
                            <a href="#" class="btn btn-outline-warning btn-sm rounded-circle"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-warning btn-sm rounded-circle"><i class="fa-brands fa-zalo">Z</i></a>
                            <a href="#" class="btn btn-outline-warning btn-sm rounded-circle"><i class="fa-brands fa-tiktok"></i></a>
                        </div>
                    </div>

                    <div class="col-md-7 bg-white p-5">
                        <h4 class="fw-bold text-dark mb-4">Gửi lời nhắn cho chúng tôi</h4>
                        
                        <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 animate__animated animate__shakeX">
                                <i class="fa-solid fa-circle-check me-2"></i> Gửi lời nhắn thành công! Tú sẽ check mail ngay.
                            </div>
                        <?php endif; ?>

                        <form action="send_contact" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Họ và Tên</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="fa-solid fa-user text-warning"></i></span>
                                        <input type="text" name="name" class="form-control border-0 bg-light rounded-end-3" placeholder="Nguyễn Văn A" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-muted">Địa chỉ Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="fa-solid fa-envelope text-warning"></i></span>
                                        <input type="email" name="email" class="form-control border-0 bg-light rounded-end-3" placeholder="email@example.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Chủ đề cần hỗ trợ</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fa-solid fa-pen-nib text-warning"></i></span>
                                    <input type="text" name="subject" class="form-control border-0 bg-light rounded-end-3" placeholder="Ví dụ: Tư vấn mua iPhone 16" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">Nội dung chi tiết</label>
                                <textarea name="message" class="form-control border-0 bg-light rounded-3" rows="4" placeholder="Nhập lời nhắn của bạn tại đây..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill py-3 shadow-sm text-uppercase tracking-wider">
                                <i class="fa-solid fa-paper-plane me-2"></i> Gửi lời nhắn ngay
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.2);
        border: 1px solid #ffc107 !important;
    }
    .input-group-text {
        font-size: 0.9rem;
    }
    .tracking-wider {
        letter-spacing: 1px;
    }
    .icon-box {
        transition: transform 0.3s ease;
    }
    .card:hover .icon-box {
        transform: scale(1.1);
    }
</style>