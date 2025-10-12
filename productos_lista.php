<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>© SummerWooll - Productos</title>
    <!-- estilos -->
    <link rel="stylesheet" href="styles/lista.css">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
    <!-- header -->
<?php include 'header.php'; ?>
<!-- lista de productos -->
<h2>Productos</h2>
    <a href="index.php?action=producto_form">Agregar producto</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Código</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Foto</th>
        <th>Categoría</th>
        <th>Acciones</th>
    </tr>
    <!-- recorrer productos -->
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
<br><br><br><br><br><br>
<!--footer -->
<?php include 'footer.php'; ?>
</body>
</html>