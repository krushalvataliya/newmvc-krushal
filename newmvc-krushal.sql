-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 07:12 PM
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(32, 'krushal', 'kv@gmail.com', '123', 1, '2023-04-23 08:58:33', '2023-04-23 18:46:23'),
(33, 'kv vataliya', '', '', 1, '2023-04-23 18:40:43', '2023-04-23 18:45:13'),
(34, 'kv vataliya', 'krushalvataliya24@gmail.com', '22', 1, '2023-04-23 18:43:13', '2023-04-24 07:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `name`, `description`, `image`, `entity_type_id`, `created_at`, `updated_at`) VALUES
(5, 'nike', 'nike nike nike', 'IMG_1681895042.jpg', 7, '2023-04-19 14:34:02', NULL),
(7, 'lenovo', 'lenovo lenovo lenovo', 'IMG_1681895430.png', 7, '2023-04-19 14:40:30', NULL),
(11, 'qq', '22', 'IMG_1682442179.jpg', 7, '2023-04-25 22:32:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_decimal`
--

CREATE TABLE `brand_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_decimal`
--

INSERT INTO `brand_decimal` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(2, 7, 69, '145.00');

-- --------------------------------------------------------

--
-- Table structure for table `brand_int`
--

CREATE TABLE `brand_int` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_text`
--

CREATE TABLE `brand_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_text`
--

INSERT INTO `brand_text` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 7, 70, '112');

-- --------------------------------------------------------

--
-- Table structure for table `brand_varchar`
--

CREATE TABLE `brand_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `shiping_method_id` int(11) NOT NULL,
  `shiping_amount` int(11) NOT NULL,
  `tax_percent` int(11) DEFAULT 0,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `shiping_method_id`, `shiping_amount`, `tax_percent`, `customer_id`, `created_at`, `updated_at`) VALUES
(64, 334, 0, 10, 3452, '2023-04-19 06:29:59', '2023-04-20 05:38:42');

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
  `customer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
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

INSERT INTO `category` (`category_id`, `entity_type_id`, `parent_id`, `name`, `path`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'root', '1', 1, '', '2023-04-18 18:28:25', NULL),
(284, 4, 283, 'a', '1=284', 1, 'a', '2023-04-18 18:29:40', '2023-04-18 18:29:40'),
(285, 4, 284, 'b', '1=284=285', 1, 'b', '2023-04-18 18:30:23', '2023-04-18 18:30:23'),
(286, 4, 285, 'c', '1=284=285=286', 1, 'c', '2023-04-18 18:30:31', '2023-04-18 18:30:31'),
(287, 4, 286, 'd', '1=284=285=286=287', 1, 'd', '2023-04-18 18:48:58', '2023-04-18 18:48:58'),
(288, 4, 1, 'kv', '1=288', 1, 'vk', '2023-04-23 11:01:41', '2023-04-23 13:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `category_decimal`
--

CREATE TABLE `category_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_int`
--

CREATE TABLE `category_int` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_text`
--

CREATE TABLE `category_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_text`
--

INSERT INTO `category_text` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 287, 62, 'ccq'),
(2, 288, 62, 'ccq');

-- --------------------------------------------------------

--
-- Table structure for table `category_varchar`
--

