<?php
require_once 'gestion/producto.php';
require_once 'gestion/categoria.php';
// clase producto controlador
class ProductoControlador {
    public function listar() {
        $productos = Producto::obtenerTodo();
        $categorias = Categoria::obtenerTodo();
        include 'listas/productos_lista.php';
    }
// formulario para agregar o editar producto
    public function formulario($id = null) {
        $producto = null;
        $categorias = Categoria::obtenerTodo();
        if ($id) {
            $producto = Producto::obtenerPorId($id);
        }
        include 'formularios/productos_formulario.php';
    }
// guardar producto (insertar o actualizar)
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
// Insertar o actualizar según si hay ID
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
        header("Location: index.php?action=productos");
        exit;
    }
// eliminar producto
    public function eliminar($id) {
        Producto::eliminar($id);
        header("Location: index.php?action=productos");
        exit;
    }
}
?>