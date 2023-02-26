-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2023 at 12:44 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_db_ss_multiplatformv1`
--

-- --------------------------------------------------------

--
-- Table structure for table `prefix_ssmv1_users`
--

CREATE TABLE `prefix_ssmv1_users` (
  `id` bigint(20) NOT NULL DEFAULT '0',
  `id_parent` bigint(20) NOT NULL DEFAULT '0',
  `sort_order` decimal(64,30) NOT NULL DEFAULT '0.000000000000000000000000000000',
  `date_creation` datetime DEFAULT NULL,
  `date_timezone` varchar(255) DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `id_type` int(11) NOT NULL DEFAULT '0' COMMENT '1 - administrator (all functions) | 2 - (browse records)  | 3 - (include records) | 4 - (edit records) | 5 - (delete records)',
  `name_title` text,
  `name_full` text,
  `name_first` text,
  `name_last` text,
  `date_birth` datetime DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - not specified | 1 - male | 2 - female',
  `document` text,
  `address_street` text,
  `address_number` text,
  `address_complement` text,
  `neighborhood` text,
  `district` text,
  `county` text,
  `city` text,
  `state` text,
  `country` text,
  `zip_code` text,
  `phone1_international_code` text,
  `phone1_area_code` text,
  `phone1` text,
  `phone2_international_code` text,
  `phone2_area_code` text,
  `phone2` text,
  `phone3_international_code` text,
  `phone3_area_code` text,
  `phone3` text,
  `username` text,
  `email` text,
  `password` longtext,
  `password_hint` text,
  `password_length` text,
  `info1` longtext,
  `info2` longtext,
  `info3` longtext,
  `info4` longtext,
  `info5` longtext,
  `info6` longtext,
  `info7` longtext,
  `info8` longtext,
  `info9` longtext,
  `info10` longtext,
  `image_main` text,
  `activation` tinyint(1) NOT NULL DEFAULT '0',
  `activation1` tinyint(1) NOT NULL DEFAULT '0',
  `activation2` tinyint(1) NOT NULL DEFAULT '0',
  `activation3` tinyint(1) NOT NULL DEFAULT '0',
  `activation4` tinyint(1) NOT NULL DEFAULT '0',
  `activation5` tinyint(1) NOT NULL DEFAULT '0',
  `id_status` bigint(20) NOT NULL DEFAULT '0',
  `notes` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prefix_ssmv1_users`
--

INSERT INTO `prefix_ssmv1_users` (`id`, `id_parent`, `sort_order`, `date_creation`, `date_timezone`, `date_edit`, `id_type`, `name_title`, `name_full`, `name_first`, `name_last`, `date_birth`, `gender`, `document`, `address_street`, `address_number`, `address_complement`, `neighborhood`, `district`, `county`, `city`, `state`, `country`, `zip_code`, `phone1_international_code`, `phone1_area_code`, `phone1`, `phone2_international_code`, `phone2_area_code`, `phone2`, `phone3_international_code`, `phone3_area_code`, `phone3`, `username`, `email`, `password`, `password_hint`, `password_length`, `info1`, `info2`, `info3`, `info4`, `info5`, `info6`, `info7`, `info8`, `info9`, `info10`, `image_main`, `activation`, `activation1`, `activation2`, `activation3`, `activation4`, `activation5`, `id_status`, `notes`) VALUES
(1365, 0, '1.000000000000000000000000000000', '2021-03-20 15:40:06', '', '2021-03-20 15:40:27', 0, '', 'Testing insert after cookie logic - edit01', '', '', NULL, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'userlaravel', 'userlaravel@user.com', 'def50200ea49abaef476566979ea1e5a2670d0d03593da608d8db650acad38741926caad9ac9a9e55574629c475e04271166ceebc297423b48a5bae5322f7450da6094e70e3c7e2593193a37a1ed0fe9b2346fe42375f10b9b7633', '', '', '847ef509866a4ab40bf857428acc045b', '847ef509866a4ab40bf857428acc045b', '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 1, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prefix_ssmv1_users`
--
ALTER TABLE `prefix_ssmv1_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
