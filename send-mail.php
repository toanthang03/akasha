<?php

//gọi các file PHPMAILER để sử dụng (Lấy từ github)
//Link github tham khảo: https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vender/PHPMailer-master/src/Exception.php';
require 'vender/PHPMailer-master/src/PHPMailer.php';
require 'vender/PHPMailer-master/src/SMTP.php';

function sendMail($to, $content)
{
    //Khai báo một biến mailer mới và try để bắt các sự kiện nếu lỗi (cũng lấy từ github)
    $mail = new PHPMailer(true);
    try {
        //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'toanthang300403@gmail.com';                     //SMTP username
        $mail->Password   = 'ulfk ffrj pfhk jfnt';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('toanthang300403@gmail.com', ' Lã Toàn Thắng');
        $mail->addAddress($to);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = '=?UTF-8?B?' . base64_encode('Mã đổi mật khẩu cho tài khoản của bạn') . '?=';
        $mail->Body    = $content;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
