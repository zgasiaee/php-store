-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 03, 2022 at 09:57 AM
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
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `amount` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `code` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `price` double(10,3) NOT NULL,
  `groups` int(100) NOT NULL,
  `pic` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `amount`, `code`, `price`, `groups`, `pic`) VALUES
(17, 'شلیل', 'بسته 1 کیلوگرمی', 'SH17', 37.500, 1, 'fruites/17'),
(5, 'موز', 'کیلوگرم', 'M05', 38.500, 1, 'fruites/5'),
(6, 'گریپ فروت', 'کیلوگرم', 'GF06', 19.600, 1, 'fruites/6'),
(7, 'پرتقال جنوب', 'کیلوگرم', 'PJ07', 31.300, 1, 'fruites/7'),
(16, 'توت فرنگی', 'بسته 300 گرمی', 'TF16', 28.000, 1, 'fruites/16'),
(8, 'لیمو ترش', 'بسته 500 گرمی', 'LT08', 16.500, 1, 'fruites/8'),
(15, 'زنجبیل', 'بسته 250 گرمی', 'ZA15', 56.000, 1, 'fruites/15'),
(9, 'نارگیل', '1 عدد', 'N09', 32.000, 1, 'fruites/9'),
(10, 'به', 'کیلوگرم', 'B10', 29.000, 1, 'fruites/10'),
(14, 'انار', 'کیلوگرم', 'AN14', 27.000, 1, 'fruites/14'),
(11, 'گیلاس', 'بسته 500 گرمی', 'GI11', 39.000, 1, 'fruites/11'),
(13, 'نارنگی', 'کیلوگرم', 'NA13', 26.500, 1, 'fruites/13'),
(12, 'گلابی', 'کیلوگرم', 'JO12', 45.500, 1, 'fruites/12'),
(3, 'عرق زنیان', '1 لیتری', 'AZA03', 17.900, 3, 'organic/3'),
(4, 'عرق رازیانه', '1000 سی سی', 'ARAZ04', 8.000, 3, 'organic/4'),
(18, 'عسل سفید', 'شیشه 250 گرمی', 'ASSE05', 52.000, 3, 'organic/5'),
(19, 'عسل مخصوص چند گیاه', 'شیشه 850 گرمی', 'ASCH06', 172.000, 3, 'organic/6'),
(20, 'عسل گون انگبین', 'شیشه 850 گرمی', 'AJON07', 182.000, 3, 'organic/7'),
(21, 'روغن کنجد', 'بطری 750 سی سی', 'RKO08', 130.000, 3, 'organic/8'),
(22, 'روغن آفتابگردان', '750 سی سی', 'RAF09', 58.000, 3, 'organic/9'),
(23, 'روغن زیتون', 'شیشه 500 سی سی', 'RZE10', 68.000, 3, 'organic/10'),
(24, 'گوجه گیلاسی', 'بسته 380 گرمی', 'GG03', 23.000, 2, 'vegetable/3'),
(25, 'شلغم', 'کیلوگرم', 'SHA04', 26.500, 2, 'vegetable/4'),
(26, 'سیر حبه', 'بسته 250 گرمی', 'SIR05', 20.000, 2, 'vegetable/5'),
(27, 'سیب زمینی', 'بسته 2 کیلوگرمی', 'SIB06', 26.500, 2, 'vegetable/6'),
(1, 'کدو سبز', 'کیلوگرم', 'KAD07', 18.600, 2, 'vegetable/7'),
(28, 'هویج', 'کیلوگرم', 'HA08', 12.300, 2, 'vegetable/8'),
(29, 'کلم بروکلی', '1 عدد', 'KAB09', 19.000, 2, 'vegetable/9'),
(30, 'بادمجان', 'کیلوگرم', 'BAD10', 15.500, 2, 'vegetable/10'),
(31, 'چغندر', 'کیلوگرم', 'CHOG11', 13.200, 2, 'vegetable/11'),
(32, 'قارچ', 'بسته 400 گرمی', 'GHAR12', 28.000, 2, 'vegetable/12'),
(33, 'موسیر', 'بسته 200 گرمی', 'MO13', 75.000, 2, 'vegetable/13'),
(34, 'پیاز', '2 کیلوگرمی', 'PIA14', 16.800, 2, 'vegetable/14'),
(35, 'فلفل دلمه رنگی', 'بسته 3 عددی', 'FERA15', 26.000, 2, 'vegetable/15'),
(36, 'کلم سفید', '1 عدد', 'KAS16', 13.200, 2, 'vegetable/16'),
(37, 'لوبیا سبز', 'کیلوگرم', 'LOSA17', 24.500, 2, 'vegetable/17'),
(38, 'کرفس', 'بسته 700 گرمی', 'KARF18', 6.500, 2, 'vegetable/18'),
(41, 'خیار گلخانه ای', 'کیلوگرم', 'KHIA01', 18.700, 1, 'fruites/2'),
(58, 'فلفل تند', '500 گرم', 'FEFTO19', 12.000, 2, 'vegetable/19'),
(59, 'بلال', 'عدد', 'BALL20', 7.500, 2, 'vegetable/20'),
(45, 'سیب آبگیری مخلوط', 'توری 2 کیلویی', 'SIBMA01', 17.000, 1, 'fruites/1'),
(46, 'سیب قرمز و زرد', 'بسته 700 گرمی', 'SIBGHZA02', 17.000, 1, 'fruites/3'),
(47, 'انار درجه دو', 'توری 2 کیلویی', 'ANAD2', 20.000, 1, 'fruites/4'),
(48, 'انگور', 'کیلوگرم', 'ANG03', 31.000, 1, 'fruites/18'),
(49, 'چاقاله بادام', 'بسته 300 گرمی', 'CHAGHAL', 35.000, 1, 'fruites/19'),
(50, 'زردآلو', 'بسته 500 گرمی', 'ZARDA04', 35.500, 1, 'fruites/20'),
(51, 'عرق شاهتره', 'پت 1 لیتری', 'ARASHAH', 17.900, 3, 'organic/1'),
(67, 'آناناس', '1 عدد', 'ANAS12', 174.000, 1, 'fruites/21'),
(52, 'آبغوره ', 'شیشه 1 لیتری', 'ABGHO11', 28.500, 3, 'organic/11'),
(53, 'سرکه سیب', '1 لیتری', 'SERKSI12', 18.800, 3, 'organic/12'),
(54, 'پسته خام', 'لیوان 85 گرمی', 'PESKHA12', 26.000, 3, 'organic/13'),
(55, 'توت خشک', 'بسته 250 گرمی', 'TOTKHO14', 29.000, 3, 'organic/14'),
(56, 'عرق نعنا', 'پت 1 لیتری', 'ARANA15', 21.900, 3, 'organic/15'),
(57, 'زعفران', 'بسته 2 گرمی', 'ZAFE16', 37.500, 3, 'organic/16'),
(60, 'فلفل دلمه ای', 'بسته 400 گرمی', 'FELFDOL1', 15.500, 2, 'vegetable/1'),
(61, 'کاهو چینی', '1 عدد', 'KAHCHI2', 18.000, 2, 'vegetable/2');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userIp` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `browser` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `userName` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `detailes` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `userId`, `time`, `userIp`, `browser`, `email`, `userName`, `detailes`) VALUES
(1, 2, '2022-02-27 05:58:22', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(2, 3, '2022-02-27 06:01:38', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(3, 3, '2022-02-27 06:08:16', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(4, 3, '2022-02-27 06:22:25', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(5, 2, '2022-02-27 06:28:53', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(6, 3, '2022-02-27 06:30:54', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(7, 2, '2022-02-27 08:49:16', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(8, 2, '2022-02-28 04:55:35', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(9, 2, '2022-02-28 04:57:40', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(10, 3, '2022-02-28 05:04:25', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(11, 3, '2022-02-28 05:06:10', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(12, 3, '2022-02-28 05:10:51', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(13, 3, '2022-02-28 05:10:53', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(14, 3, '2022-02-28 05:12:54', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(15, 3, '2022-02-28 05:12:55', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(16, 3, '2022-02-28 05:13:02', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(17, 3, '2022-02-28 05:13:39', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(18, 3, '2022-02-28 05:13:40', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(19, 3, '2022-02-28 05:13:41', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(20, 3, '2022-02-28 05:13:52', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(21, 3, '2022-02-28 05:15:22', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(22, 3, '2022-02-28 05:15:26', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(23, 3, '2022-02-28 05:19:41', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(24, 2, '2022-02-28 05:22:19', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(25, 2, '2022-02-28 05:22:20', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(26, 2, '2022-02-28 05:23:23', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(27, 2, '2022-02-28 05:30:31', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(28, 2, '2022-02-28 05:30:31', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(29, 2, '2022-02-28 05:31:50', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(30, 2, '2022-02-28 05:31:51', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(31, 2, '2022-02-28 05:32:24', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(32, 3, '2022-02-28 05:32:38', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(33, 2, '2022-02-28 05:33:50', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(34, 3, '2022-02-28 05:35:04', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(35, 3, '2022-02-28 05:35:05', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(36, 2, '2022-02-28 05:35:54', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(37, 2, '2022-02-28 05:35:54', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(38, 2, '2022-02-28 05:37:22', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(39, 2, '2022-02-28 05:37:23', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(40, 2, '2022-02-28 05:38:09', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(41, 2, '2022-02-28 05:40:16', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(42, 3, '2022-02-28 05:41:27', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(43, 2, '2022-02-28 05:42:42', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(44, 2, '2022-02-28 05:44:39', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(45, 3, '2022-02-28 05:45:30', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(46, 2, '2022-02-28 05:46:02', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(47, 2, '2022-02-28 05:46:57', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(48, 2, '2022-02-28 05:48:04', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(49, 2, '2022-02-28 05:49:04', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(50, 2, '2022-02-28 05:49:14', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(51, 3, '2022-02-28 05:50:15', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(52, 3, '2022-02-28 05:50:18', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(53, 3, '2022-02-28 05:50:53', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(54, 3, '2022-02-28 05:50:55', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(55, 3, '2022-02-28 05:51:56', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(56, 3, '2022-02-28 05:51:57', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(57, 3, '2022-02-28 05:51:58', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(58, 3, '2022-02-28 05:52:03', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(59, 3, '2022-02-28 05:52:04', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(60, 3, '2022-02-28 05:52:05', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(61, 3, '2022-02-28 05:52:05', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(62, 3, '2022-02-28 05:52:06', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(63, 3, '2022-02-28 05:52:07', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(64, 3, '2022-02-28 05:52:08', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(65, 2, '2022-02-28 05:53:21', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(66, 2, '2022-02-28 05:53:33', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(67, 3, '2022-02-28 05:53:58', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(68, 3, '2022-02-28 05:54:09', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(69, 2, '2022-03-02 04:41:47', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(70, 2, '2022-03-02 04:54:08', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(71, 3, '2022-03-02 05:02:29', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(72, 2, '2022-03-02 05:11:48', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(73, 2, '2022-03-02 05:12:36', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(74, 2, '2022-03-02 05:18:49', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(75, 2, '2022-03-02 05:26:26', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(76, 2, '2022-03-02 05:26:53', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(77, 3, '2022-03-02 05:30:57', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(78, 3, '2022-03-02 05:31:30', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(79, 2, '2022-03-02 05:34:27', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(80, 2, '2022-03-02 05:35:11', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(81, 2, '2022-03-02 05:36:10', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(82, 3, '2022-03-02 05:36:35', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(83, 3, '2022-03-02 05:37:09', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(84, 3, '2022-03-02 05:41:18', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(85, 3, '2022-03-02 05:42:54', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(86, 2, '2022-03-03 04:51:09', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(87, 2, '2022-03-03 05:01:23', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(88, 5, '2022-03-03 05:01:40', '::1', 'chrome', 'zgasiaeee@gmail.com', 'modir', 'ورود'),
(89, 2, '2022-03-03 05:59:01', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'ورود'),
(90, 2, '2022-03-03 05:59:59', '::1', 'chrome', 'zgasiaeee@gmail.com', 'zga', 'خروج'),
(91, 3, '2022-03-03 06:00:43', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'ورود'),
(92, 3, '2022-03-03 06:01:14', '::1', 'chrome', 'asiaee@gmail.com', 'sana', 'خروج'),
(93, 10, '2022-03-03 06:10:12', '::1', 'chrome', 'sara@gmail.com', 'sara', 'ورود'),
(94, 10, '2022-03-03 06:10:17', '::1', 'chrome', 'sara@gmail.com', 'sara', 'خروج');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `token`) VALUES
(10, 'سارا', 'احمدی', 'sara', 'sara@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '0'),
(8, 'زهرا', 'آسیایی', 'zga', 'zgasiaeee@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '5f7fcf4bba8a6c861591839923358b0ff0178c241646287836'),
(9, 'ثنا', 'آسیایی', 'sana', 'asiaee@gmail.com', 'bfe54caa6d483cc3887dce9d1b8eb91408f1ea7a', '0'),
(5, 'مدیر', 'وب سایت', 'modir', 'zgasiaeee@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '5f7fcf4bba8a6c861591839923358b0ff0178c241646287836');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
