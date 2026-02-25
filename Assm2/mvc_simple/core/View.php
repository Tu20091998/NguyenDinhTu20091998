<?php
    //khai báo namespace
    namespace core;

    //sử dụng viewException
    use core\ViewNotFoundExeception;

    class View
    {
        // Mặc định là frontend
        public static string $baseDir = "frontend/views";

        // Hàm để thay đổi thư mục view (Dùng cho Admin)
        public static function setBaseDir(string $path)
        {
            self::$baseDir = $path;
        }

        //tạo hàm thay thế nội dung của tất cả view
        public static function render($viewName, $data = [])
        {
            //lấy nội dung của trang con
            $viewContent = self::renderViewOnly($viewName, $data);

            //lấy nội dung của layout chung
            $viewLayout = self::renderLayoutOnly();

            //thay thế các nội dung 
            return str_replace("{{content}}",$viewContent,$viewLayout);
        }

        //hàm đọc file view thay đổi
        public static function renderViewOnly($viewName, $data)
        {
            //tạo đường dẫn đến file
            $viewPath = self::$baseDir . "/" . $viewName . ".php";

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

        //tạo hàm chỉ đọc file layout chung
        public static function renderLayoutOnly()
        {
            ob_start();
            include self::$baseDir. "/" . "layouts/main.php";
            return ob_get_clean();
        }
    }
?>