<?php
    //hàm lấy sản phẩm theo tên
    function get_product_by_name($name){
        //nạp vào file kết nối
        include "../bai3_lab1/config.php";

        try{
            //Câu lệnh SQL với placeholder có tên (:name)
            $sql = "SELECT * FROM products WHERE name like :name";

            //Chuẩn bị câu lệnh (Prepare)
            $stmt = $connect->prepare($sql);

            $search_name = "%". $name ."%";

            $stmt->bindParam(':name', $search_name, PDO::PARAM_STR);

            //Thực thi và truyền tham số trực tiếp vào execute
            $stmt->execute();

            //Lấy tất cả các kết quả trả về dưới dạng mảng kết hợp
            return $stmt->fetchAll();

        }catch(PDOException $e){
            //Xử lý lỗi nếu cần thiết
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }

    //hàm lấy ra toàn bộ sản phẩm
    function get_all_products(){
        //nạp vào file kết nối
        include "../bai3_lab1/config.php";

        try{
            //Câu lệnh SQL
            $sql = "SELECT * FROM products";
            $stmt = $connect->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(PDOException $e){
            //Xử lý lỗi nếu cần thiết
            error_log("Lỗi truy vấn: " . $e->getMessage());
            return null;
        }
    }
?>

