<?php
require_once 'categoria.php';

class CategoriaControlador {
    public function listar() {
        $categorias = Categoria::obtenerTodo();
        include 'categorias_lista.php';
    }

    public function formulario($id = null) {
        $categoria = null;
        if ($id) {
            $categoria = Categoria::obtenerPorId($id);
        }
        include 'categorias_formulario.php';
    }

    public function guardar($dato) {
        if (!empty($dato['categoria_id'])) {
            Categoria::actualizar($dato['categoria_id'], $dato['categoria_nombre'], $dato['categoria_ubicacion']);
        } else {
            Categoria::insertar($dato['categoria_nombre'], $dato['categoria_ubicacion']);
        }
        header("Location: index.php?action=categorias");
        exit;
    }

    public function eliminar($id) {
        Categoria::eliminar($id);
        header("Location: index.php?action=categorias");
        exit;
    }
}
?>