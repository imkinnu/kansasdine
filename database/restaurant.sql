-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 03:05 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `beverages`
--

CREATE TABLE `beverages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beverages`
--

INSERT INTO `beverages` (`id`, `name`, `image`, `price`) VALUES
(1, 'Organic Lemonade', '1.png', '2.30'),
(2, 'Organic Hibiscus Lemonade', '2.png', '2.30'),
(3, 'Organic Mandarin Agua Fresca', '3.png', '2.30'),
(4, 'Organic Berry Agua Fresca', '4.png', '2.30'),
(5, 'Fountain Drink', '5.png', '2.30'),
(6, 'Mexican Coca-Cola', '6.png', '2.80');

-- --------------------------------------------------------

--
-- Table structure for table `burgers`
--

CREATE TABLE `burgers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `burgers`
--

INSERT INTO `burgers` (`id`, `name`, `image`, `price`) VALUES
(1, 'Big Mac', '1.jpg', '14.30'),
(2, 'Quarter Pounder with Cheese', '2.jpg', '16.30'),
(3, 'Double Quarter Pounder with Cheese', '3.jpg', '15.30'),
(4, 'Cheeseburger', '4.jpg', '12.30'),
(5, 'Double Cheeseburger', '5.jpg', '18.30'),
(6, 'Hamburger', '6.jpg', '25.20');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `category` int(11) NOT NULL COMMENT '1 - pizza 2 - beverages 3 - sandwiches 4 - burgers',
  `item_name` int(10) NOT NULL,
  `size` int(1) DEFAULT NULL,
  `crust` int(1) DEFAULT NULL,
  `sauce` int(1) DEFAULT NULL,
  `cheese` int(1) DEFAULT NULL,
  `quantity` int(5) NOT NULL,
  `price` varchar(20) NOT NULL,
  `timestamp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `category`, `item_name`, `size`, `crust`, `sauce`, `cheese`, `quantity`, `price`, `timestamp`) VALUES
(2, 'USR00001', 1, 37, 1, 1, 1, 1, 1, '65', '1619415633'),
(3, 'USR0002', 2, 1, 0, 0, 0, 0, 1, '2.30', '1619419918'),
(7, 'USR0002', 2, 4, 0, 0, 0, 0, 1, '2.30', '1619442211');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'BESTSELLERS'),
(2, 'VEG PIZZA'),
(3, 'NON-VEG PIZZA'),
(4, 'PIZZA MANIA');

-- --------------------------------------------------------

--
-- Table structure for table `crust`
--

CREATE TABLE `crust` (
  `id` int(11) NOT NULL,
  `crust` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crust`
--

INSERT INTO `crust` (`id`, `crust`) VALUES
(1, 'New Hand Tossed'),
(2, 'Wheat Thin Crust'),
(3, 'Cheese Burst'),
(4, 'Fresh Pan Pizza');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `cartid` int(10) NOT NULL,
  `payment_info` text NOT NULL,
  `invoice_no` varchar(30) NOT NULL,
  `timestamp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `cartid`, `payment_info`, `invoice_no`, `timestamp`) VALUES
(15, 'USR00001', 1, 'a:5:{i:0;s:24:\"Tirumalasetti Kiran Babu\";i:1;s:11:\"74687686531\";i:2;s:1:\"2\";i:3;s:4:\"2026\";i:4;s:9:\"288\";}', 'INVOICE-USR00001-0014', '1619415510'),
(16, 'USR0002', 3, '1b1665123c970c7f11301e1778387427', 'INVOICE-USR0002-0001', '1619441881'),
(17, 'USR0002', 7, 'de7f5c58125592dba28fecf885e70b36', 'INVOICE-USR0002-0017', '1619442276');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_prices`
--

CREATE TABLE `pizza_prices` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `type` int(5) NOT NULL,
  `size` int(11) NOT NULL,
  `crust` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizza_prices`
--

