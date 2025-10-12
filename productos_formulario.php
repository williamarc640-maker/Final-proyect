<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $producto ? 'Editar' : 'Agregar' ?> Producto</title>
    <link rel="stylesheet" href="styles/formularios.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <style>
        .form-producto {
            max-width: 500px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ccc;
            padding: 2rem;
        }
        .form-producto label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
        }
        .form-producto input, .form-producto select {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.3rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-producto button, .form-producto a {
            margin-top: 1.5rem;
            margin-right: 1rem;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 5px;
            background: #8e44ad;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.2s;
        }
        .form-producto button:hover, .form-producto a:hover {
            background: #6c3483;
        }
        .preview-img {
            margin-top: 1rem;
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
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
function previewImage(event) {
    const img = document.getElementById('img-preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>
<?php include 'footer.php'; ?>
</body>
</html>