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

        //hàm hiển thị trang thông tin cá nhân
        public function profile() {
            //khai báo biến thông báo
            $message = "";

            //xét trả về thông báo khi cập nhật thông tin cá nhân
            if(isset($_GET["update"])){
                switch($_GET["update"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Cập nhật thông tin cá nhân thành công!</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-danger'>❌ Cập nhật thông tin cá nhân thất bại!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }
            
            //xét trả về thông báo khi cập nhật mật khẩu
            if(isset($_GET["password"])){
                switch($_GET["password"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Đổi mật khẩu thành công!</div>";
                    break;

                    case "error_old":
                        $message = "<div class='alert alert-danger'>❌ Mật khẩu cũ không đúng!</div>";
                    break;

                    case "error_confirm":
                        $message = "<div class='alert alert-danger'>❌ Mật khẩu xác nhận không khớp!</div>";
                    break;

                    case "error_update":
                        $message = "<div class='alert alert-danger'>❌ Đổi mật khẩu thất bại!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }

             //xét trả về thông báo khi đổi mật khẩu
            if(isset($_GET["password"])){
                switch($_GET["password"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Đổi mật khẩu thành công!</div>";
                    break;

                    case "error_old":
                        $message = "<div class='alert alert-danger'>❌ Mật khẩu cũ không đúng!</div>";
                    break;

                    case "error_confirm":
                        $message = "<div class='alert alert-danger'>❌ Mật khẩu xác nhận không khớp!</div>";
                    break;

                    case "error_update":
                        $message = "<div class='alert alert-danger'>❌ Đổi mật khẩu thất bại!</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }
            
            //lấy thông tin người dùng
            $users = $this->userModel->getAllUsers();

            // Chuyển hướng thư mục view sang backend
            View::setBaseDir("frontend/views");

            return View::render("ProfileView", [
                "users" => $users,
                "message" => $message
            ]);
        }

        //hàm cập nhật thông tin cá nhân
        public function update_profile() {
            //lấy dữ liệu từ form
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];

            //lấy id người dùng từ session
            $userId = $_SESSION['user']['id'];

            //cập nhật thông tin người dùng
            if ($this->userModel->updateUserInfo($userId, $lastname, $firstname)) {
                //cập nhật thông tin trong session
                $_SESSION['user']['lastname'] = $lastname;
                $_SESSION['user']['firstname'] = $firstname;

                header("Location: profile?update=success");
            } else {
                header("Location: profile?update=error");
            }
        }

        //hàm đổi mật khẩu
        public function change_password() {
            //lấy dữ liệu từ form
            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            //lấy id người dùng từ session
            $userId = $_SESSION['user']['id'];

            //kiểm tra mật khẩu cũ có đúng không
            if (!password_verify($oldPassword, $_SESSION['user']['password'])) {
                header("Location: profile?password=error_old");
                return;
            }

            //kiểm tra mật khẩu mới có khớp với xác nhận không
            if ($newPassword !== $confirmPassword) {
                header("Location: profile?password=error_confirm");
                return;
            }

            //cập nhật mật khẩu mới
            if ($this->userModel->updatePassword($userId, $newPassword)) {
                header("Location: profile?password=success");
            } else {
                header("Location: profile?password=error_update");
            }
        }
    }
?>