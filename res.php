<?php
require_once 'database.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'] ?? '';
    $correo = $_POST['email'] ?? '';
    $contraseña = $_POST['password'] ?? '';
    $confirmar = $_POST['confirm-password'] ?? '';
    if ($contraseña !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $correo, $contraseña, 'empleado']);
        $mensaje = "Usuario registrado correctamente. <a href='ini.php'>Inicia sesión aquí</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant Hunter - Register</title>
    <script src="archivesjs/ini.js"></script>
    <link rel="stylesheet" href="styles/ini.css">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
    <div class="container">
<!-- header -->
<?php include 'header.php'; ?>
        <main>
<!-- formulario de registro -->
            <section class="auth-form">
                <h1>Crear Cuenta</h1>
                <form id="register-form" method="post">
                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Gmail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirmar Contraseña</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <button type="submit" class="btn">Registrar</button>
                </form>
                <p class="form-footer">¿Ya Tienes Cuenta? <a href="ini.php">Inicia Sesion aca</a></p>
<?php if ($mensaje): ?>
    <p style="color:green;"><?= $mensaje ?></p>
<?php endif; ?>
            </section>
        </main>
<!-- footer -->
<?php include 'footer.php'; ?>
    </div>
    <div id="notification" class="notification"></div>
</body>
</html>