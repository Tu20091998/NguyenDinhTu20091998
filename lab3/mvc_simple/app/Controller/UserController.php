<?php
    //tạo namespace
    namespace app\Controller;

    //nạp vào composer
    require_once __DIR__."/../../vendor/autoload.php";

    //nạp vào usermodel
    use app\Models\UserModel;

    //tạo class usercontroller
    class UserController
    {
        //khai báo thuộc tính usermodel
        protected UserModel $userModel;

        //khai báo hàm khởi tạo class
        public function __construct()
        {
            $this->userModel = new UserModel();
        }
        //hàm xử lý đăng ký người dùng
        public function register_user_confirm()
        {
            //nhận dữ liệu từ form
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';

            //kiểm tra dữ liệu hợp lệ
            if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirmPassword)) {
                $_GET['error'] = "Vui lòng điền đầy đủ thông tin.";
                $this->getAllUsers();
                return;
            }
            
            //kiểm tra password hợp lệ
            if ($password !== $confirmPassword) {
                $_GET['error'] = "Mật khẩu xác nhận không khớp.";
                $this->getAllUsers();
                return;
            }

            //kiểm tra người dùng có tồn tại không
            $existingUsers = $this->userModel->getAllUsersModel();
            foreach ($existingUsers as $user) {
                if ($user['email'] === $email) {
                    $_GET['error'] = "Email đã được đăng ký.";
                    $this->getAllUsers();
                    return;
                }
            }

            //gọi model để xử lý đăng ký
            try {
                $this->userModel->register_user_model($firstname, $lastname, $email, $password);
                
                if(!$this->userModel){
                    $_GET['error'] = "Đăng ký thất bại ở usermodel.";
                    $this->getAllUsers();
                    return;
                }

                //chuyển hướng về trang đăng ký và thông báo
                $_GET['success'] = "Đăng ký thành công!";

                $this->getAllUsers();
                return;
            } catch (\Exception $e) {
                die("Lỗi đăng ký: " . $e->getMessage());
            }
        }
        
        //lấy toàn bộ danh sách người dùng
        public function getAllUsers()
        {
            $users = $this->userModel->getAllUsersModel();
            require_once __DIR__ . "/../view/home.php";
            return;
        }
    }
?>