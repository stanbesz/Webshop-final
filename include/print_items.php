<?php
require_once "connection.php";
include_once "check_promotion.php";
include_once "check_amount.php";
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
    $sql = "SELECT * FROM items 
            INNER JOIN manufacturers ON items.manu_id=manufacturers.manu_id
            WHERE type=?;";

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
    $resultData = mysqli_stmt_get_result($stmt);
?>

    <h6 class="display-6  mt-3 mx-1 border-bottom border-2 pb-1 section" id="<?php echo $type["type"]; ?>" style="font-size: 24px;"><b><?php echo $type["type"] ?></b></h6>
    <div class="row border-bottom border-2 row_line">
        <?php
        while ($row = mysqli_fetch_assoc($resultData)) { // loop to store the data in an associative array.
            $item_id = $row['item_id'];
            $manu_id = $row['manu_id'];
            $name = $row['name'];
            $price = $row['price'];
            $amount = $row['amount'];
            $date = $row['date'];
            $company_name = $row['company_name'];
            $image = getImage($item_id);
            if (checkPromo($item_id) && getAmount($item_id) > 0) {
        ?>
                <form class="col-sm-4 my-2 form_buy " action="browse_items.php" method="post">
                    <div class="media-29101 mt-2 mb-1 border border-3 shadow-sm p-2 mb-5 rounded" style="border-radius: 15px; border-color:red; background-color:#F2F1F0;">
                        <div id="img_container" class="mx-auto px-auto">
                            <img src="../images/promo2_small.png" class=" img-fluid pt-2 ms-4 align-self-start" id="img2">
                            <img src="<?php echo getImage($item_id); ?>" id="img1" alt="Image" class="img-fluid rounded-4 mx-auto d-block border-bottom pb-3 pt-4">
                        </div>
                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                        <input type="hidden" name="item_image" value="<?php echo $image; ?>">
                        <input type="hidden" name="item_name" value="<?php echo $name; ?>">
                        <input type="hidden" name="company_name" value="<?php echo $company_name; ?>">
                        <div class="row border-bottom align-items-center text-center mx-auto">
                            <h3 class="col text-secondary" style="font-size: 22px;"><?php echo $name; ?></h3>

                        </div>
                        <div class="row border-bottom align-items-center text-center pt-1 mx-auto">
                            <h3 class="col text-primary"><?php echo $company_name; ?></h3>
                        </div>
                        <div class="row text-center d-flex align-items-center mx-auto ms-1 ps-2 pe-3 pb-3 pt-3">
                            <input type="number" min="0" value="1" max="<?php echo getAmount($item_id)?>" class="form-control col " name="item_amount" placeholder="Amount" aria-label="Item\'s amount" aria-describedby="basic-addon2">
                            <h3 class="col-4 mx-auto text-danger price_true" id="price" value="<?php echo $price ?>"><?php echo number_format((float)$price, 2, '.', '') . ' лв.'; ?></h3>
                            <h3 class="col text-secondary date_true" style="display:none;" id="date_true" value=<?php echo $date=preg_replace('/\s+/', '', $date); ?>><?php echo $date; ?></h3>
                            <input type="hidden" name="price_post">
                            <input type="hidden" name="item_price" value="<?php echo $price; ?>">
                            <button type="submit" name="add_to_cart" class="col btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-cart-plus me-2 " viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"></path>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                                </svg>Buy</button>


                        </div>
                    </div>
                </form>
            <?php
            } else if (getAmount($item_id) > 0 && !checkPromo($item_id)) {
            ?>
                <form class="col-sm-4 my-2 form_buy" action="browse_items.php" method="post">
                    <div class="media-29101 justify-content-center align-items-center mt-2 mb-1 mx-auto border border-3 shadow-sm p-2 mb-5 rounded" style="border-radius: 15px; border-color:red; background-color:#F2F1F0;">
                        <img src="<?php echo getImage($item_id); ?>" alt="Image" class="img-fluid  mx-auto d-block border-bottom pb-3 pt-4" style="object-fit:contain;height:280px;width:350px;">
                        <div class="row border-bottom align-items-center text-center" style="margin-left:0px;margin-right:0px;">
                            <h3 class="col text-secondary" style="font-size: 22px;"><?php echo $name; ?></h3>
                            <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                            <input type="hidden" name="item_image" value="<?php echo $image; ?>">
                            <input type="hidden" name="item_name" value="<?php echo $name; ?>">
                            <input type="hidden" name="company_name" value="<?php echo $company_name; ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $item_id; ?>">
                        <div class="row border-bottom align-items-center text-center pt-1 mx-auto">
                            <h3 class="col text-primary"><?php echo $company_name; ?></h3>
                        </div>
                        <div class="row text-center d-flex align-items-center mx-auto ms-1 ps-2 pe-3 pb-3 pt-3">
                            <input type="number" value="1" max="<?php echo getAmount($item_id)?>" min="0" class="form-control col" name="item_amount" placeholder="Amount" aria-label="Item\'s amount" aria-describedby="basic-addon2">
                            <h3 class="col-4 mx-auto price_true" id="price"><?php echo number_format((float)$price, 2, '.', '') . ' лв.'; ?></h3>
                            <h3 class="col text-secondary date_true" style="display:none;" id="date_true" value=<?php echo $date=preg_replace('/\s+/', '', $date); ?>><?php echo $date; ?></h3>
                            <input type="hidden" name="item_price" value="<?php echo $price; ?>">
                            <button type="submit" name="add_to_cart" class="col btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-cart-plus me-2 " viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"></path>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                                </svg>Buy</button>

                        </div>
                    </div>
                </form>
            <?php
            } else if (getAmount($item_id) == 0) {
            ?>
            <div class="col-sm-4 my-2">
                <div class=" media-29101 align-items-center mt-2 mb-1 mx-auto border border-3 shadow-sm mb-5 rounded" style="border-radius: 15px; border-color:red; background-color:#F2F1F0;">
                    <div id="img_sold" class="mx-auto px-auto">
                        <img src="<?php echo getImage($item_id); ?>" id="img1" alt="Image" class="img-fluid rounded-4 mx-auto d-block border-bottom pb-3 pt-4">
                        <img src="../images/sold_out.png" class=" img-fluid pt-2 ms-4 align-self-start" id="img2_sold">
                    </div>
                    <div class="row border-bottom align-items-center text-center" style="margin-left:0px;margin-right:0px;">
                        <h3 class="col text-secondary" style="font-size: 22px;"><?php echo $name; ?></h3>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $item_id; ?>">
                    <h3 class="col text-secondary date_true" style="display:none;" id="date_true" value=<?php echo $date=preg_replace('/\s+/', '', $date); ?>><?php echo $date; ?></h3>
                    <h3 class="col-4 mx-auto text-danger price_true" style="display:none;" id="price" value="<?php echo $price ?>"><?php echo number_format((float)$price, 2, '.', '') . ' лв.'; ?></h3>
                    <div class="row border-bottom align-items-center text-center pt-1 mx-auto">
                        <h3 class="col text-primary"><?php echo $company_name; ?></h3>
                    </div>
                    <div class="row text-center d-flex align-items-center mx-auto ms-1 ps-2 pe-3 pb-3 pt-3">
                        <h3 class="col text-danger" style="font-size:22px;">OUT OF STOCK</h3>
                    </div>
                </div>
            </div>
        <?php
            }
        }
        mysqli_stmt_close($stmt);

        echo '</div>';

        //mysqli_stmt_close($stmt);
    }
