<!-- header.php -->
<header>
    <nav>
        <img src="img/icono-FJ.PNG">
        <div class="logo">© Function Juntion</div>
        <ul>
<!-- enlaces de navegacion -->
            <li><a href="index.php">inicio</a></li>
            <li><a href="ini.php">Iniciar sesion</a></li>
            <li><a href="car.php">Catalogo</a></li>
<!-- carrito de compras, solo se muestra en car.php -->
            <?php if (basename($_SERVER['PHP_SELF']) === 'car.php'): ?>
                <li><a href="#cart" id="cart-icon"><i class="fas fa-shopping-cart"></i> <span id="cart-count">0</span></a></li>
            <?php endif; ?>
        </ul>
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header> 