<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>© SummerWooll - <?= $categoria ? 'Editar' : 'Agregar' ?> Categoría</title>
    <link rel="stylesheet" href="styles/formularios.css">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
    <!-- header -->
<?php include 'inc/header.php'; ?>
<!-- formulario para agregar o editar categoría -->
<h2 style="text-align:center"><?= $categoria ? 'Editar' : 'Agregar' ?> Categoría</h2>
<form class="form-categoria" action="index.php?action=categoria_guardar" method="post">
    <input type="hidden" name="categoria_id" value="<?= $categoria->categoria_id ?? '' ?>">
    <label for="categoria_nombre">Nombre:</label>
    <input type="text" id="categoria_nombre" name="categoria_nombre" value="<?= $categoria->categoria_nombre ?? '' ?>" required>
    <label for="categoria_ubicacion">Ubicación:</label>
    <input type="text" id="categoria_ubicacion" name="categoria_ubicacion" value="<?= $categoria->categoria_ubicacion ?? '' ?>" required>
    <button type="submit">Guardar</button>
    <a href="index.php?action=categorias">Cancelar</a>
</form>
<!-- footer -->
<?php include 'inc/footer.php'; ?>
</body>
</html>