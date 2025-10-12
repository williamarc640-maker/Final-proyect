<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>© SummerWooll - <?= $usuario ? 'Editar' : 'Agregar' ?> Usuario</title>
    <!-- estilos -->
    <link rel="stylesheet" href="./styles/formularios.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- formulario -->
    <h2><?= $usuario ? 'Editar' : 'Agregar' ?> Usuario</h2>
    <!-- formulario para agregar o editar usuario -->
    <div class="form-container">
        <form action="index.php?action=guardar" method="post">
            <input type="hidden" name="usuario_id" value="<?= $usuario->usuario_id ?? '' ?>">
            <label for="usuario_nombre">Nombre:</label>
            <input type="text" name="usuario_nombre" id="usuario_nombre" value="<?= $usuario->usuario_nombre ?? '' ?>" required>
            <label for="usuario_apellido">Apellido:</label>
            <input type="text" name="usuario_apellido" id="usuario_apellido" value="<?= $usuario->usuario_apellido ?? '' ?>" required>
            <label for="usuario_usuario">Usuario:</label>
            <input type="text" name="usuario_usuario" id="usuario_usuario" value="<?= $usuario->usuario_usuario ?? '' ?>" required>
            <label for="usuario_email">Correo:</label>
            <input type="email" name="usuario_email" id="usuario_email" value="<?= $usuario->usuario_email ?? '' ?>" required>
            <label for="usuario_clave">Contraseña:</label>
            <input type="password" name="usuario_clave" id="usuario_clave" value="<?= $usuario->usuario_clave ?? '' ?>" required>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <label for="rol">Rol:</label>
                <select name="rol" id="rol">
                    <option value="admin" <?= ($usuario && $usuario->rol == 'admin') ? 'selected' : '' ?>>Administrador</option>
                    <option value="empleado" <?= ($usuario && $usuario->rol == 'empleado') ? 'selected' : '' ?>>Empleado</option>
                    <option value="cliente" <?= ($usuario && $usuario->rol == 'cliente') ? 'selected' : '' ?>>Cliente</option>
                </select>
            <?php endif; ?>
            <div class="botones">
                <button type="submit"><i class="fas fa-save"></i> Guardar</button>
                <a href="index.php" class="cancelar"><i class="fas fa-times"></i> Cancelar</a>
            </div>
        </form>
    </div>
    <!-- footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
