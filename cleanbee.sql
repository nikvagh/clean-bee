-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2020 at 09:52 AM
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
-- Table structure for table `capabilities`
--

DROP TABLE IF EXISTS `capabilities`;
CREATE TABLE IF NOT EXISTS `capabilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `arabic_name` varchar(200) NOT NULL,
  `laundry` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 1, 'nikul2', 'vag', 'username2', '', '', 'true', 'false', NULL),
(2, 2, 'nikul2', 'vag', 'username1', '1600335988_2048-12.jpg', 'tse tets etsetsete', 'true', 'false', NULL);

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
  `applied_to` enum('1','2','3') NOT NULL COMMENT '1=total amount,\r\n2=order_amount,\r\n3=total_fee',
  `send_push_notification` enum('Y','N') NOT NULL,
  `vendors` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `role_id` int(11) NOT NULL,
  `privileges` text NOT NULL,
  `token` text NOT NULL,
  `device_token` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `password`, `role_id`, `privileges`, `token`, `device_token`, `status`, `created_at`, `updated_at`) VALUES
(1, '1234562', 'nikul2vaghani@gmail.com', '123456', 3, '', 'ulfVEM9xLCnF06BvDQW2', '123456', 'Enable', '2020-09-17 12:07:04', '2020-09-17 12:07:04'),
(2, '123456', 'nikul111@gmail.com', '123456', 3, '', '1yRpCa40KdfLEbnuJOUG', '', 'Enable', '2020-09-17 12:09:50', '2020-09-17 10:19:48');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
