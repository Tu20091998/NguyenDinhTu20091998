<?php
//đặt namespace cho usermodel
namespace app\Models;

//khai báo composer
require_once __DIR__ . "/../../vendor/autoload.php";

//nạp vào kết nối database
use app\core\Database;

//khai báo class xử lý usermodel
class UserModel
{
    protected $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    //khai báo hàm xử lý đăng ký người dùng bằng pdo
    public function register_user_model($firstname, $lastname, $email, $password){
        try{
            $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        } catch (\PDOException $e){
            throw new \Exception("Lỗi đăng ký người dùng: " . $e->getMessage());
        }
    }

    //lấy toàn bộ danh sách người dùng
    public function getAllUsersModel()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $users;
        } catch (\PDOException $e) {
            throw new \Exception("Lỗi lấy danh sách người dùng: " . $e->getMessage());
        }
    }

    // Kiểm tra email đã tồn tại
    public function emailExists($email)
    {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }
}
