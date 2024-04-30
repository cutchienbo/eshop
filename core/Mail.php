<?php

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    public $mail;

    function __construct()
    {
        $this->mail = new PHPMailer(true);

        try {
            //Server settings
            // $this -> mail->SMTPDebug = 2;
            $this->mail->isSMTP(); // Sử dụng SMTP để gửi mail
            $this->mail->Host = 'smtp.gmail.com'; // Server SMTP của gmail
            $this->mail->SMTPAuth = true; // Bật xác thực SMTP
            $this->mail->Username = 'cristntk0162@gmail.com'; // Tài khoản email
            $this->mail->Password = 'cnkjibhimlwnywsx'; // Mật khẩu ứng dụng ở bước 1 hoặc mật khẩu email
            $this->mail->SMTPSecure = 'ssl'; // Mã hóa SSL
            $this->mail->Port = 465; // Cổng kết nối SMTP là 465

            //Recipients
            $this->mail->setFrom('cristntk0162@gmail.com', 'Eshop'); // Địa chỉ email và tên người gửi

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }

    public function sendEmail($to = '', $name = '', $code = '')
    {

        try {

            $this->mail->addAddress($to, $name); // Địa chỉ mail và tên người nhận

            $this->mail->isHTML(true); // Set email format to HTML
            $this->mail->Subject = 'Eshop - Active email code'; // Tiêu đề
            $this->mail->Body = file_get_contents(_WEB_ROOT . '/assest/email_template/index.php');
            $this->mail->Body .= $code;
            $this->mail->Body .= file_get_contents(_WEB_ROOT . '/assest/email_template/bot.php');

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
};
