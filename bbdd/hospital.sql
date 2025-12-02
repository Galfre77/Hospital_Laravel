-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2024 a las 12:34:51
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
-- Base de datos: `hospital`
--
CREATE DATABASE IF NOT EXISTS `hospital` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hospital`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('9e6a55b6b4563e652a23be9d623ca5055c356940', 'i:1;', 1733655991),
('9e6a55b6b4563e652a23be9d623ca5055c356940:timer', 'i:1733655991;', 1733655991);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_paciente`
--

DROP TABLE IF EXISTS `log_paciente`;
CREATE TABLE `log_paciente` (
  `idlogpaciente` int(11) NOT NULL,
  `accion` char(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `idpaciente` int(11) NOT NULL,
  `nif` char(9) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `fechaingreso` date NOT NULL,
  `fechaalta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `log_paciente`
--

INSERT INTO `log_paciente` (`idlogpaciente`, `accion`, `timestamp`, `idpaciente`, `nif`, `nombre`, `apellidos`, `fechaingreso`, `fechaalta`) VALUES
(1, 'D', '2024-11-26 17:21:00', 258, '22200002B', 'Beatrix', 'Kiddo', '2023-05-01', '2023-09-05'),
(2, 'U', '2024-11-26 21:40:11', 257, '10000000A', 'Frank\'s', 'Pentangelli', '2023-05-04', '2023-07-27'),
(3, 'D', '2024-11-26 21:40:45', 276, '10003871B', 'Johnny', 'Mentero', '2023-01-30', NULL),
(4, 'I', '2024-11-26 21:41:42', 368, '20000002F', 'Petra', 'Pedrusco', '2024-11-04', NULL),
(5, 'U', '2024-12-08 11:23:06', 257, '10000000A', 'Frank', 'Pentangelli', '2023-05-04', '2023-07-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL,
  `nif` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `apellidos` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fechaingreso` date NOT NULL,
  `fechaalta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpaciente`, `nif`, `nombre`, `apellidos`, `fechaingreso`, `fechaalta`) VALUES
(256, '10000001B', 'Connie', 'Corleone', '2023-05-01', NULL),
(257, '10000000A', 'Frank', 'Pentangelli', '2023-05-04', '2023-07-26'),
(260, '10000044T', 'Freddy', 'Kruegger', '2023-05-01', NULL),
(262, '10001101B', 'Vincent', 'Vega', '2023-05-01', NULL),
(264, '10033000A', 'Vernita', 'Green', '2023-03-07', NULL),
(266, '10000333C', 'Lilith', 'Lafayette', '2023-03-01', NULL),
(267, '10055500A', 'Pierre', 'Delacroix', '2023-01-31', NULL),
(268, '10999002C', 'Josep Lluis', 'Torrent', '2023-03-01', NULL),
(269, '45600002B', 'Django', 'Freeman', '2023-04-06', '2023-07-27'),
(270, '10001230A', 'Marcellus', 'Wallace', '2023-01-30', NULL),
(271, '98700001A', 'Jessy', 'Pikman', '2023-05-03', NULL),
(275, '55544001A', 'Nikita', 'Nipone', '2023-02-27', NULL),
(277, '10000923B', 'O-Ren', 'Ishii', '2023-03-02', NULL),
(368, '20000002F', 'Petra', 'Pedrusco', '2024-11-04', NULL);

--
-- Disparadores `paciente`
--
DROP TRIGGER IF EXISTS `deletepaciente`;
DELIMITER $$
CREATE TRIGGER `deletepaciente` BEFORE DELETE ON `paciente` FOR EACH ROW INSERT INTO log_paciente VALUES (NULL, 'D', CURRENT_TIMESTAMP, OLD.idpaciente, OLD.nif, OLD.nombre, OLD.apellidos, OLD.fechaingreso, OLD.fechaalta)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `insertpaciente`;
DELIMITER $$
CREATE TRIGGER `insertpaciente` AFTER INSERT ON `paciente` FOR EACH ROW INSERT INTO log_paciente VALUES (NULL, 'I', CURRENT_TIMESTAMP, NEW.idpaciente, NEW.nif, NEW.nombre, NEW.apellidos, NEW.fechaingreso, NEW.fechaalta)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `updatepaciente`;
DELIMITER $$
CREATE TRIGGER `updatepaciente` BEFORE UPDATE ON `paciente` FOR EACH ROW INSERT INTO log_paciente VALUES (NULL, 'U', CURRENT_TIMESTAMP, OLD.idpaciente, OLD.nif, OLD.nombre, OLD.apellidos, OLD.fechaingreso, OLD.fechaalta)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nif` char(9) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(80) NOT NULL,
  `foto` varchar(80) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nif`, `nombre`, `apellidos`, `password`, `email`, `foto`, `remember_token`, `email_verified_at`, `is_admin`) VALUES
