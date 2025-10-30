<?php
// res.php - Registro con verificación por email
session_start(); // IMPORTANTE: Debe estar al principio
require_once 'database/database.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';
// Usar las clases de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Inicializar variables
$mensaje = "";
$tipo_mensaje = "error";
// Manejo del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['usuario_nombre'] ?? '';
    $apellido = $_POST['usuario_apellido'] ?? '';
    $usuario = $_POST['usuario_usuario'] ?? '';
    $email = $_POST['usuario_email'] ?? '';
    $clave = $_POST['usuario_clave'] ?? '';
    $confirmar = $_POST['confirmar_clave'] ?? '';
    // Validar contraseñas
    if ($clave !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $db = Database::conectar();
        // Verificar si el usuario ya existe
        $stmt = $db->prepare("SELECT usuario_id FROM usuarios WHERE usuario_usuario = ? OR usuario_email = ?");
        $stmt->execute([$usuario, $email]);
        // Si ya existe, mostrar mensaje de error
        if ($stmt->fetch()) {
            $mensaje = "El usuario o email ya está registrado.";
        } else {
            // Generar código de verificación de 6 dígitos
            $codigo = rand(100000, 999999);
            $_SESSION['codigo_verificacion'] = $codigo;
            $_SESSION['datos_registro'] = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario,
                'email' => $email,
                'clave' => password_hash($clave, PASSWORD_DEFAULT)
            ];
            // Enviar email
            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor
                $mail->isSMTP();
                $mail->Host = 'HOST';
                $mail->SMTPAuth = true;
                $mail->Username = 'EMAIL';
                $mail->Password = 'CONTRASEÑA'; // Usa una contraseña de aplicación
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = PUERTO;
                // Configuración del email
                $mail->setFrom('summerwoollenterprises@gmail.com', 'SummerWooll');
                $mail->addAddress($email, $nombre);
                $mail->CharSet = 'UTF-8';
                // Contenido
                $mail->isHTML(true);
                $mail->Subject = 'Código de Verificación - SummerWooll';
                $mail->Body = "
                    <h2>Bienvenido a SummerWooll</h2>
                    <p>Hola <strong>$nombre</strong>,</p>
                    <p>Tu código de verificación es:</p>
                    <h1 style='color: #4CAF50; font-size: 36px;'>$codigo</h1>
                    <p>Ingresa este código para completar tu registro.</p>
                    <p>El código expira en 10 minutos.</p>
                ";
                // Enviar el email
                $mail->send();
                // Guardar tiempo de expiración (10 minutos)
                $_SESSION['codigo_expira'] = time() + 600;
                // Redirigir a la página de verificación
                header("Location: verificar.php");
                exit;
                // Mensaje de error si falla el envío
            } catch (Exception $e) {
                $mensaje = "Error al enviar el email: {$mail->ErrorInfo}";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- metadatos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>© SummerWooll - Registro</title>
    <!-- scripts -->
    <script src="archivesjs/ini.js"></script>
    <!-- estilos -->
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
<!-- header -->
<?php include 'inc/header.php'; ?>
        <main>
<!-- formulario de registro -->
            <section class="auth-form">
                <h1 title="Crear Cuenta">Crear Cuenta</h1>
                <form id="register-form" method="post">
                    <div class="form-group">
                        <label for="usuario_nombre" title="Nombre">Nombre</label>
                        <input type="text" id="usuario_nombre" name="usuario_nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario_apellido" title="Apellido">Apellido</label>
                        <input type="text" id="usuario_apellido" name="usuario_apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario_usuario" title="Nombre de Usuario">Nombre de Usuario</label>
                        <input type="text" id="usuario_usuario" name="usuario_usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario_email" title="Correo Electrónico">Correo Electrónico</label>
                        <input type="email" id="usuario_email" name="usuario_email" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario_clave" title="Contraseña">Contraseña</label>
                        <input type="password" id="usuario_clave" name="usuario_clave" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmar_clave" title="Confirmar Contraseña" >Confirmar Contraseña</label>
                        <input type="password" id="confirmar_clave" name="confirmar_clave" required>
                    </div>
                    <button type="submit" class="btn" title="Registrar" >Registrar</button>
                </form>
                <p class="form-footer" title="¿Ya Tienes Cuenta?" >¿Ya Tienes Cuenta? <a href="login.php" title="Inicia Sesion aca" >Inicia Sesion aca</a></p>
<?php if ($mensaje): ?>
    <p style="color:green;"><?= $mensaje ?></p>
<?php endif; ?>
            </section>
        </main>
<!-- footer -->
<?php include 'inc/footer.php'; ?>
    </div>
    <!-- notification -->
    <div id="notification" class="notification"></div>
</body>
</html>