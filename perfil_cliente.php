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
        <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario->nombre) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($usuario->correo) ?></p>
        <p><strong>Contraseña:</strong> <?= htmlspecialchars($usuario->contraseña) ?></p>
        <a href="index2.php?action=perfilCliente&editar=1" class="perfil-editar"><i class="fas fa-edit"></i> Editar datos</a>
    <?php else: ?>
        <form action="index2.php?action=actualizarCliente" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario->nombre) ?>" required>
            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($usuario->correo) ?>" required>
            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" id="contraseña" value="<?= htmlspecialchars($usuario->contraseña) ?>" required>
            <div class="perfil-botones">
                <button type="submit"><i class="fas fa-save"></i> Guardar cambios</button>
                <a href="index2.php?action=perfilCliente" class="cancelar"><i class="fas fa-times"></i> Cancelar</a>
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