<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="./styles/perfil.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- perfil cliente -->
    <h2>Mis datos</h2>
    <div class="perfil-container">
    <?php if (!isset($_GET['editar'])): ?>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario->usuario_nombre) ?></p>
        <p><strong>Apellido:</strong> <?= htmlspecialchars($usuario->usuario_apellido) ?></p>
        <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario->usuario_usuario) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($usuario->usuario_email) ?></p>
        <p><strong>Contraseña:</strong> <?= htmlspecialchars($usuario->usuario_clave) ?></p>
        <a href="index.php?action=perfilCliente&editar=1" class="perfil-editar"><i class="fas fa-edit"></i> Editar datos</a>
    <?php else: ?>
        <form action="index.php?action=actualizarCliente" method="post">
            <label for="usuario_nombre">Nombre:</label>
            <input type="text" name="usuario_nombre" id="usuario_nombre" value="<?= htmlspecialchars($usuario->usuario_nombre) ?>" required>
            <label for="usuario_apellido">Apellido:</label>
            <input type="text" name="usuario_apellido" id="usuario_apellido" value="<?= htmlspecialchars($usuario->usuario_apellido) ?>" required>
            <label for="usuario_usuario">Usuario:</label>
            <input type="text" name="usuario_usuario" id="usuario_usuario" value="<?= htmlspecialchars($usuario->usuario_usuario) ?>" required>
            <label for="usuario_email">Correo:</label>
            <input type="email" name="usuario_email" id="usuario_email" value="<?= htmlspecialchars($usuario->usuario_email) ?>" required>
            <label for="usuario_clave">Contraseña:</label>
            <input type="password" name="usuario_clave" id="usuario_clave" value="<?= htmlspecialchars($usuario->usuario_clave) ?>" required>
            <div class="perfil-botones">
                <button type="submit"><i class="fas fa-save"></i> Guardar cambios</button>
                <a href="index.php?action=perfilCliente" class="cancelar"><i class="fas fa-times"></i> Cancelar</a>
            </div>
        </form>
    <?php endif; ?>
    </div>
    <div class="cerrar-sesion-container">
        <a href="logout.php" class="perfil-editar"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
    </div>
    <!-- footer -->
    <?php include 'footer.php'; ?>
</body>
</html>