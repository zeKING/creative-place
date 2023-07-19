<?php defined('BASEPATH') OR exit('No direct script access allowed.');

use PHPMailer\PHPMailer\PHPMailer;
class MY_Email
{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load(){
        $name = "Dar";  // Name of your website or yours

        $from = "noreplay@5ss.uz";  // you mail
        $password = "n123123Y!";  // your mail password

        // Ignore from here

        require_once APPPATH."third_party/phpmailer/PHPMailer.php";
        require_once APPPATH."third_party/phpmailer/SMTP.php";
        require_once APPPATH."third_party/phpmailer/Exception.php";
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->Encoding = 'base64';
        // To Here

        //SMTP Settings
        $mail->isSMTP();
        // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging
        $mail->Host = "webmail.5ss.uz"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 25;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        return $mail;
    }
}