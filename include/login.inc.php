<?php
if(isset($_POST["submit"])){

    $user=$_POST["user"];
    $password=$_POST["password"];

    require_once 'connection.php';
    require_once 'functions.php';

    if(emptyInputLogin($user,$password)!==false){
        header("location: ../login.php?error=empty");
        exit();
    }
    loginUser($conn,$user,$user,$password);
}