CREATE TABLE `category_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `shiping_address_id` int(11) DEFAULT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `entity_type_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `shiping_address_id`, `billing_address_id`, `created_at`, `updated_at`) VALUES
(3452, 2, 'hiren', 'khut', 'hiren@gmail.com', 'male', '06353319278', 1, 290, 290, '2023-04-19 02:17:57', '2023-04-25 17:05:58'),
(3453, 2, 'hemin', 'shah', 'hemin@gmail.com', 'male', '6325413365', 1, 291, 291, '2023-04-19 06:19:38', '2023-04-19 06:19:38'),
(3459, 2, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, 301, 301, '2023-04-23 12:25:23', '2023-04-23 12:25:23'),
(3462, 2, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, 304, 304, '2023-04-25 17:03:58', '2023-04-25 17:03:58');

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
(290, 'plot no.76/B,', 'jamnafdgars', 'gujarat', 'India', 361008, '2023-04-19 07:47:57', '2023-04-25 22:34:12', 3452),
(291, 'plot no.76/B,', 'jamsnagara', 'gujarat', 'India', 361008, '2023-04-19 11:49:38', NULL, 3453),
(301, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-04-23 17:55:23', NULL, 3459),
(304, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-04-25 22:33:58', NULL, 3462);

-- --------------------------------------------------------

--
-- Table structure for table `customer_decimal`
--

CREATE TABLE `customer_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_int`
--

CREATE TABLE `customer_int` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_text`
--

CREATE TABLE `customer_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_varchar`
--

CREATE TABLE `customer_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_varchar`
--

INSERT INTO `customer_varchar` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(2, 3452, 64, 'adhar'),
(3, 3453, 64, '11'),
(5, 3459, 64, ''),
(14, 3462, 43, '115,114'),
(15, 3462, 64, ''),
(16, 3452, 43, '115,114');

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
  `source_model` varchar(255) NOT NULL,
  `input_type` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute`
--

INSERT INTO `eav_attribute` (`attribute_id`, `entity_type_id`, `code`, `backend_type`, `name`, `status`, `source_model`, `input_type`, `updated_at`) VALUES
(43, 2, 'qaq', 'varchar', 'qqax', 1, 'Eav_Attribute_Option_Source', 'multiselect', '2023-04-23 16:56:15'),
(44, 5, 'age', 'int', 'jhgf', 1, 'Eav_Attribute_Option_Source', 'select', '2023-04-18 03:19:06'),
(45, 5, 'age', 'int', 'aa', 1, 'Eav_Attribute_Option_Source', 'radio', '2023-04-18 03:19:11'),
(46, 5, 'agdqe', 'varchar', 'aa', 1, 'Eav_Attribute_Option_Source', 'multiselect', '2023-04-18 03:19:17'),
(50, 5, 'desc', 'text', 'desc', 1, 'Eav_Attribute_Option_Source', 'textarea', '2023-04-23 07:08:01'),
(54, 5, 'cost', 'decimal', 'cost', 1, 'Eav_Attribute_Option_Source', 'textbox', '2023-04-23 07:08:01'),
(62, 4, 'desc', 'text', 'desc', 1, 'Eav_Attribute_Option_Source', 'textbox', '2023-04-19 02:14:53'),
(64, 2, 'proof', 'varchar', 'proof', 1, 'Eav_Attribute_Option_Source', 'textbox', '2023-04-23 07:08:01'),
(65, 3, 'proof', 'text', 'proof', 1, 'Eav_Attribute_Option_Source', 'select', '2023-04-19 02:14:37'),
(66, 1, 'description', 'text', 'description', 1, 'Eav_Attribute_Option_Source', 'textarea', '2023-04-23 07:08:01'),
(67, 1, 'color', 'int', 'color', 1, 'Eav_Attribute_Option_Source', 'select', '2023-04-23 07:08:01'),
(68, 1, 'material', 'varchar', 'material', 1, 'Eav_Attribute_Option_Source', 'checkbox', '2023-04-23 07:08:01'),
(69, 7, 'net worth', 'decimal', 'net worth', 1, 'Eav_Attribute_Option_Source', 'textbox', '2023-04-23 07:08:01'),
(70, 7, 'international?', 'text', 'international?', 1, 'Eav_Attribute_Option_Source', 'radio', '2023-04-19 09:09:37');

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
(48, 'select 3', 44, NULL, '2023-04-14 08:20:55'),
(49, 'select 2', 44, NULL, '2023-04-14 08:20:55'),
(50, 'select1', 44, NULL, '2023-04-14 08:20:55'),
(51, 'radio 3', 45, NULL, '2023-04-14 08:23:25'),
(52, 'radio 2', 45, NULL, '2023-04-14 08:23:25'),
(53, 'radio 1', 45, NULL, '2023-04-14 08:23:25'),
(54, 'multi select 3', 46, 3, '2023-04-16 10:44:48'),
(55, 'multi select 2', 46, 2, '2023-04-16 10:44:44'),
(56, 'multi select 1', 46, 1, '2023-04-16 10:44:41'),
(102, 'licence', 65, 3, '2023-04-19 02:11:15'),
(103, 'pan', 65, 2, '2023-04-19 02:11:15'),
(104, 'adhar', 65, 1, '2023-04-19 02:11:15'),
(105, 'green', 67, 3, '2023-04-19 05:06:31'),
(106, 'blue', 67, 2, '2023-04-19 05:06:31'),
(107, 'red', 67, 1, '2023-04-19 05:06:31'),
(108, 'cotton', 68, 3, '2023-04-19 05:07:58'),
(109, 'silk', 68, 2, '2023-04-19 05:07:58'),
(110, 'solid', 68, 1, '2023-04-19 05:07:58'),
(111, 'no', 70, 2, '2023-04-19 09:09:37'),
(112, 'yes', 70, 1, '2023-04-19 09:09:37'),
(113, 'c1', 43, 3, '2023-04-23 16:45:07'),
(114, 'b1', 43, 2, '2023-04-23 16:45:07'),
(115, 'a1', 43, 1, '2023-04-23 16:45:07');

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
(1, 'product', 'Model_Product'),
(2, 'customer', 'Model_Customer'),
(3, 'vendor', 'Model_Vendor'),
(4, 'category', 'Model_Category'),
(5, 'item', 'Model_Item'),
(6, 'salesman', 'Model_Salesman'),
(7, 'brand', 'Model_Brand');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `entity_type_id` int(11) NOT NULL DEFAULT 5,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `sku`, `entity_type_id`, `status`, `created_at`, `updated_at`) VALUES
(41, 'rt', 5, 2, '2023-04-25 08:36:39', NULL),
(42, 'rt', 5, 1, '2023-04-25 16:46:15', '2023-04-25 22:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `item_decimal`
--

CREATE TABLE `item_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_decimal`
--

INSERT INTO `item_decimal` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(17, 41, 54, '0.00'),
(18, 42, 54, '11.00');

-- --------------------------------------------------------

--
-- Table structure for table `item_int`
--

CREATE TABLE `item_int` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_int`
--

INSERT INTO `item_int` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(79, 41, 44, 48),
(80, 42, 44, 48),
(81, 42, 45, 51);

-- --------------------------------------------------------

--
-- Table structure for table `item_text`
--

CREATE TABLE `item_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_text`
--

INSERT INTO `item_text` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(42, 41, 50, 'desc'),
(43, 42, 50, '11');

-- --------------------------------------------------------

--
-- Table structure for table `item_varchar`
--

CREATE TABLE `item_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_varchar`
--

INSERT INTO `item_varchar` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(145, 42, 46, '56,55');

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
  `gallary` tinyint(4) DEFAULT 0,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `filename`, `created_at`, `updated_at`, `img`, `gallary`, `product_id`) VALUES
(118, 'aa', '2023-04-25 14:20:55', NULL, 'IMG_1682412655.', 0, 2565),
(119, 'aa', '2023-04-25 14:21:01', NULL, 'IMG_1682412661.', 0, 2565),
(120, '', '2023-04-25 14:22:48', NULL, '', 0, 2565),
(121, 'aa', '2023-04-25 14:39:33', NULL, 'IMG_1682413773.', 0, 2565),
(122, 'aa', '2023-04-25 14:39:37', NULL, 'IMG_1682413777.', 0, 2565),
(123, 'java', '2023-04-25 14:40:08', NULL, 'IMG_1682413808.', 0, 2565),
(132, '', '2023-04-25 21:18:20', '2023-04-25 16:31:34', 'IMG_1682437700.png', 1, 2589),
(134, 'aa', '2023-04-25 21:20:21', '2023-04-25 16:31:34', 'IMG_1682437821.png', 1, 2589);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Complete','Pending') NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `shipping_method_id` int(11) NOT NULL,
  `shipping_amount` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `address_id` int(11) NOT NULL,
  `customer_address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` int(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`payment_method_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cash', 1, '2023-02-11 16:21:48', '2023-04-20 08:13:19'),
(40, 'upi', 1, '2023-03-02 04:56:24', '2023-04-20 08:13:21'),
(450, 'credit card', 1, '2023-03-31 04:38:50', '2023-04-24 07:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `cost` int(5) NOT NULL,
  `price` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` enum('red','green','blue') NOT NULL,
  `material` varchar(255) NOT NULL,
  `thumbnail_id` int(11) DEFAULT NULL,
  `midium_id` int(11) DEFAULT NULL,
  `large_id` int(11) DEFAULT NULL,
  `small_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `entity_type_id`, `name`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `thumbnail_id`, `midium_id`, `large_id`, `small_id`, `created_at`, `updated_at`) VALUES
(2664, 1, 'nokia 1100', 'nokia 1100', 1100, 1100, 1100, '', 1, 'red', '', NULL, NULL, NULL, NULL, '2023-04-25 22:14:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_decimal`
--

CREATE TABLE `product_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Dumping data for table `product_int`
--

INSERT INTO `product_int` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(361, 2664, 67, 106);

-- --------------------------------------------------------

--
-- Table structure for table `product_text`
--

CREATE TABLE `product_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_text`
--

INSERT INTO `product_text` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(383, 2664, 66, 'nokia 1100');

-- --------------------------------------------------------

--
-- Table structure for table `product_varchar`
--

CREATE TABLE `product_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_varchar`
--

INSERT INTO `product_varchar` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(43, 2664, 68, '110');

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `quote_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `payment_method_id` int(11) NOT NULL,
  `shiping_method_id` int(11) NOT NULL,
  `shiping_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`quote_id`, `customer_id`, `total`, `status`, `payment_method_id`, `shiping_method_id`, `shiping_amount`, `created_at`, `updated_at`) VALUES
(1, 3452, 100, 1, 450, 334, 100, '2023-04-20 05:49:29', '2023-04-25 09:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `quote_address`
--

CREATE TABLE `quote_address` (
  `address_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `customer_address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quote_address`
--

INSERT INTO `quote_address` (`address_id`, `quote_id`, `customer_address_id`, `address`, `city`, `state`, `country`, `zip_code`) VALUES
(17, 1, 290, 'plot no.76/B,', 'jamnafdgars', 'gujarat', 'India', 361008);

-- --------------------------------------------------------

--
-- Table structure for table `quote_items`
--

CREATE TABLE `quote_items` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL,
  `quote_id` int(11) NOT NULL
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
(38, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-04-24 12:22:00', NULL, 64),
(39, '', '', '', '', 0, '2023-04-24 12:22:00', NULL, 64);

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
(100, 64, 2565, 1221, '2023-04-25 05:55:37'),
(102, 64, 2588, 1221, NULL);

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
(64, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, 'ww', '2023-04-24 12:22:00', NULL);

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
  `entity_type_id` int(11) NOT NULL,
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

INSERT INTO `vendors` (`vendor_id`, `entity_type_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(417, 0, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 1, 'qqqq', '2023-04-24 12:16:16', NULL);

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
(92, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-04-24 12:16:16', NULL, 417);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_decimal`
--

CREATE TABLE `vendor_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_int`
--

CREATE TABLE `vendor_int` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_text`
--

CREATE TABLE `vendor_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_text`
--

INSERT INTO `vendor_text` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 376, 65, '102'),
(3, 377, 65, '103');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_varchar`
--

CREATE TABLE `vendor_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD KEY `entity_type_id` (`entity_type_id`);

--
-- Indexes for table `brand_decimal`
--
ALTER TABLE `brand_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `brand_int`
--
ALTER TABLE `brand_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `brand_text`
--
ALTER TABLE `brand_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `brand_varchar`
--
ALTER TABLE `brand_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `shipping_id` (`shiping_method_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent -id` (`parent_id`),
  ADD KEY `entity_type_id` (`entity_type_id`);

--
-- Indexes for table `category_decimal`
--
ALTER TABLE `category_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `category_int`
--
ALTER TABLE `category_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `category_text`
--
ALTER TABLE `category_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `category_varchar`
--
ALTER TABLE `category_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`),
  ADD KEY `billing_address_id` (`billing_address_id`),
  ADD KEY `shiping_address_id` (`shiping_address_id`),
  ADD KEY `entity_type_id` (`entity_type_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer_decimal`
--
ALTER TABLE `customer_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `customer_int`
--
ALTER TABLE `customer_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `customer_text`
--
ALTER TABLE `customer_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `customer_varchar`
--
ALTER TABLE `customer_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

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
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_decimal`
--
ALTER TABLE `item_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `item_int`
--
ALTER TABLE `item_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `item_text`
--
ALTER TABLE `item_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `item_varchar`
--
ALTER TABLE `item_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `product-id` (`product_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `shipping_method_id` (`shipping_method_id`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_address_id` (`customer_address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `thumbnail_id` (`thumbnail_id`),
  ADD KEY `midium_id` (`midium_id`),
  ADD KEY `large_id` (`large_id`),
  ADD KEY `small_id` (`small_id`),
  ADD KEY `entity_type_id` (`entity_type_id`);

--
-- Indexes for table `product_decimal`
--
ALTER TABLE `product_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_int`
--
ALTER TABLE `product_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_text`
--
ALTER TABLE `product_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_varchar`
--
ALTER TABLE `product_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`quote_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `shipping_method_id` (`shiping_method_id`);

--
-- Indexes for table `quote_address`
--
ALTER TABLE `quote_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_address_id` (`customer_address_id`),
  ADD KEY `quote_id` (`quote_id`);

--
-- Indexes for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `quote_id` (`quote_id`),
  ADD KEY `quote_items_ibfk_2` (`product_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `salesman_id` (`salesman_id`);

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
  ADD PRIMARY KEY (`vendor_id`),
  ADD UNIQUE KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `vendor_decimal`
--
ALTER TABLE `vendor_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `vendor_int`
--
ALTER TABLE `vendor_int`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `vendor_text`
--
ALTER TABLE `vendor_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `vendor_varchar`
--
ALTER TABLE `vendor_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id_2` (`entity_id`,`attribute_id`),
  ADD KEY `entity_id` (`entity_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brand_decimal`
--
ALTER TABLE `brand_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand_int`
--
ALTER TABLE `brand_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_text`
--
ALTER TABLE `brand_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand_varchar`
--
ALTER TABLE `brand_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `category_decimal`
--
ALTER TABLE `category_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_int`
--
ALTER TABLE `category_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_text`
--
ALTER TABLE `category_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_varchar`
--
ALTER TABLE `category_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3463;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `customer_decimal`
--
ALTER TABLE `customer_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_int`
--
ALTER TABLE `customer_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_text`
--
ALTER TABLE `customer_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_varchar`
--
ALTER TABLE `customer_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `entity_type`
--
ALTER TABLE `entity_type`
  MODIFY `entity_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `item_decimal`
--
ALTER TABLE `item_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `item_int`
--
ALTER TABLE `item_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `item_text`
--
ALTER TABLE `item_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `item_varchar`
--
ALTER TABLE `item_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2665;

--
-- AUTO_INCREMENT for table `product_decimal`
--
ALTER TABLE `product_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_int`
--
ALTER TABLE `product_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- AUTO_INCREMENT for table `product_text`
--
ALTER TABLE `product_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

--
-- AUTO_INCREMENT for table `product_varchar`
--
ALTER TABLE `product_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quote_address`
--
ALTER TABLE `quote_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `shiping_methods`
--
ALTER TABLE `shiping_methods`
  MODIFY `shiping_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `vendor_decimal`
--
ALTER TABLE `vendor_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_int`
--
ALTER TABLE `vendor_int`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_text`
--
ALTER TABLE `vendor_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor_varchar`
--
ALTER TABLE `vendor_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brand_decimal`
--
ALTER TABLE `brand_decimal`
  ADD CONSTRAINT `brand_decimal_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brand_decimal_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brand_int`
--
ALTER TABLE `brand_int`
  ADD CONSTRAINT `brand_int_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brand_int_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brand_text`
--
ALTER TABLE `brand_text`
  ADD CONSTRAINT `brand_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brand_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brand_varchar`
--
ALTER TABLE `brand_varchar`
  ADD CONSTRAINT `brand_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brand_varchar_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_id` FOREIGN KEY (`shiping_method_id`) REFERENCES `shiping_methods` (`shiping_method_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_decimal`
--
ALTER TABLE `category_decimal`
  ADD CONSTRAINT `category_decimal_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_decimal_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_int`
--
ALTER TABLE `category_int`
  ADD CONSTRAINT `category_int_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_int_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_text`
--
ALTER TABLE `category_text`
  ADD CONSTRAINT `category_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_varchar`
--
ALTER TABLE `category_varchar`
  ADD CONSTRAINT `category_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_varchar_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`billing_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`shiping_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `customers_ibfk_3` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer-id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_decimal`
--
ALTER TABLE `customer_decimal`
  ADD CONSTRAINT `customer_decimal_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_decimal_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_int`
--
ALTER TABLE `customer_int`
  ADD CONSTRAINT `customer_int_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_int_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_text`
--
ALTER TABLE `customer_text`
  ADD CONSTRAINT `customer_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_varchar`
--
ALTER TABLE `customer_varchar`
  ADD CONSTRAINT `customer_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_varchar_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `item_decimal`
--
ALTER TABLE `item_decimal`
  ADD CONSTRAINT `item_decimal_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_decimal_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_int`
--
ALTER TABLE `item_int`
  ADD CONSTRAINT `item_int_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_int_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_text`
--
ALTER TABLE `item_text`
  ADD CONSTRAINT `item_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_varchar`
--
ALTER TABLE `item_varchar`
  ADD CONSTRAINT `item_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_varchar_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`payment_method_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`shipping_method_id`) REFERENCES `shiping_methods` (`shiping_method_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`customer_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`thumbnail_id`) REFERENCES `media` (`media_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`midium_id`) REFERENCES `media` (`media_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`large_id`) REFERENCES `media` (`media_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`small_id`) REFERENCES `media` (`media_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_ibfk_5` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_decimal`
--
ALTER TABLE `product_decimal`
  ADD CONSTRAINT `product_decimal_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_decimal_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_int`
--
ALTER TABLE `product_int`
  ADD CONSTRAINT `product_int_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_int_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_text`
--
ALTER TABLE `product_text`
  ADD CONSTRAINT `product_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_varchar`
--
ALTER TABLE `product_varchar`
  ADD CONSTRAINT `product_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_varchar_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `quote_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`payment_method_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_ibfk_3` FOREIGN KEY (`shiping_method_id`) REFERENCES `shiping_methods` (`shiping_method_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quote_address`
--
ALTER TABLE `quote_address`
  ADD CONSTRAINT `quote_address_ibfk_1` FOREIGN KEY (`customer_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_address_ibfk_2` FOREIGN KEY (`quote_id`) REFERENCES `quote` (`quote_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD CONSTRAINT `quote_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_items_ibfk_3` FOREIGN KEY (`quote_id`) REFERENCES `quote` (`quote_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD CONSTRAINT `salesman_address_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesmen` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`salesman_id`) REFERENCES `salesmen` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_decimal`
--
ALTER TABLE `vendor_decimal`
  ADD CONSTRAINT `vendor_decimal_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_decimal_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_int`
--
ALTER TABLE `vendor_int`
  ADD CONSTRAINT `vendor_int_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_int_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_text`
--
ALTER TABLE `vendor_text`
  ADD CONSTRAINT `vendor_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_varchar`
--
ALTER TABLE `vendor_varchar`
  ADD CONSTRAINT `vendor_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vendor_varchar_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
