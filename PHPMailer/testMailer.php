<?php
    require_once ("PHPMailerAutoload.php");

    try{

    $mail = new PHPMailer();
    $mail->SMTPDebug=SMTP::DEBUG_CONNECTION;
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->isHTML(true);
    $mail->Username = "stanswebshop@gmail.com";
    $mail->Password="webshop123";
    $mail->SetFrom('stanswebshop@gmail.com');
    $mail->Subject = "Hello World!";
    $mail->Body="A test email!";
    $mail->addAddress('stanswebshop@gmail.com');

    $mail->send();
    }catch(Exception $e){
    echo "Message cannot be sent";
    echo "Mailer  Error: $mail->ErrorInfo";
    }

?>