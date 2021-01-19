-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2021 at 10:10 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

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
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` mediumtext NOT NULL,
  `img` mediumtext NOT NULL,
  `target` mediumtext NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `img`, `target`, `status`, `created_at`, `updated_at`) VALUES
(12, 's', '1602506515_00427_HD.JPG', 'www.ghfghfgh', 'Enable', '2020-10-12 12:41:55', '2020-10-12 18:11:55'),
(11, 'dsfdsf', '1602506504_5986_MC-G-TY-129.jpg', 'www.ghfghfgh', 'Enable', '2020-10-12 12:41:44', '2020-10-12 18:11:44'),
(5, 'dsfdsf', '1602510386_5908_MC-G-FJ-606.jpg', 'www.fhfhfgh.fg', 'Disable', '2020-10-12 05:21:11', '2020-10-12 01:46:26'),
(10, 'dfg', '1602503648_4286.JPG', 'www.ghfgh', 'Disable', '2020-10-12 11:54:08', '2020-10-12 17:24:08'),
(13, 'artre', '1602507944_14768_CG-G-DC-105.jpg', 'http://ghfghfgh', 'Enable', '2020-10-12 13:05:44', '2020-10-12 18:35:44'),
(14, 'test tset', '1602511014_6312_MC-G-RW-396.jpg', 'http://ghfghfgh', 'Enable', '2020-10-12 13:56:54', '2020-10-12 19:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `capabilities`
--

DROP TABLE IF EXISTS `capabilities`;
CREATE TABLE IF NOT EXISTS `capabilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `arabic_name` varchar(200) NOT NULL,
  `laundry_id` int(11) NOT NULL,
  `image` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`id`, `name`, `arabic_name`, `laundry_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Iron', 'كوي', 1, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(2, 'Wash & Iron', 'Wash & Iron', 1, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(3, 'Dry clean', 'Dry clean', 1, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(4, 'Iron', 'Iron', 2, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(5, 'Wash & Iron', 'Wash & Iron', 2, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(6, 'Dry clean', 'Dry clean', 2, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `card_number` varchar(200) NOT NULL,
  `expiry_date` date NOT NULL,
  `cvv` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `laundry_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ss_ids` mediumtext NOT NULL,
  `price` double(20,2) NOT NULL,
  `price_total` double(20,2) NOT NULL,
  `removed` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y,N',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `laundry_id`, `qty`, `ss_ids`, `price`, `price_total`, `removed`, `created_at`, `updated_at`) VALUES
(15, 1, 1, 11, '2,1', 30.00, 330.00, 'N', '2020-09-28 18:47:52', '2021-01-19 05:34:00'),
(14, 1, 2, 3, '1', 10.00, 30.00, 'N', '2020-09-28 18:47:52', '2021-01-19 05:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `page_type` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `currency_name`) VALUES
(1, 'QAR');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `img` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `phone_varified` enum('true','false') NOT NULL COMMENT 'true,false',
  `email_varified` enum('true','false') NOT NULL DEFAULT 'false',
  `confirmed_at` datetime DEFAULT NULL,
  `refer_from` int(11) NOT NULL,
  `wallet` double(20,2) NOT NULL,
  `login_provider` enum('normal','google','fb','apple_id') NOT NULL DEFAULT 'normal' COMMENT 'normal,google,fb,apple_id',
  `provider_token` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `firstname`, `lastname`, `username`, `img`, `address`, `phone_varified`, `email_varified`, `confirmed_at`, `refer_from`, `wallet`, `login_provider`, `provider_token`) VALUES
(1, 1, 'nikul2', 'vag', 'test_user', '', '', 'true', 'false', NULL, 0, 68.00, 'normal', ''),
(2, 2, 'nikul2', 'vag', 'username1', '1601470906_4286.JPG', 'username1', 'true', 'false', NULL, 0, 0.00, 'normal', ''),
(3, 6, 'nikul', 'kartum', 'nikul', '', '', 'true', 'false', NULL, 0, 0.00, 'normal', ''),
(4, 7, 'nikul', 'kartum', 'nikul', '', '', 'false', 'false', NULL, 0, 0.00, 'google', 'ss'),
(5, 8, 'nikul', 'kartum', 'nikul', '', '', 'false', 'false', NULL, 0, 0.00, 'google', 'ss1'),
(6, 9, 'nikul1', 'kartum1', 'nikul1', '', '', 'true', 'false', NULL, 0, 0.00, 'normal', '');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `discount_type` enum('percentage','value') NOT NULL,
  `percentage` varchar(10) NOT NULL,
  `value` double(20,2) NOT NULL,
  `applied_to` enum('1','2','3') NOT NULL COMMENT '1=sub_total,\r\n2=grand_total,\r\n3=delivery_fee',
  `send_push_notification` enum('Y','N') NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `vendors` mediumtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `discount_type`, `percentage`, `value`, `applied_to`, `send_push_notification`, `expiry_date`, `vendors`, `created_at`, `updated_at`) VALUES
(1, 'test10', 'percentage', '10', 0.00, '2', 'Y', '2020-09-07 19:25:36', '1,9', '2020-09-24 19:14:41', '2020-09-24 19:14:41'),
(2, 'test20', 'value', '0', 20.00, '1', 'N', '2020-10-13 19:25:55', '5,3,2,3,9', '2020-09-24 19:14:41', '2020-09-24 19:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `laundries`
--

DROP TABLE IF EXISTS `laundries`;
CREATE TABLE IF NOT EXISTS `laundries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `arabic_name` varchar(200) NOT NULL,
  `does_require_car` enum('Y','N') NOT NULL,
  `sort_order` int(11) NOT NULL,
  `image` mediumtext NOT NULL,
  `specification` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `laundries`
