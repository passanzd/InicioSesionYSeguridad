-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2025 a las 18:35:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cimpa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips_autorizadas`
--

CREATE TABLE `ips_autorizadas` (
  `ip` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ips_autorizadas`
--

INSERT INTO `ips_autorizadas` (`ip`) VALUES
('192.168.1.28'),
('192.168.45.33'),
('8.8.8.8'),
('81.45.23.10'),
('::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_intentos_ip`
--

CREATE TABLE `logs_intentos_ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `tipo_resultado` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logs_intentos_ip`
--

INSERT INTO `logs_intentos_ip` (`id`, `ip`, `fecha`, `tipo_resultado`, `usuario_id`) VALUES
(1, '::1', '2025-05-10 12:50:31', 1, 2),
(2, '192.168.1.28', '2025-05-10 12:58:10', 2, 2),
(3, '192.168.1.28', '2025-05-10 13:02:11', 1, 2),
(5, '192.168.45.33', '2025-05-10 13:21:33', 2, 2),
(6, '192.168.45.33', '2025-05-10 13:23:26', 1, 2),
(8, '8.8.8.8', '2025-05-10 13:38:14', 1, 2),
(9, '8.8.8.8', '2025-05-10 13:38:15', 4, 2),
(10, '81.45.23.10', '2025-05-10 13:44:28', 1, 2),
(270, '8.8.8.8', '2025-05-19 21:45:21', 1, 51),
(271, '8.8.8.8', '2025-05-19 21:45:21', 4, 51),
(272, '::1', '2025-05-19 21:57:34', 1, 2),
(273, '::1', '2025-05-20 16:48:51', 1, 2),
(274, '8.8.8.8', '2025-05-20 16:50:24', 1, 51),
(275, '8.8.8.8', '2025-05-20 16:50:24', 4, 51),
(276, '::1', '2025-05-20 16:51:47', 2, 51),
(277, '::1', '2025-05-20 16:55:19', 2, 51),
(278, '::1', '2025-05-20 16:55:52', 1, 51),
(279, '::1', '2025-05-20 16:55:52', 5, 51),
(280, '::1', '2025-05-20 16:55:57', 1, 51),
(281, '::1', '2025-05-20 16:55:57', 5, 51),
(282, '::1', '2025-05-20 16:56:01', 1, 51),
(283, '::1', '2025-05-20 16:56:01', 5, 51),
(284, '::1', '2025-05-20 17:08:23', 1, 51),
(287, '::1', '2025-05-20 17:12:33', 1, 2),
(290, '::1', '2025-05-20 17:14:46', 1, 2),
(292, '::1', '2025-05-21 23:18:00', 1, 48),
(293, '::1', '2025-05-21 23:18:00', 5, 48),
(296, '::1', '2025-05-21 23:32:20', 1, 2),
(297, '::1', '2025-05-21 23:56:33', 1, 51),
(298, '::1', '2025-05-21 23:56:33', 5, 51),
(299, '::1', '2025-05-21 23:59:14', 1, 51),
(300, '::1', '2025-05-21 23:59:14', 5, 51),
(301, '::1', '2025-05-22 00:00:25', 1, 51),
(302, '::1', '2025-05-24 21:32:09', 1, 51),
(304, '::1', '2025-05-24 21:34:43', 1, 2),
(305, '::1', '2025-05-25 00:03:33', 1, 51),
(306, '::1', '2025-05-25 00:03:33', 5, 51),
(307, '::1', '2025-05-25 00:03:36', 1, 51),
(308, '::1', '2025-05-25 00:03:36', 5, 51),
(309, '::1', '2025-05-25 00:03:40', 1, 51),
(310, '::1', '2025-05-25 00:03:40', 5, 51),
(311, '::1', '2025-05-25 00:20:40', 1, 51),
(312, '::1', '2025-05-25 09:46:56', 1, 51),
(313, '::1', '2025-05-25 09:51:13', 1, 2),
(315, '::1', '2025-05-25 23:06:45', 2, 51),
(316, '::1', '2025-05-25 23:07:08', 2, 51),
(317, '::1', '2025-05-25 23:07:54', 1, 51),
(318, '::1', '2025-05-25 23:07:54', 3, 51),
(319, '8.8.8.8', '2025-05-25 23:08:18', 1, 51),
(320, '8.8.8.8', '2025-05-25 23:08:18', 4, 51),
(321, '81.45.23.10', '2025-05-25 23:08:39', 1, 2),
(333, '::1', '2025-05-25 23:14:55', 1, 2),
(345, '::1', '2025-05-27 18:23:32', 1, NULL),
(346, '::1', '2025-05-27 18:25:27', 2, 51),
(347, '8.8.8.8', '2025-05-27 18:27:22', 1, 51),
(348, '8.8.8.8', '2025-05-27 18:27:22', 4, 51),
(349, '::1', '2025-05-27 18:28:00', 1, 2),
(350, '::1', '2025-05-27 18:29:23', 1, 51),
(351, '::1', '2025-05-27 18:29:23', 5, 51),
(352, '::1', '2025-05-27 18:29:40', 1, 2),
(353, '::1', '2025-05-27 18:29:41', 5, 2),
(354, '::1', '2025-05-27 18:29:47', 1, 2),
(355, '::1', '2025-05-27 18:30:22', 1, 51),
(357, '::1', '2025-05-27 18:32:32', 1, NULL),
(358, '::1', '2025-05-27 18:33:33', 1, 54),
(359, '::1', '2025-05-27 18:35:00', 1, 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_resultado`
--

CREATE TABLE `tipos_resultado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_resultado`
--

INSERT INTO `tipos_resultado` (`id`, `descripcion`) VALUES
(1, 'Acceso permitido'),
(2, 'IP no autorizada'),
(3, 'Error en geolocalización'),
(4, 'País no permitido'),
(5, 'Contraseña incorrecta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`ID`, `NOMBRE`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `CLAVE` varchar(100) DEFAULT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `APELLIDO` varchar(100) DEFAULT NULL,
  `MAIL` varchar(100) NOT NULL,
  `TELEFONO` int(11) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'Activado',
  `ID_TIPOUSUARIO` int(11) NOT NULL,
  `intentos_fallidos` int(11) DEFAULT 0,
  `bloqueo_hasta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `CLAVE`, `NOMBRE`, `APELLIDO`, `MAIL`, `TELEFONO`, `direccion`, `estado`, `ID_TIPOUSUARIO`, `intentos_fallidos`, `bloqueo_hasta`) VALUES
(2, '$2y$10$ozEOsCfJXcWbHJXdug3KkuqloZ/EZv38zT92jTrjmnv9PVPbIHPjq', 'Ana', 'Gómez', 'anacimpa01@gmail.com', 631975489, 'Calle Constitución 45, Sevilla', 'Activado', 2, 0, NULL),
(33, '$2y$10$02Qf3lqC16gvY/IA7u7WrOhtL9sZksuproGcx3ixXd8SmbnOXF.fK', 'Diego', 'Saenz', 'diegocimpa@ejemplo.com', 666888777, 'Calle Bernabeu, 10, Madrid', 'Bloqueado', 1, 4, '2025-05-18 20:11:42'),
(34, '$2y$10$p2bRzM5XyTu9bW9q9WWyN.OxSkCFp51w22UftBNhQAA9sqcZvXQDq', 'Laura', 'Segovia', 'lauracimpa@ejemplo.com', 667882146, 'Calle Wanda, 13, Madrid', 'Bloqueado', 1, 4, '2025-05-19 21:49:45'),
(35, '$2y$10$h8EGWZ4XrVeY5n3VrrXYkeHO4cF/O4Mv0qSYo9nKRyobBfv.eMo.i', 'Elena', 'Azul', 'elenacimpa@ejemplo.com', 638555444, 'Calle Rosa, 20, Barcelona', 'Activado', 1, 1, NULL),
(36, '$2y$10$2DtN8VxrUsE5vyfHfspBIOj6RUq49XsoJAYKYqUu3xNG7Tv6poS0.', 'Jaime', 'Bernaldo', 'jaimecimpa@ejemplo.com', 696444777, 'Calle Aguas, 11, Málaga', 'Activado', 1, 0, NULL),
(37, '$2y$10$3D7MjB814DK.C4fKzXy3k.t8GrNynygoBD13NYqCUkjvECRDVeL7K', 'Pepe', 'Hernando', 'pepecimpa@ejemplo.com', 687999333, 'Calle Amapola, 46, Sevilla', 'Bloqueado', 1, 0, NULL),
(38, '$2y$10$E10UfdI9Ea1h2/O7/KFYTOV0dBCeK0BgxrCp7E5e1ASg5cbqCf406', 'Luis', 'Rubio', 'luiscimpa@ejemplo.com', 691410505, 'Calle Luna, 25, Huelva', 'Bloqueado', 1, 0, NULL),
(39, '$2y$10$NqmAiyg69Y5shVEv.4urVeIyYpioGMVDG.pwbdzhX7251M49A41FK', 'Ignacio', 'Valles', 'ignaciocimpa@ejemplo.com', 618798152, 'Calle Arco, 54, Barcelona', 'Activado', 1, 0, NULL),
(40, '$2y$10$Op8f7IY5VXk27aZCld92y.H2xjBMI2E7B7MRSmreGEDPdhTOLkhim', 'Joe', 'Sebas', 'joecimpa@ejemplo.com', 689777111, 'Calle Principal, 86, Ávila', 'Activado', 1, 0, NULL),
(41, '$2y$10$QtWD1kvApShzqjskLxt0beI8WjFoIJ29lEw9uAMlVQS20DbKon5gW', 'Andrés', 'Torres', 'andrescimpa@ejemplo.com', 637896541, 'Calle Luz, 47, Madrid', 'Bloqueado', 1, 0, NULL),
(42, '$2y$10$6wL/ziKBLKSJ.S.KNm8/U.Kwl.ERFL3Cuwchv/Jy/P1z9rrOVjWAS', 'Hugo', 'Martín', 'hugocimpa@ejemplo.com', 697558441, 'Calle Gato, 21, Barcelona', 'Bloqueado', 1, 0, NULL),
(43, '$2y$10$SKSOY9FmaUZI2WroD9LSceExG5dqG8rnQhKtGztgFC011jzex9itu', 'Mario', 'Varela', 'mariocimpa@ejemplo.com', 689743123, 'Calle Lavanda, 63, Barcelona', 'Activado', 1, 0, NULL),
(44, '$2y$10$8GogPxDZ/MJvXwzm2zSI/u5Kh7rB9vxXD4G12dROEuibpPXi08gFi', 'María', 'Sanz', 'mariacimpa@ejemplo.com', 693123687, 'Calle Flor, 15, Madrid', 'Activado', 1, 0, NULL),
(48, '$2y$10$q0QXwBLw7lBeHgWl/YfwN.k2h8ICR.nPQejWQMmVpldRuKcSaDcfa', 'Mario', 'Prueba', 'mario@cimpa.com', 666222848, 'Calle Mayor, 10, Madrid', 'Bloqueado', 1, 1, NULL),
(49, '$2y$10$8lDUPLCrItQZSTWzUeeD/ePS5OajgPZ4igo5npT6WQP6eWd7wBnY2', 'Luis', 'Mar', 'luis@cimpa.com', 666222848, 'Calle Bernabeu, 10, Madrid', 'Activado', 1, 3, '2025-05-19 20:14:23'),
(51, '$2y$10$JE/SFEY2KX/u1q40FvOvdO8dZr8EKg368YefEL9duoE.8d8AS5466', 'Juan', 'Sanz', 'juancimpauser@gmail.com', 666525111, 'Calle Mayor 123, Alicante', 'Activado', 1, 0, NULL),
(54, '$2y$10$W5D26iViXCYTEaHRNI3sFOy7mj46NPyddaUhx7/PN1z86nIHmHa2.', 'David', 'Sanz', 'davsapas@gmail.com', 666222848, 'Calle Sol, 10, Madrid', 'Activado', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_admin`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_admin` (
`ID_USUARIO` int(11)
,`NOMBRE` varchar(100)
,`APELLIDO` varchar(100)
,`MAIL` varchar(100)
,`CLAVE` varchar(100)
,`ID_TIPOUSUARIO` int(11)
,`TIPO_USUARIO_NOMBRE` varchar(100)
,`TELEFONO` int(11)
,`direccion` varchar(255)
,`estado` varchar(50)
,`intentos_fallidos` int(11)
,`bloqueo_hasta` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_logs_detallada`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_logs_detallada` (
`id` int(11)
,`ip` varchar(45)
,`fecha` datetime
,`resultado` varchar(100)
,`NOMBRE` varchar(100)
,`APELLIDO` varchar(100)
,`MAIL` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuarios` (
`ID_USUARIO` int(11)
,`NOMBRE` varchar(100)
,`APELLIDO` varchar(100)
,`MAIL` varchar(100)
,`CLAVE` varchar(100)
,`TIPO_USUARIO` varchar(100)
,`TELEFONO` int(11)
,`direccion` varchar(255)
,`estado` varchar(50)
,`intentos_fallidos` int(11)
,`bloqueo_hasta` datetime
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_admin`
--
DROP TABLE IF EXISTS `vista_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_admin`  AS SELECT `u`.`ID_USUARIO` AS `ID_USUARIO`, `u`.`NOMBRE` AS `NOMBRE`, `u`.`APELLIDO` AS `APELLIDO`, `u`.`MAIL` AS `MAIL`, `u`.`CLAVE` AS `CLAVE`, `u`.`ID_TIPOUSUARIO` AS `ID_TIPOUSUARIO`, `tu`.`NOMBRE` AS `TIPO_USUARIO_NOMBRE`, `u`.`TELEFONO` AS `TELEFONO`, `u`.`direccion` AS `direccion`, `u`.`estado` AS `estado`, `u`.`intentos_fallidos` AS `intentos_fallidos`, `u`.`bloqueo_hasta` AS `bloqueo_hasta` FROM (`usuarios` `u` left join `tipousuario` `tu` on(`u`.`ID_TIPOUSUARIO` = `tu`.`ID`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_logs_detallada`
--
DROP TABLE IF EXISTS `vista_logs_detallada`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_logs_detallada`  AS SELECT `l`.`id` AS `id`, `l`.`ip` AS `ip`, `l`.`fecha` AS `fecha`, `tr`.`descripcion` AS `resultado`, `u`.`NOMBRE` AS `NOMBRE`, `u`.`APELLIDO` AS `APELLIDO`, `u`.`MAIL` AS `MAIL` FROM ((`logs_intentos_ip` `l` join `tipos_resultado` `tr` on(`l`.`tipo_resultado` = `tr`.`id`)) join `usuarios` `u` on(`l`.`usuario_id` = `u`.`ID_USUARIO`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuarios`
--
DROP TABLE IF EXISTS `vista_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuarios`  AS SELECT `u`.`ID_USUARIO` AS `ID_USUARIO`, `u`.`NOMBRE` AS `NOMBRE`, `u`.`APELLIDO` AS `APELLIDO`, `u`.`MAIL` AS `MAIL`, `u`.`CLAVE` AS `CLAVE`, `t`.`NOMBRE` AS `TIPO_USUARIO`, `u`.`TELEFONO` AS `TELEFONO`, `u`.`direccion` AS `direccion`, `u`.`estado` AS `estado`, `u`.`intentos_fallidos` AS `intentos_fallidos`, `u`.`bloqueo_hasta` AS `bloqueo_hasta` FROM (`usuarios` `u` left join `tipousuario` `t` on(`u`.`ID_TIPOUSUARIO` = `t`.`ID`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ips_autorizadas`
--
ALTER TABLE `ips_autorizadas`
  ADD PRIMARY KEY (`ip`);

--
-- Indices de la tabla `logs_intentos_ip`
--
ALTER TABLE `logs_intentos_ip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `fk_tipo_resultado` (`tipo_resultado`);

--
-- Indices de la tabla `tipos_resultado`
--
ALTER TABLE `tipos_resultado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `ID_TIPOUSUARIO` (`ID_TIPOUSUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logs_intentos_ip`
--
ALTER TABLE `logs_intentos_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `logs_intentos_ip`
--
ALTER TABLE `logs_intentos_ip`
  ADD CONSTRAINT `fk_tipo_resultado` FOREIGN KEY (`tipo_resultado`) REFERENCES `tipos_resultado` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `logs_intentos_ip_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`ID_TIPOUSUARIO`) REFERENCES `tipousuario` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
