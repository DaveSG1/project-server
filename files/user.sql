-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-03-2022 a las 20:46:14
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
-- Estructura de tabla para la tabla `user`
--
CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--
INSERT INTO
  `user` (`id`, `email`, `active`, `roles`, `password`)
VALUES
  (
    1,
    'cudillero.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2y$13$ho0bBRqIk82xpW3mYUWFIe16I4dXGOo4RZ2gZQdl/AB5Sd.NZsTVa'
  ),
  (
    2,
    'castrillon.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    3,
    'potes.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    4,
    'montesmalaga.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    5,
    'donana.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    6,
    'zahora.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    7,
    'jerte.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2y$13$mvzGUz/WsF2Dx93GmJLIfOd4TEuZ0.NbM/vgcZ0TWTAkwgVcmZdNS'
  ),
  (
    8,
    'montserrat.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    9,
    'vielha.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2y$13$z0BC4WLIgJtu8YYebzzKIuRJmiwmYN34KwHzGK7Y9BV4QNSBrUFXS'
  ),
  (
    10,
    'rascafria.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    11,
    'haro.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    12,
    'orotava.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    13,
    'soller.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    14,
    'ferreries.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2a$12$Dz.a/sfTFnRDfUrHStWvpeRkPjjU8gSVQfbfqibq5.5Bp5fsDy/le'
  ),
  (
    17,
    'prueba.rutas@gmail.com',
    1,
    '[\"ROLE_USER\"]',
    '$2y$13$Y3eJRJSJ6Mb1ZhogIxC5O.zkdKGJ949FeLozvBQjJ1cOjQwV520m2'
  );

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `user`
--
ALTER TABLE
  `user`
ADD
  PRIMARY KEY (`id`),
ADD
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE
  `user`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 24;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;