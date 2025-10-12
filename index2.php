<!-- index2.php -->
<?php
/* inicio de sesion y verificacion */
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
/* logica del controlador */
require_once 'usuariocontroller.php';
require_once 'productocontroller.php';
$controlador = new Controlador();
$productoControlador = new ProductoControlador();
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

if ($_SESSION['rol'] === 'cliente') {
    if (isset($_GET['action']) && $_GET['action'] === 'actualizarCliente') {
        $controlador->actualizarCliente($_POST);
    } else {
        $controlador->perfilCliente();
    }
    exit;
}

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
    default:
        $controlador->listar();
        break;
}
?>

