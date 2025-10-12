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
<style>
.modal {
    position: fixed; z-index: 9999; left: 0; top: 0; width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center;
}
.modal-content {
    background: #fff; padding: 2rem; border-radius: 10px; max-width: 350px; width: 90%; text-align: center; position: relative;
}
.close-modal {
    position: absolute; right: 1rem; top: 1rem; font-size: 2rem; cursor: pointer; color: #8e44ad;
}
.modal-image {
    width: 100%; max-width: 200px; border-radius: 8px; margin-bottom: 1rem;
}
</style>
</body>
</html>