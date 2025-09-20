<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $usuario ? 'Editar' : 'Agregar' ?> Usuario</title>
    <link rel="stylesheet" href="./styles/formularios.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- formulario -->
    <h2><?= $usuario ? 'Editar' : 'Agregar' ?> Usuario</h2>
    <div class="form-container">
        <form action="index2.php?action=guardar" method="post">
            <input type="hidden" name="id" value="<?= $usuario->id ?? '' ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= $usuario->nombre ?? '' ?>" required>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo" value="<?= $usuario->correo ?? '' ?>" required>

            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" id="contraseña" value="<?= $usuario->contraseña ?? '' ?>" required>

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
                <a href="index2.php" class="cancelar"><i class="fas fa-times"></i> Cancelar</a>
            </div>
        </form>
    </div>
    <!-- footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
