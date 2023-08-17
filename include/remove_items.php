<?php
require_once "connection.php";
if (isset($_POST['amount_button'])) {
    if (empty($_POST['remove_amount'])) {
        header("location: ../item_control.php?error=emptyInput");
        exit();
    }
    $item_id = $_POST["item_id"];
    $amount = $_POST["amount"];
    $remove_amount = $_POST["remove_amount"];
    $result_division = $amount - $remove_amount;
    if ($result_division > 0) {
        
        $sql = "UPDATE items 
            SET amount=amount-? WHERE item_id=?";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../item_control.php?error=dbaccessFailed");
            die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_error($stmt);
        $check = mysqli_stmt_bind_param($stmt, "ii", $remove_amount, $item_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../item_control.php?deleted=amountReduced&id=".$_POST['item_id']);
        exit();
    } else {
        
        $sql = "DELETE FROM items WHERE item_id=?;";

        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../user_info.php?error=dbaccessFailed");
            die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_bind_param($stmt, "i", $item_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_error($stmt);

        mysqli_stmt_close($stmt);
        header("location: ../item_control.php?deleted=itemsDeleted&id=".$_POST['item_id']);
        exit();
    }
} else if (isset($_POST['remove_item'])) {
    $sql = "DELETE FROM items WHERE item_id=?;";
    print_r($_POST);
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_error($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user_info.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_bind_param($stmt, "i", $_POST['item_id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_error($stmt);

    echo $item_id;
    mysqli_stmt_close($stmt);
    header("location: ../item_control.php?deleted=itemsDeleted&id=".$_POST['item_id']);
    exit();
} else {
    header("Location: ../item_control.php?error=nobutton");
    exit();
}
