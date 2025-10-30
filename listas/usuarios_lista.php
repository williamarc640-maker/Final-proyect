<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>© SummerWooll - Listado de usuarios</title>
    <!-- estilos -->
    <link rel="stylesheet" href="styles/lista.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- estilos para impresión  si lo quito no agarra el estilo-->
    <style>
        @media print {
            .no-print, 
            header, 
            footer, 
            nav,
            td:last-child, 
            th:last-child,
            #chatbot-widget { 
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
            h2 {
                text-align: center;
                margin-bottom: 20px;
                color: #000;
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
            table tr:nth-child(even) {
                background-color: #f9f9f9 !important;
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
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px 15px;
            margin: 10px 0;
            border-radius: 4px;
        }
    </style>
</head>
<!-- header -->
<?php 
include 'inc/header.php';
require_once 'database/database.php';
$conexion = Database::conectar();
?>
<?php if (!empty($_GET['error'])): ?>
    <div class="alert-error no-print"><?php echo htmlspecialchars(urldecode($_GET['error'])); ?></div>
<?php endif; ?>
<body>
    <div class="no-print">
        <h2>Listado de usuarios</h2>
    </div>
        <!-- Botón de impresión -->
    <button onclick="window.print();" class="btn-print no-print">
        <i class="fas fa-print"></i> Imprimir Lista
    </button>
    <!-- agregar usuario -->
    <?php if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'empleado'): ?>
        <a href="index.php?action=formulario">Agregar usuario</a>
    <?php endif; ?>
    <!-- tabla de usuarios -->
    <?php if (isset($usuarios) && is_array($usuarios) && count($usuarios) > 0): ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <!-- mostrar datos del usuario -->
                <td><?= htmlspecialchars($u->usuario_id) ?></td>
                <td><?= htmlspecialchars($u->usuario_nombre) ?></td>
                <td><?= htmlspecialchars($u->usuario_apellido) ?></td>
                <td><?= htmlspecialchars($u->usuario_usuario) ?></td>
                <td><?= htmlspecialchars($u->usuario_email) ?></td>
                <td><?= htmlspecialchars($u->usuario_clave) ?></td>
                <td><?= htmlspecialchars($u->rol) ?></td>
                <td>
                    <!-- acciones -->
                    <a href="index.php?action=detalle&id=<?= $u->usuario_id ?>">Ver</a> | 
                    <a href="index.php?action=formulario&id=<?= $u->usuario_id ?>">Editar</a>
                    <?php if ($_SESSION['rol'] === 'admin'): ?>
                        | <a href="index.php?action=eliminar&id=<?= $u->usuario_id ?>" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <!-- para alejar el footer -->
        <br>
    <?php else: ?>
        <p>No hay usuarios registrados.</p>
    <?php endif; ?> 
    <!-- Información adicional para la versión impresa -->
    <div class="print-header" style="display: none;">
        <h1>© SummerWooll</h1>
        <p>Reporte de Usuarios</p>
        <p>Fecha de impresión: <?php echo date('d/m/Y H:i:s'); ?></p>
    </div>
    <!-- Registro de actividades -->
    <?php if ($_SESSION['rol'] === 'admin'): ?>
    <div class="no-print">
        <h3>Registro de Actividades</h3>
        <table border="1" cellpadding="5">
            <tr>
                <th>Fecha y Hora</th>
                <th>Acción</th>
                <th>Usuario</th>
                <th>Detalles</th>
                <th>Modificado por</th>
            </tr>
            <?php
            // Obtener registros de actividad
            $query = "SELECT r.*, 
                    CONCAT(u.usuario_nombre, ' ', u.usuario_apellido) as nombre_usuario,
                    CONCAT(m.usuario_nombre, ' ', m.usuario_apellido) as modificado_por_nombre
                    FROM registro_usuarios r 
                    LEFT JOIN usuarios u ON r.usuario_id = u.usuario_id
                    LEFT JOIN usuarios m ON r.modificado_por = m.usuario_id
                    ORDER BY r.fecha_hora DESC
                    LIMIT 10";
            $stmt = $conexion->prepare($query);
            $stmt->execute();
            $registros = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            foreach ($registros as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r->fecha_hora) ?></td>
                <td><?= htmlspecialchars($r->accion) ?></td>
                <td><?= htmlspecialchars($r->nombre_usuario) ?></td>
                <td><?= htmlspecialchars($r->descripcion) ?></td>
                <td><?= htmlspecialchars($r->modificado_por_nombre) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
<!-- para alejar el footer -->
    <br><br><br><br>
<!-- footer -->
    <?php include 'inc/footer.php'; ?>
</body>
</html>