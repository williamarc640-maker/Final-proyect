<!-- header.php -->
<header>
    <nav>
        <img src="img/icono-SW.png">
        <div class="logo">© SummerWooll</div>
        <ul>
<!-- enlaces de navegacion -->
            <li><a href="index.php">inicio</a></li>
            <li><a href="login.php">Iniciar sesion</a></li>
            <li><a href="car.php">Catalogo</a></li>
            <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado')): ?>
                <li><a href="index2.php">Usuarios</a></li>
                <li><a href="index2.php?action=productos">Administrar productos</a></li>
            <?php endif; ?>
<!-- mostrar enlace de cerrar sesion si el usuario ha iniciado sesion -->
            <?php if (isset($_SESSION['usuario'])): ?>
                <li><a href="logout.php">Cerrar sesión</a></li>
            <?php endif; ?>
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