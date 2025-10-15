<?php
require_once 'database.php';
$txn = isset($_GET['txn']) ? $_GET['txn'] : '';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Pago exitoso</title></head>
<body>
<?php include 'header.php'; ?>
<main style="padding:24px">
  <h2>Pago completado</h2>
  <p>Gracias por su compra. Transacción: <strong><?php echo htmlspecialchars($txn); ?></strong></p>
  <a href="index.php">Volver a la tienda</a>
</main>
<?php include 'footer.php'; ?>
</body>
</html>
