<!-- header.php -->
<header>
    <nav>
        <img src="./inc/icono-SW.png" alt="Logo" class="nav-logo">
        <div class="logo" title="© SummerWooll" >© SummerWooll</div>
        <ul>
<!-- enlaces de navegacion -->
            <li><a href="index.php" title="inicio" >inicio</a></li>
<!-- mostrar enlace de iniciar sesion si el usuario no ha iniciado sesion -->
            <?php if (!isset($_SESSION['usuario'])): ?>
                <li><a href="login.php" title="Iniciar sesion">Iniciar sesion</a></li>
            <?php endif; ?>
            <li><a href="car.php" title="Catalogo" >Catalogo</a></li>
<!-- mostrar enlaces de administracion si el usuario es admin o empleado -->
            <?php if (isset($_SESSION['rol']) && ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado')): ?>
                <li><a href="index.php" title="Administrar Usuarios">Administrar Usuarios</a></li>
                <li><a href="index.php?action=productos" title="Administrar productos" >Administrar productos</a></li>
                <li><a href="index.php?action=categorias" title="Administrar categorías" >Administrar categorías</a></li>
            <?php endif; ?>
<!-- mostrar enlace de cerrar sesion si el usuario ha iniciado sesion -->
            <?php if (isset($_SESSION['usuario'])): ?>
                <li><a href="logout.php" title="Cerrar sesión">Cerrar sesión</a></li>
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
</header>\n<script src="chatbot_widget.js"></script>\n