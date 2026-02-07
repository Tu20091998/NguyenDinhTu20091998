<?php
    //tạo namespace
    namespace app\core;

    //khai báo class Exception
    use Exception;

    //tạo class ViewNotFoundExeception kế thừa từ class \Exception
    class ViewNotFoundExeception extends Exception {
        protected $message = 'View not found';//không tìm thấy view
    }
?>