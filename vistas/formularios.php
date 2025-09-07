<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $usuario ? 'Editar' : 'Agregar' ?> Usuario</title>
    <link rel="stylesheet" href="./styles/formularios.css">
</head>
<body>
    <h2><?= $usuario ? 'Editar' : 'Agregar' ?> Usuario</h2>
    <form action="index2.php?action=guardar" method="post">
        <input type="hidden" name="id" value="<?= $usuario->id ?? '' ?>">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= $usuario->nombre ?? '' ?>" required><br><br>
        <label>Correo:</label><br>
        <input type="email" name="correo" value="<?= $usuario->correo ?? '' ?>" required><br><br>
        <button type="submit">Guardara</button>
        <a href="index2.php">Cancelar</a>
    </form>
</body>
</html>
