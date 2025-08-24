<?php
session_start();
$mensaje = "";
if (isset($_SESSION['usuario'])) {
    header("Location: index2.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_valido = "admin";
    $contraseña_valida = "1234";
    $usuario = $_POST['usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    if ($usuario === $usuario_valido && $contraseña === $contraseña_valida) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index2.php");
        exit;
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Juntion℗ - Inicio de sesion</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script src="ini.js"></script>
    <link rel="stylesheet" href="ini.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <div class="logo">Function Juntion℗</div>
                <ul>
                    <li><a href="index.php">inicio</a></li>
                    <li><a href="misvis.php">¿quienes somos?</a></li>
                    <li><a href="car.php">catalogo</a></li>
                    <li><a href="Contacto.php">Mas de Nosotros</a></li>
                    <li><a>|</a></li>
                    <li><a href="res.php">Registrarse</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section class="auth-form">
                <h1>Bienvenido</h1>
    <?php if ($mensaje): ?>
        <p style="color:red;"><?= $mensaje ?></p>
    <?php endif; ?>
    <form id="login-form" method="post">
        <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        </div>
        <div class="form-group">
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br><br>
        </div>
        <button type="submit" class="btn">Iniciar sesion</button>
    </form>
                <p class="form-footer">¿No tienes cuenta? <a href="res.php">Registrate aca</a></p>
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
    </div>
    <div id="notification" class="notification"></div>
</body>
</html>