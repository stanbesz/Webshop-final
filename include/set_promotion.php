<?php
include_once "connection.php";
include_once "check_promotion.php";
if (isset($_POST['set_promotion'])) {
    if (empty($_POST['percent'])) {
        header("Location: ../item_control.php?error=emptyInputPromo");
        exit();
    }
    $price = $_POST['price'];
    $item_id = $_POST["item_id"];
    $percent = $_POST["percent"];
    $date = $_POST['date'];
    $new_price = number_format($price - $price * $percent / 100, 2);
    $sql = "UPDATE items SET price=? WHERE item_id=?";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_error($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../item_control.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_error($stmt);
    mysqli_stmt_bind_param($stmt, "di", $new_price, $item_id);

    $check = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if (!$check) {
        header("Location: ../item_control.php?error=promoFail");
        exit();
    } else {
        $sql = "INSERT INTO
            discount ( item_id, percent_promo, new_price, old_price)
            VALUES(?, ?, ?, ?) ON DUPLICATE KEY
            UPDATE percent_promo = percent_promo + '$percent' - percent_promo * '$percent'/100,
            new_price='$new_price';";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../item_control.php?error=dbaccessFailed");
            die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_error($stmt);
        mysqli_stmt_bind_param($stmt, "iddd", $item_id, $percent, $new_price, $price);
        mysqli_stmt_error($stmt);
        $check = mysqli_stmt_execute($stmt);

        mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);

        header("Location: ../item_control.php?success=promoSet&id=".$item_id);
        exit();
    }
} else if (isset($_POST['unset_promotion'])) {
    $price = $_POST['price'];
    $item_id = $_POST["item_id"];
    $percent = $_POST["percent"];
    $date = $_POST['date'];
    $sql = "UPDATE items INNER JOIN discount ON items.item_id=discount.item_id
            SET items.price = discount.old_price WHERE discount.item_id=?;";


    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_error($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../item_control.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_error($stmt);
    mysqli_stmt_bind_param($stmt, "i", $item_id);

    $check = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if (!$check) {
        header("location: ../item_control.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
    } else {
        $sql = "DELETE FROM discount WHERE item_id=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../item_control.php?error=dbaccessFailed");
            die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_error($stmt);
        mysqli_stmt_bind_param($stmt, "i", $item_id);

        $check = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: ../item_control.php?success=promoUnset&id=".$item_id);
    exit();
}
