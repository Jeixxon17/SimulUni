-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2024 a las 13:54:42
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
-- Base de datos: `db_simuluni`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulaciones`
--

CREATE TABLE `simulaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `monto_prestamo` int(11) DEFAULT NULL,
  `tasa_interes_anual` int(11) DEFAULT NULL,
  `plazo_meses` int(11) DEFAULT NULL,
  `frecuencia_pago` varchar(50) DEFAULT NULL,
  `total_intereses` int(11) DEFAULT NULL,
  `abono_capital` int(11) DEFAULT NULL,
  `pago_mensual` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_credito_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `simulaciones`
--

INSERT INTO `simulaciones` (`id`, `id_usuario`, `monto_prestamo`, `tasa_interes_anual`, `plazo_meses`, `frecuencia_pago`, `total_intereses`, `abono_capital`, `pago_mensual`, `fecha_creacion`, `tipo_credito_id`) VALUES
(1, 1, 1000000, 1, 12, 'Mensual', 0, 1500, 83594, '2024-04-18 15:19:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_credito`
--

CREATE TABLE `tipo_credito` (
  `id_tipoCredito` int(11) NOT NULL,
  `nombreCredito` varchar(50) NOT NULL,
  `estadoCredito` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_credito`
--

INSERT INTO `tipo_credito` (`id_tipoCredito`, `nombreCredito`, `estadoCredito`) VALUES
(1, 'Credito Personal', 1),
(2, 'Credito Hipotecario', 1),
(3, 'Credito Automotriz', 1);

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
(2, 'Jeison Andres', 'yeisonaml1117@gmail.com', '$2y$10$mPDOlHw65hJ6EZ.Xe8Nznu1zV2ftWZsT5jRig7gjHnCn.tmwKTdv6', '2024-02-28 20:36:11', '2024-02-28 20:36:11'),
(3, 'Jeison Martinez', 'yeisonaml2611@gmail.com', '$2y$10$Lpr5QBpHxeU8z/9WYbERKOwvkp/u8ID3CDxiLOJFzRQXGKTvFBb0K', '2024-04-11 12:05:43', '2024-04-11 12:05:43'),
(4, 'Jeison Martinez', 'camila.correa@gmail.com', '$2y$10$xNh8D/ygK5mhWPI2RVWkoe6zlk3zR6JoCxNoqK/5Oa08lGvgM9V6a', '2024-04-18 12:08:12', '2024-04-18 12:08:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `fk_simulaciones_tipo_credito` (`tipo_credito_id`);

--
-- Indices de la tabla `tipo_credito`
--
ALTER TABLE `tipo_credito`
  ADD PRIMARY KEY (`id_tipoCredito`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_credito`
--
ALTER TABLE `tipo_credito`
  MODIFY `id_tipoCredito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  ADD CONSTRAINT `fk_simulaciones_tipo_credito` FOREIGN KEY (`tipo_credito_id`) REFERENCES `tipo_credito` (`id_tipoCredito`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `simulaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
