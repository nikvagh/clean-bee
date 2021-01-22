-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2021 at 09:55 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `arabic_name` varchar(200) NOT NULL,
  `laundry_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `card_number` varchar(200) NOT NULL,
  `expiry_date` date NOT NULL,
  `cvv` int NOT NULL,
  `default` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `customer_id`, `name`, `card_number`, `expiry_date`, `cvv`, `default`, `created_at`, `updated_at`) VALUES
(11, 2, 'test ', '12345678', '2020-01-00', 123, 'Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 2, 'test 1111', '12345678', '2019-05-01', 123, 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 2, 'test 1111', '12345678', '2019-05-01', 123, 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 2, 'test 1111', '12345678', '2019-05-01', 123, 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 2, 'test 1111', '12345678', '2019-05-01', 123, 'N', '2021-01-20 11:52:59', '2021-01-20 11:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `laundry_id` int NOT NULL,
  `qty` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `page_type` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iso` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nicename` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `iso3` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `numcode` smallint DEFAULT NULL,
  `phonecode` int NOT NULL,
  `status` enum('Enable','Disable') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`, `status`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93, 'Enable'),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355, 'Enable'),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213, 'Enable'),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684, 'Enable'),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376, 'Enable'),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244, 'Enable'),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264, 'Enable'),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0, 'Enable'),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268, 'Enable'),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54, 'Enable'),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374, 'Enable'),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297, 'Enable'),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61, 'Enable'),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43, 'Enable'),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994, 'Enable'),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242, 'Enable'),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973, 'Enable'),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880, 'Enable'),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246, 'Enable'),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375, 'Enable'),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32, 'Enable'),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501, 'Enable'),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229, 'Enable'),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441, 'Enable'),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975, 'Enable'),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591, 'Enable'),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387, 'Enable'),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267, 'Enable'),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0, 'Enable'),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55, 'Enable'),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246, 'Enable'),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673, 'Enable'),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359, 'Enable'),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226, 'Enable'),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257, 'Enable'),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855, 'Enable'),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237, 'Enable'),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1, 'Enable'),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238, 'Enable'),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345, 'Enable'),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236, 'Enable'),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235, 'Enable'),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56, 'Enable'),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86, 'Enable'),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61, 'Enable'),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672, 'Enable'),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57, 'Enable'),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269, 'Enable'),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242, 'Enable'),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242, 'Enable'),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682, 'Enable'),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506, 'Enable'),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225, 'Enable'),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385, 'Enable'),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53, 'Enable'),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357, 'Enable'),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420, 'Enable'),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45, 'Enable'),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253, 'Enable'),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767, 'Enable'),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809, 'Enable'),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593, 'Enable'),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20, 'Enable'),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503, 'Enable'),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240, 'Enable'),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291, 'Enable'),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372, 'Enable'),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251, 'Enable'),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500, 'Enable'),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298, 'Enable'),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679, 'Enable'),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358, 'Enable'),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33, 'Enable'),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594, 'Enable'),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689, 'Enable'),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0, 'Enable'),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241, 'Enable'),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220, 'Enable'),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995, 'Enable'),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49, 'Enable'),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233, 'Enable'),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350, 'Enable'),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30, 'Enable'),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299, 'Enable'),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473, 'Enable'),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590, 'Enable'),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671, 'Enable'),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502, 'Enable'),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224, 'Enable'),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245, 'Enable'),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592, 'Enable'),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509, 'Enable'),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0, 'Enable'),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39, 'Enable'),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504, 'Enable'),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852, 'Enable'),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36, 'Enable'),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354, 'Enable'),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91, 'Enable'),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62, 'Enable'),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98, 'Enable'),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964, 'Enable'),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353, 'Enable'),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972, 'Enable'),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39, 'Enable'),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876, 'Enable'),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81, 'Enable'),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962, 'Enable'),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7, 'Enable'),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254, 'Enable'),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686, 'Enable'),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850, 'Enable'),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82, 'Enable'),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965, 'Enable'),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996, 'Enable'),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856, 'Enable'),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371, 'Enable'),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961, 'Enable'),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266, 'Enable'),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231, 'Enable'),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218, 'Enable'),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423, 'Enable'),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370, 'Enable'),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352, 'Enable'),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853, 'Enable'),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389, 'Enable'),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261, 'Enable'),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265, 'Enable'),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60, 'Enable'),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960, 'Enable'),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223, 'Enable'),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356, 'Enable'),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692, 'Enable'),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596, 'Enable'),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222, 'Enable'),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230, 'Enable'),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269, 'Enable'),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52, 'Enable'),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691, 'Enable'),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373, 'Enable'),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377, 'Enable'),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976, 'Enable'),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664, 'Enable'),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212, 'Enable'),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258, 'Enable'),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95, 'Enable'),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264, 'Enable'),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674, 'Enable'),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977, 'Enable'),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31, 'Enable'),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599, 'Enable'),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687, 'Enable'),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64, 'Enable'),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505, 'Enable'),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227, 'Enable'),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234, 'Enable'),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683, 'Enable'),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672, 'Enable'),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670, 'Enable'),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47, 'Enable'),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968, 'Enable'),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92, 'Enable'),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680, 'Enable'),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970, 'Enable'),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507, 'Enable'),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675, 'Enable'),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595, 'Enable'),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51, 'Enable'),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63, 'Enable'),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0, 'Enable'),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48, 'Enable'),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351, 'Enable'),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787, 'Enable'),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974, 'Enable'),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262, 'Enable'),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40, 'Enable'),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70, 'Enable'),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250, 'Enable'),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290, 'Enable'),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869, 'Enable'),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758, 'Enable'),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508, 'Enable'),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784, 'Enable'),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684, 'Enable'),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378, 'Enable'),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239, 'Enable'),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966, 'Enable'),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221, 'Enable'),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381, 'Enable'),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248, 'Enable'),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232, 'Enable'),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65, 'Enable'),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421, 'Enable'),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386, 'Enable'),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677, 'Enable'),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252, 'Enable'),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27, 'Enable'),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0, 'Enable'),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34, 'Enable'),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94, 'Enable'),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249, 'Enable'),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597, 'Enable'),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47, 'Enable'),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268, 'Enable'),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46, 'Enable'),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41, 'Enable'),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963, 'Enable'),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886, 'Enable'),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992, 'Enable'),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255, 'Enable'),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66, 'Enable'),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670, 'Enable'),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228, 'Enable'),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690, 'Enable'),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676, 'Enable'),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868, 'Enable'),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216, 'Enable'),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90, 'Enable'),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370, 'Enable'),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649, 'Enable'),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688, 'Enable'),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256, 'Enable'),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380, 'Enable'),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971, 'Enable'),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44, 'Enable'),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1, 'Enable'),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1, 'Enable'),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598, 'Enable'),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998, 'Enable'),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678, 'Enable'),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58, 'Enable'),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84, 'Enable'),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284, 'Enable'),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340, 'Enable'),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681, 'Enable'),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212, 'Enable'),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967, 'Enable'),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260, 'Enable'),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263, 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `img` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `phone_varified` enum('true','false') NOT NULL COMMENT 'true,false',
  `email_varified` enum('true','false') NOT NULL DEFAULT 'false',
  `confirmed_at` datetime DEFAULT NULL,
  `refer_from` int NOT NULL,
  `wallet` double(20,2) NOT NULL,
  `login_provider` enum('normal','google','fb','apple_id') NOT NULL DEFAULT 'normal' COMMENT 'normal,google,fb,apple_id',
  `provider_token` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `firstname`, `lastname`, `username`, `img`, `address`, `phone_varified`, `email_varified`, `confirmed_at`, `refer_from`, `wallet`, `login_provider`, `provider_token`) VALUES
