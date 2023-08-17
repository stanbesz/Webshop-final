<?php
session_start();
$_SESSION['in_checkout']=false;
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51JCPa0HFB8xdXVrNvATp60qb6Ij5v624FJSkcClnmIIH3n22gGxqaMEhnW8dTY5dMoGCSgi06N9IfCP7S5XIU8l700aNwTwA6S');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://stanswebshop/try_stripe';

$currency = 'bgn';
$line_items_array=array();
foreach ($_SESSION['shopping_cart'] as $key => $product) {

  $line_items_array[] = array(
    'price_data' => array(
      'currency' => $currency,
      'unit_amount' => $product['price'] * 100,
      'product_data' => array(
        'name' => $product['name'],
        'images' => array('https://i.imgur.com/rz2n8AJ.png'),
      ),
    ),
    'quantity' => $product['item_amount'],
  );
}


$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => $line_items_array,
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php?success=payment',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php?error=payment',
  'customer_email' => $_SESSION['email'],
]);

$_SESSION['in_checkout']=true;
header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);