-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2020 at 12:06 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kna_matrimony`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `album_image`
--

CREATE TABLE `album_image` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `basic_details`
--

CREATE TABLE `basic_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `months` int(11) NOT NULL,
  `height` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `marital_status` int(11) NOT NULL,
  `parish_name` varchar(255) NOT NULL,
  `parish_place` varchar(255) NOT NULL,
  `family_status` int(11) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `name`) VALUES
(1, 'movies_music', 'Movies & Music'),
(2, 'science_technology', 'Science & Technology'),
(3, 'pets_animals', 'Pets & Animals'),
(4, 'vehicles_automobiles', 'Vehicles & Automobiles'),
(5, 'art_culture', 'Art & Culture'),
(6, 'education_knowledge', 'Education & Knowledge'),
(7, 'food_restaurant', 'Food & Restaurant'),
(8, 'travel_tours', 'Travel & Tours'),
(9, 'politics_current_affairs', 'Politics & Current Affairs'),
(10, 'games', 'Games'),
(11, 'business_economics', 'Business & Economics'),
(12, 'healthcare', 'Healthcare');

-- --------------------------------------------------------

--
-- Table structure for table `core`
--

CREATE TABLE `core` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `header_logo` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `sms_user` varchar(255) NOT NULL,
  `sms_password` varchar(255) NOT NULL,
  `sms_sender_id` varchar(30) NOT NULL,
  `is_smtp` tinyint(1) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `connection_prefix` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `core`
--

