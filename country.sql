-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2021 at 05:42 AM
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
-- Database: `data_web1`
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
