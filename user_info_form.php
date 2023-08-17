<?php
session_start();
include "include/connection.php";
$user_id=$_SESSION['user_id'];

if (isset($_POST['submit_image'])) {

  $file = $_FILES['imageInp'];
  $fileName = $_FILES['imageInp']['name'];
  $fileTmpName = $_FILES['imageInp']['tmp_name'];
  $fileSize = $_FILES['imageInp']['size'];
  $fileError = $_FILES['imageInp']['error'];
  $fileType = $_FILES['imageInp']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png', 'pdf');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {
        $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
        $fileDestination = 'images/profile_images/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);

        $sql= "INSERT INTO profile_images (user_id, `image_name`, `image_path`)
               VALUES(?, ?, ?)  ON DUPLICATE KEY
               UPDATE image_name = '$fileNameNew',
               image_path = '$fileDestination';";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../user_info.php?error=dbaccessFailed");
            die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        } 
        mysqli_stmt_bind_param($stmt,"iss",$user_id, $fileNameNew, $fileDestination);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: ../user_info.php?upload=success");
        exit();
      }
      else {
        echo "Your file is too big!";
        header("Location: ../user_info.php?error=error");
      }
    }
    else {
      echo "There was an error uploading your file!";
      header("Location: ../user_info.php?error=size");
    }
  }
  else {
    echo "You cannot upload files of this type!";
    header("Location: ../user_info.php?error=type");
  }

}
?>