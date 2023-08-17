<?php
include_once "connection.php";

if (isset($_SESSION['user_id'])) { 
  $product_ids = array();
  if (isset($_POST["add_to_cart"])) {

    if (isset($_SESSION['shopping_cart'])) {

      $count = count($_SESSION['shopping_cart']);

      $product_ids = array_column($_SESSION['shopping_cart'], 'id');

      if (!in_array($_POST['item_id'], $product_ids)) {

        $_SESSION['shopping_cart'][$count] = array(
          'id' => $_POST['item_id'],
          'name' => $_POST['item_name'],
          'image' => $_POST['item_image'],
          'price' => $_POST['item_price'],
          'company_name' => $_POST['company_name'],
          'item_amount' => $_POST['item_amount'],
        );
      } else {
        for ($i = 0; $i < count($product_ids); $i++) {
          if ($product_ids[$i] == $_POST['item_id']) {
            $_SESSION['shopping_cart'][$i]['item_amount'] += $_POST['item_amount'];
          }
        }
      }
    } else {
      $_SESSION['shopping_cart'][0] = array(
        'id' => $_POST['item_id'],
        'name' => $_POST['item_name'],
        'image' => $_POST['item_image'],
        'price' => $_POST['item_price'],
        'company_name' => $_POST['company_name'],
        'item_amount' => $_POST['item_amount'],
      );
    }
  }
  if (isset($_POST["remove_item"])) {
    $remove_id = $_POST['remove_item'];
    foreach ($_SESSION['shopping_cart'] as $key => $product_ids) {
      if ($product_ids['id'] == $remove_id) {
        unset($_SESSION['shopping_cart'][$key]);
      }
    }
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
  }
  if (isset($_POST['checkout_cart'])) {

    header("location: ../stripe/checkout.php");
  }
}
