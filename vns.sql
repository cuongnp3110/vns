-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2022 at 11:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vns`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `password` varchar(35) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `addr` varchar(150) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `avt` varchar(100) NOT NULL,
  `open_day` date NOT NULL DEFAULT current_timestamp(),
  `duration` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `password`, `fname`, `addr`, `phone`, `email`, `avt`, `open_day`, `duration`, `state`) VALUES
(1, '7bf0e11fbf4453dc63dbf68ba48faa48', 'Nguyễn Phú Cường', 'Cần Thơ', '0916555771', 'cuongnp3110@gmail.com', 'rx78.jpg', '2022-03-08', 380, 2),
(4, '21232f297a57a5a743894a0e4a801fc3', '123', '', '', 'admin@gmail.com', '47268854_1153655891470223_4650032534418096128_n.jpg', '2022-02-08', 10, 1),
(5, '287684929f8615eb67028c598d70b4f5', 'PC', '', '', 'cuongnp@gmail.com', '', '2022-03-08', 365, 2),
(23, 'c4ca4238a0b923820dcc509a6f75849b', '123123123', '', '', '123123123@gmail.com', '', '2022-01-04', 30, 2),
(27, 'ff2d7c29f744aeb2f107302bf7a115f7', 'Âu Quỳnh Như', '', '', 'nhu1412@gmail.com', '', '2022-03-20', 30, 2),
(28, 'c4ca4238a0b923820dcc509a6f75849b', 'test1234', '', '', 'test@gmail.com', '', '2022-04-05', 40, 2),
(31, '25d55ad283aa400af464c76d713c07ad', '', '', '', 'nhokcuong747@gmail.com', '', '2022-04-06', 0, 2),
(32, '43ef63b23b5ddbd8dc0b2805da15aca0', '', '', '', 'cctn@gmail.com', '', '2022-04-12', 365, 2),
(33, '25d55ad283aa400af464c76d713c07ad', '', '', '', 'nhokcuong474@gmail.com', '', '2022-04-12', 10, 2),
(34, '25d55ad283aa400af464c76d713c07ad', '', '', '', 'kiennhgcc18158@fpt.edu.vn', '', '2022-04-13', 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bot_data`
--

