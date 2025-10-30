<?php
require_once 'database/database.php';
/* modelo de usuario */
class Usuario {
    // Último error interno (si ocurre alguno en operaciones DB)
    private static $ultimoError = '';
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
        try {
            // Iniciar transacción
            $db->beginTransaction();

            // 1) Verificar dependencias críticas que no permiten eliminar (producto.usuario_id es NOT NULL)
            $stmtCheck = $db->prepare("SELECT COUNT(*) AS cnt FROM producto WHERE usuario_id = ?");
            $stmtCheck->execute([$id]);
            $cnt = (int) $stmtCheck->fetch(PDO::FETCH_OBJ)->cnt;
            if ($cnt > 0) {
                // No podemos eliminar si hay productos asociados
                $db->rollBack();
                self::$ultimoError = "No se puede eliminar el usuario: existen productos asociados (producto.usuario_id).";
                return false;
            }

            // 2) Limpiar referencias en tablas de registro (permiten NULL)
            $stmtUpd1 = $db->prepare("UPDATE registro_usuarios SET modificado_por = NULL WHERE modificado_por = ?");
            $stmtUpd1->execute([$id]);
            $stmtUpd2 = $db->prepare("UPDATE registro_productos SET modificado_por = NULL WHERE modificado_por = ?");
            $stmtUpd2->execute([$id]);
            $stmtUpd3 = $db->prepare("UPDATE registro_categorias SET modificado_por = NULL WHERE modificado_por = ?");
            $stmtUpd3->execute([$id]);

            // 3) Eliminar el usuario
            $stmt = $db->prepare("DELETE FROM usuarios WHERE usuario_id = ?");
            $ok = $stmt->execute([$id]);

            if ($ok) {
                $db->commit();
                return true;
            } else {
                $db->rollBack();
                self::$ultimoError = 'No se pudo eliminar el usuario por un error desconocido.';
                return false;
            }
        } catch (PDOException $e) {
            // Rollback en caso de excepción y guardar mensaje para el controlador
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            self::$ultimoError = $e->getMessage();
            return false;
        }
    }

    // Obtener el último error ocurrido en operaciones de Usuario
    public static function getUltimoError() {
        return self::$ultimoError;
    }
}
?>