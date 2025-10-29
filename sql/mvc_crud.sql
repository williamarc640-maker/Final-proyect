-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2025 a las 23:45:55
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mvc_crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(7) NOT NULL,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES
(1, 'Peluches', 'Tienda'),
(2, 'Ropa', 'Tienda'),
(3, 'Accesorios', 'Tienda'),
(4, 'Otros', 'Tienda'),
(6, 'yupiiii', 'yeeeeee');

--
-- Disparadores `categoria`
--
DELIMITER $$
CREATE TRIGGER `categorias_delete_registro` BEFORE DELETE ON `categoria` FOR EACH ROW BEGIN
    DECLARE num_productos INT;
    
    SELECT COUNT(*) INTO num_productos 
    FROM producto WHERE categoria_id = OLD.categoria_id;

    INSERT INTO registro_categorias (
        accion,
        categoria_id,
        categoria_nombre,
        categoria_ubicacion,
        productos_afectados,
        descripcion
    )
    VALUES (
        'DELETE',
        OLD.categoria_id,
        OLD.categoria_nombre,
        OLD.categoria_ubicacion,
        num_productos,
        CONCAT('Se eliminó la categoría. Productos afectados: ', num_productos)
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `categorias_insert_registro` AFTER INSERT ON `categoria` FOR EACH ROW BEGIN
    INSERT INTO registro_categorias (
        accion,
        categoria_id,
        categoria_nombre,
        categoria_ubicacion,
        productos_afectados,
        descripcion
    )
    VALUES (
        'INSERT',
        NEW.categoria_id,
        NEW.categoria_nombre,
        NEW.categoria_ubicacion,
        0,
        'Se ha creado una nueva categoría'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `categorias_update_registro` AFTER UPDATE ON `categoria` FOR EACH ROW BEGIN
    DECLARE num_productos INT;
    DECLARE cambios TEXT DEFAULT '';
    
    SELECT COUNT(*) INTO num_productos 
    FROM producto WHERE categoria_id = NEW.categoria_id;
    
    IF OLD.categoria_nombre != NEW.categoria_nombre THEN
        SET cambios = CONCAT(cambios, 'Nombre: ', OLD.categoria_nombre, ' → ', NEW.categoria_nombre, '; ');
    END IF;
    
    IF OLD.categoria_ubicacion != NEW.categoria_ubicacion THEN
        SET cambios = CONCAT(cambios, 'Ubicación: ', OLD.categoria_ubicacion, ' → ', NEW.categoria_ubicacion, '; ');
    END IF;

    INSERT INTO registro_categorias (
        accion,
        categoria_id,
        categoria_nombre,
        categoria_ubicacion,
        productos_afectados,
        descripcion
    )
    VALUES (
        'UPDATE',
        NEW.categoria_id,
        NEW.categoria_nombre,
        NEW.categoria_ubicacion,
        num_productos,
        CONCAT('Se modificó la categoría. ', cambios)
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(20) NOT NULL,
  `producto_codigo` varchar(70) NOT NULL,
  `producto_nombre` varchar(70) NOT NULL,
  `producto_precio` decimal(30,0) NOT NULL,
  `producto_stock` int(25) NOT NULL,
  `producto_foto` varchar(500) NOT NULL,
  `categoria_id` int(7) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_codigo`, `producto_nombre`, `producto_precio`, `producto_stock`, `producto_foto`, `categoria_id`, `usuario_id`) VALUES
(1, '123456789', 'Aretes', 20000, 10, 'img/productos/69016983c878a_1000053396.jpeg', 3, 17),
(2, '369258147', 'Falda para niña', 30000, 5, 'img/productos/690169ad7ac01_1000053390.jpeg', 2, 17),
(3, '789456123', 'Muñeco de perro', 10000, 6, 'img/productos/690169ceea951_1000053392.jpeg', 1, 17),
(4, '456781233', 'Muñeco de la virgencita', 40000, 2, 'img/productos/690169f7a170c_1000053393.jpeg', 1, 17),
(5, '54891213', 'pepe', 10000000000000, 600, 'img/productos/690293968b3fc_imagen_2025-10-19_104938019-removebg-preview.png', 4, 17);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `productos_delete_registro` BEFORE DELETE ON `producto` FOR EACH ROW BEGIN
    DECLARE cat_nombre VARCHAR(50);
    SELECT categoria_nombre INTO cat_nombre 
    FROM categoria WHERE categoria_id = OLD.categoria_id;

    INSERT INTO registro_productos (
        accion,
        producto_id,
        producto_codigo,
        producto_nombre,
        producto_precio,
        producto_stock,
        producto_foto,
        categoria_id,
        categoria_nombre,
        modificado_por,
        descripcion
    )
    VALUES (
        'DELETE',
        OLD.producto_id,
        OLD.producto_codigo,
        OLD.producto_nombre,
        OLD.producto_precio,
        OLD.producto_stock,
        OLD.producto_foto,
        OLD.categoria_id,
        cat_nombre,
        OLD.usuario_id,
        'Se ha eliminado el producto del sistema'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `productos_insert_registro` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    DECLARE cat_nombre VARCHAR(50);
    SELECT categoria_nombre INTO cat_nombre 
    FROM categoria WHERE categoria_id = NEW.categoria_id;

    INSERT INTO registro_productos (
        accion,
        producto_id,
        producto_codigo,
        producto_nombre,
        producto_precio,
        producto_stock,
        producto_foto,
        categoria_id,
        categoria_nombre,
        modificado_por,
        descripcion
    )
    VALUES (
        'INSERT',
        NEW.producto_id,
        NEW.producto_codigo,
        NEW.producto_nombre,
        NEW.producto_precio,
        NEW.producto_stock,
        NEW.producto_foto,
        NEW.categoria_id,
        cat_nombre,
        NEW.usuario_id,
        'Se ha agregado un nuevo producto al sistema'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `productos_update_registro` AFTER UPDATE ON `producto` FOR EACH ROW BEGIN
    DECLARE cat_nombre_old, cat_nombre_new VARCHAR(50);
    DECLARE cambios TEXT DEFAULT '';
    
    SELECT categoria_nombre INTO cat_nombre_old 
    FROM categoria WHERE categoria_id = OLD.categoria_id;
    
    SELECT categoria_nombre INTO cat_nombre_new 
    FROM categoria WHERE categoria_id = NEW.categoria_id;

    IF OLD.producto_codigo != NEW.producto_codigo THEN
        SET cambios = CONCAT(cambios, 'Código: ', OLD.producto_codigo, ' → ', NEW.producto_codigo, '; ');
    END IF;
    
    IF OLD.producto_nombre != NEW.producto_nombre THEN
        SET cambios = CONCAT(cambios, 'Nombre: ', OLD.producto_nombre, ' → ', NEW.producto_nombre, '; ');
    END IF;
    
    IF OLD.producto_precio != NEW.producto_precio THEN
        SET cambios = CONCAT(cambios, 'Precio: ', OLD.producto_precio, ' → ', NEW.producto_precio, '; ');
    END IF;
    
    IF OLD.producto_stock != NEW.producto_stock THEN
        SET cambios = CONCAT(cambios, 'Stock: ', OLD.producto_stock, ' → ', NEW.producto_stock, '; ');
    END IF;
    
    IF OLD.categoria_id != NEW.categoria_id THEN
        SET cambios = CONCAT(cambios, 'Categoría: ', cat_nombre_old, ' → ', cat_nombre_new, '; ');
    END IF;

    INSERT INTO registro_productos (
        accion,
        producto_id,
        producto_codigo,
        producto_nombre,
        producto_precio,
        producto_stock,
        producto_foto,
        categoria_id,
        categoria_nombre,
        modificado_por,
        descripcion
    )
    VALUES (
        'UPDATE',
        NEW.producto_id,
        NEW.producto_codigo,
        NEW.producto_nombre,
        NEW.producto_precio,
        NEW.producto_stock,
        NEW.producto_foto,
        NEW.categoria_id,
        cat_nombre_new,
        NEW.usuario_id,
        CONCAT('Se modificó el producto. ', cambios)
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_categorias`
--

CREATE TABLE `registro_categorias` (
  `registro_id` int(11) NOT NULL,
  `accion` varchar(20) NOT NULL COMMENT 'INSERT, UPDATE o DELETE',
  `categoria_id` int(11) NOT NULL COMMENT 'ID de la categoría afectada',
  `categoria_nombre` varchar(50) DEFAULT NULL COMMENT 'Nombre de la categoría',
  `categoria_ubicacion` varchar(150) DEFAULT NULL COMMENT 'Ubicación de la categoría',
  `productos_afectados` int(11) DEFAULT NULL COMMENT 'Número de productos afectados',
  `modificado_por` int(11) DEFAULT NULL COMMENT 'ID del usuario que realizó el cambio',
  `fecha_hora` datetime DEFAULT current_timestamp(),
  `descripcion` text DEFAULT NULL COMMENT 'Descripción del cambio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_productos`
--

CREATE TABLE `registro_productos` (
  `registro_id` int(11) NOT NULL,
  `accion` varchar(20) NOT NULL COMMENT 'INSERT, UPDATE o DELETE',
  `producto_id` int(11) NOT NULL COMMENT 'ID del producto afectado',
  `producto_codigo` varchar(70) DEFAULT NULL COMMENT 'Código del producto',
  `producto_nombre` varchar(70) DEFAULT NULL COMMENT 'Nombre del producto',
  `producto_precio` decimal(30,0) DEFAULT NULL COMMENT 'Precio del producto',
  `producto_stock` int(11) DEFAULT NULL COMMENT 'Stock del producto',
  `producto_foto` varchar(500) DEFAULT NULL COMMENT 'Ruta de la foto',
  `categoria_id` int(11) DEFAULT NULL COMMENT 'ID de la categoría',
  `categoria_nombre` varchar(50) DEFAULT NULL COMMENT 'Nombre de la categoría',
  `modificado_por` int(11) DEFAULT NULL COMMENT 'ID del usuario que realizó el cambio',
  `fecha_hora` datetime DEFAULT current_timestamp(),
  `descripcion` text DEFAULT NULL COMMENT 'Descripción del cambio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_usuarios`
--

CREATE TABLE `registro_usuarios` (
  `registro_id` int(11) NOT NULL,
  `accion` varchar(20) NOT NULL COMMENT 'INSERT, UPDATE o DELETE',
  `usuario_id` int(11) NOT NULL COMMENT 'ID del usuario afectado',
  `usuario_nombre` varchar(40) DEFAULT NULL COMMENT 'Nombre del usuario',
  `usuario_apellido` varchar(40) DEFAULT NULL COMMENT 'Apellido del usuario',
  `usuario_usuario` varchar(20) DEFAULT NULL COMMENT 'Nombre de usuario',
  `usuario_email` varchar(100) DEFAULT NULL COMMENT 'Email del usuario',
  `rol` varchar(20) DEFAULT NULL COMMENT 'Rol del usuario',
  `modificado_por` int(11) DEFAULT NULL COMMENT 'ID del usuario que realizó el cambio',
  `fecha_hora` datetime DEFAULT current_timestamp(),
  `descripcion` text DEFAULT NULL COMMENT 'Descripción del cambio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(40) NOT NULL,
  `usuario_apellido` varchar(40) NOT NULL,
  `usuario_usuario` varchar(20) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_clave` varchar(200) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'empleado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `usuario_nombre`, `usuario_apellido`, `usuario_usuario`, `usuario_email`, `usuario_clave`, `rol`) VALUES
(17, 'william', 'Romero', 'shipo64', 'williamarc640@gmail.com', '$2y$10$oLclZPpuD1VtDp7SX24udeYs9KcRvO20eko10Gax9HWihsZTPZvwK', 'admin');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `usuarios_delete_registro` BEFORE DELETE ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO registro_usuarios (
        accion,
        usuario_id,
        usuario_nombre,
        usuario_apellido,
        usuario_usuario,
        usuario_email,
        rol,
        descripcion
    )
    VALUES (
        'DELETE',
        OLD.usuario_id,
        OLD.usuario_nombre,
        OLD.usuario_apellido,
        OLD.usuario_usuario,
        OLD.usuario_email,
        OLD.rol,
        'Se ha eliminado el usuario del sistema'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuarios_insert_registro` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO registro_usuarios (
        accion,
        usuario_id,
        usuario_nombre,
        usuario_apellido,
        usuario_usuario,
        usuario_email,
        rol,
        modificado_por,
        descripcion
    )
    VALUES (
        'INSERT',
        NEW.usuario_id,
        NEW.usuario_nombre,
        NEW.usuario_apellido,
        NEW.usuario_usuario,
        NEW.usuario_email,
        NEW.rol,
        NEW.usuario_id,
        'Se ha registrado un nuevo usuario en el sistema'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuarios_update_registro` AFTER UPDATE ON `usuarios` FOR EACH ROW BEGIN
    DECLARE cambios TEXT DEFAULT '';
    
    IF OLD.usuario_nombre != NEW.usuario_nombre THEN
        SET cambios = CONCAT(cambios, 'Nombre: ', OLD.usuario_nombre, ' → ', NEW.usuario_nombre, '; ');
    END IF;
    
    IF OLD.usuario_apellido != NEW.usuario_apellido THEN
        SET cambios = CONCAT(cambios, 'Apellido: ', OLD.usuario_apellido, ' → ', NEW.usuario_apellido, '; ');
    END IF;
    
    IF OLD.usuario_email != NEW.usuario_email THEN
        SET cambios = CONCAT(cambios, 'Email: ', OLD.usuario_email, ' → ', NEW.usuario_email, '; ');
    END IF;
    
    IF OLD.rol != NEW.rol THEN
        SET cambios = CONCAT(cambios, 'Rol: ', OLD.rol, ' → ', NEW.rol, '; ');
    END IF;

    INSERT INTO registro_usuarios (
        accion,
        usuario_id,
        usuario_nombre,
        usuario_apellido,
        usuario_usuario,
        usuario_email,
        rol,
        modificado_por,
        descripcion
    )
    VALUES (
        'UPDATE',
        NEW.usuario_id,
        NEW.usuario_nombre,
        NEW.usuario_apellido,
        NEW.usuario_usuario,
        NEW.usuario_email,
        NEW.rol,
        NEW.usuario_id,
        CONCAT('Se modificó el usuario. ', cambios)
    );
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `registro_categorias`
--
ALTER TABLE `registro_categorias`
  ADD PRIMARY KEY (`registro_id`),
  ADD KEY `modificado_por` (`modificado_por`),
  ADD KEY `idx_reg_categorias_fecha` (`fecha_hora`),
  ADD KEY `idx_reg_categorias_categoria` (`categoria_id`);

--
-- Indices de la tabla `registro_productos`
--
ALTER TABLE `registro_productos`
  ADD PRIMARY KEY (`registro_id`),
  ADD KEY `modificado_por` (`modificado_por`),
  ADD KEY `idx_reg_productos_fecha` (`fecha_hora`),
  ADD KEY `idx_reg_productos_producto` (`producto_id`);

--
-- Indices de la tabla `registro_usuarios`
--
ALTER TABLE `registro_usuarios`
  ADD PRIMARY KEY (`registro_id`),
  ADD KEY `modificado_por` (`modificado_por`),
  ADD KEY `idx_reg_usuarios_fecha` (`fecha_hora`),
  ADD KEY `idx_reg_usuarios_usuario` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `registro_categorias`
--
ALTER TABLE `registro_categorias`
  MODIFY `registro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_productos`
--
ALTER TABLE `registro_productos`
  MODIFY `registro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_usuarios`
--
ALTER TABLE `registro_usuarios`
  MODIFY `registro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `registro_categorias`
--
ALTER TABLE `registro_categorias`
  ADD CONSTRAINT `registro_categorias_ibfk_1` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `registro_productos`
--
ALTER TABLE `registro_productos`
  ADD CONSTRAINT `registro_productos_ibfk_1` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `registro_usuarios`
--
ALTER TABLE `registro_usuarios`
  ADD CONSTRAINT `registro_usuarios_ibfk_1` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
