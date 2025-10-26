<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>© SummerWooll - Categorías</title>
    <!-- estilos -->
    <link rel="stylesheet" href="styles/lista.css">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
    <!-- header -->
<?php include 'inc/header.php'; ?>
<h2>Categorías</h2>
<a href="index.php?action=categoria_form">Agregar categoría</a>
<!-- tabla de categorias -->
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Ubicación</th>
        <th>Acciones</th>
    </tr>
    <!-- recorrer categorias -->
    <?php foreach ($categorias as $c): ?>
    <tr>
        <!-- mostrar datos de la categoria -->
        <td><?= htmlspecialchars($c->categoria_id) ?></td>
        <td><?= htmlspecialchars($c->categoria_nombre) ?></td>
        <td><?= htmlspecialchars($c->categoria_ubicacion) ?></td>
        <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
        <td>
            <!-- enlaces para editar y eliminar categoria -->
            <a href="index.php?action=categoria_form&id=<?= $c->categoria_id ?>">Editar</a> |
            <a href="index.php?action=categoria_eliminar&id=<?= $c->categoria_id ?>" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!--footer -->
<?php include 'inc/footer.php'; ?>
</body>
</html>