-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-09-2020 a las 00:47:14
-- Versión del servidor: 10.3.13-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `longbit_modapp`
--

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
(14, 'Mexicoo', 'Nezahual', '301', '290', '2528', '06090', 1, NULL, 2, NULL),
(15, 'Colombia', 'Neza', '30', '29', NULL, '06900', 1, NULL, NULL, 1),
(20, 'MTY', 'MTY', 'SUR 234534', '386', '3', '58392', 1, NULL, 5, NULL),
(21, 'TJ', 'TJ', 'SUR 234534', '1000', 'A 17', '58392', 1, NULL, NULL, 4);

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
(2, 'longbit', 'longbit@longbit.com', 5529282048, NULL, 'Pruebaaaaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$SnwJG12nxrRc5Ml0KTI8zuRjslzf8lhzM9.hM.IQSSdjVVFrJv4JS', 1, NULL, NULL),
(3, 'Longbit', 'longbit2@longbit.com', 5529282195, 'cagj960308hd5', 'Pruebaaaaa', NULL, 'Empresa de tecnología', 'www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ggYr1Ns1ym8rq11LhaOzfOpbbP46a1ytchlM.USUWT9s40Xop85He', 1, 'longbit@gmail.com', 5534080960),
(5, 'Longbit', 'omaar@gmail.com', 5534081024, 'cagj960308hd5', 'Yo', NULL, 'Empresa de tecnología', 'www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QMVonlnTTO5GYEZqfpKpPO0JIzM6PfFKb5pEcilmFsc07EDIGF9DK', 1, 'longbit@gmail.com', 5534080960),
(6, NULL, 'pruebaomar@gmail.com', 5534081024, NULL, 'Yo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QMVonlnTTO5GYEZqfpKpPO0JIzM6PfFKb5pEcilmFsc07EDIGF9DK', 1, NULL, NULL);

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
(95, 1, NULL, 2, '9:00', '16:00'),
(96, 2, NULL, 2, '11:00', '17:00'),
(97, 3, NULL, 2, '12:00', '15:00'),
(98, 4, NULL, 2, '11:00', '17:00'),
(99, 5, NULL, 2, '9:00', '16:00'),
(100, 6, NULL, 2, '9:00', '16:00'),
(101, 7, NULL, 2, NULL, NULL),
(102, 1, NULL, 4, '9:00', '18:00'),
(103, 2, NULL, 4, '10:00', '13:30'),
(104, 3, NULL, 4, '9:00', '17:00'),
(105, 4, NULL, 4, '10:00', '13:00'),
(106, 5, NULL, 4, '9:00', '18:00'),
(107, 6, NULL, 4, '9:00', '15:00'),
(108, 7, NULL, 4, 'CERRADO', 'CERRADO'),
(116, 1, 2, NULL, '9:00', '18:00'),
(117, 2, 2, NULL, '10:00', '13:30'),
(118, 3, 2, NULL, '9:00', '17:00'),
(119, 4, 2, NULL, '10:00', '13:00'),
(120, 5, 2, NULL, '9:00', '18:00'),
(121, 6, 2, NULL, '9:00', '15:00'),
(122, 7, 2, NULL, 'CERRADO', 'CERRADO');

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
(1, 'Prueba 1', NULL, 'jkdahckljadnadfhjkdmn,f,msdnb', 1, 1),
(2, 'Prueba 2', NULL, 'lkwjdhfkjadnckjashfkljsdn', 1, 5),
(4, 'Omar', NULL, 'Jnmkdnckjdncjkdsnc', 1, 1),
(6, 'POST-MAN', 'https://upload.wikimedia.org/wikipedia/commons/a/af/Tour_eiffel_at_sunrise_from_the_trocadero.jpg', 'Champ de Mars, 5 Avenue Anatole France, 75007 Paris, Francia', 1, 2);

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
  `genre` varchar(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `username`, `mail`, `age`, `password`, `image`, `interest`, `genre`, `status`) VALUES
(1, 'test fullname', 'user.username', 'test@test.com', NULL, '$2y$10$IeS5UkvN4hZI84M77HsU/OJ14JLxMyTvlQ8ASTfdCgXbv21XPjL1.', NULL, NULL, NULL, NULL),
(2, 'test fullname', 'user.username', 'test@test.com', NULL, '$2y$10$lyaont7K1Iv76Pv4HNJsoeC9DK3qLaa/ddecKCt9Ky4CAOmoxYkPu', NULL, NULL, NULL, NULL);

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
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indices de la tabla `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id_day`);

--
-- Indices de la tabla `hour`
--
ALTER TABLE `hour`
  ADD PRIMARY KEY (`id_hour`),
  ADD KEY `id_day` (`id_day`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_store` (`id_store`);

--
-- Indices de la tabla `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id_store`),
  ADD KEY `id_client` (`id_client`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `days`
--
ALTER TABLE `days`
  MODIFY `id_day` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `hour`
--
ALTER TABLE `hour`
  MODIFY `id_hour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `store`
--
ALTER TABLE `store`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
