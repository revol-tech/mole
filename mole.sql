-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 22, 2013 at 05:53 PM
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
  `title_np` varchar(127) NOT NULL,
  `description_np` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`, `description`, `title_np`, `description_np`, `created_by`, `date_created`, `date_published`, `active`) VALUES
(1, 'Album 1', 'More about album 1', 'आल्बम १', 'आल्बम १ को बारे', 1, '2012-12-20 13:20:58', NULL, 1),
(2, 'Album 2', 'More about album 2', 'आल्बम २', 'आल्बम २ को बारे', 1, '2012-12-20 13:21:16', NULL, 1),
(3, 'Album 3', 'More about album 3', 'आल्बम ३', 'आल्बम ३ को बारे', 1, '2012-12-20 13:21:29', NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(62, 1358836722, '127.0.0.1', 'XPWLPk');

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
  `address_np` varchar(255) NOT NULL,
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

INSERT INTO `contacts` (`id`, `address`, `address_np`, `tel`, `fax`, `email`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`, `contacts_type`) VALUES
(0, 'Ministry of Labour and Employment   Minbhawan, Baneshwor, Kathmandu, Nepal         ', '  नेपाल सरकार\nश्रम तथा रोजगार मन्त्रालय\nसिहंदरबार, \nकाठमाडौ, \nनेपाल     ', '+977-1-4107124, 4107288', '+977-1-4107288', 'info@mole.gov.np', 1, '2013-01-09 07:23:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, NULL);

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
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contents` text CHARACTER SET utf8 NOT NULL,
  `title_np` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contents_np` text CHARACTER SET utf8 NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `homepage` tinyint(4) NOT NULL DEFAULT '0',
  `filename` varchar(127) DEFAULT NULL,
  `timestamp` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `contents`, `title_np`, `contents_np`, `date_created`, `created_by`, `date_published`, `date_removed`, `active`, `homepage`, `filename`, `timestamp`) VALUES
(16, 'The Ministry of Labour and Employment is entrusted to promote economic development of the country by creating an investment-friendly environment by means of mobilizing and managing public-private partnership, cooperative.', 'And domestic and foreign private investments, and for making the process of industrialization orderly and rapid, and for the development of infrastructure and other sectors to create employment opportunities, and to offer meaningful contribution to poverty alleviation.\n\nThe Ministry of Labour and Employment is entrusted to promote economic development of the country by creating an investment-friendly environment by means of mobilizing and managing public-private partnership, cooperative and domestic and foreign private investments, and for making the process of industrialization orderly and rapid, and for the development of infrastructure and other sectors to create employment opportunities, and to offer meaningful contribution to poverty alleviation.', 'हल िलिासजउ हलािसज लासकजसउ लाकसज ालकसज ालकसज ालकसज ालकज', 'लकह ालजहालसकज ालसकज ालसकज लाकसजहलकाजहलिासुह ोािु गहसलजकगह लसजगह ालसिजहग लासिजह लासजुह ;लहिो लासकजह लािह ालसजकहउ टाजो; ालसकजहउ ालिज ालिजउह ालसकजहउ ला;िजउ लासकउह ाल;ि उालसिजउह ालउालसुउज ालजउासलकहउाल कसजबह ालसकज लािज लासिजुह टिला ालिगु ापोग पा;ज गालसिजगुह पािजग पािुगह पिुजगह सािप     ', '2013-01-07 22:48:59', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'about_img.jpg', '1357599026.9384.jpg'),
(17, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan\narcu et orci ultricies condimentum sed sed enim. Phasellus sed augue\nnisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla\nlobortis erat tristique. Morbi pulvinar au', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan\narcu et orci ultricies condimentum sed sed enim. Phasellus sed augue\nnisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla\nlobortis erat tristique. Morbi pulvinar augue in metus euismod id porta\narcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.\nPellentesque varius massa id elit posuere placerat. Integer tempor\ncursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu\npurus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum\ninterdum in, cursus a nunc. Quisque varius libero id ligula congue\neuismod. In consequat ultrices diam, eu gravida tortor suscipit et.\n\nUt pellentesque dolor ut sem ornare non malesuada nisl pellentesque.\nNulla convallis scelerisque dignissim. Quisque vitae venenatis eros.\nQuisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in\nfelis imperdiet dignissim. Integer lobortis, diam vel ultrices\nfringilla, ipsum magna fermentum felis, in semper lacus neque sit amet\neros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget\nlibero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar\nsapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices\nposuere cubilia Curae; Pellentesque habitant morbi tristique senectus et\nnetus et malesuada fames ac turpis egestas. Nullam eget est eros.\n', 'किुसक उजगासलकाुगलुया कलाजिुज गगपिाु लासकजु गहला;सज लासु', 'किुसक उजगासलकाुगलुया कलाजिुज गगपिाु लासकजु गहला;सज लासुलकजास ज।लक;सह;ासलकउ;ाोसजसउ।ास,हउलकाजसह उलकाउ।कासउह पि;ासज ल;ासह क,ह सलकजहगलास गुहापु;हलाुगय ािु हाह लसाकहग पटलि लटिगसुगतिल ाु गहलसुोुिाग सकलगो', '2013-01-07 23:39:41', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'Screenshot from 2013-01-06 02:23:20.png', '1357602095.2935.png');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faqs_type_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` mediumtext NOT NULL,
  `question_np` text NOT NULL,
  `answer_np` mediumtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `faqs_type_id` (`faqs_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faqs_type_id`, `question`, `answer`, `question_np`, `answer_np`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet?', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;/p&gt;\n', '्रम तथा रोजगार मन्त्रालय ?', '<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>\n', 1, '2013-01-01 16:50:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 2, 'Ut pellentesque dolor?', '&lt;p&gt;\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;/p&gt;\n', 'तथा रोजगार मन्त्रालय श्रम', '<p>\n ्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय</p>\n', 1, '2013-01-01 16:52:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 2, 'In nec faucibus ipsum?', '&lt;p&gt;\n In nec faucibus ipsum. Integer vehicula congue sapien non tincidunt. Phasellus eget massa ligula, vitae consectetur risus. Cras sed nisi lorem. Aliquam erat volutpat. In vulputate sapien eget arcu sagittis lacinia. Curabitur et tortor nisi, a aliquet justo. Donec id purus at tellus eleifend tempor. Fusce mauris leo, dignissim id ornare sed, gravida in augue. Curabitur id quam massa, sit amet fermentum nulla. In a ipsum a elit eleifend lobortis at sit amet risus. Quisque eros ligula, imperdiet vitae dignissim a, rhoncus in est. Etiam ullamcorper metus eget quam ornare tristique vitae non sapien. In accumsan adipiscing lorem, eget faucibus leo tempor vel. Ut id mi eget turpis porta pharetra. Mauris elementum, quam consectetur hendrerit ultricies, purus velit congue quam, vulputate semper nibh mi quis mi. Etiam condimentum lobortis accumsan. Vestibulum felis erat, mattis vel viverra eget, laoreet quis est. Suspendisse congue pretium semper. Integer viverra tristique velit, in tincidunt sapien ultrices id. Morbi fringilla pellentesque leo sit amet congue. Quisque eget mi sed sem euismod bibendum id porttitor lorem.&lt;/p&gt;\n', 'रोजगार मन्त्रालय', '<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय</p>\n', 1, '2013-01-01 16:53:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 2, 'Praesent ac varius dui?', '&lt;p&gt;\n Praesent ac varius dui. Maecenas in leo libero. Integer malesuada, neque non interdum malesuada, dolor velit viverra nunc, nec suscipit sapien metus vitae libero. Vestibulum eu quam nulla, ut facilisis tellus. Cras neque magna, pellentesque non sagittis sed, adipiscing convallis turpis. Vivamus rhoncus ipsum nec purus convallis consectetur. In pretium ultrices nisi, ut tincidunt odio porta sit amet. Curabitur vulputate quam at ipsum semper ut mollis ante dapibus. Suspendisse a sapien turpis, ac convallis mauris.&lt;/p&gt;\n', 'श्रम तथा रोजगार', '<p>\n ्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n &nbsp;</p>\n', 1, '2013-01-01 16:54:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 1, 'In accumsan adipiscing lorem, eget?', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et. Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque.&lt;/p&gt;\n&lt;p&gt;\n Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros. In nec faucibus ipsum. Integer vehicula congue sapien non tincidunt. Phasellus eget massa ligula, vitae consectetur risus. Cras sed nisi lorem. Aliquam erat volutpat. In vulputate sapien eget arcu sagittis lacinia.&lt;/p&gt;\n&lt;p&gt;\n Curabitur et tortor nisi, a aliquet justo. Donec id purus at tellus eleifend tempor. Fusce mauris leo, dignissim id ornare sed, gravida in augue. Curabitur id quam massa, sit amet fermentum nulla. In a ipsum a elit eleifend lobortis at sit amet risus. Quisque eros ligula, imperdiet vitae dignissim a, rhoncus in est. Etiam ullamcorper metus eget quam ornare tristique vitae non sapien. In accumsan adipiscing lorem, eget faucibus leo tempor vel. Ut id mi eget turpis porta pharetra. Mauris elementum, quam consectetur hendrerit ultricies, purus velit congue quam, vulputate semper nibh mi quis mi. Etiam condimentum lobortis accumsan. Vestibulum felis erat, mattis vel viverra eget, laoreet quis est. Suspendisse congue pretium semper. Integer viverra tristique velit, in tincidunt sapien ultrices id. Morbi fringilla pellentesque leo sit amet congue. Quisque eget mi sed sem euismod bibendum id porttitor lorem.&lt;/p&gt;\n', 'श्रम मन्त्रालय', '<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय</p>\n', 1, '2013-01-01 16:54:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 1, 'xcvb nser srgre ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;br /&gt;\n &lt;br /&gt;\n &amp;nbsp;&lt;/p&gt;\n', 'मन्त्रालयको बारेमा ....', '<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय</p>\n', 1, '2013-01-16 08:27:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs_type`
