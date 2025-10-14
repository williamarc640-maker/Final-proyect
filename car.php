<!-- car.php -->
<!-- codigo para obtener los productos de la base de datos -->
<?php
require_once 'gestion/producto.php';
$productos = Producto::obtenerTodo();
?>
<!-- codigo HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SummerWooll℗ - Catálogo</title>
<!-- estilos y scripts -->
    <link rel="stylesheet" href="styles/car.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        window.productos = <?= json_encode($productos) ?>;
    </script>
    <script src="archivesjs/car.js" defer></script>
</head>
<body>
<!-- header -->
<?php include 'inc/header.php'; ?>
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
<!-- notificacion -->
<div id="notification" class="notification"></div>
<!-- Modal de detalles del producto -->
<div id="product-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal" id="close-modal">&times;</span>
        <img id="modal-image" src="" alt="" class="modal-image">
        <h3 id="modal-title"></h3>
        <p id="modal-category"></p>
        <p id="modal-price"></p>
        <p id="modal-stock"></p>
        <button id="modal-add-cart" class="btn">Añadir al Carrito</button>
    </div>
</div>
<!-- footer -->
<?php include 'inc/footer.php'; ?>
</body>
</html>