<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>© SummerWooll - <?= $producto ? 'Editar' : 'Agregar' ?> Producto</title>
    <link rel="stylesheet" href="styles/formularios.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <!-- por recomendacion de una ia toca dejar esto aca -->
</head>
<body>
    <!-- header -->
<?php include 'header.php'; ?>
<!-- formulario para agregar o editar producto -->
<h2 style="text-align:center"><?= $producto ? 'Editar' : 'Agregar' ?> Producto</h2>
<form class="form-producto" action="index.php?action=producto_guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="producto_id" value="<?= $producto->producto_id ?? '' ?>">
    <label>Código:</label>
    <input type="text" name="producto_codigo" value="<?= $producto->producto_codigo ?? '' ?>" required>
    <label>Nombre:</label>
    <input type="text" name="producto_nombre" value="<?= $producto->producto_nombre ?? '' ?>" required>
    <label>Precio:</label>
    <input type="number" name="producto_precio" value="<?= $producto->producto_precio ?? '' ?>" required>
    <label>Stock:</label>
    <input type="number" name="producto_stock" value="<?= $producto->producto_stock ?? '' ?>" required>
    <label>Foto:</label>
    <input type="file" name="producto_foto" accept="image/*" <?= $producto ? '' : 'required' ?> onchange="previewImage(event)">
    <?php if (!empty($producto->producto_foto)): ?>
        <img src="<?= htmlspecialchars($producto->producto_foto) ?>" class="preview-img" id="img-preview">
    <?php else: ?>
        <img style="display:none;" class="preview-img" id="img-preview">
    <?php endif; ?>
    <label>Categoría:</label>
    <select name="categoria_id" required>
        <!-- Cargar categorías dinámicamente -->
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat->categoria_id ?>" <?= ($producto && $producto->categoria_id == $cat->categoria_id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat->categoria_nombre) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Guardar</button>
    <a href="index.php?action=productos">Cancelar</a>
</form>
<script>
    // Vista previa de la imagen seleccionada
function previewImage(event) {
    const img = document.getElementById('img-preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>
<!-- footer -->
<?php include 'footer.php'; ?>
</body>
</html>