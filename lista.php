<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de usuarios</title>
    <link rel="stylesheet" href="styles/lista.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<!-- header -->
<?php include 'header.php'?>
<body>
    <h2>Listado de usuarios</h2>
    <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
        <a href="index2.php?action=formulario">Agregar usuario</a> |
    <?php endif; ?>
    <a href="logout.php">Cerrar sesión</a>
    <br><br>

    <?php if (isset($usuarios) && is_array($usuarios) && count($usuarios) > 0): ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u->usuario_id) ?></td>
                <td><?= htmlspecialchars($u->usuario_nombre) ?></td>
                <td><?= htmlspecialchars($u->usuario_apellido) ?></td>
                <td><?= htmlspecialchars($u->usuario_usuario) ?></td>
                <td><?= htmlspecialchars($u->usuario_email) ?></td>
                <td><?= htmlspecialchars($u->usuario_clave) ?></td>
                <td><?= htmlspecialchars($u->rol) ?></td>
                <td>
                    <a href="index2.php?action=detalle&id=<?= $u->usuario_id ?>">Ver</a> | 
                    <a href="index2.php?action=formulario&id=<?= $u->usuario_id ?>">Editar</a>
                    <?php if ($_SESSION['rol'] === 'admin'): ?>
                        | <a href="index2.php?action=eliminar&id=<?= $u->usuario_id ?>" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay usuarios registrados.</p>
    <?php endif; ?> 
<!-- footer -->
    <?php include 'footer.php'; ?>
</body>
</html>

