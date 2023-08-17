<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Stanimir Aleksandrov">
    <meta http-equiv="" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stan's Company</title>
    <link rel="stylesheet" href="styles_boot/css/bootstrap.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="css/bg_image.css" type="text/css" charset="utf-8">
    <link rel="shortcut icon" href="images/shop.svg">
</head>

<body class="bg-image">

    <div class="container">
        <div class="container position-absolute top-50 start-50 p-5 translate-middle text-center bg-dark text-light col-4" style="border-radius: 25px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" fill="currentColor" style="color:#EB984E" class="bi bi-cash-stack img-fluid" viewBox="0 0 16 16">
                <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
            </svg>
            <h1 class="h4 my-2 pt-2 font-weight-normal text-center border-top"> Please insert you payment credentials</h1>
            <?php
            include_once 'stripe/vendor/autoload.php';
               \Stripe\Stripe::setApiKey('sk_test_51JCPa0HFB8xdXVrNvATp60qb6Ij5v624FJSkcClnmIIH3n22gGxqaMEhnW8dTY5dMoGCSgi06N9IfCP7S5XIU8l700aNwTwA6S');

               $intent = \Stripe\PaymentIntent::create([
                 'amount' => 1099,
                 'currency' => 'bgn',
                 // Verify your integration in this guide by including this parameter
                 'metadata' => ['integration_check' => 'accept_a_payment'],
               ]);
            ?>
            <form id="payment-form" data-secret="<?= $intent->client_secret ?>">
                <div id="card-element" class="form-control">
                    <!-- Elements will create input elements here -->
                </div>

                <!-- We'll put the error messages in this element -->
                <div id="card-errors" role="alert"></div>

                <button id="card-button" class="btn btn-success">Submit Payment</button>
            </form>
            <small class="mt-3" style="font-size: 15px; color:#C3C2C1">@Stan's Webshop</small>
        </div>
    </div>

    <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
    <script src="styles_boot/js/bootstrap.js"></script>

</body>

</html>