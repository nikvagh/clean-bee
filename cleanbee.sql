-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 24, 2020 at 02:32 PM
-- Server version: 5.7.31
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
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `img`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test test', '', 'Enable', '2020-09-18 17:00:40', '2020-09-18 17:00:40');

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
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `capabilities`
--

INSERT INTO `capabilities` (`id`, `name`, `arabic_name`, `laundry_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Iron', 'Iron', 1, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(2, 'Wash & Iron', 'Wash & Iron', 1, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(3, 'Dry clean', 'Dry clean', 1, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(4, 'Iron', 'Iron', 2, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(5, 'Wash & Iron', 'Wash & Iron', 2, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00'),
(6, 'Dry clean', 'Dry clean', 2, '', '2020-09-22 00:00:00', '2020-09-22 00:00:00');

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
  `ss_ids` text NOT NULL,
  `price` double(20,2) NOT NULL,
  `price_total` double(20,2) NOT NULL,
  `removed` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y,N',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `laundry_id`, `qty`, `ss_ids`, `price`, `price_total`, `removed`, `created_at`, `updated_at`) VALUES
(10, 1, 2, 3, '1', 10.00, 30.00, 'N', '2020-09-24 16:00:05', '2020-09-24 15:00:54'),
(11, 1, 1, 5, '2,1', 30.00, 150.00, 'N', '2020-09-24 16:05:37', '2020-09-24 15:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `page_type` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
  `img` text NOT NULL,
  `address` text NOT NULL,
  `phone_varified` enum('true','false') NOT NULL COMMENT 'true,false',
  `email_varified` enum('true','false') NOT NULL DEFAULT 'false',
  `confirmed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `firstname`, `lastname`, `username`, `img`, `address`, `phone_varified`, `email_varified`, `confirmed_at`) VALUES
(1, 1, 'nikul2', 'vag', 'test_user', '', '', 'true', 'false', NULL),
(2, 2, 'nikul2', 'vag', 'username1', '1600427387_5986_MC-G-TY-129.jpg', 'username1', 'true', 'false', NULL);

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
  `vendors` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `discount_type`, `percentage`, `value`, `applied_to`, `send_push_notification`, `expiry_date`, `vendors`, `created_at`, `updated_at`) VALUES
