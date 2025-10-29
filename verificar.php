<?php
// verificar.php
session_start();
require_once 'database/database.php';

$mensaje = "";

// Verificar que haya datos de registro
if (!isset($_SESSION['codigo_verificacion']) || !isset($_SESSION['datos_registro'])) {
    header("Location: res.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_ingresado = $_POST['codigo'] ?? '';
    
    // Verificar si el código expiró
    if (time() > $_SESSION['codigo_expira']) {
        $mensaje = "El código ha expirado. Por favor, regístrate nuevamente.";
        session_destroy();
    } 
    // Verificar el código
    elseif ($codigo_ingresado == $_SESSION['codigo_verificacion']) {
        // Código correcto, crear el usuario
        $datos = $_SESSION['datos_registro'];
        $db = Database::conectar();
        
        $stmt = $db->prepare("INSERT INTO usuarios (usuario_nombre, usuario_apellido, usuario_usuario, usuario_email, usuario_clave, rol) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$datos['nombre'], $datos['apellido'], $datos['usuario'], $datos['email'], $datos['clave'], 'cliente'])) {
            // Limpiar sesión
            unset($_SESSION['codigo_verificacion']);
            unset($_SESSION['datos_registro']);
            unset($_SESSION['codigo_expira']);
            
            $mensaje = "<span style='color:green;'>¡Cuenta verificada con éxito! <a href='login.php'>Inicia sesión aquí</a></span>";
        } else {
            $mensaje = "Error al crear la cuenta.";
        }
    } else {
        $mensaje = "Código incorrecto. Inténtalo de nuevo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>© SummerWooll - Verificación</title>
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
    <div class="container">
<?php include 'inc/header.php'; ?>
        <main>
            <section class="auth-form">
                <h1>Verificación de Email</h1>
                <p>Hemos enviado un código de 6 dígitos a tu correo electrónico.</p>
                
                <?php if ($mensaje): ?>
                    <p><?= $mensaje ?></p>
                <?php endif; ?>
                
                <form method="post">
                    <div class="form-group">
                        <label for="codigo">Código de Verificación</label>
                        <input type="text" id="codigo" name="codigo" maxlength="6" pattern="[0-9]{6}" required placeholder="123456">
                    </div>
                    <button type="submit" class="btn">Verificar</button>
                </form>
                
                <p class="form-footer"><a href="res.php">Volver al registro</a></p>
            </section>
        </main>
<?php include 'inc/footer.php'; ?>
    </div>
</body>
</html>