<?php
    //khai báo namespace
    namespace backend\controllers;

    //nạp vào view
    use core\View;

    //nạp vào user model
    use models\UserModel;

    //khai báo class UserController
    class UserController {
        protected $userModel;

        //hàm khởi tạo
        public function __construct()
        {
            $this->userModel = new UserModel();
        }

        //hàm hiển thị trang quản lý người dùng
        public function show_user_page() {
            //khai báo biến thông báo
            $message = "";

            //xét trả về thông báo khi thay đổi trạng thái người dùng
            if(isset($_GET["status"])){
                switch($_GET["status"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Cập nhật trạng thái người dùng thành công</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-danger'>❌ Cập nhật trạng thái người dùng thất bại!</div>";
                    break;

                    case "invalid":
                        $message = "<div class='alert alert-danger'>❌ Yêu cầu không hợp lệ!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }

            $users = $this->userModel->getAllUsers();

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("backend/views");

            return View::render("UserView", [
                "users" => $users, 
                "message" => $message
            ]);
        }

        //hàm thay đổi trạng thái người dùng
        public function toggle_user_status() {
            if (isset($_GET['id']) && isset($_GET['current'])) {
                $id = $_GET['id'];
                $currentStatus = $_GET['current'];

                if ($this->userModel->toggleStatus($id, $currentStatus)) {
                    header("Location: users?status=success");
                } else {
                    header("Location: users?status=error");
                }
            } else {
                header("Location: users?status=invalid");
            }
        }

        
    }
?>