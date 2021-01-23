-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: shareddb-o.hosting.stackcp.net
-- Tiempo de generación: 23-01-2021 a las 04:06:03
-- Versión del servidor: 10.2.33-MariaDB-log
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `modapp-3130391e4c`
--
CREATE DATABASE IF NOT EXISTS `modapp-3130391e4c` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `modapp-3130391e4c`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `address`
--

CREATE TABLE `address` (
  `id_address` int(11) NOT NULL,
  `state` varchar(30) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `street` varchar(40) NOT NULL,
  `number_st` varchar(50) DEFAULT NULL,
  `number_int` varchar(50) DEFAULT NULL,
  `cp` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `id_user` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `store` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `address`
--

INSERT INTO `address` (`id_address`, `state`, `municipio`, `street`, `number_st`, `number_int`, `cp`, `status`, `id_user`, `id_client`, `store`) VALUES
(9, 'Mexico', 'Neza', '30', 'NULL', 'NULL', '06090', 1, NULL, NULL, NULL),
(12, 'Mexico', 'Neza', '29', '38', NULL, '57210', 1, 1, NULL, NULL),
(20, 'MTY', 'MTY', 'SUR 234534', '386', '3', '58392', 1, NULL, 5, NULL),
(21, 'TJ', 'TJ', 'SUR 234534', '1000', 'A 17', '58392', 1, NULL, NULL, 4),
(22, 'México', 'ecatepec', '33', '12', '7', '55057', 1, 1, NULL, NULL),
(23, 'México', 'ecatepec', '33', '12', '7', '55057', 1, 1, NULL, NULL),
(24, 'México', 'ecatepec', '33', '12', '7', '55057', 1, 1, NULL, NULL),
(25, 'México', 'ecatepec', '33', '12', NULL, '55057', 1, 1, NULL, NULL),
(26, 'México', 'ecatepec', 'revolución', '12', '7', '55057', 1, 1, NULL, NULL),
(27, 'México', 'ecatepec', 'revolución', '12', '7', '55057', 1, 6, NULL, NULL),
(38, 'México', 'ecatepec', 'revolución', '12', '7', '55057', 1, 8, NULL, NULL),
(40, 'México', 'ecatepec', 'revolución', '123', '2342', '55100', 1, 10, NULL, NULL),
(149, 'qwq', 'qw', 'sasa', '658', 'sasa', '1231', 1, 13, NULL, NULL),
(152, 'jshss', 'jdjdjd', 'bdjdjd', '6464', 'jdjdjd', '455', 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencies`
--

CREATE TABLE `agencies` (
  `id_agency` int(11) NOT NULL,
  `name` char(75) COLLATE utf8_spanish_ci NOT NULL,
  `image` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `contrataciones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `agencies`
--

INSERT INTO `agencies` (`id_agency`, `name`, `image`, `contrataciones`, `rating`) VALUES
(1, 'Your dreams', 'http://localhost/longbit/imagesAgencies/agencie.png', '3', '3.9'),
(2, 'Chic Look', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(3, 'Chic Look 2', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(4, 'Chic Look 3', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(5, 'Your dreams 4', 'http://localhost/longbit/imagesAgencies/agencie.png', '3', '3.9'),
(6, 'Chic Look 5', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(7, 'Chic Look  6', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(8, 'Chic Look 7', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(9, 'Chic Look 8', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(10, 'Chic Look 9', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(11, 'Your dreams 10', 'http://localhost/longbit/imagesAgencies/agencie.png', '3', '3.9'),
(12, 'Chic Look 11', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(13, 'Chic Look  12', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6'),
(14, 'Chic Look 13', 'http://localhost/longbit/imagesAgencies/agencie.png', '8', '4.6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `article_features`
--

CREATE TABLE `article_features` (
  `id_articleType` int(11) NOT NULL,
  `id_feature` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `article_type`
--

CREATE TABLE `article_type` (
  `id_articleType` int(11) NOT NULL,
  `typeName` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `article_type`
--

INSERT INTO `article_type` (`id_articleType`, `typeName`) VALUES
(1, 'Ejemplo articleType');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `body`
--

CREATE TABLE `body` (
  `id_body` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `body`
--

INSERT INTO `body` (`id_body`, `name`) VALUES
(1, 'Ejemplo body');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `categoryName` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id_category`, `categoryName`) VALUES
(1, 'ejemplo category');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `company_name` varchar(70) DEFAULT NULL,
  `mail` varchar(40) NOT NULL,
  `tel` double DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `name_contact` varchar(70) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `maps` text DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `noti_flash` int(2) DEFAULT NULL,
  `noti_normal` int(2) DEFAULT NULL,
  `noti_push` int(2) DEFAULT NULL,
  `client_since_date` date DEFAULT NULL,
  `init_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `password` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `company_mail` varchar(40) DEFAULT NULL,
  `company_tel` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id_client`, `company_name`, `mail`, `tel`, `rfc`, `name_contact`, `product`, `description`, `image`, `maps`, `puntos`, `noti_flash`, `noti_normal`, `noti_push`, `client_since_date`, `init_date`, `end_date`, `password`, `status`, `company_mail`, `company_tel`) VALUES
(1, 'omar', 'juanomcam@gmail.com', NULL, NULL, 'name_contact', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$IzIAXRdHySvZDYf/aYcGE.Rjocm0VFuY/0W2oSohQGT.Z2Al.i5vm', 1, NULL, NULL),
(2, 'longbit', 'longbit@longbit.com', 5529282048, NULL, 'Pruebaaaaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$SnwJG12nxrRc5Ml0KTI8zuRjslzf8lhzM9.hM.IQSSdjVVFrJv4JS', 2, NULL, NULL),
(3, 'Longbit', 'longbit2@longbit.com', 5529282195, 'cagj960308hd5', 'Pruebaaaaa', NULL, 'Empresa de tecnología', 'www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ggYr1Ns1ym8rq11LhaOzfOpbbP46a1ytchlM.USUWT9s40Xop85He', 1, 'longbit@gmail.com', 5534080960),
(5, 'Longbit', 'omaar@gmail.com', 5534081024, 'cagj960308hd5', 'Yo', NULL, 'Empresa de tecnología', 'www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QMVonlnTTO5GYEZqfpKpPO0JIzM6PfFKb5pEcilmFsc07EDIGF9DK', 1, 'longbit@gmail.com', 5534080960),
(6, NULL, 'pruebaomar@gmail.com', 5534081024, NULL, 'Yo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QMVonlnTTO5GYEZqfpKpPO0JIzM6PfFKb5pEcilmFsc07EDIGF9DK', 1, NULL, NULL),
(8, 'longbit', 'longbit@yopmail.com', NULL, NULL, 'longbit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$V5Cslt/Bg29YhZcx8hutmeDwX8GEf2mPQ07Cx8Oy6WsMWytPZPBYm', 1, NULL, NULL),
(9, 'longbit', 'longbit2@yopmail.com', NULL, NULL, 'longbit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$.ymxxpeLxMmv/RLLtsGzresr6ivcx2oJ/s1ABk7awjtmJ65Z4qxie', 1, NULL, NULL),
(10, 'longbit', 'longbit3@yopmail.com', NULL, NULL, 'longbit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$jkI9tOOa/m.hkt.ISY3u..SZirf0sx2h77r65Y5o1QEloMSXgdm4e', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colors`
--

CREATE TABLE `colors` (
  `id_color` int(11) NOT NULL,
  `colorName` varchar(500) DEFAULT NULL,
  `hex` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `colors`
--

INSERT INTO `colors` (`id_color`, `colorName`, `hex`) VALUES
(1, 'Green', '#57f5'),
(2, 'Pink', '#fa0092'),
(3, 'Green', '#57f5'),
(4, 'Pink', '#fa0092'),
(5, 'Green', '#57f5'),
(6, 'Pink', '#fa0092'),
(7, 'morado', '#fffff'),
(8, 'xxx 1', '#fff'),
(9, 'xxxxx', '#fff'),
(10, 'uno', '#fff'),
(11, 'dos', '#asdfas'),
(12, 'tres', '#00000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_rating`
--

CREATE TABLE `company_rating` (
  `id_rating` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `rating_comment` char(200) NOT NULL,
  `rating_date` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `company_rating`
--

INSERT INTO `company_rating` (`id_rating`, `rating`, `rating_comment`, `rating_date`, `id_user`, `id_client`, `status`) VALUES
(2, '3.5', 'muy bueno', '2020-09-01 11:38:58', 1, 2, 1),
(7, '4.0', 'ok', '2020-09-03 16:16:01', 1, 3, 1),
(8, '5.0', 'muy bien', '2020-09-03 16:16:01', 1, 1, 1),
(10, '5.0', 'muy bien', '2020-09-03 16:16:01', 5, 2, 1),
(14, '4.5', 'muy buen producto', '2020-11-04 00:36:02', 2, 1, 1),
(16, '4.5', 'muy buen producto', '2020-11-04 00:37:55', 4, 1, 1),
(21, '4.5', 'muy buen producto', '2020-11-04 00:36:02', 3, 1, 1),
(22, '4.5', 'muy buen producto', '2020-11-04 00:37:55', 5, 1, 1),
(23, '2.3', 'Comentario del usuario', '2020-12-15 20:33:51', 12, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `days`
--

CREATE TABLE `days` (
  `id_day` int(11) NOT NULL,
  `day` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `days`
--

INSERT INTO `days` (`id_day`, `day`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sábado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `features`
--

CREATE TABLE `features` (
  `id_feature` int(11) NOT NULL,
  `featureName` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_user_followed` int(11) DEFAULT NULL,
  `id_store_followed` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `followers`
--

INSERT INTO `followers` (`id`, `id_user`, `id_user_followed`, `id_store_followed`, `created_at`, `updated_at`) VALUES
(3, 1, 5, NULL, '2020-10-14 22:32:30', '2020-10-14 22:32:30'),
(6, 2, 1, NULL, '2020-10-14 23:43:31', '2020-10-14 23:43:31'),
(7, 3, 1, NULL, '2020-10-14 23:43:35', '2020-10-14 23:43:35'),
(8, 4, 1, NULL, '2020-10-14 23:43:39', '2020-10-14 23:43:39'),
(9, 5, 1, NULL, '2020-10-14 23:43:43', '2020-10-14 23:43:43'),
(10, 6, 1, NULL, '2020-10-14 23:43:46', '2020-10-14 23:43:46'),
(11, 7, 1, NULL, '2020-10-14 23:43:51', '2020-10-14 23:43:51'),
(13, 1, 3, NULL, '2020-12-11 02:27:58', '2020-12-11 02:27:58'),
(15, 1, NULL, 2, '2020-12-11 02:33:02', '2020-12-11 02:33:02'),
(16, 1, NULL, 4, '2020-12-11 02:33:10', '2020-12-11 02:33:10'),
(17, 12, 13, NULL, '2020-12-11 02:57:52', '2020-12-11 02:57:52'),
(20, 12, 10, NULL, '2020-12-11 03:06:00', '2020-12-11 03:06:00'),
(21, 15, 2, NULL, '2020-12-15 23:38:14', '2020-12-15 23:38:14'),
(35, 2, 38, NULL, '2020-12-22 15:54:34', '2020-12-22 15:54:34'),
(38, 2, 4, NULL, '2020-12-22 16:06:04', '2020-12-22 16:06:04'),
(39, 4, 2, NULL, '2020-12-22 16:47:19', '2020-12-22 16:47:19'),
(40, 5, 2, NULL, '2020-12-22 16:47:23', '2020-12-22 16:47:23'),
(71, 12, 6, NULL, '2020-12-24 05:54:23', '2020-12-24 05:54:23'),
(73, 12, 5, NULL, '2020-12-24 05:54:57', '2020-12-24 05:54:57'),
(115, 2, NULL, 8, '2021-01-16 01:20:12', '2021-01-16 01:20:12'),
(116, 2, NULL, 4, '2021-01-16 01:20:19', '2021-01-16 01:20:19'),
(125, 38, NULL, 7, '2021-01-16 19:18:46', '2021-01-16 19:18:46'),
(129, 38, NULL, 4, '2021-01-16 19:28:18', '2021-01-16 19:28:18'),
(133, 12, NULL, 2, '2021-01-18 20:47:11', '2021-01-18 20:47:11'),
(136, 38, 5, NULL, '2021-01-19 18:34:13', '2021-01-19 18:34:13'),
(153, 38, NULL, 2, '2021-01-19 19:39:45', '2021-01-19 19:39:45'),
(154, 38, 3, NULL, '2021-01-19 19:39:51', '2021-01-19 19:39:51'),
(155, 38, 6, NULL, '2021-01-19 19:40:06', '2021-01-19 19:40:06'),
(164, 38, 2, NULL, '2021-01-19 20:57:57', '2021-01-19 20:57:57'),
(167, 38, 4, NULL, '2021-01-19 21:10:45', '2021-01-19 21:10:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gender`
--

CREATE TABLE `gender` (
  `id_gender` int(11) NOT NULL,
  `genderName` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gender`
--

INSERT INTO `gender` (`id_gender`, `genderName`) VALUES
(1, 'ejemplo gender');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hour`
--

CREATE TABLE `hour` (
  `id_hour` int(11) NOT NULL,
  `id_day` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_store` int(11) DEFAULT NULL,
  `open` varchar(100) DEFAULT NULL,
  `close` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hour`
--

INSERT INTO `hour` (`id_hour`, `id_day`, `id_client`, `id_store`, `open`, `close`) VALUES
(81, 1, 5, NULL, '9:00', '16:00'),
(82, 2, 5, NULL, '11:00', '17:00'),
(83, 3, 5, NULL, '9:00', '16:00'),
(84, 4, 5, NULL, '11:00', '17:00'),
(85, 5, 5, NULL, '9:00', '16:00'),
(86, 6, 5, NULL, '9:00', '16:00'),
(87, 7, 5, NULL, 'CERRADO', 'CERRADO'),
(95, 1, NULL, 2, '08:00', '14:00'),
(96, 2, NULL, 2, '08:00', '14:00'),
(97, 3, NULL, 2, NULL, NULL),
(98, 4, NULL, 2, NULL, NULL),
(99, 5, NULL, 2, NULL, NULL),
(100, 6, NULL, 2, NULL, NULL),
(101, 7, NULL, 2, NULL, NULL),
(102, 1, NULL, 4, '08:00', '14:00'),
(103, 2, NULL, 4, '08:00', '14:00'),
(104, 3, NULL, 4, NULL, NULL),
(105, 4, NULL, 4, NULL, NULL),
(106, 5, NULL, 4, NULL, NULL),
(107, 6, NULL, 4, NULL, NULL),
(108, 7, NULL, 4, NULL, NULL),
(116, 1, 2, NULL, '9:00', '18:00'),
(117, 2, 2, NULL, '10:00', '13:30'),
(118, 3, 2, NULL, '9:00', '17:00'),
(119, 4, 2, NULL, '10:00', '13:00'),
(120, 5, 2, NULL, '9:00', '18:00'),
(121, 6, 2, NULL, '9:00', '15:00'),
(122, 7, 2, NULL, 'CERRADO', 'CERRADO'),
(123, 1, NULL, 1, '08:00', '16:00'),
(124, 2, NULL, 1, '08:00', '14:00'),
(125, 3, NULL, 1, NULL, NULL),
(126, 4, NULL, 1, NULL, NULL),
(127, 5, NULL, 1, NULL, NULL),
(128, 6, NULL, 1, NULL, NULL),
(129, 7, NULL, 1, NULL, NULL),
(144, 1, NULL, 6, '08:00', '14:00'),
(145, 2, NULL, 6, '08:00', '14:00'),
(146, 3, NULL, 6, NULL, NULL),
(147, 4, NULL, 6, NULL, NULL),
(148, 5, NULL, 6, NULL, NULL),
(149, 6, NULL, 6, NULL, NULL),
(150, 7, NULL, 6, NULL, NULL),
(264, 1, NULL, NULL, 'laksdjf', NULL),
(265, 2, NULL, NULL, NULL, NULL),
(266, 3, NULL, NULL, NULL, NULL),
(267, 4, NULL, NULL, NULL, NULL),
(268, 5, NULL, NULL, NULL, NULL),
(269, 6, NULL, NULL, NULL, NULL),
(270, 7, NULL, NULL, NULL, NULL),
(271, 1, NULL, NULL, 'laksdjf', NULL),
(272, 2, NULL, NULL, NULL, NULL),
(273, 3, NULL, NULL, NULL, NULL),
(274, 4, NULL, NULL, NULL, NULL),
(275, 5, NULL, NULL, NULL, NULL),
(276, 6, NULL, NULL, NULL, NULL),
(277, 7, NULL, NULL, NULL, NULL),
(285, 1, 3, NULL, '16:00', '08:00'),
(286, 2, 3, NULL, '08:00', '16:00'),
(287, 3, 3, NULL, NULL, NULL),
(288, 4, 3, NULL, NULL, NULL),
(289, 5, 3, NULL, NULL, NULL),
(290, 6, 3, NULL, NULL, NULL),
(291, 7, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `influencers`
--

CREATE TABLE `influencers` (
  `id_influencer` int(11) NOT NULL,
  `name` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lastname` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` char(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` char(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `age` tinyint(3) UNSIGNED DEFAULT NULL,
  `gender` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `state_residence` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `alias` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `instagram_url` char(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `facebook_url` char(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `youtube_url` char(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiktok_url` char(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `pinterest_url` char(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `snapchat_url` char(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `twitter_url` char(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `profile_image` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `influencers`
--

INSERT INTO `influencers` (`id_influencer`, `name`, `lastname`, `phone`, `email`, `password`, `age`, `gender`, `state_residence`, `alias`, `instagram_url`, `facebook_url`, `youtube_url`, `tiktok_url`, `pinterest_url`, `snapchat_url`, `twitter_url`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'ed', NULL, '0123456110', 'asdfa@m.ail.com', 'asdfasdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-30 23:25:39', '2020-09-30 23:25:39'),
(9, 'ed', NULL, '0123456110', 'asdfa123@m.ail.com', 'asdfasdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-01 00:11:58', '2020-10-01 00:11:58'),
(13, 'ed', NULL, '0123456110', 'asdfa1234@m.ail.com', 'asdfasdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-01 02:17:06', '2020-10-01 02:17:06'),
(17, 'ed', NULL, '0123456110', 'qwerty@mail.com', 'asdfasdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-01 03:46:29', '2020-10-01 03:46:29'),
(18, 'ed', NULL, '0123456110', 'qwert@mail.com', 'asdfasdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-01 03:46:44', '2020-10-01 03:46:44'),
(20, 'ed', NULL, '0123456789', 'qwerst@gmail.com', 'asdfasdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-01 05:43:07', '2020-10-01 05:43:07'),
(22, 'ed', NULL, '0123456789', 'hola@gmail.com', '$2y$10$XwjvC5xuf4zkCLcbd/hy3e0jTgkLXZXMbqfWOnJxMm1zdpIU5fmJC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-01 06:48:10', '2020-10-01 06:48:10'),
(24, 'ed', NULL, '0123456789', 'hola2@gmail.com', '$2y$10$.O8gZ6aPnjTU5JdMCj15ZOJ86P3WpYBbHXlWvmuLTVmAfbBsmhwXO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-30 04:36:34', '2020-10-30 04:36:34'),
(25, 'ed', NULL, '0123456789', 'hola10@gmail.com', '$2y$10$XRpWEDpj8kH/ORLY1mxLyu93TLrMFbyrfxEwk9kAbbcEdZuMpcQsu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-11 09:14:50', '2020-12-11 09:14:50'),
(26, 'ed', NULL, '0123456789', 'hola110@gmail.com', '$2y$10$r7lkUeVRz./sxWurQ6RaE..79g5O82dCIV4OGYFkFVvHdoqMI/.kq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-12 08:17:06', '2020-12-12 08:17:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `label_season`
--

CREATE TABLE `label_season` (
  `id_labelSeason` int(11) NOT NULL,
  `seasonName` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `label_season`
--

INSERT INTO `label_season` (`id_labelSeason`, `seasonName`) VALUES
(1, 'Ejemplo label season');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `measurements`
--

CREATE TABLE `measurements` (
  `id_measurement` int(11) NOT NULL,
  `id_range` int(11) DEFAULT NULL,
  `id_partsClothing` int(11) DEFAULT NULL,
  `id_size` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `measurements`
--

INSERT INTO `measurements` (`id_measurement`, `id_range`, `id_partsClothing`, `id_size`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(3, 1, 1, 1),
(4, 1, 1, 1),
(5, 1, 1, 1),
(8, 1, 1, 1),
(9, 1000, 1, 1),
(10, 1, 1, 1),
(11, 1, 1, 1),
(12, 1, 1, 1),
(13, 100000, 100000, 10000),
(14, 100000, 100000, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parts_clothing`
--

CREATE TABLE `parts_clothing` (
  `id_partsClothing` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parts_clothing`
--

INSERT INTO `parts_clothing` (`id_partsClothing`, `name`) VALUES
(1, 'Ejemplo parts clothing\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_measurements`
--

CREATE TABLE `personal_measurements` (
  `user_id` int(11) NOT NULL,
  `chest` decimal(5,2) DEFAULT NULL,
  `waist` decimal(5,2) DEFAULT NULL,
  `hip` decimal(5,2) DEFAULT NULL,
  `shoulders` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `bra_size` char(5) DEFAULT NULL,
  `shoe_size` decimal(5,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personal_measurements`
--

INSERT INTO `personal_measurements` (`user_id`, `chest`, `waist`, `hip`, `shoulders`, `weight`, `height`, `bra_size`, `shoe_size`) VALUES
(1, '123.00', '80.60', '90.00', '120.00', NULL, NULL, NULL, NULL),
(12, '12.00', '98.95', '11.00', '101.00', '44.90', '1.79', '000', '12.00'),
(13, '65.10', '78.95', '27.00', '26.10', '12.70', '118.50', '', '21.90'),
(14, '12.00', '22.00', '22.00', '22.00', '22.00', '22.00', '000', '22.00'),
(15, '90.70', '78.95', NULL, '101.25', '84.90', '1.79', NULL, '28.00'),
(3, '23.00', '23.00', '21.00', '12.00', '23.00', '12.00', '122c', '12.00'),
(22, '12.00', '21.00', NULL, NULL, NULL, NULL, NULL, '12.00'),
(24, '12.00', '21.00', NULL, NULL, NULL, NULL, NULL, '12.00'),
(30, '12.00', '21.00', NULL, NULL, NULL, NULL, NULL, '12.00'),
(31, '23.00', '12.00', '12.00', '23.00', '12.00', '23.00', '23', '12.00'),
(32, NULL, '21.00', NULL, NULL, NULL, NULL, NULL, '12.00'),
(33, NULL, '21.00', NULL, NULL, NULL, NULL, NULL, '12.00'),
(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12.00'),
(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, '12.00', NULL, NULL, NULL, NULL),
(4, '58.00', '22.00', '2.00', '12.00', '2.00', '2.00', '2c', '2.00'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '223.10', '12.00', '12.00', '12.00', '13.20', '24.10', '12', '12.00'),
(9, '12.20', '50.00', NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `productName` varchar(500) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `avgDiscount` float DEFAULT NULL,
  `priceDiscount` float DEFAULT NULL,
  `id_articleType` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_gender` int(11) DEFAULT NULL,
  `id_body` int(11) DEFAULT NULL,
  `labelStyle` varchar(500) DEFAULT NULL,
  `labelOccasion` varchar(500) DEFAULT NULL,
  `id_labelSeason` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_measurement` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `productName`, `price`, `avgDiscount`, `priceDiscount`, `id_articleType`, `id_category`, `id_gender`, `id_body`, `labelStyle`, `labelOccasion`, `id_labelSeason`, `id_client`, `id_measurement`) VALUES
(1, 'ejemplo Productoname', 10000, NULL, NULL, 1, 1, 1, 1, 'ejemplo label style', 'ejemplo label ocassion', 1, 1, 1),
(2, 'ejemplo Productoname', 10000, NULL, NULL, 1, 1, 1, 1, 'ejemplo label style', 'ejemplo label ocassion', 1, 1, 2),
(3, 'ejemplo Productoname', 10000, NULL, NULL, 1, 1, 1, 1, 'ejemplo label style', 'ejemplo label ocassion', 1, 1, 3),
(4, 'ejemplo Productoname', 10000, NULL, NULL, 1, 1, 1, 1, 'ejemplo label style', 'ejemplo label ocassion', 1, 1, 4),
(5, 'ejemplo Productoname', 10000, NULL, NULL, 1, 1, 1, 1, 'ejemplo label style', 'ejemplo label ocassion', 1, 1, 5),
(6, 'jlaksdjflkj', 2099, 0, 0, 1, 1, 1, 1, 'lksjdfl', 'alskdjflas', 1, 1, 8),
(7, 'jlaksdjflkj', 2099, 0, 0, 1, 1, 1, 1, 'lksjdfl', 'alskdjflas', 1, 1, 9),
(8, 'jlaksdjflkj', 2099, 0, 0, 1000, 1, 1, 1, 'lksjdfl', 'alskdjflas', 1, 1, 10),
(9, 'jlaksdjflkj', 2099, 0, 0, 1, 1, 1, 1000, 'lksjdfl', 'alskdjflas', 1, 1, 11),
(10, 'jlaksdjflkj', 2099, 0, 0, 1, 1, 100, 1000, 'lksjdfl', 'alskdjflas', 1, 1, 12),
(11, 'jlaksdjflkj', 2099, 0, 0, 1, 1, 100, 1000, 'lksjdfl', 'alskdjflas', 10000, 10000, 13),
(12, 'jlaksdjflkj', 2099, 0, 0, 1, 1, 100, 1000, 'lksjdfl', 'alskdjflas', 10000, 10000, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_color`
--

CREATE TABLE `product_color` (
  `id_product` int(11) NOT NULL,
  `id_color` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product_color`
--

INSERT INTO `product_color` (`id_product`, `id_color`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(3, 7),
(4, 8),
(4, 9),
(5, 10),
(5, 11),
(5, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_images`
--

CREATE TABLE `product_images` (
  `id_productImage` int(11) NOT NULL,
  `imageUrl` varchar(500) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `ordering` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_print`
--

CREATE TABLE `product_print` (
  `id_product` int(11) NOT NULL,
  `id_print` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_rating`
--

CREATE TABLE `product_rating` (
  `id_rating` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `rating_comment` char(200) NOT NULL,
  `rating_date` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) NOT NULL,
  `concordance` tinyint(1) NOT NULL,
  `correct_size` tinyint(1) NOT NULL,
  `mat_quality` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `image` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product_rating`
--

INSERT INTO `product_rating` (`id_rating`, `rating`, `rating_comment`, `rating_date`, `id_user`, `id_product`, `concordance`, `correct_size`, `mat_quality`, `status`, `image`) VALUES
(3, '3.5', 'muy bueno', '2017-09-01 11:41:57', 1, 1, 1, 1, 1, 1, 'D:/xampp/htdocs/longbit/imagesUser/11598978517.JPG'),
(4, '3.5', 'muy bueno', '2020-09-01 13:43:49', 1, 2, 1, 1, 1, 1, NULL),
(5, '3.5', 'muy bueno', '2019-03-11 14:02:35', 1, 3, 1, 1, 1, 1, 'D:/xampp/htdocs/longbit/imagesUser/11598986955.JPG'),
(6, '3.5', 'muy bueno', '2020-09-01 14:03:28', 1, 4, 1, 1, 1, 1, 'D:/xampp/htdocs/longbit/imagesUser/141598987008.JPG'),
(7, '3.5', 'muy bueno', '2016-09-01 14:14:34', 1, 5, 0, 1, 1, 1, 'D:/xampp/htdocs/longbit/imagesUser/151598987674.JPG'),
(8, '4.0', 'ok', '2020-03-17 14:16:18', 1, 6, 1, 1, 1, 1, 'D:/xampp/htdocs/longbit/imagesUser/161598987778.JPG'),
(9, '3.0', 'ok', '2018-11-30 15:50:04', 1, 8, 0, 1, 1, 1, NULL),
(10, '5.0', 'ok', '2020-09-02 12:17:56', 1, 122, 1, 1, 1, 1, 'http://localhost/longbit/imagesUser/11221599067076.JPG'),
(11, '4.5', 'bueno', '2017-03-01 12:17:56', 2, 1, 0, 1, 0, 1, 'http://localhost/longbit/imagesUser/11221599067076.JPG'),
(12, '4.5', 'maso', '2019-03-11 14:16:18', 3, 1, 1, 0, 1, 1, 'D:/xampp/htdocs/longbit/imagesUser/161598987778.JPG'),
(13, '3.0', 'dos tres', '2020-01-01 15:50:04', 4, 1, 1, 1, 1, 1, NULL),
(14, '4.0', 'está bueno', '2018-08-18 12:17:56', 5, 1, 1, 1, 0, 1, 'http://localhost/longbit/imagesUser/11221599067076.JPG'),
(15, '4.5', 'Es realmente bueno', '2020-09-09 00:17:58', 1, 111, 0, 1, 1, 1, 'http://localhost/longbit/imagesUser/11111599628678.JPG'),
(16, '4.5', 'muy buen producto', '2020-11-06 17:35:16', 2, 2, 1, 1, 1, 1, 'http://localhost/longbit/imagesUser/221604705716.png'),
(17, '3.0', 'muy buen producto', '2020-11-06 17:38:33', 3, 2, 1, 1, 1, 1, 'http://localhost/longbit/imagesUser/321604705913.png'),
(22, '3.0', 'muy buen producto', '2020-12-11 23:57:33', 5, 2, 1, 1, 1, 1, 'http://modapp.longbit.mx/longbit/imagesUser/521607752653.png'),
(23, '1.0', 'Hola soy un comenbtario', '2020-12-15 20:30:56', 12, 55, 0, 0, 0, 1, NULL),
(24, '1.0', 'Hola soy un comenbtario', '2020-12-15 20:31:48', 13, 55, 0, 0, 0, 1, NULL),
(25, '3.0', 'muy buen producto', '2020-12-15 22:40:08', 5, 10, 1, 1, 1, 1, NULL),
(27, '3.0', 'muy buen producto', '2020-12-15 22:42:21', 5, 11, 1, 1, 1, 1, '/home3/longbit/modapp.longbit.mx/longbit/imagesUser/5111608093741.png'),
(28, '3.0', 'muy buen producto', '2020-12-15 22:53:26', 5, 12, 1, 1, 1, 1, 'http://modapp.longbit.mx//longbit/imagesUser/5121608094406.png'),
(29, '3.0', 'muy buen producto', '2020-12-15 22:54:56', 5, 13, 1, 1, 1, 1, 'http://modapp.longbit.mx/longbit/imagesUser/5131608094496.png'),
(32, '3.0', 'muy buen producto', '2020-12-16 15:06:40', 5, 14, 1, 1, 1, 1, 'http://modapp.longbit.mx/longbit/imagesUser/5141608152800.png'),
(35, '1.0', 'Hola soy un comenbtario', '2020-12-16 19:05:22', 11, 55, 0, 0, 0, 1, 'http://modapp.longbit.mx/longbit/imagesUser/11551608167122.png'),
(36, '1.0', 'Hola soy un comenbtario', '2020-12-16 19:06:57', 11, 42, 0, 0, 0, 1, 'http://modapp.longbit.mx/longbit/imagesUser/11421608167217.png'),
(37, '3.0', 'muy buen producto', '2020-12-16 19:12:03', 5, 15, 1, 1, 1, 1, 'http://modapp.longbit.mx/longbit/imagesUser/5151608167523.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_size`
--

CREATE TABLE `product_size` (
  `id_product` int(11) NOT NULL,
  `id_size` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranges`
--

CREATE TABLE `ranges` (
  `id_range` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ranges`
--

INSERT INTO `ranges` (`id_range`, `value`) VALUES
(1, 'ejemplo range');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sizes`
--

CREATE TABLE `sizes` (
  `id_size` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sizes`
--

INSERT INTO `sizes` (`id_size`, `size`) VALUES
(1, 'ej size');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store`
--

CREATE TABLE `store` (
  `id_store` int(11) NOT NULL,
  `store_name` varchar(70) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `maps` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT 1,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `store`
--

INSERT INTO `store` (`id_store`, `store_name`, `image`, `maps`, `status`, `id_client`) VALUES
(1, 'wer', 'kasdfkfd', 'jkajkdfkf', 1, 1),
(2, 'wer', 'kasdfkfd', 'jkajkdfkf', 1, 5),
(4, 'Omar', NULL, 'Jnmkdnckjdncjkdsnc', 1, 1),
(6, 'POST-MAN', 'https://upload.wikimedia.org/wikipedia/commons/a/af/Tour_eiffel_at_sunrise_from_the_trocadero.jpg', 'Champ de Mars, 5 Avenue Anatole France, 75007 Paris, Francia', 1, 2),
(7, 'lajsdlkfjsd', NULL, 'oajsdlkf', 1, 1),
(8, 'lajsdlkfjsd', NULL, 'oajsdlkf', 1, 1),
(9, 'jkadfklsdfkl', 'kasdfkfd', 'jkajkdfkf', 1, 1),
(10, 'jkadfklsdfkl', 'kasdfkfd', 'jkajkdfkf', 1, 1),
(11, 'jkadfklsdfkl', 'kasdfkfd', 'jkajkdfkf', 1, 1),
(12, 'jkadfklsdfkl', 'kasdfkfd', 'jkajkdfkf', 1, 1),
(15, 'jkadfklsdfkl', 'kasdfkfd', 'jkajkdfkf', 1, 2),
(16, 'jkadfklsdfkl', 'kasdfkfd', 'jkajkdfkf', 1, 2),
(17, 'jkadfklsdfkl', 'kasdfkfd', 'jkajkdfkf', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store_product`
--

CREATE TABLE `store_product` (
  `id_storeProduct` int(11) NOT NULL,
  `id_store` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_size` int(11) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(75) DEFAULT NULL,
  `username` varchar(75) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `age` varchar(2) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `interest` varchar(30) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `bio` varchar(200) DEFAULT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `username`, `mail`, `age`, `password`, `image`, `interest`, `gender`, `status`, `bio`, `birth_date`) VALUES
(1, 'test fullname', 'prueba', 'test@test.com', NULL, '$2y$10$IeS5UkvN4hZI84M77HsU/OJ14JLxMyTvlQ8ASTfdCgXbv21XPjL1.', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'test fullname', 'user.username', 'test@test.com', NULL, '$2y$10$lyaont7K1Iv76Pv4HNJsoeC9DK3qLaa/ddecKCt9Ky4CAOmoxYkPu', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'test fullname', 'user.usernamea', 'luisdiaz961013@gmail.com', NULL, '$2y$10$kisCjPLMfJESlKaBLiGAjeq.pCtiqBNqIkc0gm5L.Ct9lmmTa2qAy', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'hola hola', 'hola', 'hola@hola.com', NULL, '$2y$10$bgRnBTLhmD5yROtzR1vXa.HZfaV9CN1y/9jjs5Yv0yZkjxXoABqBK', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'HOLA', 'hola hola', 'hola22@hola.com', NULL, '$2y$10$ZoQmWgN1wxN6EH4TFmJsVucmOZUSHtYBW9jXZMR65xVy3VPqZgwY.', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'HOLA', 'hola hola3', 'hola252@hola.com', NULL, '$2y$10$yEFb9uJBbc1Twd4QB2MXm.46ZP.bLiIqBcFPmWJsRCHULMFccqdxu', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'HOLA', 'hola hola33', 'hola2552@hola.com', NULL, '$2y$10$KzNBWBVHX1NBsDb4vpRqp.9ToMiraw7fUANA6IDorD8sxttORWBQC', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'HOLA', 'hola hola333', 'hola2552e@hola.com', NULL, '$2y$10$Z7fknjJ0iPm/xzfDjxeXAuRsg67AaEDsCJmU58xzwK3dBi5Eyu0si', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'HOLA', 'holayop', 'longbit@yopmail.com', NULL, '$2y$10$nKwvEirsic84rJX/klx7Pe3enem3Wm3PN5EukbIWv6YDIlNXgMm72', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'HOLA', 'holayop2', 'longbit3@yopmail.com', NULL, '$2y$10$Ez6X6Y.YzuIVAC7C0gAfSeF8.JBXj5yuyXSuG8MPo8CIW40BtkQ1e', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'test fullname', 'ad', 'asfsf', NULL, '$2y$10$fhj830ykej9kIJMRfc9eRedUT4vIBm5I.uQUq4aPEC3O8XH0Q29p6', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'test peter uvaldo', 'Peter elpanda', 'peterxd.uvaldo@gmail.com', NULL, '$2y$10$jyyun25CbmpG2mBTNXjD4OEKvqRRu.6WwEBhsWhHsOFyu2eau6WwC', NULL, NULL, 'F', NULL, 'asdfasdfasdfasdfas DFA dsaf asdfasdfasdfasdfas ASDF as ASDF ASDF ASDF ASDF sadf ASDF ', '2020-11-26'),
(13, 'test Joana', 'lanalana', 'jouluna01@gmail.com', NULL, '$2y$10$kNrnUmRaERP0Y9HpJbd3Pu6HOa61p3Ioxsuvh9wDvx4tFSz25ZQgu', NULL, NULL, 'F', NULL, 'Holla at todos', '2020-12-23'),
(14, 'nombre y apellido', 'nombre y apellido', 'nombre y apellido', NULL, '$2y$10$bnuGDTZ1XCSLbFbvpL1df.HNR4lVE8rZ0hP7D6RyWNfePbiHkykaq', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'as', 'as', 'as', NULL, '$2y$10$xLCDxoJ8RG4wPThP51B4HeVFflzpfu2I64gNnA147h0F9KnzlFSsa', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'test', 'test', 'test', NULL, '$2y$10$EPu3DjxeJGQoA7G3oFmrW.3nRd/R66qAKlwEkXHls2hE04aWHkOQS', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'pedro', 'pedro', 'pedro', NULL, '$2y$10$/Ir6oVRGWh7CJRG1auuRWOeWyq5BG1s37bLP/sSzHIo/Y04vUi776', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'peter escobedo', 'peter escobedo', 'peter escobedo', NULL, '$2y$10$04gwlqgln8uEdbCSITgzReOQAucc2MbNgksi4SAr5D9qcktcawb7O', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'sadas', 'sadas', 'sadas', NULL, '$2y$10$RQQUFr4Jgvo/SmdjknomFOXnfQ.xzA1OBLh9Eig6b7Bphu850rsRu', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'asdfasf', 'lffloresc', 'asdfasf', NULL, '$2y$10$N395F/z37PhiU4yyahycWeLpqF6K.PpE3KIdiryrAaebKl5gipO1a', NULL, NULL, 'M', NULL, 'Se feliz', '1998-05-10'),
(21, 'pedro escobedo', 'Pedro ', 'pedro escobedo', NULL, '$2y$10$pxfhzT3wXceIpOxUqvAwwuISE9mi8oVjqdkfhy2oSbiBUI8SgB.za', NULL, NULL, 'M', NULL, 'lala', NULL),
(22, 'pedro escobedo g', 'pedro escobedo g', 'pedro escobedo g', NULL, '$2y$10$Czyp3IRFrTfSFW1NgN8eP.YqgLyNmQJT.eDGGOr4wMQaLJDQ9gtbK', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'test Joana1', 'test.joana1', 'jouluna011@gmail.com', NULL, '$2y$10$QGOC6Kqiiu2TeBERSk7D7eHjtTgI3d0iOnZDPh67fzXP2LTgWk0QG', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'pedro escobedo ggg', 'pedro escobedo ggg', 'pedro escobedo ggg', NULL, '$2y$10$KeGDJHgA4/szjNELVMSJ2Od6VynjtmdSbYvHhSjwX4.z7G7LgFy92', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'peter el panda', 'peter el panda', 'peter el panda', NULL, '$2y$10$iuZcnIwQzskfy3FX5bnrBe4IGCAI5e96eTavT3hBFbxMXKtw0eXZa', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'peterx', 'peterx', 'peterx', NULL, '$2y$10$VJb3ydDGE1h2J7mLcPaRD.wJ4VaT/5t6BhKwEc0PJqN19dQ2NM1Cq', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'pancho', 'pancho', 'pancho', NULL, '$2y$10$6jXECkJxkqQz0jja6ZB0L.m1hmQa3aTz7PNmd6sL5/GYWC1Piqknm', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'lalo', 'lalo', 'lalo', NULL, '$2y$10$B.cc/5dWCdn.7FCtbYxnDu.N.jLfZ4hQOp4Xsk.Yn.hyjPCzHBjDC', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'lalola', 'lalola', 'lalola', NULL, '$2y$10$kWPvCdcAaUbsH9Lczipyo.xsJPixG3CEddhtT.9qQMyBiUgdiZwNa', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'pedroes', 'pedroes', 'pedroes', NULL, '$2y$10$NU51e3QqA2u2lzLVRna.uupJ2e8tb5t/4hq6tLGmjyBOxLkWwBXa.', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Ghhjjhh', 'Ghhjjhh', 'Ghhjjhh', NULL, '$2y$10$ZhjsErSBCyVwlUgq5POfyOCA6MzJ/EpUmBrBTVVb56fSjop3md5vW', NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Address', 'Address', 'Address', NULL, '$2y$10$FatyLEPLPaenBAoHFm2vhuT5rtVp5t0PuHYnCu3ohQe5onCQrhGFy', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Address2', 'Address2', 'Address2', NULL, '$2y$10$RntW5/EulJFaP57/q2m1RezfqkGYDKoUPL9mhHiBNyLh4gQJB7c0y', NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Hhh', 'Hhh', 'Hhh', NULL, '$2y$10$d05NfGzU8k3LapV3gXpN9OLHhseBCm0nFkptTuI5qaDuu0zzwMCF.', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'peter el panda', 'panchito', 'peterxd.uvaldo@gmail.com.mx', NULL, '$2y$10$OpFZ6.pAslKxkAGa3H.hbOZVlIFg1TZLZWE18ZRu4jKJTxOgibg72', NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Pedro Escobedo ', 'Pedro.uvaldo', 'peterxd.uvaldo@gmail.com.mm', NULL, '$2y$10$A6lpN5.B7WinstMIfNOWkOVTev5.cpW8RIi8931RiZyz8mMCZb05m', NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'asgfasd aw arw ', 'asdf', 'peterxd.uvaldo@gmail.com-mxx', NULL, '$2y$10$ZX98o1hWweqL2dgCoTXfHee89jFHUlbofpo5BBvsMlulJqbXHQVOq', NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Luis Felipe Cabello', 'Luis96', 'luis.fcg.261296@gmail.com', NULL, '$2y$10$31oW9ny7P9aWJHjU4MdL.edSPkZteXeME4shuLK8EcffuAGbtQpIG', NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'luis', 'l96', 'l86@test.com', NULL, '$2y$10$8jJg0SOerM0ksMoZwj8hVOMhLZadr2dynJ1fwiUh3oJ0WfW/9ReSe', NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'tester ', 'tester01', 'tester@test.com.mx', NULL, '$2y$10$w8X3Nfe4tQE9CGfj.T4EGuSacN1LWPmy3IAwB6C0XwBBgW/Su7l6y', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_posts`
--

CREATE TABLE `user_posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` varchar(500) DEFAULT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_posts`
--

INSERT INTO `user_posts` (`id`, `id_user`, `content`, `tags`, `created_at`, `updated_at`) VALUES
(1, 3, 'Hola buen día', '', '2021-01-19 18:31:24', '2021-01-19 18:31:24'),
(7, 3, 'Hola buen día', '', '2021-01-19 18:47:51', '2021-01-19 18:47:51'),
(8, 3, 'post actualizado', '#tags', '2021-01-19 18:51:58', '2021-01-19 21:14:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_posts_images`
--

CREATE TABLE `user_posts_images` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `path` varchar(1000) NOT NULL,
  `img_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_posts_images`
--

INSERT INTO `user_posts_images` (`id`, `id_post`, `path`, `img_order`) VALUES
(5, 7, 'http://longbit.com.mx/modapp/images/imagesUser/316110820713473.png', 1),
(6, 7, 'http://longbit.com.mx/modapp/images/imagesUser/316110820726058.png', 2),
(7, 8, 'http://longbit.com.mx/modapp/images/imagesUser/31611082318348.png', 1),
(8, 8, 'http://longbit.com.mx/modapp/images/imagesUser/316110823182256.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_stories`
--

CREATE TABLE `user_stories` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` varchar(100) DEFAULT NULL,
  `img_path` varchar(1000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `store` (`store`);

--
-- Indices de la tabla `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id_agency`);

--
-- Indices de la tabla `article_features`
--
ALTER TABLE `article_features`
  ADD PRIMARY KEY (`id_articleType`,`id_feature`),
  ADD KEY `id_feature` (`id_feature`);

--
-- Indices de la tabla `article_type`
--
ALTER TABLE `article_type`
  ADD PRIMARY KEY (`id_articleType`);

--
-- Indices de la tabla `body`
--
ALTER TABLE `body`
  ADD PRIMARY KEY (`id_body`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indices de la tabla `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `company_rating`
--
ALTER TABLE `company_rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD UNIQUE KEY `UNIQUE_COMPANY_COMMENT` (`id_user`,`id_client`),
  ADD KEY `id_client` (`id_client`);

--
-- Indices de la tabla `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id_day`);

--
-- Indices de la tabla `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id_feature`);

--
-- Indices de la tabla `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_user_followed`),
  ADD UNIQUE KEY `id_user_2` (`id_user`,`id_store_followed`),
  ADD KEY `id_user_followed` (`id_user_followed`),
  ADD KEY `id_store_followed` (`id_store_followed`);

--
-- Indices de la tabla `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id_gender`);

--
-- Indices de la tabla `hour`
--
ALTER TABLE `hour`
  ADD PRIMARY KEY (`id_hour`),
  ADD KEY `id_day` (`id_day`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_store` (`id_store`);

--
-- Indices de la tabla `influencers`
--
ALTER TABLE `influencers`
  ADD PRIMARY KEY (`id_influencer`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `label_season`
--
ALTER TABLE `label_season`
  ADD PRIMARY KEY (`id_labelSeason`);

--
-- Indices de la tabla `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id_measurement`),
  ADD KEY `id_range` (`id_range`),
  ADD KEY `id_partsClothing` (`id_partsClothing`),
  ADD KEY `id_size` (`id_size`);

--
-- Indices de la tabla `parts_clothing`
--
ALTER TABLE `parts_clothing`
  ADD PRIMARY KEY (`id_partsClothing`);

--
-- Indices de la tabla `personal_measurements`
--
ALTER TABLE `personal_measurements`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_articleType` (`id_articleType`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_gender` (`id_gender`),
  ADD KEY `id_body` (`id_body`),
  ADD KEY `id_labelSeason` (`id_labelSeason`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_measurement` (`id_measurement`);

--
-- Indices de la tabla `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id_product`,`id_color`),
  ADD KEY `id_color` (`id_color`);

--
-- Indices de la tabla `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id_productImage`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `product_print`
--
ALTER TABLE `product_print`
  ADD PRIMARY KEY (`id_product`,`id_print`),
  ADD KEY `id_print` (`id_print`);

--
-- Indices de la tabla `product_rating`
--
ALTER TABLE `product_rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD UNIQUE KEY `UNIQUE_PROD_COMMENT` (`id_user`,`id_product`);

--
-- Indices de la tabla `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id_product`,`id_size`),
  ADD KEY `id_size` (`id_size`);

--
-- Indices de la tabla `ranges`
--
ALTER TABLE `ranges`
  ADD PRIMARY KEY (`id_range`);

--
-- Indices de la tabla `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id_size`);

--
-- Indices de la tabla `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id_store`),
  ADD KEY `id_client` (`id_client`);

--
-- Indices de la tabla `store_product`
--
ALTER TABLE `store_product`
  ADD PRIMARY KEY (`id_storeProduct`),
  ADD KEY `id_store` (`id_store`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_size` (`id_size`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `user_posts_images`
--
ALTER TABLE `user_posts_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Indices de la tabla `user_stories`
--
ALTER TABLE `user_stories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT de la tabla `agencies`
--
ALTER TABLE `agencies`
  MODIFY `id_agency` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `article_type`
--
ALTER TABLE `article_type`
  MODIFY `id_articleType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `body`
--
ALTER TABLE `body`
  MODIFY `id_body` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colors`
--
ALTER TABLE `colors`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `company_rating`
--
ALTER TABLE `company_rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `days`
--
ALTER TABLE `days`
  MODIFY `id_day` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `features`
--
ALTER TABLE `features`
  MODIFY `id_feature` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `gender`
--
ALTER TABLE `gender`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hour`
--
ALTER TABLE `hour`
  MODIFY `id_hour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT de la tabla `influencers`
--
ALTER TABLE `influencers`
  MODIFY `id_influencer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `label_season`
--
ALTER TABLE `label_season`
  MODIFY `id_labelSeason` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id_measurement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `parts_clothing`
--
ALTER TABLE `parts_clothing`
  MODIFY `id_partsClothing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id_productImage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product_rating`
--
ALTER TABLE `product_rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `ranges`
--
ALTER TABLE `ranges`
  MODIFY `id_range` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `store`
--
ALTER TABLE `store`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `store_product`
--
ALTER TABLE `store_product`
  MODIFY `id_storeProduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `user_posts_images`
--
ALTER TABLE `user_posts_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `user_stories`
--
ALTER TABLE `user_stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `address_ibfk_3` FOREIGN KEY (`store`) REFERENCES `store` (`id_store`);

--
-- Filtros para la tabla `hour`
--
ALTER TABLE `hour`
  ADD CONSTRAINT `hour_ibfk_1` FOREIGN KEY (`id_day`) REFERENCES `days` (`id_day`),
  ADD CONSTRAINT `hour_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `hour_ibfk_3` FOREIGN KEY (`id_store`) REFERENCES `store` (`id_store`);

--
-- Filtros para la tabla `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Filtros para la tabla `user_posts`
--
ALTER TABLE `user_posts`
  ADD CONSTRAINT `user_posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `user_posts_images`
--
ALTER TABLE `user_posts_images`
  ADD CONSTRAINT `user_posts_images_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `user_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
