<?php
/* usuariocontroller.php */
require_once 'usuario.php';
class Controlador {
/* listar todos los usuarios */
    public function listar() {
        $usuarios = Usuario::obtenerTodo();
        include 'lista.php';
    }
/* ver detalle de un usuario */
    public function detalle($id) {
        $usuario = Usuario::obtenerPorId($id);
        include 'detalle.php';
    }
/* mostrar formulario para crear o editar usuario */
    public function formulario($id = null) {
        $usuario = null;
        if ($id) {
            $usuario = Usuario::obtenerPorId($id);
            // Si el usuario logueado es empleado y el usuario a editar es admin, no permitir
            if ($_SESSION['rol'] === 'empleado' && $usuario && $usuario->rol === 'admin') {
                header("Location: index2.php");
                exit;
            }
        }
        include 'formularios.php';
    }
/* guardar usuario (crear o actualizar) */
    public function guardar($dato) {
        // Si el usuario logueado es empleado, fuerza el rol a "empleado"
        if ($_SESSION['rol'] === 'empleado') {
            // Si está editando un usuario admin, no permitir
            if (!empty($dato['usuario_id'])) {
                $usuario = Usuario::obtenerPorId($dato['usuario_id']);
                if ($usuario && $usuario->rol === 'admin') {
                    header("Location: index2.php");
                    exit;
                }
            }
            $dato['rol'] = 'empleado';
        }
        if (!empty($dato['usuario_id'])) {
            Usuario::actualizar(
                $dato['usuario_id'],
                $dato['usuario_nombre'],
                $dato['usuario_apellido'],
                $dato['usuario_usuario'],
                $dato['usuario_email'],
                $dato['usuario_clave'],
                $dato['rol']
            );
        } else {
            Usuario::insertar(
                $dato['usuario_nombre'],
                $dato['usuario_apellido'],
                $dato['usuario_usuario'],
                $dato['usuario_email'],
                $dato['usuario_clave'],
                $dato['rol'] ?? 'empleado'
            );
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
        include 'perfil_cliente.php';
    }
/* actualizar datos del cliente */
    public function actualizarCliente($dato) {
        Usuario::actualizar(
            $_SESSION['id'],
            $dato['usuario_nombre'],
            $dato['usuario_apellido'],
            $dato['usuario_usuario'],
            $dato['usuario_email'],
            $dato['usuario_clave'],
            'cliente'
        );
        header("Location: index2.php?action=perfilCliente");
        exit;
    }
}
?>
