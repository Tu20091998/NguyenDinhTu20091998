<?php

function get_user($email) {
    //nạp vào file kết nối
    include 'config.php'; 

    try {
        // Câu lệnh SQL với placeholder có tên (:email)
        $sql = "SELECT * FROM users WHERE email = :email";
        
        // Chuẩn bị câu lệnh (Prepare)
        $stmt = $connect->prepare($sql);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        // Thực thi và truyền tham số trực tiếp vào execute
        $stmt->execute();
        
        // Lấy kết quả (fetch sẽ trả về mảng dữ liệu hoặc false nếu không thấy)
        $user = $stmt->fetch();
        
        if ($user) {
            return $user; // Trả về mảng chứa thông tin user
        }
        
    } catch (PDOException $e) {
        // Xử lý lỗi nếu cần thiết
        error_log("Lỗi truy vấn: " . $e->getMessage());
    }

    return null; // Trả về null nếu không tìm thấy
}
?>