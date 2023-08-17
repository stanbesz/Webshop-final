<?php

function emptyInput($userName,$email,$password,$confPassword,$selected_type){
    $result=false;
    if(empty($userName)||empty($email)||empty($password)||empty($confPassword)||empty($selected_type)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}
function emptyInputItem($name,$type,$price,$amount){
    $result=false;
    if(empty($name)||empty($type)||empty($price)||empty($amount)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}
function invalidUserName($userName){
    $result=false;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$userName)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}
function invalidEmail($email){
    $result=false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}
function pwdMatch($password,$confPassword){
    $result=false;
    if($password!==$confPassword){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function userExists($conn,$user,$email){
    $sql= "SELECT * FROM users WHERE username = ? OR email = ?;";
    $statement=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement,$sql)){
        header("location: ../signup.php?error=dbaccessFailed");
        exit();
    }
    mysqli_stmt_bind_param($statement,"ss",$user, $email);
    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
        echo $row['username'];
        echo $row['email'];
        exit();
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($statement);
}
function checkManu($conn,$user_id){
    $sql= "SELECT manu_id, company_name
    FROM manufacturers
    INNER JOIN users
    ON manufacturers.user_id=users.user_id WHERE manufacturers.user_id=?;";
    $statement=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($statement,$sql)){
        header("location: ../login.php?error=dbaccessFailed");
        die(mysqli_stmt_error($statement));
    }
    mysqli_stmt_bind_param($statement,"i",$user_id);
    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
        exit();
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($statement);
}
function createUser($conn,$userName,$email,$password,$manuName,$selected_type){
    if($selected_type==="user"){
        $sql = "INSERT INTO `users` (`username`, `password`, `email`) VALUES (?, ?, ?);";
        $stmt=mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../signup.php?error=dbaccessFailed");
            exit();
        }

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"sss",$userName,$hashedPass,$email);
        
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_close($stmt);
        header("location:../login.php?signup=success");
        exit();
        }
        else if($selected_type==="manufacturer"){
    
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?);";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../signup.php?error=dbaccessFailed");
            exit();
        }
    
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        
        mysqli_stmt_bind_param($stmt,"sss",$userName,$hashedPass,$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql="INSERT INTO manufacturers (user_id,company_name) VALUES((SELECT user_id FROM users WHERE username=?),?);";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../signup.php?error=dbaccessFailed");
            exit();
        }
              
        mysqli_stmt_bind_param($stmt,"ss",$userName,$manuName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location:../login.php?signup=success");
        exit();
    }

}

function emptyInputLogin($username,$password){
    $result=false;
    if(empty($username)||empty($password)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function loginUser($conn,$user,$email,$password){

    $userExist=userExists($conn,$user,$email);
    if($userExist === false){
        header("location: ../login.php?error=noUser");
       exit();
    }

    $pwdHashed = $userExist["password"];+-
    $checkPass = password_verify($password,$pwdHashed);

    if($checkPass === false){
        header("location: ../login.php?error=wrongPass");
        exit();
    }
    else if($checkPass === true){
        
        session_start();
        $_SESSION["user_id"] = $userExist["user_id"];
        $_SESSION["username"] = $userExist["username"];
        $_SESSION["email"] = $userExist["email"];
        $_SESSION["manufacturer"]=null;
        $checkManu=checkManu($conn,$_SESSION["user_id"]);
        if($checkManu===false){
            header("location:../index.php?login=checkUser");
            exit();
        }
        else{
            $_SESSION["manufacturer"] = $checkManu["company_name"];
            $_SESSION["manu_id"] = $checkManu["manu_id"];
            header("location:../index.php?login=checkManu");
            exit();
        }
    }
}