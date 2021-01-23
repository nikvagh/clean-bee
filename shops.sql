-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2021 at 09:00 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cleanbee`
--

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `shop_name` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `range_in_km` varchar(10) NOT NULL,
  `cleanbee_percentage` varchar(10) NOT NULL,
  `delivery_fee` double(20,2) NOT NULL,
  `address` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `minimum_order` varchar(150) NOT NULL,
  `24hrs` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N',
  `freedelivery` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `vendor_id`, `shop_name`, `phone`, `description`, `opening_time`, `closing_time`, `latitude`, `longitude`, `range_in_km`, `cleanbee_percentage`, `delivery_fee`, `address`, `image`, `minimum_order`, `24hrs`, `freedelivery`, `created_at`, `updated_at`) VALUES
(1, 1, 'shop1', '123456789', 'shop des1', '04:00:00', '06:00:00', '25.2617', '72.1596', '10', '5', 0.00, 'test addres 1', '1600335512_7735_QL-G-QG-060403.jpg', 'QAR 30', 'Y', 'N', '2020-09-18 18:23:59', '2020-09-18 18:23:59'),
(2, 2, 'shop2', '123456789', 'shop des 2', '09:00:00', '10:00:00', '25.2323', '73.256', '20', '7', 0.00, 'test address 2', '1601470906_4286.JPG', 'QAR 20', 'N', 'Y', '2020-09-18 18:23:59', '2020-09-18 18:23:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