(1, 1, 'test111', 'demo22', 'test_user', '', '', 'true', 'false', NULL, 0, 78.00, 'normal', ''),
(2, 2, 'nikul2', 'vag', 'username1', '1601470906_4286.JPG', '21.2373879', 'true', 'false', NULL, 0, 2501.00, 'normal', ''),
(3, 6, 'nikul', 'kartum', 'nikul', '', '', 'true', 'false', NULL, 0, 0.00, 'normal', ''),
(4, 7, 'nikul', 'kartum', 'nikul', '', '', 'false', 'false', NULL, 0, 0.00, 'google', 'ss'),
(5, 8, 'nikul', 'kartum', 'nikul', '', '', 'false', 'false', NULL, 0, 0.00, 'google', 'ss1'),
(6, 9, 'nikul1', 'kartum1', 'nikul1', '', '', 'true', 'false', NULL, 0, 0.00, 'normal', ''),
(7, 10, 'nikul', 'kartum', 'nikul', '', '', 'false', 'false', NULL, 0, 0.00, 'apple_id', 'ss1'),
(8, 11, 'nikul', 'kartum', 'nikul', '', '', 'false', 'false', NULL, 0, 0.00, 'apple_id', 'ss1v');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `arabic_name` varchar(200) NOT NULL,
  `does_require_car` enum('Y','N') NOT NULL,
  `sort_order` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `rider_id` int NOT NULL,
  `shop_id` int NOT NULL,
  `order_type` varchar(200) NOT NULL,
  `pick_location` varchar(200) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_hour` varchar(10) NOT NULL,
  `pickup_time` varchar(10) NOT NULL,
  `drop_location` mediumtext NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_hour` varchar(10) NOT NULL,
  `delivery_time` varchar(10) NOT NULL,
  `order_status` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `laundry_id` int NOT NULL,
  `qty` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `star` float NOT NULL,
  `reason_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `status_code` varchar(100) NOT NULL,
  `status_title` varchar(150) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `sort_code` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL,
  `otp` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `phone`, `otp`) VALUES
(7, '123456', '1234'),
(4, '1234567', '1234'),
(19, '1234562', '1234'),
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
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `shop_id` int NOT NULL,
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
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `rider_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `rider_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `shop_id` int NOT NULL,
  `user_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `shop_id` int NOT NULL,
  `user_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `shop_id` int NOT NULL,
  `laundry_id` int NOT NULL,
  `capability_id` int NOT NULL,
  `standard_amt` double(20,2) NOT NULL,
  `urgent_amt` double(20,2) NOT NULL,
  `currency` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int NOT NULL COMMENT '1=admin 2=vendor 3=customer 4=rider 5=super_admin',
  `privileges` mediumtext NOT NULL,
  `token` mediumtext NOT NULL,
  `device_token` mediumtext NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `password`, `role_id`, `privileges`, `token`, `device_token`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, '1234562', 'test11234@gmail.com2', '123456', 3, '', 'K9tEuF4pPhMIsLJgTkQj', '', 'Enable', NULL, '2020-09-17 12:07:04', '2020-09-17 12:07:04'),
(2, '123456', 'nikul222@gmail.com', '123456', 3, '', '7IfKEGYNsF23t5iAwryz', '', 'Enable', NULL, '2020-09-17 12:09:50', '2020-09-29 09:40:18'),
(5, '1234567899', 'admin@gmail.com', '123456', 5, '', '', '', 'Enable', '2020-09-30 12:50:51', '2020-09-30 10:00:53', '2020-09-30 10:00:53'),
(3, '123456', 'vendor@gmail.com', '123456', 2, '', '1yRpCa40KdfLEbnuJOUG', '', 'Enable', NULL, '2020-09-17 12:09:50', '2020-09-17 10:19:48'),
(4, '1234567899', 'rider@gmail.com', '123456', 4, '', 'CJFHEATdvs2MpG0PS8ai', '', 'Enable', NULL, '2020-09-17 12:09:50', '2020-09-29 14:13:00'),
(7, '123456789', 'nikul21@kartuminfotech.com', '', 3, '', 'oRusFaipJZDKrVtz852c', '', 'Enable', NULL, '2020-10-05 12:28:25', '2020-10-05 12:28:25'),
(6, '123456789', 'nikul@kartuminfotech.com', '123456', 3, '', 'Z8ifqHkhu69tAasQnl1p', '', 'Enable', NULL, '2020-10-05 10:13:38', '2020-10-05 10:13:38'),
(8, '123456789', 'nikul21@kartuminfotech.com', '', 3, '', 'ej4Zm6nDPSJy3GtHdI5Y', '', 'Enable', NULL, '2020-10-05 12:36:28', '2020-10-05 12:36:28'),
(9, '123456719', 'nikul1@kartuminfotech.com', '123456', 3, '', 'PB8gz3ampbNtf9FZevCq', '', 'Enable', NULL, '2021-01-16 11:47:19', '2021-01-16 11:47:19'),
(11, '123456789', '', '', 3, '', 'oDzGu7JnU98ERZWkip3m', '123456', 'Enable', NULL, '2021-01-22 11:23:53', '2021-01-22 11:23:53'),
(10, '123456789', 'nikul21@kartuminfotech.com', '', 3, '', '1tUQWqxJERVDTduS2Zcs', '', 'Enable', NULL, '2021-01-22 10:43:50', '2021-01-22 10:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `amount` double(20,2) NOT NULL,
  `operation_type` enum('credit','debit') NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wallet_history`
