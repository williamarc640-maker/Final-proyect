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
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
/* insertar nuevo usuario */
    public static function insertar($nombre, $correo, $contraseña, $rol = 'empleado') {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO usuarios(nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $correo, $contraseña, $rol]);
    }
/* actualizar usuario existente */
    public static function actualizar($id, $nombre, $correo, $contraseña, $rol) {
        $db = Database::conectar();
        $stmt = $db->prepare("UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ?, rol = ? WHERE id = ?");
        return $stmt->execute([$nombre, $correo, $contraseña, $rol, $id]);
}
/* eliminar usuario */
    public static function eliminar($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
