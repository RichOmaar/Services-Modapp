-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 10, 2020 at 10:26 PM
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
  `state` varchar(30) DEFAULT NULL,
  `municipio` varchar(50) DEFAULT NULL,
  `street` varchar(40) DEFAULT NULL,
  `number_st` varchar(7) DEFAULT NULL,
  `number_int` varchar(7) DEFAULT NULL,
  `cp` int(10) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `company_name` varchar(70) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `tel` int(10) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `name_contact` varchar(70) NOT NULL,
  `product` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `maps` text NOT NULL,
  `puntos` int(5) DEFAULT NULL,
  `noti_flash` int(2) DEFAULT NULL,
  `noti_normal` int(2) DEFAULT NULL,
  `noti_push` int(2) DEFAULT NULL,
  `client_since_date` date NOT NULL,
  `init_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `password` text NOT NULL,
  `status` int(1) NOT NULL,
  `id_address` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client_hours`
--

CREATE TABLE `client_hours` (
  `id_clientHours` int(11) NOT NULL,
  `id_hourDay` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id_days` int(11) NOT NULL,
  `start_day` varchar(10) DEFAULT NULL,
  `end_day` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE `hours` (
  `id_hours` int(11) NOT NULL,
  `open_hour` time DEFAULT NULL,
  `close_hour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hour_day`
--

CREATE TABLE `hour_day` (
  `id_hourDay` int(11) NOT NULL,
  `id_days` int(11) DEFAULT NULL,
  `id_hours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id_store` int(11) NOT NULL,
  `store_name` varchar(70) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `maps` text NOT NULL,
  `status` int(1) NOT NULL,
  `id_address` int(11) DEFAULT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_hours`
--

CREATE TABLE `store_hours` (
  `id_storeHours` int(11) NOT NULL,
  `id_hourDay` int(11) DEFAULT NULL,
  `id_store` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status` int(1) DEFAULT NULL,
  `id_address` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_address` (`id_address`);

--
-- Indexes for table `client_hours`
--
ALTER TABLE `client_hours`
  ADD PRIMARY KEY (`id_clientHours`),
  ADD KEY `id_hourDay` (`id_hourDay`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id_days`);

--
-- Indexes for table `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`id_hours`);

--
-- Indexes for table `hour_day`
--
ALTER TABLE `hour_day`
  ADD PRIMARY KEY (`id_hourDay`),
  ADD KEY `id_days` (`id_days`),
  ADD KEY `id_hours` (`id_hours`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id_store`),
  ADD KEY `id_address` (`id_address`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `store_hours`
--
ALTER TABLE `store_hours`
  ADD PRIMARY KEY (`id_storeHours`),
  ADD KEY `id_hourDay` (`id_hourDay`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_address` (`id_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_hours`
--
ALTER TABLE `client_hours`
  MODIFY `id_clientHours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id_days` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hours`
--
ALTER TABLE `hours`
  MODIFY `id_hours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hour_day`
--
ALTER TABLE `hour_day`
  MODIFY `id_hourDay` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_hours`
--
ALTER TABLE `store_hours`
  MODIFY `id_storeHours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_address`) REFERENCES `address` (`id_address`);

--
-- Constraints for table `client_hours`
--
ALTER TABLE `client_hours`
  ADD CONSTRAINT `client_hours_ibfk_1` FOREIGN KEY (`id_hourDay`) REFERENCES `hour_day` (`id_hourDay`),
  ADD CONSTRAINT `client_hours_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Constraints for table `hour_day`
--
ALTER TABLE `hour_day`
  ADD CONSTRAINT `hour_day_ibfk_1` FOREIGN KEY (`id_days`) REFERENCES `days` (`id_days`),
  ADD CONSTRAINT `hour_day_ibfk_2` FOREIGN KEY (`id_hours`) REFERENCES `hours` (`id_hours`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`id_address`) REFERENCES `address` (`id_address`),
  ADD CONSTRAINT `store_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Constraints for table `store_hours`
--
ALTER TABLE `store_hours`
  ADD CONSTRAINT `store_hours_ibfk_1` FOREIGN KEY (`id_hourDay`) REFERENCES `hour_day` (`id_hourDay`),
  ADD CONSTRAINT `store_hours_ibfk_2` FOREIGN KEY (`id_storeHours`) REFERENCES `store` (`id_store`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_address`) REFERENCES `address` (`id_address`);