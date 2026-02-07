<?php
    //tạo namespace
    namespace app\models;

    //nạp vào composer
    require_once __DIR__."/../../vendor/autoload.php";

    //nạp vào kết nối database
    use app\core\Database;

    //khai báo class xử lý login model
    class LoginModel
    {
        protected $conn;

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        //hàm lấy dữ liệu người dùng từ "database"
        public function getUser($email)
        {

            //chuẩn bị câu lệnh SQL và thực thi
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            //nếu không tìm thây người dùng
            if ($stmt->rowCount() === 0) {
                $stmt = null;
                header("Location: /Php2/lab8/mvc_simple/login?status_login=user_not_found");
                exit();
            }

            //lấy kết quả
            return $stmt->fetch();
        }
    }
?>