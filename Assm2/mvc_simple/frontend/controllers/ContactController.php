<?php
namespace frontend\controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController {
    public function sendContact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $mail = new PHPMailer(true);

            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'dinhtu20091998@gmail.com'; // Email của Tú
                $mail->Password   = 'vcpoanqqtsesrgxg';           // Mật khẩu ứng dụng
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
                $mail->CharSet    = 'UTF-8';

                // Gửi cho Admin (Tú)
                $mail->setFrom('dinhtu20091998@gmail.com', 'PolyXShop Contact');
                $mail->addAddress('dinhtu20091998@gmail.com'); 
                $mail->isHTML(true);
                $mail->Subject = "[LIÊN HỆ MỚI] $subject";
                $mail->Body    = "<h3>Thông tin khách hàng:</h3>
                                <p><b>Họ tên:</b> $name</p>
                                <p><b>Email:</b> $email</p>
                                <p><b>Nội dung:</b> $message</p>";
                $mail->send();

                // Gửi xác nhận cho khách hàng
                $mail->clearAddresses(); // Xóa địa chỉ cũ
                $mail->addAddress($email);
                $mail->Subject = "Xác nhận liên hệ từ PolyXShop";
                $mail->Body    = "Chào $name, cảm ơn bạn đã liên hệ với chúng tôi. Tú sẽ phản hồi bạn sớm nhất!";
                $mail->send();

                header("Location: contact?status=success");
            } catch (Exception $e) {
                header("Location: contact?status=error");
            }
        }
    }
}