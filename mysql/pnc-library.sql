-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2016 at 12:28 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2016vc2g6_pnc-library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_title_kh` varchar(45) DEFAULT NULL,
  `b_title_en` varchar(45) DEFAULT NULL,
  `b_language` varchar(45) DEFAULT NULL,
  `b_barcode` varchar(45) DEFAULT NULL,
  `b_author` varchar(45) DEFAULT NULL,
  `b_description` varchar(255) DEFAULT NULL,
  `b_comment` varchar(200) NOT NULL,
  `b_year` year(4) DEFAULT NULL,
  `b_isbn` varchar(45) DEFAULT NULL,
  `b_publisher` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `sta_id` int(11) NOT NULL,
  `b_keyword` varchar(45) DEFAULT NULL,
  `b_label` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  KEY `fk_books_users1_idx` (`users_id`),
  KEY `fk_books_categories1_idx` (`cat_id`),
  KEY `fk_books_conditions1_idx` (`con_id`),
  KEY `fk_books_status1_idx` (`sta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_id`, `b_title_kh`, `b_title_en`, `b_language`, `b_barcode`, `b_author`, `b_description`, `b_comment`, `b_year`, `b_isbn`, `b_publisher`, `users_id`, `cat_id`, `con_id`, `sta_id`, `b_keyword`, `b_label`) VALUES
(28, '', 'Space explorer', 'English', '002242443543', 'Rithy sam', '', '', 2016, '978023578477', 'RITHY', 1, 17, 1, 2, 'explorer', 'JHK'),
(29, '', 'Creating Facebook', 'English', '23974839', 'Sreymom', '', '', 1999, '035849359348', 'Rithy sam', 1, 18, 1, 1, 'facebook', 'SYM'),
(30, '', 'Window server 2013', 'en', '8756452345t', 'Rithy', '', '', 2013, '9543ip4i3983', 'rity', 1, 11, 1, 1, 'admin', 'RTH'),
(31, '', 'Pree Enter', 'English', '123456i6543', 'Dakas Va', '', '', 2016, '89786543654', 'Chantha NUl', 1, 16, 1, 1, 'Enter', 'DDV'),
(32, '', 'Head way', 'English', '4y3u254321', 'Fatasa ka', '', '', 2015, '895304-3=22', 'Soktheara', 1, 16, 1, 1, 'Ennglish, head way', 'FTK'),
(33, '', 'Creating Facebook', 'English', '-908765432345', 'MakZekaberk', '', '', 2014, '0897865432', 'kslaka', 1, 17, 1, 1, 'facebook', 'MZB'),
(34, '', 'Creating iPhone', 'English', '98309876d7', 'SteavJob', '', '', 2016, '4654654654', 'RIHTY', 1, 17, 1, 1, 'iPhone', 'SJB'),
(35, '', 'NASA goal', 'English', '09876543qws', 'Rithy sam', '', '', 1998, '978023578477', 'Chantha NUl', 1, 17, 1, 1, 'explorer', 'JHK'),
(36, '', 'Responsive Design', 'English', '98gjfhg23456', 'Dakas Va', '', '', 2016, '0897865432', 'Chantha NUl', 1, 13, 1, 1, 'science', 'DDV'),
(37, 'លួចខួរក្បាល', '', 'Khmer', '14162B1D4Ct', 'Rithy sam', '', '', 2016, '1234567890', 'RIHTY', 1, 14, 1, 1, 'លួចខួរក្បាល', 'RTS'),
(38, '', 'Beauty salon', 'English', 'lkjhg9876523', 'Rithy sam', '', '', 2016, '895304-3=22', 'RIHTY', 1, 15, 1, 2, 'Salon', 'RTS'),
(39, '', 'System Network Administrator', 'English', '9862456765432', 'Fatasa ka', '', '', 2016, '0897865432', 'Chantha NUl', 1, 13, 1, 1, 'System', 'FTK'),
(40, '', 'Javascript', 'English', '93473986429032', 'Sotheara', 'This book is good for read and practice by yourseft', 'Good for read and improve', 2016, '', '', 1, 11, 1, 1, 'best book for read in online', ''),
(41, '', 'C++', 'English', '1234567833444', 'rady y', 'perfect book in Mycrosoft', 'new book come from rady', 2016, '12345678902334', 'rady', 1, 13, 1, 1, 'best book for read in online', 'dy'),
(42, 'ប្រវត្តិខ្មែរ', 'Khmer history (18633-1953)', 'Khmer', '934953943394', 'Lyheav', 'History of Cambodian', 'know khmer', 2000, '979274045403830', 'Saroeurb', 1, 10, 1, 1, 'history', NULL),
(43, 'សន្ទនាភាសាថៃ', 'Thai Conversation', 'en', '87543920323682', 'Rady', 'from Thai language', 'good conversation', 2009, '397328682398', 'Lyheav', 1, 16, 1, 1, 'coversation', 'THA'),
(44, 'ភាពជាមេដឹកនាំ', 'Leadership', 'en', '09564435355367', 'David Charle', 'leadership skill', 'good', 2014, '', 'Saroeurb', 1, 25, 1, 1, 'leadership', 'SAR');

-- --------------------------------------------------------

--
-- Table structure for table `books_request`
--

CREATE TABLE IF NOT EXISTS `books_request` (
  `re_id` int(11) NOT NULL AUTO_INCREMENT,
  `re_title_en` varchar(50) NOT NULL,
  `re_title_kh` varchar(70) NOT NULL,
  `re_author` varchar(50) NOT NULL,
  `re_language` varchar(50) NOT NULL,
  `re_user_id` int(11) NOT NULL,
  `re_description` varchar(200) NOT NULL,
  `re_status_re_id` int(11) NOT NULL,
  `re_comment` varchar(200) NOT NULL,
  `re_year` year(4) NOT NULL,
  PRIMARY KEY (`re_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `books_request`
