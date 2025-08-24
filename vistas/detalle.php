<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Usuario</title>
</head>
<body>
    <h2>Detalle de Usuario</h2>
    <?php if ($usuario): ?>
        <p><strong>ID:</strong> <?= $usuario->id ?></p>
        <p><strong>Nombre:</strong> <?= $usuario->nombre ?></p>
        <p><strong>Correo:</strong> <?= $usuario->correo ?></p>
    <?php else: ?>
        <p>No se encontró el usuario.</p>
    <?php endif; ?>
    <a href="index2.php">Volver</a>
</body>
</html>
