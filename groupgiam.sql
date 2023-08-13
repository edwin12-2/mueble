-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-12-2022 a las 19:12:22
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `groupgiam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fechaCreado` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaCambio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `clave`, `fechaCreado`, `fechaCambio`) VALUES
(1, 'admi', 'admi', '2022-10-21 20:01:07', ''),
(2, '123', '123', '2022-10-21 22:02:29', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoriaN` varchar(255) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fechaCreado` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaCambio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoriaN`, `descripcion`, `fechaCreado`, `fechaCambio`) VALUES
(1, 'Sillas', 'a', '2022-10-22 01:37:53', ''),
(5, 'sofas', 'categori sofa', '2022-11-12 23:20:25', ''),
(6, 'mesas', 'muebles', '2022-12-03 22:20:14', ''),
(7, 'Armario', 'muebles armario', '2022-12-05 16:43:16', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiapedidos`
--

CREATE TABLE `historiapedidos` (
  `id` int(11) NOT NULL,
  `pedidoId` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `observar` mediumtext NOT NULL,
  `fechaPublicar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historiapedidos`
--

INSERT INTO `historiapedidos` (`id`, `pedidoId`, `estado`, `observar`, `fechaPublicar`) VALUES
(2, 8, 'En proceso', 'esta procesando\r\n                            ', '2022-12-05 16:45:34'),
(3, 12, 'Entregado', 'se entregó\r\n                            ', '2022-12-05 16:46:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `inventarioId` int(11) NOT NULL,
  `productoId` int(11) NOT NULL,
  `enFecha` date NOT NULL,
  `enExistencia` int(11) NOT NULL,
  `fechaSalida` date NOT NULL,
  `salidaExistencia` int(11) NOT NULL,
  `restante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`inventarioId`, `productoId`, `enFecha`, `enExistencia`, `fechaSalida`, `salidaExistencia`, `restante`) VALUES
(2, 24, '2022-12-03', 2, '0000-00-00', 0, 2),
(3, 25, '2022-12-03', 5, '0000-00-00', 0, 5),
(4, 26, '2022-12-05', 4, '0000-00-00', 0, 4),
(5, 27, '2022-12-05', 4, '0000-00-00', 0, 4),
(6, 28, '2022-12-05', 5, '0000-00-00', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `productoId` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaPedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `metodoPago` varchar(50) DEFAULT NULL,
  `pedidoEstado` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuarioId`, `productoId`, `cantidad`, `fechaPedido`, `metodoPago`, `pedidoEstado`) VALUES
(12, 4, '25', 1, '2022-12-05 20:00:40', 'Tarjeta', 'Entregado'),
(13, 5, '28', 1, '2022-12-05 21:37:41', 'Tarjeta', 'Pendiente'),
(14, 4, '28', 1, '2022-12-09 20:12:16', 'Tarjeta', 'Pendiente'),
(15, 4, '26', 2, '2022-12-09 20:55:43', 'Tarjeta', 'Pendiente'),
(16, 4, '25', 1, '2022-12-09 21:51:48', 'Tarjeta', 'Pendiente'),
(17, 4, '26', 2, '2022-12-09 21:51:48', 'Tarjeta', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `subcategoria` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `precioAnterior` int(11) NOT NULL,
  `describir` longtext NOT NULL,
  `imagen1` varchar(255) NOT NULL,
  `imagen2` varchar(255) NOT NULL,
  `imagen3` varchar(255) NOT NULL,
  `costoEnviar` int(11) NOT NULL,
  `disponibilidad` varchar(255) NOT NULL,
  `fechaPublicar` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaCambio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria`, `subcategoria`, `producto`, `empresa`, `precio`, `precioAnterior`, `describir`, `imagen1`, `imagen2`, `imagen3`, `costoEnviar`, `disponibilidad`, `fechaPublicar`, `fechaCambio`) VALUES
(24, 1, 1, 'silla', 'Group Peru', 40, 40, '              descp. silla                                  \r\n                                            ', 'Silla de Madera1.png', 'Silla de Madera1.png', 'Silla de Madera1.png', 1, 'En stock', '2022-12-03 23:37:09', ''),
(25, 5, 3, 'sofá', 'Group Peru', 90, 100, '                     muebles                  ', 'sofa.jpg', 'sofa.jpg', 'sofa.jpg', 1, 'Fuera de Stock', '2022-12-04 00:06:55', ''),
(26, 6, 4, 'mesas ', 'Group Peru', 80, 80, '   a                                             \r\n                                            ', 'mesa melamina.png', 'mesa melamina.png', 'mesa melamina.png', 1, 'En stock', '2022-12-05 16:40:44', ''),
(28, 7, 5, 'armario', 'Group Peru', 89, 90, ' a                                               \r\n                                            ', 'armario2.png', 'armario2.png', 'armario2.png', 1, 'En stock', '2022-12-05 16:44:17', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `categoriaId` int(11) NOT NULL,
  `subcategoria` varchar(255) NOT NULL,
  `fechaCreado` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaCambio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `categoriaId`, `subcategoria`, `fechaCreado`, `fechaCambio`) VALUES
(1, 1, 'Sub. Silla', '2022-10-22 02:25:59', '03-12-2022 03:36:12 PM'),
(3, 5, 'Sub Sofá', '2022-11-12 23:20:37', '03-12-2022 04:05:57 PM'),
(4, 6, 'mesas1', '2022-12-03 22:20:25', ''),
(5, 7, 'sub armario', '2022-12-05 16:43:29', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contacto` bigint(11) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `enviarA` longtext NOT NULL,
  `enviarEstado` varchar(255) NOT NULL,
  `enviarCiudad` varchar(255) NOT NULL,
  `enviarPostal` int(11) NOT NULL,
  `facturarA` longtext NOT NULL,
  `facturarEstado` varchar(255) NOT NULL,
  `facturarCiudad` varchar(255) NOT NULL,
  `facturarPostal` int(11) NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaCambio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contacto`, `clave`, `enviarA`, `enviarEstado`, `enviarCiudad`, `enviarPostal`, `facturarA`, `facturarEstado`, `facturarCiudad`, `facturarPostal`, `fechaRegistro`, `fechaCambio`) VALUES
(4, 'omar', 'omar@gmail', 1234, '12', '1', '', '', 0, '1', '', '', 0, '2022-12-04 03:31:11', ''),
(5, 'roger', 'roger@gmail', 1212, 'c20ad4d76fe97759aa27a0c99bff6710', 'q', '', '', 0, 'q', '', '', 0, '2022-12-05 21:37:19', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosingresados`
--

CREATE TABLE `usuariosingresados` (
  `id` int(11) NOT NULL,
  `usuarioCorreo` varchar(255) NOT NULL,
  `usuarioRip` binary(16) NOT NULL,
  `horaInicio` timestamp NOT NULL DEFAULT current_timestamp(),
  `salir` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuariosingresados`
--

INSERT INTO `usuariosingresados` (`id`, `usuarioCorreo`, `usuarioRip`, `horaInicio`, `salir`, `estado`) VALUES
(1, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-10-22 12:42:53', '', 1),
(2, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-10-22 12:43:14', '', 1),
(3, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-03 21:01:30', '', 1),
(4, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 01:25:44', '', 1),
(5, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 01:26:01', '', 1),
(6, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 01:26:12', '', 1),
(7, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 01:41:57', '', 1),
(8, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 01:42:15', '', 1),
(9, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 01:44:14', '', 1),
(10, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 01:44:25', '', 1),
(11, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 01:45:54', '', 1),
(12, 'e@e', 0x3a3a3100000000000000000000000000, '2022-12-04 03:24:38', '', 1),
(13, 'e@e', 0x3a3a3100000000000000000000000000, '2022-12-04 03:26:42', '', 1),
(14, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 03:31:20', '', 1),
(15, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 03:43:28', '', 1),
(16, 'OMAR@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 04:17:09', '', 1),
(17, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 11:38:29', '', 1),
(18, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 11:42:40', '', 1),
(19, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-04 14:27:13', '', 1),
(20, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-05 16:39:32', '', 1),
(21, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-05 19:54:22', '', 1),
(22, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-05 19:56:56', '', 1),
(23, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-05 19:59:45', '', 1),
(24, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-05 21:37:24', '', 1),
(25, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-05 21:45:15', '', 1),
(26, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-05 21:50:33', '', 1),
(27, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-08 11:41:01', '', 1),
(28, 'roger@gmail', 0x3a3a3100000000000000000000000000, '2022-12-09 03:15:01', '', 1),
(29, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-09 03:25:19', '', 1),
(30, 'omar@gmail', 0x3a3a3100000000000000000000000000, '2022-12-10 00:28:36', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historiapedidos`
--
ALTER TABLE `historiapedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`inventarioId`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuariosingresados`
--
ALTER TABLE `usuariosingresados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `historiapedidos`
--
ALTER TABLE `historiapedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `inventarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

-- 
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuariosingresados`
--
ALTER TABLE `usuariosingresados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
