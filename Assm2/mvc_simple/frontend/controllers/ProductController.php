<?php
    //khai báo namespace
    namespace frontend\controllers;

    //nạp vào product model
    use models\ProductModel;

    //nap vào cart model
    use models\CategoryModel;

    //nạp vào review model
    use models\ReviewModel;

    //nạp vào view
    use core\View;

    //tạo class ProductController
    class ProductController {
        protected $productModel;

        protected $categoryModel;

        protected $reviewModel;

        //hàm khởi tạo
        public function __construct()
        {
            $this->productModel = new ProductModel();
            $this->categoryModel = new CategoryModel();
            $this->reviewModel = new ReviewModel();
        }

        public function show_product_list() {

            // Cấu hình các tham số phân trang
            $limit = 6; // Số sản phẩm hiển thị trên mỗi trang
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
            if ($page < 1) $page = 1; 
            $offset = ($page - 1) * $limit; // Vị trí bắt đầu lấy dữ liệu

            // Nhận id danh mục và từ khóa tìm kiếm
            $category_id = isset($_GET['cat']) ? $_GET['cat'] : null;
            $search_query = isset($_GET['keyword']) ? $_GET['keyword'] : null;

            // Gọi hàm lấy sản phẩm có phân trang từ Model
            $products = $this->productModel->getProductsPaged($category_id, $search_query, $offset, $limit);

            // Tính toán tổng số trang
            $totalProducts = $this->productModel->countTotalProducts($category_id, $search_query);
            $totalPages = ceil($totalProducts / $limit);

            // Lấy danh sách danh mục
            $categories = $this->categoryModel->get_all_categories();

            // Truyền thêm dữ liệu phân trang sang view
            return View::render("ProductListView", [
                "products" => $products,
                "categories" => $categories,
                "totalPages" => $totalPages,   // Tổng số trang
                "currentPage" => $page,        // Trang hiện tại để active nút
                "category_id" => $category_id, // Giữ lại danh mục khi chuyển trang
                "keyword" => $search_query     // Giữ lại từ khóa khi chuyển trang
            ]);
        }

        // tạo hàm hiển thị chi tiết sản phẩm
        public function product_detail() {
            //khai báo biến thông báo
            $message = "";

            //kiểm tra nếu id sản phẩm được truyền qua GET
            if(isset($_GET["id"])){
                $id = $_GET["id"];

                //lấy thông tin sản phẩm từ model
                $product = $this->productModel->getProductById($id);

                //lấy bình luận của sản phẩm từ model
                $reviews = $this->reviewModel->getReviewsByProduct($id);

                //nếu sản phẩm tồn tại, hiển thị chi tiết sản phẩm
                if($product){
                    //bắt hiên thị thông báo nếu có
                    if(isset($_GET['message'])){
                        switch($_GET['message']){
                            case "review_added":
                                $message = "Cảm ơn bạn đã đánh giá sản phẩm!";
                                break;
                            default:
                                $message = "";
                        }
                    }

                    View::setBaseDir("frontend/views");

                    return View::render("ProductDetail", [
                        "product" => $product, 
                        "reviews" => $reviews,
                        "message" => $message
                    ]);
                } else {
                    echo "Sản phẩm không tồn tại!";
                }
            } else {
                echo "ID sản phẩm không hợp lệ!";
            }
        }

        //hàm thêm bình luận cho sản phẩm
        public function add_review() {
            //kiểm tra nếu người dùng đã đăng nhập
            if(!isset($_SESSION['user'])){
                header("Location: login");
                exit();
            }

            //kiểm tra nếu có dữ liệu POST gửi lên
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $userId = $_SESSION['user']['id'];
                $productId = $_POST['product_id'];
                $rating = $_POST['rating'];
                $comment = $_POST['comment'];

                //gọi model để thêm bình luận vào cơ sở dữ liệu
                $this->reviewModel->addReview($productId, $userId, $rating, $comment);

                //quay lại trang chi tiết sản phẩm sau khi thêm bình luận
                header("Location: product_detail?id=" . $productId . "&message=review_added");
            }
        }

    }
?>