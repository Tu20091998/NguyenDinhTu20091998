<?php
    //khai báo name space
    namespace core;

    //khởi tạo class form
    class Form
    {
        //khởi tạo hàm bắt đầu để truyền vào đường dẫn và phương thức
        public static function begin($action, $method)
        {
            //gắn các giá trị và in ra
            echo sprintf('<form action="%s" method="%s">',$action, $method);

            //trả về 1 form đã có action và method
            return new Form();
        }

        //khởi tạo hàm để kết thúc thẻ form
        public static function end()
        {
            return "</form>";
        }

        //khởi tạo hàm truyền vào thuộc tính
        public function field($attribute){
            return new Field($attribute);
        }

        //tạo nút button submit form đăng ký
        public function submitButton(string $text, string $class = "btn btn-register btn-block mt-3")
        {
            return sprintf(
                '<button type="submit" class="%s">%s</button>',
                $class, $text
            );
        }
    }
?>