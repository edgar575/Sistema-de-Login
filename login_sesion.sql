-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 12-11-2025 a las 19:11:25
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
-- Base de datos: `login_sesion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `usuario`, `clave`, `fecha_registro`) VALUES
(1, 'edgar', 'veliz', 'edgargilmar1@gmail.com', 'Edgar', '$2y$10$OoHoaY/awlrV8gsUGRjw5.1xfNaepypCQWOaowdh54gD3z/vNoUqq', '2025-11-11 17:16:48'),
(2, 'Aldana', 'Espinoza', 'Aldana@gmail.com', 'Aldana.3025', '$2y$10$2GNk5SWtnw/WtdiKMsHoC.7Npt9nttjSxhK9wjbWcEGi27.MwYR0O', '2025-11-11 17:20:52'),
(3, 'Jaime', 'Salazar', 'JaimeS@gmail.com', 'Jaime25', '$2y$10$w9G30Jf0F.2U8hCmsiUt.erPy6CJCtYDqaP22MwLj322KsgBw.Na.', '2025-11-11 17:30:51'),
(4, 'Domenica', 'veliz', 'DomeVeliz1@gmail.com', 'dome25', '$2y$10$fVvelJEHE4fAEkv4mxDX0u.6QHc1pbJs6TtCcuzIHlxiIm.tvqds.', '2025-11-11 18:06:45'),
(5, 'Abel', 'veliz', 'Abej@gmail.com', 'Abel50', '$2y$10$Fk3kbSziiizK/RgtOXQrSOJFqEtocNY7nWF4dwKBLy9qKmOIEN7wW', '2025-11-11 18:08:57'),
(6, 'Socorro', 'veliz', 'socorrov@gmail.com', 'socorro60', '$2y$10$FvOnZMalfxj/SVnOOw8/x.26aoLSbDdccHrCy1ebfwkvLc3QC5XVG', '2025-11-12 01:12:17'),
(7, 'Margoth', 'Salazar', 'Margoth1@gmail.com', 'Margoth11', '$2y$10$QmybeqqS8f4eYQ8mq4iZjeqos9MVcuZ/V7ZqzGFYW5bNF2x3AasfS', '2025-11-12 14:12:58'),
(8, 'Dianna', 'Torres', 'DiannaT@gmail.com', 'Dianna35', '$2y$10$oEdmAvylEP2E0yGBp6DDMO/5ckAhaKJu9dDODL5tFjBCFctriHdy6', '2025-11-12 16:17:21'),
(9, 'Maria', 'Castro', 'MariaC@gmail.com', 'Maria19', '$2y$10$XF25bdNezvaQ3eZHA.vye.nRhQJZzGeMc7HxzQgoxIrBWkczEbRNu', '2025-11-12 16:55:02'),
(10, 'David', 'Veliz', 'DavidV@gmail.com', 'David10', '$2y$10$52oU5Nl1YTP.u0L9vMA8HOtCsnUEdlQI2M7fTMCSFosLxevlNrSQK', '2025-11-12 17:19:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
