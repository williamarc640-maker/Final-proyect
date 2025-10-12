<?php
require_once 'database.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['usuario_nombre'] ?? '';
    $apellido = $_POST['usuario_apellido'] ?? '';
    $usuario = $_POST['usuario_usuario'] ?? '';
    $email = $_POST['usuario_email'] ?? '';
    $clave = $_POST['usuario_clave'] ?? '';
    $confirmar = $_POST['confirmar_clave'] ?? '';
    if ($clave !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO usuarios (usuario_nombre, usuario_apellido, usuario_usuario, usuario_email, usuario_clave, rol) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellido, $usuario, $email, $clave, 'empleado']);
        $mensaje = "Usuario registrado correctamente. <a href='login.php'>Inicia sesión aquí</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>© SummerWooll - Registro</title>
    <script src="archivesjs/ini.js"></script>
    <link rel="stylesheet" href="styles/ini.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        <label for="usuario_nombre">Nombre</label>
                        <input type="text" id="usuario_nombre" name="usuario_nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario_apellido">Apellido</label>
                        <input type="text" id="usuario_apellido" name="usuario_apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario_usuario">Nombre de Usuario</label>
                        <input type="text" id="usuario_usuario" name="usuario_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario_email">Correo Electrónico</label>
                        <input type="email" id="usuario_email" name="usuario_email" required>
                    </div>
                    <div class="form-group">sip
                        <label for="usuario_clave">Contraseña</label>
                        <input type="password" id="usuario_clave" name="usuario_clave" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmar_clave">Confirmar Contraseña</label>
                        <input type="password" id="confirmar_clave" name="confirmar_clave" required>
                    </div>
                    <button type="submit" class="btn">Registrar</button>
                </form>
                <p class="form-footer">¿Ya Tienes Cuenta? <a href="login.php">Inicia Sesion aca</a></p>
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