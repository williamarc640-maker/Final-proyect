<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
</head>
<body>
    <h2>Mis datos</h2>
    <?php if (!isset($_GET['editar'])): ?>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario->nombre) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($usuario->correo) ?></p>
        <p><strong>Contraseña:</strong> <?= htmlspecialchars($usuario->contraseña) ?></p>
        <a href="index2.php?action=perfilCliente&editar=1">Editar datos</a>
    <?php else: ?>
        <form action="index2.php?action=actualizarCliente" method="post">
            <label>Nombre:</label><br>
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario->nombre) ?>" required><br><br>
            <label>Correo:</label><br>
            <input type="email" name="correo" value="<?= htmlspecialchars($usuario->correo) ?>" required><br><br>
            <label>Contraseña:</label><br>
            <input type="password" name="contraseña" value="<?= htmlspecialchars($usuario->contraseña) ?>" required><br><br>
            <button type="submit">Guardar cambios</button>
            <a href="index2.php?action=perfilCliente">Cancelar</a>
        </form>
    <?php endif; ?>
    <a href="logout.php">Cerrar sesion</a>
</body>
</html>