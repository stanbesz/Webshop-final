<?php

require_once "../PHPMailer/PHPMailerAutoload.php";

if(isset($_POST["reset_submit"])){

    $selector=bin2hex(random_bytes(8));//
    $token = random_bytes(32);

    $url="https://stanswebshop/reset_password.php?selector=". $selector ."&validator=".bin2hex($token);//link which is going to be sent by email

    $expires = date("U") + 3600;
    require_once "connection.php";

    $userEmail = $_POST["emailAddress"];
    $user_id=null;
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        die("Error with preparing of statement");
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$userEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        if(!$row){
            header("Location: ../login.php?reset=noemail");
            exit();
        }
        $user_id=$row['user_id'];
    }
    // print_r($_POST);
    // print($user_id);
    $sql = "DELETE FROM change_password WHERE change_id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        die("Error with preparing of statement");
    }
    else{
        mysqli_stmt_bind_param($stmt,"i",$user_id);
        mysqli_stmt_execute($stmt);
    }

    $sql="INSERT INTO change_password (change_id, selector, token, expires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        die("Error with preparing of statement");
    }
    else{
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"isss", $user_id, $selector, $token, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->isHTML(true);
    $mail->Username = "stanswebshop@gmail.com";
    $mail->Password= "webshop123";
    $mail->SetFrom('stanswebshop@gmail.com');
    $mail->Subject = "Recover password for Stan's webshop";
    $mail->addAddress($to);
    $message = '<p>A reset password request hase been received for this email.
     If you haven\'t sent this request ignore this email!</p>';
    $message .= '<p>Here is your password reset link: <a href ="' .$url.'" >'. $url.'</a></p>';
    $mail->Body = $message;
    $mail->send();

    header("Location: ../login.php?reset=success");
    exit();
}
else{
    header("Location: ../index.php");
    exit();
}