INSERT INTO `pizza_prices` (`id`, `category`, `type`, `size`, `crust`, `price`) VALUES
(1, 1, 1, 1, 1, 37),
(2, 1, 1, 2, 1, 70),
(3, 1, 1, 3, 1, 76),
(4, 1, 1, 1, 2, 35),
(5, 1, 1, 2, 2, 92),
(6, 1, 1, 3, 2, 94),
(7, 1, 1, 1, 3, 102),
(8, 1, 1, 2, 3, 56),
(9, 1, 1, 3, 3, 12),
(10, 1, 1, 1, 4, 70),
(11, 1, 1, 2, 4, 84),
(12, 1, 1, 3, 4, 69),
(13, 1, 8, 1, 1, 81),
(14, 1, 8, 2, 1, 48),
(15, 1, 8, 3, 1, 82),
(16, 1, 8, 1, 2, 83),
(17, 1, 8, 2, 2, 101),
(18, 1, 8, 3, 2, 59),
(19, 1, 8, 1, 3, 53),
(20, 1, 8, 2, 3, 91),
(21, 1, 8, 3, 3, 105),
(22, 1, 8, 1, 4, 95),
(23, 1, 8, 2, 4, 75),
(24, 1, 8, 3, 4, 110),
(25, 1, 7, 1, 1, 29),
(26, 1, 7, 2, 1, 21),
(27, 1, 7, 3, 1, 72),
(28, 1, 7, 1, 2, 101),
(29, 1, 7, 2, 2, 72),
(30, 1, 7, 3, 2, 14),
(31, 1, 7, 1, 3, 102),
(32, 1, 7, 2, 3, 31),
(33, 1, 7, 3, 3, 103),
(34, 1, 7, 1, 4, 59),
(35, 1, 7, 2, 4, 33),
(36, 1, 7, 3, 4, 93),
(37, 1, 6, 1, 1, 56),
(38, 1, 6, 2, 1, 39),
(39, 1, 6, 3, 1, 69),
(40, 1, 6, 1, 2, 96),
(41, 1, 6, 2, 2, 26),
(42, 1, 6, 3, 2, 37),
(43, 1, 6, 1, 3, 104),
(44, 1, 6, 2, 3, 101),
(45, 1, 6, 3, 3, 29),
(46, 1, 6, 1, 4, 112),
(47, 1, 6, 2, 4, 12),
(48, 1, 6, 3, 4, 77),
(49, 1, 5, 1, 1, 13),
(50, 1, 5, 2, 1, 106),
(51, 1, 5, 3, 1, 53),
(52, 1, 5, 1, 2, 37),
(53, 1, 5, 2, 2, 52),
(54, 1, 5, 3, 2, 83),
(55, 1, 5, 1, 3, 41),
(56, 1, 5, 2, 3, 92),
(57, 1, 5, 3, 3, 60),
(58, 1, 5, 1, 4, 16),
(59, 1, 5, 2, 4, 72),
(60, 1, 5, 3, 4, 95),
(61, 1, 4, 1, 1, 42),
(62, 1, 4, 2, 1, 106),
(63, 1, 4, 3, 1, 5),
(64, 1, 4, 1, 2, 44),
(65, 1, 4, 2, 2, 49),
(66, 1, 4, 3, 2, 76),
(67, 1, 4, 1, 3, 23),
(68, 1, 4, 2, 3, 81),
(69, 1, 4, 3, 3, 119),
(70, 1, 4, 1, 4, 81),
(71, 1, 4, 2, 4, 106),
(72, 1, 4, 3, 4, 90),
(73, 1, 3, 1, 1, 87),
(74, 1, 3, 2, 1, 96),
(75, 1, 3, 3, 1, 92),
(76, 1, 3, 1, 2, 67),
(77, 1, 3, 2, 2, 13),
(78, 1, 3, 3, 2, 83),
(79, 1, 3, 1, 3, 105),
(80, 1, 3, 2, 3, 70),
(81, 1, 3, 3, 3, 118),
(82, 1, 3, 1, 4, 38),
(83, 1, 3, 2, 4, 27),
(84, 1, 3, 3, 4, 61),
(85, 1, 2, 1, 1, 111),
(86, 1, 2, 2, 1, 111),
(87, 1, 2, 3, 1, 52),
(88, 1, 2, 1, 2, 26),
(89, 1, 2, 2, 2, 69),
(90, 1, 2, 3, 2, 62),
(91, 1, 2, 1, 3, 73),
(92, 1, 2, 2, 3, 34),
(93, 1, 2, 3, 3, 53),
(94, 1, 2, 1, 4, 29),
(95, 1, 2, 2, 4, 88),
(96, 1, 2, 3, 4, 69),
(97, 2, 18, 1, 1, 114),
(98, 2, 18, 2, 1, 74),
(99, 2, 18, 3, 1, 12),
(100, 2, 18, 1, 2, 79),
(101, 2, 18, 2, 2, 111),
(102, 2, 18, 3, 2, 59),
(103, 2, 18, 1, 3, 27),
(104, 2, 18, 2, 3, 80),
(105, 2, 18, 3, 3, 107),
(106, 2, 18, 1, 4, 120),
(107, 2, 18, 2, 4, 27),
(108, 2, 18, 3, 4, 23),
(109, 2, 19, 1, 1, 74),
(110, 2, 19, 2, 1, 43),
(111, 2, 19, 3, 1, 8),
(112, 2, 19, 1, 2, 90),
(113, 2, 19, 2, 2, 105),
(114, 2, 19, 3, 2, 42),
(115, 2, 19, 1, 3, 95),
(116, 2, 19, 2, 3, 5),
(117, 2, 19, 3, 3, 94),
(118, 2, 19, 1, 4, 27),
(119, 2, 19, 2, 4, 12),
(120, 2, 19, 3, 4, 120),
(121, 2, 20, 1, 1, 86),
(122, 2, 20, 2, 1, 56),
(123, 2, 20, 3, 1, 97),
(124, 2, 20, 1, 2, 28),
(125, 2, 20, 2, 2, 64),
(126, 2, 20, 3, 2, 67),
(127, 2, 20, 1, 3, 6),
(128, 2, 20, 2, 3, 33),
(129, 2, 20, 3, 3, 44),
(130, 2, 20, 1, 4, 41),
(131, 2, 20, 2, 4, 92),
(132, 2, 20, 3, 4, 83),
(133, 2, 21, 1, 1, 104),
(134, 2, 21, 2, 1, 68),
(135, 2, 21, 3, 1, 55),
(136, 2, 21, 1, 2, 111),
(137, 2, 21, 2, 2, 11),
(138, 2, 21, 3, 2, 60),
(139, 2, 21, 1, 3, 45),
(140, 2, 21, 2, 3, 66),
(141, 2, 21, 3, 3, 86),
(142, 2, 21, 1, 4, 23),
(143, 2, 21, 2, 4, 72),
(144, 2, 21, 3, 4, 69),
(145, 2, 22, 1, 1, 54),
(146, 2, 22, 2, 1, 92),
(147, 2, 22, 3, 1, 16),
(148, 2, 22, 1, 2, 75),
(149, 2, 22, 2, 2, 5),
(150, 2, 22, 3, 2, 106),
(151, 2, 22, 1, 3, 69),
(152, 2, 22, 2, 3, 95),
(153, 2, 22, 3, 3, 96),
(154, 2, 22, 1, 4, 18),
(155, 2, 22, 2, 4, 77),
(156, 2, 22, 3, 4, 61),
(157, 2, 23, 1, 1, 94),
(158, 2, 23, 2, 1, 64),
(159, 2, 23, 3, 1, 21),
(160, 2, 23, 1, 2, 82),
(161, 2, 23, 2, 2, 21),
(162, 2, 23, 3, 2, 12),
(163, 2, 23, 1, 3, 75),
(164, 2, 23, 2, 3, 13),
(165, 2, 23, 3, 3, 5),
(166, 2, 23, 1, 4, 114),
(167, 2, 23, 2, 4, 89),
(168, 2, 23, 3, 4, 111),
(169, 2, 17, 1, 1, 110),
(170, 2, 17, 2, 1, 23),
(171, 2, 17, 3, 1, 21),
(172, 2, 17, 1, 2, 44),
(173, 2, 17, 2, 2, 102),
(174, 2, 17, 3, 2, 89),
(175, 2, 17, 1, 3, 9),
(176, 2, 17, 2, 3, 82),
(177, 2, 17, 3, 3, 71),
(178, 2, 17, 1, 4, 72),
(179, 2, 17, 2, 4, 102),
(180, 2, 17, 3, 4, 86),
(181, 2, 16, 1, 1, 35),
(182, 2, 16, 2, 1, 92),
(183, 2, 16, 3, 1, 96),
(184, 2, 16, 1, 2, 89),
(185, 2, 16, 2, 2, 64),
(186, 2, 16, 3, 2, 83),
(187, 2, 16, 1, 3, 112),
(188, 2, 16, 2, 3, 7),
(189, 2, 16, 3, 3, 101),
(190, 2, 16, 1, 4, 60),
(191, 2, 16, 2, 4, 11),
(192, 2, 16, 3, 4, 119),
(193, 2, 15, 1, 1, 75),
(194, 2, 15, 2, 1, 72),
(195, 2, 15, 3, 1, 64),
(196, 2, 15, 1, 2, 10),
(197, 2, 15, 2, 2, 111),
(198, 2, 15, 3, 2, 102),
(199, 2, 15, 1, 3, 24),
(200, 2, 15, 2, 3, 120),
(201, 2, 15, 3, 3, 40),
(202, 2, 15, 1, 4, 7),
(203, 2, 15, 2, 4, 49),
(204, 2, 15, 3, 4, 23),
(205, 2, 9, 1, 1, 5),
(206, 2, 9, 2, 1, 52),
(207, 2, 9, 3, 1, 65),
(208, 2, 9, 1, 2, 108),
(209, 2, 9, 2, 2, 111),
(210, 2, 9, 3, 2, 26),
(211, 2, 9, 1, 3, 74),
(212, 2, 9, 2, 3, 82),
(213, 2, 9, 3, 3, 113),
(214, 2, 9, 1, 4, 48),
(215, 2, 9, 2, 4, 34),
(216, 2, 9, 3, 4, 38),
(217, 2, 10, 1, 1, 83),
(218, 2, 10, 2, 1, 44),
(219, 2, 10, 3, 1, 27),
(220, 2, 10, 1, 2, 38),
(221, 2, 10, 2, 2, 15),
(222, 2, 10, 3, 2, 65),
(223, 2, 10, 1, 3, 98),
(224, 2, 10, 2, 3, 46),
(225, 2, 10, 3, 3, 52),
(226, 2, 10, 1, 4, 91),
(227, 2, 10, 2, 4, 13),
(228, 2, 10, 3, 4, 53),
(229, 2, 11, 1, 1, 88),
(230, 2, 11, 2, 1, 88),
(231, 2, 11, 3, 1, 100),
(232, 2, 11, 1, 2, 10),
(233, 2, 11, 2, 2, 85),
(234, 2, 11, 3, 2, 107),
(235, 2, 11, 1, 3, 83),
(236, 2, 11, 2, 3, 72),
(237, 2, 11, 3, 3, 81),
(238, 2, 11, 1, 4, 56),
(239, 2, 11, 2, 4, 6),
(240, 2, 11, 3, 4, 118),
(241, 2, 12, 1, 1, 14),
(242, 2, 12, 2, 1, 58),
(243, 2, 12, 3, 1, 48),
(244, 2, 12, 1, 2, 115),
(245, 2, 12, 2, 2, 83),
(246, 2, 12, 3, 2, 85),
(247, 2, 12, 1, 3, 83),
(248, 2, 12, 2, 3, 47),
(249, 2, 12, 3, 3, 45),
(250, 2, 12, 1, 4, 23),
(251, 2, 12, 2, 4, 101),
(252, 2, 12, 3, 4, 100),
(253, 2, 13, 1, 1, 40),
(254, 2, 13, 2, 1, 80),
(255, 2, 13, 3, 1, 15),
(256, 2, 13, 1, 2, 27),
(257, 2, 13, 2, 2, 54),
(258, 2, 13, 3, 2, 11),
(259, 2, 13, 1, 3, 83),
(260, 2, 13, 2, 3, 48),
(261, 2, 13, 3, 3, 74),
(262, 2, 13, 1, 4, 19),
(263, 2, 13, 2, 4, 97),
(264, 2, 13, 3, 4, 60),
(265, 2, 14, 1, 1, 83),
(266, 2, 14, 2, 1, 49),
(267, 2, 14, 3, 1, 38),
(268, 2, 14, 1, 2, 73),
(269, 2, 14, 2, 2, 79),
(270, 2, 14, 3, 2, 9),
(271, 2, 14, 1, 3, 55),
(272, 2, 14, 2, 3, 62),
(273, 2, 14, 3, 3, 50),
(274, 2, 14, 1, 4, 85),
(275, 2, 14, 2, 4, 68),
(276, 2, 14, 3, 4, 119),
(277, 3, 36, 1, 1, 23),
(278, 3, 36, 2, 1, 92),
(279, 3, 36, 3, 1, 108),
(280, 3, 36, 1, 2, 109),
(281, 3, 36, 2, 2, 14),
(282, 3, 36, 3, 2, 78),
(283, 3, 36, 1, 3, 96),
(284, 3, 36, 2, 3, 52),
(285, 3, 36, 3, 3, 30),
(286, 3, 36, 1, 4, 19),
(287, 3, 36, 2, 4, 87),
(288, 3, 36, 3, 4, 52),
(289, 3, 35, 1, 1, 114),
(290, 3, 35, 2, 1, 57),
(291, 3, 35, 3, 1, 17),
(292, 3, 35, 1, 2, 57),
(293, 3, 35, 2, 2, 85),
(294, 3, 35, 3, 2, 115),
(295, 3, 35, 1, 3, 115),
(296, 3, 35, 2, 3, 114),
(297, 3, 35, 3, 3, 86),
(298, 3, 35, 1, 4, 7),
(299, 3, 35, 2, 4, 7),
(300, 3, 35, 3, 4, 49),
(301, 3, 34, 1, 1, 69),
(302, 3, 34, 2, 1, 34),
(303, 3, 34, 3, 1, 78),
(304, 3, 34, 1, 2, 21),
(305, 3, 34, 2, 2, 18),
(306, 3, 34, 3, 2, 41),
(307, 3, 34, 1, 3, 119),
(308, 3, 34, 2, 3, 7),
(309, 3, 34, 3, 3, 40),
(310, 3, 34, 1, 4, 87),
(311, 3, 34, 2, 4, 31),
(312, 3, 34, 3, 4, 5),
(313, 3, 33, 1, 1, 53),
(314, 3, 33, 2, 1, 46),
(315, 3, 33, 3, 1, 118),
(316, 3, 33, 1, 2, 98),
(317, 3, 33, 2, 2, 54),
(318, 3, 33, 3, 2, 45),
(319, 3, 33, 1, 3, 96),
(320, 3, 33, 2, 3, 16),
(321, 3, 33, 3, 3, 31),
(322, 3, 33, 1, 4, 92),
(323, 3, 33, 2, 4, 29),
(324, 3, 33, 3, 4, 93),
(325, 3, 32, 1, 1, 51),
(326, 3, 32, 2, 1, 54),
(327, 3, 32, 3, 1, 25),
(328, 3, 32, 1, 2, 78),
(329, 3, 32, 2, 2, 44),
(330, 3, 32, 3, 2, 83),
(331, 3, 32, 1, 3, 76),
(332, 3, 32, 2, 3, 24),
(333, 3, 32, 3, 3, 25),
(334, 3, 32, 1, 4, 103),
(335, 3, 32, 2, 4, 46),
(336, 3, 32, 3, 4, 69),
(337, 3, 31, 1, 1, 7),
(338, 3, 31, 2, 1, 114),
(339, 3, 31, 3, 1, 53),
(340, 3, 31, 1, 2, 108),
(341, 3, 31, 2, 2, 38),
(342, 3, 31, 3, 2, 11),
(343, 3, 31, 1, 3, 64),
(344, 3, 31, 2, 3, 34),
(345, 3, 31, 3, 3, 115),
(346, 3, 31, 1, 4, 117),
(347, 3, 31, 2, 4, 111),
(348, 3, 31, 3, 4, 87),
(349, 3, 30, 1, 1, 33),
(350, 3, 30, 2, 1, 62),
(351, 3, 30, 3, 1, 113),
(352, 3, 30, 1, 2, 99),
(353, 3, 30, 2, 2, 41),
(354, 3, 30, 3, 2, 21),
(355, 3, 30, 1, 3, 67),
(356, 3, 30, 2, 3, 42),
(357, 3, 30, 3, 3, 109),
(358, 3, 30, 1, 4, 42),
(359, 3, 30, 2, 4, 108),
(360, 3, 30, 3, 4, 90),
(361, 3, 29, 1, 1, 64),
(362, 3, 29, 2, 1, 73),
(363, 3, 29, 3, 1, 75),
(364, 3, 29, 1, 2, 84),
(365, 3, 29, 2, 2, 80),
(366, 3, 29, 3, 2, 88),
(367, 3, 29, 1, 3, 47),
(368, 3, 29, 2, 3, 115),
(369, 3, 29, 3, 3, 47),
(370, 3, 29, 1, 4, 63),
(371, 3, 29, 2, 4, 120),
(372, 3, 29, 3, 4, 7),
(373, 3, 24, 1, 1, 65),
(374, 3, 24, 2, 1, 67),
(375, 3, 24, 3, 1, 92),
(376, 3, 24, 1, 2, 118),
(377, 3, 24, 2, 2, 25),
(378, 3, 24, 3, 2, 75),
(379, 3, 24, 1, 3, 96),
(380, 3, 24, 2, 3, 60),
(381, 3, 24, 3, 3, 109),
(382, 3, 24, 1, 4, 120),
(383, 3, 24, 2, 4, 50),
(384, 3, 24, 3, 4, 108),
(397, 3, 26, 1, 1, 28),
(398, 3, 26, 2, 1, 9),
(399, 3, 26, 3, 1, 38),
(400, 3, 26, 1, 2, 12),
(401, 3, 26, 2, 2, 10),
(402, 3, 26, 3, 2, 70),
(403, 3, 26, 1, 3, 57),
(404, 3, 26, 2, 3, 102),
(405, 3, 26, 3, 3, 34),
(406, 3, 26, 1, 4, 30),
(407, 3, 26, 2, 4, 106),
(408, 3, 26, 3, 4, 25),
(409, 3, 27, 1, 1, 32),
(410, 3, 27, 2, 1, 94),
(411, 3, 27, 3, 1, 62),
(412, 3, 27, 1, 2, 23),
(413, 3, 27, 2, 2, 21),
(414, 3, 27, 3, 2, 42),
(415, 3, 27, 1, 3, 106),
(416, 3, 27, 2, 3, 77),
(417, 3, 27, 3, 3, 116),
(418, 3, 27, 1, 4, 57),
(419, 3, 27, 2, 4, 56),
(420, 3, 27, 3, 4, 38),
(421, 3, 28, 1, 1, 6),
(422, 3, 28, 2, 1, 85),
(423, 3, 28, 3, 1, 92),
(424, 3, 28, 1, 2, 94),
(425, 3, 28, 2, 2, 82),
(426, 3, 28, 3, 2, 40),
(427, 3, 28, 1, 3, 70),
(428, 3, 28, 2, 3, 95),
(429, 3, 28, 3, 3, 119),
(430, 3, 28, 1, 4, 25),
(431, 3, 28, 2, 4, 40),
(432, 3, 28, 3, 4, 54),
(433, 4, 45, 1, 1, 48),
(434, 4, 45, 2, 1, 79),
(435, 4, 45, 3, 1, 95),
(436, 4, 45, 1, 2, 120),
(437, 4, 45, 2, 2, 98),
(438, 4, 45, 3, 2, 33),
(439, 4, 45, 1, 3, 45),
(440, 4, 45, 2, 3, 42),
(441, 4, 45, 3, 3, 29),
(442, 4, 45, 1, 4, 102),
(443, 4, 45, 2, 4, 52),
(444, 4, 45, 3, 4, 20),
(445, 4, 44, 1, 1, 82),
(446, 4, 44, 2, 1, 68),
(447, 4, 44, 3, 1, 72),
(448, 4, 44, 1, 2, 65),
(449, 4, 44, 2, 2, 26),
(450, 4, 44, 3, 2, 114),
(451, 4, 44, 1, 3, 34),
(452, 4, 44, 2, 3, 33),
(453, 4, 44, 3, 3, 92),
(454, 4, 44, 1, 4, 86),
(455, 4, 44, 2, 4, 70),
(456, 4, 44, 3, 4, 13),
(457, 4, 43, 1, 1, 110),
(458, 4, 43, 2, 1, 29),
(459, 4, 43, 3, 1, 47),
(460, 4, 43, 1, 2, 94),
(461, 4, 43, 2, 2, 84),
(462, 4, 43, 3, 2, 5),
(463, 4, 43, 1, 3, 107),
(464, 4, 43, 2, 3, 112),
(465, 4, 43, 3, 3, 78),
(466, 4, 43, 1, 4, 66),
(467, 4, 43, 2, 4, 111),
(468, 4, 43, 3, 4, 10),
(469, 4, 42, 1, 1, 67),
(470, 4, 42, 2, 1, 6),
(471, 4, 42, 3, 1, 27),
(472, 4, 42, 1, 2, 117),
(473, 4, 42, 2, 2, 11),
(474, 4, 42, 3, 2, 46),
(475, 4, 42, 1, 3, 73),
(476, 4, 42, 2, 3, 87),
(477, 4, 42, 3, 3, 35),
(478, 4, 42, 1, 4, 88),
(479, 4, 42, 2, 4, 109),
(480, 4, 42, 3, 4, 81),
(481, 4, 41, 1, 1, 34),
(482, 4, 41, 2, 1, 39),
(483, 4, 41, 3, 1, 79),
(484, 4, 41, 1, 2, 75),
(485, 4, 41, 2, 2, 117),
(486, 4, 41, 3, 2, 102),
(487, 4, 41, 1, 3, 100),
(488, 4, 41, 2, 3, 93),
(489, 4, 41, 3, 3, 73),
(490, 4, 41, 1, 4, 87),
(491, 4, 41, 2, 4, 6),
(492, 4, 41, 3, 4, 91),
(493, 4, 40, 1, 1, 91),
(494, 4, 40, 2, 1, 68),
(495, 4, 40, 3, 1, 27),
(496, 4, 40, 1, 2, 106),
(497, 4, 40, 2, 2, 112),
(498, 4, 40, 3, 2, 79),
(499, 4, 40, 1, 3, 32),
(500, 4, 40, 2, 3, 102),
(501, 4, 40, 3, 3, 92),
(502, 4, 40, 1, 4, 70),
(503, 4, 40, 2, 4, 94),
(504, 4, 40, 3, 4, 53),
(505, 4, 39, 1, 1, 45),
(506, 4, 39, 2, 1, 41),
(507, 4, 39, 3, 1, 15),
(508, 4, 39, 1, 2, 110),
(509, 4, 39, 2, 2, 89),
(510, 4, 39, 3, 2, 69),
(511, 4, 39, 1, 3, 19),
(512, 4, 39, 2, 3, 69),
(513, 4, 39, 3, 3, 104),
(514, 4, 39, 1, 4, 88),
(515, 4, 39, 2, 4, 102),
(516, 4, 39, 3, 4, 53),
(517, 4, 38, 1, 1, 34),
(518, 4, 38, 2, 1, 101),
(519, 4, 38, 3, 1, 6),
(520, 4, 38, 1, 2, 92),
(521, 4, 38, 2, 2, 94),
(522, 4, 38, 3, 2, 56),
(523, 4, 38, 1, 3, 18),
(524, 4, 38, 2, 3, 15),
(525, 4, 38, 3, 3, 39),
(526, 4, 38, 1, 4, 38),
(527, 4, 38, 2, 4, 52),
(528, 4, 38, 3, 4, 85),
(529, 4, 37, 1, 1, 65),
(530, 4, 37, 2, 1, 104),
(531, 4, 37, 3, 1, 97),
(532, 4, 37, 1, 2, 116),
(533, 4, 37, 2, 2, 46),
(534, 4, 37, 3, 2, 47),
(535, 4, 37, 1, 3, 75),
(536, 4, 37, 2, 3, 5),
(537, 4, 37, 3, 3, 116),
(538, 4, 37, 1, 4, 102),
(539, 4, 37, 2, 4, 43),
(540, 4, 37, 3, 4, 52),
(541, 4, 46, 1, 1, 88),
(542, 4, 46, 2, 1, 85),
(543, 4, 46, 3, 1, 112),
(544, 4, 46, 1, 2, 70),
(545, 4, 46, 2, 2, 40),
(546, 4, 46, 3, 2, 21),
(547, 4, 46, 1, 3, 103),
(548, 4, 46, 2, 3, 102),
(549, 4, 46, 3, 3, 38),
(550, 4, 46, 1, 4, 7),
(551, 4, 46, 2, 4, 61),
(552, 4, 46, 3, 4, 114);

