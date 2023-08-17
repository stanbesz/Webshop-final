<?php

if(isset($_POST["submit"])){
    $manuName = $_POST["manufacturerName"];
    $userName = $_POST["userName"];
    $email = $_POST["emailAddress"];
    $password = $_POST["password"];
    $confPassword = $_POST["confirmPassword"];

    if(empty($manuName)){ 
        $selected_type="user";
    }
    else{
        $selected_type="manufacturer";
    }

    require_once 'connection.php';
    require_once 'functions.php';

    if(emptyInput($userName,$email,$password,$confPassword,$selected_type)!==false){
        header("location: ../signup.php?error=empty");
        exit();
    }
    if(invalidUserName($userName)!==false){
        header("location: ../signup.php?error=invalidUsername");
        exit();
    }
    if(userExists($conn,$userName,$email)!==false){
        header("location: ../signup.php?error=userExists");
        exit();
    }
    if(invalidEmail($email)!==false){
        header("location: ../signup.php?error=invalidEmail");
        exit();
    }
    if(pwdMatch($password,$confPassword)!==false){
        header("location: ../signup.php?error=pwdError");
        exit();
    }
    
    createUser($conn,$userName,$email,$password,$manuName,$selected_type);
    
    
}
else{
    header("location: ../signup.php");
    exit();
}