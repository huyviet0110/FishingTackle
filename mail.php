<?php
    //Load Composer's autoloader
    require 'admin/PHPMailer/src/Exception.php';
    require 'admin/PHPMailer/src/PHPMailer.php';
    require 'admin/PHPMailer/src/SMTP.php';
    require 'admin/PHPMailer/src/OAuthTokenProvider.php';
    require 'admin/PHPMailer/src/POP3.php';
    require 'admin/PHPMailer/src/OAuth.php';

//Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


function send_mail($email, $name, $title, $content){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'huyvietfishingtackle2022@gmail.com';                     //SMTP username
        $mail->Password   = 'qeypajvtkhuikxdg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->SMTPSecure = 'tls';
        $mail->CharSet = 'UTF-8';

        //Recipients
        $mail->setFrom('huyvietfishingtackle2022@gmail.com', 'HuyvietFishingTackle');
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}