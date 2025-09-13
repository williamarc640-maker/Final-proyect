<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Usuario</title>
    <link rel="stylesheet" href="./styles/detalle.css">  
</head>
<body>
    <h2>Detalle de Usuario</h2>
    <?php if ($usuario): ?>
        <p><strong>ID:</strong> <?= htmlspecialchars($usuario->id) ?></p>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario->nombre) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($usuario->correo) ?></p>
        <p><strong>Contraseña:</strong> <?= htmlspecialchars($usuario->contraseña) ?></p>
        <p><strong>Rol:</strong> <?= htmlspecialchars($usuario->rol) ?></p>
    <?php else: ?>
        <p>No se encontró el usuario.</p>
    <?php endif; ?>
    <a href="index2.php">Volver</a>
</body>
</html>
