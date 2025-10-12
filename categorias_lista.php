<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link rel="stylesheet" href="styles/lista.css">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
<?php include 'header.php'; ?>
<h2>Categorías</h2>
<?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
    <a href="index.php?action=categoria_form">Agregar categoría</a>
<?php endif; ?>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Ubicación</th>
        <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
        <th>Acciones</th>
        <?php endif; ?>
    </tr>
    <?php foreach ($categorias as $c): ?>
    <tr>
        <td><?= htmlspecialchars($c->categoria_id) ?></td>
        <td><?= htmlspecialchars($c->categoria_nombre) ?></td>
        <td><?= htmlspecialchars($c->categoria_ubicacion) ?></td>
        <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
        <td>
            <a href="index.php?action=categoria_form&id=<?= $c->categoria_id ?>">Editar</a> |
            <a href="index.php?action=categoria_eliminar&id=<?= $c->categoria_id ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>
</body>
</html>