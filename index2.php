<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
require_once 'usuariocontroller.php';
$controlador = new Controlador();
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;
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
