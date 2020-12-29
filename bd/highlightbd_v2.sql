-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2020 a las 15:28:49
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `highlightbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `descripcionCAT` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `descripcionCAT`) VALUES
(1, 'Accesorios para iluminación'),
(2, 'Verduras'),
(3, 'Carasucias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `id_usu` int(11) NOT NULL,
  `num_factura` varchar(45) NOT NULL,
  `fechaCOM` date NOT NULL,
  `totalCOM` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprasdetalle`
--

CREATE TABLE `comprasdetalle` (
  `id_compra_det` int(11) NOT NULL,
  `id_comp` int(11) NOT NULL,
  `id_pr` int(11) NOT NULL,
  `cantidadCOM` decimal(10,3) NOT NULL,
  `precioCOM` decimal(18,2) NOT NULL,
  `subtotalCOM` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_img` int(11) NOT NULL,
  `imagen_1` varchar(255) NOT NULL,
  `imagen_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_img`, `imagen_1`, `imagen_2`) VALUES
(1, 'assets/img/imagenes/25122020_16089381111.jpeg', 'assets/img/imagenes/25122020_16089381112.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `descripcionM` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `descripcionM`) VALUES
(1, 'INTERELEC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portadas`
--

CREATE TABLE `portadas` (
  `id_port` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `publicado` enum('SI','NO') NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `portadas`
--

INSERT INTO `portadas` (`id_port`, `titulo`, `imagen`, `publicado`, `estado`) VALUES
(1, 'La casa de papel', 'assets/img/portadas/no-portada.png', 'SI', 1),
(2, 'Portal La campora', 'assets/img/portadas/no-portada.png', 'NO', 1),
(3, 'Copacabana', 'assets/img/portadas/02102020_1601682643.jpg', 'NO', 1),
(4, 'La cara visible 1', 'assets/img/portadas/no-portada.png', 'SI', 0),
(5, 'Maria', 'assets/img/portadas/no-portada.png', 'NO', 0),
(6, 'Se muestra', 'assets/img/portadas/no-portada.png', 'SI', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_subcat` int(11) NOT NULL,
  `id_mar` int(11) NOT NULL,
  `codigoPR` varchar(80) NOT NULL,
  `nombrePR` varchar(100) NOT NULL,
  `descripcionPR` text DEFAULT NULL,
  `stockPR` decimal(18,3) NOT NULL,
  `precio_listaPR` decimal(18,2) NOT NULL,
  `precio_ventaPR` decimal(18,2) NOT NULL,
  `destacadoPR` enum('SI','NO') NOT NULL,
  `estadoPR` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_subcat`, `id_mar`, `codigoPR`, `nombrePR`, `descripcionPR`, `stockPR`, `precio_listaPR`, `precio_ventaPR`, `destacadoPR`, `estadoPR`) VALUES
(1, 4, 1, '300497', 'Fotocontrol alumbrado público 2200W 10Amp.', '<ul><li>Casa</li><li>Allá</li></ul>', '14.000', '500.00', '800.00', 'SI', b'1'),
(2, 3, 1, '7458', 'Caca doble', NULL, '41.000', '122.00', '156.00', 'NO', b'1'),
(3, 2, 1, '300496', 'Fotocontrol domiciliario 1300W 6 amp.', NULL, '51.000', '512.00', '700.00', 'SI', b'1'),
(4, 2, 1, '300498', 'ZÓCALO PARA FOTOCONTROL 2200W', NULL, '33.000', '333.00', '444.00', 'SI', b'1'),
(7, 2, 1, '8256', 'la pucha', NULL, '44.000', '451.00', '550.00', 'NO', b'1'),
(8, 2, 1, '41256', 'La otra vez', NULL, '12.000', '41.00', '55.00', 'SI', b'1'),
(9, 2, 1, '41288', 'La otra vez con imgs', NULL, '12.000', '41.00', '55.00', 'SI', b'1'),
(10, 2, 1, '4174', 'Mil veces', NULL, '12.000', '46.00', '55.00', 'SI', b'0'),
(11, 3, 1, '85699', 'Casa de alguien', '{\"Tama\\u00f1o\":\"Regulable\",\"Medidas\":\"22 x 52 x 36\"}', '45.000', '412.00', '520.00', 'NO', b'1'),
(12, 3, 1, '4589', 'Casa de alguien 2', '<b><i>Todo pasará</i></b>', '45.000', '412.00', '520.00', 'NO', b'0'),
(13, 3, 1, '4889', 'Casa de tuya', NULL, '45.000', '412.00', '22520.00', 'SI', b'1'),
(15, 3, 1, '51395', 'la casa de quien', NULL, '745.000', '125.00', '521.00', 'NO', b'1'),
(16, 3, 1, '74588', 'pedazo', NULL, '22.000', '41.00', '123.00', 'NO', b'1'),
(17, 1, 1, '41744', 'Jebus', NULL, '23.000', '12.00', '34.00', 'SI', b'1'),
(18, 3, 1, '741', 'Casucha tuya', NULL, '122.000', '123.00', '321.00', 'NO', b'0'),
(22, 1, 1, '7412', 'Casas tuys', '<ul><li>vamis</li><li>gaso</li></ul>', '12.000', '12.00', '32.00', 'NO', b'1'),
(23, 3, 1, 'CA-4125', 'Arco luminico', '<ul><li><b>Vamos</b></li><li><b>Ya está</b></li></ul>', '74.000', '452.00', '625.00', 'NO', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_fotos`
--

CREATE TABLE `productos_fotos` (
  `id_foto` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_fotos`
--

INSERT INTO `productos_fotos` (`id_foto`, `id_prod`, `foto`) VALUES
(11, 15, 'assets/img/productos/07122020_1607390215_0.jpg'),
(12, 15, 'assets/img/productos/07122020_1607390215_2.jpg'),
(18, 16, 'assets/img/productos/14122020_1607978399_1.jpg'),
(19, 16, 'assets/img/productos/14122020_1607978399_2.jpg'),
(20, 2, 'assets/img/productos/14122020_1607978590_1.jpg'),
(21, 2, 'assets/img/productos/14122020_1607978590_2.jpg'),
(26, 19, 'assets/img/productos/15122020_1608063013_0.jpg'),
(27, 19, 'assets/img/productos/15122020_1608063013_1.jpg'),
(28, 20, 'assets/img/productos/15122020_1608064982_0.jpg'),
(29, 20, 'assets/img/productos/15122020_1608064982_1.jpg'),
(37, 23, 'assets/img/productos/29122020_1609211031_0.JPG'),
(38, 23, 'assets/img/productos/29122020_1609211031_1.PNG'),
(39, 12, 'assets/img/productos/29122020_1609251258_0.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombrePROV` varchar(70) NOT NULL,
  `domicilioPROV` varchar(100) DEFAULT NULL,
  `telefonoPROV` varchar(15) NOT NULL,
  `emailPROV` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `descripcionSC` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `id_cat`, `descripcionSC`) VALUES
(1, 2, 'Tomates'),
(2, 1, 'Fotocontroles'),
(3, 2, 'toma'),
(4, 1, 'Lamparas'),
(5, 3, 'NEGRAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarios`
--

CREATE TABLE `tipousuarios` (
  `id_tipoUsuario` int(11) NOT NULL,
  `tipo_usuario` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipousuarios`
--

INSERT INTO `tipousuarios` (`id_tipoUsuario`, `tipo_usuario`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_tu` int(11) NOT NULL,
  `nombreU` varchar(50) DEFAULT NULL,
  `apellidoU` varchar(50) DEFAULT NULL,
  `telefonoU` varchar(15) DEFAULT NULL,
  `fotoU` varchar(255) NOT NULL,
  `emailU` varchar(100) NOT NULL,
  `nickU` varchar(45) NOT NULL,
  `passwordU` varchar(255) NOT NULL,
  `estadoU` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_tu`, `nombreU`, `apellidoU`, `telefonoU`, `fotoU`, `emailU`, `nickU`, `passwordU`, `estadoU`) VALUES
(1, 1, 'Guido', 'Muchut', '215484545', 'assets/img/perfiles/no-user.jpg', 'gem_18@live.com', 'guido', '$2y$10$4uSC0/FVz5BJNjBikAD1veXvqWqGAMTzXzT63FNz.nAcPcEDDtFxO', b'1'),
(2, 2, 'Juancho', 'Perez', '41255125', 'assets/img/perfiles/02102020_1601672099.jpg', 'juan_99999@gmail.com', 'juan', '123', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_us` int(11) NOT NULL,
  `fechaVENT` datetime NOT NULL,
  `totalVENT` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventasdetalle`
--

CREATE TABLE `ventasdetalle` (
  `id_venta_det` int(11) NOT NULL,
  `id_vent` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `cantidadVENT` decimal(10,3) NOT NULL,
  `precioVENT` decimal(18,2) NOT NULL,
  `subtotalVENT` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `Compras_Proveedores_idx` (`id_prov`),
  ADD KEY `Compras_Usuarios_idx` (`id_usu`);

--
-- Indices de la tabla `comprasdetalle`
--
ALTER TABLE `comprasdetalle`
  ADD PRIMARY KEY (`id_compra_det`),
  ADD KEY `ComprasDetalle_Compras_idx` (`id_comp`),
  ADD KEY `ComprasDetalle_Productos_idx` (`id_pr`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_img`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `portadas`
--
ALTER TABLE `portadas`
  ADD PRIMARY KEY (`id_port`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `Productos_Subcategorias_idx` (`id_subcat`),
  ADD KEY `Productos_Marcas_idx` (`id_mar`);

--
-- Indices de la tabla `productos_fotos`
--
ALTER TABLE `productos_fotos`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `Subcategorias_Categorias_idx` (`id_cat`);

--
-- Indices de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  ADD PRIMARY KEY (`id_tipoUsuario`),
  ADD UNIQUE KEY `tipo_suario_UNIQUE` (`tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nickU_UNIQUE` (`nickU`),
  ADD UNIQUE KEY `emailU_UNIQUE` (`emailU`),
  ADD KEY `Usuarios_TipoUsuarios_idx` (`id_tu`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `Ventas_Usuarios_idx` (`id_us`);

--
-- Indices de la tabla `ventasdetalle`
--
ALTER TABLE `ventasdetalle`
  ADD PRIMARY KEY (`id_venta_det`),
  ADD KEY `VentasDetalle_Ventas_idx` (`id_vent`),
  ADD KEY `VentasDetalle_Lotes_idx` (`id_product`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprasdetalle`
--
ALTER TABLE `comprasdetalle`
  MODIFY `id_compra_det` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `portadas`
--
ALTER TABLE `portadas`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `productos_fotos`
--
ALTER TABLE `productos_fotos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  MODIFY `id_tipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventasdetalle`
--
ALTER TABLE `ventasdetalle`
  MODIFY `id_venta_det` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `Compras_Proveedores` FOREIGN KEY (`id_prov`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Compras_Usuarios` FOREIGN KEY (`id_usu`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comprasdetalle`
--
ALTER TABLE `comprasdetalle`
  ADD CONSTRAINT `ComprasDetalle_Compras` FOREIGN KEY (`id_comp`) REFERENCES `compras` (`id_compra`),
  ADD CONSTRAINT `ComprasDetalle_Productos` FOREIGN KEY (`id_pr`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `Productos_Marcas` FOREIGN KEY (`id_mar`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `Productos_Subcategorias` FOREIGN KEY (`id_subcat`) REFERENCES `subcategorias` (`id_subcategoria`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `Subcategorias_Categorias` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Usuarios_TipoUsuarios` FOREIGN KEY (`id_tu`) REFERENCES `tipousuarios` (`id_tipoUsuario`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `Ventas_Usuarios` FOREIGN KEY (`id_us`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventasdetalle`
--
ALTER TABLE `ventasdetalle`
  ADD CONSTRAINT `VentasDetalle_Productos` FOREIGN KEY (`id_product`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `VentasDetalle_Ventas` FOREIGN KEY (`id_vent`) REFERENCES `ventas` (`id_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
