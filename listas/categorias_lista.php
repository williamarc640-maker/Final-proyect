<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>© SummerWooll - Categorías</title>
    <!-- estilos -->
    <link rel="stylesheet" href="styles/lista.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- estilos para impresión  si lo quito no agarra el estilo-->
    <style>
        @media print {
            .no-print, header, footer, nav, 
            td:last-child, th:last-child { 
                display: none !important; 
            }
            body { 
                margin: 20px;
                padding: 0;
                background: white;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                background: white;
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            th {
                background-color: #f3f4f6 !important;
                color: #000;
                padding: 12px;
                border: 1px solid #000;
                font-size: 14px;
            }
            td {
                padding: 10px;
                border: 1px solid #000;
                font-size: 13px;
            }
            .print-header {
                text-align: center;
                margin-bottom: 30px;
                padding: 20px;
                border-bottom: 2px solid #000;
                display: block !important;
            }
            .print-header h1 {
                color: #000;
                margin: 0;
                font-size: 24px;
            }
            .print-header p {
                color: #333;
                margin: 5px 0;
                font-size: 14px;
            }
        }
        .btn-print {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px 0;
        }
        .btn-print:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- header -->
<?php 
include 'inc/header.php';
require_once 'database/database.php';
$conexion = Database::conectar();
?>
<!-- obtener categorias -->
    <div class="print-header" style="display: none;">
        <h1>Lista de Categorías</h1>
        <p>Generado el: <?php echo date('d/m/Y H:i'); ?></p>
        <p>Sistema de Gestión de Categorías</p>
    </div>
    <h2 class="no-print">Categorías</h2>
    <button onclick="window.print();" class="btn-print no-print">
        <i class="fas fa-print"></i> Imprimir Lista
    </button>
    <a href="index.php?action=categoria_form" class="no-print">Agregar categoría</a>
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
<!-- Registro de actividades -->
<?php if ($_SESSION['rol'] === 'admin'): ?>
<div class="no-print">
    <h3>Registro de Actividades</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Fecha y Hora</th>
            <th>Acción</th>
            <th>Categoría</th>
            <th>Detalles</th>
            <th>Productos Afectados</th>
            <th>Modificado por</th>
        </tr>
        <?php
        // Obtener registros de actividad
        $query = "SELECT r.*, 
                CONCAT(u.usuario_nombre, ' ', u.usuario_apellido) as modificado_por_nombre
                FROM registro_categorias r 
                LEFT JOIN usuarios u ON r.modificado_por = u.usuario_id
                ORDER BY r.fecha_hora DESC
                LIMIT 10";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $registros = $stmt->fetchAll(PDO::FETCH_OBJ);
        // Mostrar registros
        foreach ($registros as $r): ?>
        <tr>
            <!-- mostrar datos del registro -->
            <td><?= htmlspecialchars($r->fecha_hora) ?></td>
            <td><?= htmlspecialchars($r->accion) ?></td>
            <td><?= htmlspecialchars($r->categoria_nombre) ?></td>
            <td><?= htmlspecialchars($r->descripcion) ?></td>
            <td><?= htmlspecialchars($r->productos_afectados) ?></td>
            <td><?= htmlspecialchars($r->modificado_por_nombre) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>
<!-- para alejar el footer -->
<br><br><br>
<!--footer -->
<?php include 'inc/footer.php'; ?>
</body>
</html>