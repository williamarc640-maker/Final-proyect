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
        // Si el usuario logueado es empleado, fuerza el rol a "empleado"
        if ($_SESSION['rol'] === 'empleado') {
            $dato['rol'] = 'empleado';
        }
        // Si es admin, puede elegir cualquier rol (admin, empleado, cliente)
        if (!empty($dato['id'])) {
            Usuario::actualizar($dato['id'], $dato['nombre'], $dato['correo'], $dato['contraseña'], $dato['rol']);
        } else {
            Usuario::insertar($dato['nombre'], $dato['correo'], $dato['contraseña'], $dato['rol'] ?? 'empleado');
        }
        header("Location: index2.php");
        exit;
    }
/* eliminar usuario */
    public function eliminar($id) {
        if ($_SESSION['rol'] !== 'admin') {
            header("Location: index2.php");
            exit;
        }
        Usuario::eliminar($id);
        header("Location: index2.php");
        exit;
    }
/* mostrar datos del cliente */
    public function perfilCliente() {
        $usuario = Usuario::obtenerPorId($_SESSION['id']);
        include 'vistas/perfil_cliente.php';
    }
/* actualizar datos del cliente */
    public function actualizarCliente($dato) {
        // El rol siempre será 'cliente'
        Usuario::actualizar($_SESSION['id'], $dato['nombre'], $dato['correo'], $dato['contraseña'], 'cliente');
        header("Location: index2.php?action=perfilCliente");
        exit;
    }
}
?>
