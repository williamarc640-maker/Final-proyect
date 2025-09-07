<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de usuarios</title>
    <link rel="stylesheet" href="./styles/lista.css">
</head>
<body>
    <h2>Listado de usuarios</h2>
    <a href="index2.php?action=formulario">Agregar usuario</a> |
    <a href="logout.php">Cerrar sesión</a>
    <br><br>

    <?php if (isset($usuarios) && is_array($usuarios) && count($usuarios) > 0): ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th><th>Nombre</th><th>Correo</th><th>Acciones</th>
            </tr>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u->id) ?></td>
                <td><?= htmlspecialchars($u->nombre) ?></td>
                <td><?= htmlspecialchars($u->correo) ?></td>
                <td>
                    <a href="index2.php?action=detalle&id=<?= $u->id ?>">Ver</a> | 
                    <a href="index2.php?action=formulario&id=<?= $u->id ?>">Editar</a> | 
                    <a href="index2.php?action=eliminar&id=<?= $u->id ?>" 
                       onclick="return confirm('¿Eliminar este usuario?')">
                       Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay usuarios registrados.</p>
    <?php endif; ?> 
</body>
</html>

