<?php
function print_remove_items($conn){
$items_type = array();
$sql = "SELECT type FROM items WHERE manu_id=?
        GROUP BY type;";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_error($stmt);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../item_control.php?error=dbaccessFailed");
    die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
}
mysqli_stmt_bind_param($stmt, "i", $_SESSION['manu_id']);
mysqli_stmt_execute($stmt);
$index = 0;
$resultData = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($resultData)) { // loop to store the data in an associative array.
    $items_type[$index] = $row;
    $index++;
}

mysqli_stmt_close($stmt);


foreach ($items_type as $type) {
    $sql = "SELECT * FROM items 
            WHERE type=? AND manu_id = ?;";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_error($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../browse_items.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
    }
    //print_r($_SESSION['manu_id']);
    mysqli_stmt_bind_param($stmt, "si", $type['type'], $_SESSION['manu_id']);

    mysqli_stmt_error($stmt);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_error($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    ?>   
    <div class="row mt-3 border-bottom">
    <h6 class="display-6 border-bottom border-2" style="font-size: 24px;"><b><?php echo $type['type']?></b></h6>
    <?php 
    while ($row = mysqli_fetch_assoc($resultData)) { // loop to store the data in an associative array.
        
        $item_id = $row['item_id'];
        $manu_id = $row['manu_id'];
        $name = $row['name'];
        $price = $row['price'];
        $amount = $row['amount'];
        
        
?>
    <form class="col-sm-4" action="include/remove_items.php" method="post">
        <div class="media-29101 justify-content-center align-items-center mt-2 mb-3 mx-auto border border-3 shadow-sm p-2 mb-5 rounded" style="border-radius: 30px; border-color:red; background-color:#F2F1F0;">
            <img src="<?php echo getImage($item_id) ;?>" alt="Image" class="img-fluid rounded-4 mx-auto d-block border-bottom pb-3 pt-4" style="object-fit:contain; height:280px; width:350px;">
            <div class="row text-center border-bottom mx-auto mb-3">
              <h3 class="col-8"><a href="#"><?php echo $name;?></a></h3>
              <h3 class="col-4"><?php echo number_format((float)$price, 2, '.', '').'лв.'; ?></h3>
            </div>
            <input type="hidden" name="item_id" value="<?php echo $item_id?>">
            <input type="hidden" name="manu_id" value="<?php echo $manu_id?>">
            <input type="hidden" name="amount" value="<?php echo $amount?>">
            <div class="row text-center d-flex align-items-center mx-auto ms-1 ps-2 pe-3 pb-4 pt-2">
                <b class="col"><?php echo $amount;?></b>
              <input type="number" min="0" class="form-control col ps-1 pe-2 px-auto mx-auto text-center" name="remove_amount" placeholder="#" aria-label="Item's amount" aria-describedby="basic-addon2">
              <button type="submit" name="amount_button" class="col-auto mx-1 btn btn-warning px-1" >Remove Amount</button>
              <button type="submit" name="remove_item" class="col-auto btn btn-danger px-1">Remove Item</button>
            </div>
          </div>
    </form>
<?php
    }
    mysqli_stmt_close($stmt);
    ?> 
    </div> 
    <?php
}
}

