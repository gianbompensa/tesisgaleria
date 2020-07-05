-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2020 a las 00:41:22
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gallery`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion_categoria` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `img_categoria` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `img_categoria`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'decoraciones', 'aqui encontraras las mejores decoraciones del mundo entero, para tu hogar, para tu oficia y mucho mas', 'pagcorsetti_ROLLERS-10.jpg', '2020-06-15 09:30:25', '2020-06-15 09:30:25', '2020-06-15 09:30:25'),
(2, 'paisajes', 'los mejores paisajes los encontraras en esta sección, imágenes para descargar y compartir  ', 'achieve-2203653_1920.jpg', '2020-06-15 09:40:54', '2020-06-15 09:40:54', '2020-06-15 09:40:54'),
(3, 'animales', 'las especies en peligro de extincion, que deben ser salvadas, para la preservacion del planeta tierra entero', 'iceland-1979445_1920.jpg', '2020-06-28 16:15:33', '2020-06-28 16:15:33', '2020-06-28 16:15:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id_favorito` int(11) NOT NULL,
  `post_favorito` int(11) NOT NULL,
  `usuario_favorito` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `img_post` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre_post` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `categoria` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nombre_user` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido_user` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rol` char(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `delete_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_users`, `nombre_user`, `apellido_user`, `email`, `pass`, `avatar`, `rol`, `create_at`, `update_at`, `delete_at`) VALUES
(4, 'admin', '', 'admin@gmail.com', 'admin123', 'noimg', 'a', '2020-06-15 08:36:49', '2020-06-15 08:36:49', '2020-06-15 08:36:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favorito`),
  ADD KEY `post_favorito` (`post_favorito`),
  ADD KEY `usuario_favorito` (`usuario_favorito`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`post_favorito`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`usuario_favorito`) REFERENCES `users` (`id_users`);

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