INSERT INTO `core` (`id`, `site_name`, `email`, `header_logo`, `logo`, `sms_user`, `sms_password`, `sms_sender_id`, `is_smtp`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`, `connection_prefix`) VALUES
(1, 'Knanaya Partner', 'knanayapartner@gmail.com', 'logo1.png', 'logo.png', 'jasooly007', 'G37LXH4U123', 'SMRTPZ', 1, 'smtp.gmail.com', '587', 'robin.smartipz@gmail.com', 'Asdqwe123@', 'tls');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `tel_code` varchar(10) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `currency_2` varchar(10) NOT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `country_code_iso_3` varchar(10) NOT NULL,
  `currency_symbol` varchar(5) DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `tel_code`, `currency`, `currency_2`, `country_code`, `country_code_iso_3`, `currency_symbol`, `active`) VALUES
(1, 'Abkhazia', '840', 'RUB', 'EURO', 'AB', 'ABK', NULL, 0),
(2, 'Afghanistan', '93', 'AFN', 'USD', 'AF', 'AFG', NULL, 0),
(3, 'Albania', '355', 'ALL', 'EURO', 'AL', 'ALB', NULL, 0),
(4, 'Algeria', '213', 'DZD', 'USD', 'DZ', 'DZA', NULL, 0),
(5, 'Andorra', '376', 'EUR', 'EUR', 'AD', 'AND', NULL, 0),
(6, 'Angola', '244', 'AOA', 'USD', 'AO', 'AGO', NULL, 0),
(7, 'Antigua and Barbuda', '1 268', 'XCD', 'USD', 'AG', 'ATG', NULL, 0),
(8, 'Argentina', '54', 'ARS', 'USD', 'AR', 'ARG', NULL, 0),
(9, 'Armenia', '374', 'AMD', 'EURO', 'AM', 'ARM', NULL, 0),
(10, 'Australia', '61', 'AUD', 'AUD', 'AU', 'AUS', 'A$', 1),
(11, 'Austria', '43', 'EUR', '', 'AT', '', NULL, 0),
(12, 'Bahamas', '1 242', 'BSD', 'USD', 'BS', 'BHS', NULL, 0),
(13, 'Bahrain', '973', 'BHD', 'USD', 'BH', 'BHR', NULL, 0),
(14, 'Bangladesh', '880', 'BDT', 'USD', 'BD', 'BGD', NULL, 0),
(15, 'Barbados', '1 246', 'BBD', 'USD', 'BB', 'BRB', NULL, 0),
(16, 'Belarus', '375', 'BYR', 'EURO', 'BY', 'BLR', NULL, 0),
(17, 'Belgium', '32', 'EUR', 'EUR', 'BE', 'BEL', NULL, 0),
(18, 'Belize', '501', 'BZD', 'USD', 'BZ', 'BLZ', NULL, 0),
(19, 'Benin', '229', 'XOF', 'USD', 'BJ', 'BEN', NULL, 0),
(20, 'Bhutan', '975', 'BTN', 'USD', 'BT', 'BTN', NULL, 0),
(21, 'Bolivia', '591', 'BOB', 'USD', 'BO', 'BOL', NULL, 0),
(22, 'Bosnia and Herzegovina', '387', 'BAM', 'EURO', 'BA', 'BIH', NULL, 0),
(23, 'Botswana', '267', 'BWP', 'USD', 'BW', 'BWA', NULL, 0),
(24, 'Brazil', '55', 'BRL', 'USD', 'BR', 'BRA', NULL, 0),
(25, 'Brunei Darussalam\r\n', '673', 'BND', 'USD', 'BN', 'BRN', NULL, 0),
(26, 'Bulgaria', '359', 'EUR', 'EUR', 'BG', 'BGR', NULL, 0),
(27, 'Burkina Faso', '226', 'XOF', 'USD', 'BF', 'BFA', NULL, 0),
(28, 'Burma', '291', 'ERN', 'USD', 'ER', 'ERI', NULL, 0),
(29, 'Burundi', '257', 'BIF', 'USD', 'BI', 'BDI', NULL, 0),
(30, 'Cambodia', '855', 'KHR', 'USD', 'KH', 'KHM', NULL, 0),
(31, 'Cameroon', '237', 'XAF', 'USD', 'CM', 'CMR', NULL, 0),
(32, 'Canada', '1', 'CAD', 'CAD', 'CA', 'CAN', 'C$', 1),
(33, 'Cape Verde', '238', 'CVE', 'USD', 'CV', 'CPV', NULL, 0),
(34, 'Central African Republic', '236', 'XAF', 'USD', 'CF', 'CAF', NULL, 0),
(35, 'Chad', '235', 'XAF', 'USD', 'TD', 'TCD', NULL, 0),
(36, 'Chile', '56', 'CLP', 'USD', 'CL', 'CHL', NULL, 0),
(37, 'China', '86', 'CNY', 'GBP', 'CN', 'CHN', NULL, 0),
(38, 'Colombia', '57', 'COP', 'COP', 'CO', 'COL', NULL, 0),
(39, 'Comoros', '269', 'KNF', 'USD', 'KM', 'COM', NULL, 0),
(40, 'Democratic Republic of Congo', '243', 'XAF', 'USD', 'CD', 'COD', NULL, 0),
(41, 'Cook Islands', '682', 'NZD', 'USD', 'CK', 'COK', NULL, 0),
(42, 'Costa Rica', '506', 'CRC', 'USD', 'CR', 'CRI', NULL, 0),
(43, 'Croatia', '385', 'HRK', 'EURO', 'HR', 'HRV', NULL, 0),
(44, 'Cuba', '53', 'CUP', 'USD', 'CU', 'CUB', NULL, 0),
(45, 'Cyprus', '357', 'EUR', 'EUR', 'CY', 'CYP', NULL, 0),
(46, 'Czech Republic', '420', 'CZK', 'EURO', 'CZ', 'CZE', NULL, 0),
(47, 'Côte d\'Ivoire', '225', 'XOF', 'USD', 'CI', 'CIV', NULL, 0),
(48, 'Denmark', '45', 'DKK', 'EUR', 'DK', 'DNK', NULL, 0),
(49, 'Djibouti', '253', 'DJF', 'USD', 'DJ', 'DJI', NULL, 0),
(50, 'Dominica', '1 767', 'XCD', 'USD', 'DM', 'DMA', NULL, 0),
(51, 'Dominican Republic', '1 809', 'DOP', 'USD', 'DO', 'DOM', NULL, 0),
(52, 'East Timor', '670', 'USD', 'USD', 'TL', 'TLS', NULL, 0),
(53, 'Ecuador', '593', 'USD', 'USD', 'EC', 'ECU', NULL, 0),
(54, 'Egypt', '20', 'EGP', 'USD', 'EG', 'EGY', NULL, 0),
(55, 'El Salvador', '503', 'USD', 'USD', 'SV', 'SLV', NULL, 0),
(56, 'Equatorial Guinea', '240', 'XAF', 'USD', 'GQ', 'GNQ', NULL, 0),
(57, 'Eritrea', '291', 'ERN', 'ERN', 'ER', 'ERI', NULL, 0),
(58, 'Estonia', '372', 'EURO', 'EURO', 'EE', 'EST', NULL, 0),
(59, 'Ethiopia', '251', 'ETB', 'ETB', 'ET', 'ETH', NULL, 0),
(60, 'Fiji', '679', 'FJD', 'FJD', 'FJ', 'FJI', NULL, 0),
(61, 'Finland', '358', 'EUR', 'EUR', 'FI', 'FIN', NULL, 0),
(62, 'France', '33', 'EUR', 'EUR', 'FR', 'FRA', NULL, 0),
(63, 'Gabon', '241', NULL, '', 'GA', '', NULL, 0),
(64, 'Gambia', '220', NULL, '', 'GM', '', NULL, 0),
(65, 'Georgia', '995', NULL, '', 'GE', '', NULL, 0),
(66, 'Germany', '49', 'EUR', 'EUR', 'DE', 'DEU', NULL, 1),
(67, 'Ghana', '233', NULL, '', 'GH', '', NULL, 0),
(68, 'Greece', '30', 'EUR', 'EUR', 'GR', 'GRC', NULL, 0),
(69, 'Grenada', '1 473', NULL, '', 'GD', '', NULL, 0),
(70, 'Guatemala', '502', NULL, '', 'GT', '', NULL, 0),
(71, 'Guinea', '224', NULL, '', 'GN', '', NULL, 0),
(72, 'Guinea-Bissau', '245', NULL, '', 'GW', '', NULL, 0),
(73, 'Guyana', '592', NULL, '', 'GY', '', NULL, 0),
(74, 'Haiti', '509', NULL, '', 'HT', '', NULL, 0),
(75, 'Honduras', '504', NULL, '', 'HN', '', NULL, 0),
(76, 'Hungary', '36', 'HUF', 'EUR', 'HU', 'HUN', NULL, 0),
(77, 'Iceland', '354', NULL, '', 'IS', '', NULL, 0),
(78, 'India', '91', 'INR', 'INR', 'IN', 'IND', 'Rs', 1),
(79, 'Indonesia', '62', NULL, '', 'ID', '', NULL, 0),
(80, 'Iran', '98', NULL, '', 'IR', '', NULL, 0),
(81, 'Iraq', '964', NULL, '', 'IQ', '', NULL, 0),
(82, 'Ireland', '353', 'EUR', 'EUR', 'IE', 'IRL', NULL, 0),
(83, 'Israel', '972', 'ISL', 'EUR', 'IL', 'ISR', NULL, 1),
(84, 'Italy', '39', 'EUR', 'EUR', 'IT', 'ITA', NULL, 1),
(85, 'Ivory Coast', '225', NULL, '', 'CI', '', NULL, 0),
(86, 'Jamaica', '1 876', NULL, '', 'JM', '', NULL, 0),
(87, 'Japan', '81', 'JPY', 'USD', 'JP', 'JPN', NULL, 0),
(88, 'Jordan', '962', NULL, '', 'JO', '', NULL, 0),
(89, 'Kazakhstan', '7', NULL, '', 'KZ', '', NULL, 0),
(90, 'Kenya', '254', NULL, '', 'KE', '', NULL, 0),
(91, 'Kiribati', '686', NULL, '', 'KI', '', NULL, 0),
(92, 'Korea, North', '0', NULL, '', NULL, '', NULL, 0),
(93, 'Korea, South', '0', NULL, '', NULL, '', NULL, 0),
(94, 'Kosovo', '381', NULL, '', NULL, '', NULL, 0),
(95, 'Kuwait', '965', NULL, '', 'KW', '', NULL, 0),
(96, 'Kyrgyzstan', '996', NULL, '', 'KG', '', NULL, 0),
(97, 'Laos', '856', NULL, '', 'LA', '', NULL, 0),
(98, 'Latvia', '371', NULL, '', 'LV', '', NULL, 0),
(99, 'Lebanon', '961', NULL, '', 'LB', '', NULL, 0),
(100, 'Lesotho', '266', NULL, '', 'LS', '', NULL, 0),
(101, 'Liberia', '231', NULL, '', 'LR', '', NULL, 0),
(102, 'Libya', '218', NULL, '', 'LY', '', NULL, 0),
(103, 'Liechtenstein', '423', 'EUR', 'EUR', 'LI', 'LIE', NULL, 0),
(104, 'Lithuania', '370', NULL, '', 'LT', '', NULL, 0),
(105, 'Luxembourg', '352', 'EUR', 'EUR', 'LU', 'LUX', NULL, 0),
(106, 'Macedonia', '389', NULL, '', 'MK', '', NULL, 0),
(107, 'Madagascar', '261', NULL, '', 'MG', '', NULL, 0),
(108, 'Malawi', '265', NULL, '', 'MW', '', NULL, 0),
(109, 'Malaysia', '60', 'MYR', 'USD', 'MY', 'MYS', NULL, 0),
(110, 'Maldives', '960', NULL, '', 'MV', '', NULL, 0),
(111, 'Mali', '223', NULL, '', 'ML', '', NULL, 0),
(112, 'Malta', '356', 'EUR', 'EUR', 'MT', 'MLT', NULL, 0),
(113, 'Marshall Islands', '692', NULL, '', 'MH', '', NULL, 0),
(114, 'Mauritania', '222', NULL, '', 'MR', '', NULL, 0),
(115, 'Mauritius', '230', NULL, '', 'MU', '', NULL, 0),
(116, 'Mexico', '52', 'MXN', 'USD', 'MX', 'MEX', NULL, 0),
(117, 'Micronesia', '691', NULL, '', 'FM', '', NULL, 0),
(118, 'Moldova', '373', NULL, '', 'MD', '', NULL, 0),
(119, 'Monaco', '377', 'EUR', 'EUR', 'MC', 'MCO', NULL, 0),
(120, 'Mongolia', '976', NULL, '', 'MN', '', NULL, 0),
(121, 'Montenegro', '382', NULL, '', 'ME', '', NULL, 0),
(122, 'Morocco', '212', NULL, '', 'MA', '', NULL, 0),
(123, 'Mozambique', '258', 'MZN', 'USD', 'MZ', 'MOZ', NULL, 0),
(124, 'Myanmar / Burma', '0', NULL, '', NULL, '', NULL, 0),
(125, 'Nagorno-Karabakh', '0', NULL, '', NULL, '', NULL, 0),
(126, 'Namibia', '264', NULL, '', 'NA', '', NULL, 0),
(127, 'Nauru', '674', NULL, '', 'NR', '', NULL, 0),
(128, 'Nepal', '977', NULL, '', 'NP', '', NULL, 0),
(129, 'Netherlands', '31', 'EUR', 'EUR', 'NL', 'NLD', NULL, 0),
(130, 'New Zealand', '64', 'NZD', 'USD', 'NZ', 'NZL', NULL, 1),
(131, 'Nicaragua', '505', NULL, '', 'NI', '', NULL, 0),
(132, 'Niger', '227', NULL, '', 'NE', '', NULL, 0),
(133, 'Nigeria', '234', NULL, '', 'NG', '', NULL, 0),
(134, 'Niue', '683', NULL, '', 'NU', '', NULL, 0),
(135, 'Northern Cyprus', '0', NULL, '', NULL, '', NULL, 0),
(136, 'Norway', '47', 'NOK', 'EUR', 'NO', 'NOR', NULL, 0),
(137, 'Oman', '968', NULL, '', 'OM', '', NULL, 0),
(138, 'Pakistan', '92', NULL, '', 'PK', '', NULL, 0),
(139, 'Palau', '680', NULL, '', 'PW', '', NULL, 0),
(140, 'Palestine', '970', NULL, '', NULL, '', NULL, 0),
(141, 'Panama', '507', NULL, '', 'PA', '', NULL, 0),
(142, 'Papua New Guinea', '675', NULL, '', 'PG', '', NULL, 0),
(143, 'Paraguay', '595', NULL, '', 'PY', '', NULL, 0),
(144, 'Peru', '51', 'PEN', 'COP', 'PE', '', NULL, 0),
(145, 'Philippines', '63', 'PHP', 'USD', 'PH', 'PHL', NULL, 0),
(146, 'Poland', '48', 'PLN', 'EUR', 'PL', 'POL', NULL, 0),
(147, 'Portugal', '351', 'EUR', 'EUR', 'PT', 'PRT', NULL, 0),
(148, 'Qatar', '974', NULL, '', 'QA', '', NULL, 0),
(149, 'Romania', '40', NULL, '', 'RO', '', NULL, 0),
(150, 'Russia', '7', 'RUB', 'EUR', 'RU', 'RUS', NULL, 0),
(151, 'Rwanda', '250', NULL, '', 'RW', '', NULL, 0),
(152, 'Sahrawi Arab Democratic Republic', '0', NULL, '', NULL, '', NULL, 0),
(153, 'Saint Kitts and Nevis', '1 869', NULL, '', 'KN', '', NULL, 0),
(154, 'Saint Lucia', '1 758', NULL, '', 'LC', '', NULL, 0),
(155, 'Saint Vincent and the Grenadines', '1 784', NULL, '', 'VC', '', NULL, 0),
(156, 'Samoa', '685', NULL, '', 'WS', '', NULL, 0),
(157, 'San Marino', '378', 'EUR', 'EUR', 'SM', 'SMR', NULL, 0),
(158, 'Saudi Arabia', '966', NULL, '', 'SA', '', NULL, 0),
(159, 'Senegal', '221', NULL, '', 'SN', '', NULL, 0),
(160, 'Serbia', '381', NULL, '', 'RS', '', NULL, 0),
(161, 'Seychelles', '248', NULL, '', 'SC', '', NULL, 0),
(162, 'Sierra Leone', '232', NULL, '', 'SL', '', NULL, 0),
(163, 'Singapore', '65', 'SGD', 'USD', 'SG', 'SGP', NULL, 0),
(164, 'Slovakia', '421', 'EUR', 'EUR', 'SK', 'SVK', NULL, 0),
(165, 'Slovenia', '386', 'EUR', 'EUR', 'SI', 'SVN', NULL, 0),
(166, 'Solomon Islands', '677', NULL, '', 'SB', '', NULL, 0),
(167, 'Somalia', '252', NULL, '', 'SO', '', NULL, 0),
(168, 'Somaliland', '252', NULL, '', NULL, '', NULL, 0),
(169, 'South Africa', '27', 'ZAR', 'USD', 'ZA', 'ZAF', NULL, 1),
(170, 'South Ossetia', '0', NULL, '', NULL, '', NULL, 0),
(171, 'Spain', '34', 'EUR', 'EUR', 'ES', 'ESP', NULL, 0),
(172, 'Sri Lanka', '94', NULL, '', 'LK', '', NULL, 0),
(173, 'Sudan', '249', NULL, '', 'SD', '', NULL, 0),
(174, 'Suriname', '597', NULL, '', 'SR', '', NULL, 0),
(175, 'Swaziland', '268', NULL, '', 'SZ', '', NULL, 0),
(176, 'Sweden', '46', 'SEK', 'EUR', 'SE', 'SWE', NULL, 0),
(177, 'Switzerland', '41', 'CHF', 'EUR', 'CH', 'CHE', NULL, 0),
(178, 'Syria', '963', NULL, '', 'SY', '', NULL, 0),
(179, 'São Tomé and Príncipe', '239', NULL, '', 'ST', '', NULL, 0),
(180, 'Taiwan', '886', 'TWD', 'USD', 'TW', 'TWN', NULL, 0),
(181, 'Tajikistan', '992', NULL, '', 'TJ', '', NULL, 0),
(182, 'Tanzania', '255', NULL, '', 'TZ', '', NULL, 0),
(183, 'Thailand', '66', 'THB', 'USD', 'TH', 'THA', NULL, 0),
(184, 'Timor-Leste / East Timor', '0', NULL, '', NULL, '', NULL, 0),
(185, 'Togo', '228', NULL, '', 'TG', '', NULL, 0),
(186, 'Tonga', '676', NULL, '', 'TO', '', NULL, 0),
(187, 'Trinidad and Tobago', '1 868', NULL, '', 'TT', '', NULL, 0),
(188, 'Tunisia', '216', NULL, '', 'TN', '', NULL, 0),
(189, 'Turkey', '90', 'TRY', 'EUR', 'TR', 'TUR', NULL, 0),
(190, 'Turkmenistan', '993', NULL, '', 'TM', '', NULL, 0),
(191, 'Tuvalu', '688', NULL, '', 'TV', '', NULL, 0),
(192, 'Uganda', '256', NULL, '', 'UG', '', NULL, 0),
(193, 'Ukraine', '380', NULL, '', 'UA', '', NULL, 0),
(194, 'United Arab Emirates', '971', NULL, '', 'AE', '', NULL, 1),
(195, 'United Kingdom', '44', 'GBP', 'COP', 'GB', 'GBR', '£', 1),
(196, 'United States', '1', 'USD', 'USD', 'US', 'USA', '$', 1),
(197, 'Uruguay', '598', NULL, '', 'UY', '', NULL, 0),
(198, 'Uzbekistan', '998', NULL, '', 'UZ', '', NULL, 0),
(199, 'Vanuatu', '678', NULL, '', 'VU', '', NULL, 0),
(200, 'Vatican City', '39', 'EUR', 'EUR', 'VAT', 'VAT', NULL, 1),
(201, 'Venezuela', '58', NULL, '', 'VE', '', NULL, 0),
(202, 'Vietnam', '84', NULL, '', 'VN', '', NULL, 0),
(203, 'Yemen', '967', NULL, '', 'YE', '', NULL, 0),
(204, 'Zambia', '260', NULL, '', 'ZM', '', NULL, 0),
(205, 'Zimbabwe', '263', NULL, '', 'ZW', '', NULL, 0),
(206, 'Gibraltar', '350', 'GIP', 'GBP', 'GI', 'GIB', NULL, 0),
(207, 'Aland Islands', '35818', NULL, '', 'AX', 'ALA', NULL, 0),
(208, 'American Samoa', '1-684', NULL, '', 'AS', 'ASM', NULL, 0),
(209, 'Anguilla\r\n', '1-264', NULL, '', 'AI', 'AIA', NULL, 0),
(210, 'Antarctica\r\n', '672', NULL, '', 'AQ', 'ATA', NULL, 0),
(211, 'Aruba\r\n', '297', NULL, '', 'AW', 'ABW', NULL, 0),
(212, 'Bermuda', '1-441', NULL, '', 'BM', 'BMU', NULL, 0),
(213, 'Bouvet Island', NULL, NULL, '', 'BV', 'BVT', NULL, 0),
(214, 'British Indian Ocean Territory', '246', NULL, '', 'IO', 'IOT', NULL, 0),
(215, 'Guernsey', '44-1481', NULL, '', 'GG', 'GGY', NULL, 0),
(216, 'Cayman Islands', '1-345', NULL, '', 'KY', 'CYM', NULL, 0),
(217, 'Christmas Island', '61', NULL, '', 'CX', 'CXR', NULL, 0),
(218, 'Cocos (Keeling) Islands', '61', NULL, '', 'CC', 'CCK', NULL, 0),
(219, 'Falkland Islands (Malvinas) ', '500', NULL, '', 'FK', 'FLK', NULL, 0),
(220, 'Faroe Islands', '298', NULL, '', 'FO', 'FRO', NULL, 0),
(221, 'French Guiana', NULL, NULL, '', 'GF', 'GUF', NULL, 0),
(222, 'French Polynesia', '689', NULL, '', 'PF', 'PYF', NULL, 0),
(223, 'French Southern Territories\r\n', NULL, NULL, '', 'TF', 'ATF', NULL, 0),
(224, 'Greenland', '299', NULL, '', 'GL', 'GRL', NULL, 0),
(225, 'Guadeloupe', NULL, NULL, '', 'GP', 'GLP', NULL, 0),
(226, 'Guam', '1-671', NULL, '', 'GU', 'GUM', NULL, 0),
(227, 'Heard Island and Mcdonald Islands', NULL, NULL, '', 'HM', 'HMD', NULL, 0),
(228, 'Holy See (Vatican City State)', NULL, NULL, '', 'VA', 'VAT', NULL, 0),
(229, 'Hong Kong', '852', NULL, '', 'HK', 'HKG', NULL, 0),
(230, 'Isle of Man', '44-1624', NULL, '', 'IM', 'IMN', NULL, 0),
(231, 'Jersey', '44-1534', NULL, '', 'JE', 'JEY', NULL, 0),
(232, 'Macao', NULL, NULL, '', 'MO', 'MAC', NULL, 0),
(233, 'Martinique', NULL, NULL, '', 'MQ', 'MTQ', NULL, 0),
(234, 'Mayotte', '262', NULL, '', 'YT', 'MYT', NULL, 0),
(235, 'Montserrat', '1-664', NULL, '', 'MS', 'MSR', NULL, 0),
(236, 'Netherlands Antilles', '599', NULL, '', 'AN', 'ANT', NULL, 0),
(237, 'New Caledonia', '687', NULL, '', 'NC', 'NCL', NULL, 0),
(238, 'Norfolk Island', NULL, NULL, '', 'NF', 'NFK', NULL, 0),
(239, 'Northern Mariana Islands', '1-670', NULL, '', 'MP', 'MNP', NULL, 0),
(240, 'Pitcairn', '64', NULL, '', 'PN', 'PCN', NULL, 0),
(241, 'Puerto Rico', '1-787', NULL, '', 'PR', 'PRI', NULL, 0),
(242, 'Reunion', '262', NULL, '', 'RE', 'REU', NULL, 0),
(243, 'Saint Helena', '290', NULL, '', 'SH', 'SHN', NULL, 0),
(244, 'Saint Pierre and Miquelon', '508', NULL, '', 'PM', 'SPM', NULL, 0),
(245, 'South Georgia and the South Sandwich Islands', NULL, NULL, '', 'GS', 'SGS', NULL, 0),
(246, 'Svalbard and Jan Mayen', '47', NULL, '', 'SJ', 'SJM', NULL, 0),
(247, 'Tokelau', '690', NULL, '', 'TK', 'TKL', NULL, 0),
(248, 'Turks and Caicos Islands', '1-649', NULL, '', 'TC', 'TCA', NULL, 0),
(249, 'Virgin Islands, British', '1-284', NULL, '', 'VG', 'VGB', NULL, 0),
(250, 'Virgin Islands, U.S.', '1-340', NULL, '', 'VI', 'VIR', NULL, 0),
(251, 'Wallis and Futuna', '681', NULL, '', 'WF', 'WLF', NULL, 0),
(252, 'Western Sahara', '212', NULL, '', 'EH', 'ESH', NULL, 0),
(253, 'Korea, Republic of', NULL, NULL, '', 'KR', 'KOR', NULL, 0),
(254, 'Azerbaijan\r\n', NULL, NULL, '', 'AZ', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `state_id`, `name`) VALUES
(1, 1, 'Idukki'),
(2, 1, 'Alappuzha'),
(3, 1, 'Kottayam'),
(5, 1, 'Ernakulam'),
(6, 1, 'Kannur'),
(7, 1, 'Kasaragod'),
(8, 1, 'Kollam'),
(9, 1, 'Kozhikode'),
(10, 1, 'Malappuram'),
(11, 1, 'Palakkad'),
(12, 1, 'Pathanamthitta'),
(13, 1, 'Thiruvananthapuram'),
(14, 1, 'Thrissur'),
(15, 1, 'Wayanad');

-- --------------------------------------------------------

--
-- Table structure for table `edu_category`
--

CREATE TABLE `edu_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `edu_category`
--

INSERT INTO `edu_category` (`id`, `name`) VALUES
(3, 'Ph.D.'),
(4, 'Service - IAS / IPS / IRS / IES / IFS'),
(5, 'Any Financial Qualification - ICWAI / CA / CS/ CFA'),
(6, 'Any Masters in Arts / Science / Commerce'),
(7, 'Any Masters in Engineering / Computers'),
(8, 'Any Masters in Legal'),
(9, 'Any Masters in Management'),
(10, 'Any Masters in Medicine - General / Dental / Surgeon'),
(11, 'Any Bachelors in Arts / Science / Commerce'),
(12, 'Any Bachelors in Engineering / Computers'),
(13, 'Any Bachelors in Legal'),
(14, 'Any Bachelors in Management'),
(15, 'Any Bachelors in Medicine in General / Dental / Surgeon'),
(16, 'Any Diploma'),
(17, 'Higher Secondary / Secondary');

-- --------------------------------------------------------

--
-- Table structure for table `edu_category_list`
--

CREATE TABLE `edu_category_list` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `edu_category_list`
--

INSERT INTO `edu_category_list` (`id`, `category_id`, `name`) VALUES
(6, 3, 'Ph.D.'),
(7, 4, 'IAS'),
(8, 4, 'IPS'),
(9, 4, 'IRS'),
(10, 4, 'IES'),
(11, 4, 'IFS'),
(12, 4, 'Other Degree in Service'),
(13, 5, 'CA'),
(14, 5, 'CS'),
(15, 5, 'ICWA'),
(16, 5, 'CFA (Chartered Financial Analyst)'),
(17, 5, 'Other Degree in Finance'),
(18, 6, 'M.Phil.'),
(19, 6, 'MCom'),
(20, 6, 'M.Sc.'),
(21, 6, 'M.A.'),
(22, 6, 'M.Ed.'),
(23, 6, 'MLIS'),
(24, 6, 'MSW'),
(25, 6, 'Other Master Degree in Arts / Science / Commerce'),
(26, 6, 'MFA'),
(27, 7, 'M.S.(Engg.)'),
(28, 7, 'M.Arch.'),
(29, 7, 'MCA'),
(30, 7, 'PGDCA'),
(31, 7, 'ME'),
(32, 7, 'M.Tech.'),
(33, 7, 'M.Sc. IT / Computer Science'),
(34, 7, 'Other Masters Degree in Engineering / Computers'),
(35, 8, 'M.L.'),
(36, 8, 'LL.M.'),
(37, 8, 'Other Master Degree in  Legal'),
(38, 9, 'MHM  (Hotel Management)'),
(39, 9, 'MBA'),
(40, 9, 'PGDM'),
(41, 9, 'MHRM (Human Resource Management)'),
(42, 9, 'MFM (Financial Management)'),
(43, 9, 'Other Master Degree in Management'),
(44, 10, 'MD / MS (Medical)'),
(45, 10, 'MDS'),
(46, 10, 'MVSc'),
(47, 10, 'MPT'),
(48, 10, 'M.Pharm'),
(49, 10, 'Other Master Degree in Medicine'),
(50, 11, 'B.Phil.'),
(51, 11, 'B.Com.'),
(52, 11, 'B.Sc.'),
(53, 11, 'B.A'),
(54, 11, 'B.Ed.'),
(55, 11, 'Aviation Degree'),
(56, 11, 'BFA'),
(57, 11, 'BLIS'),
(58, 11, 'B.S.W'),
(59, 11, 'B.M.M.'),
(60, 11, 'BFT'),
(61, 11, 'Other Bachelor Degree in Arts / Science / Commerce'),
(62, 12, 'BCA'),
(63, 12, 'Aeronautical Engineering'),
(64, 12, 'B.Arch'),
(65, 12, 'B.Plan'),
(66, 12, 'BE'),
(67, 12, 'B.Tech.'),
(68, 12, 'Other Bachelor Degree in Engineering / Computers'),
(69, 12, 'B.Sc IT/ Computer Science'),
(70, 13, 'BGL'),
(71, 13, 'B.L.'),
(72, 13, 'LL.B.'),
(73, 13, 'Other Bachelor Degree in Legal'),
(74, 14, 'BHM (Hotel Management)'),
(75, 14, 'BBA'),
(76, 14, 'BFM (Financial Management)'),
(77, 14, 'Other Bachelor Degree in Management'),
(78, 15, 'MBBS'),
(79, 15, 'BDS'),
(80, 15, 'BVSc'),
(81, 15, 'BPT'),
(82, 15, 'BHMS'),
(83, 15, 'B.A.M.S.'),
(84, 15, 'BPharm'),
(85, 15, 'BSMS'),
(86, 15, 'BUMS'),
(87, 15, 'Other Bachelor Degree in Medicine'),
(88, 15, 'B.Sc. Nursing'),
(89, 16, 'Trade School'),
(90, 16, 'Diploma'),
(91, 16, 'Polytechnic'),
(92, 16, 'Others in Diploma'),
(93, 17, 'Higher Secondary School / High School');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `variables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `slug`, `subject`, `body`, `variables`) VALUES
(1, 'welcome', 'Welcome To Dating', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:550px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<div style=\"border: solid 1px #d9d9d9;\">\r\n						<div style=\"text-align: center;\">&nbsp;</div>\r\n\r\n						<div style=\"text-align: center;\"><img alt=\"\" src=\"\" style=\"width: 296px; height: 41px;\" /></div>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"content\" style=\"color:#444; font-family:arial,sans-serif; font-size:12px; line-height:1.6; margin-left:30px; margin-right:30px; margin-top:15px; width:490px\">\r\n							<tbody>\r\n								<tr>\r\n									<td colspan=\"2\">\r\n									<div style=\"padding: 15px 0;\">Welcome and Congratulations,<br />\r\n									<br />\r\n									<br />\r\n									<br />\r\n									Once again, congratulations and we look forward to working for you.<br />\r\n									<br />\r\n									Administrator,<br />\r\n									[*site_name*]</div>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"footer\" style=\"font-family:arial,sans-serif; font-size:12px; line-height:1.5; margin-left:30px; margin-right:30px; width:490px\">\r\n							<tbody>\r\n								<tr>\r\n									<td colspan=\"2\">\r\n									<div style=\"padding-top: 15px; padding-bottom: 1px;\">&nbsp;</div>\r\n\r\n									<div>For any requests, please contact <a href=\"mailto:[*site_email*]\">[*site_email*]</a></div>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td colspan=\"2\">.</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</div>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 'name,email,login-url,site_name,site_email'),
(2, 'forgot-password', '[Dating] Password Reset', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:550px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<div style=\"border: solid 1px #d9d9d9;\">\r\n						<div style=\"text-align: center;\"><img alt=\"\" src=\"\" style=\"width: 296px; height: 41px;\" /></div>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"content\" style=\"color:#444; font-family:arial,sans-serif; font-size:12px; line-height:1.6; margin-left:30px; margin-right:30px; margin-top:15px; width:490px\">\r\n							<tbody>\r\n								<tr>\r\n									<td colspan=\"2\">\r\n									<div style=\"padding: 15px 0;\">Hi [*name*],<br />\r\n									We received a request to reset your password. If you did not make this request, simply ignore this email. If you did make this request, please click the link below to reset your password:<br />\r\n									<br />\r\n									<strong>[*reset-url*]</strong><br />\r\n									<br />\r\n									If the link above does not work, try copying and pasting it into your browser.<br />\r\n									<br />\r\n									Administrator,<br />\r\n									[*site_name*]</div>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"footer\" style=\"font-family:arial,sans-serif; font-size:12px; line-height:1.5; margin-left:30px; margin-right:30px; width:490px\">\r\n							<tbody>\r\n								<tr>\r\n									<td colspan=\"2\">\r\n									<div style=\"padding-top: 15px; padding-bottom: 1px;\">&nbsp;</div>\r\n\r\n									<div>For any requests, please contact <a href=\"mailto:[*site_email*]\">[*site_email*]</a></div>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td colspan=\"2\">.</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</div>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 'name,reset-url,site_name,site_email'),
(3, 'password-changed', 'Password Change Confirmation', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:550px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<div style=\"border: solid 1px #d9d9d9;\">\r\n						<div style=\"text-align: center;\"><img alt=\"\" src=\"\" style=\"width: 296px; height: 41px;\" /></div>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"content\" style=\"color:#444; font-family:arial,sans-serif; font-size:12px; line-height:1.6; margin-left:30px; margin-right:30px; margin-top:15px; width:490px\">\r\n							<tbody>\r\n								<tr>\r\n									<td colspan=\"2\">\r\n									<div style=\"padding: 15px 0;\">Hi [*name*],<br />\r\n									<br />\r\n									You have successfully changed your password.<br />\r\n									<br />\r\n									<br />\r\n									Administrator,<br />\r\n									[*site_name*]</div>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"footer\" style=\"font-family:arial,sans-serif; font-size:12px; line-height:1.5; margin-left:30px; margin-right:30px; width:490px\">\r\n							<tbody>\r\n								<tr>\r\n									<td colspan=\"2\">\r\n									<div style=\"padding-top: 15px; padding-bottom: 1px;\">&nbsp;</div>\r\n\r\n									<div>For any requests, please contact <a href=\"mailto:[*site_email*]\">[*site_email*]</a></div>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td colspan=\"2\">.</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</div>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 'name,site_name,site_email'),
(10, 'invite-user', 'You\'ve registered to knanaya partner', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:550px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<div style=\"border: solid 1px #d9d9d9;\">\r\n						<div style=\"text-align: center;\"><img alt=\"\" src=\"\" style=\"width: 296px; height: 41px;\" /></div>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"content\" style=\"color:#444; font-family:arial,sans-serif; font-size:12px; line-height:1.6; margin-left:30px; margin-right:30px; margin-top:15px; width:490px\">\r\n							<tbody>\r\n								<tr>\r\n									<td colspan=\"2\">\r\n									<div style=\"padding: 15px 0;\">Hi [*name*],<br />\r\n									<br />\r\n									You have registered to [*site_name*], please click the below link to get activated<br />\r\n									<br />\r\n									<strong>[*invite-url*]</strong><br />\r\n									<br />\r\n									If the link above does not work, try copying and pasting it into your browser.<br />\r\n									<br />\r\n									Administrator,<br />\r\n									[*site_name*]</div>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"footer\" style=\"font-family:arial,sans-serif; font-size:12px; line-height:1.5; margin-left:30px; margin-right:30px; width:490px\">\r\n							<tbody>\r\n								<tr>\r\n									<td colspan=\"2\">\r\n									<div style=\"padding-top: 15px; padding-bottom: 1px;\">&nbsp;</div>\r\n\r\n									<div>For any requests, please contact <a href=\"mailto:[*site_email*]\">[*site_email*]</a></div>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td colspan=\"2\">.</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</div>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 'name,invite-url,site_name,site_email');

-- --------------------------------------------------------

--
-- Table structure for table `family_details`
--

CREATE TABLE `family_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_brother_unmarried` int(11) NOT NULL,
  `no_brother_married` int(11) NOT NULL,
  `no_sister_unmarried` int(11) NOT NULL,
  `no_sister_married` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `person_one` int(11) NOT NULL,
  `person_two` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends_list`
--

CREATE TABLE `friends_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `deactive` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`) VALUES
(1, 'Administrator'),
(2, 'Host');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id_from` int(11) NOT NULL,
  `friend_id_to` int(11) NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `occ_category`
--

CREATE TABLE `occ_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `occ_category`
--

