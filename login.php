<?php
require_once 'database.php';
session_start();
$mensaje = "";
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $db = Database::conectar();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE usuario_usuario = ? AND usuario_clave = ?");
    $stmt->execute([$usuario, $clave]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    if ($user) {
        $_SESSION['usuario'] = $user->usuario_usuario;
        $_SESSION['rol'] = $user->rol;
        $_SESSION['id'] = $user->usuario_id;
        header("Location: index.php");
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
    <title>© SummerWooll - Inicio de sesion</title>
    <script src="archivesjs/ini.js"></script>
    <link rel="stylesheet" href="styles/ini.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<!-- conexion a index -->
    <div class="container">
<?php include 'header.php'; ?>
<!-- main -->
        <main>
<!-- formulario de inicio de sesion -->
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
        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required><br><br>
        </div>
        <button type="submit" class="btn">Iniciar sesion</button>
    </form>
                <p class="form-footer">¿No tienes cuenta? <a href="res.php">Registrate aca</a></p>
            </section>
        </main>
<!-- footer -->
<?php include 'footer.php'; ?>
    </div>
    <div id="notification" class="notification"></div>
</body>
</html>