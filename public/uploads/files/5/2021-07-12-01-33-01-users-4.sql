-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2021 a las 20:25:18
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registros`
--

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `parent_id`, `role`, `name`, `lastname`, `avatar`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 'Dennis', 'Ormeño', 'avatar.jpg', 'dennis.orm@hotmail.com', NULL, '$2y$10$pAKnfBw9tp8.gyVWu7OVLuCY1hOhA28cJDLjmHF90sjmiudwz/6r2', 'M1O0irkpnI1yg8STivUpoEbKNezy5va7py1unPTGhpUArX64UQ9pGELYVYLn', NULL, '2021-07-09 05:32:00'),
(3, NULL, 2, 'Raflis', 'Trimen', 'avatar.jpg', 'raflisd@gmail.com', NULL, '$2y$10$bsfD.P26CrfsjAPJEsRh0OXszjEz2DST4XEwB6e1gvZzklRPE6e0W', 'JrQs34QvyXWTCzdgn3v1wpyC7p3ZtGJyCUrbVHKnBEUOh4qZ1Ky2Vu3DXAve', '2021-07-09 19:43:08', '2021-07-09 19:43:08'),
(4, NULL, 1, 'Raflis', 'Trimen', 'avatar.jpg', 'dormeno@solera.pe', NULL, '$2y$10$KpWrcH11fmDftoUxuz9M6.yIOzlrsMApwRn/fRB1pynM/5UhUHFS2', NULL, '2021-07-09 19:44:25', '2021-07-09 19:44:25'),
(5, NULL, 2, 'Trimen', 'Info', 'avatar.jpg', 'trimen.info@gmail.com', NULL, '$2y$10$8Rxs0QGaRdRG0P4k6slGg.H4FL8NE285rd6n6g63imM3gWry/mcua', NULL, '2021-07-09 19:48:11', '2021-07-09 19:48:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
