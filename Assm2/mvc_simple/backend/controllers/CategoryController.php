<?php
    //khai báo namespace
    namespace backend\controllers;

    //nap vào cart model
    use models\CategoryModel;

    //nạp vào view
    use core\View;

    class CategoryController {
        protected $categoryModel;

        //hàm khởi tạo
        public function __construct()
        {
            $this->categoryModel = new CategoryModel();
        }

        //hàm hiển thị form thêm danh mục mới
        public function show_category_page() {

            //khai báo các biến liên quan
            $message = "";
            
            //xét trả về thông báo thêm mới danh mục
            if(isset($_GET["add_category"])){
                switch($_GET["add_category"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Chèn danh mục thành công</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-error'>❌ Chèn danh mục thất bại!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }

            //xét tra về thông báo cập nhật danh mục
            if(isset($_GET["update_category"])){
                switch($_GET["update_category"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Cập nhật danh mục thành công</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-error'>❌ Cập nhật danh mục thất bại!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }

            //xét tra về thông báo xóa danh mục
            if(isset($_GET["delete_category"])){
                switch($_GET["delete_category"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Xóa danh mục thành công</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-error'>❌ Xóa danh mục thất bại!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }

            //lấy tất cả danh mục để hiển thị
            $categories = $this->categoryModel->get_all_categories();

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");

            //trả về view với dữ liệu danh mục đã lấy được
            return View::render("CategoryView", [
                "categories" => $categories,
                "message" => $message,
                "title" => "Quản lý danh mục"
            ]);
        }

        //thêm danh mục mới
        public function add_category() {
            //lấy dữ liệu từ form
            $name = $_POST["name"];
            $description = $_POST["description"];

            //gọi hàm model để thêm danh mục mới
            $result = $this->categoryModel->insert_category($name, $description);

            //xét kết quả trả về và chuyển hướng về trang quản lý danh mục với thông báo tương ứng
            if($result) {
                header("Location: categories?add_category=success");
            } else {
                header("Location: categories?add_category=error");
            }
        }

        //hàm hiển thị form chỉnh sửa danh mục
        public function edit_category() {
            //lấy id danh mục cần chỉnh sửa từ query string
            $id = $_GET["id"];

            //lấy thông tin danh mục theo id
            $category = $this->categoryModel->getCategoryById($id);

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");

            //trả về view chỉnh sửa với dữ liệu danh mục đã lấy được
            return View::render("EditCategoryView", [
                "category" => $category,
                "title" => "Chỉnh sửa danh mục"
            ]);
        }

        //hàm cập nhật danh mục
        public function update_category() {
            //lấy dữ liệu từ form
            $id = $_POST["id"];
            $name = $_POST["name"];
            $description = $_POST["description"];

            //gọi hàm model để cập nhật danh mục
            $result = $this->categoryModel->update_category($id, $name, $description);

            //xét kết quả trả về và chuyển hướng về trang quản lý danh mục với thông báo tương ứng
            if($result) {
                header("Location: categories?update_category=success");
            } else {
                header("Location: categories?update_category=error");
            }
        }

        //xóa danh mục
        public function delete_category() {
            //lấy id danh mục cần xóa từ query string
            $id = $_GET["id"];

            //gọi hàm model để xóa danh mục
            $result = $this->categoryModel->delete_category($id);

            //chuyển hướng về trang quản lý danh mục sau khi xóa
            header("Location: categories?delete_category=" . ($result ? "success" : "error"));
        }
    }
?>