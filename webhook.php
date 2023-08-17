<?php

require "stripe/vendor/autoload.php";
$payload = @file_get_contents('php://input');
$event = null;

ob_start();
var_dump($payload);
error_log(ob_get_clean(), 4);

print_r($_POST);
print_r($event);
try {
    $event = \Stripe\Event::constructFrom(
        json_decode($payload, true)
    );
} catch (\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
}

// Handle the event
switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
        // Then define and call a method to handle the successful payment intent.
        // handlePaymentIntentSucceeded($paymentIntent);
        break;
    case 'payment_method.attached':
        $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
        // Then define and call a method to handle the successful attachment of a PaymentMethod.
        // handlePaymentMethodAttached($paymentMethod);
        break;
    case 'customer.created':
        $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
        // Then define and call a method to handle the successful attachment of a PaymentMethod.
        // handlePaymentMethodAttached($paymentMethod);
        break;
        // ... handle other event types
    default:
        echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);
