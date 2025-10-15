<?php
session_start();
require_once 'database.php';

$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
$method = isset($_POST['method']) ? $_POST['method'] : 'unknown';

if ($amount <= 0) {
    die('Monto inválido.');
}

// Simulate payment processing
$status = 'pending';
$transaction_id = uniqid('txn_');

if ($method === 'paypal' || $method === 'card') {
    // NOTE: Here you would call PayPal SDK / API using client/server credentials.
    // If you provide credentials in a config file, this script could perform live calls.
    $status = 'completed'; // simulated
} elseif ($method === 'nequi' || $method === 'daviplata') {
    // NOTE: For Nequi / Daviplata integrate their APIs or create a payment link.
    $status = 'completed'; // simulated
} else {
    $status = 'failed';
}

// Save to a payments table (create table if doesn't exist)
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
    $stmt->execute([$transaction_id, $method, $amount, $status]);
} catch (Exception $e) {
    error_log('DB error: '.$e->getMessage());
    // continue, don't expose DB errors to user
}

?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Resultado Pago</title></head><body>
<?php include 'header.php'; ?>
<main>
  <h1>Resultado del pago</h1>
  <p>Transacción: <strong><?php echo htmlspecialchars($transaction_id); ?></strong></p>
  <p>Método: <strong><?php echo htmlspecialchars($method); ?></strong></p>
  <p>Monto: <strong><?php echo htmlspecialchars(number_format($amount,2)); ?> COP</strong></p>
  <p>Estado: <strong><?php echo htmlspecialchars($status); ?></strong></p>
  <p>Si deseas integrar las pasarelas reales, abre <code>process_payment.php</code> y sigue los comentarios donde se indican los SDK/API.</p>
  <a href="index.php">Volver</a>
</main>
<?php include 'footer.php'; ?>
</body></html>
