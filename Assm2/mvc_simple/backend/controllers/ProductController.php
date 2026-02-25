<?php
    //khai báo namespace
    namespace backend\controllers;

    //nạp vào product model
    use models\ProductModel;

    //nạp vào view
    use core\View;

    //khai báo đường dẫn đến thư mục storage
    define("STORAGE_PATH", __DIR__ . "/../../storage/product_images/");

    class ProductController {
        protected $productModel;

        //hàm khởi tạo
        public function __construct()
        {
            $this->productModel = new ProductModel();
        }

        //hàm hiển thị form thêm sản phẩm mới
        public function show_product_page() {

            //khai báo các biến liên quan
            $message = "";
            
            //xét trả về thông báo
            if(isset($_GET["add_product"])){
                switch($_GET["add_product"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Chèn sản phẩm thành công</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-error'>❌ Chèn sản phẩm thất bại!</div>";
                    break;

                    case "invalid_image":
                        $message = "<div class='alert alert-error'>❌ Ảnh không hợp lệ. </div>";
                    break;
                }
            }
            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");
            
            //lấy danh sách sản phẩm để hiển thị
            $products = $this->productModel->get_all_products();

            return View::render("ProductView", [
                "title" => "Quản lý sản phẩm",
                "message" => $message,
                "products" => $products
            ]);
        }

        //hàm xử lý thêm sản phẩm mới vào database
        public function add_product() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Xử lý dữ liệu từ form
                $name = $_POST['name'];
                $price = $_POST['price'];
                $description = $_POST['description'];

                // Xử lý file ảnh
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $imageTmpPath = $_FILES['image']['tmp_name'];
                    $imageName = basename($_FILES['image']['name']);
                    $storageDir = STORAGE_PATH;

                    $imagePath = $storageDir . $imageName;

                    // Di chuyển file ảnh vào thư mục storage
                    if (move_uploaded_file($imageTmpPath, $imagePath)) {
                        // Lưu thông tin sản phẩm vào database
                        $data = [
                            'name' => $name,
                            'price' => $price,
                            'image' => $imageName, // Lưu đường dẫn tương đối
                            'description' => $description
                        ];

                        if ($this->productModel->insert_product($data)) {
                            header("Location: /Php2/Assm2/mvc_simple/products?add_product=success");
                            exit;
                        } else {
                            header("Location: /Php2/Assm2/mvc_simple/products?add_product=error");
                            exit;
                        }
                    } else {
                        header("Location: /Php2/Assm2/mvc_simple/products?add_product=invalid_image");
                        exit;
                    }
                } else {
                    header("Location: /Php2/Assm2/mvc_simple/products?add_product=invalid_image");
                    exit;
                }
            }
        }
    }
?>