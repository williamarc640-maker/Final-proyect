<?php
require_once 'database.php';

class Categoria {
    public static function obtenerTodo() {
        $db = Database::conectar();
        $stmt = $db->query("SELECT * FROM categoria");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>