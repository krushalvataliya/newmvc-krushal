-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 04:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newmvc-krushal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(26, 'kv vataliya', 'krushalvataliya24@gmail.com', '123', 1, '2023-04-02 12:47:20', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `shiping_method_id` int(11) NOT NULL,
  `shiping_amount` int(11) NOT NULL,
  `tax_percent` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `shiping_method_id`, `shiping_amount`, `tax_percent`, `created_at`, `updated_at`) VALUES
(41, 334, 100, 5, '2023-04-08 09:15:08', '2023-04-10 13:48:28'),
(42, 335, 200, 5, '2023-04-08 09:16:07', '2023-04-10 13:48:53'),
(43, 344, 300, 5, '2023-04-08 09:19:41', '2023-04-08 09:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_item_id`, `product_id`, `cost`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2264, 1100, 1100, 6, '2023-03-14 13:33:51', '2023-04-10 13:16:05'),
(45, 2265, 1200, 1200, 12, '2023-04-08 13:36:36', '2023-04-10 13:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `name`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 'main', 1, 'main', '2023-03-01 09:05:04', '2023-03-31 08:17:22'),
(6, NULL, 'main 2', 1, 'main 2', '2023-03-01 09:06:13', NULL),
(205, 1, 'c', 1, 'c', '2023-03-31 03:51:04', '2023-03-31 09:30:32'),
(206, 1, 'a', 1, 'a', '2023-03-31 06:19:43', '2023-04-01 09:55:24'),
(207, 206, 'b', 1, 'b', '2023-03-31 06:19:53', '2023-03-31 09:30:24'),
(208, 207, 'c', 1, 'c', '2023-03-31 06:20:00', '2023-04-01 08:49:36'),
(209, 208, 'd', 1, 'd', '2023-03-31 06:20:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `name`, `path`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'root', '1', 1, 'main 2', '2023-03-01 09:06:13', NULL),
(256, 1, 'ab', '1=256', 1, 'a', '2023-04-02 02:48:35', '2023-04-02 02:52:32'),
(267, 256, 'b', '1=256=267', 1, 'b', '2023-04-02 08:14:59', '2023-04-02 08:14:59'),
(268, 267, 'c', '1=256=267=268', 2, 'c', '2023-04-02 08:15:38', '2023-04-03 01:50:20'),
(272, 1, 'c', '1=272', 1, 'c', '2023-04-03 04:38:13', '2023-04-03 04:38:13'),
(279, 268, 'd', '1=256=267=268=279', 1, 'd', '2023-04-09 13:03:49', '2023-04-09 13:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(3386, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, '2023-04-01 02:43:14', '2023-04-01 02:43:23'),
(3387, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 2, '2023-04-01 02:55:33', '2023-04-03 01:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `customer_id`) VALUES
(153, 'plot no.76/B,', 'aa', 'gujarat', 'India', 361008, '2023-04-01 08:13:14', '2023-04-01 08:13:23', 3386),
(154, 'plot no.76/B,', 'jamnagara', 'gujarat', 'India', 361008, '2023-04-01 08:25:33', '2023-04-03 07:21:12', 3387);

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute`
--

CREATE TABLE `eav_attribute` (
  `attribute_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `backend_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `backend_model` varchar(255) NOT NULL,
  `input_type` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute`
--

INSERT INTO `eav_attribute` (`attribute_id`, `entity_type_id`, `code`, `backend_type`, `name`, `status`, `backend_model`, `input_type`, `updated_at`) VALUES
(1, 1, 'color', 'text', 'color', 1, '', 'radio', '2023-04-10 03:06:40'),
(28, 1, '11', 'datetime', '11', 1, '11', 'radio', '2023-04-10 03:35:48'),
(29, 1, 'gender', 'text', 'gender', 1, 'gender', 'radio', '2023-04-10 05:54:58'),
(31, 1, 'ss', 'text', 'ss', 1, 'ss', 'select', '2023-04-10 13:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute_option`
--

CREATE TABLE `eav_attribute_option` (
  `option_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `position` int(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute_option`
--

INSERT INTO `eav_attribute_option` (`option_id`, `name`, `attribute_id`, `position`, `updated_at`) VALUES
(2, 'red', 1, NULL, '2023-04-09 07:40:05'),
(7, 'blue', 1, NULL, '2023-04-09 05:59:37'),
(14, 'green', 1, NULL, '2023-04-09 07:38:14'),
(29, 'gray', 1, NULL, '2023-04-10 03:06:40'),
(34, 'male', 29, NULL, '2023-04-10 05:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `entity_type`
--

CREATE TABLE `entity_type` (
  `entity_type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `entity_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entity_type`
--

INSERT INTO `entity_type` (`entity_type_id`, `name`, `entity_model`) VALUES
(1, 'product', ''),
(2, 'customer', ''),
(3, 'vendor', ''),
(4, 'salesman', '');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `thumbnail` tinyint(4) DEFAULT 0,
  `base` tinyint(4) DEFAULT 0,
  `midium` tinyint(4) DEFAULT 0,
  `large` tinyint(4) DEFAULT 0,
  `small` tinyint(4) DEFAULT 0,
  `gallary` tinyint(4) DEFAULT 0,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `filename`, `created_at`, `updated_at`, `img`, `thumbnail`, `base`, `midium`, `large`, `small`, `gallary`, `product_id`) VALUES
(81, 'aa', '2023-04-02 13:53:00', '2023-04-10 07:23:21', 'IMG_1680423780.jpg', 1, 0, 0, 0, 0, 0, 2264),
(85, 'ww', '2023-04-04 22:31:54', NULL, 'IMG_1680627714.png', 0, 0, 0, 0, 0, 0, 2265),
(86, 'q', '2023-04-05 10:06:39', '2023-04-10 07:23:21', 'IMG_1680669399.png', 0, 0, 0, 0, 0, 1, 2264),
(89, 'aa', '2023-04-10 12:20:41', '2023-04-10 07:23:21', 'IMG_1681109441.png', 0, 0, 0, 1, 1, 1, 2264);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`payment_method_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cash', 1, '2023-02-11 16:21:48', '2023-03-16 04:52:27'),
(40, 'upi', 1, '2023-03-02 04:56:24', '2023-03-31 04:25:34'),
(449, 'debitcard', 1, '2023-03-31 04:38:25', NULL),
(450, 'credit card', 1, '2023-03-31 04:38:50', '2023-04-06 05:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `cost` int(5) NOT NULL,
  `price` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` enum('red','green','blue') NOT NULL,
  `material` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `created_at`, `updated_at`) VALUES
(2264, 'nokia 1100', 'nokia 1100', 1100, 1100, 1100, 'nokia 1100', 1, 'red', 'nokia 1100 a', '2023-03-13 13:32:28', '2023-04-07 11:34:58'),
(2265, 'nokia 1200', 'nokia1200', 1200, 1200, 111, '111', 1, 'red', 'good', '2023-03-13 18:45:07', '2023-04-04 22:31:29'),
(2323, 'nokia 1300', 'nokia 1300', 1300, 1300, 1300, 'nokia 1300', 2, 'red', 'good', '2023-04-04 22:34:58', '2023-04-07 11:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_int`
--

CREATE TABLE `product_int` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `salesman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `salesman_id`) VALUES
(14, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-04-02 15:43:44', NULL, 50),
(16, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-04-08 08:40:24', NULL, 52);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

CREATE TABLE `salesman_price` (
  `entity_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `salesman_price` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_price`
--

INSERT INTO `salesman_price` (`entity_id`, `salesman_id`, `product_id`, `salesman_price`, `updated_at`) VALUES
(92, 50, 2264, 20, '2023-04-09 12:24:58'),
(93, 52, 2264, 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesmen`
--

CREATE TABLE `salesmen` (
  `salesman_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesmen`
--

INSERT INTO `salesmen` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(50, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, '', '2023-04-02 15:43:44', NULL),
(52, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, 'ww', '2023-04-08 08:40:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shiping_methods`
--

CREATE TABLE `shiping_methods` (
  `shiping_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shiping_methods`
--

INSERT INTO `shiping_methods` (`shiping_method_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(334, 'silver', 100, 1, '2023-03-14 08:31:37', '2023-04-06 05:33:27'),
(335, 'gold', 200, 2, '2023-03-14 08:31:46', NULL),
(344, 'platinum', 300, 1, '2023-04-01 03:56:22', '2023-04-06 05:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(352, 'kv', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, 'ccc', '2023-03-09 07:54:54', '2023-03-14 08:57:06'),
(357, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, 'ss', '2023-03-11 21:07:36', NULL),
(358, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 2, 'ccca', '2023-03-13 09:35:10', '2023-04-01 08:54:28'),
(365, 'krushalww', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 2, 'cc', '2023-04-01 09:10:51', '2023-04-01 09:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `vendor_id`) VALUES
(2, 'plot no.76/B', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-09 07:54:54', '2023-03-09 09:54:57', 352),
(5, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-11 21:07:36', '2023-03-16 10:56:10', 357),
(6, 'plot no.76/B,a', 'dd', 'gujarat', 'India', 361008, '2023-03-13 09:35:10', '2023-04-01 08:54:28', 358),
(15, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-04-01 09:10:51', '2023-04-01 09:11:05', 365);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `shipping_id` (`shiping_method_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent -id` (`parent_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent -id` (`parent_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `entity_type_id` (`entity_type_id`);

--
-- Indexes for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `entity_type`
--
ALTER TABLE `entity_type`
  ADD PRIMARY KEY (`entity_type_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `product-id` (`product_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_int`
--
ALTER TABLE `product_int`
  ADD PRIMARY KEY (`value_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `shiping_methods`
--
ALTER TABLE `shiping_methods`
  ADD PRIMARY KEY (`shiping_method_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3394;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `entity_type`
--
ALTER TABLE `entity_type`
  MODIFY `entity_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=456;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2333;

--
-- AUTO_INCREMENT for table `product_int`
--
ALTER TABLE `product_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `shiping_methods`
--
ALTER TABLE `shiping_methods`
  MODIFY `shiping_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `shipping_id` FOREIGN KEY (`shiping_method_id`) REFERENCES `shiping_methods` (`shiping_method_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `product-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `parent -id` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer-id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD CONSTRAINT `eav_attribute_ibfk_1` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD CONSTRAINT `eav_attribute_option_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_int`
--
ALTER TABLE `product_int`
  ADD CONSTRAINT `product_int_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_int_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD CONSTRAINT `salesman_id` FOREIGN KEY (`salesman_id`) REFERENCES `salesmen` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`salesman_id`) REFERENCES `salesmen` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor-id` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
