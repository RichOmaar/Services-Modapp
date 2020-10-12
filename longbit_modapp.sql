-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 12, 2020 at 06:48 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `modapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id_address` int(11) NOT NULL,
  `state` varchar(30) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `street` varchar(40) NOT NULL,
  `number_st` varchar(50) DEFAULT NULL,
  `number_int` varchar(50) DEFAULT NULL,
  `cp` varchar(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `id_user` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `store` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
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
-- Table structure for table `article_features`
--

CREATE TABLE `article_features` (
  `id_articleType` int(11) NOT NULL,
  `id_feature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_features`
--

INSERT INTO `article_features` (`id_articleType`, `id_feature`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_type`
--

CREATE TABLE `article_type` (
  `id_articleType` int(11) NOT NULL,
  `typeName` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_type`
--

INSERT INTO `article_type` (`id_articleType`, `typeName`) VALUES
(1, 'Sudadera'),
(2, 'Pantalón'),
(3, 'Suerter'),
(4, 'Camisa'),
(5, 'Playera');

-- --------------------------------------------------------

--
-- Table structure for table `body`
--

CREATE TABLE `body` (
  `id_body` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `body`
--

INSERT INTO `body` (`id_body`, `name`) VALUES
(1, 'Parte superior'),
(2, 'Parte inferior'),
(3, 'Conjuntos o completos');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `categoryName` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `categoryName`) VALUES
(1, 'Ropa'),
(2, 'Calzado'),
(3, 'Accesorios');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `company_name` varchar(70) DEFAULT NULL,
  `mail` varchar(40) NOT NULL,
  `tel` double DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `name_contact` varchar(70) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(200) DEFAULT NULL,
  `maps` text,
  `puntos` int(5) DEFAULT NULL,
  `noti_flash` int(2) DEFAULT NULL,
  `noti_normal` int(2) DEFAULT NULL,
  `noti_push` int(2) DEFAULT NULL,
  `client_since_date` date DEFAULT NULL,
  `init_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `password` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `company_mail` varchar(40) DEFAULT NULL,
  `company_tel` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `company_name`, `mail`, `tel`, `rfc`, `name_contact`, `product`, `description`, `image`, `maps`, `puntos`, `noti_flash`, `noti_normal`, `noti_push`, `client_since_date`, `init_date`, `end_date`, `password`, `status`, `company_mail`, `company_tel`) VALUES
(1, 'omar', 'juanomcam@gmail.com', NULL, NULL, 'name_contact', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$IzIAXRdHySvZDYf/aYcGE.Rjocm0VFuY/0W2oSohQGT.Z2Al.i5vm', 1, NULL, NULL),
(2, 'longbit', 'longbit@longbit.com', 5529282048, NULL, 'Pruebaaaaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$SnwJG12nxrRc5Ml0KTI8zuRjslzf8lhzM9.hM.IQSSdjVVFrJv4JS', 1, NULL, NULL),
(3, 'Longbit', 'longbit2@longbit.com', 5529282195, 'cagj960308hd5', 'Pruebaaaaa', NULL, 'Empresa de tecnología', 'www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ggYr1Ns1ym8rq11LhaOzfOpbbP46a1ytchlM.USUWT9s40Xop85He', 1, 'longbit@gmail.com', 5534080960),
(5, 'Longbit', 'omaar@gmail.com', 5534081024, 'cagj960308hd5', 'Yo', NULL, 'Empresa de tecnología', 'www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QMVonlnTTO5GYEZqfpKpPO0JIzM6PfFKb5pEcilmFsc07EDIGF9DK', 1, 'longbit@gmail.com', 5534080960),
(6, NULL, 'pruebaomar@gmail.com', 5534081024, NULL, 'Yo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QMVonlnTTO5GYEZqfpKpPO0JIzM6PfFKb5pEcilmFsc07EDIGF9DK', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id_color` int(11) NOT NULL,
  `colorName` varchar(500) DEFAULT NULL,
  `hex` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id_color`, `colorName`, `hex`) VALUES
(5, 'NEGRO', '000000'),
(6, 'NEGRO', '000000'),
(7, 'NEGRO', '000000'),
(8, 'NEGRO', '000000'),
(9, 'NEGRO', '000000'),
(10, 'BLANCO', 'FFFFFF'),
(11, 'BLANCO', 'FFFFFF'),
(12, 'BLANCO', 'FFFFFF'),
(13, 'BLANCO', 'FFFFFF'),
(14, 'BLANCO', 'FFFFFF');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id_day` int(11) NOT NULL,
  `day` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `days`
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
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id_feature` int(11) NOT NULL,
  `featureName` varchar(500) DEFAULT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id_feature`, `featureName`, `value`) VALUES
(1, 'Marca', ''),
(2, 'Materiales', ''),
(3, 'Manga', ''),
(4, 'Largo', '');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id_gender` int(11) NOT NULL,
  `genderName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id_gender`, `genderName`) VALUES
(1, 'Mujer'),
(2, 'Hombre'),
(3, 'Niño'),
(4, 'Niña'),
(5, 'Unisex');

-- --------------------------------------------------------

--
-- Table structure for table `hour`
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
-- Dumping data for table `hour`
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
-- Table structure for table `label_season`
--

CREATE TABLE `label_season` (
  `id_labelSeason` int(11) NOT NULL,
  `seasonName` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `label_season`
--

INSERT INTO `label_season` (`id_labelSeason`, `seasonName`) VALUES
(2, 'Otoño');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id_measurement` int(11) NOT NULL,
  `id_range` int(11) DEFAULT NULL,
  `id_partsClothing` int(11) DEFAULT NULL,
  `id_size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id_measurement`, `id_range`, `id_partsClothing`, `id_size`) VALUES
(46, 5, 1, 1),
(91, 5, 1, 1),
(92, 5, 1, 1),
(93, 5, 1, 1),
(94, 5, 1, 1),
(95, 5, 1, 1),
(96, 5, 1, 1),
(97, 5, 1, 1),
(98, 5, 1, 1),
(99, 5, 1, 1),
(100, 5, 1, 1),
(101, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `parts_clothing`
--

CREATE TABLE `parts_clothing` (
  `id_partsClothing` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parts_clothing`
--

INSERT INTO `parts_clothing` (`id_partsClothing`, `name`) VALUES
(1, 'Hombro');

-- --------------------------------------------------------

--
-- Table structure for table `prints`
--

CREATE TABLE `prints` (
  `id_print` int(11) NOT NULL,
  `printName` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prints`
--

INSERT INTO `prints` (`id_print`, `printName`) VALUES
(2, 'camo verde'),
(3, 'camo'),
(4, 'Animal print'),
(5, 'Animal print'),
(6, 'Animal print'),
(7, 'Animal print'),
(8, 'Animal print'),
(9, 'Animal print'),
(10, 'Animal print'),
(11, 'Animal print'),
(12, 'Animal print');

-- --------------------------------------------------------

--
-- Table structure for table `products`
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
  `id_measurement` int(11) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `productName`, `price`, `avgDiscount`, `priceDiscount`, `id_articleType`, `id_category`, `id_gender`, `id_body`, `labelStyle`, `labelOccasion`, `id_labelSeason`, `id_client`, `id_measurement`, `status`) VALUES
(23, 'Camisa', 100, NULL, 100, 4, 1, 2, 1, 'Prueba8', 'Casual', 2, 1, 92, 1),
(29, 'Camisa', 100, NULL, 100, 4, 1, 2, 1, 'Prueba18', 'Casual', 2, 1, 98, 1),
(30, 'Camisa', 100, NULL, 100, 4, 1, 2, 1, 'Prueba18', 'Casual', 2, 1, 99, 1),
(31, 'Camisa', 100, NULL, 100, 4, 1, 2, 1, 'Prueba18', 'Casual', 2, 1, 100, 1),
(32, 'Camisa', 100, NULL, 100, 4, 1, 2, 1, 'Prueba18', 'Casual', 2, 1, 101, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id_product` int(11) NOT NULL,
  `id_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id_product`, `id_color`) VALUES
(23, 5),
(29, 11),
(30, 12),
(31, 13),
(32, 14);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id_productImage` int(11) NOT NULL,
  `imageUrl` varchar(500) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `ordering` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_print`
--

CREATE TABLE `product_print` (
  `id_product` int(11) NOT NULL,
  `id_print` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_print`
--

INSERT INTO `product_print` (`id_product`, `id_print`) VALUES
(29, 4),
(30, 10),
(31, 11),
(32, 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

CREATE TABLE `product_rating` (
  `id_productRating` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `content` text,
  `rate` int(5) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id_product` int(11) NOT NULL,
  `id_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id_product`, `id_size`) VALUES
(29, 1),
(30, 1),
(31, 1),
(32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ranges`
--

CREATE TABLE `ranges` (
  `id_range` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ranges`
--

INSERT INTO `ranges` (`id_range`, `value`) VALUES
(2, '12-15'),
(5, '16-20');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id_size` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id_size`, `size`) VALUES
(1, 'XS'),
(2, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id_store` int(11) NOT NULL,
  `store_name` varchar(70) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `maps` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id_store`, `store_name`, `image`, `maps`, `status`, `id_client`) VALUES
(1, 'Prueba 1', NULL, 'jkdahckljadnadfhjkdmn,f,msdnb', 1, 1),
(2, 'Prueba 2', NULL, 'lkwjdhfkjadnckjashfkljsdn', 1, 5),
(4, 'Omar', NULL, 'Jnmkdnckjdncjkdsnc', 1, 1),
(6, 'POST-MAN', 'https://upload.wikimedia.org/wikipedia/commons/a/af/Tour_eiffel_at_sunrise_from_the_trocadero.jpg', 'Champ de Mars, 5 Avenue Anatole France, 75007 Paris, Francia', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `store_product`
--

CREATE TABLE `store_product` (
  `id_storeProduct` int(11) NOT NULL,
  `id_store` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_size` int(11) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_product`
--

INSERT INTO `store_product` (`id_storeProduct`, `id_store`, `id_product`, `id_size`, `quantity`, `date`) VALUES
(3, 6, 29, 1, 20, '2020-10-11 23:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(75) DEFAULT NULL,
  `username` varchar(75) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `age` varchar(2) DEFAULT NULL,
  `password` text,
  `image` varchar(200) DEFAULT NULL,
  `interest` varchar(30) DEFAULT NULL,
  `genre` varchar(1) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `username`, `mail`, `age`, `password`, `image`, `interest`, `genre`, `status`) VALUES
(1, 'test fullname', 'user.username', 'test@test.com', NULL, '$2y$10$IeS5UkvN4hZI84M77HsU/OJ14JLxMyTvlQ8ASTfdCgXbv21XPjL1.', NULL, NULL, NULL, NULL),
(2, 'test fullname', 'user.username', 'test@test.com', NULL, '$2y$10$lyaont7K1Iv76Pv4HNJsoeC9DK3qLaa/ddecKCt9Ky4CAOmoxYkPu', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `store` (`store`);

--
-- Indexes for table `article_features`
--
ALTER TABLE `article_features`
  ADD PRIMARY KEY (`id_articleType`,`id_feature`),
  ADD KEY `id_feature` (`id_feature`);

--
-- Indexes for table `article_type`
--
ALTER TABLE `article_type`
  ADD PRIMARY KEY (`id_articleType`);

--
-- Indexes for table `body`
--
ALTER TABLE `body`
  ADD PRIMARY KEY (`id_body`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id_color`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id_day`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id_feature`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id_gender`);

--
-- Indexes for table `hour`
--
ALTER TABLE `hour`
  ADD PRIMARY KEY (`id_hour`),
  ADD KEY `id_day` (`id_day`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_store` (`id_store`);

--
-- Indexes for table `label_season`
--
ALTER TABLE `label_season`
  ADD PRIMARY KEY (`id_labelSeason`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id_measurement`),
  ADD KEY `id_range` (`id_range`),
  ADD KEY `id_partsClothing` (`id_partsClothing`),
  ADD KEY `id_size` (`id_size`);

--
-- Indexes for table `parts_clothing`
--
ALTER TABLE `parts_clothing`
  ADD PRIMARY KEY (`id_partsClothing`);

--
-- Indexes for table `prints`
--
ALTER TABLE `prints`
  ADD PRIMARY KEY (`id_print`);

--
-- Indexes for table `products`
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
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id_product`,`id_color`),
  ADD KEY `id_color` (`id_color`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id_productImage`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product_print`
--
ALTER TABLE `product_print`
  ADD PRIMARY KEY (`id_product`,`id_print`),
  ADD KEY `id_print` (`id_print`);

--
-- Indexes for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD PRIMARY KEY (`id_productRating`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id_product`,`id_size`),
  ADD KEY `id_size` (`id_size`);

--
-- Indexes for table `ranges`
--
ALTER TABLE `ranges`
  ADD PRIMARY KEY (`id_range`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id_size`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id_store`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `store_product`
--
ALTER TABLE `store_product`
  ADD PRIMARY KEY (`id_storeProduct`),
  ADD KEY `id_store` (`id_store`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_size` (`id_size`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `article_type`
--
ALTER TABLE `article_type`
  MODIFY `id_articleType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `body`
--
ALTER TABLE `body`
  MODIFY `id_body` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id_day` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id_feature` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id_gender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hour`
--
ALTER TABLE `hour`
  MODIFY `id_hour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `label_season`
--
ALTER TABLE `label_season`
  MODIFY `id_labelSeason` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id_measurement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `parts_clothing`
--
ALTER TABLE `parts_clothing`
  MODIFY `id_partsClothing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prints`
--
ALTER TABLE `prints`
  MODIFY `id_print` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id_productImage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_rating`
--
ALTER TABLE `product_rating`
  MODIFY `id_productRating` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ranges`
--
ALTER TABLE `ranges`
  MODIFY `id_range` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store_product`
--
ALTER TABLE `store_product`
  MODIFY `id_storeProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `address_ibfk_3` FOREIGN KEY (`store`) REFERENCES `store` (`id_store`);

--
-- Constraints for table `article_features`
--
ALTER TABLE `article_features`
  ADD CONSTRAINT `article_features_ibfk_1` FOREIGN KEY (`id_articleType`) REFERENCES `article_type` (`id_articleType`),
  ADD CONSTRAINT `article_features_ibfk_2` FOREIGN KEY (`id_feature`) REFERENCES `features` (`id_feature`);

--
-- Constraints for table `hour`
--
ALTER TABLE `hour`
  ADD CONSTRAINT `hour_ibfk_1` FOREIGN KEY (`id_day`) REFERENCES `days` (`id_day`),
  ADD CONSTRAINT `hour_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `hour_ibfk_3` FOREIGN KEY (`id_store`) REFERENCES `store` (`id_store`);

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_ibfk_1` FOREIGN KEY (`id_range`) REFERENCES `ranges` (`id_range`),
  ADD CONSTRAINT `measurements_ibfk_2` FOREIGN KEY (`id_partsClothing`) REFERENCES `parts_clothing` (`id_partsClothing`),
  ADD CONSTRAINT `measurements_ibfk_3` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id_size`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_articleType`) REFERENCES `article_type` (`id_articleType`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`id_gender`) REFERENCES `gender` (`id_gender`),
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`id_body`) REFERENCES `body` (`id_body`),
  ADD CONSTRAINT `products_ibfk_5` FOREIGN KEY (`id_labelSeason`) REFERENCES `label_season` (`id_labelSeason`),
  ADD CONSTRAINT `products_ibfk_6` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `products_ibfk_7` FOREIGN KEY (`id_measurement`) REFERENCES `measurements` (`id_measurement`);

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `product_color_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `colors` (`id_color`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `product_print`
--
ALTER TABLE `product_print`
  ADD CONSTRAINT `product_print_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `product_print_ibfk_2` FOREIGN KEY (`id_print`) REFERENCES `prints` (`id_print`);

--
-- Constraints for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD CONSTRAINT `product_rating_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `product_rating_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id_size`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Constraints for table `store_product`
--
ALTER TABLE `store_product`
  ADD CONSTRAINT `store_product_ibfk_1` FOREIGN KEY (`id_store`) REFERENCES `store` (`id_store`),
  ADD CONSTRAINT `store_product_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `store_product_ibfk_3` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id_size`);
