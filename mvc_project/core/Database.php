<?php
namespace core;

use PDO;
use PDOException;

class Database
{
    protected $conn;

    public function connect()
    {
        $dsn = "mysql:host=localhost;port=3307;dbname=mvc_project;charset=utf8mb4";
        $user = "root";
        $pass = "";

        try {
            $this->conn = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Lấy user theo email
    public function getUser($email)
    {
        try{
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":email" => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Lỗi : ".$e->getMessage();
            echo "Lỗi ở file". $e->getFile();
        }
        
    }

    // Thêm sản phẩm
    public function insertUser($email, $password)
    {
        try{
            //mã hoá mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ":email" => $email,
                ":password" => $hashedPassword,
            ]);
        }catch(PDOException $e){
            echo "Lỗi : ".$e->getMessage();
            echo "Lỗi ở file". $e->getFile();
        }
        
    }

    // Thêm sản phẩm
    public function insertProduct($name, $price)
    {
        try{
            $sql = "INSERT INTO products (name, price) VALUES (:name, :price)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ":name" => $name,
                ":price" => $price
            ]);
        }catch(PDOException $e){
            echo "Lỗi : ".$e->getMessage();
            echo "Lỗi ở file". $e->getFile();
        }
        
    }

    //lấy toàn bộ sản phẩm trong giỏ
    public function getAllProducts(){
        try{
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Lỗi : ".$e->getMessage();
            echo "Lỗi ở file". $e->getFile();
        }
    }

    //hàm xoá sản phẩm
    public function deleteProduct($id){
        try{
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([":id" => $id]);
        }catch(PDOException $e){
            echo "Lỗi : ".$e->getMessage();
            echo "Lỗi ở file". $e->getFile();
        }
    }

    //hàm lấy sản phẩm theo id
    public function getProductById($id){
        try{
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Lỗi : ".$e->getMessage();
            echo "Lỗi ở file". $e->getFile();
        }
    }

    //hàm cập nhật sản phẩm
    public function update_product($id, $name, $price){
        try{
            $sql = "UPDATE
                        products 
                    SET 
                        name = :name, price = :price
                    WHERE 
                        id = :id";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ":id" => $id,
                ":name" => $name,
                ":price" => $price
            ]);
        }catch(PDOException $e){
            echo "Lỗi : ".$e->getMessage();
            echo "Lỗi ở file". $e->getFile();
        }
    }
}