CREATE TABLE `bot_data` (
  `data_id` int(11) NOT NULL,
  `raw_data` varchar(200) NOT NULL,
  `time` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bot_data`
--

INSERT INTO `bot_data` (`data_id`, `raw_data`, `time`, `account_id`) VALUES
(8, '123', '2022-04-09 14:26:53', 1),
(10, 'what isup', '2022-04-09 14:38:34', 4),
(11, 'alo', '2022-04-13 11:16:42', 4),
(12, 'product image', '2022-04-15 10:41:27', 4);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `account_id`) VALUES
(3, 'Honda', 1),
(4, 'Yamaha', 1),
(5, 'Suzuki', 1),
(6, 'BMX', 1),
(20, 'Hino', 1),
(21, 'Vinfast', 1),
(23, 'Hồng đức 123', 27),
(30, 'Jjij', 27),
(39, '5thewack', 32);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `account_id`) VALUES
(6, 'Car', 1),
(7, 'Motobike', 1),
(35, 'Bikecycle', 1),
(55, 'Truck', 1),
(56, 'Van', 1),
(57, 'Bus', 1),
(58, 'E1', 27),
(60, 'Xe Máy', 27),
(62, 'Xe Hơi', 27),
(67, 'Xe Máyjb', 27),
(79, 'Sextoy', 32);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `addr` varchar(150) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `purchased` double(12,0) NOT NULL,
  `debt` double(12,0) NOT NULL,
  `membership` int(11) NOT NULL,
  `describe` varchar(200) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `addr`, `phone`, `email`, `purchased`, `debt`, `membership`, `describe`, `account_id`) VALUES
(1, 'Nguyễn Phú Cường', '', '0916511597', 'c110@gmail.com', 51500000000, 400000000, 1, 'khách hàng thân thiết', 1),
(2, 'Quỳnh Như', '', '0916514778', '', 7900000000, 0, 0, 'Xinh đẹp', 1),
(24, 'Passerby', 'Empty', '0', 'Empty', 2800000000, 0, 0, 'Empty', 1),
(29, 'Passerby', 'Empty', '0', 'Empty', 0, 0, 0, 'Empty', 31),
(30, 'Passerby', 'Empty', '0', 'Empty', 0, 0, 0, 'Empty', 32),
(31, 'Passerby', 'Empty', '0', 'Empty', 0, 0, 0, 'Empty', 33),
(32, 'Passerby', 'Empty', '0', 'Empty', 0, 0, 0, 'Empty', 34);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_ex`
--

CREATE TABLE `invoice_ex` (
  `invoice_ex_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `discount` double(12,0) NOT NULL,
  `subtotal` double(12,0) NOT NULL,
  `total` double(12,0) NOT NULL,
  `payment` double(12,0) NOT NULL,
  `note` varchar(500) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_ex`
--

INSERT INTO `invoice_ex` (`invoice_ex_id`, `customer_id`, `discount`, `subtotal`, `total`, `payment`, `note`, `time`, `account_id`) VALUES
(35, 1, 0, 4200000000, 4200000000, 4200000000, '', '2022-04-11 13:50:49', 1),
(36, 24, 0, 2800000000, 2800000000, 2800000000, '', '2021-06-15 13:57:23', 1),
(37, 1, 0, 3000000000, 3000000000, 3000000000, '', '2021-05-11 13:58:52', 1),
(38, 2, 0, 7900000000, 7900000000, 7900000000, '', '2021-07-13 13:59:24', 1),
(39, 1, 0, 2400000000, 2400000000, 2400000000, '', '2022-01-03 14:46:24', 1),
(40, 1, 0, 2100000000, 2100000000, 2100000000, '', '2022-02-07 14:46:41', 1),
(41, 1, 0, 1200000000, 1200000000, 1200000000, '', '2022-03-07 14:46:55', 1),
(42, 1, 0, 600000000, 600000000, 600000000, '', '2021-08-09 14:47:12', 1),
(43, 1, 0, 600000000, 600000000, 600000000, '', '2021-09-08 14:47:25', 1),
(44, 1, 0, 500000000, 500000000, 500000000, '', '2021-10-18 14:47:38', 1),
(45, 1, 0, 2100000000, 2100000000, 2100000000, '', '2021-11-16 14:47:51', 1),
(46, 1, 0, 800000000, 800000000, 800000000, '', '2021-09-01 14:49:42', 1),
(47, 1, 0, 800000000, 800000000, 400000000, '', '2022-04-12 18:08:32', 1),
(48, 1, 0, 33200000000, 33200000000, 33200000000, 'big deal', '2022-04-13 14:22:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_ex_item`
--

CREATE TABLE `invoice_ex_item` (
  `invoice_ex_item_id` int(11) NOT NULL,
  `invoice_ex_id` int(11) NOT NULL,
  `product_code` varchar(15) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(12,0) NOT NULL,
  `total` double(12,0) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_ex_item`
--

INSERT INTO `invoice_ex_item` (`invoice_ex_item_id`, `invoice_ex_id`, `product_code`, `product_name`, `quantity`, `price`, `total`, `time`, `account_id`) VALUES
(75, 35, 'R1M2020', 'YZF R1M Edition 2020', 2, 600000000, 1200000000, '2022-04-11 13:50:50', 1),
(76, 35, 'CRVRSHD', 'CRV RS 2022', 2, 700000000, 1400000000, '2022-04-11 13:50:50', 1),
(77, 35, 'H500SFLCTHN', 'Hino 500 Series FL8JW7A Cargo Truck 2022', 2, 800000000, 1600000000, '2022-04-11 13:50:50', 1),
(78, 36, 'CIVRSHD', 'Civic RS 1.5 Turbo 2022', 2, 800000000, 1600000000, '2022-04-11 13:57:23', 1),
(79, 36, 'R1M2020', 'YZF R1M Edition 2020', 2, 600000000, 1200000000, '2022-04-11 13:57:23', 1),
(80, 37, 'CRB1RRHD', 'CBR1000rr', 2, 700000000, 1400000000, '2022-04-11 13:58:52', 1),
(81, 37, 'CIVRSHD', 'Civic RS 1.5 Turbo 2022', 2, 800000000, 1600000000, '2022-04-11 13:58:52', 1),
(82, 38, 'R1M2020', 'YZF R1M Edition 2020', 1, 600000000, 600000000, '2022-04-11 13:59:24', 1),
(83, 38, 'CRB1RRHD', 'CBR1000rr', 2, 700000000, 1400000000, '2022-04-11 13:59:24', 1),
(84, 38, 'VBVB', 'Vin Bus 2022', 3, 500000000, 1500000000, '2022-04-11 13:59:24', 1),
(85, 38, 'CTRSHD', 'City RS 2022', 4, 600000000, 2400000000, '2022-04-11 13:59:25', 1),
(86, 38, 'YZFR6YMH', 'YZF R6 2020', 5, 400000000, 2000000000, '2022-04-11 13:59:25', 1),
(87, 39, 'CIVRSHD', 'Civic RS 1.5 Turbo 2022', 3, 800000000, 2400000000, '2022-04-11 14:46:24', 1),
(88, 40, 'CRB1RRHD', 'CBR1000rr', 3, 700000000, 2100000000, '2022-04-11 14:46:41', 1),
(89, 41, 'CTRSHD', 'City RS 2022', 2, 600000000, 1200000000, '2022-04-11 14:46:55', 1),
(90, 42, 'TAHD', 'Twin Africa 2021', 2, 300000000, 600000000, '2022-04-11 14:47:12', 1),
(91, 43, 'CTRSHD', 'City RS 2022', 1, 600000000, 600000000, '2022-04-11 14:47:25', 1),
(92, 44, 'VBVB', 'Vin Bus 2022', 1, 500000000, 500000000, '2022-04-11 14:47:38', 1),
(93, 45, 'CRVRSHD', 'CRV RS 2022', 3, 700000000, 2100000000, '2022-04-11 14:47:51', 1),
(94, 46, 'H500SFLCTHN', 'Hino 500 Series FL8JW7A Cargo Truck 2022', 1, 800000000, 800000000, '2022-04-11 14:48:21', 1),
(95, 47, 'CIVRSHD', 'Civic RS 1.5 Turbo 2022', 1, 800000000, 800000000, '2022-04-12 18:08:32', 1),
(96, 48, 'CIVRSHD', 'Civic RS 1.5 Turbo 2022', 10, 800000000, 8000000000, '2022-04-13 14:22:54', 1),
(97, 48, 'R1M2020', 'YZF R1M Edition 2020', 9, 600000000, 5400000000, '2022-04-13 14:22:55', 1),
(98, 48, 'CRB1RRHD', 'CBR1000rr', 8, 700000000, 5600000000, '2022-04-13 14:22:55', 1),
(99, 48, 'CRVRSHD', 'CRV RS 2022', 7, 700000000, 4900000000, '2022-04-13 14:22:55', 1),
(100, 48, 'YZFR6YMH', 'YZF R6 2020', 6, 400000000, 2400000000, '2022-04-13 14:22:55', 1),
(101, 48, 'CTRSHD', 'City RS 2022', 5, 600000000, 3000000000, '2022-04-13 14:22:55', 1),
(102, 48, 'TAHD', 'Twin Africa 2021', 4, 300000000, 1200000000, '2022-04-13 14:22:55', 1),
(103, 48, 'GTLP16BMX', 'GT Lil Performer 16', 3, 300000000, 900000000, '2022-04-13 14:22:55', 1),
(104, 48, 'VBVB', 'Vin Bus 2022', 2, 500000000, 1000000000, '2022-04-13 14:22:55', 1),
(105, 48, 'H500SFLCTHN', 'Hino 500 Series FL8JW7A Cargo Truck 2022', 1, 800000000, 800000000, '2022-04-13 14:22:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_im`
--

CREATE TABLE `invoice_im` (
  `invoice_im_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `discount` double(12,0) NOT NULL,
  `subtotal` double(12,0) NOT NULL,
  `total` double(12,0) NOT NULL,
  `payment` double(12,0) NOT NULL,
  `note` varchar(500) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_im`
--

INSERT INTO `invoice_im` (`invoice_im_id`, `supplier_id`, `discount`, `subtotal`, `total`, `payment`, `note`, `time`, `account_id`) VALUES
(61, 9, 0, 1600000000, 1600000000, 1600000000, '', '2022-04-12 18:07:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_im_item`
--

CREATE TABLE `invoice_im_item` (
  `invoice_im_item_id` int(11) NOT NULL,
  `invoice_im_id` int(11) NOT NULL,
  `product_code` varchar(15) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(12,0) NOT NULL,
  `total` double(12,0) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_im_item`
--

INSERT INTO `invoice_im_item` (`invoice_im_item_id`, `invoice_im_id`, `product_code`, `product_name`, `quantity`, `price`, `total`, `account_id`) VALUES
(125, 61, 'CIVRSHD', 'Civic RS 1.5 Turbo 2022', 2, 800000000, 1600000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `log` varchar(150) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `log`, `log_time`, `account_id`) VALUES
(27, 'By cuongnp3110@gmail.com | Customer Edit: 1232', '2022-03-24 04:36:15', 1),
(28, 'By cuongnp3110@gmail.com | Customer Delete: 1232', '2022-03-24 04:36:19', 1),
(29, 'By cuongnp3110@gmail.com | Supplier Add: 123', '2022-03-24 04:37:39', 1),
(30, 'By cuongnp3110@gmail.com | Supplier Add: 1232', '2022-03-24 04:37:44', 1),
(31, 'By cuongnp3110@gmail.com | Supplier Delete: ', '2022-03-24 04:37:46', 1),
(32, 'By cuongnp3110@gmail.com | Supplier Delete: ', '2022-03-24 04:38:05', 1),
(33, 'By cuongnp3110@gmail.com | Supplier Add: 123', '2022-03-24 04:38:51', 1),
(34, 'By cuongnp3110@gmail.com | Supplier Delete: 123', '2022-03-24 04:38:54', 1),
(35, 'By cuongnp3110@gmail.com | Invoice Export Delete (Total Price): $1440000000', '2022-03-24 04:54:57', 1),
(36, 'By cuongnp3110@gmail.com | Invoice Export Delete (Total Price): $9000000000', '2022-03-24 04:54:59', 1),
(37, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $2520000000', '2022-03-29 11:40:40', 1),
(38, 'By cuongnp3110@gmail.com | Product Add: 1', '2022-03-29 11:42:04', 1),
(39, 'By cuongnp3110@gmail.com | Category Add: New Cat', '2022-03-29 11:42:04', 1),
(40, 'By cuongnp3110@gmail.com | Brand Add: New Brand', '2022-03-29 11:42:04', 1),
(41, 'By cuongnp3110@gmail.com | Product Delete: 1', '2022-03-29 11:42:32', 1),
(42, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $17820000000', '2022-03-31 18:05:53', 1),
(43, 'By cuongnp3110@gmail.com | Category Add: 123', '2022-04-01 10:20:48', 1),
(44, 'By cuongnp3110@gmail.com | Brand Add: 123', '2022-04-01 10:20:48', 1),
(45, 'By cuongnp3110@gmail.com | Invoice Export Delete (Total Price): $17820000000', '2022-04-03 10:25:22', 1),
(46, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $1600000000', '2022-04-04 18:20:53', 1),
(47, 'By cuongnp3110@gmail.com | Invoice Export Delete (Total Price): $2520000000', '2022-04-04 18:21:06', 1),
(48, 'By cuongnp3110@gmail.com | Invoice Export Delete (Total Price): $1600000000', '2022-04-04 18:21:17', 1),
(49, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $30240000000', '2022-04-04 18:23:06', 1),
(50, 'By cuongnp3110@gmail.com | Invoice Import Add (Total Price): $800000000', '2022-04-04 20:19:17', 1),
(51, 'By admin@gmail.com | Edit Profile', '2022-04-05 03:06:19', 4),
(52, 'By cuongnp3110@gmail.com | Customer Edit: Quỳnh Như', '2022-04-06 22:06:01', 1),
(53, 'By cuongnp3110@gmail.com | Customer Edit: Quỳnh Như', '2022-04-06 22:18:37', 1),
(54, 'By cuongnp3110@gmail.com | Customer Edit: Quỳnh Như', '2022-04-06 22:19:49', 1),
(55, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-07 19:29:21', 1),
(56, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-07 19:29:39', 1),
(57, 'By cuongnp3110@gmail.com | Invoice Import Add (Total Price): $1120000000', '2022-04-07 19:36:20', 1),
(58, 'By cuongnp3110@gmail.com | Category Delete: C', '2022-04-07 19:42:43', 1),
(59, 'By cuongnp3110@gmail.com | Category Delete: 123', '2022-04-07 19:42:47', 1),
(60, 'By cuongnp3110@gmail.com | Category Delete: New Cat', '2022-04-07 19:42:48', 1),
(61, 'By cuongnp3110@gmail.com | Brand Delete: B', '2022-04-07 19:42:51', 1),
(62, 'By cuongnp3110@gmail.com | Brand Delete: New Brand', '2022-04-07 19:42:53', 1),
(63, 'By cuongnp3110@gmail.com | Brand Delete: 123', '2022-04-07 19:42:55', 1),
(64, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $704000000', '2022-04-07 21:52:19', 1),
(65, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-07 22:05:26', 1),
(66, 'By cuongnp3110@gmail.com | Invoice Export Delete (Total Price): $30240000000', '2022-04-11 06:14:32', 1),
(67, 'By cuongnp3110@gmail.com | Invoice Export Delete (Total Price): $704000000', '2022-04-11 06:14:35', 1),
(68, 'By cuongnp3110@gmail.com | Invoice Import Delete (Total Price): $800000000', '2022-04-11 06:14:42', 1),
(69, 'By cuongnp3110@gmail.com | Invoice Import Delete (Total Price): $1120000000', '2022-04-11 06:14:44', 1),
(70, 'By cuongnp3110@gmail.com | Supplier Add: Honda', '2022-04-11 06:14:53', 1),
(71, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-11 06:21:36', 1),
(72, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-11 06:21:59', 1),
(73, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $4200000000', '2022-04-11 06:50:50', 1),
(74, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $2800000000', '2022-04-11 06:57:23', 1),
(75, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $3000000000', '2022-04-11 06:58:52', 1),
(76, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $7900000000', '2022-04-11 06:59:25', 1),
(77, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $2400000000', '2022-04-11 07:46:25', 1),
(78, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $2100000000', '2022-04-11 07:46:41', 1),
(79, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $1200000000', '2022-04-11 07:46:55', 1),
(80, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $600000000', '2022-04-11 07:47:12', 1),
(81, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $600000000', '2022-04-11 07:47:25', 1),
(82, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $500000000', '2022-04-11 07:47:38', 1),
(83, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $2100000000', '2022-04-11 07:47:51', 1),
(84, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $800000000', '2022-04-11 07:48:21', 1),
(85, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-11 20:36:52', 1),
(86, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-11 20:37:06', 1),
(87, 'By concactaone@gmail.com | Product Add: Cu Gia', '2022-04-11 23:52:25', 32),
(88, 'By concactaone@gmail.com | Category Add: Sextoy', '2022-04-11 23:52:25', 32),
(89, 'By concactaone@gmail.com | Brand Add: 5thewack', '2022-04-11 23:52:25', 32),
(90, 'By concactaone@gmail.com | Supplier Add: Nam', '2022-04-11 23:58:53', 32),
(91, 'By cuongnp3110@gmail.com | Category Add: 123', '2022-04-12 02:11:47', 1),
(92, 'By cuongnp3110@gmail.com | Brand Add: 123', '2022-04-12 02:11:47', 1),
(93, 'By cuongnp3110@gmail.com | Product Add: 12312', '2022-04-12 02:12:01', 1),
(94, 'By cuongnp3110@gmail.com | Product Add: 123121', '2022-04-12 02:13:04', 1),
(95, 'By cuongnp3110@gmail.com | Product Delete: 12312', '2022-04-12 02:13:17', 1),
(96, 'By cuongnp3110@gmail.com | Product Delete: 123121', '2022-04-12 02:13:25', 1),
(97, 'By cuongnp3110@gmail.com | Product Delete: ', '2022-04-12 02:13:30', 1),
(98, 'By cuongnp3110@gmail.com | Product Delete: 123', '2022-04-12 02:13:39', 1),
(99, 'By cuongnp3110@gmail.com | Product Add: 23', '2022-04-12 02:19:05', 1),
(100, 'By cuongnp3110@gmail.com | Category Add: 3', '2022-04-12 02:19:05', 1),
(101, 'By cuongnp3110@gmail.com | Brand Add: 2', '2022-04-12 02:19:05', 1),
(102, 'By cuongnp3110@gmail.com | Product Edit: 23', '2022-04-12 02:19:18', 1),
(103, 'By cuongnp3110@gmail.com | Product Edit: 23', '2022-04-12 02:19:34', 1),
(104, 'By cuongnp3110@gmail.com | Product Edit: 23', '2022-04-12 02:22:28', 1),
(105, 'By cuongnp3110@gmail.com | Product Delete: 23', '2022-04-12 02:22:40', 1),
(106, 'By cuongnp3110@gmail.com | Product Edit: CRV RS 2022', '2022-04-12 02:23:12', 1),
(107, 'By cuongnp3110@gmail.com | Product Edit: CRV RS 2022', '2022-04-12 02:23:23', 1),
(108, 'By cuongnp3110@gmail.com | Product Edit: CRV RS 2022', '2022-04-12 02:24:13', 1),
(109, 'By cuongnp3110@gmail.com | Product Edit: CRV RS 2022', '2022-04-12 02:24:24', 1),
(110, 'By cuongnp3110@gmail.com | Category Add: 1', '2022-04-12 02:47:05', 1),
(111, 'By cuongnp3110@gmail.com | Brand Add: 1', '2022-04-12 02:47:05', 1),
(112, 'By cuongnp3110@gmail.com | Invoice Import Add (Total Price): $1600000000', '2022-04-12 11:07:27', 1),
(113, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $800000000', '2022-04-12 11:08:32', 1),
(114, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-13 04:13:50', 1),
(115, 'By cuongnp3110@gmail.com | Edit Profile', '2022-04-13 04:14:06', 1),
(116, 'By cuongnp3110@gmail.com | Invoice Export Add (Total Price): $33200000000', '2022-04-13 07:22:55', 1),
(120, 'By cuongnp3110@gmail.com | Supplier Add: Yamaha', '2022-04-15 12:22:40', 1),
(121, 'By cuongnp3110@gmail.com | Supplier Add: Toyota', '2022-04-15 12:27:00', 1),
(122, 'By cuongnp3110@gmail.com | Category Delete: 1', '2022-04-15 12:33:51', 1),
(123, 'By cuongnp3110@gmail.com | Category Delete: 3', '2022-04-15 12:33:53', 1),
(124, 'By cuongnp3110@gmail.com | Category Delete: 123', '2022-04-15 12:33:55', 1),
(125, 'By cuongnp3110@gmail.com | Brand Delete: 1', '2022-04-15 12:33:58', 1),
(126, 'By cuongnp3110@gmail.com | Brand Delete: 2', '2022-04-15 12:34:00', 1),
(127, 'By cuongnp3110@gmail.com | Brand Delete: 123', '2022-04-15 12:34:02', 1),
(128, 'By cuongnp3110@gmail.com | Brand Delete: Ford', '2022-04-15 12:34:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(15) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `brand_id` varchar(50) NOT NULL,
  `img` varchar(150) NOT NULL,
  `color` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `normal_price` double(12,0) NOT NULL,
  `discount_price` double(12,0) NOT NULL,
  `describe` varchar(200) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_code`, `product_name`, `category_id`, `brand_id`, `img`, `color`, `amount`, `normal_price`, `discount_price`, `describe`, `account_id`) VALUES
(4, 'CIVRSHD', 'Civic RS 1.5 Turbo 2022', 'Car', 'Honda', 'civic.png', 'White', 189, 800000000, 20, 'Best Seller', 1),
(5, 'R1M2020', 'YZF R1M Edition 2020', 'Motobike', 'Yamaha', 'r1.png', 'Blue', 197, 600000000, 550000000, 'Fav', 1),
(131, 'CRB1RRHD', 'CBR1000rr', 'Motobike', 'Honda', 'honda-cbr1000rr-r-fireblade-sp-2020-9587-1602042052-1602063945_680x0.jpg', 'Red', 96, 700000000, 650000000, '', 1),
(132, 'CRVRSHD', 'CRV RS 2022', 'Car', 'Honda', '1649730263honda-cr-v-2021-61742.png', 'Blue', 85, 700000000, 5, '', 1),
(133, 'YZFR6YMH', 'YZF R6 2020', 'Motobike', 'Yamaha', '2020_YZF-R6_Action_2.jpg', 'Blue', 102, 400000000, 380000000, '', 1),
(134, 'CTRSHD', 'City RS 2022', 'Car', 'Honda', 'F4-1-e1645089253562.png', 'White', 82, 600000000, 550000000, '', 1),
(135, 'TAHD', 'Twin Africa 2021', 'Motobike', 'Honda', '1622198484_honda-viet-nam-ra-mat-africa-twin-2021-dat-nhat-6899-trieu-dong.jpg', 'White', 90, 300000000, 290000000, '', 1),
(136, 'GTLP16BMX', 'GT Lil Performer 16', 'Bikecycle', 'BMX', 'mm5q9bmVQcpVnz7oCCTwB4-1200-80.jpg', 'Blue', 41, 300000000, 290000000, '', 1),
(137, 'VBVB', 'Vin Bus 2022', 'Bus', 'Vinfast', 'e5to17q_ckq.jpg', 'Green', 76, 500000000, 450000000, '', 1),
(138, 'H500SFLCTHN', 'Hino 500 Series FL8JW7A Cargo Truck 2022', 'Truck', 'Hino', 'hino-500-series-fl8jw7a-cab-chassis-10-wheeler-61ab1868a0a57.jpg', 'White', 76, 800000000, 790000000, '', 1),
(149, 'GCD', 'Gi Cung Duoc', 'Xe Máy', 'Hồng đức 123', '251485604_3087890721531813_6704883600458391152_n.jpg', 'White', 1, 5, 1, '', 27),
(150, '1626', '115', '62626', '55454', '222.png', 'Yellow', 2552, 288, 1, '', 27),
(154, '1321', 'Cu Gia', 'Sextoy', '5thewack', '...png', 'Red', 100, 5, 0, 'nice', 32);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `account_id` int(11) NOT NULL,
  `membership_silver` int(11) NOT NULL,
  `membership_gold` int(11) NOT NULL,
  `membership_platinum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `addr` varchar(150) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `purchased` double(12,0) NOT NULL,
  `debt` double(12,0) NOT NULL,
  `membership` int(11) NOT NULL,
  `describe` varchar(200) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `addr`, `phone`, `email`, `purchased`, `debt`, `membership`, `describe`, `account_id`) VALUES
(7, '123', '123', '0123456789', '2@gmail.com', 1, 1, 0, '', 27),
(8, '123123123', '123123123', '0000123123', '', 1, 1, 0, '', 27),
(9, 'Honda', '', '1234567890', 'honda@gmail.com', 1600000000, 0, 0, '', 1),
(12, 'Nam', 'Vietnam', '0758986585', 'concactaone@gmail.com', 500, 0, 0, '', 32),
(13, 'Yamaha', 'Vĩnh Phúc', '0702010203', 'yamahatown@gmail.com', 0, 0, 0, '', 1),
(14, 'Toyota', 'Hoa Binh, Viet Nam', '0266012345', 'toyotavn@gmail.com', 0, 0, 0, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `bot_data`
--
ALTER TABLE `bot_data`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `invoice_ex`
--
ALTER TABLE `invoice_ex`
  ADD PRIMARY KEY (`invoice_ex_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `invoice_ex_item`
--
ALTER TABLE `invoice_ex_item`
  ADD PRIMARY KEY (`invoice_ex_item_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `invoice_im`
--
ALTER TABLE `invoice_im`
  ADD PRIMARY KEY (`invoice_im_id`),
  ADD KEY `customer_id` (`supplier_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `invoice_im_item`
--
ALTER TABLE `invoice_im_item`
  ADD PRIMARY KEY (`invoice_im_item_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `acount_id` (`account_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `bot_data`
--
ALTER TABLE `bot_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `invoice_ex`
--
ALTER TABLE `invoice_ex`
  MODIFY `invoice_ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `invoice_ex_item`
--
ALTER TABLE `invoice_ex_item`
  MODIFY `invoice_ex_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `invoice_im`
--
ALTER TABLE `invoice_im`
  MODIFY `invoice_im_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `invoice_im_item`
--
ALTER TABLE `invoice_im_item`
  MODIFY `invoice_im_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bot_data`
--
ALTER TABLE `bot_data`
  ADD CONSTRAINT `bot_data_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `invoice_ex`
--
ALTER TABLE `invoice_ex`
  ADD CONSTRAINT `invoice_ex_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `invoice_ex_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `invoice_ex_item`
--
ALTER TABLE `invoice_ex_item`
  ADD CONSTRAINT `invoice_ex_item_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `invoice_im`
--
ALTER TABLE `invoice_im`
  ADD CONSTRAINT `invoice_im_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `invoice_im_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `invoice_im_item`
--
ALTER TABLE `invoice_im_item`
  ADD CONSTRAINT `invoice_im_item_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
