<?php
require_once 'producto.php';
require_once 'categoria.php';

class ProductoControlador {
    public function listar() {
        $productos = Producto::obtenerTodo();
        $categorias = Categoria::obtenerTodo();
        include 'productos_lista.php';
    }

    public function formulario($id = null) {
        $producto = null;
        $categorias = Categoria::obtenerTodo();
        if ($id) {
            $producto = Producto::obtenerPorId($id);
        }
        include 'productos_formulario.php';
    }

    public function guardar($dato) {
        $foto = '';
        if (isset($_FILES['producto_foto']) && $_FILES['producto_foto']['error'] === UPLOAD_ERR_OK) {
            $dir = 'img/productos/';
            if (!is_dir($dir)) mkdir($dir, 0777, true);
            $nombreArchivo = uniqid() . '_' . basename($_FILES['producto_foto']['name']);
            $ruta = $dir . $nombreArchivo;
            move_uploaded_file($_FILES['producto_foto']['tmp_name'], $ruta);
            $foto = $ruta;
        } else if (!empty($dato['producto_id'])) {
            // Si no se sube nueva imagen, mantener la anterior
            $producto = Producto::obtenerPorId($dato['producto_id']);
            $foto = $producto->producto_foto;
        }

        if (!empty($dato['producto_id'])) {
            Producto::actualizar(
                $dato['producto_id'],
                $dato['producto_codigo'],
                $dato['producto_nombre'],
                $dato['producto_precio'],
                $dato['producto_stock'],
                $foto,
                $dato['categoria_id'],
                $_SESSION['id']
            );
        } else {
            Producto::insertar(
                $dato['producto_codigo'],
                $dato['producto_nombre'],
                $dato['producto_precio'],
                $dato['producto_stock'],
                $foto,
                $dato['categoria_id'],
                $_SESSION['id']
            );
        }
        header("Location: index2.php?action=productos");
        exit;
    }

    public function eliminar($id) {
        Producto::eliminar($id);
        header("Location: index2.php?action=productos");
        exit;
    }
}
?>