--

INSERT INTO `laundries` (`id`, `name`, `arabic_name`, `does_require_car`, `sort_order`, `image`, `specification`, `created_at`, `updated_at`) VALUES
(1, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(2, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(3, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(4, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(5, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(6, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(7, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(8, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(9, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(10, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(11, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(12, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(13, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(14, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(15, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(16, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(17, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(18, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(19, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(20, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(21, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(22, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(23, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(24, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(25, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(26, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(27, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(28, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(29, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(30, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(31, 'thobe', '', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(32, 'wool thobe', 'wool thobe', 'N', 0, '', '', '2020-09-18 00:00:00', '2020-09-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` mediumtext NOT NULL,
  `message` mediumtext NOT NULL,
  `is_new` enum('true','false') NOT NULL DEFAULT 'true' COMMENT 'true,false',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_new`, `created_at`, `updated_at`) VALUES
(1, 2, 'tset tet s', 'messg', 'false', '2020-09-18 17:17:03', '2020-09-29 15:21:31'),
(2, 2, 'test title 2', 'msg 2', 'false', '2020-09-18 17:17:03', '2020-09-29 15:23:29'),
(3, 4, 'test title 2', 'msg 2', 'false', '2020-09-18 17:17:03', '2020-09-29 15:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `order_type` varchar(200) NOT NULL,
  `pick_location` varchar(200) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_hour` varchar(10) NOT NULL,
  `pickup_time` varchar(10) NOT NULL,
  `drop_location` mediumtext NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_hour` varchar(10) NOT NULL,
  `delivery_time` varchar(10) NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_cost` double(20,2) NOT NULL,
  `delivery_fee` double(20,2) NOT NULL,
  `pick_lat` varchar(50) NOT NULL,
  `pick_lng` varchar(50) NOT NULL,
  `shop_lat` varchar(50) NOT NULL,
  `shop_lng` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `rider_id`, `shop_id`, `order_type`, `pick_location`, `pickup_date`, `pickup_hour`, `pickup_time`, `drop_location`, `delivery_date`, `delivery_hour`, `delivery_time`, `order_status`, `order_cost`, `delivery_fee`, `pick_lat`, `pick_lng`, `shop_lat`, `shop_lng`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, 'standard', '10. western view. apt.', '2020-10-12', '20', '30', '', '2020-10-15', '15', '06', 1, 45.00, 5.00, '22.02151', '52.02151', '52.02151', '52.15525', '2020-09-25 16:58:57', '2020-09-25 16:58:57'),
(2, 1, 0, 1, 'standard', '10. western view. apt.', '2020-10-12', '20', '30', '', '2020-10-15', '15', '06', 12, 45.00, 5.00, '22.02151', '52.02151', '52.02151', '52.15525', '2020-09-25 17:00:46', '2020-09-25 17:00:46'),
(3, 1, 0, 1, 'standard', '10. western view. apt.', '2020-10-12', '20', '30', '', '2020-10-15', '15', '06', 1, 45.00, 5.00, '22.02151', '52.02151', '52.02151', '52.15525', '2020-09-25 17:00:54', '2020-09-25 17:00:54'),
(4, 1, 0, 1, 'standard', '10. western view. apt.', '2020-10-12', '20', '30', '', '2020-10-15', '15', '06', 1, 45.00, 5.00, '22.02151', '52.02151', '52.02151', '52.15525', '2020-09-25 17:01:04', NULL),
(5, 1, 1, 1, 'standard', '10. western view. apt.', '2020-10-12', '20', '30', '', '2020-10-15', '15', '06', 1, 45.00, 5.00, '22.02151', '52.02151', '52.02151', '52.15525', '2020-09-28 12:43:51', NULL),
(6, 1, 1, 1, 'standard', '10. western view. apt.', '2020-09-29', '20', '30', '', '2020-10-15', '15', '06', 3, 45.00, 5.00, '22.02151', '52.02151', '52.02151', '52.15525', '2020-09-28 16:16:15', '2020-09-29 16:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `order_additional_info`
--

DROP TABLE IF EXISTS `order_additional_info`;
CREATE TABLE IF NOT EXISTS `order_additional_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `street_no` varchar(100) NOT NULL,
  `house_building_no` varchar(100) NOT NULL,
  `appartment_office_name` varchar(200) NOT NULL,
  `floor` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `laundry_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ss_ids` mediumtext NOT NULL,
  `price` double(20,2) NOT NULL,
  `price_total` double(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `laundry_id`, `qty`, `ss_ids`, `price`, `price_total`) VALUES
(1, 0, 2, 3, '1', 10.00, 30.00),
(2, 0, 1, 8, '2,1', 30.00, 240.00),
(3, 1, 2, 3, '1', 10.00, 30.00),
(4, 1, 1, 8, '2,1', 30.00, 240.00),
(5, 2, 2, 3, '1', 10.00, 30.00),
(6, 2, 1, 8, '2,1', 30.00, 240.00),
(7, 3, 2, 3, '1', 10.00, 30.00),
(8, 3, 1, 8, '2,1', 30.00, 240.00),
(9, 4, 2, 3, '1', 10.00, 30.00),
(10, 4, 1, 8, '2,1', 30.00, 240.00),
(11, 5, 2, 3, '1', 10.00, 30.00),
(12, 5, 1, 8, '2,1', 30.00, 240.00),
(13, 6, 2, 9, '1', 10.00, 90.00),
(14, 6, 1, 24, '2,1', 30.00, 720.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_rating`
--

DROP TABLE IF EXISTS `order_rating`;
CREATE TABLE IF NOT EXISTS `order_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `star` float NOT NULL,
  `reason_id` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_rating`
--

INSERT INTO `order_rating` (`id`, `order_id`, `star`, `reason_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 0, '', '2020-09-28 17:07:52', NULL),
(2, 1, 2, 1, 'tets', '2020-09-29 07:51:16', NULL),
(3, 3, 2, 1, '', '2020-09-29 07:52:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_code` varchar(100) NOT NULL,
  `status_title` varchar(150) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `sort_code` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status_code`, `status_title`, `status`, `sort_code`, `created_at`, `updated_at`) VALUES
(1, 'pending', 'pending', 'Enable', 0, '2020-09-25 13:06:41', '2020-09-25 13:06:41'),
(2, 'assigned', 'assigned', 'Enable', 0, '2020-09-25 13:06:41', '2020-09-25 13:06:41'),
(3, 'start', 'start', 'Enable', 0, '2020-09-25 13:06:41', '2020-09-25 13:06:41'),
(4, 'picked_up_from_customer', 'picked_up_from_customer', 'Enable', 0, '2020-09-25 13:06:41', '2020-09-25 13:06:41'),
(5, 'dropped_to_vendor', 'dropped_to_vendor', 'Enable', 0, '2020-09-25 13:06:41', '2020-09-25 13:06:41'),
(6, 'processing_completed', 'processing_completed', 'Enable', 0, '2020-09-25 13:06:41', '2020-09-25 13:06:41'),
(7, 'ready_to_deliver', 'ready_to_deliver', 'Enable', 0, '2020-09-25 13:06:41', '2020-09-25 13:06:41'),
(8, 'start_to_vendor', 'start_to_vendor', 'Enable', 0, '2020-09-25 13:06:41', '2020-09-25 13:06:41'),
(9, 'picked_up_from_vendor', 'picked_up_from_vendor', 'Enable', 0, '2020-09-25 13:08:22', '2020-09-25 13:08:22'),
(10, 'dropped_to_customer', 'dropped_to_customer', 'Enable', 0, '2020-09-25 13:08:22', '2020-09-25 13:08:22'),
(11, 'completed', 'completed', 'Enable', 0, '2020-09-25 13:08:22', '2020-09-25 13:08:22'),
(12, 'cancel', 'cancel', 'Enable', 0, '2020-09-25 13:08:22', '2020-09-25 13:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

DROP TABLE IF EXISTS `otps`;
CREATE TABLE IF NOT EXISTS `otps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL,
  `otp` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `phone`, `otp`) VALUES
(7, '123456', '1234'),
(4, '1234567', '1234'),
(6, '1234562', '1234'),
(11, '1234567898', '1234'),
(14, '1234567899', '1234'),
(15, '123456789', '1234'),
(16, '123456719', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `payment_token` mediumtext NOT NULL,
  `fill_name` varchar(200) NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `net_amount` double(20,2) NOT NULL,
  `paypal_fee` double(20,2) NOT NULL,
  `email` varchar(200) NOT NULL,
  `payment_type` varchar(50) NOT NULL COMMENT 'credit_card,cash,wallet',
  `date_received` datetime NOT NULL,
  `address` mediumtext NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL COMMENT 'paid,pending,failed',
  `order_amount` double(20,2) NOT NULL,
  `discount` double(20,2) NOT NULL,
  `delivery_fee` double(20,2) NOT NULL,
  `online_payment_commision` double(20,2) NOT NULL,
  `payable_amount_to_shop` double(20,2) NOT NULL,
  `commission_amount` double(20,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `shop_id`, `payment_token`, `fill_name`, `total_amount`, `net_amount`, `paypal_fee`, `email`, `payment_type`, `date_received`, `address`, `status`, `order_amount`, `discount`, `delivery_fee`, `online_payment_commision`, `payable_amount_to_shop`, `commission_amount`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'token', 'nik test@gmail.com', 45.00, 45.00, 0.00, 'test@gmail.com', 'credit_card', '2020-09-25 17:01:04', 'testt test', 'paid', 40.00, 0.00, 5.00, 0.00, 42.75, 2.25, '2020-09-25 17:01:04', '2020-09-25 19:31:04'),
(2, 5, 1, 'token', 'nik test@gmail.com', 45.00, 45.00, 0.00, 'test@gmail.com', 'credit_card', '2020-09-28 12:43:51', 'testt test', 'paid', 40.00, 0.00, 5.00, 0.00, 42.75, 2.25, '2020-09-28 12:43:51', '2020-09-28 15:13:51'),
(3, 6, 1, 'token', 'nik test@gmail.com', 45.00, 45.00, 0.00, 'test@gmail.com', 'credit_card', '2020-09-28 16:16:15', 'testt test', 'paid', 40.00, 0.00, 5.00, 0.00, 42.75, 2.25, '2020-09-28 16:16:15', '2020-09-28 18:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(17, 'dsfdsf', 152, '2020-09-16 04:58:27', NULL),
(18, 'dd', 125, '2020-09-16 04:58:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_reasons`
--

DROP TABLE IF EXISTS `review_reasons`;
CREATE TABLE IF NOT EXISTS `review_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review_reasons`
--

INSERT INTO `review_reasons` (`id`, `description`) VALUES
(1, 'bad service'),
(2, 'bad service 1');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

DROP TABLE IF EXISTS `riders`;
CREATE TABLE IF NOT EXISTS `riders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rider_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `img` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `ride_type` enum('car','bike') NOT NULL COMMENT 'car,bike',
  `phone_varified` enum('true','false') NOT NULL COMMENT 'true,false	',
  `email_varified` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'true,false	',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`id`, `rider_id`, `firstname`, `lastname`, `img`, `address`, `ride_type`, `phone_varified`, `email_varified`) VALUES
(1, 4, 'nik rider', 'nik rider', '1601376833_6883_QR-G-RW-23.jpg', 'addresss test rider', 'bike', 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `rider_activity_statuses`
--

DROP TABLE IF EXISTS `rider_activity_statuses`;
CREATE TABLE IF NOT EXISTS `rider_activity_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rider_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00'),
(2, 'vendor', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00'),
(3, 'customer', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00'),
(4, 'rider', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00'),
(5, 'super_admin', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_area_request`
--

DROP TABLE IF EXISTS `service_area_request`;
CREATE TABLE IF NOT EXISTS `service_area_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` mediumtext NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_area_request`
--

INSERT INTO `service_area_request` (`id`, `email`, `phone`, `address`, `latitude`, `longitude`) VALUES
(1, 'test@gmail.com', '123456789', '3, main tst dgtessjd,s', '25.225452', '24.121522'),
(2, 'test@gmail.com', '123456789', '3, main tst dgtessjd,s', '25.225452', '24.121522'),
(3, 'test123@gmail.com', '12563412', 'test address', '25.3651', '25.1452'),
(4, 'test123@gmail.com', '12563412', 'test address', '25.3651', '25.1452');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `vendor_id`, `shop_name`, `phone`, `description`, `opening_time`, `closing_time`, `latitude`, `longitude`, `range_in_km`, `cleanbee_percentage`, `delivery_fee`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'shop1', '123456789', 'shop des1', '04:00:00', '06:00:00', '25.2617', '72.1596', '10', '5', 0.00, 'test addres 1', '', '2020-09-18 18:23:59', '2020-09-18 18:23:59'),
(2, 2, 'shop2', '123456789', 'shop des 2', '09:00:00', '10:00:00', '25.2323', '73.256', '20', '7', 0.00, 'test address 2', '', '2020-09-18 18:23:59', '2020-09-18 18:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `shop_favourite`
--

DROP TABLE IF EXISTS `shop_favourite`;
CREATE TABLE IF NOT EXISTS `shop_favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_favourite`
--

INSERT INTO `shop_favourite` (`id`, `shop_id`, `user_id`) VALUES
(4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_ratings`
--

DROP TABLE IF EXISTS `shop_ratings`;
CREATE TABLE IF NOT EXISTS `shop_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_ratings`
--

INSERT INTO `shop_ratings` (`id`, `shop_id`, `user_id`, `rate`) VALUES
(1, 1, 1, 2.6),
(2, 1, 2, 2.3),
(3, 1, 3, 5),
(4, 1, 4, 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `shop_services`
--

DROP TABLE IF EXISTS `shop_services`;
CREATE TABLE IF NOT EXISTS `shop_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `laundry_id` int(11) NOT NULL,
  `capability_id` int(11) NOT NULL,
  `standard_amt` double(20,2) NOT NULL,
  `urgent_amt` double(20,2) NOT NULL,
  `currency` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_services`
--

INSERT INTO `shop_services` (`id`, `shop_id`, `laundry_id`, `capability_id`, `standard_amt`, `urgent_amt`, `currency`) VALUES
(1, 1, 2, 4, 10.00, 15.00, 1),
(2, 1, 2, 5, 20.00, 22.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

DROP TABLE IF EXISTS `slots`;
CREATE TABLE IF NOT EXISTS `slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `available` enum('Y','N') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `start_time`, `end_time`, `available`, `created_at`, `updated_at`) VALUES
(1, '24:50:18', '17:45:18', 'Y', '2020-09-18 17:52:42', '2020-09-18 17:52:42'),
(2, '10:50:18', '17:45:18', 'Y', '2020-09-18 17:52:49', '2020-09-18 17:52:49'),
(3, '19:50:18', '21:50:18', 'Y', '2020-09-18 17:52:49', '2020-09-18 17:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `token` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '1=admin 2=vendor 3=customer 4=rider 5=super_admin',
  `privileges` mediumtext NOT NULL,
  `token` mediumtext NOT NULL,
  `device_token` mediumtext NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `password`, `role_id`, `privileges`, `token`, `device_token`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, '1234562', 'nikul2vaghani@gmail.com', '1234567', 3, '', 'ruU53PBvz0njYCI2Gtkb', '', 'Enable', NULL, '2020-09-17 12:07:04', '2020-09-17 12:07:04'),
(2, '123456', 'nikul222@gmail.com', '123456', 3, '', 'YQnjzha8FSB2oPRApL3c', '', 'Enable', NULL, '2020-09-17 12:09:50', '2020-09-29 09:40:18'),
(5, '1234567899', 'admin@gmail.com', '123456', 5, '', '', '', 'Enable', '2020-09-30 12:50:51', '2020-09-30 10:00:53', '2020-09-30 10:00:53'),
(3, '123456', 'vendor@gmail.com', '123456', 2, '', '1yRpCa40KdfLEbnuJOUG', '', 'Enable', NULL, '2020-09-17 12:09:50', '2020-09-17 10:19:48'),
(4, '1234567899', 'rider@gmail.com', '123456', 4, '', 'CJFHEATdvs2MpG0PS8ai', '', 'Enable', NULL, '2020-09-17 12:09:50', '2020-09-29 14:13:00'),
(7, '123456789', 'nikul21@kartuminfotech.com', '', 3, '', 'oRusFaipJZDKrVtz852c', '', 'Enable', NULL, '2020-10-05 12:28:25', '2020-10-05 12:28:25'),
(6, '123456789', 'nikul@kartuminfotech.com', '123456', 3, '', 'Z8ifqHkhu69tAasQnl1p', '', 'Enable', NULL, '2020-10-05 10:13:38', '2020-10-05 10:13:38'),
(8, '123456789', 'nikul21@kartuminfotech.com', '', 3, '', 'ej4Zm6nDPSJy3GtHdI5Y', '', 'Enable', NULL, '2020-10-05 12:36:28', '2020-10-05 12:36:28'),
(9, '123456719', 'nikul1@kartuminfotech.com', '123456', 3, '', 'PB8gz3ampbNtf9FZevCq', '123456', 'Enable', NULL, '2021-01-16 11:47:19', '2021-01-16 11:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `confirmed_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_id`, `name`, `confirmed_at`) VALUES
(1, 3, 'vendor test', '2020-09-15 19:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payments`
--

DROP TABLE IF EXISTS `vendor_payments`;
CREATE TABLE IF NOT EXISTS `vendor_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_history`
--

DROP TABLE IF EXISTS `wallet_history`;
CREATE TABLE IF NOT EXISTS `wallet_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `operation_type` enum('credit','debit') NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wallet_history`
--

INSERT INTO `wallet_history` (`id`, `user_id`, `amount`, `operation_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, -5.00, 'credit', 'Add credit to wallet by customer', '2020-09-25 11:39:08', '2020-09-25 11:39:08'),
(2, 1, 6.00, 'credit', 'Add credit to wallet by customer', '2020-09-25 11:39:13', '2020-09-25 11:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

DROP TABLE IF EXISTS `web_config`;
CREATE TABLE IF NOT EXISTS `web_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` mediumtext NOT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`config_name`, `config_value`) VALUES
('meta_keyword', ''),
('sidepanel_block_title', '-'),
('meta_description', ''),
('site_name', 'Clean Bee'),
('page_size', ''),
('powered_by', 'Powered by <a href=\"#\" target=\"_blank\" class=\"fotertext\">Nehal Mistry</a>'),
('company_copyright', 'Copyright © Clean Bee services. All rights reserved'),
('meta_title', 'Sicanet'),
('from_email_address', 'cleanbee@gmail.com'),
('company_name', 'Clean Bee'),
('company_address', '52, Naist Prisam, op.MS House'),
('company_mobile', '1234567891'),
('company_email', 'cleanbee@gmail.com'),
('template', 'default'),
('usa_cell', '0'),
('india_cell', '0'),
('company_phone1', '-'),
('company_phone2', '-'),
('fb_link', ''),
('twit_link', ''),
('linked_link', ''),
('city', 'Surat'),
('about_us', 'Established in 2010 is a globally renowned manufacturer of Farm Equipment under the brand name SHUBH. Synonymous with quality and durability SHUBH is a brand of choice amongst farmers in India and 40 other countries. Company`s diverse range of products include BANZO Tillers, Hade waster lifting tailer. etc. Marked by more than three decades of experience, we have been contributing to agricultural growth of the country by providing innovative implements at Most affordable prices. With our pursuit to perfection in all the spheres of the business, we have made a strong presence in domestic as well as overseas market. Our state-of-the-art manufacturing unit is equipped with advanced machinery capable of executing bulk orders with precision. We use best quality of raw material and sustainable engineering designs for manufacturing innovative implements of International standards. Our company has been certified to ISO 9001: 2000 for following a world-class quality management system. We believe in building a mutually beneficial relationship with our clients by providing them quality products, responsive services and timely delivery.'),
('terms_condition', '<p>gvbngngngg<strong>nfgnfgg</strong>ng<strong>nfgngng<em>fghfghfghfghghfghfghfgfgfhfg</em></strong></p>\r\n\r\n<p>fghfghfghfgh</p>\r\n');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
