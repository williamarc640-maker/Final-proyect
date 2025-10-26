<?php
// Controlador principal
session_start();
require_once 'controllers/usuariocontroller.php';
require_once 'controllers/productocontroller.php';
require_once 'controllers/categoriacontroller.php';
// Instanciar controladores
$controlador = new Controlador();
$productoControlador = new ProductoControlador();
$categoriaControlador = new CategoriaControlador();
// Obtener acción y id desde la URL
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;
// Si no hay sesión, muestra la portada
if (!isset($_SESSION['usuario'])) {
    include 'vistas/portada.php'; // Mueve el HTML de tu index.php actual a portada.php
    exit;
}
// Si es cliente, solo perfil y catálogo
if ($_SESSION['rol'] === 'cliente') {
    if ($action === 'actualizarCliente') {
        $controlador->actualizarCliente($_POST);
    } elseif ($action === 'perfilCliente') {
        $controlador->perfilCliente();
    } else {
        include 'car.php';
    }
    exit;
}
// Admin y empleado: panel completo
switch ($action) {
    case 'formulario':
        $controlador->formulario($id);
        break;
    case 'guardar':
        $controlador->guardar($_POST);
        break;
    case 'eliminar':
        $controlador->eliminar($id);
        break;
    case 'detalle':
        $controlador->detalle($id);
        break;
    case 'productos':
        $productoControlador->listar();
        break;
    case 'producto_form':
        $productoControlador->formulario($id);
        break;
    case 'producto_guardar':
        $productoControlador->guardar($_POST);
        break;
    case 'producto_eliminar':
        $productoControlador->eliminar($id);
        break;
    case 'categorias':
        $categoriaControlador->listar();
        break;
    case 'categoria_form':
        $categoriaControlador->formulario($id);
        break;
    case 'categoria_guardar':
        $categoriaControlador->guardar($_POST);
        break;
    case 'categoria_eliminar':
        $categoriaControlador->eliminar($id);
        break;
    default:
        $controlador->listar();
        break;
}
?>