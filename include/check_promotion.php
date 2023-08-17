<?php
function getImage($item_id)
{
    include "connection.php";

    $sql = "SELECT pic_id, image_name, image_path from item_images
            WHERE item_id=?;";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_error($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../browse_items.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_bind_param($stmt, "i", $item_id);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $image = $row['image_path'];
    } else {
        $image = "../images/no_image_found.png";
    }

    return $image;
    mysqli_stmt_close($stmt);
}

function checkPromo($item_id){
include "connection.php";

$sql = "SELECT * FROM discount";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_error($stmt);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../item_info.php?error=dbaccessFailed");
    die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
}

mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);
$promos[] = array();
while($row = mysqli_fetch_assoc($resultData)) {
    $promos[$row["item_id"]]=$row;
}
//print_r($promos);
if(array_key_exists($item_id,$promos)){
    return true;
}
else{
    return false;
}
}

//}

function getPromoRow($item_id){

include "connection.php";

$promos[] = array();

$sql = "SELECT * FROM discount WHERE item_id=?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_error($stmt);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../item_info.php?error=dbaccessFailed");
    die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
}
mysqli_stmt_bind_param($stmt,"i",$item_id);
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($resultData);
$promos[$row['item_id']]=$row;

return $promos;
mysqli_stmt_close($stmt);
}