<?php
    //khai báo namespace
    namespace frontend\controllers;

    //nạp vào product model
    use models\CartModel;

    //nạp vào view
    use core\View;

    class CartController {
        protected $cartModel;

        //hàm khởi tạo
        public function __construct()
        {
            $this->cartModel = new CartModel();
        }

        //hàm hiển thị giỏ hàng
        public function cart() {
            //khai báo biến thông báo
            $message = "";

            //xét thông báo thêm vào giỏ hàng
            if(isset($_GET["status"])){
                switch($_GET["status"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Thêm vào giỏ hàng thành công</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-error'>❌ Thêm vào giỏ hàng thất bại!</div>";
                    break;

                    case "delete_success":
                        $message = "<div class='alert alert-success'>✅ Xóa sản phẩm khỏi giỏ hàng thành công</div>";
                    break;

                    default:
                        $message = "";
                    break;
                }
            }

            //lấy userid
            $userId = $_SESSION['user']['id'];

            //nếu user chưa đăng nhập thì chuyển hướng về trang login
            if (!isset($_SESSION['user'])) {
                header("Location: login?status_login=need_login");
                exit;
            }

            //lấy danh sách sản phẩm trong giỏ hàng của user
            $cartItems = $this->cartModel->getCartItemsByUserId($userId);

            return View::render("CartView", [
                "message" => $message,
                "cartItems" => $cartItems
            ]);
        }

        // tạo hàm thêm sản phẩm vào giỏ hàng
        public function add_to_cart() {
            // Kiểm tra đăng nhập (giả sử Tú lưu user trong session)
            if (!isset($_SESSION['user'])) {
                header("Location: login?status_login=need_login");
                exit;
            }

            $userId = $_SESSION['user']['id'];
            $productId = $_GET['id'];

            // Kiểm tra xem máy này đã có trong giỏ chưa
            $item = $this->cartModel->checkItemExist($userId, $productId);

            if ($item) {
                // Có rồi thì cộng thêm 1
                $this->cartModel->updateQuantity($item['id'], $item['quantity'] + 1);
            } else {
                // Chưa có thì chèn mới vào bảng cart
                $this->cartModel->addToCart($userId, $productId);
            }

            header("Location: cart?status=success");
        }

        // tạo hàm xóa sản phẩm khỏi giỏ hàng
        public function remove_cart() {
            // Kiểm tra đăng nhập
            if (!isset($_SESSION['user'])) {
                header("Location: login?status_login=need_login");
                exit;
            }

            $cartId = $_GET['id'];

            // Xóa sản phẩm khỏi giỏ hàng
            $this->cartModel->removeFromCart($cartId);

            header("Location: cart?status=delete_success");
        }
    }
?>