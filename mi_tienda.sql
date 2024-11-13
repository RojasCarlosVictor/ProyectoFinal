-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2024 a las 21:47:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mi_tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(20) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `total`, `fecha`, `estado`) VALUES
(1, NULL, 109.96, '2024-11-12 19:51:12', 'pendiente'),
(2, NULL, 29.99, '2024-11-12 21:21:52', 'pendiente'),
(3, NULL, 79.97, '2024-11-12 21:34:40', 'pendiente'),
(4, NULL, 19.99, '2024-11-12 21:38:36', 'pendiente'),
(5, NULL, 69.98, '2024-11-12 21:39:41', 'pendiente'),
(6, NULL, 189.94, '2024-11-12 22:05:57', 'pendiente'),
(7, NULL, 19.99, '2024-11-13 12:12:03', 'pendiente'),
(8, NULL, 79.97, '2024-11-13 12:19:28', 'pendiente'),
(9, NULL, 49.98, '2024-11-13 12:54:55', 'pendiente'),
(10, NULL, 29.99, '2024-11-13 13:09:23', 'pendiente'),
(11, 5, 139.95, '2024-11-13 13:34:07', 'pendiente'),
(12, 5, 139.95, '2024-11-13 13:39:58', 'pendiente'),
(13, 5, 89.97, '2024-11-13 13:40:16', 'pendiente'),
(14, 5, 69.98, '2024-11-13 13:40:49', 'pendiente'),
(15, 5, 39.98, '2024-11-13 13:43:01', 'pendiente'),
(16, 4, 59.98, '2024-11-13 14:21:37', 'pendiente'),
(17, 8, 29.99, '2024-11-13 14:23:24', 'pendiente'),
(18, 8, 39.99, '2024-11-13 14:31:17', 'pendiente'),
(19, 4, 29.99, '2024-11-13 18:56:35', 'pendiente'),
(20, 10, 59.98, '2024-11-13 19:10:04', 'pendiente'),
(21, 10, 59.98, '2024-11-13 19:12:19', 'pendiente'),
(22, 10, 39.99, '2024-11-13 19:28:44', 'pendiente'),
(23, 10, 69.98, '2024-11-13 19:40:54', 'pendiente'),
(24, 10, 39.99, '2024-11-13 19:54:22', 'pendiente'),
(25, 4, 69.98, '2024-11-13 20:25:47', 'pendiente'),
(26, 4, 89.97, '2024-11-13 20:27:32', 'pendiente'),
(27, 12, 69.98, '2024-11-13 20:30:35', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalles`
--

CREATE TABLE `pedido_detalles` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_detalles`
--

INSERT INTO `pedido_detalles` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 1, 2, 19.99),
(2, 1, 3, 1, 39.99),
(3, 1, 2, 1, 29.99),
(4, 2, 2, 1, 29.99),
(5, 3, 1, 1, 19.99),
(6, 3, 2, 2, 29.99),
(7, 4, 1, 1, 19.99),
(8, 5, 2, 1, 29.99),
(9, 5, 3, 1, 39.99),
(10, 6, 2, 3, 29.99),
(11, 6, 3, 2, 39.99),
(12, 6, 1, 1, 19.99),
(13, 7, 1, 1, 19.99),
(14, 8, 1, 1, 19.99),
(15, 8, 2, 2, 29.99),
(16, 9, 1, 1, 19.99),
(17, 9, 2, 1, 29.99),
(18, 10, 2, 1, 29.99),
(19, 12, 1, 2, 19.99),
(20, 12, 2, 2, 29.99),
(21, 12, 3, 1, 39.99),
(22, 13, 1, 1, 19.99),
(23, 13, 2, 1, 29.99),
(24, 13, 3, 1, 39.99),
(25, 14, 2, 1, 29.99),
(26, 14, 3, 1, 39.99),
(27, 15, 1, 2, 19.99),
(28, 16, 2, 2, 29.99),
(29, 17, 2, 1, 29.99),
(30, 18, 3, 1, 39.99),
(31, 19, 2, 1, 29.99),
(32, 20, 2, 2, 29.99),
(33, 21, 2, 2, 29.99),
(34, 22, 3, 1, 39.99),
(35, 23, 2, 1, 29.99),
(36, 23, 3, 1, 39.99),
(37, 24, 3, 1, 39.99),
(38, 25, 2, 1, 29.99),
(39, 25, 3, 1, 39.99),
(40, 26, 3, 1, 39.99),
(41, 26, 1, 1, 19.99),
(42, 26, 2, 1, 29.99),
(43, 27, 3, 1, 39.99),
(44, 27, 2, 1, 29.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `fecha_agregado`, `activo`) VALUES
(1, 'Producto 1', 'Descripción del producto 1', 19.99, 'producto1.jpg', '2024-11-12 19:01:19', 1),
(2, 'Producto 2', 'Descripción del producto 2', 29.99, 'producto2.jpg', '2024-11-12 19:01:19', 1),
(3, 'Producto 3', 'Descripción del producto 3', 39.99, 'producto3.jpg', '2024-11-12 19:01:19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `rol` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `fecha_registro`, `rol`) VALUES
(1, 'azdas', 'adadsaasd@ada', '$2y$10$KgUyaPoZQVIuzMKaIojUf.8FF/NL6wy9E1KXbfrVlAfw.nGznuzp2', '2024-11-12 22:17:06', 2),
(2, 'carlitos', 'pisculichi@sa', '$2y$10$680kudY3U368m5zxDjghjerPjZkjotZh3LzxiwHDsOOOO8BRRamgG', '2024-11-12 22:18:04', 2),
(3, 'dasa', 'qwdqw@asd', '$2y$10$WR2DRTGo0rWyMsV7Ozx5u.kUMKLpxwk44260JRie/LvhM/J3ab0Zm', '2024-11-12 22:38:04', 2),
(4, 'carlitos', 'carlitos@carlitos', '$2y$10$Fen/ZY9ZSHibefZixRNBGOhE2n/HD0wKgYMz54DC.ZvdOuvquSzx.', '2024-11-12 22:38:21', 2),
(5, 'agustin', 'agustin@agustin', '$2y$10$.uZhXjD4kiGdAGj/Uuek0uR9yzZcbRpbMH9tz9w47x/mL2MAp71qS', '2024-11-13 12:54:28', 2),
(6, 'ww', 'qwd@asd', '$2y$10$Iy1gpO.83khXaJ5MgpCuCu3zwOFiGNpNa3spNqjMuUFQ/ASNhoa5G', '2024-11-13 13:26:40', 2),
(7, 'pity', 'pp@pp', '$2y$10$odmj39q.Ge5pmSuLGva9aOrklgKc94owKIWibciykBCXFKNnMPmaW', '2024-11-13 13:32:04', 2),
(8, 'miguel', 'miguel@miguel', '$2y$10$59vVsKaEXnzNtGKLvXYtw.YLrnOvjVo.s6LyPWLQNOaY7fZ4.LjOu', '2024-11-13 13:42:34', 2),
(9, 'asa', 'as@s', '$2y$10$R0BOkbJZ7DztUNtDUhS3K.dOuv3fVMTJCqzVQN/WZfA6yZPYyLfkS', '2024-11-13 15:28:10', 2),
(10, 'ibaeltercerooooo', 'a@a', '$2y$10$kFFAboTNp5Ia1Wp5b2l//u9I8ij8HJtRUTwixl9YdXrNJtrCGXudy', '2024-11-13 19:02:18', 2),
(11, 'Admin', 'admin@a', 'aa', '2024-11-13 20:18:06', 1),
(12, 'piscu', 'piscu@p', '$2y$10$l5lJP5RcjXia6y.3yo0QVuUPdyiMzGBI4Le.yMsjRZor./bLSceb2', '2024-11-13 20:30:07', 2),
(13, 'antonio', 'a@o', '$2y$10$nIq0b/JHSme9kkcFd3FEX.OsLisnNE/8.VK2H84DRVRwq/37Xx4g6', '2024-11-13 20:35:22', 2),
(14, 'antonio', 'a@os', '$2y$10$56e.tMqPK0DhACy6QXZ9UOhP.jpYP.2lzJDB47q.cEobrXkiNjKo6', '2024-11-13 20:35:40', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD CONSTRAINT `pedido_detalles_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pedido_detalles_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
