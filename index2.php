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
$controlador = new Controlador();
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
    default:
        $controlador->listar();
        break;
}
?>

