<?php
require_once 'usuario.php';
class Controlador {
    public function listar() {
        $usuarios = Usuario::obtenerTodo();
        include 'vistas/lista.php';
    }
    public function detalle($id) {
        $usuario = Usuario::obtenerPorId($id);
        include 'vistas/detalle.php';
    }
    public function formulario($id = null) {
        $usuario = $id ? Usuario::obtenerPorId($id) : null;
        include 'vistas/formularios.php';
    }
    public function guardar($dato) {
        if (!empty($dato['id'])) {
            Usuario::actualizar($dato['id'], $dato['nombre'], $dato['correo']);
        } else {
            Usuario::insertar($dato['nombre'], $dato['correo']);
        }
        header("Location: index2.php");
        exit;
    }
    public function eliminar($id) {
        Usuario::eliminar($id);
        header("Location: index2.php");
        exit;
    }
}
?>
