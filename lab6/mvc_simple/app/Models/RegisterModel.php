<?php
//đặt namespace cho usermodel
namespace app\Models;

//khai báo composer
require_once __DIR__ . "/../../vendor/autoload.php";

//nạp vào kết nối database
use app\core\Database;

//khai báo class xử lý usermodel
class RegisterModel
{
    protected $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    //hàm đăng ký người dùng
    public function insertUser($lastname, $firstname, $email, $password){
        //mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //kết nối database
        $db = new Database();
        $conn = $db->getConnection();

        //thêm người dùng vào database
        $sql = "INSERT INTO users (lastname, firstname, email, password) 
                VALUES (:lastname, :firstname, :email, :password)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        //thực thi câu lệnh
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    //hàm kiểm tra người dùng đã tồn tại
    public function userExists($email){
        //chuẩn bị câu lệnh SQL và thực thi
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        //nếu tìm thấy người dùng
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}