--

CREATE TABLE IF NOT EXISTS `faqs_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  `title_np` varchar(127) NOT NULL,
  `description_np` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `faqs_type`
--

INSERT INTO `faqs_type` (`id`, `title`, `description`, `title_np`, `description_np`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`) VALUES
(1, 'General', '<p>\n General questions ....</p>\n', 'साधारण', '<p>\n साधारण प्रश्नहरु</p>\n', 1, '2013-01-01 16:46:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Situations', '<p>\n About Labour unions</p>\n', 'खास प्रश्नहरू', '<p>\n मज्दुर संगठनको बारे</p>\n', 1, '2013-01-01 16:47:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, ' Working Abroad', '<p>\n About Foreign Employment</p>\n', 'बिदेशी रोज्गार', '<p>\n बिदेशी रोज्गारका प्रश्नहरु</p>\n', 1, '2013-01-01 16:48:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, ' Labour Acts', '<p>\n Questions about Acts related to labour and Employment</p>\n', 'मज्दुर ऐन', '<p>\n मज्दुर ऐनको बारे</p>\n', 1, '2013-01-01 16:49:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, ' Safety and Health', '<p>\n Smoke free law and employers responsibility</p>\n', 'स्वास्थ तथा सुरक्षा', '<p>\n स्वास्थ तथा सुरक्षाको बारे</p>\n', 1, '2013-01-01 16:49:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(127) NOT NULL,
  `title` varchar(127) NOT NULL,
  `description` varchar(255) NOT NULL,
  `title_np` varchar(127) NOT NULL,
  `description_np` varchar(255) NOT NULL,
  `timestamp` varchar(127) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `file_type` varchar(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `title`, `description`, `title_np`, `description_np`, `timestamp`, `created_by`, `date_created`, `date_published`, `file_type`, `album_id`) VALUES
(1, 'slide1.jpg', 'Hon''ble Minister with Secretary', 'Innaguration DOL Program', 'मन्ऋ', 'ासगासउ', '1355935239.1404.jpg', 0, '2012-12-19 10:54:31', NULL, 'slider', NULL),
(2, 'slide2.jpg', 'The Labour Relations', 'Employment Law Practice', 'ासग', 'उगजह तततहतह', '1355935275.3907.jpg', 0, '2012-12-19 10:55:50', NULL, 'slider', NULL),
(3, 'slide3.jpg', 'Labour''s Alternative', 'Employment Law Practice', 'उगह सरतह', 'हबमनजहगबजनयज रय त', '1355935328.0733.jpg', 0, '2012-12-19 10:56:18', NULL, 'slider', NULL),
(4, 'slide4.jpg', 'Children', 'Have rights too', 'तु ह गगह स', 'उगज उग हतजु ', '1355935352.8419.jpg', 0, '2012-12-19 10:57:11', NULL, 'slider', NULL),
(5, 'gallery_1.png', 'Album 1', 'More about album 1', '', '', '1356033859.9995.png', 0, '2012-12-20 14:19:07', NULL, 'album_image', 1),
(6, 'gallery_2.png', 'Album 2', 'More about album 2', '', '', '1356033913.3109.png', 0, '2012-12-20 14:19:53', NULL, 'album_image', 2),
(7, 'gallery_3.png', 'Album 2', 'More about album 2', '', '', '1356033941.4707.png', 0, '2012-12-20 14:20:17', NULL, 'album_image', 2),
(8, 'gallery_4.png', 'Album 3', 'More about album 3', '', '', '1356033966.351.png', 0, '2012-12-20 14:20:46', NULL, 'album_image', 3),
(10, 'Load shedding-2069-8-23.pdf', 'loashedding', 'ljkas ;lkajlkja', 'उगहज', 'सलकउजह ;लासज ;लाकग', '1357808324.5062.pdf', 0, '2013-01-10 08:58:11', NULL, NULL, NULL),
(11, 'Load shedding-2069-8-23.pdf', 'oliuhoiu haasoiujaa', 'aszxdfcvgbygtuy', 'उगहज', 'ास ास ाग', '1357808363.1836.pdf', 0, '2013-01-10 08:58:50', NULL, NULL, NULL);

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
  KEY `table` (`table`),
  KEY `row_id` (`row_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `link`, `table`, `row_id`) VALUES
(4, 'contacts/x4', 'contacts', '0'),
(5, 'news/news/gtd', 'news', '25'),
(6, 'acts/nn', 'news', '26'),
(7, 'employments/emp', 'news', '7'),
(8, 'acts/event1', 'news', '3'),
(9, 'acts/h1', 'news', '14'),
(10, 'pages/asdf', 'news', '27'),
(11, 'events/ee', 'news', '28'),
(12, 'pages/aas', 'news', '27'),
(13, 'pages/', 'news', '28'),
(14, 'pages/ास', 'news', '29'),
(15, 'employments/sf', 'news', '30'),
(18, 'pages/sfg', 'news', '29'),
(19, 'employments/hts', 'news', '30'),
(20, 'employments/nsn', 'news', '8'),
(21, 'news/news/lkjuh', 'news', '31'),
(22, 'news/sh', 'news', '1'),
(23, 'acts/acts/acts/fs', 'news', '32'),
(24, 'acts/fff', 'news', '33'),
(25, 'acts/', 'news', '34'),
(26, '/', 'news', '4'),
(32, 'pages/hnt', 'news', '37'),
(33, 'pages/fgh', 'news', '38'),
(34, 'pages/sfa', 'news', '6'),
(35, 'pages/oli', 'news', '5'),
(36, 'employments/', 'news', '39'),
(38, 'employments/employments/uhiu', 'news', '41'),
(39, 'employments/gfds', 'news', '42'),
(40, 'acts/gre', 'news', '43'),
(42, 'acts/dsff', 'news', '45'),
(44, 'pages/xx', 'news', '47'),
(45, 'pages/uiouiui', 'news', '49'),
(46, 'pages/yutyt', 'news', '50'),
(47, 'pages/qwq', 'news', '51'),
(48, 'pages/fgyhkoityjuj', 'news', '52'),
(49, 'employments/employments/vb', 'news', '10'),
(50, 'employments/shr', 'news', '9'),
(51, 'pages/finince', 'news', '54'),
(52, 'pages/difivisons/budget', 'news', '54'),
(54, 'pages/aaa', 'news', '56'),
(55, 'pages/dddddd', 'news', '57'),
(56, 'pages/eeeeeee', 'news', '58'),
(57, 'pages/abc', 'news', '59'),
(58, 'pages/qwerty', 'news', '60'),
(59, 'pages/introduction', 'news', '61'),
(60, 'pages/about', 'news', '62'),
(62, '/', 'news', '64'),
(63, '/', 'news', '64');

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
  UNIQUE KEY `title` (`title`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title_np`, `comments_np`, `title`, `comments`, `link`, `parent_id`, `active`) VALUES
(1, 'हाम्रो बारे', 'हाम्रो बारेमा .....', 'about us', 'About us .....', 'pages/about', 0, 1),
(2, 'रिसोर्सेस', 'रिसोर्सेसको बारेमा ...........', 'resources', 'about resourcs', 'acts', 0, 1),
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
(20, 'मान्डेटस', '', 'Mandates', '', 'pages/mandates', 17, 0),
(21, 'सस्ता', '', 'Organization Chart', '', 'pages/chart', 17, 0),
(22, 'मुख्य प्लान', '', 'Master Plan', '', 'pages/plan', 17, 0),
(23, 'सम्बन्धित कार्यलय', '', 'Related Offices', '', 'pages/offices', 0, 0),
(24, 'ढि ओ ऐफ ई', '', 'DOFE', '', 'pages/dofe', 23, 1),
(26, 'सुरुवात', '', 'Introduction to DOFE', '', 'pages/dofe-intro', 24, 1),
(27, 'समाचार', '', 'News and Alerts', '', 'pages/dofe-news-and-alerts', 24, 1),
(28, 'ढि ओ ऐल', '', 'DOL', '', 'pages/dol', 23, 1),
(29, 'ओ एस् एच पि', '', 'OSHP', '', 'pages/oshp', 23, 1),
(30, 'मिडिया', '', 'Media', '', 'pages/media', 0, 0),
(31, 'बिभाग', 'अरु बिभागहरु', 'Division', 'Different Difivisons .....', '', 17, 1),
(32, 'अर्थ बिभाग', 'अर्थ बिभागको बारेमा ....', 'Financial Division', 'about Financial Division .......', 'divisions/63', 31, 1),
(33, 'बजेट बिभाग', 'बजेट बिभागको बारेमा ....', 'Budgett Division', 'about Budjet Division .......', 'divisions/budget', 31, 0),
(34, 'न्याय तया संबिधान', 'न्याय तया संबिधानको बारे', 'Legal and Constitution Diviison', 'about Legal and Constitution Diviison ... ', 'divisions/legal', 31, 0),
(35, 'बजेट बिभाग', 'बजेट बिभागको बारेमा जानकारी .....', 'Budget Division', 'Information about Budjet Division.........', 'divisions/58', 31, 1),
(36, 'स्वास्थ', 'स्वास्थको बारे ........', 'Health and Safety', 'about Health an Savety ........', '', 0, 1),
(37, ' ासलदजा लकदजउहा लसकजाउलज लाकज ', 'सउगज सतु ससत', 'WSH Regulatory Framework', 'h sh s h', 'health/44', 36, 1),
(38, 'स्वास्थ तथा सुरक्षा बिभाग', 'स्वास्थ तथा सुरक्षाको बारे ........', 'Safety & Health Management System ', 'about Health an Savety ........', 'health/43 ', 36, 1);

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
(1, 1, '127.0.0.1', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, 1268889823, 1358836733, 1);

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE IF NOT EXISTS `networks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `title_np` varchar(127) NOT NULL,
  `link` varchar(127) NOT NULL,
  `description` varchar(127) NOT NULL,
  `description_np` varchar(127) NOT NULL,
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

INSERT INTO `networks` (`id`, `title`, `title_np`, `link`, `description`, `description_np`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`) VALUES
(1, 'Like us on Facebook', 'फेसबुक', 'http://facebook.com', 'like from facebook ...................', 'फेसबुक .........', 1, '2013-01-07 23:57:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(2, 'Follow us on Twitter', 'ट्विटर', 'http://twitter.com', 'Follow us on Twitter ..............', 'ट्विटर ...........', 1, '2013-01-07 23:57:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `title_np` varchar(255) NOT NULL,
  `content_np` longtext NOT NULL,
  `news_type` int(127) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `homepage` tinyint(4) NOT NULL DEFAULT '0',
  `lang` enum('en','np') NOT NULL DEFAULT 'en',
  `filename` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_type` (`news_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `title_np`, `content_np`, `news_type`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`, `lang`, `filename`) VALUES
(5, 'The floods submits documents', '<p>\n An employer or an establishment hit by the floods submits dicuments concerned to the Provincial Office of Labour</p>\n<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n &nbsp;</p>', 'बाढीले कागजहरू ....', '<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>', 2, 1, '2012-12-18 23:55:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(6, 'The floods submits documents', '<p>\n An employer or an establishment hit by the floods submits dicuments concerned to the Provincial Office of Labour.</p>\n<p>\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n &nbsp;</p>', 'बाढीले कागजहरू ....', '<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>', 2, 1, '2012-12-18 23:58:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(7, 'Restricated Trading Days', '<p>\n Restricated Trading Days</p>\n<p>\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n &nbsp;</p>\n', 'उध्योग दिनहरु', '<p>\n उध्योग दिनहरु</p>\n<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>\n', 7, 1, '2012-12-19 00:11:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(8, 'Minimum wage rates', '<p>\n Minimum wage rates</p>\n<p>\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n &nbsp;</p>\n', 'न्युनतम पारिशमिक दर', '<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>\n', 7, 1, '2012-12-19 00:12:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(9, 'Public holidays dates 2012', '<p>\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n <br />\n &nbsp;</p>\n', 'बिदा दिनहरु', '<p>\n ्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>\n', 7, 1, '2012-12-19 00:13:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(10, 'Minimum employment rights', '<p>\n Minimum employment rights</p>\n<p>\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n &nbsp;</p>\n', 'न्युनतम पारिशमिक अधिकार', '<p>\n ्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>\n', 7, 1, '2012-12-19 00:14:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(14, 'WSH Regulatory Framework ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', '', '', 5, 1, '2012-12-19 18:58:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL);
INSERT INTO `news` (`id`, `title`, `content`, `title_np`, `content_np`, `news_type`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`, `lang`, `filename`) VALUES
(15, 'Safety & Health Management System ', '<p  justify;">\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n <br />\n &nbsp;</p>\n', 'स्वास्थ', '<p  justify;">\n ्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n &nbsp;</p>\n', 5, 1, '2012-12-19 19:00:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(16, 'Monitoring and Surveillance ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', '', '', 5, 1, '2012-12-19 19:01:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(17, 'Work Injury Compensation', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', '', '', 5, 1, '2012-12-19 19:02:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'en', NULL),
(18, 'Certification & Registration', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;/p&gt;\n', 'उगजहउगह', '<p>\n सह सजह सह सह सह सह सतहयु</p>\n', 5, 1, '2012-12-19 19:03:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(19, 'Incident Reporting ', '&lt;p&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan&lt;br /&gt;\n arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue&lt;br /&gt;\n nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla&lt;br', '', '', 5, 1, '2012-12-19 19:04:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 'en', NULL),
(21, ' Amendments to the Employment of Foreign Manpower Act', '&lt;p&gt;\r\n The Employment of Foreign Manpower Act (EFMA) prescribes the responsibilities and obligations pertaining to the employment of foreign workers. The EFMA was last amended in 2007.Since 2010, following the recommendations of the Economic Strategi', '', '', 8, 1, '2012-12-22 02:39:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(26, 'nnnn', '&lt;p&gt;\n ndaoijad iof jweopf japsodif jaoeijf aposija w&lt;/p&gt;\n', '', '', 8, 1, '2012-12-30 02:37:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(43, 'Safety & Health Management System', '<p>\n &nbsp;</p>\n<p>\n &lt;p justify;&quot;=&quot;&quot;&gt;<br />\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n <br />\n &nbsp;</p>\n', 'स्वास्थ तथा सुरक्षा बिभाग', '<p>\n &nbsp;</p>\n<p>\n &lt;p justify;&quot;=&quot;&quot;&gt;<br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>\n', 5, 1, '2013-01-09 10:55:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(44, 'WSH Regulatory Framework', '<p  justify;">\n <br />\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n <br />\n &nbsp;</p>\n', 'फ्रेमवर्क', '<p  justify;">\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n &nbsp;</p>\n', 5, 1, '2013-01-09 14:20:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', NULL),
(58, 'Budget Division', '<p>\n <br />\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim.<br />\n Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n &nbsp;</p>', 'बजेट बिभाग', '<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय</p>\n<p>\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय</p>', 9, 1, '2013-01-18 07:57:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', '4'),
(62, 'Introduction', '&lt;p  justify;&quot;&gt;\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.&lt;br /&gt;\n &lt;br /&gt;\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.&lt;br /&gt;\n &lt;br /&gt;\n In nec faucibus ipsum. Integer vehicula congue sapien non tincidunt. Phasellus eget massa ligula, vitae consectetur risus. Cras sed nisi lorem. Aliquam erat volutpat. In vulputate sapien eget arcu sagittis lacinia. Curabitur et tortor nisi, a aliquet justo. Donec id purus at tellus eleifend tempor.&lt;br /&gt;\n &amp;nbsp;&lt;/p&gt;', 'परिचय', '<p  justify;">\n &nbsp;</p>\n<p>\n &lt;p style=&quot;text-align: justify;&quot; justify;&quot;=&quot;&quot;&gt; <strong>परिचय</strong><br />\n <br />\n असल श्रम सम्बन्ध कायम गरी श्रम क्षेत्रलाई व्यवस्थित र मर्यादित गराउँदै लगानी र औद्योगिक उत्पादनलाई सहज वातावरण सिर्जना गर्नका साथै श्रमिकहरुको हकहित र कल्याण अभिवृद्धि गर्न तत्कालीन उद्योग वाणिज्य तथा आपूर्ति मन्त्रालय अन्तर्गत रहने गरी २०२८ सालमा श्रम विभागको स्थापना भएको थियो । श्रम क्षेत्रको छुट्टै महत्व र यसमा समाज कल्याणको पक्ष समेत समावेश हुने गरी २०३८ सालमा नेपाल सरकारले छुट्टै श्रम तथा समाजकल्याण मन्त्रालय गठन गरी यस अन्तर्गत श्रम विभाग रहने व्यवस्था भयो । समयको परिवर्तन सँगै समाज कल्याणको क्षेत्र यो मन्त्रालयको कार्य क्षेत्रबाट हटाई यातायात व्यवस्थापन सम्बन्धी कार्य क्षेत्र यस मन्त्रलायमा समावेश गरी श्रम तथा यातायात व्यवस्था मन्त्रालयको रुपमा कार्य सञ्चालन हुँदै आएकोमा नेपाल सरकारको (मन्त्रीपरिषद) मिति २०६९।०२।०५ को निर्णयानुसार पुनः यातायात व्यवस्थापनको क्षेत्र हट्न गई श्रम तथा रोजगार मन्त्रालय कायम भई यस मन्त्रालयको कार्य क्षेत्रमा श्रम तथा रोजगारी सम्बन्धी विषयहरु समेटिएको छ ।<br />\n <br />\n <strong>पृष्ठभूमि</strong><br />\n <br />\n श्रम तथा रोजगार मन्त्रालयबाट श्रम तथा रोजगार क्षेत्रका नीति, योजना र कार्यक्रमहरु विशेषत आन्तरिक श्रम व्यवस्थापन, व्यवसायिक तथा सीप विकास तालीम, सामाजिक सम्बादका माध्यमबाट औद्योगिक शान्ति स्थापना, बालश्रम निवारण, व्यवसायजन्य सुरक्षा तथा स्वास्थ्य र वैदेशिक रोजगार प्रवद्र्धनमा केन्द्रित रही कार्यक्रम सञ्चालन हुँदै आईरहेका छन् । सञ्चालित कार्यक्रमहरुबाट कानुनी, संस्थागत र कार्यगत व्यवस्थापनमा क्रमशः सुधार हुँदै आएको छ । यस क्षेत्रका विभिन्न सवालहरुलाई सम्बोधन गर्न नीतिगत, कानुनी तथा संस्थागत पूर्वाधारहरु पनि तयार हुदै गएको भएता पनि हासिल उपलव्धिहरु आवश्यकता र सम्भावनाको अनुपातमा पर्याप्त भने छैनन् । नेपालको श्रम बजारमा सक्रिय युवा श्रमशक्तिको आपूर्ति निरन्तर बढोत्तरी भइरहेको छ भने अर्को तर्फ तदनुरुप दक्ष जनशक्ति र रोजगार सिर्जना आशातीत रुपमा बृद्धि हुन सकेको छैन । फलस्वरुप श्रम तथा रोजगार सम्बन्धी माग तथा आपूर्तिका बीचमा निकै ठूलो खाडल देखा परेको छ । औद्योगिक प्रतिष्ठानहरुको वृद्धि सँगै रोजगारदाता र कामदारहरुबीच आपसी विश्वास, सहकार्य र हितमा आधारित सुमधुर सम्बन्धको विकास हुनु अनिवार्य हुन्छ भने औद्योगिक प्रतिष्ठानहरुमा कामदारहरुको निमित्त स्वस्थ एवं अनुकूल कार्य वातावरणको सुनिश्चितता पनि त्यत्तिकै महत्वपूर्ण पक्ष हुन आउँछ ।<br />\n <br />\n वर्तमान त्रि&ndash;वर्षीय योजना रोजगारमा केन्द्रित रहेको र सो अनुरुप जनशक्तिको उद्यमशीलता तथा रोजगार, स्वरोजगार सामथ्र्यमा अभिवृद्धि, सामाजिक सम्बादका माध्यमबाट औद्योगिक सम्बन्ध एवं लगानीको वातावरणमा सुधार, क्षमता न्यूनताको कारणबाट लाभान्वित हुन नसकेका युवा, महिला, जनजाती, अपाङ्गता भएका व्यक्ति, मधेशी, दलित तथा द्धन्दबाट प्रभावित एवं सीमान्तकृत समुदायको स्वदेशी तथा विदेशी श्रम बजारमा उपलव्ध अवसरहरुमा पहुँच, बालश्रम न्यूनीकरण, रोजगार क्षेत्रमा गुणात्मक सुधार र वैदेशिकरोजगारमा जानेहरुको हकहित संरक्षणको लागि संस्थागत सुधारमा जोड दिइएको छ । वैदेशिक रोजगारीलाई नियमन गर्ने, वैदेशिक रोजगारका नयाँ सवाल तथा चुनौतीहरुलाई समाधान गरी व्यवस्थित, मर्यादित, सुरक्षित एवं भरपर्दो बनाउनु मुख्य चुनौतीको रुपमा रहेकोे छ । विगत वर्षदेखि आन्तरिक श्रम व्यवस्थापनका लागि श्रम विभाग र बाह्य मुलुकमा जाने कामदारहरुको सहजीकरण र व्यवस्थापनको लागि वैदेशिक रोजगार विभाग तथा वैदेशिक रोजगार प्रवद्र्धन बोर्डको गठन हुनुका साथै वैदेशिक रोजगारमा जानेहरुलाई लक्षित गरी कल्याणकारी कोष सञ्चालनमा ल्याईएको छ । नेपाल सरकार मन्त्रिपरिषदको मिति २०६९।०२।०५ गतेको निर्णयबाट तत्कालीन श्रम तथा यातायात मन्त्रालयबाट यातायात व्यवस्थापन क्षेत्र अगल गरी श्रम तथा रोजगार मन्त्रालय कायम गरी मन्त्रालयको संरचना परिवर्तन भई रोजगारीलाई सरकारले मुख्य केन्द्रविन्दु बनाएको सन्दर्भमा मन्त्रालयको नीतिगत, कानुनी र संस्थागत संयन्त्रलाई व्यवस्थित र परिमार्जित गर्न जरुरी देखिएको छ । अतः मन्त्रालयको ध्यान रोजगार सम्बन्धी समष्टिगत नीति तयार गर्ने, स्वदेशमा रोजगारी तथा स्वरोजगारका अवसरहरु सिर्जना गर्न सघन रुपमा सीप तथा व्यावसायमूलक तालीम सञ्चालन गर्ने, रोजगार सूचना केन्द्रलाई रोजगार विनिमय केन्द्रको रुपमा विकास गर्ने, पूर्वाधारहरुको सिर्जना र सुशासनको माध्यमबाट देशभित्र आन्तरिक तथा वाह्य लगानी हुने वातावरण सिर्जना गर्ने, श्रम कानुनमा सुधार गरी सामाजिक संवाद र त्रि&ndash;पक्षीय संयन्त्रलाई परिचालन गरी सुमधुर श्रम सम्बन्ध सहित औद्योगिक शान्ति कायम गर्ने, बालश्रम निवारणका लागि स्थानीय स्तरसम्म कार्यक्रम विस्तार गर्ने तर्फ केन्द्रित हुनु पर्ने भएको छ । यसको साथै वैदेशिक रोजगारीलाई मर्यादित, सुरक्षित र व्यवस्थित बनाउन वैदेशिक रोजगार प्रशासनको आधुनिकीकरण तथा सुदृढीकरण गरी वैदेशिक रोजगारीबाट प्राप्त हुने विप्रेषण, सीप, प्रविधि र पूँजीलाई उत्पादनमूलक कार्यमा आकर्षित गर्न आवश्यक रहेको छ । विदेशमा रहेका नेपाली कामदारहरु र विशेष गरी महिला कामदारहरुको हक&not;हित संरक्षण एवं सम्बद्र्धन गर्ने तथा कामदारहरुको लागि सामाजिक सुरक्षा जस्ता कार्यक्रमहरु सञ्चालन गर्दै सरोकारवाला निकायहरुबीचको समन्वयलाई प्रभावकारी बनाई तदनुकूल नीति तथा कार्यक्रमहरु निर्वाधरुपमा कार्यान्वयन हुने वातावरण तयार गर्न जरुरी छ । बहुक्षेत्रका विषयहरु यस मन्त्रालयको कार्यक्षेत्रमा परेकाले नीतिगत समन्वय र कार्यान्वयनमा अन्य सम्वद्ध निकायहरुको सहयोग अपरिहार्य छ ।</p>', 6, 1, '2013-01-19 17:31:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 'en', '1358617425.6572.jpg');
INSERT INTO `news` (`id`, `title`, `content`, `title_np`, `content_np`, `news_type`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`, `lang`, `filename`) VALUES
(63, 'Financial Division', '<p>\n <br />\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n &nbsp;</p>', 'अर्थ बिभाग', '<p>\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n &nbsp;</p>', 9, 1, '2013-01-21 09:19:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', '3'),
(64, 'National Budget 2013', '<p>\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan arcu et orci ultricies condimentum sed sed enim. Phasellus sed augue nisi, eu auctor urna. Nunc aliquet tortor in lectus porttitor fringilla lobortis erat tristique. Morbi pulvinar augue in metus euismod id porta arcu euismod. Fusce ut risus justo. Vivamus ac fermentum enim. Pellentesque varius massa id elit posuere placerat. Integer tempor cursus lorem vitae gravida. Duis vestibulum euismod accumsan. Duis eu purus mattis arcu feugiat feugiat. Integer augue lorem, accumsan rutrum interdum in, cursus a nunc. Quisque varius libero id ligula congue euismod. In consequat ultrices diam, eu gravida tortor suscipit et.<br />\n <br />\n Ut pellentesque dolor ut sem ornare non malesuada nisl pellentesque. Nulla convallis scelerisque dignissim. Quisque vitae venenatis eros. Quisque quis mi vitae augue tristique mattis. Vivamus aliquet erat in felis imperdiet dignissim. Integer lobortis, diam vel ultrices fringilla, ipsum magna fermentum felis, in semper lacus neque sit amet eros. Vestibulum purus elit, consectetur eget luctus ut, fringilla eget libero. Fusce tempor molestie mollis. Duis sed erat purus, nec pulvinar sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam eget est eros.<br />\n &nbsp;</p>', 'नेपाल बद्जेट २०१३', '<p>\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n <br />\n श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालयश्रम तथा रोजगार मन्त्रालय श्रम तथा रोजगार मन्त्रालय<br />\n &nbsp;</p>', 4, 1, '2013-01-22 07:01:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 'en', '1358838265.0632.JPG');

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
  `title` varchar(127) CHARACTER SET utf8 NOT NULL,
  `sub_title` text CHARACTER SET utf8,
  `title_np` varchar(127) CHARACTER SET utf8 NOT NULL,
  `sub_title_np` text CHARACTER SET utf8,
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

INSERT INTO `organizations` (`id`, `title`, `sub_title`, `title_np`, `sub_title_np`, `date_created`, `created_by`, `date_published`, `date_removed`, `active`) VALUES
(7, 'Establishment', 'Ministry of Labour & Social Welfare, 2038 BS', 'संगठन', 'श्रम तथा जनहित मन्त्रालय', '2013-01-11 08:36:27', 0, NULL, NULL, 1),
(8, 'Establishment', 'Ministry of Labour, 2052 BS', 'संगठन', 'श्रम मन्त्रालय, बि स२०५२ ', '2013-01-11 08:36:27', 0, NULL, NULL, 1),
(9, 'Establishment', 'Ministry of Labour & Transport Management, 2057 BS', 'संगठन', 'श्रम तथा यातायात मन्त्रालय, बि स २०५७ ', '2013-01-03 15:23:43', 0, NULL, NULL, 1),
(10, 'Establishment', 'Ministry of Labour & Employment, 2069', 'संगठन', 'श्रम तथा रोजगार मन्त्रालय, बि स२०६९', '2013-01-11 09:02:17', 0, NULL, NULL, 1),
(11, 'Objectives and Long Term vision of Ministry', 'Development of Pure Industrial Relationship', 'भविश्यका चुनौती', 'ह कज गहकजग हकजगह जकगह जकह', '2013-01-03 15:24:30', 0, NULL, NULL, 1),
(12, 'Objectives and Long Term vision of Ministry', 'Ending Unemployment and Development of Productive and Qualitative Employment System', 'भविश्यका चुनौती', 'कजह कजह गजकहग कजगह कज', '2013-01-03 15:25:32', 0, NULL, NULL, 1),
(13, 'Objectives and Long Term vision of Ministry', 'Child Labour Alleviation', 'भविश्यका चुनौती', 'जकह गजकह गकजहग कजह गकजहग ', '2013-01-03 15:27:07', 0, NULL, NULL, 1),
(14, 'Objectives and Long Term vision of Ministry', 'Development of Safety, Managed and help based transportation system', 'भविश्यका चुनौती', 'जकह गकजह कजह कजह ', '2013-01-03 15:27:23', 0, NULL, NULL, 1),
(15, 'Responsibilities of Ministry', ' Labour policy and Work completion ', 'मन्त्रालयको जिम्मेवारी', 'कजगह कजगह कजह कजगह कजगह जकह ', '2013-01-03 15:29:52', 0, NULL, NULL, 1),
(16, 'Responsibilities of Ministry', ' Study, investigation, data collection and verification of labour power and labour market. ', 'मन्त्रालयको जिम्मेवारी', 'कजगह कजह गकजह जकह जकह गजक', '2013-01-03 15:30:13', 0, NULL, NULL, 1),
(17, 'Responsibilities of Ministry', ' Contact and relationship development of labour with national and international chambers and corporations ', 'मन्त्रालयको जिम्मेवारी', 'जकहग कजह जकह जकह गजकहब ', '2013-01-03 15:30:31', 0, NULL, NULL, 1),
(18, 'Responsibilities of Ministry', ' Relationship between Labour and management. ', 'मन्त्रालयको जिम्मेवारी', 'कजग जनबकजहग ुकयह कजगन ुक ', '2013-01-03 15:30:44', 0, NULL, NULL, 1),
(19, 'Responsibilities of Ministry', ' Help Employee and Labour supply. ', 'मन्त्रालयको जिम्मेवारी', 'कजगह जनब ुकहय कजबनव कुहकजह ', '2013-01-03 15:30:57', 0, NULL, NULL, 1),
(20, 'Responsibilities of Ministry', ' Foreign Employments ', 'मन्त्रालयको जिम्मेवारी', 'बैदेशिक रोजगार', '2013-01-11 09:02:17', 0, NULL, NULL, 1),
(21, 'Responsibilities of Ministry', ' Promotion, supply and organize vocational trainings ', 'मन्त्रालयको जिम्मेवारी', 'जकगह कजह गोलगकजगह ुोय कजगह ु', '2013-01-03 15:31:31', 0, NULL, NULL, 1),
(22, 'Responsibilities of Ministry', ' Training on child, women and disabled labours. ', 'मन्त्रालयको जिम्मेवारी', 'क जबुोगह कजगहवकुयतहग जहग ुक', '2013-01-03 15:31:44', 0, NULL, NULL, 1),
(23, 'Responsibilities of Ministry', ' Trade unions ', 'मन्त्रालयको जिम्मेवारी', 'कजगह िुयकहगउ यिकगतउ जयुत ुयतउयग', '2013-01-03 15:31:59', 0, NULL, NULL, 1),
(24, 'Responsibilities of Ministry', ' For social safety of Labour ', 'मन्त्रालयको जिम्मेवारी', 'जयहउ जगयतउ जहग उजयतग जहगउ य७', '2013-01-03 15:32:17', 0, NULL, NULL, 1),
(25, 'Responsibilities of Ministry', ' Permission for Foreign Employees ', 'मन्त्रालयको जिम्मेवारी', 'जहग यजहतगउ जयहग जगउ िुगय जगउ यग जहगउ य', '2013-01-03 15:32:29', 0, NULL, NULL, 1),
(26, 'Responsibilities of Ministry', ' Labour Administration and Management. ', 'मन्त्रालयको जिम्मेवारी', 'जहगउ यउ जहगउ यगि जगउ यिक', '2013-01-03 15:32:42', 0, NULL, NULL, 1),
(27, 'Responsibilities of Ministry', 'Bonus', 'मन्त्रालयको जिम्मेवारी', 'जहउ िकुय जयग उयुग जग ुयजग ', '2013-01-03 15:32:53', 0, NULL, NULL, 1),
(28, 'Responsibilities of Ministry', ' Manage, organize Transportation (Air transport not included) Policies and Planning, Regulations and Work completions. ', 'मन्त्रालयको जिम्मेवारी', 'जयगत जयत जगह युग जगउ ियग जगउ ', '2013-01-03 15:33:08', 0, NULL, NULL, 1),
(29, 'Responsibilities of Ministry', ' Manage, organize Transportation (Air transport not included) with other chambers and corporation ', 'मन्त्रालयको जिम्मेवारी', 'जयगत जयत हग ियग जग यिग जग', '2013-01-03 15:33:21', 0, NULL, NULL, 1),
(30, 'Responsibilities of Ministry', ' Relationship between Transportation (Air transport not included) with other related and managed international corporations ', 'मन्त्रालयको जिम्मेवारी', 'जयग जयत यजुग जहग हजगउ हजग हगब उियकग जह', '2013-01-03 15:33:33', 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `question_np` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  `option1_np` text NOT NULL,
  `option2_np` text NOT NULL,
  `option3_np` text NOT NULL,
  `option4_np` text NOT NULL,
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

INSERT INTO `poll` (`id`, `question`, `question_np`, `option1`, `option2`, `option3`, `option4`, `option1_np`, `option2_np`, `option3_np`, `option4_np`, `created_by`, `date_created`, `date_published`, `date_removed`, `count_option1`, `count_option2`, `count_option3`, `count_option4`, `active`) VALUES
(1, 'How much should the minimum wage be increased by?', 'न्युनतम पारिमिक कतिले बढाउनु पर्छ ?', 'Choice 1', 'Choice 2', 'Choice 3', 'Choice 4', 'बिचार १', 'बिचार २', 'बिचार ३', 'बिचार ४', 1, '2012-12-20 00:40:51', NULL, NULL, 0, 0, 1, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `poll_history`
--

INSERT INTO `poll_history` (`id`, `question_id`, `user_id`, `date_submitted`) VALUES
(2, 1, '1', '2013-01-11 16:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title_np` varchar(127) CHARACTER SET utf8 NOT NULL,
  `comments_np` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title` varchar(127) CHARACTER SET utf8 NOT NULL,
  `comments` varchar(255) CHARACTER SET utf8 NOT NULL,
  `link` varchar(127) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id`, `title_np`, `comments_np`, `title`, `comments`, `link`, `active`) VALUES
(1, 'घटना', 'घटनाको बारे .................', 'Events', 'about events ..........', 'events', 1),
(2, 'प्रश्न-उत्तर', 'प्रश्न-उत्तर ..........', 'FAQs', 'about faqs ........', 'faqs', 1),
(3, 'सुझाव', 'सुझाव बारे', 'Feedback', 'about feedbacks ........', 'contacts', 1),
(4, 'भेटघाट', 'भेटघाट बारे', 'contactus', 'about contactus ..........', 'contacts', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usefullinks`
--

CREATE TABLE IF NOT EXISTS `usefullinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `title_np` varchar(127) NOT NULL,
  `link` varchar(127) NOT NULL,
  `description` varchar(127) NOT NULL,
  `description_np` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `date_removed` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `homepage` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `usefullinks`
--

INSERT INTO `usefullinks` (`id`, `title`, `title_np`, `link`, `description`, `description_np`, `created_by`, `date_created`, `date_published`, `date_removed`, `active`, `homepage`) VALUES
(1, 'Employment Agreement Builder', 'श्रम सम्झौता', 'http://mof.gov.np', 'about Employment Agreement Builder ....', 'श्रम सम्झौताको बारे ....', 1, '2013-01-22 08:25:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(2, 'Paid Leave Calculator', 'बिदा हिसाब', 'http://google.com', 'description of Paid Parental', 'बिदा हिसाबको बारे', 1, '2013-01-22 08:31:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(3, 'Employment Law Database', 'श्रम ऐन', 'http://google.com', 'description of Database', 'श्रम ऐनको बारे', 1, '2013-01-22 08:27:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(4, 'Collective Bargaining resource', 'श्रम तथा रोजगार मन्त्रालय', 'http://google.com', 'description of resource', 'श्रम तथा रोजगार मन्त्रालयको बारे', 1, '2013-01-22 08:29:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(5, 'Ministry of Labour and Employments', 'श्रम तथा रोजगार मन्त्रालय', 'http://mof.gov.np', 'About Ministry of Labour and Employments', 'श्रम तथा रोजगार मन्त्रालयको बारे', 1, '2013-01-22 08:30:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0);

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
  `title_np` varchar(127) NOT NULL,
  `description_np` varchar(255) NOT NULL,
  `timestamp` varchar(127) NOT NULL,
  `created_by` int(100) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_published` timestamp NULL DEFAULT NULL,
  `file_type` varchar(127) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `vip`
--

INSERT INTO `vip` (`id`, `filename`, `title`, `description`, `title_np`, `description_np`, `timestamp`, `created_by`, `date_created`, `date_published`, `file_type`, `active`) VALUES
(3, 'Honorable_Minister_Posta_Bahadur_Bogati.jpg', 'Posta Bahadur Bogati', 'Honorable Minister', 'पोष्ट बहादुर बोगटी', 'मन्त्री', '1357231226.2148.jpg', 0, '2013-01-03 16:39:14', NULL, '', 1),
(4, 'secretary_Somlal_Subedi.jpg', 'Somlal Subedi', 'Secretry', 'सोम लाल  सुबेदि', 'सचिव', '1357231267.7461.jpg', 0, '2013-01-03 16:40:31', NULL, '', 1),
(5, 'index.png', 'lkjhl kj', 'kj hlkjh lkj hl', 'ुयिुय', 'जहगदुत', '1358488243.2613.png', 0, '2013-01-18 05:50:20', NULL, '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=224 ;

--
-- Dumping data for table `visited_count`
--

INSERT INTO `visited_count` (`id`, `timestamp`, `ip_address`) VALUES
(1, '2013-01-01 16:38:15', '127.0.0.1'),
(9, '2013-01-02 12:28:30', '192.168.1.1'),
(23, '2013-01-03 15:26:14', '192.168.1.3'),
(135, '2013-01-05 18:07:42', '192.168.1.2'),
(144, '2013-01-05 18:09:30', '192.168.1.6'),
(210, '2013-01-05 20:10:42', '192.168.1.4'),
(223, '2013-01-16 17:30:05', '192.168.1.8');

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
