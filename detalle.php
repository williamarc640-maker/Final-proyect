<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Usuario</title>
    <link rel="stylesheet" href="styles/detalle.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- Detalle de usuario -->
    <h2>Detalle de Usuario</h2>
    <div class="detalle-container">
    <?php if ($usuario): ?>
        <p><strong>ID:</strong> <?= htmlspecialchars($usuario->usuario_id) ?></p>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario->usuario_nombre) ?></p>
        <p><strong>Apellido:</strong> <?= htmlspecialchars($usuario->usuario_apellido) ?></p>
        <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario->usuario_usuario) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($usuario->usuario_email) ?></p>
        <p><strong>Contraseña:</strong> <?= htmlspecialchars($usuario->usuario_clave) ?></p>
        <p><strong>Rol:</strong> <?= htmlspecialchars($usuario->rol) ?></p>
    <?php else: ?>
        <p>No se encontró el usuario.</p>
    <?php endif; ?>
    </div>
    <div class="volver-container">
        <a href="index.php" class="volver">Volver</a>
    </div>
    <!-- footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
