-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 05:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_active`) VALUES
(5, 'Bruno', 'brunoadmin@gmail.com', '$2y$10$qZ0OoyX8bhAVxDFM/fx8leZSZwlyq15c1C/KTnaqDLSx6eCDJ0VpC', '0'),
(8, 'Harry Den', 'harryden@gmail.com', '$2y$10$YKSDtra7v2wH6ORYfry8Ue9t49pk1AvQvdJGuq4lDvFLEcx.kP6Mq', '0'),
(9, 'fabrice Mukarage', 'fabrice.mukarage@gmail.com', '$2y$10$5JMSkF21fFQ.wik/6yHddeLLSJe3pD0dqctxEUFpeH/SZXT0p9NnO', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(29, 2, '::1', -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, 'Business'),
(3, 'Marketing'),
(4, 'Advertising'),
(5, 'Ads'),
(6, 'Startup'),
(12, 'Post'),
(13, 'New year'),
(14, 'Christmas'),
(15, 'Event'),
(16, 'Gift'),
(17, 'Invitation'),
(18, 'Party'),
(19, 'Travel'),
(20, 'Promotion'),
(21, 'Festival'),
(22, 'Workshop'),
(23, 'Concert'),
(24, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `service_id`, `qty`, `trx_id`, `p_status`) VALUES
(1, 1, 1, 1, '9L434522M7706801A', 'Completed'),
(2, 1, 2, 1, '9L434522M7706801A', 'Completed'),
(3, 1, 3, 1, '9L434522M7706801A', 'Completed'),
(4, 1, 1, 1, '8AT7125245323433N', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(100) NOT NULL,
  `service_cat` int(11) NOT NULL,
  `service_title` varchar(255) NOT NULL,
  `service_price` int(100) NOT NULL,
  `service_desc` text NOT NULL,
  `service_image` text NOT NULL,
  `service_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_cat`, `service_title`, `service_price`, `service_desc`, `service_image`, `service_keywords`) VALUES
(1, 4, 'Advertising fliers', 3, 'Advertising fliers', 'marketing.jpg', 'Advertising'),
(2, 17, 'Invitation fliers', 5, 'flier for invitations', 'invitation.jpg', 'invitations'),
(5, 12, 'Post fliers', 4, 'post', 'post.jpg', 'post'),
(10, 2, 'business fliers', 3, 'business fliers', 'business.jpg', 'business'),
(11, 6, 'fliers for startup companies', 2, 'startup', 'startup.jpg', 'startup'),
(20, 14, 'Fliers for Christimas', 2, 'christimas', 'christman.jpg', 'christimas'),
(21, 16, 'Gifts fliers', 1, 'different types of gift', 'gift.jpg', 'gift'),
(23, 13, 'new year fliers', 2, 'new year gift', 'new year.jpg', 'new year'),
(24, 15, 'fliers for events', 2, 'events fliers', 'event.jpg', 'event'),
(25, 19, 'traveling fliers', 1, 'traveling fliers', 'travel.jpg', 'travel'),
(26, 20, 'promotion fliers', 2, 'promotion', 'promotion.jpg', 'promotion'),
(27, 21, 'fliers for Festivals', 1, 'Festivals', 'festival.jpg', 'Festival'),
(28, 22, 'fliers for workshops', 2, 'workshops fliers', 'workshop.jpg', 'workshop'),
(29, 23, 'flier for concerts', 1, 'concert', 'concert.jpg', 'concert'),
(30, 24, 'fliers for sports', 1, 'sports', 'sport.jpg', 'sports'),
(31, 3, 'Marketing fliers', 1, 'marketing', 'adverting.jpg', 'marketing'),
(32, 5, 'ads fliers', 2, 'Ads', 'ad.jpg', 'ads'),
(33, 18, 'flier for party', 1, 'party fliers', 'party.jpg', 'party');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(1, 'Christine', 'Randolph', 'randolphc@gmail.com', '25f9e794323b453885f5181f1b624d0b', '8389080183', '2133  Hill Haven Drive', 'Terra Stree'),
(2, 'Will', 'Willams', 'willainswill@gmail.com', '25f9e794323b453885f5181f1b624d0b', '8389080183', '4567  Orphan Road', 'WI'),
(3, 'Demo', 'Name', 'demo@gmail.com', 'password', '9876543210', 'demo ad1', 'ademo ad2'),
(5, 'Steeve', 'Rogers', 'steeve1@gmail.com', '305e4f55ce823e111a46a9d500bcb86c', '9876547770', '573  Pinewood Avenue', 'MN'),
(6, 'Melissa', 'Gilbert', 'gilbert@gmail.com', '305e4f55ce823e111a46a9d500bcb86c', '7845554582', '1711  McKinley Avenue', 'MA'),
(7, 'Fabrice', 'Mukarage', 'fabrice.mukarage@gmail.com', 'ccb507236fa18a4ceb3e8b19ed06489b', '0783932356', 'Muyira, Nyanza', 'Kigali');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