--

INSERT INTO `books_request` (`re_id`, `re_title_en`, `re_title_kh`, `re_author`, `re_language`, `re_user_id`, `re_description`, `re_status_re_id`, `re_comment`, `re_year`) VALUES
(10, 'grammer', '', 'soktheara', 'English', 1, 'good', 0, '', 0000),
(11, 'good family', '', 'soktheara', 'English', 1, 'good', 3, 'bad', 0000),
(12, 'cambodia news', '', 'soktheara', 'English', 1, 'good book', 2, 'good', 0000),
(13, 'C#', '', 'soktheara', 'English', 1, 'for WEP subject', 2, 'good', 0000),
(14, 'JavaScript', '', 'soktheara', 'English', 1, 'This is good book for wep skill', 1, '', 0000),
(15, 'Jecma Business', '', 'Dakas Va', 'English', 1, 'This book is take about Jecma', 1, '', 0000);

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE IF NOT EXISTS `borrows` (
  `bor_id` int(11) NOT NULL AUTO_INCREMENT,
  `bor_borrow_date` date DEFAULT NULL,
  `bor_return_date` date DEFAULT NULL,
  `bor_chechin_date` date DEFAULT NULL,
  `bor_status` varchar(45) DEFAULT NULL,
  `bor_comment` varchar(45) DEFAULT NULL,
  `rules_rul_id` int(11) NOT NULL,
  `books_b_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`bor_id`),
  KEY `fk_borrows_rules_idx` (`rules_rul_id`),
  KEY `fk_borrows_books1_idx` (`books_b_id`),
  KEY `fk_borrows_users1_idx` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`bor_id`, `bor_borrow_date`, `bor_return_date`, `bor_chechin_date`, `bor_status`, `bor_comment`, `rules_rul_id`, `books_b_id`, `users_id`) VALUES
(43, '2016-06-25', '2016-07-01', '2016-06-27', 'New', 'Is the same before borrowing.', 1, 28, 1),
(44, '2016-06-27', '2016-07-03', '2016-07-05', 'Correct', '', 1, 31, 3),
(46, '2016-06-28', '2016-07-04', '2016-06-29', 'New', '', 1, 32, 2),
(47, '2016-06-20', '2016-06-26', '2016-06-29', 'New', '', 1, 38, 4),
(48, '2016-06-29', '2016-07-05', '2016-07-13', 'New', '', 1, 33, 5),
(49, '2016-06-29', '2016-07-05', '2016-06-29', 'New', '', 1, 30, 2),
(50, '2016-06-29', '2016-07-05', '2016-07-15', 'New', '', 1, 31, 2),
(51, '2016-06-29', '2016-07-05', '2016-06-29', 'New', '', 1, 39, 1),
(52, '2016-06-29', '2016-07-05', '2016-07-08', 'New', '', 1, 34, 2),
(53, '2016-06-29', '2016-07-05', '2016-07-15', 'New', '', 1, 35, 6),
(54, '2016-06-29', '2016-07-05', '2016-06-29', 'New', '', 1, 37, 2),
(55, '2016-06-29', '2016-07-05', '2016-07-05', 'New', '', 1, 34, 8),
(56, '2016-06-29', '2016-07-05', '2016-06-29', 'New', '', 1, 35, 2),
(57, '2016-06-29', '2016-07-05', '2016-07-05', 'New', '', 1, 37, 5),
(58, '2016-06-29', '2016-07-05', '2016-07-05', 'New', '', 1, 36, 7),
(59, '2016-06-29', '2016-07-05', '2016-06-29', 'New', '', 1, 29, 8),
(60, '2016-06-29', '2016-07-05', '2016-06-29', 'New', '', 1, 34, 7),
(61, '2016-06-29', '2016-07-05', '2016-06-29', 'New', '', 1, 36, 6),
(62, '2016-06-29', '2016-07-05', NULL, NULL, NULL, 1, 28, 3),
(63, '2016-06-23', '2016-06-29', NULL, NULL, NULL, 1, 28, 8),
(64, '2016-06-21', '2016-06-27', NULL, NULL, NULL, 1, 34, 7),
(65, '2016-06-18', '2016-06-24', NULL, NULL, NULL, 1, 30, 2),
(66, '2016-06-30', '2016-07-06', NULL, NULL, NULL, 1, 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(200) DEFAULT NULL,
  `cat_comment` varchar(200) DEFAULT NULL,
  `categoryId` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`),
  KEY `fk_categories_category_label1_idx` (`categoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_comment`, `categoryId`) VALUES
