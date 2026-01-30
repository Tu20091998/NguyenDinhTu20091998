<?php
//khai báo namespace
namespace app;

//định nghĩa hằng số STORAGE_PATH
define('STORAGE_PATH', __DIR__ . '/../storage');

class Home
{
    // Hàm xử lý hiển thị trang chủ
    public static function index(): string
    {
        $message = '';

        if (isset($_GET['status'])) {
            if ($_GET['status'] === 'success') {
                $message = "<div class='alert alert-success'>✅ Upload file thành công!</div>";
            } else {
                $message = "<div class='alert alert-error'>❌ Upload file thất bại!</div>";
            }
        }

        //trả về nội dung HTML của trang chủ
        return "
            <!DOCTYPE html>
            <html lang='vi'>
            <head>
                <meta charset='UTF-8'>
                <title>Upload File</title>
                <link rel='stylesheet' href='public/css/home.css'>
            </head>
            <body>
                <div class='container'>
                    <h1>Upload File</h1>

                    $message

                    <form method='POST' action='upload' enctype='multipart/form-data'>
                        <input type='file' name='receipt' required>
                        <button type='submit'>Upload</button>
                    </form>
                </div>
            </body>
            </html>
        ";
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
            header("Location: /Php2/lab5/mvc_simple?status=success");
            exit;
        } else {
            header("Location: /Php2/lab5/mvc_simple?status=error");
            exit;
        }
    }
}
