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
    public static function insertar($nombre, $correo) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO usuarios(nombre, correo) VALUES (?, ?)");
        return $stmt->execute([$nombre, $correo]);
    }
/* actualizar usuario existente */
    public static function actualizar($id, $nombre, $correo) {
        $db = Database::conectar();
        $stmt = $db->prepare("UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?");
        return $stmt->execute([$nombre, $correo, $id]);
    }
/* eliminar usuario */
    public static function eliminar($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