-- --------------------------------------------------------

--
-- Table structure for table `pizza_types`
--

CREATE TABLE `pizza_types` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `image` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizza_types`
--

INSERT INTO `pizza_types` (`id`, `category`, `image`, `description`, `type`) VALUES
(1, 1, '1.jpg', 'A classic delight with 100% Real mozzarella cheese', 'Margherita'),
(2, 1, '2.jpg', 'Delightful combination of onion, capsicum, tomato & grilled mushroom', 'Farmhouse'),
(3, 1, '3.jpg', 'Flavorful trio of juicy paneer, crisp capsicum with spicy red paprika', 'Peppy Paneer'),
(4, 1, '4.jpg', 'Black olives, capsicum, onion, grilled mushroom, corn, tomato, jalapeno & extra cheese', 'Veg Extravaganza'),
(5, 1, '5.jpg', 'The awesome foursome! Golden corn, black olives, capsicum, red paprika', 'Veggie Paradise'),
(6, 1, '6.jpg', 'Sweet & Juicy Golden corn and 100% real mozzarella cheese in a delectable combination !', 'Cheese n Corn'),
(7, 1, '7.jpg', 'Pepper barbecue chicken for that extra zing', 'Pepper Barbecue Chicken'),
(8, 1, '8.jpg', 'American classic! Spicy, herbed chicken sausage on pizza', 'Chicken Sausage'),
(9, 2, '1.jpg', 'A classic delight with 100% Real mozzarella cheese', 'Margherita'),
(10, 2, '1.jpg', 'A classic delight loaded with extra 100% real mozzarella cheese', 'Double Cheese Margherita'),
(11, 2, '2.jpg', 'Delightful combination of onion, capsicum, tomato & grilled mushroom', 'Farmhouse'),
(12, 2, '3.jpg', 'Flavorful trio of juicy paneer, crisp capsicum with spicy red paprika', 'Peppy Paneer'),
(13, 2, '10.jpg', 'Mexican herbs sprinkled on onion, capsicum, tomato & jalapeno', 'Mexican Green Wave'),
(14, 2, '9.jpg', 'Veg delight - onion, capsicum, grilled mushroom, corn & paneer', 'Deluxe Veggie'),
(15, 2, '4.jpg', 'Flavorful trio of juicy paneer, crisp capsicum with spicy red paprika', 'Veg Extravaganza'),
(16, 2, '11.jpg', 'The awesome foursome! Golden corn, black olives, capsicum, red paprika', 'Veggie Paradise'),
(17, 2, '12.jpg', 'Sweet & Juicy Golden corn and 100% real mozzarella cheese in a delectable combination !', 'Cheese n Corn'),
(18, 2, '13.jpg', 'Delectable combination of onion & capsicum, a veggie lovers pick', 'Fresh Veggie\r\n'),
(19, 2, '14.jpg', 'Flavorful twist of spicy makhani sauce topped with paneer & capsicum', 'Paneer Makhani'),
(20, 2, '15.jpg', 'It is hot. It is spicy. It is oh-so-Indian. Tandoori paneer with capsicum, red paprika & mint mayo', 'Indi Tandoori Paneer'),
(21, 2, '16.jpg', 'A delectable combination of cheese and juicy tomato', 'Cheese n Tomato'),
(22, 2, '13.jpg', 'Loaded with a delicious creamy tomato pasta topping , green capsicum, crunchy red and yellow bell peppers', 'Creamy Tomato Pasta Pizza - Veg'),
(23, 2, '14.jpg', 'A pizza loaded with a spicy combination of Harissa sauce and delicious pasta.', 'Moroccan Spice Pasta Pizza - Veg\r\n'),
(24, 3, '12.jpg', 'Loaded with a delicious creamy tomato pasta topping, BBQ pepper chicken, green capsicum, crunchy red', 'Creamy Tomato Pasta Pizza - Non Veg'),
(26, 3, '14.jpg', 'A pizza loaded with a spicy combination of Harissa sauce, Peri Peri chicken chunks and delicious pasta.', 'Moroccan Spice Pasta Pizza - Non Veg'),
(27, 3, '19.jpg', 'Double pepper barbecue chicken, golden corn and extra cheese, true delight', 'Chicken Golden Delight'),
(28, 3, '18.jpg', 'Supreme combination of black olives, onion, capsicum, grilled mushroom, pepper barbecue chicken', 'Non Veg Supreme'),
(29, 3, '17.jpg', 'A classic American taste! Relish the delectable flavor of Chicken Pepperoni, topped with extra cheese', 'Chicken Pepperoni'),
(30, 3, '20.jpg', 'Grilled chicken rashers, peri-peri chicken, onion & capsicum, a complete fiest', 'Chicken Fiesta'),
(31, 3, '22.jpg', 'Loaded with double pepper barbecue chicken, peri-peri chicken, chicken tikka & grilled chicken rashers', 'Chicken Dominator'),
(32, 3, '21.jpg', 'Pepper barbecue chicken for that extra zing', 'Pepper Barbecue Chicken'),
(33, 3, '23.jpg', 'American classic! Spicy, herbed chicken sausage on pizza', 'Chicken Sausage'),
(34, 3, '24.jpg', 'A classic favourite with pepper barbeque chicken and onion', 'Pepper Barbecue & Onion'),
(35, 3, '25.jpg', 'The wholesome flavour of tandoori masala with Chicken tikka, onion, red paprika & mint mayo', 'Indi Chicken Tikka'),
(36, 3, '26.jpg', 'Delicious minced chicken keema topped with crunchy onions on your favourite cheesy pizza', 'Keema Do Pyaza'),
(37, 4, '27.jpg', 'Chicken sausage, pepper barbecue chicken & peri-peri chicken in a fresh pan crust', 'Non Veg Loaded'),
(38, 4, '28.jpg', 'Tomato, Jalapeno, Corn, Grilled Mushroom & crushed Aranchini Patty in a fresh pan crust', 'Veg Loaded'),
(39, 4, '29.jpg', 'Pepper barbecue chicken for that extra zing', 'Pepper Barbecue Chicken'),
(40, 4, '30.jpg', 'Cheese lovers paradise, loaded with mozzarella, cheddar & gouda cheese', 'Cheesy'),
(41, 4, '31.jpg', 'Creamy Paneer & Onion', 'Paneer & Onion'),
(42, 4, '32.jpg', 'American classic! Spicy, herbed chicken sausage on pizza', 'Chicken Sausage'),
(43, 4, '33.jpg', 'Sweet & juicy golden corn for that lipsmacking taste', 'Golden Corn'),
(44, 4, '34.jpg', 'Fresh & crisp capsicum for the perfect crunch in pizza', 'Capsicum'),
(45, 4, '35.jpg', 'Crunchy onion on a cheesy base. The pizza mania classic', 'Onion'),
(46, 4, '36.jpg', 'Juicy tomato in a flavourful combination with cheese & tangy sauce', 'Tomato');

-- --------------------------------------------------------

--
-- Table structure for table `sandwitches`
--

CREATE TABLE `sandwitches` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sandwitches`
--