--

INSERT INTO `wallet_history` (`id`, `user_id`, `amount`, `operation_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, -5.00, 'credit', 'Add credit to wallet by customer', '2020-09-25 11:39:08', '2020-09-25 11:39:08'),
(2, 1, 6.00, 'credit', 'Add credit to wallet by customer', '2020-09-25 11:39:13', '2020-09-25 11:39:13'),
(3, 1, 6.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 10:41:55', '2021-01-22 10:41:55'),
(4, 1, 1.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 10:46:44', '2021-01-22 10:46:44'),
(5, 1, 1.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 10:48:37', '2021-01-22 10:48:37'),
(6, 1, 1.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 10:49:30', '2021-01-22 10:49:30'),
(7, 1, 1.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 10:49:43', '2021-01-22 10:49:43'),
(8, 2, 1.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 10:50:25', '2021-01-22 10:50:25'),
(9, 2, 500.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 10:50:53', '2021-01-22 10:50:53'),
(10, 2, 500.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 10:52:46', '2021-01-22 10:52:46'),
(11, 2, 500.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 11:12:16', '2021-01-22 11:12:16'),
(12, 2, 500.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 11:15:16', '2021-01-22 11:15:16'),
(13, 2, 500.00, 'credit', 'Add credit to wallet by customer', '2021-01-22 11:17:59', '2021-01-22 11:17:59');

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
