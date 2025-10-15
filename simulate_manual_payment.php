<?php
require_once 'database.php';
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);
$method = $input['method'] ?? 'manual';
$amount = isset($input['amount']) ? floatval($input['amount']) : 0.0;

$txn = 'sim_' . uniqid();
try {
    $db = Database::conectar();
    $db->exec("CREATE TABLE IF NOT EXISTS payments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        transaction_id VARCHAR(255),
        method VARCHAR(100),
        amount DECIMAL(12,2),
        status VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    $stmt = $db->prepare("INSERT INTO payments (transaction_id, method, amount, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$txn, $method, $amount, 'completed']);
    echo json_encode(['ok' => true, 'txn' => $txn]);
} catch (Exception $e) {
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
?>
