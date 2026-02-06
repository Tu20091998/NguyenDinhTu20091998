<?php
    //khai báo namespace
    namespace app\core;

    //khai báo composer
    require_once __DIR__ . "/../../vendor/autoload.php";

    //định nghĩa viewpath
    define("VIEW_PATH", "app/view");

    //sử dụng viewException
    use app\core\ViewNotFoundExeception;

    class View
    {
        public static function render($viewName, $data = [])
        {
            //tạo đường dẫn đến file
            $viewPath = VIEW_PATH . "/" . $viewName . ".php";

            //nếu file đường dẫn view không hợp lệ, ném lỗi
            if(!file_exists($viewPath)){
                throw new ViewNotFoundExeception();
            }

            //truyền biến sang view
            extract($data);

            //bắt đầu lưu vào bộ nhớ đệm
            ob_start();

            //nạp vào file đường dẫn
            include $viewPath;

            //trả html
            return ob_get_clean();
        }
    }
?>