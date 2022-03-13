-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-03-2022 a las 20:46:00
-- Versión del servidor: 8.0.28-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de datos: `freedomride`
--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `ride_availability`
--
CREATE TABLE `ride_availability` (
  `id` int NOT NULL,
  `ride_id` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ride_availability`
--
INSERT INTO
  `ride_availability` (`id`, `ride_id`, `date`, `time`)
VALUES
  (1, 1, '2022-03-24', '17:00:00'),
  (2, 1, '2022-03-25', '12:00:00'),
  (3, 2, '2022-03-18', '10:00:00'),
  (4, 2, '2022-03-19', '10:30:00'),
  (5, 3, '2022-03-26', '10:00:00'),
  (6, 3, '2022-03-27', '12:00:00'),
  (7, 4, '2022-03-19', '10:00:00'),
  (8, 4, '2022-03-20', '11:30:00'),
  (9, 5, '2022-03-24', '10:30:00'),
  (10, 5, '2022-03-28', '17:00:00'),
  (11, 6, '2022-03-30', '12:00:00'),
  (12, 6, '2022-03-31', '09:00:00'),
  (13, 7, '2022-03-27', '12:00:00'),
  (14, 7, '2022-03-26', '10:00:00'),
  (15, 8, '2022-03-18', '12:00:00'),
  (16, 8, '2022-03-19', '10:00:00'),
  (17, 9, '2022-03-18', '12:00:00'),
  (18, 9, '2022-03-19', '11:00:00'),
  (19, 10, '2022-03-18', '11:00:00'),
  (20, 10, '2022-03-19', '12:00:00'),
  (21, 11, '2022-03-26', '11:00:00'),
  (22, 11, '2022-03-27', '11:00:00'),
  (23, 12, '2022-03-19', '10:00:00'),
  (24, 12, '2022-03-20', '11:00:00'),
  (25, 13, '2022-03-26', '11:00:00'),
  (26, 13, '2022-03-27', '11:30:00'),
  (27, 14, '2022-03-26', '11:00:00'),
  (28, 14, '2022-03-27', '11:30:00');

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `ride_availability`
--
ALTER TABLE
  `ride_availability`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `IDX_37F96B00302A8A70` (`ride_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `ride_availability`
--
ALTER TABLE
  `ride_availability`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 29;

--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `ride_availability`
--
ALTER TABLE
  `ride_availability`
ADD
  CONSTRAINT `FK_37F96B00302A8A70` FOREIGN KEY (`ride_id`) REFERENCES `ride` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;