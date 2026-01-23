<?php
    //sử dụng hàm spl_autoload_register để tự động load các class khi cần
    spl_autoload_register(function ($class){
        //tìm đường dẫn có dấu \ và thay bằng / .php
        $file = str_replace("\\","/",$class). ".php";

        //nếu tồn tại đường dẫn thì nạp file đính kèm
        if(file_exists($file)){
            require_once $file;
            return;
        }

        //nếu không có đường dẫn thì tạo cơ chế đường dẫn dự phòng
        //tách đường dẫn thành mảng
        $parts = explode("\\",$class);

        //lấy phần tử cuối cùng của mảng
        $className = end($parts);

        //nếu tồn tại đường dẫn thì nạp vào file
        if(file_exists($className .".php")){
            require_once $className .".php";
        }
    });

    //nạp file database vào
    use Core\Database as DB;

    //khởi tạo database
    $db = new DB();
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>Home Page</h1>
</body>
</html>