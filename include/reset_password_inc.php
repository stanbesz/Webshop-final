<?php
if (isset($_POST["reset_password_submit"])) {
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['password_reset'];
    $confirmPassword = $_POST['confirmPassword_reset'];

    $currentDate = date("U");

    require_once "connection.php";

    $sql = "SELECT * FROM change_password WHERE selector=? AND expires >=$currentDate";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Error with statement preparing");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "Resubmit reset request";
        } else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = strcmp($tokenBin, $row['token']);
            if ($tokenCheck === false) {
                die("Please submit reset request.");
            } else if ($tokenCheck === 0) {

                $user_id = $row['change_id'];
                $sql = "SELECT * FROM users WHERE user_id=?;";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {

                    die("Error with statement preparing");
                } else {

                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (!$row = mysqli_fetch_assoc($result)) {
                        die("Error with statement!");
                    } else {

                        $sql = "UPDATE users SET password=? WHERE user_id=?;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            die("Error with statement preparing");
                        } else {
                            $newHashedPass = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "si", $newHashedPass, $user_id);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM change_password WHERE change_id=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                die("Error with preparing of statement");
                            } else {
                                mysqli_stmt_bind_param($stmt, "i", $user_id);
                                mysqli_stmt_execute($stmt);
                                header("Location:../login.php?newPass=passUpdated");
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: ../index.php");
}
