<?php
session_start();
include "connection.php";
include "functions.php";
$manu_id = $_SESSION['manu_id'];
if (isset($_POST['insert_item'])) {
    $item_type = $_POST['typeDataList'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_amount = $_POST['item_amount'];
    $date=date("U");
    if (emptyInputItem($item_name, $item_type, $item_price, $item_amount)) {
        header("Location: ../item_control.php?error=emptyInputItem");
        exit();
    }
    
    $sql = "INSERT INTO items (item_id, manu_id, type, name, price, amount)
               VALUES(?, ?, ?, ?, ?, ?) 
               ON DUPLICATE KEY UPDATE
               amount = amount + VALUES(amount);";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_error($stmt);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../item_control.php?error=dbaccessFailedhere");
    die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
}

mysqli_stmt_bind_param($stmt, "iissdi",$item_id, $manu_id, $item_type, $item_name, $item_price, $item_amount);
mysqli_stmt_execute($stmt);


mysqli_stmt_close($stmt);

        $sql = "SELECT item_id FROM items
        WHERE type = ? AND name = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../item_control.php?error=dbaccessFailed");
            die("Error:" . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_bind_param($stmt, "ss",$item_type, $item_name);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($resultData)) {
            $item_id=0;
        } else {
            mysqli_stmt_execute($stmt);
            $item_id = $row['item_id'];
            mysqli_stmt_close($stmt);
        }
    

    if (empty($_FILES['imageInp']['name'])) {
        header("Location: ../item_control.php?success=noImage");
        print_r($_POST);
        exit();
    } else {
        $fileName = $_FILES["imageInp"]["name"];
        $fileTmpName = $_FILES["imageInp"]["tmp_name"];
        $fileSize = $_FILES["imageInp"]["size"];
        $fileError = $_FILES["imageInp"]["error"];
        $fileType = $_FILES["imageInp"]["type"];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                    $fileDirectory = '../images/' . $item_type;
                    if (!file_exists($fileDirectory)) {
                        mkdir($fileDirectory, 0777, true);
                    }                   
                    $fileDestination = $fileDirectory . '/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $sql = "INSERT INTO
                    item_images (item_id , `image_name`, `image_path`)
                    VALUES(?, ?, ?) ON DUPLICATE KEY
                    UPDATE image_name = '$fileNameNew',
                    image_path = '$fileDestination';";

                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_error($stmt);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location: ../item_control.php?error=dbaccessFailed");
                        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
                    }
                    mysqli_stmt_bind_param($stmt, "iss", $item_id, $fileNameNew, $fileDestination);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    header("Location: ../item_control.php?upload=success");
                    exit();
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
    }
}
