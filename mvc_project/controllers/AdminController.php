<?php
namespace controllers;

require_once __DIR__ . "/../core/Database.php";

use core\Database;

class AdminController
{
    public $conn;

    //hàm hiển thị khởi tạo
    public function __construct()
    {
        $this->conn = new Database();
        $this->conn->connect();

        //xét nếu không phải admin thì bắt đăng nhập lại
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            header("Location: login?status=not_admin_login");
            exit;
        }
    }

    //hàm hiển thị admin view
    public function index()
    {

        //gọi hàm lấy toàn bộ sản phẩm
        $products = $this->conn->getAllProducts();

        //nạo trang chủ nếu đăng nhập thành công
        require_once __DIR__ . "/../views/AdminView.php";
    }

    //hàm thêm sản phẩm
    public function addProduct()
    {
        if (!empty($_POST['name']) && !empty($_POST['price'])) {

            $name = $_POST['name'];
            $price = $_POST['price'];

            //chèn sản phẩm
            $this->conn->insertProduct($name, $price);

            header("Location: admin?status=add_product_success");
        } else {
            header("Location: admin?status=add_product_error");
        }
    }

    //hàm xoá sản phẩm
    public function delete_product(){
        //lấy id từ get
        $product_id = $_GET["product_id"] ?? null;

        //chạy hàm delete
        if($this->conn->deleteProduct($product_id)){
            header("Location: admin?status=delete_product_success");
            exit;
        }
        else{
            header("Location: admin?status=delete_product_error");
            exit;
        }
    }

    //hàm hiển thị form sửa sản phẩm
    public function edit_product(){
        //lấy id sản phẩm bằng get
        $product_id = $_GET["product_id"] ?? null;

        //lấy dữ liệu sản phẩm đó
        $product = $this->conn->getProductById($product_id);

        //nạo vào trang sửa sản phẩm
        require_once __DIR__ . "/../views/EditProduct.php";
    }

    //hàm thực hiện sửa sản phẩm
    public function update_product(){
        //lấy thông tin sản phẩm từ post
        $product_id = $_POST["id"] ?? null;
        $product_name = $_POST["name"] ?? null;
        $product_price = $_POST["price"] ?? null;

        //chạy hàm cập nhật thông tin sản phẩm
        if($this->conn->update_product($product_id, $product_name, $product_price)){
            header("Location: admin?status=update_product_success");
            exit;
        }
        else{
            header("Location: admin?status=update_product_error");
            exit;
        }
    }

}