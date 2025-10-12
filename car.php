<?php
require_once 'producto.php';
$productos = Producto::obtenerTodo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SummerWooll℗ - Catálogo</title>
    <link rel="stylesheet" href="styles/car.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        window.productos = <?= json_encode($productos) ?>;
    </script>
    <script src="archivesjs/car.js" defer></script>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <section id="catalog" class="catalog">
        <h1>Nuestro catálogo</h1>
        <div class="product-grid" id="product-grid">
            <!-- Los productos se renderizan por JS -->
        </div>
    </section>
    <section id="cart" class="cart">
        <h2>Carrito de compra</h2>
        <div id="cart-items"></div>
        <div class="cart-total">
            <strong>Total: COP <span id="cart-total">0.00</span></strong>
        </div>
        <button id="checkout-btn" class="btn">Comprar</button>
    </section>
</main>
<?php include 'footer.php'; ?>
<div id="notification" class="notification"></div>
</body>
</html>