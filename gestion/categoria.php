<?php
require_once 'database/database.php';
/* clase categoria */
class Categoria {
    // Último error interno para operaciones en Categoria
    private static $ultimoError = '';
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
        try {
            // Iniciar transacción
            $db->beginTransaction();

            // Poner a NULL la categoría en productos asociados (permitirá que la sección aparezca vacía)
            $stmtUpd = $db->prepare("UPDATE producto SET categoria_id = NULL WHERE categoria_id = ?");
            $stmtUpd->execute([$id]);

            // Eliminar la categoría
            $stmt = $db->prepare("DELETE FROM categoria WHERE categoria_id=?");
            $ok = $stmt->execute([$id]);

            if ($ok) {
                $db->commit();
                return true;
            } else {
                $db->rollBack();
                self::$ultimoError = 'No se pudo eliminar la categoría por un error desconocido.';
                return false;
            }
        } catch (PDOException $e) {
            if ($db->inTransaction()) $db->rollBack();
            self::$ultimoError = $e->getMessage();
            return false;
        }
    }

    // Obtener el último error ocurrido en operaciones de Categoria
    public static function getUltimoError() {
        return self::$ultimoError;
    }
}
?>