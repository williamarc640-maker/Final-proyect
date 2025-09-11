<?php
/* usuariocontroller.php */
require_once 'usuario.php';
class Controlador {
/* listar todos los usuarios */
    public function listar() {
        $usuarios = Usuario::obtenerTodo();
        include 'vistas/lista.php';
    }
/* ver detalle de un usuario */
    public function detalle($id) {
        $usuario = Usuario::obtenerPorId($id);
        include 'vistas/detalle.php';
    }
/* mostrar formulario para crear o editar usuario */
    public function formulario($id = null) {
        $usuario = $id ? Usuario::obtenerPorId($id) : null;
        include 'vistas/formularios.php';
    }
/* guardar usuario (crear o actualizar) */
    public function guardar($dato) {
        if (!empty($dato['id'])) {
            Usuario::actualizar($dato['id'], $dato['nombre'], $dato['correo']);
        } else {
            Usuario::insertar($dato['nombre'], $dato['correo']);
        }
        header("Location: index2.php");
        exit;
    }
/* eliminar usuario */
    public function eliminar($id) {
        Usuario::eliminar($id);
        header("Location: index2.php");
        exit;
    }
}
?>
