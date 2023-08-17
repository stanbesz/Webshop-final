<?php
require_once "connection.php";

function printItems(){}
$items_type = array();
$sql = "SELECT type FROM items 
        GROUP BY type;";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_error($stmt);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../browse_items.php?error=dbaccessFailed");
    die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
}

mysqli_stmt_execute($stmt);
$index = 0;
$resultData = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($resultData)) { // loop to store the data in an associative array.
    $items_type[$index] = $row;
    $index++;
}

mysqli_stmt_close($stmt);
//print_r($items_type);

foreach ($items_type as $type) {
    $sql = "SELECT * FROM items  INNER JOIN discount
            ON items.item_id=discount.item_id;";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_error($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../browse_items.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_bind_param($stmt, "s", $type['type']);

    mysqli_stmt_error($stmt);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_error($stmt);
    //mysqli_stmt_close($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    //mysqli_stmt_close($stmt);

?>
    <div class="row mt-3">
        <h6 class="display-6 mx-1 border-bottom" style="font-size: 24px;" id="<?php $type['type'];?>"><b><?php echo $type["type"] ?></b></h6>
        <div class="container owl-2-style">
            <div class="owl-carousel owl-2">
                <?php
                while ($row = mysqli_fetch_assoc($resultData)) { // loop to store the data in an associative array.
                    $item_id = $row['item_id'];
                    $manu_id = $row['manu_id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $amount = $row['amount'];
                    $date = $row['date'];
                    $new_price = $row['new_price'];

                ?>
                <form action="index.php?add_to_cart=add&id=<?php echo $item_id;?>" method="post" >
                    <div class="media-29101 justify-content-center align-items-center mt-2 mb-3 mx-auto border border-3" style="border-radius: 30px; border-color:red; background-color:#F2F1F0;">
                        <img src="<?php echo getImage($item_id); ?>" alt="Image" class="img-fluid rounded-4 mx-auto d-block border-bottom pb-3 pt-4" style="height:250px;width:350px;">
                        <div class="row border-bottom align-items-center text-center mx-auto">
                            <h3 class="col"><?php echo $name; ?></h3>
                            
                        </div>
                        <div class="row text-center d-flex align-items-center mx-auto ms-1 ps-2 pe-3 pb-4 pt-3">
                            <input type="number" value="1" min="0" class="form-control col mx-2" name="item_amount" id="item_amount" placeholder="Amount" aria-label="Item\'s amount" aria-describedby="basic-addon2">
                            <h3 class="col-3" id="price"><?php echo number_format((float)$price, 2, '.', '') . ' лв.'; ?></h3>
                            <button type="submit" name="add_to_cart" class="col-4 btn btn-success">Add to Cart</button>

                        </div>
                    </div>
                </form>
                <?php
                }
                ?>
            </div>
        <?php
        //mysqli_stmt_close($stmt);
    }
        ?>

        </div>
    </div>
}