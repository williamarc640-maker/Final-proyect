<?php
require_once 'database.php';
/* modelo de usuario */
class Usuario {
/* obtener todos los usuarios */
    public static function obtenerTodo() {
        $db = Database::conectar();
        $stmt = $db->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
/* obtener usuario por id */
    public static function obtenerPorId($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE usuario_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
/* insertar nuevo usuario */
    public static function insertar($nombre, $apellido, $usuario, $email, $clave, $rol = 'empleado') {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO usuarios(usuario_nombre, usuario_apellido, usuario_usuario, usuario_email, usuario_clave, rol) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellido, $usuario, $email, $clave, $rol]);
    }
/* actualizar usuario existente */
    public static function actualizar($id, $nombre, $apellido, $usuario, $email, $clave, $rol) {
        $db = Database::conectar();
        $stmt = $db->prepare("UPDATE usuarios SET usuario_nombre = ?, usuario_apellido = ?, usuario_usuario = ?, usuario_email = ?, usuario_clave = ?, rol = ? WHERE usuario_id = ?");
        return $stmt->execute([$nombre, $apellido, $usuario, $email, $clave, $rol, $id]);
    }
/* eliminar usuario */
    public static function eliminar($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE usuario_id = ?");
        return $stmt->execute([$id]);
    }
}
?>
