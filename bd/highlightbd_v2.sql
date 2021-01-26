-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2021 a las 01:38:29
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
(1, 'Iluminación'),
(3, 'Herramientas');

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
(1, 'INTERELEC'),
(2, 'OMAHA'),
(3, 'TOTAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `teléfono` varchar(255) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime NOT NULL,
  `estado_mensaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `nombre`, `correo`, `teléfono`, `motivo`, `mensaje`, `fecha_envio`, `estado_mensaje`) VALUES
(1, 'Pedro', 'pedro@ndd.com.ar', '3425162658', 'Consulta', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odit dolor maxime esse sapiente nihil tempore autem quidem necessitatibus, doloremque sint cupiditate aliquid. Eaque, est non quos ipsam quo repellat voluptate.', '2021-01-25 18:52:26', 0),
(2, 'Juan', 'ge@mmm.com.ar', '3435552676', 'Precio de producto', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque doloremque eius nisi harum temporibus minus quibusdam consequatur ea quam quasi corporis repudiandae deleniti incidunt iste quidem, vel minima ex veniam!', '2021-01-25 19:16:04', 1);

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
(1, 'Total', 'assets/img/portadas/29122020_1609255347.PNG', 'SI', 1),
(2, 'Portal La campora', 'assets/img/portadas/no-portada.png', 'NO', 1),
(3, 'Copacabana', 'assets/img/portadas/02102020_1601682643.jpg', 'NO', 1),
(4, 'La cara visible 1', 'assets/img/portadas/no-portada.png', 'SI', 0),
(5, 'Maria', 'assets/img/portadas/no-portada.png', 'NO', 0),
(6, 'Se muestra', 'assets/img/portadas/no-portada.png', 'SI', 0),
(7, 'Omaha', 'assets/img/portadas/29122020_1609255395.PNG', 'SI', 1);

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
(1, 4, 1, '300497', 'PAR 38 LED SMD 12W E27', '<ul><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><p style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Aptas intemperie.</big></p></li><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><p style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Admite ser ultilizada en ambientes húmedos.</big></p></li><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><p style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Encendido y brillo instantáneo.</big></p></li><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><p style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Ideal para ambientar jardines, parques, celebraciones, paisajismo y para destacar sectores a la intemperie.</big></p></li><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><p style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Livianas y no emiten&nbsp;calor.</big></p></li></ul>', '14.000', '500.00', '800.00', 'NO', b'1'),
(3, 4, 1, '300496', 'Lámpara AR111 12W GU10', '', '51.000', '512.00', '700.00', 'NO', b'1'),
(4, 9, 1, '300498', 'PARA ALUMBRADO PÚBLICO E40', '', '33.000', '1500.00', '2500.00', 'SI', b'1'),
(23, 9, 1, 'CA-4125', 'ALUMBRADO PÚBLICO 150W', '<ul><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Cuerpo de aluminio.</big></li><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Leds de alta potencia y máxima luminosidad.</big></li><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Altura recomendada de instalación 4-6&nbsp;mts.</big></li><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Apto intemperie IP65.</big></li></ul>', '74.000', '3500.00', '5000.00', 'SI', b'1'),
(24, 8, 2, '788998', 'ROTOMARTILLO ELÉCTRICO', '<ul class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0.5em; padding: 0px 0px 0px 1.3em; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; list-style-position: initial; list-style-image: initial; pointer-events: auto; font-size: 13px; line-height: normal; font-family: &quot;open sans&quot;, sans-serif; color: rgb(0, 0, 0); letter-spacing: 0em;\"><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Potencia:</span>&nbsp;1050&nbsp;w</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Energía&nbsp;de&nbsp;impacto:</span>&nbsp;3.5 J</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Fuente&nbsp;de&nbsp;alimentación:&nbsp;</span>Eléctrica</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Velocidad&nbsp;de&nbsp;rotación:</span>&nbsp;0-1150 rpm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Cincelador:</span>&nbsp;Sí</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Rotativo:&nbsp;</span>Sí</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Percutor:</span>&nbsp;Sí</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Golpes&nbsp;por&nbsp;minuto:</span>&nbsp;5100 bpm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Capacidad&nbsp;en&nbsp;madera:</span>&nbsp;43&nbsp;mm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Capacidad&nbsp;en&nbsp;concreto:</span>&nbsp;26 mm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Capacidad&nbsp;en&nbsp;metal:&nbsp;</span>13&nbsp;mm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Garantía:&nbsp;</span>12 meses</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Incluye:</span>&nbsp;Cincel punta 14x250mm | Cincel plano 14x250mm | Brocas 8/10/12x150 mm (3) | Carbones (2) | Barra de profundidad |&nbsp;Maletín plástico</span></p></li></ul>', '5.000', '5000.00', '9000.00', 'SI', b'1'),
(25, 6, 2, '988952', 'MARTILLO DEMOLEDOR ELÉCTRICO DE-27HEX', '<ul class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0.5em; padding: 0px 0px 0px 1.3em; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; list-style-position: initial; list-style-image: initial; pointer-events: auto; line-height: normal; color: rgb(0, 0, 0);\"><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Potencia:&nbsp;</span>2100W</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Impactos por Minutos:&nbsp;</span>1650 bpm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Energía de Impacto:&nbsp;</span>85 J</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Corriente Entrada:&nbsp;</span>9A</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Aislación:&nbsp;</span>Clase II</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Garantía:&nbsp;</span>12 meses</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Incluye:&nbsp;</span>Carro maletín con ruedas | Cincel punta | Cincel plano</span></p></li></ul>', '5.000', '10000.00', '15000.00', 'SI', b'1'),
(26, 8, 3, '89797987', 'Atornillador Inalámbrico 8V – TSDLI0801', '<ul style=\"margin-bottom: 0px; color: rgb(119, 119, 119); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><li style=\"line-height: 22px;\">Encastre hexagonal: 1/4“</li><li style=\"line-height: 22px;\">Velocidad : 0-220 / min.</li><li style=\"line-height: 22px;\">Torque máx .: 5.5 N.m</li><li style=\"line-height: 22px;\">Configuración de Torque: 15 + 1</li><li style=\"line-height: 22px;\">Luz de trabajo integrada</li><li style=\"line-height: 22px;\">Indicador de nivel de carga</li><li style=\"line-height: 22px; margin-bottom: 0px;\">Incluye cargador, 10 puntas 25mm de Cr-V, 1 soporte de broca magnética, 4 brocas HSS con vástago hexagonal y bolso transportador</li></ul>', '10.000', '3500.00', '5000.00', 'NO', b'1'),
(27, 8, 3, '654488', 'Atornillador Inalámbrico 4V – TSDLI0401', '<ul style=\"margin-bottom: 0px; color: rgb(119, 119, 119); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\"><li style=\"line-height: 22px;\">Encastre hexagonal: 1/4”</li><li style=\"line-height: 22px;\">Velocidad : 180 rpm</li><li style=\"line-height: 22px;\">Torque máx .: 4N.m</li><li style=\"line-height: 22px;\">Luz de trabajo integrada</li><li style=\"line-height: 22px;\">Indicador de nivel de carga</li><li style=\"line-height: 22px; margin-bottom: 0px;\">Incluye cargador, 10 puntas hexagonales de 25mm y 1 soporte de broca magnética</li></ul>', '10.000', '3700.00', '5700.00', 'SI', b'1'),
(28, 8, 3, '5445545', 'Amoladora Angular TG1302306-4', '<ul style=\"margin-bottom: 0px; color: rgb(119, 119, 119); font-family: \"Open Sans\", sans-serif; font-size: 14px;\"><li style=\"line-height: 22px;\">Velocidad : 6300 rpm</li><li style=\"line-height: 22px;\">Diámetro del disco: 230 mm</li><li style=\"line-height: 22px;\">Rosca del husillo: M14</li><li style=\"line-height: 22px;\">Incluye mango auxiliar y 1 juego de<br style=\"margin-bottom: 0px;\">carbónes</li><li style=\"line-height: 22px; margin-bottom: 0px;\"><span style=\"font-weight: bolder; margin-bottom: 0px;\">Uso</span> INDUSTRIAL</li></ul>', '12.000', '3500.00', '5000.00', 'SI', b'1'),
(29, 6, 3, '65656', 'Amoladora Angular TG1141256-4', '<ul style=\"margin-bottom: 0px; color: rgb(119, 119, 119); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\"><li style=\"line-height: 22px;\">Potencia: 1400W</li><li style=\"line-height: 22px;\">Velocidad: 11000rpm</li><li style=\"line-height: 22px;\">Diámetro de disco: 125mm</li><li style=\"line-height: 22px;\">Adaptable a disco de 115mm</li><li style=\"line-height: 22px;\">Protección Epoxi</li><li style=\"line-height: 22px;\">Bloqueo del eje para un fácil reemplazo del disco</li><li style=\"line-height: 22px;\">Interruptor de encendido / apagado de fácil acceso para el control y la comodidad</li><li style=\"line-height: 22px;\">Mango de posición múltiple permite una operación más fácil</li><li style=\"line-height: 22px;\">Engranajes de aluminio duradero para una larga vida útil</li><li style=\"line-height: 22px; margin-bottom: 0px;\"><span style=\"font-weight: bolder; margin-bottom: 0px;\">Uso</span>&nbsp;INDUSTRIAL</li></ul>', '4.000', '3200.00', '4500.00', 'NO', b'1'),
(30, 7, 3, '335564', 'Set de Llave Tubo', '<ul style=\"margin-bottom: 0px; color: rgb(119, 119, 119); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\"><li style=\"line-height: 22px;\">Marca: TOTAL</li><li style=\"line-height: 22px;\">12 piezas encastre 1/2″</li><li style=\"line-height: 22px;\">Llave crique 1/2</li><li style=\"line-height: 22px;\">Extensión 125mm</li><li style=\"line-height: 22px;\">Medidas: 10-15mm, 17 mm, 19 mm, 21 mm, 24 mm</li><li style=\"line-height: 22px;\">Llave inglesa 450mm</li><li style=\"line-height: 22px; margin-bottom: 0px;\"><span style=\"font-weight: bolder; margin-bottom: 0px;\">Uso</span>&nbsp;INDUSTRIAL</li></ul>', '15.000', '2700.00', '3500.00', 'NO', b'1'),
(31, 7, 3, '56454', 'Llaves Ajustables', '<ul style=\"margin-bottom: 0px; color: rgb(119, 119, 119); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\"><li style=\"line-height: 22px;\">Marca: TOTAL</li><li style=\"line-height: 22px;\">Llave&nbsp;ajustable&nbsp;150mm</li><li style=\"line-height: 22px;\">Llave&nbsp;ajustable&nbsp;200mm</li><li style=\"line-height: 22px;\">Llave&nbsp;ajustable&nbsp;250mm</li><li style=\"line-height: 22px;\">Llave&nbsp;ajustable&nbsp;300mm</li><li style=\"line-height: 22px; margin-bottom: 0px;\"><span style=\"font-weight: bolder; margin-bottom: 0px;\">Uso</span>&nbsp;INDUSTRIAL</li></ul>', '14.000', '1700.00', '2700.00', 'SI', b'1'),
(32, 8, 2, '5564564', 'ROTOMARTILLO ELÉCTRICO RM-36PLUS', '<ul class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0.5em; padding: 0px 0px 0px 1.3em; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; list-style-position: initial; list-style-image: initial; pointer-events: auto; font-size: 13px; line-height: normal; font-family: \"open sans\", sans-serif; color: rgb(0, 0, 0); letter-spacing: 0em;\"><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Potencia:</span> 1800 w</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Energía de impacto:</span> 7 J</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Fuente de alimentación: </span>Eléctrica</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Velocidad de rotación:</span> 820 rpm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Cincelador:</span> Sí</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Rotativo: </span>Sí</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Percutor:</span> Sí</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Golpes por minuto:</span> 4000 bpm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Capacidad en madera:</span> 42 mm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Capacidad en concreto:</span> 36 mm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Capacidad en metal: </span>13 mm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Garantía: </span>12 meses</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Incluye:</span> Cincel punta 14x250mm | Cincel plano 14x250mm | Brocas 8/10/12x150 mm (3) | Carbones (2) | Maletín plástico</span></p></li></ul>', '17.000', '7000.00', '12000.00', 'SI', b'1'),
(33, 7, 2, '56456456', 'CARRETILLA METÁLICA 120 KG CAPB-01', '<ul class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0.5em; padding: 0px 0px 0px 1.3em; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; list-style-position: initial; list-style-image: initial; pointer-events: auto; line-height: normal; color: rgb(0, 0, 0);\"><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Soporta:</span>&nbsp;120 Kg</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Diámetro rueda:</span>&nbsp;13x3\"</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Bandeja:</span>&nbsp;76x47x23 cm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Espesor de Bandeja:</span>&nbsp;0.6 mm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Color:</span>&nbsp;Rojo</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Distancia entre barrales:</span>&nbsp;36 cm</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit; letter-spacing: 0em; font-family: &quot;open sans&quot;, sans-serif; font-size: 13px;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Profundidad:</span>&nbsp;23 cm</span></p></li></ul>', '12.000', '3500.00', '4200.00', 'NO', b'1'),
(34, 6, 2, '57456645', 'ASPIRADORA SOPLADORA VP-20', '<ul class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0.5em; padding: 0px 0px 0px 1.3em; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; list-style-position: initial; list-style-image: initial; pointer-events: auto; font-size: 13px; line-height: normal; font-family: &quot;open sans&quot;, sans-serif; color: rgb(0, 0, 0); letter-spacing: 0em;\"><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Tensión:&nbsp;</span>220V~</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Frecuencia:</span>&nbsp;50Hz</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Potencia:</span>&nbsp;</span>2400W</p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Máx. poder de succión:</span>&nbsp;170±20 W</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Caudal:&nbsp;</span>1.7±0.1 m³/min</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Ruido:</span>&nbsp;≤80</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Capacidad:&nbsp;</span>75 lts</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">Largo del cable:&nbsp;</span>1,5 mts</span></p></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-style: inherit; font-weight: inherit; line-height: inherit;\"><p class=\"font_8\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; line-height: normal; color: rgb(var(--color_15));\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background: transparent; font-weight: bold;\">INCLUYE:&nbsp;</span>Manguera de 1.5 mts | Tubos plásticos (2) | Cepillo para piso seco | Cepillo para líquidos | Boquilla con cepillo para polvo | Filtro HEPA | Bolsa</span></p></li></ul>', '7.000', '25000.00', '35000.00', 'SI', b'1');
INSERT INTO `productos` (`id_producto`, `id_subcat`, `id_mar`, `codigoPR`, `nombrePR`, `descripcionPR`, `stockPR`, `precio_listaPR`, `precio_ventaPR`, `destacadoPR`, `estadoPR`) VALUES
(35, 4, 1, '8684654', '1W E12 PARA MÁQUINAS DE COSER', '<div class=\"description\" style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; color: rgb(127, 127, 127); font-size: 12px; line-height: 20px; margin: 0px 0px 32px; font-family: Ubuntu, sans-serif; outline: none !important;\"><ul style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; margin-right: 0px; margin-bottom: 22px; margin-left: 0px; padding: 0px 0px 0px 60px; outline: none !important;\"><li style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\"><big style=\"border-color: rgb(225, 225, 225); border-style: solid; border-width: 0px; zoom: 1; -webkit-tap-highlight-color: transparent; outline: none !important;\">Iluminación para utilizar específicamente en máquinas de coser.</big></li></ul></div>', '12.000', '300.00', '450.00', 'NO', b'1');

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
(46, 24, 'assets/img/productos/29122020_1609257149_0.PNG'),
(47, 25, 'assets/img/productos/29122020_1609257286_0.PNG'),
(48, 26, 'assets/img/productos/29122020_1609257419_0.PNG'),
(49, 27, 'assets/img/productos/29122020_1609257466_0.PNG'),
(50, 28, 'assets/img/productos/29122020_1609257654_0.PNG'),
(51, 29, 'assets/img/productos/29122020_1609257718_0.PNG'),
(52, 30, 'assets/img/productos/29122020_1609257902_0.PNG'),
(53, 31, 'assets/img/productos/29122020_1609258009_0.PNG'),
(55, 32, 'assets/img/productos/29122020_1609258227_0.PNG'),
(56, 33, 'assets/img/productos/29122020_1609258310_0.PNG'),
(57, 34, 'assets/img/productos/29122020_1609258390_0.PNG'),
(58, 3, 'assets/img/productos/29122020_1609258568_0.PNG'),
(59, 1, 'assets/img/productos/29122020_1609258657_0.PNG'),
(60, 4, 'assets/img/productos/29122020_1609258755_0.PNG'),
(61, 23, 'assets/img/productos/29122020_1609258903_0.PNG'),
(62, 35, 'assets/img/productos/29122020_1609259024_0.PNG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_ofertas`
--

CREATE TABLE `productos_ofertas` (
  `id_oferta` int(11) NOT NULL,
  `id_produc` int(11) DEFAULT NULL,
  `id_subcat` int(11) DEFAULT NULL,
  `porcentaje` decimal(10,2) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_cancelado` datetime DEFAULT NULL,
  `estado_oferta` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_ofertas`
--

INSERT INTO `productos_ofertas` (`id_oferta`, `id_produc`, `id_subcat`, `porcentaje`, `fecha_inicio`, `fecha_fin`, `fecha_cancelado`, `estado_oferta`) VALUES
(2, 33, NULL, '10.00', '2021-01-08', NULL, NULL, b'0'),
(3, 3, NULL, '14.29', '2021-01-09', NULL, NULL, b'0'),
(4, NULL, 7, '25.00', '2021-01-10', NULL, NULL, b'1'),
(5, 3, NULL, '15.00', '2021-01-12', NULL, NULL, b'0'),
(6, NULL, 2, '15.00', '2021-01-12', NULL, '2021-01-12 19:14:10', b'0'),
(7, NULL, 6, '20.00', '2021-01-13', NULL, '2021-01-12 19:49:25', b'0'),
(8, 23, NULL, '20.00', '2021-01-12', NULL, NULL, b'1'),
(10, NULL, 4, '12.50', '2021-01-13', '2021-01-20', NULL, b'1'),
(11, 25, NULL, '10.00', '2021-01-12', NULL, NULL, b'1'),
(12, 29, NULL, '15.00', '2021-01-13', NULL, NULL, b'1'),
(13, NULL, 2, '10.00', '2021-01-14', NULL, NULL, b'1');

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
(2, 1, 'Fotocontroles'),
(4, 1, 'Lamparas LED'),
(6, 3, 'Eléctricas'),
(7, 3, 'Manuales'),
(8, 3, 'Inalámbricas'),
(9, 1, 'Lámparas ALTA POTENCIA');

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
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`);

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
-- Indices de la tabla `productos_ofertas`
--
ALTER TABLE `productos_ofertas`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `id_produc` (`id_produc`),
  ADD KEY `id_subcat` (`id_subcat`);

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
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `portadas`
--
ALTER TABLE `portadas`
  MODIFY `id_port` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `productos_fotos`
--
ALTER TABLE `productos_fotos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `productos_ofertas`
--
ALTER TABLE `productos_ofertas`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Filtros para la tabla `productos_ofertas`
--
ALTER TABLE `productos_ofertas`
  ADD CONSTRAINT `productos_ofertas_ibfk_1` FOREIGN KEY (`id_produc`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `productos_ofertas_ibfk_2` FOREIGN KEY (`id_subcat`) REFERENCES `subcategorias` (`id_subcategoria`);

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
