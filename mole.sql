-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2013 at 11:47 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mole`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`, `description`, `created_by`, `date_created`, `date_published`, `active`) VALUES
(1, 'Album 1', 'More about album 1', 1, '2012-12-20 13:20:58', NULL, 1),
(2, 'Album 2', 'More about album 2', 1, '2012-12-20 13:21:16', NULL, 1),
(3, 'Album 3', 'More about album 3', 1, '2012-12-20 13:21:29', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(20, 1357397775, '127.0.0.1', 'tmh1gP');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `fax` varchar(127) DEFAULT NULL,
  `email` varchar(127) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `homepage` tinyint(4) NOT NULL,
  `contacts_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `address`, `tel`, `fax`, `email`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`, `contacts_type`) VALUES
(0, ' Ministry of Labour and Employment   Minbhawan, Baneshwor, Kathmandu, Nepal', '+977-1-4107124, 4107288', 'F +977-1-4107288', 'info@mole.gov.np', 1, '2012-12-19 11:29:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--

CREATE TABLE IF NOT EXISTS `employments` (
  `id` int(11) NOT NULL,
  `title` varchar(127) NOT NULL,
  `content` varchar(255) NOT NULL,
  `usefullinks_type` int(127) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `homepage` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `contents` text NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `homepage` tinyint(4) NOT NULL DEFAULT '0',
  `filename` varchar(127) DEFAULT NULL,
  `timestamp` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `contents`, `date_created`, `created_by`, `date_published`, `date_removed`, `active`, `homepage`, `filename`, `timestamp`) VALUES
(8, 'eaf', 'asdewafw af awefas efawf asdw      ', '2013-01-03 19:49:46', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 'social_sprite.png', '1357242623.1627.png'),
(9, 'asdfasdf asdf asdf ', 'l;k fja;lkja;lsdkf a;sldf kal;sdf k;alsdf k;aslf k;alsdkf a;lsf k;asld ka;ldf k;alsf k;alskf ;alsdkf ;alsk f;aslkdf a;lskf ;alsdkf ;alsdkf ;asldkf a;slf ka;sld kf;ald kfa;lsdk f;asld kfa;sld kfa;sldfk a;sldf k', '2013-01-03 20:46:19', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'Screenshot from 2012-11-30 07:21:48.png', '1357246010.9305.png'),
(10, '\n\nThe Ministry of Labour and Employment is entrusted to promote economic development of the country by creating an investment-friendly environment by means of mobilizing and managing public-private partnership, cooperative.', 'And domestic and foreign private investments, and for making the process of industrialization orderly and rapid, and for the development of infrastructure and other sectors to create employment opportunities, and to offer meaningful contribution to poverty alleviation.\n\nThe Ministry of Labour and Employment is entrusted to promote economic development of the country by creating an investment-friendly environment by means of mobilizing and managing public-private partnership, cooperative and domestic and foreign private investments, and for making the process of industrialization orderly and rapid, and for the development of infrastructure and other sectors to create employment opportunities, and to offer meaningful contribution to poverty alleviation.', '2013-01-03 21:12:23', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'about_img.jpg', '1357247651.1713.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faqs_type_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` mediumtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `faqs_type_id` (`faqs_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faqs_type_id`, `question`, `answer`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet?', '&lt;pre&gt;\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan\narcu et orci ultricies condimentum sed sed enim. Phasellus sed augue\nnisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla\nlobortis erat tristique. Morbi pulvinar augue in metus euismod id porta\narcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.\nPellentesque varius massa id elit posuere placerat. Integer tempor\ncursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu\npurus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum\ninterdum in, cursus a nunc. Quisque varius libero id ligula congue\neuismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;/pre&gt;\n', 1, '2013-01-01 16:50:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 2, 'Ut pellentesque dolor?', '&lt;pre&gt;\nUt pellentesque dolor ut sem ornare non malesuada nisl pellentesque.\nNulla convallis scelerisque dignissim. Quisque vitae venenatis eros.\nQuisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in\nfelis imperdiet dignissim. Integer lobortis, diam vel ultrices\nfringilla, ipsum magna fermentum felis, in semper lacus neque sit amet\neros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget\nlibero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar\nsapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices\nposuere cubilia Curae; Pellentesque habitant morbi tristique senectus et\nnetus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;/pre&gt;\n', 1, '2013-01-01 16:52:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 2, 'In nec faucibus ipsum?', '&lt;pre&gt;\nIn nec faucibus ipsum. Integer vehicula congue sapien non tincidunt.\nPhasellus eget massa ligula, vitae consectetur risus. Cras sed nisi\nlorem. Aliquam erat volutpat. In vulputate sapien eget arcu sagittis\nlacinia. Curabitur et tortor nisi, a aliquet justo. Donec id purus at\ntellus eleifend tempor.\n\nFusce mauris leo, dignissim id ornare sed, gravida in augue. Curabitur\nid quam massa, sit amet fermentum nulla. In a ipsum a elit eleifend\nlobortis at sit amet risus. Quisque eros ligula, imperdiet vitae\ndignissim a, rhoncus in est. Etiam ullamcorper metus eget quam ornare\ntristique vitae non sapien. In accumsan adipiscing lorem, eget faucibus\nleo tempor vel. Ut id mi eget turpis porta pharetra. Mauris elementum,\nquam consectetur hendrerit ultricies, purus velit congue quam, vulputate\nsemper nibh mi quis mi. Etiam condimentum lobortis accumsan. Vestibulum\nfelis erat, mattis vel viverra eget, laoreet quis est. Suspendisse\ncongue pretium semper. Integer viverra tristique velit, in tincidunt\nsapien ultrices id. Morbi fringilla pellentesque leo sit amet congue.\nQuisque eget mi sed sem euismod bibendum id porttitor lorem.&lt;/pre&gt;\n', 1, '2013-01-01 16:53:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 2, 'Praesent ac varius dui?', '&lt;pre&gt;\nPraesent ac varius dui. Maecenas in leo libero. Integer malesuada, neque\nnon interdum malesuada, dolor velit viverra nunc, nec suscipit sapien\nmetus vitae libero. Vestibulum eu quam nulla, ut facilisis tellus. Cras\nneque magna, pellentesque non sagittis sed, adipiscing convallis turpis.\nVivamus rhoncus ipsum nec purus convallis consectetur. In pretium\nultrices nisi, ut tincidunt odio porta sit amet. Curabitur vulputate\nquam at ipsum semper ut mollis ante dapibus. Suspendisse a sapien\nturpis, ac convallis mauris.&lt;/pre&gt;\n', 1, '2013-01-01 16:54:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 1, 'In accumsan adipiscing lorem, eget?', '&lt;pre&gt;\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan\narcu et orci ultricies condimentum sed sed enim. Phasellus sed augue\nnisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla\nlobortis erat tristique. Morbi pulvinar augue in metus euismod id porta\narcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.\nPellentesque varius massa id elit posuere placerat. Integer tempor\ncursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu\npurus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum\ninterdum in, cursus a nunc. Quisque varius libero id ligula congue\neuismod. In consequat ultrices diam, eu gravida tortor suscipit et.\n\nUt pellentesque dolor ut sem ornare non malesuada nisl pellentesque.\nNulla convallis scelerisque dignissim. Quisque vitae venenatis eros.\nQuisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in\nfelis imperdiet dignissim. Integer lobortis, diam vel ultrices\nfringilla, ipsum magna fermentum felis, in semper lacus neque sit amet\neros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget\nlibero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar\nsapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices\nposuere cubilia Curae; Pellentesque habitant morbi tristique senectus et\nnetus et malesuada fames ac turpis egestas. Nullam eget est eros.\n\nIn nec faucibus ipsum. Integer vehicula congue sapien non tincidunt.\nPhasellus eget massa ligula, vitae consectetur risus. Cras sed nisi\nlorem. Aliquam erat volutpat. In vulputate sapien eget arcu sagittis\nlacinia. Curabitur et tortor nisi, a aliquet justo. Donec id purus at\ntellus eleifend tempor.\n\nFusce mauris leo, dignissim id ornare sed, gravida in augue. Curabitur\nid quam massa, sit amet fermentum nulla. In a ipsum a elit eleifend\nlobortis at sit amet risus. Quisque eros ligula, imperdiet vitae\ndignissim a, rhoncus in est. Etiam ullamcorper metus eget quam ornare\ntristique vitae non sapien. In accumsan adipiscing lorem, eget faucibus\nleo tempor vel. Ut id mi eget turpis porta pharetra. Mauris elementum,\nquam consectetur hendrerit ultricies, purus velit congue quam, vulputate\nsemper nibh mi quis mi. Etiam condimentum lobortis accumsan. Vestibulum\nfelis erat, mattis vel viverra eget, laoreet quis est. Suspendisse\ncongue pretium semper. Integer viverra tristique velit, in tincidunt\nsapien ultrices id. Morbi fringilla pellentesque leo sit amet congue.\nQuisque eget mi sed sem euismod bibendum id porttitor lorem.&lt;/pre&gt;\n', 1, '2013-01-01 16:54:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs_type`
--

CREATE TABLE IF NOT EXISTS `faqs_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `faqs_type`
--

INSERT INTO `faqs_type` (`id`, `title`, `description`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`) VALUES
(1, 'General', 'General questions   ', 1, '2013-01-01 16:46:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Situations', 'About Labour unions', 1, '2013-01-01 16:47:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, ' Working Abroad', 'Foreign Employment ', 1, '2013-01-01 16:48:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, ' Labour Acts', 'Questions about Acts related to labour and Employment  ', 1, '2013-01-01 16:49:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, ' Safety and Health', 'Smoke free law and employers responsibility ', 1, '2013-01-01 16:49:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(127) NOT NULL,
  `title` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` varchar(127) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `file_type` varchar(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `title`, `description`, `timestamp`, `created_by`, `date_created`, `date_published`, `file_type`, `album_id`) VALUES
(1, 'slide1.jpg', 'Hon''ble Minister with Secretary', 'Innaguration DOL Program', '1355935239.1404.jpg', 0, '2012-12-19 10:54:31', NULL, 'slider', NULL),
(2, 'slide2.jpg', 'The Labour Relations', 'Employment Law Practice', '1355935275.3907.jpg', 0, '2012-12-19 10:55:50', NULL, 'slider', NULL),
(3, 'slide3.jpg', 'Labour''s Alternative', 'Employment Law Practice', '1355935328.0733.jpg', 0, '2012-12-19 10:56:18', NULL, 'slider', NULL),
(4, 'slide4.jpg', 'Children', 'Have rights too', '1355935352.8419.jpg', 0, '2012-12-19 10:57:11', NULL, 'slider', NULL),
(5, 'gallery_1.png', 'Album 1', 'More about album 1', '1356033859.9995.png', 0, '2012-12-20 14:19:07', NULL, NULL, 1),
(6, 'gallery_2.png', 'Album 2', 'More about album 2', '1356033913.3109.png', 0, '2012-12-20 14:19:53', NULL, NULL, 2),
(7, 'gallery_3.png', 'Album 2', 'More about album 2', '1356033941.4707.png', 0, '2012-12-20 14:20:17', NULL, NULL, 2),
(8, 'gallery_4.png', 'Album 3', 'More about album 3', '1356033966.351.png', 0, '2012-12-20 14:20:46', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `description` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`) VALUES
(1, 'admin', 'The super admin of the project');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(127) NOT NULL,
  `table` varchar(127) NOT NULL,
  `row_id` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link` (`link`),
  KEY `table` (`table`),
  KEY `row_id` (`row_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `link`, `table`, `row_id`) VALUES
