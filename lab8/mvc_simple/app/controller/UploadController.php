<?php
    //khai báo namespace
    namespace app\controller;

    //nạp vào composer
    require_once __DIR__."/../../vendor/autoload.php";

    //định nghĩa hằng số STORAGE_PATH
    define('STORAGE_PATH', __DIR__ . '/../../storage');

    //nạp vào view
    use app\core\View;

    //khai báo class upload controller
    class UploadController
    {
        //tạo hàm hiển thị
        public function index()
        {
            //khai báo các biến liên quan
            $message = "";
            
            //xét trả về thông báo
            if(isset($_GET["status_upload"])){
                switch($_GET["status_upload"]){
                    case "success":
                        $message = "<div class='alert alert-success'>✅ Upload file thành công!</div>";
                    break;

                    case "error":
                        $message = "<div class='alert alert-error'>❌ Upload file thất bại!</div>";
                    break;
                }
            }

            //đưa ra màn hình
            return View::render("UploadView",[
                "message" => $message
            ]);
        }

        //hàm xử lý upload file
        public static function upload()
        {
            //khai báo đường dẫn lưu trữ file
            $filePath = STORAGE_PATH . '/'. $_FILES["receipt"]["name"];

            //di chuyển file từ thư mục tạm sang thư mục lưu trữ
            $isMoved = move_uploaded_file($_FILES["receipt"]["tmp_name"], $filePath);

            //xét upload
            if ($isMoved) {
                header("Location: /Php2/lab8/mvc_simple/upload?status_upload=success");
                exit;
            } else {
                header("Location: /Php2/lab8/mvc_simple/upload?status_upload=error");
                exit;
            }
        }
    }
?>