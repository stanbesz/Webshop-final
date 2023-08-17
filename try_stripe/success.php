<html>

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Stanimir Aleksandrov">
  <meta http-equiv="" content="30">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stan's Company</title>
  <link rel="stylesheet" href="../styles_boot/css/bootstrap.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="../css/bg_image.css" type="text/css" charset="utf-8">
  <link rel="shortcut icon" href="../images/shop.svg">
</head>

<body class="bg-image">
  <div class="container">
    <?php
    session_start();
    include_once "../include/connection.php";
    if (isset($_SESSION['in_checkout']) && $_SESSION['in_checkout'] == true) {
      foreach ($_SESSION['shopping_cart'] as $key => $product_ids) {
        $company_name = $_SESSION['shopping_cart'][$key]['company_name'];
        $sql = "INSERT INTO `transactions` 
            (`user_id` ,`item_id` ,`item_price` ,`item_amount` ,`trans_date`)
            VALUES (?,?,?,?,CURRENT_TIMESTAMP);";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../browse_items.php?error=dbaccessFailed");
          die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_bind_param(
          $stmt,
          "iidi",
          $_SESSION['user_id'],
          $_SESSION['shopping_cart'][$key]['id'],
          $_SESSION['shopping_cart'][$key]['price'],
          $_SESSION['shopping_cart'][$key]['item_amount']
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $sql = "UPDATE items SET items.amount = items.amount - 
        " . $_SESSION['shopping_cart'][$key]['item_amount'] . " WHERE items.item_id=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../browse_items.php?error=dbaccessFailed");
          die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['shopping_cart'][$key]['id']);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
      }

      unset($_SESSION['shopping_cart']);
      unset($_SESSION['in_checkout']);
      
    } else {
    }
    ?>
    <div class="container position-absolute top-50 start-50 p-5 translate-middle text-center bg-dark text-light col-4" style="border-radius: 25px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" style="color:#EB984E" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
      </svg>
      <h1 class="h4 my-2 pt-2 mt-5 font-weight-normal text-center border-top"> Thank you for your purchase!</h1>
      <div class="row pb-3 mt-3 border-bottom"><button type="button" class="btn btn-primary" onclick="location.href='../index.php?purchase=success';">Back to Start</button></div>
      <small class="mt-5" style="font-size: 15px; color:#C3C2C1">@Stan's Webshop</small>
    </div>
  </div>

  <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
  <script src="styles_boot/js/bootstrap.js"></script>

</body>

</html>