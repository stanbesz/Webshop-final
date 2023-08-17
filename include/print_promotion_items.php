<?php
function print_promo_items()
{
    require_once "connection.php";
    include_once "check_promotion.php";
    include_once "check_amount.php";
    


    $items_type = array();
    $sql = "SELECT type FROM items WHERE manu_id=?
        GROUP BY type;";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_error($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../browse_items.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['manu_id']);
    mysqli_stmt_execute($stmt);
    $index = 0;
    $resultData = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($resultData)) { 
        $items_type[$index] = $row;
        $index++;
    }

    mysqli_stmt_close($stmt);


    foreach ($items_type as $type) {
        $sql = "SELECT * FROM items WHERE type=? AND manu_id = ?;";

        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../browse_items.php?error=dbaccessFailed");
            die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        }
        
        mysqli_stmt_bind_param($stmt, "si", $type['type'], $_SESSION['manu_id']);

        mysqli_stmt_error($stmt);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_error($stmt);
?>
        <div class="row mt-3 border-bottom">
            <h6 class="display-6 border-bottom border-2" style="font-size: 24px;"><b><?php echo $type['type'] ?></b></h6>

            <?php 
            $resultData = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($resultData)) { // loop to store the data in an associative array.
                
                $item_id = $row['item_id'];
                $name = $row['name'];
                $price = $row['price'];
                $date = $row['date'];
                if (!checkPromo($item_id)&&getAmount($item_id)>0) {

            ?> <form class="col-sm-4" action="include/set_promotion.php" method="post">
                        <div class="media-29101 justify-content-center align-items-center mt-2 mb-3 mx-auto border border-3 shadow-sm p-2 mb-5 rounded" style="border-radius: 30px; border-color:red; background-color:#F2F1F0;">
                            <img src="<?php echo getImage($item_id); ?>" alt="Image" class="img-fluid rounded-4 mx-auto d-block border-bottom pb-3 pt-4" id="img1" style="height:280px;width:350px;">
                            <div class="row text-center border-bottom mx-auto">
                                <h3 class="col-8"><a href="#"><?php echo $name; ?></a></h3>
                                <h3 class="col-4"><?php echo number_format((float)$price, 2, '.', '') . 'лв.'; ?></h3>
                            </div>
                            <input type="hidden" name="price" value="<?php echo $price ?>">
                            <input type="hidden" name="item_id" value="<?php echo $item_id ?>">
                            <input type="hidden" name="date" value="<?php echo $date ?>">
                            <div class="row text-center d-flex align-items-center mx-auto ms-1 pe-3 pb-3 pt-2">
                                <span class="col-auto">Percentage:</span>
                                <input type="number" min="0" step="5" class="form-control me-2 col" name="percent" placeholder="%" aria-label="Item's amount" aria-describedby="basic-addon2">
                                <button type="submit" name="set_promotion" class="col-auto btn btn-success p-1">Set Discount</button>
                            </div>
                        </div>
                    </form>
                <?php
                } else if (checkPromo($item_id)&&getAmount($item_id)>0) {
                    $promo_row = getPromoRow($item_id);
                ?>
                    <form class="col-sm-4" action="include/set_promotion.php" method="post">
                        <div class="media-29101 justify-content-center align-items-center mt-2 mb-3 border border-3 px-0 shadow-sm p-2 mb-5 rounded" style="border-radius: 30px; border-color:red; background-color:#F2F1F0;">
                            <div id="img_container">
                                <img src="<?php echo getImage($item_id); ?>" id="img1" alt="Image" class="img-fluid  mx-auto d-block border-bottom pb-3 pt-4" style="height:280px;width:350px;">
                                <img src="../images/promo2_small.png" class=" img-fluid pt-2 ms-4 align-self-start"id="img2" >
                            </div>
                            <div class="row text-center border-bottom mx-auto">
                                <h3 class="col-8"><a href="#"><?php echo $name; ?></a></h3>
                                <h3 class="col-4"><?php echo number_format((float)$price, 2, '.', '') . 'лв.'; ?></h3>
                            </div>
                            <input type="hidden" name="price" value="<?php echo $price ?>">
                            <input type="hidden" name="item_id" value="<?php echo $item_id ?>">
                            <input type="hidden" name="date" value="<?php echo $date ?>">
                            <div class="row text-center d-flex align-items-center justify-content-evenly mx-auto ms-1 pe-3 pb-2 pt-2">
                                <span class="col-auto">Percentage:</span>
                                <input type="number" min="0" step="5" class="form-control me-2 col" name="percent" placeholder="%" aria-label="Item's amount" aria-describedby="basic-addon2">
                                <button type="submit" name="set_promotion" class="col-auto btn btn-success p-1">Set Discount</button>
                            </div>
                            <div class="row border-top d-flex align-items-center  justify-content-evenly mx-auto ms-1 pt-2 pe-3 pb-3">
                                <label class="col-4 ps-1 p-0">Original Price:</label>
                                <b class="col-3 text-danger me-4" style="font-size:20px;"><?php echo number_format((float)$promo_row[$item_id]['old_price'], 2, '.', '') . 'лв.';  ?></b>
                                <button type="submit" name="unset_promotion" class="col-auto ms-1 text-center btn btn-danger p-1 px-2 text-right">Unset Sale</button>
                            </div>
                        </div>
                    </form>

            <?php
                }
                else if (getAmount($item_id)==0) {
                    ?>
                            <div class="col-4">
                                <div class=" media-29101 align-items-center mt-2 mb-1 mx-auto border border-3 shadow-sm mb-5 rounded" style="border-radius: 15px; border-color:red; background-color:#F2F1F0;">
                                    <div id="img_sold" class="mx-auto px-auto">
                                        <img src="<?php echo getImage($item_id); ?>" id="img1" alt="Image" class="img-fluid rounded-4 mx-auto d-block border-bottom pb-3 pt-4" style="height:280px;width:350px;">
                                        <img src="../images/sold_out.png" class=" img-fluid pt-2 ms-4 align-self-start" id="img2_sold">
                                    </div>
                                    <div class="row border-bottom align-items-center text-center" style="margin-left:0px;margin-right:0px;">
                                        <h3 class="col text-secondary" style="font-size: 22px;"><?php echo $name; ?></h3>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $item_id; ?>">
                                    <div class="row text-center d-flex align-items-center mx-auto ms-1 ps-2 pe-3 pb-3 pt-3">
                                        <h3 class="col text-danger" style="font-size:22px;">OUT OF STOCK</h3>
                                    </div>
                                </div>
                            </div>
                    <?php
            }
        }
            ?>
        </div>
<?php
        mysqli_stmt_close($stmt);
    }
}
