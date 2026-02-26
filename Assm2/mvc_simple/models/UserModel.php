<?php
    //tạo namespace
    namespace models;

    //nạp vào composer
    require_once __DIR__."/../vendor/autoload.php";

    //nạp vào kết nối database
    use core\Database;

    //khai báo class xử lý login model
    class UserModel
    {
        protected $conn;

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        //hàm lấy tất cả người dùng
        public function getAllUsers()
        {
            $sql = "SELECT * FROM users WHERE role = 'user' ORDER BY created_at DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll();
        }

        //hàm thay đổi trạng thái người dùng
        public function toggleStatus($id, $currentStatus) {
            // Nếu status đang là 1 thì đổi thành 0, và ngược lại
            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $sql = "UPDATE users SET status = :status WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':status' => $newStatus,
                ':id' => $id
            ]);
        } 
        
        //hàm cập nhật thông tin người dùng
        public function updateUserInfo($id, $lastname, $firstname) {
            $sql = "UPDATE users SET lastname = :lastname, firstname = :firstname WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':lastname' => $lastname,
                ':firstname' => $firstname,
                ':id' => $id
            ]);
        }

        //hàm cập nhật mật khẩu
        public function updatePassword($id, $newPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':password' => $hashedPassword,
                ':id' => $id
            ]);
        }
    }
?>