<!-- header.php -->
<header>
    <nav>
        <img src="img/icono-FJ.PNG">
        <div class="logo">Function Juntion℗</div>
        <ul>
            <li><a href="ingreso.php">inicio</a></li>
            <li><a href="misvis.php">¿quienes somos?</a></li>
            <li><a href="Contacto.php">Mas de Nosotros</a></li>
            <li><a href="car.php">catalogo</a></li>
            <li><a href="ini.php">Contacto</a></li>
            <?php if (basename($_SERVER['PHP_SELF']) === 'car.php'): ?>
        <li><a href="#cart" id="cart-icon"><i class="fas fa-shopping-cart"></i> <span id="cart-count">0</span></a></li>
    <?php endif; ?>
        </ul>
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header>