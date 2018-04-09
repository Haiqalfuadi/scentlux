-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2018 at 08:18 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scentlux`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_tmp`
--

CREATE TABLE IF NOT EXISTS `cart_tmp` (
`id` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `date` date NOT NULL,
  `queue` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_tmp`
--

INSERT INTO `cart_tmp` (`id`, `member`, `product`, `date`, `queue`) VALUES
(1, 1, 4, '2018-03-01', 0),
(2, 1, 1, '2018-04-01', 1),
(3, 1, 5, '2018-05-01', 2),
(4, 1, 7, '2018-06-01', 3),
(5, 1, 3, '2018-07-01', 4),
(6, 1, 9, '2018-08-01', 5),
(7, 1, 1, '2018-09-01', 6),
(8, 1, 4, '2018-04-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@scentlux.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `gender` char(6) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `brand`, `type`, `gender`, `image`) VALUES
(1, 'Cambridge Knight', 4, 'Eau de Parfum', 'Male', 'assets/images/parfume/img-478.jpg'),
(3, 'Man Blue', 1, 'Eau de Parfum', 'Male', 'assets/images/parfume/img-648.jpg'),
(4, 'Maritim For Him', 5, 'Eau de Toilette', 'Female', 'assets/images/parfume/img-742.jpg'),
(5, 'Cypress', 7, 'Eau de Parfume', 'Male', 'assets/images/parfume/img-743.jpg'),
(6, 'Tardes', 3, 'Eau de Parfum', 'Female', 'assets/images/parfume/img-797.jpg'),
(7, 'Colonia', 9, 'Eau de Cologne', 'Male', 'assets/images/parfume/img-799.jpg'),
(8, 'Colonia', 9, 'Eau de Cologne', 'Male', 'assets/images/parfume/img-799.jpg'),
(9, 'Maritim For Him', 5, 'Eau de Toilette', 'Female', 'assets/images/parfume/img-742.jpg'),
(10, 'Cypress', 7, 'Eau de Parfume', 'Male', 'assets/images/parfume/img-743.jpg'),
(11, 'Tardes', 3, 'Eau de Parfum', 'Female', 'assets/images/parfume/img-797.jpg'),
(12, 'Colonia', 9, 'Eau de Cologne', 'Male', 'assets/images/parfume/img-799.jpg'),
(13, 'Man Blue', 1, 'Eau de Parfum', 'Male', 'assets/images/parfume/img-648.jpg'),
(14, 'Tardes', 3, 'Eau de Parfum', 'Female', 'assets/images/parfume/img-797.jpg'),
(15, 'Maritim For Him', 5, 'Eau de Toilette', 'Female', 'assets/images/parfume/img-742.jpg'),
(16, 'Tardes', 3, 'Eau de Parfum', 'Female', 'assets/images/parfume/img-797.jpg'),
(17, 'Colonia', 9, 'Eau de Cologne', 'Male', 'assets/images/parfume/img-799.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE IF NOT EXISTS `product_brand` (
`id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`id`, `brand`) VALUES
(1, 'VERSACE'),
(2, 'BVLGARI'),
(3, 'GUCCI'),
(4, 'ENGLISH LAUNDRY'),
(5, 'PRADA'),
(6, 'TOMMY BAHAMA'),
(7, 'HUGO BOSS'),
(8, 'BURBERRY'),
(9, 'TOMFORD'),
(10, 'DOLCE & GABBANA');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `id` int(11) NOT NULL,
  `product_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_tmp`
--
ALTER TABLE `cart_tmp`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_tmp`
--
ALTER TABLE `cart_tmp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
