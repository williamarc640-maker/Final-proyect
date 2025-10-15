
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pasarela de Pago</title>
<link rel="stylesheet" href="styles/payment.css">
</head>
<body>
  <div class="container">
    <h2>Resumen del Pedido</h2>
    <div class="summary">
      <p><strong>Producto:</strong> Suscripción Premium</p>
      <p><strong>Cantidad:</strong> 1</p>
      <p><strong>Total:</strong> COP 45.000</p>
    </div>
    <form action="payment_success.php" method="POST">
      <input type="text" placeholder="Nombre en la tarjeta" required>
      <input type="number" placeholder="Número de tarjeta" required>
      <input type="text" placeholder="Fecha de vencimiento (MM/AA)" required>
      <input type="number" placeholder="CVV" required>
      <button type="submit" class="realizar">Realizar pago</button>
      <button type="button" class="cancelar" onclick="window.location.href='payment_cancel.php'">Cancelar</button>
    </form>
  </div>
</body>
</html>
