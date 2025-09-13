<?php
// connection to the database
class Database {
    public static function conectar() {
        try {
            $con = new PDO("mysql:host=localhost;dbname=mvc_crud;charset=utf8", "root", "");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            die("Error de conexión: ".$e->getMessage());
        }
    }
}
?>
