<?php
function getAmount($item_id){
include "connection.php";
$sql = "SELECT amount FROM items WHERE item_id=?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_error($stmt);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../item_info.php?error=dbaccessFailed");
    die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
}
mysqli_stmt_bind_param($stmt,"i",$item_id);
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

$amount = mysqli_fetch_assoc($resultData);

return $amount['amount'];
}