<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Juntion℗ - catalogo</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script src="car.js"></script>
    <link rel="stylesheet" href="car.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Function Juntion℗</div>
            <ul>
                <li><a href="index.php">inicio</a></li>
                <li><a href="misvis.php">¿quienes somos?</a></li>
                <li><a href="Contacto.php">Mas de Nosotros</a></li>
                <li><a href="ini.php">Contacto</a></li>
                <li><a>|</a></li>
                <li><a href="#catalog">Catalogo</a></li>
                <li><a href="#cart" id="cart-icon"><i class="fas fa-shopping-cart"></i> <span id="cart-count">0</span></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="catalog" class="catalog">
            <h1>Nuestro catalogo</h1>
            <div class="product-grid" id="product-grid">
                <!-- Products will be dynamically added here -->
            </div>
        </section>
        <section id="cart" class="cart">
            <h2>carrito de compra</h2>
            <div id="cart-items">
                <!-- Cart items will be dynamically added here -->
            </div>
            <div class="cart-total">
                <strong>Total: COP<span id="cart-total">0.00</span></strong>
            </div>
          <li><a href="ini.php" style="text-decoration: none;"> <button id="checkout-btn" class="btn">Comprar</button></a></li> 
        </section>
    </main>
    <footer>
        <div class="footer-content">
            <div class="social-links">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
            <p>&copy; 2024 Function Juntion℗. All rights reserved.</p>
        </div>
    </footer>
    <div id="notification" class="notification"></div>
    <script src="script.js"></script>
</body>
</html>