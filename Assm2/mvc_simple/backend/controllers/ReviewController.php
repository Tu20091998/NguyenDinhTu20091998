<?php
    //khai báo namespace
    namespace backend\controllers;

    //nạp vào view
    use core\View;

    //nạp vào review model
    use models\ReviewModel;

    //khai báo class ReviewController
    class ReviewController {
        protected $reviewModel;

        //hàm khởi tạo
        public function __construct()
        {
            $this->reviewModel = new ReviewModel();
        }

        //hàm hiển thị trang quản lý đánh giá
        public function show_reviews_page() {
            //khai báo biến thông báo
            $message = "";

            //xét trả về thông báo khi thay đổi trạng thái người dùng
            if(isset($_GET["status"])){
                switch($_GET["status"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Cập nhật trạng thái đánh giá thành công</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-danger'>❌ Cập nhật trạng thái đánh giá thất bại!</div>";
                    break;

                    case "invalid":
                        $message = "<div class='alert alert-danger'>❌ Yêu cầu không hợp lệ!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }

            //lấy đánh giá để lọc
            $rating = $_GET['rating'] ?? null;
            
            //lấy đánh giá đã lọc
            $reviews = $this->reviewModel->getReviewsPaged($rating);

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");

            return View::render("AdminReviewView", [
                "reviews" => $reviews, 
                "message" => $message
            ]);
        }

        //hàm thay đổi trạng thái hiển thị của đánh giá
        public function toggle_review_status() {
            if(!isset($_GET['id']) || !isset($_GET['status'])) {
                header("Location: admin_reviews?status=invalid");
                exit();
            }

            $reviewId = $_GET['id'];
            $newStatus = $_GET['status'];

            // Kiểm tra giá trị status hợp lệ
            if(!in_array($newStatus, ['0', '1'])) {
                header("Location: admin_reviews?status=invalid");
                exit();
            }

            $result = $this->reviewModel->toggleStatus($reviewId, $newStatus);

            if($result) {
                header("Location: admin_reviews?status=success");
            } else {
                header("Location: admin_reviews?status=error");
            }
            exit();
        }
    }
?>