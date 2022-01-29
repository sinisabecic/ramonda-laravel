-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2022 at 08:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `name`, `created_at`, `updated_at`) VALUES
                                                                       (1, 'Milana Raickovica bb, Podgorica', NULL, NULL),
                                                                       (2, 'Jozefa Bajze bb, Podgorica', NULL, NULL),
                                                                       (3, 'Partizanski put bb, Podgorica', NULL, NULL),
                                                                       (4, 'Bulevar oslobodjenja 45, Podgorica', NULL, NULL),
                                                                       (5, 'Koce Popovica 46, Podgorica', NULL, NULL),
                                                                       (6, 'Ksenije Cicvaric bb, Podgorica', NULL, NULL),
                                                                       (7, 'OVA TABELA SE VISE NE KORISTI', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
                              `id` int(11) UNSIGNED NOT NULL,
                              `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
                                                                                              (1, 'News', 'news', '2022-01-26 18:24:27', '2022-01-27 14:49:50', NULL),
                                                                                              (3, 'Books', 'books', '2022-01-27 15:03:35', '2022-01-27 15:24:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
                                 `category_id` int(11) UNSIGNED NOT NULL,
                                 `post_id` int(11) UNSIGNED NOT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
                            `id` bigint(20) UNSIGNED NOT NULL,
                            `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            `commentable_id` bigint(20) NOT NULL,
                            `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `created_at`, `updated_at`, `commentable_id`, `commentable_type`) VALUES
                                                                                                               (1, 'Svaka cast Sinisa. Dobro ti ide...', '2021-12-25 20:14:11', NULL, 1, 'App\\Post'),
                                                                                                               (2, 'Partizane jedini, mi za tebe zivimo', '2021-12-25 20:14:11', NULL, 2, 'App\\Post'),
                                                                                                               (3, 'Acerbi treba da ostane u Lazio', '2021-12-25 20:14:11', NULL, 2, 'App\\Post'),
                                                                                                               (4, 'Fejsa nam ne treba, ionako je star', '2021-12-25 20:14:11', NULL, 1, 'App\\Post'),
                                                                                                               (5, 'Svaka cast Sinisa. Dobro ti ide...', '2021-12-25 20:14:11', NULL, 1, 'App\\Video'),
                                                                                                               (6, 'Partizane jedini, mi za tebe zivimo', '2021-12-25 20:14:11', NULL, 4, 'App\\Video'),
                                                                                                               (7, 'Acerbi treba da ostane u Lazio', '2021-12-25 20:14:11', NULL, 4, 'App\\Video'),
                                                                                                               (8, 'Fejsa nam ne treba, ionako je star', '2021-12-25 20:14:11', NULL, 1, 'App\\Video');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
                             `id` int(10) UNSIGNED NOT NULL,
                             `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`, `short_name`) VALUES
                                                                                     (1, 'Albania', NULL, NULL, 'AL'),
                                                                                     (2, 'Algeria', NULL, NULL, 'DZ'),
                                                                                     (3, 'American Samoa', NULL, NULL, 'DS'),
                                                                                     (4, 'Andorra', NULL, NULL, 'AD'),
                                                                                     (5, 'Angola', NULL, NULL, 'AO'),
                                                                                     (6, 'Anguilla', NULL, NULL, 'AI'),
                                                                                     (7, 'Antarctica', NULL, NULL, 'AQ'),
                                                                                     (8, 'Antigua and Barbuda', NULL, NULL, 'AG'),
                                                                                     (9, 'Argentina', NULL, NULL, 'AR'),
                                                                                     (10, 'Armenia', NULL, NULL, 'AM'),
                                                                                     (11, 'Aruba', NULL, NULL, 'AW'),
                                                                                     (12, 'Australia', NULL, NULL, 'AU'),
                                                                                     (13, 'Austria', NULL, NULL, 'AT'),
                                                                                     (14, 'Azerbaijan', NULL, NULL, 'AZ'),
                                                                                     (15, 'Bahamas', NULL, NULL, 'BS'),
                                                                                     (16, 'Bahrain', NULL, NULL, 'BH'),
                                                                                     (17, 'Bangladesh', NULL, NULL, 'BD'),
                                                                                     (18, 'Barbados', NULL, NULL, 'BB'),
                                                                                     (19, 'Belarus', NULL, NULL, 'BY'),
                                                                                     (20, 'Belgium', NULL, NULL, 'BE'),
                                                                                     (21, 'Belize', NULL, NULL, 'BZ'),
                                                                                     (22, 'Benin', NULL, NULL, 'BJ'),
                                                                                     (23, 'Bermuda', NULL, NULL, 'BM'),
                                                                                     (24, 'Bhutan', NULL, NULL, 'BT'),
                                                                                     (25, 'Bolivia', NULL, NULL, 'BO'),
                                                                                     (26, 'Bosnia and Herzegovina', NULL, NULL, 'BA'),
                                                                                     (27, 'Botswana', NULL, NULL, 'BW'),
                                                                                     (28, 'Bouvet Island', NULL, NULL, 'BV'),
                                                                                     (29, 'Brazil', NULL, NULL, 'BR'),
                                                                                     (30, 'British Indian Ocean Territory', NULL, NULL, 'IO'),
                                                                                     (31, 'Brunei Darussalam', NULL, NULL, 'BN'),
                                                                                     (32, 'Bulgaria', NULL, NULL, 'BG'),
                                                                                     (33, 'Burkina Faso', NULL, NULL, 'BF'),
                                                                                     (34, 'Burundi', NULL, NULL, 'BI'),
                                                                                     (35, 'Cambodia', NULL, NULL, 'KH'),
                                                                                     (36, 'Cameroon', NULL, NULL, 'CM'),
                                                                                     (37, 'Canada', NULL, NULL, 'CA'),
                                                                                     (38, 'Cape Verde', NULL, NULL, 'CV'),
                                                                                     (39, 'Cayman Islands', NULL, NULL, 'KY'),
                                                                                     (40, 'Central African Republic', NULL, NULL, 'CF'),
                                                                                     (41, 'Chad', NULL, NULL, 'TD'),
                                                                                     (42, 'Chile', NULL, NULL, 'CL'),
                                                                                     (43, 'China', NULL, NULL, 'CN'),
                                                                                     (44, 'Christmas Island', NULL, NULL, 'CX'),
                                                                                     (45, 'Cocos (Keeling) Islands', NULL, NULL, 'CC'),
                                                                                     (46, 'Colombia', NULL, NULL, 'CO'),
                                                                                     (47, 'Comoros', NULL, NULL, 'KM'),
                                                                                     (48, 'Democratic Republic of the Congo', NULL, NULL, 'CD'),
                                                                                     (49, 'Republic of Congo', NULL, NULL, 'CG'),
                                                                                     (50, 'Cook Islands', NULL, NULL, 'CK'),
                                                                                     (51, 'Costa Rica', NULL, NULL, 'CR'),
                                                                                     (52, 'Croatia (Hrvatska)', NULL, NULL, 'HR'),
                                                                                     (53, 'Cuba', NULL, NULL, 'CU'),
                                                                                     (54, 'Cyprus', NULL, NULL, 'CY'),
                                                                                     (55, 'Czech Republic', NULL, NULL, 'CZ'),
                                                                                     (56, 'Denmark', NULL, NULL, 'DK'),
                                                                                     (57, 'Djibouti', NULL, NULL, 'DJ'),
                                                                                     (58, 'Dominica', NULL, NULL, 'DM'),
                                                                                     (59, 'Dominican Republic', NULL, NULL, 'DO'),
                                                                                     (60, 'East Timor', NULL, NULL, 'TP'),
                                                                                     (61, 'Ecuador', NULL, NULL, 'EC'),
                                                                                     (62, 'Egypt', NULL, NULL, 'EG'),
                                                                                     (63, 'El Salvador', NULL, NULL, 'SV'),
                                                                                     (64, 'Equatorial Guinea', NULL, NULL, 'GQ'),
                                                                                     (65, 'Eritrea', NULL, NULL, 'ER'),
                                                                                     (66, 'Estonia', NULL, NULL, 'EE'),
                                                                                     (67, 'Ethiopia', NULL, NULL, 'ET'),
                                                                                     (68, 'Falkland Islands (Malvinas)', NULL, NULL, 'FK'),
                                                                                     (69, 'Faroe Islands', NULL, NULL, 'FO'),
                                                                                     (70, 'Fiji', NULL, NULL, 'FJ'),
                                                                                     (71, 'Finland', NULL, NULL, 'FI'),
                                                                                     (72, 'France', NULL, NULL, 'FR'),
                                                                                     (73, 'France, Metropolitan', NULL, NULL, 'FX'),
                                                                                     (74, 'French Guiana', NULL, NULL, 'GF'),
                                                                                     (75, 'French Polynesia', NULL, NULL, 'PF'),
                                                                                     (76, 'French Southern Territories', NULL, NULL, 'TF'),
                                                                                     (77, 'Gabon', NULL, NULL, 'GA'),
                                                                                     (78, 'Gambia', NULL, NULL, 'GM'),
                                                                                     (79, 'Georgia', NULL, NULL, 'GE'),
                                                                                     (80, 'Germany', NULL, NULL, 'DE'),
                                                                                     (81, 'Ghana', NULL, NULL, 'GH'),
                                                                                     (82, 'Gibraltar', NULL, NULL, 'GI'),
                                                                                     (83, 'Guernsey', NULL, NULL, 'GK'),
                                                                                     (84, 'Greece', NULL, NULL, 'GR'),
                                                                                     (85, 'Greenland', NULL, NULL, 'GL'),
                                                                                     (86, 'Grenada', NULL, NULL, 'GD'),
                                                                                     (87, 'Guadeloupe', NULL, NULL, 'GP'),
                                                                                     (88, 'Guam', NULL, NULL, 'GU'),
                                                                                     (89, 'Guatemala', NULL, NULL, 'GT'),
                                                                                     (90, 'Guinea', NULL, NULL, 'GN'),
                                                                                     (91, 'Guinea-Bissau', NULL, NULL, 'GW'),
                                                                                     (92, 'Guyana', NULL, NULL, 'GY'),
                                                                                     (93, 'Haiti', NULL, NULL, 'HT'),
                                                                                     (94, 'Heard and Mc Donald Islands', NULL, NULL, 'HM'),
                                                                                     (95, 'Honduras', NULL, NULL, 'HN'),
                                                                                     (96, 'Hong Kong', NULL, NULL, 'HK'),
                                                                                     (97, 'Hungary', NULL, NULL, 'HU'),
                                                                                     (98, 'Iceland', NULL, NULL, 'IS'),
                                                                                     (99, 'India', NULL, NULL, 'IN'),
                                                                                     (100, 'Isle of Man', NULL, NULL, 'IM'),
                                                                                     (101, 'Indonesia', NULL, NULL, 'ID'),
                                                                                     (102, 'Iran (Islamic Republic of)', NULL, NULL, 'IR'),
                                                                                     (103, 'Iraq', NULL, NULL, 'IQ'),
                                                                                     (104, 'Ireland', NULL, NULL, 'IE'),
                                                                                     (105, 'Israel', NULL, NULL, 'IL'),
                                                                                     (106, 'Italy', NULL, NULL, 'IT'),
                                                                                     (107, 'Ivory Coast', NULL, NULL, 'CI'),
                                                                                     (108, 'Jersey', NULL, NULL, 'JE'),
                                                                                     (109, 'Jamaica', NULL, NULL, 'JM'),
                                                                                     (110, 'Japan', NULL, NULL, 'JP'),
                                                                                     (111, 'Jordan', NULL, NULL, 'JO'),
                                                                                     (112, 'Kazakhstan', NULL, NULL, 'KZ'),
                                                                                     (113, 'Kenya', NULL, NULL, 'KE'),
                                                                                     (114, 'Kiribati', NULL, NULL, 'KI'),
                                                                                     (115, 'Korea, Democratic People\'s Republic of', NULL, NULL, 'KP'),
(116, 'Korea, Republic of', NULL, NULL, 'KR'),
(117, 'Kosovo', NULL, NULL, 'XK'),
(118, 'Kuwait', NULL, NULL, 'KW'),
(119, 'Kyrgyzstan', NULL, NULL, 'KG'),
(120, 'Lao People\'s Democratic Republic', NULL, NULL, 'LA'),
                                                                                     (121, 'Latvia', NULL, NULL, 'LV'),
                                                                                     (122, 'Lebanon', NULL, NULL, 'LB'),
                                                                                     (123, 'Lesotho', NULL, NULL, 'LS'),
                                                                                     (124, 'Liberia', NULL, NULL, 'LR'),
                                                                                     (125, 'Libyan Arab Jamahiriya', NULL, NULL, 'LY'),
                                                                                     (126, 'Liechtenstein', NULL, NULL, 'LI'),
                                                                                     (127, 'Lithuania', NULL, NULL, 'LT'),
                                                                                     (128, 'Luxembourg', NULL, NULL, 'LU'),
                                                                                     (129, 'Macau', NULL, NULL, 'MO'),
                                                                                     (130, 'North Macedonia', NULL, NULL, 'MK'),
                                                                                     (131, 'Madagascar', NULL, NULL, 'MG'),
                                                                                     (132, 'Malawi', NULL, NULL, 'MW'),
                                                                                     (133, 'Malaysia', NULL, NULL, 'MY'),
                                                                                     (134, 'Maldives', NULL, NULL, 'MV'),
                                                                                     (135, 'Mali', NULL, NULL, 'ML'),
                                                                                     (136, 'Malta', NULL, NULL, 'MT'),
                                                                                     (137, 'Marshall Islands', NULL, NULL, 'MH'),
                                                                                     (138, 'Martinique', NULL, NULL, 'MQ'),
                                                                                     (139, 'Mauritania', NULL, NULL, 'MR'),
                                                                                     (140, 'Mauritius', NULL, NULL, 'MU'),
                                                                                     (141, 'Mayotte', NULL, NULL, 'TY'),
                                                                                     (142, 'Mexico', NULL, NULL, 'MX'),
                                                                                     (143, 'Micronesia, Federated States of', NULL, NULL, 'FM'),
                                                                                     (144, 'Moldova, Republic of', NULL, NULL, 'MD'),
                                                                                     (145, 'Monaco', NULL, NULL, 'MC'),
                                                                                     (146, 'Mongolia', NULL, NULL, 'MN'),
                                                                                     (147, 'Montenegro', NULL, NULL, 'ME'),
                                                                                     (148, 'Montserrat', NULL, NULL, 'MS'),
                                                                                     (149, 'Morocco', NULL, NULL, 'MA'),
                                                                                     (150, 'Mozambique', NULL, NULL, 'MZ'),
                                                                                     (151, 'Myanmar', NULL, NULL, 'MM'),
                                                                                     (152, 'Namibia', NULL, NULL, 'NA'),
                                                                                     (153, 'Nauru', NULL, NULL, 'NR'),
                                                                                     (154, 'Nepal', NULL, NULL, 'NP'),
                                                                                     (155, 'Netherlands', NULL, NULL, 'NL'),
                                                                                     (156, 'Netherlands Antilles', NULL, NULL, 'AN'),
                                                                                     (157, 'New Caledonia', NULL, NULL, 'NC'),
                                                                                     (158, 'New Zealand', NULL, NULL, 'NZ'),
                                                                                     (159, 'Nicaragua', NULL, NULL, 'NI'),
                                                                                     (160, 'Niger', NULL, NULL, 'NE'),
                                                                                     (161, 'Nigeria', NULL, NULL, 'NG'),
                                                                                     (162, 'Niue', NULL, NULL, 'NU'),
                                                                                     (163, 'Norfolk Island', NULL, NULL, 'NF'),
                                                                                     (164, 'Northern Mariana Islands', NULL, NULL, 'MP'),
                                                                                     (165, 'Norway', NULL, NULL, 'NO'),
                                                                                     (166, 'Oman', NULL, NULL, 'OM'),
                                                                                     (167, 'Pakistan', NULL, NULL, 'PK'),
                                                                                     (168, 'Palau', NULL, NULL, 'PW'),
                                                                                     (169, 'Palestine', NULL, NULL, 'PS'),
                                                                                     (170, 'Panama', NULL, NULL, 'PA'),
                                                                                     (171, 'Papua New Guinea', NULL, NULL, 'PG'),
                                                                                     (172, 'Paraguay', NULL, NULL, 'PY'),
                                                                                     (173, 'Peru', NULL, NULL, 'PE'),
                                                                                     (174, 'Philippines', NULL, NULL, 'PH'),
                                                                                     (175, 'Pitcairn', NULL, NULL, 'PN'),
                                                                                     (176, 'Poland', NULL, NULL, 'PL'),
                                                                                     (177, 'Portugal', NULL, NULL, 'PT'),
                                                                                     (178, 'Puerto Rico', NULL, NULL, 'PR'),
                                                                                     (179, 'Qatar', NULL, NULL, 'QA'),
                                                                                     (180, 'Reunion', NULL, NULL, 'RE'),
                                                                                     (181, 'Romania', NULL, NULL, 'RO'),
                                                                                     (182, 'Russian Federation', NULL, NULL, 'RU'),
                                                                                     (183, 'Rwanda', NULL, NULL, 'RW'),
                                                                                     (184, 'Saint Kitts and Nevis', NULL, NULL, 'KN'),
                                                                                     (185, 'Saint Lucia', NULL, NULL, 'LC'),
                                                                                     (186, 'Saint Vincent and the Grenadines', NULL, NULL, 'VC'),
                                                                                     (187, 'Samoa', NULL, NULL, 'WS'),
                                                                                     (188, 'San Marino', NULL, NULL, 'SM'),
                                                                                     (189, 'Sao Tome and Principe', NULL, NULL, 'ST'),
                                                                                     (190, 'Saudi Arabia', NULL, NULL, 'SA'),
                                                                                     (191, 'Senegal', NULL, NULL, 'SN'),
                                                                                     (192, 'Serbia', NULL, NULL, 'RS'),
                                                                                     (193, 'Seychelles', NULL, NULL, 'SC'),
                                                                                     (194, 'Sierra Leone', NULL, NULL, 'SL'),
                                                                                     (195, 'Singapore', NULL, NULL, 'SG'),
                                                                                     (196, 'Slovakia', NULL, NULL, 'SK'),
                                                                                     (197, 'Slovenia', NULL, NULL, 'SI'),
                                                                                     (198, 'Solomon Islands', NULL, NULL, 'SB'),
                                                                                     (199, 'Somalia', NULL, NULL, 'SO'),
                                                                                     (200, 'South Africa', NULL, NULL, 'ZA'),
                                                                                     (201, 'South Georgia South Sandwich Islands', NULL, NULL, 'GS'),
                                                                                     (202, 'South Sudan', NULL, NULL, 'SS'),
                                                                                     (203, 'Spain', NULL, NULL, 'ES'),
                                                                                     (204, 'Sri Lanka', NULL, NULL, 'LK'),
                                                                                     (205, 'St. Helena', NULL, NULL, 'SH'),
                                                                                     (206, 'St. Pierre and Miquelon', NULL, NULL, 'PM'),
                                                                                     (207, 'Sudan', NULL, NULL, 'SD'),
                                                                                     (208, 'Suriname', NULL, NULL, 'SR'),
                                                                                     (209, 'Svalbard and Jan Mayen Islands', NULL, NULL, 'SJ'),
                                                                                     (210, 'Swaziland', NULL, NULL, 'SZ'),
                                                                                     (211, 'Sweden', NULL, NULL, 'SE'),
                                                                                     (212, 'Switzerland', NULL, NULL, 'CH'),
                                                                                     (213, 'Syrian Arab Republic', NULL, NULL, 'SY'),
                                                                                     (214, 'Taiwan', NULL, NULL, 'TW'),
                                                                                     (215, 'Tajikistan', NULL, NULL, 'TJ'),
                                                                                     (216, 'Tanzania, United Republic of', NULL, NULL, 'TZ'),
                                                                                     (217, 'Thailand', NULL, NULL, 'TH'),
                                                                                     (218, 'Togo', NULL, NULL, 'TG'),
                                                                                     (219, 'Tokelau', NULL, NULL, 'TK'),
                                                                                     (220, 'Tonga', NULL, NULL, 'TO'),
                                                                                     (221, 'Trinidad and Tobago', NULL, NULL, 'TT'),
                                                                                     (222, 'Tunisia', NULL, NULL, 'TN'),
                                                                                     (223, 'Turkey', NULL, NULL, 'TR'),
                                                                                     (224, 'Turkmenistan', NULL, NULL, 'TM'),
                                                                                     (225, 'Turks and Caicos Islands', NULL, NULL, 'TC'),
                                                                                     (226, 'Tuvalu', NULL, NULL, 'TV'),
                                                                                     (227, 'Uganda', NULL, NULL, 'UG'),
                                                                                     (228, 'Ukraine', NULL, NULL, 'UA'),
                                                                                     (229, 'United Arab Emirates', NULL, NULL, 'AE'),
                                                                                     (230, 'United Kingdom', NULL, NULL, 'GB'),
                                                                                     (231, 'United States', NULL, NULL, 'US'),
                                                                                     (232, 'United States minor outlying islands', NULL, NULL, 'UM'),
                                                                                     (233, 'Uruguay', NULL, NULL, 'UY'),
                                                                                     (234, 'Uzbekistan', NULL, NULL, 'UZ'),
                                                                                     (235, 'Vanuatu', NULL, NULL, 'VU'),
                                                                                     (236, 'Vatican City State', NULL, NULL, 'VA'),
                                                                                     (237, 'Venezuela', NULL, NULL, 'VE'),
                                                                                     (238, 'Vietnam', NULL, NULL, 'VN'),
                                                                                     (239, 'Virgin Islands (British)', NULL, NULL, 'VG'),
                                                                                     (240, 'Virgin Islands (U.S.)', NULL, NULL, 'VI'),
                                                                                     (241, 'Wallis and Futuna Islands', NULL, NULL, 'WF'),
                                                                                     (242, 'Western Sahara', NULL, NULL, 'EH'),
                                                                                     (243, 'Yemen', NULL, NULL, 'YE'),
                                                                                     (244, 'Zambia', NULL, NULL, 'ZM'),
                                                                                     (245, 'Zimbabwe', NULL, NULL, 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
                               `id` bigint(20) UNSIGNED NOT NULL,
                               `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
                              `id` int(10) UNSIGNED NOT NULL,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
                                                          (1, '2014_10_12_000000_create_users_table', 1),
                                                          (2, '2014_10_12_100000_create_password_resets_table', 1),
                                                          (3, '2019_08_19_000000_create_failed_jobs_table', 1),
                                                          (4, '2021_12_22_154434_create_posts_table', 1),
                                                          (5, '2021_12_22_155107_add_user_id_on_posts_table', 1),
                                                          (6, '2021_12_23_212333_add_column_deleted_at_to_posts', 1),
                                                          (7, '2021_12_24_121745_create_roles_table', 1),
                                                          (8, '2021_12_24_123041_create_users_roles_table', 1),
                                                          (9, '2021_12_24_142430_create_countries_table', 1),
                                                          (10, '2021_12_24_143307_add_short_name_column_to_countries', 1),
                                                          (11, '2021_12_24_160715_create_photos_table', 1),
                                                          (12, '2021_12_24_180135_create_videos_table', 1),
                                                          (13, '2021_12_24_180150_create_tags_table', 1),
                                                          (14, '2021_12_24_180215_create_taggables_table', 1),
                                                          (15, '2021_12_24_220937_create_addresses_table', 1),
                                                          (16, '2021_12_24_223914_add_column_deleted_at_to_users', 2),
                                                          (17, '2021_12_24_233847_create_staff_table', 3),
                                                          (18, '2021_12_24_233907_create_products_table', 3),
                                                          (19, '2021_12_25_161138_add_url_column_to_photos_table', 4),
                                                          (20, '2021_12_25_201050_create_comments_table', 5),
                                                          (21, '2021_12_25_201112_create_commentables_table', 5),
                                                          (22, '2021_12_25_203857_add_some_columns_to_comments_table', 6),
                                                          (23, '2021_12_28_011525_add_column_path_to_posts_table', 7),
                                                          (24, '2021_12_29_010201_add_column_address_to_users_table', 8),
                                                          (25, '2022_01_25_145532_create_sessions_table', 9),
                                                          (26, '2022_01_25_153652_add_is_active_to_users', 10),
                                                          (27, '2022_01_26_183415_create_categories_table', 11),
                                                          (28, '2022_01_26_184121_add_deleted_at_column_categories_tale', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
                               `id` int(11) NOT NULL,
                               `name` varchar(255) COLLATE latin1_bin NOT NULL,
                               `slug` varchar(255) COLLATE latin1_bin NOT NULL,
                               `description` text COLLATE latin1_bin DEFAULT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
                                                                                                              (1, 'Full Control', 'full-control', 'User has all privileges', '2022-01-21 16:42:59', '2022-01-24 15:47:39', NULL),
                                                                                                              (2, 'View Dashboard', 'view-dashboard', 'User can only view a dashboard.', '2022-01-20 18:00:51', '2022-01-24 15:57:28', NULL),
                                                                                                              (8, 'View Only', 'view-only', 'Enables users to view application pages. The View Only permission level is used for the Excel Services Viewers group.', '2022-01-22 01:21:35', '2022-01-22 01:21:35', NULL),
                                                                                                              (9, 'Limited Access', 'limited-access', 'Enables users to access shared resources and a specific asset. Limited Access is designed to be combined with fine-grained permissions to enable users to access a specific list, document library, folder, list item, or document, without enabling them to access the whole site. Limited Access cannot be edited or deleted.', '2022-01-22 01:23:24', '2022-01-22 01:23:24', NULL),
                                                                                                              (10, 'Read', 'read', 'Enables users to view pages and list items, and to download documents.', '2022-01-22 01:23:39', '2022-01-22 01:23:39', NULL),
                                                                                                              (11, 'Contribute', 'contribute', 'Enables users to manage personal views, edit items and user information, delete versions in existing lists and document libraries, and add, remove, and update personal Web Parts.', '2022-01-22 01:23:54', '2022-01-22 01:23:54', NULL),
                                                                                                              (12, 'Edit', 'edit', 'Enables users to manage lists.', '2022-01-22 01:24:03', '2022-01-24 15:20:28', NULL),
                                                                                                              (14, 'Design', 'design', 'Enables users to view, add, update, delete, approve, and customize items or pages in the website.', '2022-01-22 01:31:12', '2022-01-24 15:22:14', NULL),
                                                                                                              (17, 'No access', 'no-access', 'The user doesn’t have access to anything.', '2022-01-24 15:44:30', '2022-01-24 15:44:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
                                   `permission_id` int(11) NOT NULL,
                                   `role_id` int(11) NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
                                                                                           (1, 1, '2022-01-20 18:04:30', NULL),
                                                                                           (2, 6, '2022-01-22 16:45:29', NULL),
                                                                                           (2, 14, '2022-01-24 15:23:55', NULL),
                                                                                           (9, 2, '2022-01-22 17:08:27', NULL),
                                                                                           (9, 5, '2022-01-22 17:09:05', NULL),
                                                                                           (10, 3, '2022-01-22 16:57:47', NULL),
                                                                                           (10, 14, '2022-01-24 15:23:55', NULL),
                                                                                           (11, 4, '2022-01-22 17:08:57', NULL),
                                                                                           (11, 6, '2022-01-22 17:09:41', NULL),
                                                                                           (12, 6, '2022-01-22 16:45:29', NULL),
                                                                                           (12, 14, '2022-01-24 15:23:55', NULL),
                                                                                           (14, 6, '2022-01-22 16:45:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
                                   `permission_id` int(11) NOT NULL,
                                   `user_id` bigint(20) NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `created_at`, `updated_at`) VALUES
    (1, 1, '2022-01-21 16:44:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
                          `id` bigint(20) UNSIGNED NOT NULL,
                          `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.jpg',
                          `imageable_id` bigint(20) UNSIGNED NOT NULL,
                          `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `url`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
                                                                                                     (2, 'post_image.jpg', 3, 'App\\Staff', '2021-12-24 15:39:36', '2021-12-25 17:56:04'),
                                                                                                     (3, 'laravel.jpg', 96, 'App\\Post', '2021-12-24 15:39:36', '2021-12-25 17:54:05'),
                                                                                                     (4, 'post_image2.jpg', 96, 'App\\Post', '2022-01-28 13:06:30', '2022-01-28 13:06:33'),
                                                                                                     (7, 'avatar-372-456324-300x300.png', 3, 'App\\User', '2021-12-25 16:54:02', '2022-01-28 18:55:35'),
                                                                                                     (11, 'images.png', 2, 'App\\User', '2022-01-16 21:18:50', '2022-01-29 19:13:20'),
                                                                                                     (12, 'default.jpg', 127, 'App\\User', '2022-01-17 02:42:16', '2022-01-17 02:42:16'),
                                                                                                     (13, 'avatar-372-456324-300x300.png', 1, 'App\\User', '2022-01-28 16:54:14', '2022-01-29 18:56:21'),
                                                                                                     (14, 'Trip Vutra.png', 203, 'App\\User', '2022-01-28 17:23:24', '2022-01-28 17:23:24'),
                                                                                                     (15, '20200917_181426.jpg', 204, 'App\\User', '2022-01-28 18:13:06', '2022-01-28 18:13:06'),
                                                                                                     (16, 'images.png', 205, 'App\\User', '2022-01-28 18:59:26', '2022-01-29 15:46:20'),
                                                                                                     (17, 'png-transparent-avatar-user-computer-icons-software-developer-avatar-child-face-heroes-thumbnail.png', 206, 'App\\User', '2022-01-29 15:47:41', '2022-01-29 18:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
                         `id` int(11) UNSIGNED NOT NULL,
                         `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
                         `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `user_id` bigint(20) UNSIGNED NOT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `banner` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `slug`, `created_at`, `updated_at`, `user_id`, `deleted_at`, `banner`) VALUES
    (98, 'Libero quibusdam labore corpor', '<p>Libero quibusdam labore corporLibero quibusdam labore corporLibero quibusdam labore corporLibero quibusdam labore corpor</p>', 'libero-quibusdam-labore-corpor', '2022-01-23 22:12:38', '2022-01-24 16:04:53', 2, NULL, 'rosette-nebula-1920×1080.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
                            `id` bigint(20) UNSIGNED NOT NULL,
                            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
                                                                      (1, 'Addidas Gazelle', '2021-12-25 17:36:19', NULL),
                                                                      (2, 'Nike patike Air Max', '2021-12-25 17:36:19', NULL),
                                                                      (3, 'Umbro patike', '2021-12-25 17:36:19', NULL),
                                                                      (4, 'Cronos rukavice', '2021-12-25 17:36:19', NULL),
                                                                      (5, 'Znojnik', '2021-12-25 17:36:19', NULL),
                                                                      (6, 'Skije', '2021-12-25 17:36:19', NULL),
                                                                      (7, 'Elle jakna', '2021-12-25 17:36:19', NULL),
                                                                      (8, 'McKinley duks crni', '2021-12-25 17:36:19', NULL),
                                                                      (9, 'Kacket Nike', '2021-12-25 17:36:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
                         `id` int(11) NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
                                                                                         (1, 'Admin', 'admin', '2021-12-24 13:44:06', '2022-01-27 14:46:57', NULL),
                                                                                         (2, 'Subscriber', 'subscriber', '2021-12-24 13:44:06', '2022-01-21 17:33:32', NULL),
                                                                                         (3, 'User', 'user', '2021-12-24 13:44:06', '2022-01-23 23:58:32', NULL),
                                                                                         (4, 'Partner', 'partner', '2021-12-24 23:08:59', '2022-01-21 18:10:26', NULL),
                                                                                         (5, 'Nomad', 'nomad', '2021-12-24 23:08:59', '2022-01-21 23:46:36', NULL),
                                                                                         (6, 'Author', 'author', '2021-12-24 23:08:59', '2022-01-21 23:48:17', NULL),
                                                                                         (14, 'Manager', 'manager', '2022-01-24 15:23:55', '2022-01-24 15:23:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
                             `user_id` bigint(20) UNSIGNED NOT NULL,
                             `role_id` int(11) NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
                                                                               (1, 1, '2022-01-17 15:16:23', NULL),
                                                                               (1, 14, '2022-01-29 19:27:06', NULL),
                                                                               (2, 6, '2022-01-23 23:54:09', NULL),
                                                                               (3, 6, '2022-01-23 18:12:40', NULL),
                                                                               (205, 2, '2022-01-28 18:59:26', NULL),
                                                                               (206, 5, '2022-01-29 15:47:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
                            `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `user_id` bigint(20) UNSIGNED DEFAULT NULL,
                            `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
                            `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `created_at`, `updated_at`) VALUES
                                                                   (1, 'Siniša Bečić', '2021-12-25 17:33:24', NULL),
                                                                   (2, 'Marko Markovic', '2021-12-25 17:33:24', NULL),
                                                                   (3, 'Iva Bubanja', '2021-12-25 17:33:24', NULL),
                                                                   (4, 'Kristina K.', '2021-12-25 17:33:24', NULL),
                                                                   (5, 'Jana Kostelic', '2021-12-25 17:33:24', NULL),
                                                                   (6, 'Ivica Kostelic', '2021-12-25 17:33:24', NULL),
                                                                   (7, 'Nenad Aranitovic', '2021-12-25 17:33:24', NULL),
                                                                   (8, 'Pedja Bujisic', '2021-12-25 17:33:24', NULL),
                                                                   (9, 'Nikola Cupic', '2021-12-25 16:42:26', '2021-12-25 16:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
                             `tag_id` bigint(20) NOT NULL,
                             `taggable_id` bigint(20) NOT NULL,
                             `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggables`
--

INSERT INTO `taggables` (`tag_id`, `taggable_id`, `taggable_type`) VALUES
                                                                       (1, 1, 'App\\Post'),
                                                                       (3, 2, 'App\\Post'),
                                                                       (1, 1, 'App\\Video'),
                                                                       (2, 2, 'App\\Video'),
                                                                       (3, 3, 'App\\Video'),
                                                                       (3, 1, 'App\\Video'),
                                                                       (2, 7, 'App\\Post'),
                                                                       (2, 9, 'App\\Post'),
                                                                       (3, 5, 'App\\Video'),
                                                                       (7, 1, 'App\\Post'),
                                                                       (2, 2, 'App\\Post'),
                                                                       (2, 6, 'App\\Post'),
                                                                       (5, 95, 'App\\Post');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
                        `id` bigint(20) UNSIGNED NOT NULL,
                        `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `created_at` timestamp NULL DEFAULT NULL,
                        `updated_at` timestamp NULL DEFAULT NULL,
                        `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
                                                                                        (1, 'sport', 'sport', '2021-12-24 22:30:47', '2022-01-28 12:10:54', NULL),
                                                                                        (2, 'education', 'education', '2021-12-24 22:31:00', '2022-01-21 23:38:13', NULL),
                                                                                        (3, 'science', 'science', '2022-01-21 23:38:00', '2022-01-21 23:38:15', NULL),
                                                                                        (4, 'lazio', 'lazio', '2022-01-21 23:38:02', '2022-01-21 23:38:16', NULL),
                                                                                        (5, 'partizan', 'partizan', '2022-01-21 23:38:04', '2022-01-23 23:26:02', '2022-01-23 23:26:02'),
                                                                                        (7, 'Ramonda', 'ramonda', '2022-01-21 23:38:08', '2022-01-23 23:25:50', NULL),
                                                                                        (8, 'framework', 'framework', '2022-01-21 23:38:10', '2022-01-23 00:45:02', NULL),
                                                                                        (9, 'Vlada Crne Gore', 'vlada-crne-gore', '2022-01-23 00:10:06', '2022-01-23 00:10:06', NULL),
                                                                                        (10, 'politika', 'politika', '2022-01-23 00:44:07', '2022-01-23 00:44:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `country_id` bigint(20) UNSIGNED NOT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `is_active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `country_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `address`, `username`, `is_active`) VALUES
                                                                                                                                                                                               (1, 'Siniša B.', 'sinisa.becic@outlook.com', NULL, '$2y$10$BULDfOciXbXO3vjtylZnzuD/8AnEgCCsoCeN5JN73AjqHmyubr8Ku', 147, 'aRDQHnInxniZK7zWusDCvML4KGGMqvSZMxQUbjasLj0L0atAvACNHNxmi2TV', '2021-12-28 23:26:57', '2022-01-28 18:10:42', NULL, 'Partizanski put bb', 'sinisa', 1),
                                                                                                                                                                                               (2, 'Ema Anderson', 'ema@mail.com', NULL, '$2y$10$tIfFog5g8I1ymoMmuhB8zuHfykUhPdZCXmbX4LI/MQYXvKsmfZl/6', 2, NULL, '2022-01-22 17:37:39', '2022-01-29 19:28:27', NULL, 'Deserunt repudiandae dolorem e', 'ema', 1),
                                                                                                                                                                                               (3, 'Ivan Radović', 'ivan@mail.com', NULL, '$2y$10$1Rrva/TJWJWMX0ike3jAH./Ej8Dt5X7S8dUdWEqeyB7Be.LFJXjj2', 147, NULL, '2021-12-24 12:55:38', '2022-01-28 18:34:42', NULL, 'Momisici', 'ivan', 1),
                                                                                                                                                                                               (205, 'Paula Estes', 'gipe@mailinator.com', NULL, '$2y$10$jN6s.o/2Si0TQW5hEjK8e.197FWkv8Uuom3sUS7ByP5NcWoJE2M6G', 69, NULL, '2022-01-28 18:59:26', '2022-01-29 15:46:46', NULL, 'Iure quo aut facilis doloribus', 'vodakywin', 0),
                                                                                                                                                                                               (206, 'Raphael Barker', 'jixowybi@mailinator.com', NULL, '$2y$10$iGbCQ2vtQ642TV.5VVRp2..3qoosIdYMXfHEO7uGcAxPn7U8We0fC', 94, NULL, '2022-01-29 15:47:41', '2022-01-29 15:47:41', NULL, 'Tempora odit qui est quia acc', 'tapesif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
                          `id` bigint(20) UNSIGNED NOT NULL,
                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `created_at`, `updated_at`) VALUES
                                                                    (1, 'DiEM TV Christmas Special: Radical Lessons From 2021 — with Noam Chomsky and Yanis Varoufakis', '2021-12-25 20:57:57', NULL),
                                                                    (2, 'Savremeni pisci: Dušan Kovačević - drama koja traje', '2021-12-25 20:57:57', NULL),
                                                                    (3, 'Nepoželjna sloboda - Peščanik', '2021-12-25 20:57:57', NULL),
                                                                    (4, 'The Stranglers - This song', '2021-12-25 20:57:57', NULL),
                                                                    (5, 'My first video', '2021-12-25 20:40:42', '2021-12-25 20:40:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
    ADD PRIMARY KEY (`category_id`,`post_id`),
  ADD UNIQUE KEY `category_id` (`category_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
    ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
    ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
    ADD PRIMARY KEY (`permission_id`,`user_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_title_unique` (`title`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
    ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
    ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
    MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
    MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_post`
--
ALTER TABLE `category_post`
    ADD CONSTRAINT `category_post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_post_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
    ADD CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
    ADD CONSTRAINT `permission_user_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
    ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
    ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