(4, '10000001B', 'Sayaka', 'Yumi', '$2y$12$Y3CKiqWyjIdiDogoayI6me2GUrIHn2buAsvO6fiZPDny1O4zVI2UG', 'sayaka@mail.com', 'sayaka_yumi.jpg', 'dI33tBbXbwP2nIfXNtlKSquAna9O8Ut9g8KJwCJKNtLiCtyzfISEoTQeFQcz', NULL, 1),
(6, '00000002B', 'Boss', 'Magnolian', '$2y$12$BO3Td/j7QR/O/NVEc6LWC.PTDY8T1S3VEcwHlwNpVlfLq.MxkL036', 'boss@mail.com', 'boss.jpg', NULL, NULL, NULL),
(7, '10000000A', 'Koji', 'Kabuto', '$2y$12$p2SoE8EEm.0p/8IVR3e7p.xQ9BtrLe9IUmur3yZxbnarLChn.e16m', 'koji@mail.com', 'koji_kabuto.jpg', NULL, NULL, 1),
(9, '10000333A', 'Doctor', 'Hell', '$2y$12$PwQ1vR3xIeshcn8U28VEpeWDtzfOZaHvCyt5tyFvphVe0IARxBAU.', 'hell@mail.com', '673b77d742fbe_doctor_hell.jpg', NULL, NULL, NULL),
(10, '11000001A', 'Conde', 'Broken', '$2y$12$NOkQ0fg5WylG/dkcAny7tOGabu36S5/QnWNOomacS4W.3SnxUkbou', 'broken@mail.com', '674608d857388_conde_broken.jpg', NULL, NULL, NULL),
(11, '11000002B', 'Baron', 'Ashler', '$2y$12$biNYKIhr38ln4HEMtXy.m.Sd0f8Vfsn0A0qga2CL0dmsq5UzC6ebu', 'ashler@mail.com', '6746415423745_baron_ashler.jpg', NULL, NULL, 1),
(12, '19900000A', 'Profesor', 'Yumi', '$2y$12$7SdQOtv0eY0RYdYBOAtWu./9S.WpikHqmInOEYLbFjv8u6s/T81tS', 'yumi@mail.com', '67475c34489a4_profesor_yumi.jpg', NULL, NULL, NULL),
(13, '12200002C', 'Duque', 'Gorgon', '$2y$12$GaxcfIlXvnMJXtQCzEplIu0lWYC2XbeoOPtK/lZpfmOm/tHZyNsYe', 'gorgon@mail.com', 'sinfoto.jpg', NULL, NULL, NULL),
(15, '20000098J', 'Connie', 'Corleone', '$2y$12$Av0VmvPwsjZcIu8o3F2iY.CtoaadHhA2f9aHmY84ofURKtk4U2Cpa', 'connie@mail.com', 'sinfoto.jpg', NULL, NULL, NULL),
(16, '13330002C', 'Arch', 'Stanton', '$2y$12$/DltyaxsQVRFdh83BhM2fevbrdPRG.BTGvBt56L3rQxWn81NjoaLu', 'arch@mail.com', 'sinfoto.jpg', NULL, NULL, NULL),
(18, '16660002C', 'Django', 'Freeman', '$2y$12$oTWS5VVGEJkB3X.MJsr60uU1E3hzsINuGEyQY9LutzUhtukGctY6W', 'django@mail.com', 'sinfoto.jpg', NULL, NULL, NULL),
(20, '10033001B', 'O-Ren', 'Ishii', '$2y$12$F16FFHUE3GRq.uINggHVH.1/hCh3oliL.EiTiOY1ayYqJLncaHMZa', 'oren@mail.com', 'sinfoto.jpg', NULL, '2024-12-08 10:21:24', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `log_paciente`
--
ALTER TABLE `log_paciente`
  ADD PRIMARY KEY (`idlogpaciente`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`),
  ADD UNIQUE KEY `nif_UNIQUE` (`nif`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `nif` (`nif`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `log_paciente`
--
ALTER TABLE `log_paciente`
  MODIFY `idlogpaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