INSERT INTO `sandwitches` (`id`, `name`, `image`, `price`) VALUES
(1, 'Crispy Chicken Sandwich', '1.jpg', '14.30'),
(2, 'Spicy Crispy Chicken Sandwich', '2.jpg', '16.30'),
(3, 'Deluxe Crispy Chicken Sandwich', '3.jpg', '15.30'),
(4, 'Chicken McNuggets', '4.jpg', '12.30'),
(5, 'Filet-O-Fish', '5.jpg', '18.30');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size`) VALUES
(1, 'Regular'),
(2, 'Medium'),
(3, 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `last_logged_in` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `mobile`, `email`, `password`, `timestamp`, `userid`, `last_logged_in`) VALUES
(1, 'kiran', 'Kiran', 'Tirumalasetti', '7097081191', 'kirantirumalasette@gmail.com', 'ceb6c970658f31504a901b89dcd3e461', '1619148093', 'USR00001', '1619148092'),
(3, 'dhitendra', 'dhitendra', 'reddy', '9440309448', 'reddy.dhitendra@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '1619419255', 'USR0002', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beverages`
--
ALTER TABLE `beverages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `burgers`
--
ALTER TABLE `burgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`,`item_name`,`user_id`) USING BTREE;

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crust`
--
ALTER TABLE `crust`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizza_prices`
--
ALTER TABLE `pizza_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizza_types`
--
ALTER TABLE `pizza_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sandwitches`
--
ALTER TABLE `sandwitches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beverages`
--
ALTER TABLE `beverages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `burgers`
--
ALTER TABLE `burgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `crust`
--
ALTER TABLE `crust`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pizza_prices`
--
ALTER TABLE `pizza_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;

--
-- AUTO_INCREMENT for table `pizza_types`
--
ALTER TABLE `pizza_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `sandwitches`
--
ALTER TABLE `sandwitches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