(1, 'test10', 'percentage', '10', 0.00, '2', 'Y', '2020-09-07 19:25:36', '1,9', '2020-09-24 19:14:41', '2020-09-24 19:14:41'),
(2, 'test20', 'value', '0', 20.00, '1', 'N', '2020-09-26 19:25:55', '5,3,2,3', '2020-09-24 19:14:41', '2020-09-24 19:14:41');

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
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laundries`
--

INSERT INTO `laundries` (`id`, `name`, `arabic_name`, `does_require_car`, `sort_order`, `image`, `created_at`, `updated_at`) VALUES
(1, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(2, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(3, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(4, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(5, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(6, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(7, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(8, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(9, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(10, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(11, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(12, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(13, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(14, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(15, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(16, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(17, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(18, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(19, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(20, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(21, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(22, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(23, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(24, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(25, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(26, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(27, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(28, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(29, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(30, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(31, 'thobe', '', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00'),
(32, 'wool thobe', 'wool thobe', 'N', 0, '', '2020-09-18 00:00:00', '2020-09-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `is_new` enum('true','false') NOT NULL DEFAULT 'true' COMMENT 'true,false',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_new`, `created_at`, `updated_at`) VALUES
(1, 2, 'tset tet s', 'messg', 'false', '2020-09-18 17:17:03', '2020-09-18 17:17:03'),
(2, 2, 'test title 2', 'msg 2', 'true', '2020-09-18 17:17:03', '2020-09-18 17:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `order_type` varchar(200) NOT NULL,
  `pick_location` varchar(200) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_hour` varchar(10) NOT NULL,
  `pickup_time` varchar(10) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_hour` varchar(10) NOT NULL,
  `delivery_time` varchar(10) NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_cost` double(20,2) NOT NULL,
  `pick_lat` varchar(50) NOT NULL,
  `pick_lng` varchar(50) NOT NULL,
  `shop_lat` varchar(50) NOT NULL,
  `shop_lng` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `phone`, `otp`) VALUES
(7, '123456', '1234'),
(4, '1234567', '1234'),
(6, '1234562', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `payment_token` text NOT NULL,
  `fill_name` varchar(200) NOT NULL,
  `total_amount` double(20,2) NOT NULL,
  `net_amount` double(20,2) NOT NULL,
  `paypal_fee` double(20,2) NOT NULL,
  `email` varchar(200) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `date_received` datetime NOT NULL,
  `address` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `order_amount` double(20,2) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `delivery_fee` double(20,2) NOT NULL,
  `admin_commision_percentage` varchar(10) NOT NULL,
  `online_payment_commision` varchar(10) NOT NULL,
  `payable_amount_to_shop` double(20,2) NOT NULL,
  `commission_amount` double(20,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(17, 'dsfdsf', 152, '2020-09-16 04:58:27', NULL),
(18, 'dd', 125, '2020-09-16 04:58:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

DROP TABLE IF EXISTS `riders`;
CREATE TABLE IF NOT EXISTS `riders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rider_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `ride_type` enum('car','bike') NOT NULL COMMENT 'car,bike',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00'),
(2, 'admin', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00'),
(3, 'customer', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00'),
(4, 'vendor', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00'),
(5, 'rider', 'Enable', '2020-09-16 00:00:00', '2020-09-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_area_request`
--

DROP TABLE IF EXISTS `service_area_request`;
CREATE TABLE IF NOT EXISTS `service_area_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `description` text NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `range_in_km` varchar(10) NOT NULL,
  `cleanbee_percentage` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `vendor_id`, `shop_name`, `phone`, `description`, `opening_time`, `closing_time`, `latitude`, `longitude`, `range_in_km`, `cleanbee_percentage`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'shop1', '123456789', 'shop des1', '04:00:00', '06:00:00', '25.2617', '72.1596', '10', '5', 'test addres 1', '', '2020-09-18 18:23:59', '2020-09-18 18:23:59'),
(2, 2, 'shop2', '123456789', 'shop des 2', '09:00:00', '10:00:00', '25.2323', '73.256', '20', '7', 'test address 2', '', '2020-09-18 18:23:59', '2020-09-18 18:23:59');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
  `token` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `role_id` int(11) NOT NULL COMMENT '1=admin 2=vendor 3=customer 4=rider',
  `privileges` text NOT NULL,
  `token` text NOT NULL,
  `device_token` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `password`, `role_id`, `privileges`, `token`, `device_token`, `status`, `created_at`, `updated_at`) VALUES
(1, '1234562', 'nikul2vaghani@gmail.com', '1234567', 3, '', 'gKsfTk83zwtMDa2PncYi', '123456', 'Enable', '2020-09-17 12:07:04', '2020-09-17 12:07:04'),
(2, '123456', 'nikul111@gmail.com', '123456', 3, '', '1yRpCa40KdfLEbnuJOUG', '', 'Enable', '2020-09-17 12:09:50', '2020-09-17 10:19:48'),
(3, '123456', 'vendor@gmail.com', '123456', 2, '', '1yRpCa40KdfLEbnuJOUG', '', 'Enable', '2020-09-17 12:09:50', '2020-09-17 10:19:48');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

DROP TABLE IF EXISTS `web_config`;
CREATE TABLE IF NOT EXISTS `web_config` (
  `config_name` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `config_value` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`config_name`, `config_value`) VALUES
('meta_keyword', ''),
('sidepanel_block_title', '-'),
('meta_description', ''),
('site_name', 'I bid'),
('page_size', ''),
('powered_by', 'Powered by <a href=\"#\" target=\"_blank\" class=\"fotertext\">Nehal Mistry</a>'),
('company_copyright', 'Copyright © I Bid services. All rights reserved'),
('meta_title', 'Sicanet'),
('from_email_address', 'company@gmail.com'),
('company_name', 'I bid'),
('company_address', '52, Naist Prisam, op.MS House'),
('company_mobile', '1234567891'),
('company_email', 'company@gmail.com'),
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
