<?php
require 'config.php';

// Create order via PayPal API (server-side) and return order ID
header('Content-Type: application/json');

$amount = isset($_POST['amount']) ? number_format(floatval($_POST['amount']), 2, '.', '') : '0.00';
if ($amount <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Monto inválido']);
    exit;
}

$base = get_paypal_base();
$token_url = $base . "/v1/oauth2/token";
$client_id = PAYPAL_CLIENT_ID;
$secret = PAYPAL_SECRET;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $client_id . ":" . $secret);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "Accept-Language: en_US"
]);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'Error obteniendo token: ' . curl_error($ch)]);
    exit;
}
$token_data = json_decode($result, true);
$access_token = $token_data['access_token'] ?? null;
if (!$access_token) {
    http_response_code(500);
    echo json_encode(['error' => 'No se obtuvo access token']);
    exit;
}

// Create order
$order_url = $base . "/v2/checkout/orders";
$order_payload = [
    "intent" => "CAPTURE",
    "purchase_units" => [
        [
            "amount" => [
                "currency_code" => "USD",
                "value" => $amount
            ]
        ]
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $order_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $access_token
]);
$order_res = curl_exec($ch);
if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'Error creando orden: ' . curl_error($ch)]);
    exit;
}
$order_data = json_decode($order_res, true);
echo json_encode($order_data);
?>
