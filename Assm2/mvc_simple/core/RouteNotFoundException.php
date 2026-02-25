<?php

    //khai báo namespace
    namespace core;

    //khai báo class Exception
    use Exception;

    //tạo class ném ra ngoại lệ khi không tìm thấy route
    class RouteNotFoundException extends Exception {
        protected $message = 'Route not found';//không tìm thấy route
    }
?>