-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-02-2024 a las 13:00:06
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
-- Base de datos: `db_simuluni`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulaciones`
--

CREATE TABLE `simulaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `monto_prestamo` decimal(10,2) DEFAULT NULL,
  `tasa_interes_anual` decimal(5,2) DEFAULT NULL,
  `plazo_meses` int(11) DEFAULT NULL,
  `frecuencia_pago` varchar(50) DEFAULT NULL,
  `total_intereses` decimal(10,2) DEFAULT NULL,
  `abono_capital` decimal(10,2) DEFAULT NULL,
  `pago_mensual` decimal(10,2) DEFAULT NULL,
  `tipo_credito` varchar(50) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contrasena`, `creado_en`, `actualizado_en`) VALUES
(1, 'Jeison Andres', 'yeisonaml1117@gmail.com', '$2y$10$xYmGxhiYQPDdZMSRzGle7.KbG7YuU3Hk94l1vDfgml93yS3/rUgva', '2024-02-28 20:25:37', '2024-02-28 20:25:37'),
(2, 'Jeison Andres', 'yeisonaml1117@gmail.com', '$2y$10$mPDOlHw65hJ6EZ.Xe8Nznu1zV2ftWZsT5jRig7gjHnCn.tmwKTdv6', '2024-02-28 20:36:11', '2024-02-28 20:36:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  ADD CONSTRAINT `simulaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