(11, 'Computer science-IT general', '		      		good		      	', '000-ITG'),
(12, 'Computer science - System and network administration', 'good', '000-SNA'),
(13, 'Computer science - Web programming', 'good book', '000-WEP'),
(14, 'Philosophy', '		      				      	', '100-PLP'),
(15, 'Social sciences', NULL, '300'),
(16, 'Language', '		      				      	', '400-LAN'),
(17, 'Science', '		      				      	', '500-SCI'),
(18, 'Technology', '		      				      	', '600-Tech'),
(19, 'First reading', NULL, '800-FR'),
(20, 'History and Geography', '', '900-HG'),
(21, 'Novel', 'Good for free time', '700-NOV'),
(22, 'Dictionary', '', '101-DIC'),
(23, 'Mathematics', 'Improve your thinking', '100-MAT'),
(24, 'Poem', '', '100-POE'),
(25, 'Mind book', 'improved your soft skill', '200-MIN');

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE IF NOT EXISTS `conditions` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`con_id`, `con_name`) VALUES
(1, 'New'),
(2, 'Correct'),
(3, 'Need repair');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'Borrower');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `rul_id` int(11) NOT NULL AUTO_INCREMENT,
  `rul_num_day` int(11) DEFAULT NULL,
  PRIMARY KEY (`rul_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`rul_id`, `rul_num_day`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `sta_id` int(11) NOT NULL AUTO_INCREMENT,
  `sta_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sta_id`, `sta_name`) VALUES
(1, 'Vacant'),
(2, 'Booked'),
(3, 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `status_request`
--

CREATE TABLE IF NOT EXISTS `status_request` (
  `status_re_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_re_name` varchar(50) NOT NULL,
  PRIMARY KEY (`status_re_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `status_request`
--

INSERT INTO `status_request` (`status_re_id`, `status_re_name`) VALUES
(1, 'Padding'),
(2, 'Agree'),
(3, 'Disagree');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `login` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `role` int(11) NOT NULL,
  `last_connection_utc` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role`),
  KEY `IX_users_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `login`, `email`, `password`, `role`, `last_connection_utc`) VALUES
(1, 'Administrator', ' 	benoit', 'admin', 'benoit.pitet@passerellesnumeriques.org', '$2a$08$t5zNpmnjY8WUPS4Zi3p97OSXwCjRDUTgMmUdddqQvBzSnlUUyKJ5m', 1, NULL),
(2, 'Rithy', 'Sam', 'rithy.sam', 'rithy.sam@student.passerellesnumeriques.org', '$2a$08$hfuf.fNHxYY1H/L3Ay80UuTkVdbMEURw9CDW906gwSzG8ySSQQsW2', 2, NULL),
(3, 'Soktheara', 'Bin', 'soktheara.bin', 'soktheara.bin@student.passerellesnumeriques.org', '$2a$08$hfuf.fNHxYY1H/L3Ay80UuTkVdbMEURw9CDW906gwSzG8ySSQQsW2', 2, NULL),
(4, 'Rady', 'Y', 'rady.y', 'rady.y@student.passerellesnumeriques.org', '$2a$08$hfuf.fNHxYY1H/L3Ay80UuTkVdbMEURw9CDW906gwSzG8ySSQQsW2', 2, NULL),
(5, 'Saroeurb', 'Nark', 'saroeurb.nark', 'saroeurb.nark@student.passerellesnumeriques.org ', '$2a$08$hfuf.fNHxYY1H/L3Ay80UuTkVdbMEURw9CDW906gwSzG8ySSQQsW2', 2, NULL),
(6, 'Lyheav', 'Hak', 'lyheav.hak', 'lyheav.hak@student.passerellesnumeriques.org', '$2a$08$hfuf.fNHxYY1H/L3Ay80UuTkVdbMEURw9CDW906gwSzG8ySSQQsW2', 2, NULL),
(7, 'Sophea', 'Ou', 'sophea.ou', 'sophea.ou@passerellesnumeriques.org ', '$2a$08$hfuf.fNHxYY1H/L3Ay80UuTkVdbMEURw9CDW906gwSzG8ySSQQsW2', 2, NULL),
(8, 'Elise', 'Durand', 'elise.durand', 'elise.durand@passerellesnumeriques.org ', '$2a$08$hfuf.fNHxYY1H/L3Ay80UuTkVdbMEURw9CDW906gwSzG8ySSQQsW2', 2, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
