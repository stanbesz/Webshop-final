<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Accept a card payment</title>
  <meta name="description" content="A demo of a card payment on Stripe" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="global.css" />
  <link rel="stylesheet" href="../styles_boot/css/bootstrap.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="../css/bg_image.css" type="text/css" charset="utf-8">
  <link rel="shortcut icon" href="../images/shop.svg">
  <script src="https://js.stripe.com/v3/"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
  <script src="/client.js" defer></script>
  <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="bg-image">
  <div class="container">
    <div class="container position-absolute top-50 start-50 p-5 translate-middle text-center bg-dark text-light col-4" style="border-radius: 25px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="190" height="190" style="color:#EB984E" fill="currentColor" class="mb-2 bi bi-person-square" viewBox="0 0 16 16">
        <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
        <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
      </svg>
      <h1 class="h4 pt-2 font-weight-normal text-center border-top"> Please Enter your information!</h1>
      <!-- Display a payment form -->
      <?php
      session_start();
      //print_r($_POST);
      //print_r($_SESSION);
      //require "create.php";
      ?>
      <form id="payment-form">
        <div id="card-element">
          <!--Stripe.js injects the Card Element-->
        </div>
        <button id="submit">
          <div class="spinner hidden" id="spinner"></div>
          <span id="button-text">Pay now</span>
        </button>
        <p id="card-error" role="alert"></p>
        <p class="result-message hidden">
          Payment succeeded, see the result in your
          <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
        </p>
      </form>
      
      <small class="mt-3" style="font-size: 15px; color:#C3C2C1">@Stan's Webshop</small>
    </div>
  </div>

  <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
  <script src="styles_boot/js/bootstrap.js"></script>

</body>


</html>