<?php
require_once 'database.php';

class Producto {
    public static function obtenerTodo() {
        $db = Database::conectar();
        $stmt = $db->query("SELECT p.*, c.categoria_nombre FROM producto p JOIN categoria c ON p.categoria_id = c.categoria_id");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function obtenerPorId($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM producto WHERE producto_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function insertar($codigo, $nombre, $precio, $stock, $foto, $categoria_id, $usuario_id) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO producto (producto_codigo, producto_nombre, producto_precio, producto_stock, producto_foto, categoria_id, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$codigo, $nombre, $precio, $stock, $foto, $categoria_id, $usuario_id]);
    }

    public static function actualizar($id, $codigo, $nombre, $precio, $stock, $foto, $categoria_id, $usuario_id) {
        $db = Database::conectar();
        $stmt = $db->prepare("UPDATE producto SET producto_codigo=?, producto_nombre=?, producto_precio=?, producto_stock=?, producto_foto=?, categoria_id=?, usuario_id=? WHERE producto_id=?");
        return $stmt->execute([$codigo, $nombre, $precio, $stock, $foto, $categoria_id, $usuario_id, $id]);
    }

    public static function eliminar($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("DELETE FROM producto WHERE producto_id = ?");
        return $stmt->execute([$id]);
    }
}
?>