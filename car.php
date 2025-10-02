<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SummerWooll℗ - catalogo</title>
<!-- links -->
    <script src="archivesjs/car.js"></script>
    <link rel="stylesheet" href="styles/car.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<!-- header -->
<?php include 'header.php'; ?>
<!-- main -->
    <main>
<!-- catalog -->
        <section id="catalog" class="catalog">
            <h1>Nuestro catalogo</h1>
            <div class="product-grid" id="product-grid">
<!-- Products will be dynamically added here -->
            </div>
        </section>
<!-- cart -->
        <section id="cart" class="cart">
            <h2>carrito de compra</h2>
            <div id="cart-items">
<!-- Cart items will be dynamically added here -->
            </div>
<!-- total -->
            <div class="cart-total">
                <strong>Total: COP<span id="cart-total">0.00</span></strong>
            </div>
<!-- checkout button -->
            <li><a href="ini.php" style="text-decoration: none;"> <button id="checkout-btn" class="btn">Comprar</button></a></li> 
        </section>
    </main>
<!-- footer -->
<?php include 'footer.php'; ?>
<!-- notification -->
    <div id="notification" class="notification"></div>
</body>
</html>