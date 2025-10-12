<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>© SummerWooll - <?= $categoria ? 'Editar' : 'Agregar' ?> Categoría</title>
    <!-- estilos -->
    <link rel="stylesheet" href="styles/formularios.css">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
    <!-- header -->
<?php include 'header.php'; ?>
<!-- formulario para agregar o editar categoria -->
<h2><?= $categoria ? 'Editar' : 'Agregar' ?> Categoría</h2>
<form action="index.php?action=categoria_guardar" method="post">
    <input type="hidden" name="categoria_id" value="<?= $categoria->categoria_id ?? '' ?>">
    <label>Nombre:</label>
    <input type="text" name="categoria_nombre" value="<?= $categoria->categoria_nombre ?? '' ?>" required>
    <label>Ubicación:</label>
    <input type="text" name="categoria_ubicacion" value="<?= $categoria->categoria_ubicacion ?? '' ?>" required>
    <button type="submit">Guardar</button>
    <a href="index.php?action=categorias">Cancelar</a>
</form>

<!-- footer -->
<?php include 'footer.php'; ?>
</body>
</html>