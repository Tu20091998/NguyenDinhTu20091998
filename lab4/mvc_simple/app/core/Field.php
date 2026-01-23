<?php
    //tạo namespace
    namespace app\core;

    class Field
    {
        //kiểu đầu vào dữ liệu
        public const TYPE_TEXT = "text";
        public const TYPE_PASSWORD = "password";
        public const TYPE_NUMBER = "number";


        //khai báo kiểu và thuộc tính và placeholder
        public string $type;
        public string $attribute;
        public string $placeholder = "";

        //khai báo hàm khởi tạo class
        public function __construct(string $attribute)
        {
            $this->type = self::TYPE_TEXT;
            $this->attribute = $attribute;
        }

        //khai báo hàm tự động chạy khi echo Field
        public function __toString()
        {
            return sprintf(
        '<div class="form-group">
                    <label>%s</label>
                    <input 
                        type="%s" 
                        name="%s" 
                        class="form-control" 
                        placeholder="%s"
                    >
                </div>
                ',
                $this->getLabel($this->attribute),
                $this->type,
                $this->attribute,
                $this->placeholder
            );
        }

        //khai báo hàm chuyển qua type password
        public function passwordField()
        {
            $this->type = self::TYPE_PASSWORD;
            return $this;
        }

        //khai báo hàm để nhập vào placeholder
        public function placeholder(string $text)
        {
            $this->placeholder = $text;
            return $this;
        }

        //khai báo label để gắn nhãn
        public function labels()
        {
            return [
                'firstname' => 'First name',
                'lastname' => 'Last name',
                'email' => 'Your Email',
                'password' => 'Password',
                'confirmPassword' => 'Confirm password',
            ];
        }

        //khai báo hàm trả về label nhập từ tham số
        public function getLabel(string $attribute)
        {
            return $this->labels()[$attribute] ?? $attribute;
        }

    }
?>