<?php
require_once 'database/database.php';
/* clase categoria */
class Categoria {
    public static function obtenerTodo() {
        $db = Database::conectar();
        $stmt = $db->query("SELECT * FROM categoria");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
/* obtener una categoria por su id */
    public static function obtenerPorId($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM categoria WHERE categoria_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
/* insertar categoria */
    public static function insertar($nombre, $ubicacion) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO categoria (categoria_nombre, categoria_ubicacion) VALUES (?, ?)");
        return $stmt->execute([$nombre, $ubicacion]);
    }
/* actualizar categoria */
    public static function actualizar($id, $nombre, $ubicacion) {
        $db = Database::conectar();
        $stmt = $db->prepare("UPDATE categoria SET categoria_nombre=?, categoria_ubicacion=? WHERE categoria_id=?");
        return $stmt->execute([$nombre, $ubicacion, $id]);
    }
/*eliminar categoria */
    public static function eliminar($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("DELETE FROM categoria WHERE categoria_id=?");
        return $stmt->execute([$id]);
    }
}
?>