<?php
require 'config.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$orderID = $input['orderID'] ?? null;
if (!$orderID) {
    http_response_code(400);
    echo json_encode(['error' => 'orderID requerido']);
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

$capture_url = $base . "/v2/checkout/orders/{$orderID}/capture";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $capture_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $access_token
]);
$capture_res = curl_exec($ch);
if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'Error capturando: ' . curl_error($ch)]);
    exit;
}
$capture_data = json_decode($capture_res, true);

// Optionally: store capture info in DB payments table
try {
    require_once 'database/database.php';
    $db = Database::conectar();
    $db->exec("CREATE TABLE IF NOT EXISTS payments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        transaction_id VARCHAR(255),
        method VARCHAR(100),
        amount DECIMAL(12,2),
        status VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    $txn = $capture_data['purchase_units'][0]['payments']['captures'][0]['id'] ?? ($capture_data['id'] ?? 'unknown');
    $amount = $capture_data['purchase_units'][0]['payments']['captures'][0]['amount']['value'] ?? 0;
    $stmt = $db->prepare("INSERT INTO payments (transaction_id, method, amount, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$txn, 'paypal', $amount, 'completed']);
} catch (Exception $e) {
    // ignore DB errors silently
}

echo json_encode($capture_data);
?>
