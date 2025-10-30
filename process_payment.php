<?php
require 'config.php';
header('Content-Type: application/json');

try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 20000, // 💲 valor en centavos (20000 = $200)
        'currency' => 'cop',
        'description' => 'Compra en Tienda Online',
        'automatic_payment_methods' => ['enabled' => true],
    ]);
    echo json_encode(['paymentIntent' => $paymentIntent]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
