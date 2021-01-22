-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2021 at 09:52 AM
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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `building_number` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address_type` enum('office','house','apartment') COLLATE utf8_unicode_ci NOT NULL,
  `street_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `area_zone` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `office_number` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `floor_number` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apartment_number` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `default` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `customer_id`, `building_number`, `longitude`, `latitude`, `address_type`, `street_name`, `area_zone`, `office_number`, `floor_number`, `apartment_number`, `default`) VALUES
(15, 2, '', '21.2373879', '72.9202789', 'apartment', 'test', 'demo', '20', '2', '5', 'N'),
(14, 2, '', '21.2373879', '72.9202789', 'apartment', 'test', 'demo', NULL, '2', '5', 'N'),
(13, 2, '', '21.2373879', '72.9202789', 'house', 'test', 'demo', NULL, '2', NULL, 'N'),
(12, 2, '', '21.2373879', '72.9202789', 'office', 'test', 'demo', NULL, '2', NULL, 'N'),
(11, 2, '', '21.2373879', '72.9202789', 'apartment', 'test', 'demo', NULL, '2', '5', 'N'),
(18, 2, '', '21.2373879', '72.9202789', 'apartment', 'test', 'demo', NULL, NULL, '51', 'Y'),
(19, 2, '20', '21.2373879', '72.9202789', 'apartment', 'test', 'demo', NULL, '2', '51', 'N');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