(1, 'pages/xx', 'news', '24'),
(4, 'contacts/x4', 'contacts', '0'),
(5, 'news/gtd', 'news', '25'),
(6, 'acts/nn', 'news', '26'),
(7, 'employments/emp', 'news', '7'),
(8, 'acts/event1', 'news', '3'),
(9, 'acts/h1', 'news', '14'),
(10, 'pages/asdf', 'news', '27'),
(11, 'events/ee', 'news', '28'),
(12, 'pages/aas', 'news', '27'),
(13, 'pages/', 'news', '28'),
(14, 'pages/ास', 'news', '29'),
(15, 'pages/sf', 'news', '30'),
(18, 'pages/sfg', 'news', '29');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `title_np` varchar(127) NOT NULL,
  `comments_np` varchar(255) NOT NULL,
  `title` varchar(127) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `link` varchar(127) NOT NULL DEFAULT '#',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `link` (`link`),
  UNIQUE KEY `title` (`title`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title_np`, `comments_np`, `title`, `comments`, `link`, `parent_id`, `active`) VALUES
(1, 'हाम्रो बारे', 'कलज;ाद;ल सकज;लसदकज', 'about us', 'as asdg asg sa sg s', 'pages/xx', 0, 1),
(2, 'रिसोर्सेस', '', 'resources', '', 'resources', 0, 1),
(3, '', '', 'publications', '', 'publications', 0, 0),
(5, '', '', 'contact us', '', 'contacts/x4', 0, 0),
(7, '', '', 'All possible links', 'Contains the tree of all possible links', 'all', 0, 0),
(8, 'ऐन कानुन', '', 'acts & laws', '', 'acts', 7, 1),
(9, 'श्रम', '', 'Employments', '', 'employments', 7, 1),
(10, 'कार्यकौम', '', 'events', '', 'events', 7, 1),
(11, 'प्रश्न-उत्तर', '', 'FAQs', 'shoqs all of the faqs ...', 'faqs', 7, 1),
(12, 'स्वास्त', '', 'health', 'Safety & Health Management System', 'health', 7, 1),
(14, 'नोटिसेस्', '', 'Notices', 'lists all the notices', 'notices', 7, 1),
(15, 'छापा', '', 'Press Release', 'press releases ....', 'press', 7, 1),
(16, 'पोल', '', 'Polls', 'polls', 'polls', 7, 1),
(17, 'ओरगनाईजेसन', '', 'Organization', 'About organization', '', 0, 1),
(19, 'सुरुवात', '', 'Introduction', '', 'pages/introduction', 17, 1),
(20, 'मान्डेटस', '', 'Mandates', '', 'pages/mandates', 17, 1),
(21, 'सस्ता', '', 'Organization Chart', '', 'pages/chart', 17, 1),
(22, 'मुख्य प्लान', '', 'Master Plan', '', 'pages/plan', 17, 1),
(23, 'सम्बन्धित कार्यलय', '', 'Related Offices', '', 'pages/offices', 0, 1),
(24, 'ढि ओ ऐफ ई', '', 'DOFE', '', 'pages/dofe', 23, 1),
(26, 'सुरुवात', '', 'Introduction to DOFE', '', 'pages/dofe-intro', 24, 1),
(27, 'समाचार', '', 'News and Alerts', '', 'pages/dofe-news-and-alerts', 24, 1),
(28, 'ढि ओ ऐल', '', 'DOL', '', 'pages/dol', 23, 1),
(29, 'ओ एस् एच पि', '', 'OSHP', '', 'pages/oshp', 23, 1),
(30, 'मिडिया', '', 'Media', '', 'pages/media', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(23);

-- --------------------------------------------------------

--
-- Table structure for table `mole_users`
--

CREATE TABLE IF NOT EXISTS `mole_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mole_users`
--

INSERT INTO `mole_users` (`id`, `group_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`) VALUES
(1, 1, '127.0.0.1', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, 1268889823, 1357397793, 1);

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE IF NOT EXISTS `networks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `link` varchar(127) NOT NULL,
  `description` varchar(127) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `homepage` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `networks`
--

INSERT INTO `networks` (`id`, `title`, `link`, `description`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`) VALUES
(1, 'Like us on Facebook', 'http://facebook.com', '', 1, '2012-12-19 11:40:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(2, 'Follow us on Twitter', 'http://twitter.com', '', 1, '2012-12-19 11:39:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `title_np` varchar(255) DEFAULT NULL,
  `content_np` varchar(255) DEFAULT NULL,
  `news_type` int(127) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `homepage` tinyint(4) NOT NULL DEFAULT '0',
  `lang` enum('en','np') NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`),
  KEY `news_type` (`news_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `title_np`, `content_np`, `news_type`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`, `lang`) VALUES
(1, ' Development of Labour Administrator', '&lt;p&gt;\n The Development of Labour Administrator for the strengthening of Trade Cooperation in ASEAN Community Program&lt;/p&gt;\n', NULL, NULL, 1, 1, '2012-12-18 23:28:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(4, 'The National Budget for 2013', '&lt;p&gt;\n 9th Annual Sujatha Jayawardena Memorial Oration, organized by Alumini Association, University of Colombo was delivered on &amp;quot;Challenges in formulating the National Budget for 2013&amp;quot; by Dr. P. B. Jayasundera, Secretary, Ministry o', NULL, NULL, 4, 1, '2012-12-18 23:46:08', '2012-12-18 23:46:08', '0000-00-00 00:00:00', 1, 0, 'en'),
(5, 'The floods submits documents', '&lt;p&gt;\n An employer or an establishment hit by the floods submits dicuments concerned to the Provincial Office of Labour&lt;/p&gt;\n', NULL, NULL, 2, 1, '2012-12-18 23:55:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(6, 'The floods submits documents', '&lt;p&gt;\n An employer or an establishment hit by the floods submits dicuments concerned to the Provincial Office of Labour&lt;/p&gt;\n', NULL, NULL, 2, 1, '2012-12-18 23:58:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(7, 'Restricated Trading Days', '&lt;p&gt;\n Restricated Trading Days&lt;/p&gt;\n', NULL, NULL, 7, 1, '2012-12-19 00:11:06', '2012-12-30 02:37:40', '0000-00-00 00:00:00', 1, 0, 'en'),
(8, 'Minimum wage rates', '&lt;p&gt;\n Minimum wage rates&lt;/p&gt;\n', NULL, NULL, 7, 1, '2012-12-19 00:12:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(9, 'Public holidays dates 2012', '&lt;p&gt;\n Public holidays dates 2012&lt;/p&gt;\n', NULL, NULL, 7, 1, '2012-12-19 00:13:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(10, 'Minimum employment rights', '&lt;p&gt;\n Minimum employment rights&lt;/p&gt;\n', NULL, NULL, 7, 1, '2012-12-19 00:14:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(14, 'WSH Regulatory Framework ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 18:58:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(15, 'Safety & Health Management System ', '&lt;p&gt;\n Nunc aliquet tortor in lectus porttitor fringilla&lt;br /&gt;\n lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta&lt;br /&gt;\n arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.&lt;br /&gt;\n Pellentesque varius ', NULL, NULL, 5, 1, '2012-12-19 19:00:44', '2012-12-19 19:04:50', '0000-00-00 00:00:00', 1, 0, 'en'),
(16, 'Monitoring and Surveillance ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 19:01:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(17, 'Work Injury Compensation', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 19:02:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'en'),
(18, 'Certification & Registration', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 19:03:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(19, 'Incident Reporting ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', NULL, NULL, 5, 1, '2012-12-19 19:04:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'en'),
(21, ' Amendments to the Employment of Foreign Manpower Act', '&lt;p&gt;\r\n The Employment of Foreign Manpower Act (EFMA) prescribes the responsibilities and obligations pertaining to the employment of foreign workers. The EFMA was last amended in 2007.Since 2010, following the recommendations of the Economic Strategi', NULL, NULL, 8, 1, '2012-12-22 02:39:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(23, '.askldfjpwei;we g', '&lt;p&gt;\n ;oiasdf kjasd ;fowaf af aw&lt;/p&gt;\n', NULL, NULL, 5, 1, '2012-12-26 08:10:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(24, ' Ministry of Labour and Employments', '&lt;p&gt;\n Establishment Ministry of Labour &amp;amp; Social Welfare, 2038 BS, Ministry of Labour, 2052 BS, Ministry of Labour &amp;amp; Transport Management, 2057 BS, Ministry of Labour &amp;amp; Employment, 2069. Objectives and Long Term vision of Minis', 'छवबब', '<p>\n सग सउग ासगारग ासग ागासगा</p>\n', 6, 1, '2012-12-27 10:57:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 'en'),
(25, 'uyi', '&lt;p&gt;\n ;h iuhpiu hpiu hoiu hoi ugoi oi&lt;/p&gt;\n', NULL, NULL, 1, 1, '2012-12-28 12:47:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en'),
(26, 'nnnn', '&lt;p&gt;\n ndaoijad iof jweopf japsodif jaoeijf aposija w&lt;/p&gt;\n', NULL, NULL, 8, 1, '2012-12-30 02:37:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE IF NOT EXISTS `news_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(127) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_types`
--

CREATE TABLE IF NOT EXISTS `news_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `comments` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `sub_title` text,
  `date_created` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `title`, `sub_title`, `date_created`, `created_by`, `date_published`, `date_removed`, `active`) VALUES
(7, 'Establishment', 'Ministry of Labour & Social Welfare, 2038 BS', '2013-01-03 14:40:29', 0, NULL, NULL, 1),
(8, 'Establishment', 'Ministry of Labour, 2052 BS', '2013-01-03 14:40:29', 0, NULL, NULL, 1),
(9, 'Establishment', 'Ministry of Labour & Transport Management, 2057 BS', '2013-01-03 15:23:43', 0, NULL, NULL, 1),
(10, 'Establishment', 'inistry of Labour & Employment, 2069', '2013-01-03 15:24:02', 0, NULL, NULL, 1),
(11, 'Objectives and Long Term vision of Ministry', 'Development of Pure Industrial Relationship', '2013-01-03 15:24:30', 0, NULL, NULL, 1),
(12, 'Objectives and Long Term vision of Ministry', 'Ending Unemployment and Development of Productive and Qualitative Employment System', '2013-01-03 15:25:32', 0, NULL, NULL, 1),
(13, 'Objectives and Long Term vision of Ministry', 'Child Labour Alleviation', '2013-01-03 15:27:07', 0, NULL, NULL, 1),
(14, 'Objectives and Long Term vision of Ministry', 'Development of Safety, Managed and help based transportation system', '2013-01-03 15:27:23', 0, NULL, NULL, 1),
(15, 'Responsibilities of Ministry', ' Labour policy and Work completion ', '2013-01-03 15:29:52', 0, NULL, NULL, 1),
(16, 'Responsibilities of Ministry', ' Study, investigation, data collection and verification of labour power and labour market. ', '2013-01-03 15:30:13', 0, NULL, NULL, 1),
(17, 'Responsibilities of Ministry', ' Contact and relationship development of labour with national and international chambers and corporations ', '2013-01-03 15:30:31', 0, NULL, NULL, 1),
(18, 'Responsibilities of Ministry', ' Relationship between Labour and management. ', '2013-01-03 15:30:44', 0, NULL, NULL, 1),
(19, 'Responsibilities of Ministry', ' Help Employee and Labour supply. ', '2013-01-03 15:30:57', 0, NULL, NULL, 1),
(20, 'Responsibilities of Ministry', ' Foreign Employments ', '2013-01-03 15:31:16', 0, NULL, NULL, 1),
(21, 'Responsibilities of Ministry', ' Promotion, supply and organize vocational trainings ', '2013-01-03 15:31:31', 0, NULL, NULL, 1),
(22, 'Responsibilities of Ministry', ' Training on child, women and disabled labours. ', '2013-01-03 15:31:44', 0, NULL, NULL, 1),
(23, 'Responsibilities of Ministry', ' Trade unions ', '2013-01-03 15:31:59', 0, NULL, NULL, 1),
(24, 'Responsibilities of Ministry', ' For social safety of Labour ', '2013-01-03 15:32:17', 0, NULL, NULL, 1),
(25, 'Responsibilities of Ministry', ' Permission for Foreign Employees ', '2013-01-03 15:32:29', 0, NULL, NULL, 1),
(26, 'Responsibilities of Ministry', ' Labour Administration and Management. ', '2013-01-03 15:32:42', 0, NULL, NULL, 1),
(27, 'Responsibilities of Ministry', 'Bonus', '2013-01-03 15:32:53', 0, NULL, NULL, 1),
(28, 'Responsibilities of Ministry', ' Manage, organize Transportation (Air transport not included) Policies and Planning, Regulations and Work completions. ', '2013-01-03 15:33:08', 0, NULL, NULL, 1),
(29, 'Responsibilities of Ministry', ' Manage, organize Transportation (Air transport not included) with other chambers and corporation ', '2013-01-03 15:33:21', 0, NULL, NULL, 1),
(30, 'Responsibilities of Ministry', ' Relationship between Transportation (Air transport not included) with other related and managed international corporations ', '2013-01-03 15:33:33', 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `count_option1` int(127) NOT NULL,
  `count_option2` int(127) NOT NULL,
  `count_option3` int(127) NOT NULL,
  `count_option4` int(127) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `created_by`, `date_created`, `date_published`, `date_removed`, `count_option1`, `count_option2`, `count_option3`, `count_option4`, `active`) VALUES
(1, 'How much should the minimum wage be increased by?', 'Choice 1', 'Choice 2', 'Choice 3', 'Choice 4', 1, '2012-12-20 00:40:51', NULL, NULL, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `poll_history`
--

CREATE TABLE IF NOT EXISTS `poll_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usefullinks`
--

CREATE TABLE IF NOT EXISTS `usefullinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `link` varchar(127) NOT NULL,
  `description` varchar(127) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `homepage` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usefullinks`
--

INSERT INTO `usefullinks` (`id`, `title`, `link`, `description`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`) VALUES
(1, 'Employment Agreement Builder', 'http://google.com', 'description of usefullinks', 1, '2012-12-19 11:34:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(2, 'Paid Parental Leave Calculator', 'http://google.com', 'description of Paid Parental', 1, '2012-12-19 11:35:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(3, 'Employment Law Database', 'http://google.com', 'description of Database', 1, '2012-12-19 11:35:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(4, 'Collective Baiganing Resource', 'http://google.com', 'description of resource', 1, '2012-12-19 11:36:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_meta`
--

CREATE TABLE IF NOT EXISTS `users_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) NOT NULL,
  `email` varchar(127) NOT NULL,
  `cv` varchar(127) DEFAULT NULL,
  `image` varchar(127) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vip`
--

CREATE TABLE IF NOT EXISTS `vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(127) NOT NULL,
  `title` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` varchar(127) NOT NULL,
  `created_by` int(100) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `file_type` varchar(127) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vip`
--

INSERT INTO `vip` (`id`, `filename`, `title`, `description`, `timestamp`, `created_by`, `date_created`, `date_published`, `file_type`, `active`) VALUES
(3, 'Honorable_Minister_Posta_Bahadur_Bogati.jpg', 'Posta Bahadur Bogati', 'Honorable Minister', '1357231226.2148.jpg', 0, '2013-01-03 16:39:14', NULL, '', 1),
(4, 'secretary_Somlal_Subedi.jpg', 'Somlal Subedi', 'Secretry', '1357231267.7461.jpg', 0, '2013-01-03 16:40:31', NULL, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visited_count`
--

CREATE TABLE IF NOT EXISTS `visited_count` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_address` (`ip_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `visited_count`
--

INSERT INTO `visited_count` (`id`, `timestamp`, `ip_address`) VALUES
(1, '2013-01-01 16:38:15', '127.0.0.1'),
(9, '2013-01-02 12:28:30', '192.168.1.1'),
(23, '2013-01-03 15:26:14', '192.168.1.3');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `email` varchar(127) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ip_address` varchar(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