INSERT INTO `occ_category` (`id`, `name`) VALUES
(5, 'ADMINISTRATION'),
(6, 'AGRICULTURE'),
(7, 'AIRLINE'),
(8, 'ARCHITECTURE & DESIGN'),
(9, 'BANKING & FINANCE'),
(10, 'BEAUTY & FASHION'),
(11, 'BPO & CUSTOMER SERVICE'),
(12, 'CIVIL SERVICES'),
(13, 'CORPORATE PROFESSIONALS'),
(14, 'DEFENCE'),
(15, 'EDUCATION & TRAINING'),
(16, 'ENGINEERING'),
(17, 'HOSPITALITY'),
(18, 'IT & SOFTWARE'),
(19, 'LEGAL'),
(20, 'LAW ENFORCEMENT'),
(21, 'MEDICAL & HEALTHCARE'),
(22, 'MEDIA & ENTERTAINMENT'),
(23, 'MERCHANT NAVY'),
(24, 'SCIENTIST'),
(25, 'TOP MANAGEMENT'),
(26, 'OTHERS');

-- --------------------------------------------------------

--
-- Table structure for table `occ_category_list`
--

CREATE TABLE `occ_category_list` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `occ_category_list`
--

INSERT INTO `occ_category_list` (`id`, `category_id`, `name`) VALUES
(6, 5, 'Manager'),
(7, 5, 'Supervisor'),
(8, 5, 'Officer'),
(9, 5, 'Administrative Professional'),
(10, 5, 'Executive'),
(11, 5, 'Clerk'),
(12, 5, 'Human Resources Professional'),
(13, 5, 'Secretary / Front Office'),
(14, 6, 'Agriculture & Farming Professional'),
(15, 6, 'Horticulturist'),
(16, 7, 'Pilot'),
(17, 7, 'Air Hostess / Flight Attendant'),
(18, 7, 'Airline Professional'),
(19, 8, 'Architect'),
(20, 8, 'Interior Designer'),
(21, 9, 'Chartered Accountant'),
(22, 9, 'Company Secretary'),
(23, 9, 'Accounts / Finance Professional'),
(24, 9, 'Banking Service Professional'),
(25, 9, 'Auditor'),
(26, 9, 'Financial Accountant'),
(27, 9, 'Financial Analyst / Planning'),
(28, 9, 'Investment Professional'),
(29, 10, 'Fashion Designer'),
(30, 10, 'Beautician'),
(31, 10, 'Hair Stylist'),
(32, 10, 'Jewellery designer'),
(33, 10, 'Designer (others)'),
(34, 10, 'Makeup Artist'),
(35, 11, 'BPO / KPO / ITes Professional'),
(36, 11, 'Customer Service Professional'),
(37, 12, 'Civil Services (IAS / IES / IFS / IPS / IRS)'),
(38, 13, 'Analyst'),
(39, 13, 'Consultant'),
(40, 13, 'Corporate Communication'),
(41, 13, 'Corporate Planning'),
(42, 13, 'Marketing Professional'),
(43, 13, 'Operations Management'),
(44, 13, 'Sales Professional'),
(45, 13, 'Senior Manager / Manager'),
(46, 13, 'Subject Matter Expert'),
(47, 13, 'Business Development Professional'),
(48, 13, 'Content Writer'),
(49, 14, 'Army'),
(50, 14, 'Navy'),
(51, 14, 'Defence Services (Others)'),
(52, 14, 'Air Force'),
(53, 14, 'Paramilitary'),
(54, 15, 'Professor / Lecturer'),
(55, 15, 'Teaching / Academician'),
(56, 15, 'Education Professional'),
(57, 15, 'Training Professional'),
(58, 15, 'Research Assistant'),
(59, 15, 'Research Scholar'),
(60, 16, 'Civil Engineer'),
(61, 16, 'Electronics / Telecom Engineer'),
(62, 16, 'Mechanical / Production Engineer'),
(63, 16, 'Quality Assurance Engineer - Non IT'),
(64, 16, 'Engineer - Non IT'),
(65, 16, 'Designer'),
(66, 16, 'Product Manager - Non IT'),
(67, 16, 'Project Manager - Non IT'),
(68, 17, 'Hotel / Hospitality Professional'),
(69, 17, 'Restaurant / Catering Professional'),
(70, 17, 'Chef / Cook'),
(71, 18, 'Software Professional'),
(72, 18, 'Hardware Professional'),
(73, 18, 'Product Manager'),
(74, 18, 'Project Manager'),
(75, 18, 'Program Manager'),
(76, 18, 'Animator'),
(77, 18, 'Cyber / Network Security'),
(78, 18, 'UI / UX Designer'),
(79, 18, 'Web / Graphic Designer'),
(80, 18, 'Software Consultant'),
(81, 18, 'Data Analyst'),
(82, 18, 'Data Scientist'),
(83, 18, 'Network Engineer'),
(84, 18, 'Quality Assurance Engineer'),
(85, 19, 'Lawyer & Legal Professional'),
(86, 19, 'Legal Assistant'),
(87, 20, 'Law Enforcement Officer'),
(88, 20, 'Police'),
(89, 21, 'Doctor'),
(90, 21, 'Healthcare Professional'),
(91, 21, 'Paramedical Professional'),
(92, 21, 'Nurse'),
(93, 21, 'Pharmacist'),
(94, 21, 'Physiotherapist'),
(95, 21, 'Psychologist'),
(96, 21, 'Veterinary Doctor'),
(97, 21, 'Dentist'),
(98, 21, 'Surgeon'),
(99, 21, 'Therapist'),
(100, 21, 'Medical Transcriptionist'),
(101, 21, 'Dietician / Nutritionist'),
(102, 21, 'Lab Technician'),
(103, 22, 'Journalist'),
(104, 22, 'Media Professional'),
(105, 22, 'Entertainment Professional'),
(106, 22, 'Event Management Professional'),
(107, 22, 'Advertising / PR Professional'),
(108, 22, 'Designer'),
(109, 22, 'Actor / Model'),
(110, 22, 'Artist'),
(111, 23, 'Mariner / Merchant Navy'),
(112, 23, 'Sailor'),
(113, 24, 'Scientist / Researcher'),
(114, 25, 'CXO / President, Director, Chairman'),
(115, 25, 'VP / AVP / GM / DGM / AGM'),
(116, 26, 'Technician'),
(117, 26, 'Arts & Craftsman'),
(118, 26, 'Librarian'),
(119, 26, 'Business Owner / Entrepreneur'),
(120, 26, 'Transportation / Logistics Professional'),
(121, 26, 'Agent / Broker / Trader'),
(122, 26, 'Contractor'),
(123, 26, 'Fitness Professional'),
(124, 26, 'Security Professional'),
(125, 26, 'Social Worker / Volunteer / NGO'),
(126, 26, 'Sportsperson'),
(127, 26, 'Travel Professional'),
(128, 26, 'Singer'),
(129, 26, 'Writer'),
(130, 26, 'Politician'),
(131, 26, 'Associate'),
(132, 26, 'Builder'),
(133, 26, 'Chemist'),
(134, 26, 'CNC Operator'),
(135, 26, 'Distributor'),
(136, 26, 'Driver'),
(137, 26, 'Freelancer'),
(138, 26, 'Mechanic'),
(139, 26, 'Medical Representative'),
(140, 26, 'Musician'),
(141, 26, 'Photo / Videographer'),
(142, 26, 'Surveyor'),
(143, 26, 'Tailor'),
(144, 26, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `pa_session`
--

CREATE TABLE `pa_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pa_session`
--

INSERT INTO `pa_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('3bf7hunos3kt3cjqumn224i88aen5apk', '::1', 1585204316, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353230343331363b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('ca7j5rfgqcvd44l14d9uprvpvao30agi', '::1', 1585204685, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353230343638353b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('obdk3ai94qha7jh65q2en29s13hi22vk', '::1', 1585205288, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353230353238383b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('2mp7abe7rgb1l1iqef1ct1s827jdnebt', '::1', 1585206305, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353230363330353b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('86ld6mfqod0t7kkcsaml4etv2dmrvp4a', '::1', 1585207164, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353230373136343b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('leda697d8uikclq1deov4vun8dvdq1sk', '::1', 1585207835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353230373833353b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('04tdg6622rua8fs2vo9r8n3hcse8binc', '::1', 1585208149, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353230383134393b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('qdkarojfc86cc9jll3j8arjl0ruboaiq', '::1', 1585211152, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231313135323b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('5h0a8n0erhcbd7c5tjg236rl2or57shh', '::1', 1585211594, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231313539343b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('bi67u8jj9hhums754jgtga3q3h419qgd', '::1', 1585212035, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231323033353b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('p1ph4qno3mem26ju7qbbrar0fe1iqcf3', '::1', 1585213828, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231333832383b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('tncqud8es1ovb7sakci2o31vlh1vsuee', '::1', 1585214678, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231343637383b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('sadlj5l88ae8e29cgcvf164kgupv29nr', '::1', 1585215983, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231353938333b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('al6taigpps74ef7sjh6vqg2kv76oi6ti', '::1', 1585217179, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231373137393b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('s812lvjjl88npegajkpj86vjvco6igv9', '::1', 1585217524, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231373532343b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('n3n1n4f48i50l4t58p1pgsmq3oi1hufi', '::1', 1585218124, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231383132343b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('579dro5nqmju8js115uck7ut1ofvbdn1', '::1', 1585218693, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231383639333b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('uifuuhes3sgg85427qg6e2bnoui35ga7', '::1', 1585219003, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231393030333b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('0i5bs33an6taqa8kj50focn6hs436mh7', '::1', 1585219309, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231393330393b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('i2bk2ump5l9uboghnprk61bksup2npgv', '::1', 1585219613, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353231393631333b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('cvjkkrdltdj078t6r12ge0hjde1erfqv', '::1', 1585220141, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353232303134313b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('sntdv7qt220soelcrobbclkriq40e8b8', '::1', 1585226125, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353232363132353b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('hinrqpo49b61errrpnnh6dgp5j8p25fl', '::1', 1585226709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353232363730393b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('rldf3qm0hpeasi3gp7c71j2qcqaansur', '::1', 1585226709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353232363730393b),
('hp9oiskokkf3anvlm50qcvrhser72eip', '::1', 1585406665, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353430363537323b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('snthkojmda4j4gij7lqfclc6am13i8ci', '::1', 1585562251, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353536323235313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223730223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('0jdqem8a6o5lu8ug67i77798h80adfjb', '::1', 1585562552, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353536323535323b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223730223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('146gm5in9lf3ahbt38v6mqclg804re4j', '::1', 1585563068, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353536333036383b757365726e616d657c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b656d61696c7c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b757365725f69647c733a323a223135223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2231223b),
('9fjr2n5e4u1i25t0lnqjg2f8hkerorun', '::1', 1585563254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353536333036383b757365726e616d657c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b656d61696c7c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b757365725f69647c733a323a223135223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2231223b),
('d22cqrooa2fauqlkqg3n1gklnj7he2bu', '::1', 1585898918, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353839383931383b),
('gtg8b84ih43dt0vsbr50qa8lkftgtnkk', '::1', 1585922166, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932323136363b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('6v2b48oiu8skim909b8i08r7a3m7691d', '::1', 1585922575, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932323537353b),
('tsf78ne31gtp1vt03jkiru3md8bseu1d', '::1', 1585923580, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932333538303b757365726e616d657c733a32353a22726f62696e726f796162726168616d40676d61696c2e636f6d223b656d61696c7c733a32353a22726f62696e726f796162726168616d40676d61696c2e636f6d223b757365725f69647c733a323a223135223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2231223b),
('7rute6k8o0ksdjm9mn2rqqc16qeu43fo', '::1', 1585923884, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932333838343b757365726e616d657c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b656d61696c7c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b757365725f69647c733a323a223135223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2231223b),
('mqs5tub21m9csujq0p74tr91baoncnlm', '::1', 1585924413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932343431333b6d73677c733a35363a22506c6561736520636865636b20796f757220656d61696c206f7220534d5320746f20616374697661746520796f7572206163636f756e7421223b5f5f63695f766172737c613a313a7b733a333a226d7367223b733a333a226f6c64223b7d),
('cnjf9asbp9pub4838r8rl59kiu1m30as', '::1', 1585927205, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932373230353b6d73677c733a35363a22506c6561736520636865636b20796f757220656d61696c206f7220534d5320746f20616374697661746520796f7572206163636f756e7421223b5f5f63695f766172737c613a313a7b733a333a226d7367223b733a333a226f6c64223b7d),
('8gver9dbmh794tnfp73bot5rdqjr3mt5', '::1', 1585927793, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932373739333b757365726e616d657c733a32353a22726f62696e726f796162726168616d40676d61696c2e636f6d223b656d61696c7c733a32353a22726f62696e726f796162726168616d40676d61696c2e636f6d223b757365725f69647c733a323a223739223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('ebrcpuqqsd4lkg0gtrl5adankkvktg70', '::1', 1585928853, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932383835333b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('l4q8r9hi43rkqncbp8bu67eel4m1kv03', '::1', 1585929180, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932393138303b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('clpv0t063kbkffic66sj3keat23n50td', '::1', 1585929264, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353932393138303b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('s80pc95dhuhq79ns29l5dku718l6kcde', '::1', 1585973254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538353937333235343b),
('3ilfri25h8uplnsjj12mr1b7sprv34m3', '::1', 1586068433, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363036383433333b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223730223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('ifvt97peapvvtvqc3a7ctuiu3cmj61ju', '::1', 1586068765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363036383736353b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223730223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('1rljgsinb8bmkgilk1jb2b0mn0pra46f', '::1', 1586069179, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363036393137393b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223730223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('1peib42bf2d902f6kphg86cdln37c25u', '::1', 1586069878, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363036393837383b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('uv6o0m3tqqdupe2s8ai0q234bbne1eel', '::1', 1586070385, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363037303338353b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('qn3ah20i36gkufvb71pujvj0s10uqkev', '::1', 1586070762, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363037303736323b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('rh0h7c0co888um007rhubk3rgkv63hjd', '::1', 1586071167, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363037313136373b),
('gv32vk5hgpp6na7t5jg892gd7024fhe4', '::1', 1586072653, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363037323635333b),
('thc71tufh7jjbv6p23g8411rpljo51si', '::1', 1586072755, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363037323635333b),
('dpmttckcrke12uabj28tb76tfbhnq0mh', '::1', 1586176944, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363137363934343b),
('ugpbvkiig07ro36o6fuhhbv536ntnsg7', '::1', 1586177614, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363137373631343b),
('6imj8qrt1g48bang1uu2r5c1qinivge7', '::1', 1586178936, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363137383933363b),
('6e88h1fe0qf2ripjeteuda5qnk55264v', '::1', 1586179283, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363137393238333b),
('2pusc1osb3m4jm11aufhpf5d5s6ca37m', '::1', 1586180059, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363138303035393b),
('bit8ied4c0ccq7a3ip121nrgnnl8i4ir', '::1', 1586180460, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363138303436303b),
('nu3gd16lvq7osp8lfso6nnvrjb6r5ph1', '::1', 1586180703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363138303436303b),
('hba38hvtln20a9m8f6qb06shu83ski43', '::1', 1586188987, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363138383938373b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('64hk4nb8q6jnk8dtntib3ucbo0bretpg', '::1', 1586189281, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363138393231363b),
('n1ug05jpc8rjcsgjq3a14vkplea6asor', '::1', 1586335865, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363333353836323b),
('pus54kki9bkhlnoir3qdoqbj9d6egopd', '::1', 1586407452, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363430373435323b),
('dmgnkrpdv40bcd92qaimmvnb7b2fn5gn', '::1', 1586434834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363433343833343b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('kv9mcbmfn8784o4vhf1jt8a7sumgr10g', '::1', 1586435202, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363433353230323b757365726e616d657c733a31353a226a65656e6140676d61696c2e636f6d223b656d61696c7c733a31353a226a65656e6140676d61696c2e636f6d223b757365725f69647c733a323a223830223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('1mlf5epe77q87u5a3qiu7kcmrs4h5mol', '::1', 1586435717, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363433353731373b757365726e616d657c733a31353a226a65656e6140676d61696c2e636f6d223b656d61696c7c733a31353a226a65656e6140676d61696c2e636f6d223b757365725f69647c733a323a223830223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('o0v66615tss2obhjq957lkghaon8kj58', '::1', 1586436780, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363433363738303b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('be78td70sct73tcqu63q677o54qfdrhf', '::1', 1586437094, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363433373039343b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('mmfjt1ddmvn6ioeuk8rn6j6arfimq86r', '::1', 1586440826, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434303832363b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('ateoktd8g7s6ieclekf8vv0udcs89rh2', '::1', 1586440851, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434303832363b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('00bbsdep7mi92unmbaq16pgcl3ci8jpd', '::1', 1586453334, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363435333333343b),
('tphicdgq9e62u2a9uv5att4hkq7tfbs8', '::1', 1586453769, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363435333533313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223835223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('37ifqbpbfornh06qo02k2trr1ucdeeel', '::1', 1586604994, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363630343939343b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223836223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('ue2ob2670ge9p46rd2qes262bd1e7l75', '::1', 1586606579, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363630363537393b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('jn1rt7fuf8r81dul8ruhf4spdiis7ccq', '::1', 1586606584, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363630363537393b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('5d2jc6g5ch1ab0jt8kh9gfoiobpcvf9q', '::1', 1586757801, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363735373830313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223836223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('r31k1viblpud48du9f3028ho470q0a98', '::1', 1586758375, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363735383337353b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223836223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('3mph389fqvcqbhbmjnfromppipj80ikh', '::1', 1586758532, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363735383337353b757365726e616d657c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b656d61696c7c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b757365725f69647c733a323a223135223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2231223b),
('f5v3uc2g662ls16pbv9u0sdkuv5lr6q5', '::1', 1586940300, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363934303330303b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('2ulu4k6plqbkd92u04ij265bm03dr7jq', '::1', 1586941317, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363934313331373b),
('ufl7pf4nvibvebs79bkppf0tp4pf7284', '::1', 1586948477, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363934383437373b),
('66nq419hndaglbso8e94u3o9u5bj3kgr', '::1', 1586948778, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363934383737383b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223837223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('fqmn014vgrtjj58412eo89aeklh5lioo', '::1', 1586948821, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363934383832313b),
('njdmt7djuss9daahn92neqk2s3qgtpii', '::1', 1586956418, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363935363431333b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('48o0nvgguj2lsppm0hanemif7gu1iuik', '::1', 1587011126, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373031313132363b),
('qvenikavgipd5o7cn451bqpje3s7200k', '::1', 1587011463, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373031313436333b),
('9p6le3rh8b81q3btcl3262u9u3anathh', '::1', 1587013188, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373031333138383b6d73677c733a35363a22506c6561736520636865636b20796f757220656d61696c206f7220534d5320746f20616374697661746520796f7572206163636f756e7421223b5f5f63695f766172737c613a313a7b733a333a226d7367223b733a333a226f6c64223b7d),
('cagkesmh7a72a026aecnmpeb5k59ec90', '::1', 1587015182, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373031353138323b),
('4a76a29rv7a3910q2i6uo6f6ue473j0s', '::1', 1587015618, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373031353631383b),
('n90avl2lq7ir7hplovb44k1bjnbej7q9', '::1', 1587015980, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373031353938303b),
('ojkke60btt1ovnfplgk0mkf19hobc7ba', '::1', 1587017060, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373031373036303b),
('2edpd5mo6apjhbtvhvva9m9lhuffjtje', '::1', 1587017383, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373031373338333b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223839223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('lp6g6tv1rek49bo1n5rbp8hvspleqj2e', '::1', 1587021670, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373032313637303b),
('rpb1mtn48j4vr77rqrptlneli2ut827i', '::1', 1587022128, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373032323132383b),
('p8lv3ihsh5k8ekc786uitqmatipdoijh', '::1', 1587022128, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373032323132383b),
('igt95dqseadbd3mnordkfibgtmi4cubi', '::1', 1587032013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373033323031333b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223839223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('41jtcn67v5sf0kb8kjc5t6jighg5hph6', '::1', 1587032370, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373033323337303b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223839223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('j9qsvioul4ejhcqui7b05aj5jmm0vve2', '::1', 1587032855, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373033323835353b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223839223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('imnccq0n9svqttvsbs7jl0jri8ofq2al', '::1', 1587033175, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373033333137353b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223839223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('4uk3qnto0aeersbqt3h62d6e7tu7p34n', '::1', 1587033489, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373033333438393b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223839223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('3qnupvv9aagt6df5j19u0026t1tgldue', '::1', 1587033797, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373033333739373b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223839223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('qh1mkmjua9cr6npqv1rn4sl9ce732g1c', '::1', 1587034003, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538373033333739373b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223839223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('708oil8h6taaodtk0qu4jmtj4hs0f1em', '::1', 1588851393, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538383835313339333b),
('deilqeescv4oagclf1rhoiadt6vn33ov', '::1', 1588851393, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538383835313339333b),
('0j6kvfvompnblnni0ohupvvokrtp4b7t', '::1', 1590733595, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303733333537363b),
('9fg1nchl4l4d4qgenoa1l3be1kuibprn', '::1', 1591205072, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313230353037313b),
('6hs4m486omqksmde4f07ke6phj2qlkpr', '::1', 1591688248, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313638383233303b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('2ie0k3u9eplld1hpp9d2i6e8kf3unmv1', '::1', 1591702284, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313730323234363b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('1rs6evms2qoh0mj6d0kphn1oou74i2en', '::1', 1601094328, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313039343332383b),
('v7f1rsmot8q9iju59fjlv7f1i6272hlt', '::1', 1601094728, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313039343732383b),
('djb13ofkulsqpdjba36t3u8n0im9eqkm', '::1', 1601096449, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313039363434393b),
('hehntin0vi28lr3b6h233v50gf5j2nsu', '::1', 1601097107, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313039373130373b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('32nu8sitgbt72in25odrpt41dc5paaj5', '::1', 1601098610, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313039383631303b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('5r3fgt73a34hmr0eve5b0ur7280lcogm', '::1', 1601099071, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313039393037313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('43madl17tvm04cuh3mti96epncm7n20s', '::1', 1601099425, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313039393432353b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('pl8m4ef0gohak4q956u8dagg4g0ni9m9', '::1', 1601099771, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313039393737313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('qe39ijp1fvkvbrhotfmvcpflphghcfbq', '::1', 1601100121, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130303132313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('lrvv2qg9mkdo7mlvlf06gfhs595i5m28', '::1', 1601101395, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130313339353b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('gi6p7k4t0j9ihkll7chjf3f6dg3di2hb', '::1', 1601101972, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130313937323b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('mua1k117k6idhr03fagu26c514m0mnna', '::1', 1601102286, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130323238363b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('6qe520kqmf1j78rmmvh2sptlssvt6cde', '::1', 1601102643, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130323634333b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('5l7gl0fp05plt8pt91pf15acrsuhct2i', '::1', 1601102959, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130323935393b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('1lj4u3345m2aogq0leq17ncp240u2fas', '::1', 1601103278, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130333237383b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('l8cs1itqo89fk4kequvmieie39r9g99u', '::1', 1601104036, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130343033363b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('d09m6vkhg9jbv89j0n2gfeqs9vrpsvln', '::1', 1601104395, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130343339353b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('anj5gdqnoeriqrit8c4i20c794odi0c2', '::1', 1601104764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130343736343b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('aotm0o09q7qpq5hqc5su7t2g97ricsq7', '::1', 1601109818, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313130393831383b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('j8pi6cabsm4qltl02a8ah8a3eqmk5lq3', '::1', 1601110120, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131303132303b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('qq71cuqn48h3clfaa5b9tcsb4ngbbb02', '::1', 1601110571, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131303537313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('1dqrv1lc30tl70k4apbt0tv5fpq00s6a', '::1', 1601111792, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131313739323b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('6oq7hkg4m5sssd0khsr04k1htije0215', '::1', 1601112101, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131323130313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('r1krecafomce2foj5tonuetrfrl4ne3a', '::1', 1601112450, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131323435303b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('rehhsf16uo2rt3jh727our5ns2eb14kv', '::1', 1601112766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131323736363b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('ee00al5n0v3k92gnusde6vi8en6uhf88', '::1', 1601113411, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131333431313b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('5knv7772tn3dli39vbbq98n5r70acq8h', '::1', 1601115033, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131353033333b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('7fpokbtg39gqcho6lcnfqt5bvcnhsf5c', '::1', 1601115839, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131353833393b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('5vndp2oumtcb1hmigf72u4k5an5c23es', '::1', 1601116138, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313131353833393b757365726e616d657c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b656d61696c7c733a32343a22726f62696e2e736d61727469707a40676d61696c2e636f6d223b757365725f69647c733a323a223931223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('176tp2a43kq1k8n6sfv16fik10h8tprd', '::1', 1602054048, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323035343034383b),
('a2ajr5tmpfh0tn27h41o7lgu1egf5nbs', '::1', 1602060262, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323036303236323b),
('gt16mt25gskb5r1414juage9nohfvpmt', '::1', 1602060767, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323036303736373b757365726e616d657c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b656d61696c7c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b757365725f69647c733a323a223135223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2231223b6d73677c733a33303a2253657474696e67732075706461746564207375636365737366756c6c7921223b5f5f63695f766172737c613a313a7b733a333a226d7367223b733a333a226f6c64223b7d),
('k4iec4eormljo09qem087luoba8jdiea', '::1', 1602061306, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323036313330363b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('v6v2lc74se3jh5f0gt91oktr1ni6i9ds', '::1', 1602061379, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323036313330363b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('qj4ml3mt0o75u8qo1e194pof5d46ocio', '::1', 1602139634, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323133393633343b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('2h9lvs3g4v9st8hvtthqafl95cb9bros', '::1', 1602139937, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323133393933373b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('id0t2ofureo7lk0agi0nqt7v5d20eq9r', '::1', 1602140280, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323134303238303b757365726e616d657c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b656d61696c7c733a32343a226b6e616e617961706172746e657240676d61696c2e636f6d223b757365725f69647c733a323a223537223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2232223b),
('l6sbb7hmb5st4tmu1q38sk6ladu5olbu', '::1', 1602141938, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323134313933383b757365726e616d657c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b656d61696c7c733a32363a22726f62696e726f796162726168616d3140676d61696c2e636f6d223b757365725f69647c733a323a223135223b6c6f676765645f696e7c623a313b67726f75705f69647c733a313a2231223b6d73677c733a33303a2253657474696e67732075706461746564207375636365737366756c6c7921223b5f5f63695f766172737c613a313a7b733a333a226d7367223b733a333a226f6c64223b7d),
('n327e3o6r3gnfo2possv60qamoo1kd0o', '::1', 1602141971, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630323134313936383b);

-- --------------------------------------------------------

--
-- Table structure for table `profectional_details`
--

CREATE TABLE `profectional_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `edu_cat` int(11) NOT NULL,
  `edu_item` int(11) NOT NULL,
  `occ_cat` int(11) NOT NULL,
  `employed_in` int(11) NOT NULL,
  `occ_item` int(11) NOT NULL,
  `occ_description` text NOT NULL,
  `income_symbol` varchar(50) NOT NULL,
  `annual_income` varchar(255) NOT NULL,
  `working_country` int(11) NOT NULL,
  `working_city` varchar(255) NOT NULL,
  `resident_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_pics`
--

CREATE TABLE `profile_pics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_type`
--

CREATE TABLE `profile_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_type`
--

INSERT INTO `profile_type` (`id`, `name`) VALUES
(1, 'Myself'),
(2, 'Daughter'),
(3, 'Son'),
(4, 'Sister'),
(5, 'Brother'),
(6, 'Relative'),
(7, 'Friend');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(1, 'Kerala'),
(2, 'Karnataka'),
(3, 'Tamil Nadu'),
(4, 'Uttar Pradesh'),
(5, 'Andhra Pradesh'),
(6, 'Arunachal Pradesh'),
(7, 'Assam'),
(8, 'Bihar'),
(9, 'Chhattisgarh'),
(10, 'Goa'),
(11, 'Gujarat'),
(12, 'Haryana'),
(13, 'Himachal Pradesh'),
(14, 'Jammu and Kashmir'),
(15, 'Jharkhand'),
(16, 'Madhya Pradesh'),
(17, 'Maharashtra'),
(18, 'Manipur'),
(19, 'Meghalaya'),
(20, 'Mizoram'),
(21, 'Nagaland'),
(22, 'Odisha'),
(23, 'Punjab'),
(24, 'Rajasthan'),
(25, 'Sikkim'),
(26, 'Telangana'),
(27, 'Tripura'),
(28, 'Uttarakhand'),
(29, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_declient`
--

CREATE TABLE `tbl_declient` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preference`
--

CREATE TABLE `tbl_preference` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `age_from` int(11) NOT NULL,
  `age_to` int(11) NOT NULL,
  `height_from` int(11) NOT NULL,
  `height_to` int(11) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `smoking_habits` varchar(50) NOT NULL,
  `drinking_habits` varchar(50) NOT NULL,
  `education` varchar(200) NOT NULL,
  `occupation` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `district` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kna_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country_code` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  `password_reset_key` varchar(255) NOT NULL,
  `password_reset_key_expiration` datetime DEFAULT NULL,
  `invite_key` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `profile_type` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `otp` int(11) NOT NULL,
  `otp_expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `kna_id`, `first_name`, `last_name`, `email`, `gender`, `password`, `phone`, `country_code`, `country_id`, `state`, `district`, `city`, `is_active`, `group_id`, `password_reset_key`, `password_reset_key_expiration`, `invite_key`, `image`, `profile_type`, `last_login`, `created_at`, `deleted`, `otp`, `otp_expiration`) VALUES
(15, 0, 'robinrr', 'roy', 'knanayapartner@gmail.com', 'AL', '5f8437b7b2c7f56dc6c6c3e1b0310ff0', '9633713618', 0, 0, 0, 0, '', 1, 1, '', '0000-00-00 00:00:00', '', '4448d29b8de003153552eedebaf1940e.jpg', 0, '2020-10-08 09:06:27', '2016-11-16 08:08:37', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE `user_categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contacted_user` int(11) NOT NULL,
  `licence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `id` int(11) NOT NULL,
  `notify_id` int(11) NOT NULL,
  `notify_from` int(11) NOT NULL,
  `notify_type` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visited_profiles`
--

CREATE TABLE `visited_profiles` (
  `id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_image`
--
ALTER TABLE `album_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_details`
--
ALTER TABLE `basic_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_category`
--
ALTER TABLE `edu_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edu_category_list`
--
ALTER TABLE `edu_category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_details`
--
ALTER TABLE `family_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends_list`
--
ALTER TABLE `friends_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occ_category`
--
ALTER TABLE `occ_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occ_category_list`
--
ALTER TABLE `occ_category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pa_session`
--
ALTER TABLE `pa_session`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `profectional_details`
--
ALTER TABLE `profectional_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_pics`
--
ALTER TABLE `profile_pics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_type`
--
ALTER TABLE `profile_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_declient`
--
ALTER TABLE `tbl_declient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_preference`
--
ALTER TABLE `tbl_preference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visited_profiles`
--
ALTER TABLE `visited_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `album_image`
--
ALTER TABLE `album_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `basic_details`
--
ALTER TABLE `basic_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `core`
--
ALTER TABLE `core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `edu_category`
--
ALTER TABLE `edu_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `edu_category_list`
--
ALTER TABLE `edu_category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `family_details`
--
ALTER TABLE `family_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends_list`
--
ALTER TABLE `friends_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occ_category`
--
ALTER TABLE `occ_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `occ_category_list`
--
ALTER TABLE `occ_category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `profectional_details`
--
ALTER TABLE `profectional_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_pics`
--
ALTER TABLE `profile_pics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_type`
--
ALTER TABLE `profile_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_declient`
--
ALTER TABLE `tbl_declient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_preference`
--
ALTER TABLE `tbl_preference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visited_profiles`
--
ALTER TABLE `visited_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
