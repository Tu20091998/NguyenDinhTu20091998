<?php
    //khai báo namespace
    namespace backend\controllers;

    //nạp vào product model
    use models\ProductModel;

    //nap vào cart model
    use models\CategoryModel;

    //nạp vào view
    use core\View;

    //khai báo đường dẫn đến thư mục storage
    define("STORAGE_PATH", __DIR__ . "/../../storage/product_images/");

    class ProductController {
        protected $productModel;

        protected $categoryModel;

        //hàm khởi tạo
        public function __construct()
        {
            $this->productModel = new ProductModel();
            $this->categoryModel = new CategoryModel();
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

                    default:
                        $message = "";
                    break;
                }
            }

            //xét thông báo cập nhật hoặc xóa sản phẩm
            if(isset($_GET["status"])){
                switch($_GET["status"]){
                    case "update_success":
                        $message = "<div class='alert alert-success'>✅ Cập nhật sản phẩm thành công</div>";
                    break;

                    case "update_error":
                        $message = "<div class='alert alert-error'>❌ Cập nhật sản phẩm thất bại!</div>";
                    break;

                    case "delete_success":
                        $message = "<div class='alert alert-success'>✅ Xóa sản phẩm thành công</div>";
                    break;

                    case "delete_error":
                        $message = "<div class='alert alert-error'>❌ Xóa sản phẩm thất bại!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");
            
            //lấy danh sách sản phẩm để hiển thị
            $products = $this->productModel->get_all_products();

            //lấy danh mục để hiển thị
            $categories = $this->categoryModel->get_all_categories();

            return View::render("ProductView", [
                "title" => "Quản lý sản phẩm",
                "message" => $message,
                "products" => $products,
                "categories" => $categories
            ]);
        }

        //hàm xử lý thêm sản phẩm mới vào database
        public function add_product() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Xử lý dữ liệu từ form
                $name = $_POST['name'];
                $price = $_POST['price'];
                $description = $_POST['description'];
                $category_id = $_POST['category_id'];

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
                            'description' => $description,
                            'category_id' => $category_id
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

        // tạo hàm hiển thị chi tiết sản phẩm
        public function product_detail() {
            //kiểm tra nếu id sản phẩm được truyền qua GET
            if(isset($_GET["id"])){
                $id = $_GET["id"];

                //lấy thông tin sản phẩm từ model
                $product = $this->productModel->getProductById($id);

                //nếu sản phẩm tồn tại, hiển thị chi tiết sản phẩm
                if($product){
                    View::setBaseDir("frontend/views");

                    return View::render("ProductDetail", ["product" => $product]);
                } else {
                    echo "Sản phẩm không tồn tại!";
                }
            } else {
                echo "ID sản phẩm không hợp lệ!";
            }
        }

        // Trong ProductController.php
        public function edit_product() {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: /Php2/Assm2/mvc_simple/products");
                exit;
            }
            
            //lấy thông tin sản phẩm từ model
            $product = $this->productModel->getProductById($id);

            //lấy danh mục để hiển thị
            $categories = $this->categoryModel->get_all_categories();

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");
            
            //trả về view chỉnh sửa sản phẩm với dữ liệu sản phẩm đã lấy được
            return View::render("EditProductView", [
                "product" => $product,
                "categories" => $categories,
                "title" => "Chỉnh sửa sản phẩm"
            ]);
        }

        public function update_product() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $description = $_POST['description'];
                $category_id = $_POST['category_id'];

                // Lấy tên ảnh cũ từ DB để phòng trường hợp không đổi ảnh
                $oldProduct = $this->productModel->getProductById($id);
                $imageName = $oldProduct['image'];

                // Nếu người dùng chọn ảnh mới
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $imageName = time() . "_" . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], STORAGE_PATH . $imageName);

                    // Xóa ảnh cũ trong thư mục storage để sạch máy
                    if (file_exists(STORAGE_PATH . $oldProduct['image'])) {
                        unlink(STORAGE_PATH . $oldProduct['image']);
                    }
                }

                $data = [
                    'id' => $id,
                    'name' => $name,
                    'price' => $price,
                    'image' => $imageName,
                    'description' => $description,
                    'category_id' => $category_id
                ];

                if ($this->productModel->update_product($data)) {
                    header("Location: /Php2/Assm2/mvc_simple/products?status=update_success");
                } else {
                    header("Location: /Php2/Assm2/mvc_simple/products?status=update_error");
                }
                exit;
            }
        }

        // tạo hàm xóa sản phẩm
        public function delete_product() {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: /Php2/Assm2/mvc_simple/products");
                exit;
            }

            if ($this->productModel->delete_product($id)) {
                header("Location: /Php2/Assm2/mvc_simple/products?status=delete_success");
            } else {
                header("Location: /Php2/Assm2/mvc_simple/products?status=delete_error");
            }
            exit;
        }
    }
?>