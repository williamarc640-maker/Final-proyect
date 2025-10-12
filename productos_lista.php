<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="styles/lista.css">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
<?php include 'header.php'; ?>
<h2>Productos</h2>
<?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
    <a href="index.php?action=producto_form">Agregar producto</a>
<?php endif; ?>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Código</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Foto</th>
        <th>Categoría</th>
        <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
        <th>Acciones</th>
        <?php endif; ?>
    </tr>
    <?php foreach ($productos as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p->producto_id) ?></td>
        <td><?= htmlspecialchars($p->producto_codigo) ?></td>
        <td><?= htmlspecialchars($p->producto_nombre) ?></td>
        <td><?= htmlspecialchars($p->producto_precio) ?></td>
        <td><?= htmlspecialchars($p->producto_stock) ?></td>
        <td><img src="<?= htmlspecialchars($p->producto_foto) ?>" width="50"></td>
        <td><?= htmlspecialchars($p->categoria_nombre) ?></td>
        <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
        <td>
            <a href="index.php?action=producto_form&id=<?= $p->producto_id ?>">Editar</a> |
            <a href="index.php?action=producto_eliminar&id=<?= $p->producto_id ?>" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>
</body>
</html>