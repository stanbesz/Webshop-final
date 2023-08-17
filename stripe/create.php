<?php

require_once 'vendor/autoload.php';

// if (isset($_POST["remove_item"])) {
//   $remove_id = $_POST['remove_item'];
//   foreach ($_SESSION['shopping_cart'] as $key => $product_ids) {
//     if ($product_ids['id'] == $remove_id) {
//       unset($_SESSION['shopping_cart'][$key]);
//     }
//   }
//   $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
// }

// This is your real test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51JCPa0HFB8xdXVrNvATp60qb6Ij5v624FJSkcClnmIIH3n22gGxqaMEhnW8dTY5dMoGCSgi06N9IfCP7S5XIU8l700aNwTwA6S');
function calculateOrderAmount($items): int {
  return $items['total_sum']*100;
}
header('Content-Type: application/json');
try {
  // retrieve JSON from POST body
  $cart = $_SESSION['shopping_cart'];

  $paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => calculateOrderAmount($cart),
    'currency' => 'bgn',
  ]);
  $output = [
    'clientSecret' => $paymentIntent->client_secret,
  ];
  echo json_encode($output);
} catch (Error $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}