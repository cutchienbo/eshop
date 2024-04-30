-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 09:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` varchar(16) NOT NULL,
  `account` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `image` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `account`, `email`, `phone_number`, `image`, `status`) VALUES
(1, 'admin1', 'mysql', 'admin1', '', '', 'admin.png', 1),
(2, 'admin2', 'mysql', 'admin2', '', '', 'admin.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `authority`
--

CREATE TABLE `authority` (
  `auth_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_customer` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_customer`, `quantity`) VALUES
(1, 10),
(2, 4),
(3, 1),
(4, 1),
(5, 1),
(6, 4),
(7, 2),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `content` varchar(320) NOT NULL,
  `rate` int(11) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_customer`, `id_product`, `content`, `rate`, `create_date`, `status`) VALUES
(12, 1, 5, 'good', 4, '2023-11-16 09:39:18', 1),
(13, 1, 2, 'bad', 3, '2023-11-16 09:46:17', 1),
(14, 2, 2, 'good', 4, '2023-11-16 09:51:01', 1),
(15, 2, 4, 'good', 5, '2023-11-16 10:16:45', 1),
(16, 2, 5, 'pretty good', 4, '2023-11-16 10:17:38', 1),
(17, 2, 3, 'bad', 3, '2023-11-16 10:17:54', 1),
(18, 1, 3, 'good', 5, '2023-11-16 10:20:35', 1),
(19, 1, 4, 'bad', 2, '2023-11-16 10:22:13', 1),
(20, 4, 5, 'good', 5, '2023-11-16 10:24:18', 1),
(21, 4, 2, 'good product', 4, '2023-11-16 10:46:47', 1),
(24, 5, 2, 'very bad **** you', 1, '2023-11-16 21:22:52', 1),
(25, 5, 5, '****ing *****', 2, '2023-11-16 21:31:48', 1),
(26, 5, 4, 'i like that', 5, '2023-11-16 21:38:09', 1),
(27, 5, 3, 'i like that, but it so expensive for me', 3, '2023-11-16 21:39:23', 1),
(30, 4, 3, ' ** eshop ', 1, '2023-11-17 09:18:58', 1),
(31, 7, 6, 'good', 5, '2023-11-21 21:07:42', 1),
(32, 7, 2, 'good', 5, '2023-11-22 11:25:53', 1),
(33, 10, 10, '**** eshop', 4, '2023-11-22 12:01:39', 1),
(34, 4, 10, 'good', 4, '2023-11-22 12:04:02', 1),
(35, 7, 7, 'good', 5, '2023-11-22 12:10:29', 1),
(36, 7, 5, 'bad', 2, '2023-11-22 12:11:46', 1),
(37, 7, 4, 'i love that', 5, '2023-11-22 12:18:12', 1),
(38, 1, 13, '**** eshop', 1, '2023-11-30 11:02:00', 1),
(39, 1, 16, '******', 2, '2023-11-30 11:02:54', 1),
(40, 7, 8, 'good\n', 5, '2023-12-06 10:46:04', 1),
(42, 7, 20, '*****', 1, '2024-04-15 13:59:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(48) NOT NULL,
  `password` varchar(16) NOT NULL,
  `account` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(350) NOT NULL,
  `verify` int(11) NOT NULL,
  `type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `password`, `account`, `email`, `phone_number`, `status`, `image`, `verify`, `type`) VALUES
(1, 'customer1', 'mysql', 'customer1', 'khoapham1405@gmail.com', '', 1, 'accessories_beaniehat_1f1e23.jpg', 1, ''),
(2, 'customer2', 'mysql', 'customer2', '', '', 1, 'user.png', 0, ''),
(3, 'customer3', 'mysql', 'customer2', 'mnnd02062004@gmail.com', '', 1, 'user.png', 1, ''),
(4, 'cutomer3', 'mysql', 'customer3', '', '', 1, 'user.png', 0, ''),
(5, 'customer4', 'mysql', 'customer4', '', '', 1, 'user.png', 0, ''),
(6, 'Kiên Trần Nguyễn Trung', '1126189229750125', '112618922975012554016', '0306221243@caothang.edu.vn', '', 1, 'https://lh3.googleusercontent.com/a/ACg8ocJ9HnofF3OHv56Q-3vyQhRIMTUO3-bTEZpXKB6glqyWXQ=s96-c', 1, 'google'),
(7, 'Trung Kiên 12B7 Trần Nguyễn', '1070664897017248', '107066489701724854978', 'cristntk0162@gmail.com', '', 1, 'https://lh3.googleusercontent.com/a/ACg8ocIxUMiu-2OEc4BM4QycXwp7u36rqKYOGe0h5Tfgj9FMKCI=s96-c', 1, 'google'),
(8, 'ngọc diễm', '1046406382715820', '104640638271582039508', 'mnnd02062004@gmail.com', '', 1, 'avatar1667024822754-1667024823232811652161.webp', 1, 'google'),
(9, 'customer007', 'mysql', 'customer007', '', '', 1, 'user.png', 0, ''),
(10, 'Đinh Quang Vinh', '1135853665038172', '113585366503817258025', 'vinhbestyasuo@gmail.com', '', 1, 'https://lh3.googleusercontent.com/a/ACg8ocKltUragG9pk1hY5B43JZMNw9UfvpBxAjr5fvfRK2v3cOg=s96-c', 1, 'google'),
(11, 'namcute', 'mysql', 'nhatnamcute', 'nhatnam10904@gmail.com', '', 1, 'user.png', 1, ''),
(12, 'trungkien', 'mysql', 'trungkien', '', '', 1, 'user.png', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_location`
--

CREATE TABLE `customer_location` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `location` varchar(250) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_location`
--

INSERT INTO `customer_location` (`id`, `id_customer`, `location`, `status`) VALUES
(2, 1, '123, Pasteur street, District 1, HCM city ', 0),
(4, 1, '123, Pasteur, District 1, HCM city', 0),
(6, 1, '13, Pasteur, District 1, HCM city', 1),
(8, 2, '50, Go Dau, Tan Phu District, HCM city', 0),
(9, 2, 'Cao Thang College, District 1, HCM city', 0),
(10, 2, 'Nguyen Hue, District 1, HCM city', 1),
(11, 6, '50, Go Dau street, Tan Phu ward, HCM city', 1),
(12, 1, '100, Ni Su Huynh Lien street, Tan Phu ward, HCM city', 0),
(13, 7, '13, Pasteur, District 1, HCM City', 0),
(14, 1, 'binh dai, ben tre', 0),
(15, 7, '50, Go Dau, Tan Phu District, HCM City', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(12) NOT NULL,
  `size` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id`, `id_cart`, `id_customer`, `id_product`, `quantity`, `color`, `size`) VALUES
(1, 2, 1, 2, 1, 'bdab95', 'M'),
(2, 1, 2, 2, 3, 'bdab95', 'M'),
(4, 2, 1, 3, 1, '908b91', 'S'),
(5, 3, 1, 4, 1, '000', '37'),
(6, 4, 1, 4, 1, '000', '37'),
(7, 5, 1, 2, 1, 'bdab95', 'S'),
(8, 5, 1, 3, 1, '585848', 'M'),
(9, 6, 1, 4, 1, '7091b2', '41'),
(10, 2, 2, 2, 1, 'bdab95', 'S'),
(12, 2, 2, 2, 1, 'bdab95', 'M'),
(13, 1, 4, 2, 1, 'bdab95', 'S'),
(14, 3, 2, 3, 1, '585848', 'S'),
(15, 4, 2, 11, 3, '1b1716', 'S'),
(18, 1, 6, 8, 2, 'ccba9e', 'M'),
(19, 7, 1, 10, 1, '9aacc2', 'S'),
(20, 2, 6, 2, 1, '3a422b', 'S'),
(21, 2, 6, 9, 3, '0b2420', 'XL'),
(22, 2, 6, 11, 1, '1b1716', 'S'),
(23, 3, 6, 19, 1, '1b1b1b', ''),
(24, 8, 1, 7, 2, '3b472d', ''),
(26, 9, 1, 5, 102, '525252', 'S'),
(27, 9, 1, 6, 1, '000', ''),
(28, 9, 1, 7, 3, '3b472d', ''),
(29, 10, 1, 7, 1, '3b472d', ''),
(30, 3, 6, 2, 1, 'bdab95', 'S'),
(31, 3, 6, 9, 1, '0b2420', 'XL'),
(32, 10, 1, 11, 3, '1a3751', 'L'),
(33, 1, 7, 20, 4, '000', 'M'),
(34, 2, 7, 5, 1, '525252', 'XL'),
(35, 2, 7, 8, 1, 'ccba9e', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `image_store`
--

CREATE TABLE `image_store` (
  `id_image` varchar(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `color` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_store`
--

INSERT INTO `image_store` (`id_image`, `url`, `color`) VALUES
('accessories_beaniehat_1f1e23.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620542/uploads/product/accessories_beaniehat_1f1e23.jpg.jpg', '000'),
('accessories_beaniehat_9da3ad.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620544/uploads/product/accessories_beaniehat_9da3ad.jpg.jpg', '999'),
('accessories_totebag_4b5a40.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620544/uploads/product/accessories_totebag_4b5a40.jpg.jpg', '3b472d'),
('backpack.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620545/uploads/product/backpack.jpg.jpg', 'fff'),
('jacket_bomber_7a5c40.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620546/uploads/product/jacket_bomber_7a5c40.jpg.jpg', '795a3d'),
('jacket_bomber_dbccb3.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620546/uploads/product/jacket_bomber_dbccb3.jpg.jpg', 'ccba9e'),
('jacket_denim_989898.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620549/uploads/product/jacket_denim_989898.jpg.jpg', '525252'),
('jacket_varsity_102523.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620549/uploads/product/jacket_varsity_102523.jpg.jpg', '0b2420'),
('jacket_varsity_24253a.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620550/uploads/product/jacket_varsity_24253a.jpg.jpg', '292d44'),
('jeans_flared_21232e.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620551/uploads/product/jeans_flared_21232e.jpg.jpg', '1f212d'),
('jeans_flared_a1b3c6.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620551/uploads/product/jeans_flared_a1b3c6.jpg.jpg', '9aacc2'),
('jeans_skinny_1b1716.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620552/uploads/product/jeans_skinny_1b1716.jpg.jpg', '1b1716'),
('jeans_skinny_2d4c64.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620553/uploads/product/jeans_skinny_2d4c64.jpg.jpg', '1a3751'),
('jeans_straightlegs_262739.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620554/uploads/product/jeans_straightlegs_262739.jpg.jpg', '272938'),
('jeans_straightlegs_586e8b.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620554/uploads/product/jeans_straightlegs_586e8b.jpg.jpg', '4e617f'),
('jeans_tapered_45596a.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620555/uploads/product/jeans_tapered_45596a.jpg.jpg', '788990'),
('jeans_tapered_a7b5b8.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620556/uploads/product/jeans_tapered_a7b5b8.jpg.jpg', 'c4cccd'),
('shirt_denim_c0d0e0.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620557/uploads/product/shirt_denim_c0d0e0.jpg.jpg', 'c5d7e5'),
('shirt_flannel_1d1c1f.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620558/uploads/product/shirt_flannel_1d1c1f.jpg.jpg', '212123'),
('shirt_flannel_2d3a3b.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620559/uploads/product/shirt_flannel_2d3a3b.jpg.jpg', '2b3837'),
('shirt_henley_45556e.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620559/uploads/product/shirt_henley_45556e.jpg.jpg', '5b6d89'),
('shirt_henley_4f4f51.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620560/uploads/product/shirt_henley_4f4f51.jpg.jpg', '575759'),
('shirt_polo_4e4b66.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620561/uploads/product/shirt_polo_4e4b66.jpg.jpg', '4f4f67'),
('shirt_polo_cad0c9.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620562/uploads/product/shirt_polo_cad0c9.jpg.jpg', 'c9d1c8'),
('sneaker_adidasstansmith_323656.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620563/uploads/product/sneaker_adidasstansmith_323656.jpg.jpg', '000'),
('sneaker_adidasstansmith_658094.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620563/uploads/product/sneaker_adidasstansmith_658094.jpg.jpg', '7091b2'),
('sweatshirts_zipup_1b1b1d.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620564/uploads/product/sweatshirts_zipup_1b1b1d.jpg.jpg', '1b1b1b'),
('sweatshirts_zipup_b6b6b6.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620565/uploads/product/sweatshirts_zipup_b6b6b6.jpg.jpg', 'bebebe'),
('trousers_cargopants_62644f.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620565/uploads/product/trousers_cargopants_62644f.jpg.jpg', '585848'),
('trousers_cargopants_a49fa5.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620566/uploads/product/trousers_cargopants_a49fa5.jpg.jpg', '908b91'),
('tshirt_ringer_292728.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1703571113/uploads/product/tshirt_ringer_292728.jpg.jpg', '000'),
('tshirt_ringer_e7e7f2.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1703571114/uploads/product/tshirt_ringer_e7e7f2.jpg.jpg', 'fff'),
('tshirt_solid_3d452f.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620567/uploads/product/tshirt_solid_3d452f.jpg.jpg', '3a422b'),
('tshirt_solid_b3a18d.jpg', 'http://res.cloudinary.com/dwewnjnbm/image/upload/v1701620567/uploads/product/tshirt_solid_b3a18d.jpg.jpg', 'bdab95');

-- --------------------------------------------------------

--
-- Table structure for table `language_filter`
--

CREATE TABLE `language_filter` (
  `unvalid_string` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `language_filter`
--

INSERT INTO `language_filter` (`unvalid_string`) VALUES
('bitch'),
('dick'),
('fuck'),
('fuckkk'),
('gay'),
('motherfucker'),
('sex');

-- --------------------------------------------------------

--
-- Table structure for table `new_product`
--

CREATE TABLE `new_product` (
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_product`
--

INSERT INTO `new_product` (`id_product`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(8),
(12),
(14),
(16),
(17),
(20);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_customer` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `location` varchar(250) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `receiver` varchar(32) NOT NULL,
  `cost` float NOT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_customer`, `id_cart`, `status`, `location`, `phone_number`, `receiver`, `cost`, `create_date`) VALUES
(2, 1, 4, 'Cao Thang College, District 1, HCM City', '0909691405', 'customer2', 40.5, '2023-11-15'),
(3, 1, 0, '', '', '', 0, '2023-11-14'),
(4, 1, 0, '', '', '', 0, NULL),
(5, 1, 0, '', '', '', 0, NULL),
(6, 1, 4, '50, Go Dau street, Tan Phu ward, HCM city', '0369344077', 'Kiên Trần Nguyễn Trung', 56, '2023-11-24'),
(7, 1, 1, '50, Go Dau, Tan Phu District, HCM City', '0369344077', 'Trung Kiên 12B7 Trần Nguyễn', 72, '2024-04-15'),
(8, 1, 0, '', '', '', 0, NULL),
(9, 1, 0, '', '', '', 0, NULL),
(10, 1, 0, '', '', '', 0, NULL),
(11, 1, 0, '', '', '', 0, NULL),
(12, 1, 0, '', '', '', 0, NULL),
(1, 2, 1, 'binh dai, ben tre', '0369044077', 'Trung Kien', 27, '2023-11-14'),
(2, 2, 1, 'Cao Thang College, District 1, HCM City', '0369344077', 'customer2', 27, '2023-11-15'),
(6, 2, 4, '50, Go Dau street, Tan Phu ward, HCM city', '0369344077', 'Kiên Trần Nguyễn Trung', 168.6, '2023-12-03'),
(7, 2, 0, '', '', '', 0, NULL),
(1, 3, 4, '13, Pasteur, District 1, HCM City', '0969194333', 'customer1', 48, '2023-11-14'),
(2, 3, 1, 'Nguyen Hue, District 1, HCM City', '464', 'customer2', 27, '2023-11-16'),
(6, 3, 1, '50, Go Dau street, Tan Phu ward, HCM city', '0306221243', 'Kiên Trần Nguyễn Trung', 103.5, '2023-12-10'),
(1, 4, 5, '25, Go Dau, Tan Phu District, HCM City', '0369344077', 'customer1', 48, '2023-11-14'),
(2, 4, 0, '', '', '', 0, NULL),
(6, 4, 0, '', '', '', 0, NULL),
(1, 5, 4, '123, Pasteur, District 1, HCM City', '0969194333', 'customer1', 40.5, '2023-11-14'),
(1, 6, 5, '123, Pasteur, District 1, HCM City', '0369344077', 'customer1', 47.5, '2023-11-14'),
(1, 7, 4, '100, Ni Su Huynh Lien street, Tan Phu ward, HCM City', '0369344077', 'customer1', 25, '2023-11-27'),
(1, 8, 2, '123, Pasteur, District 1, HCM City', '0369044077', 'customer1', 10, '2023-12-06'),
(1, 9, 5, '123, Pasteur, District 1, HCM City', '123', 'customer1', 3256.6, '2023-12-06'),
(1, 10, 1, '13, Pasteur, District 1, HCM city', '0369344077', 'customer1', 110.3, '2023-12-26'),
(1, 11, 0, '', '', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `id_type` varchar(6) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` float NOT NULL,
  `content` varchar(500) NOT NULL,
  `star` float NOT NULL,
  `review` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `id_type`, `quantity`, `cost`, `content`, `star`, `review`, `status`) VALUES
(1, 'backpack', 'acc', 150, 20, 'sgadrhtsjrstjrtteyktek', 5, 0, 0),
(2, 'solid t-shirt', 't-s', 194, 15, 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar. T-shirts are generally made of stretchy, light, and inexpensive fabric and are easy to clean. The T-shirt evolved from undergarments used in the 19th century and, in the mid-20th century, transitioned from undergarments to general-use casual clothing.', 3.4, 5, 1),
(3, 'cargo pant', 'tro', 199, 30, 'A cargo pocket is a form of a patch pocket, often with accordion folds for increased capacity closed with a flap secured by snap, button, magnet, or Velcro common on battledress and hunting clothing. In some designs, cargo pockets may be hidden within the legs.', 3, 4, 1),
(4, 'adidas stan smith', 'sne', 199, 50, 'Adidas Stan Smith is a tennis shoe made by Adidas, and first launched in 1965. Originally named \"Adidas Robert Haillet\" after the brand endorsed French prominent player Robert Haillet, in 1978 the sneakers were renamed after Stan Smith, an American tennis player who was active between the end of the 1960s and the beginning of the 1980s.', 4.3, 4, 1),
(5, 'jacket denim', 'jac', 500, 35, 'A denim jacket, also called a jean jacket or trucker jacket, is a jacket made from denim. Introduced in the United States in the late 19th century, it has been a popular type of casual apparel with both men and women and has been described as an iconic element of American fashion. Though a staple of western wear, the denim jacket has also enjoyed a more general appeal.', 3.4, 6, 1),
(6, 'beanie hat', 'acc', 50, 100, 'In Australia, New Zealand, the United States, the United Kingdom and elsewhere, a beanie is a head-hugging brimless cap, sometimes made from triangular panels of material joined by a button at the crown and seamed together around the sides. Beanies may be made of cloth, felt, wool, leather, or silk. In many US regions and parts of Canada the term \"beanie\" refers to a knitted cap (often woollen), alternately called a \"stocking cap\" or (especially in Canada) a \"toque\".', 3, 3, 0),
(7, 'tote bag', 'acc', 100, 5, 'A tote bag is a large, typically unfastened bag with parallel handles that emerge from the sides of its pouch.\r\n\r\nTotes are often used as reusable shopping bags. The archetypal tote bag is made of sturdy cloth, perhaps with thick leather at its handles or bottom; leather versions often have a pebbled surface. Fabrics include natural canvas and jute, or nylon and other easy-care synthetics. These may degrade with prolonged exposure to sunlight. Many low-cost totes are made from recycled matter, f', 5, 1, 1),
(8, 'jacket bomber', 'jac', 53, 35, 'A flight jacket is a casual jacket that was originally created for pilots and eventually became part of popular culture and apparel. It has evolved into various styles and silhouettes, including the \"letterman\" jacket and the fashionable \"bomber\" jacket that is known today.', 5, 1, 1),
(9, 'jacket varsity', 'jac', 97, 40, 'When it comes to timeless fashion, one trend that continues to stand out is the classic varsity jacket from FJackets. Originally worn by athletes to showcase their team spirit, these jackets have evolved into a symbol of style, individuality, and a hint of nostalgia. From the iconic blue varsity jacket to the trendy black and red combination, there is a wide array of options to choose from. In this blog, we will explore some of the top varsity jackets available in the market today, highlighting ', 0, 0, 1),
(10, 'jeans flared', 'jea', 89, 25, 'Bell-bottoms (or flares) are a style of trousers that become wider from the knees downward, forming a bell-like shape of the trouser leg.', 4, 3, 1),
(11, 'jeans skinny', 'jea', 199, 39, 'Slim-fit pants or skinny jeans (when made of denim) are tight trousers that have a snug fit through the legs and end in a small leg opening that can be anywhere from 9\" to 20\" in circumference, depending on size. Other names for this style include drainpipes, stovepipes, tight pants, cigarette pants, pencil pants, skinny pants, gas pipes, skinnies, and tight jeans.', 0, 0, 1),
(12, 'jeans straightleg', 'shi', 50, 29, '\"Jean\" also references a (historic) type of sturdy cloth commonly made with a cotton warp and wool weft (also known as \"Virginia cloth\"). Jean cloth can be entirely cotton as well, similar to denim.', 0, 0, 1),
(13, 'jeans tapered', 'jea', 100, 39, 'Tapered is a jeans fit having a tapered leg that gradually gets narrower as it gets to the ankle. The width of the calf is thinner than the knee\'s. The design on the crotch area follows the shape of your body.', 1, 1, 1),
(14, 'shirt denim', 'shi', 150, 15, 'Denim is available in a range of colors, but the most common denim is indigo denim in which the warp thread is dyed while the weft thread is left white. ', 0, 0, 1),
(15, 'shirt flannel', 'shi', 200, 28, 'Flannel is a soft woven fabric, of varying fineness. Flannel was originally made from carded wool or worsted yarn, but is now often made from either wool, cotton, or synthetic fiber. Flannel is commonly used to make tartan clothing, blankets, bed sheets, and sleepwear.', 0, 0, 1),
(16, 'shirt henley', 'shi', 190, 21, 'A Henley shirt is a collarless pullover shirt, characterized by a round neckline and a placket about 3 to 5 inches (8 to 13 cm) long and usually having 2–5 buttons. It essentially is a collarless polo shirt. The sleeves may be either short or long, and it can be made in almost any fabric, although cotton, cotton-polyester blends, and thermals are by far the most popular.', 2, 1, 1),
(17, 'shirt polo', 'shi', 110, 18, 'Polo shirts are usually made of knitted cotton (rather than woven cloth), usually a piqué knit, or less commonly an interlock knit (the latter used frequently, though not exclusively, with pima cotton polos), or using other fibers such as silk, wool, synthetic fibers, or blends of natural and synthetic fibers. ', 4, 0, 0),
(19, 'sweatshirts zipup', 'swe', 100, 50, 'A sweatshirt is a long-sleeved pullover shirt or jacket fashioned out of thick, usually cotton, cloth material. Sweatshirts are almost exclusively casual attire and hence not as formal as some sweaters. Sweatshirts may or may not have a hood. A sweatshirt with a hood is now usually referred to as a hoodie, although more formal media still use the term \"hooded sweatshirt\".', 0, 0, 1),
(20, 't-shirt ringer', 't-s', 100, 20, 'A T-shirt with thin bands of contrasting color around the collar and the lower edges of the sleeves.', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` varchar(6) NOT NULL,
  `name_type` varchar(32) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name_type`, `image`, `status`) VALUES
('acc', 'accsessories', 'accessories.png', 1),
('jac', 'jacket', 'jacket.png', 1),
('jea', 'jeans', 'jeans.png', 1),
('shi', 'shirt', 'shirt.png', 1),
('sne', 'sneaker', 'sneaker.png', 1),
('swe', 'sweatshirts', 'sweatshirts.png', 1),
('t-s', 't-shirt', 'tshirt.png', 1),
('tro', 'trousers', 'trousers.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id_product` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id_product`, `discount`) VALUES
(1, 5),
(2, 10),
(3, 10),
(4, 5),
(5, 12),
(8, 20),
(11, 10),
(12, 5),
(13, 25),
(15, 5),
(20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `size_list`
--

CREATE TABLE `size_list` (
  `size` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size_list`
--

INSERT INTO `size_list` (`size`) VALUES
(''),
('37'),
('38'),
('39'),
('40'),
('41'),
('42'),
('43'),
('L'),
('M'),
('S'),
('XL'),
('XS'),
('XXL');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `account` varchar(32) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `password`, `email`, `account`, `phone_number`, `status`, `image`) VALUES
(1, 'staff1', 'mysql', '', 'staff1', '', 1, 'staff.png');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `account` varchar(32) NOT NULL,
  `password` varchar(16) NOT NULL,
  `role` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`account`, `password`, `role`) VALUES
('superadmin', 'mysql', 'super admin');

-- --------------------------------------------------------

--
-- Table structure for table `trending_product`
--

CREATE TABLE `trending_product` (
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trending_product`
--

INSERT INTO `trending_product` (`id_product`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(14),
(15),
(17),
(20);

-- --------------------------------------------------------

--
-- Table structure for table `using_image_product`
--

CREATE TABLE `using_image_product` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `using_image_product`
--

INSERT INTO `using_image_product` (`id`, `id_product`, `id_image`) VALUES
(1, 1, 'backpack.jpg'),
(2, 2, 'tshirt_solid_b3a18d.jpg'),
(3, 2, 'tshirt_solid_3d452f.jpg'),
(4, 3, 'trousers_cargopants_62644f.jpg'),
(5, 3, 'trousers_cargopants_a49fa5.jpg'),
(6, 4, 'sneaker_adidasstansmith_323656.jpg'),
(7, 4, 'sneaker_adidasstansmith_658094.jpg'),
(8, 5, 'jacket_denim_989898.jpg'),
(10, 6, 'accessories_beaniehat_1f1e23.jpg'),
(12, 7, 'accessories_totebag_4b5a40.jpg'),
(13, 8, 'jacket_bomber_7a5c40.jpg'),
(14, 8, 'jacket_bomber_dbccb3.jpg'),
(15, 9, 'jacket_varsity_24253a.jpg'),
(16, 9, 'jacket_varsity_102523.jpg'),
(17, 10, 'jeans_flared_a1b3c6.jpg'),
(18, 10, 'jeans_flared_21232e.jpg'),
(19, 11, 'jeans_skinny_1b1716.jpg'),
(20, 11, 'jeans_skinny_2d4c64.jpg'),
(21, 12, 'jeans_straightlegs_586e8b.jpg'),
(22, 12, 'jeans_straightlegs_262739.jpg'),
(23, 13, 'jeans_tapered_45596a.jpg'),
(24, 13, 'jeans_tapered_a7b5b8.jpg'),
(25, 14, 'shirt_denim_c0d0e0.jpg'),
(26, 15, 'shirt_flannel_1d1c1f.jpg'),
(27, 15, 'shirt_flannel_2d3a3b.jpg'),
(28, 16, 'shirt_henley_4f4f51.jpg'),
(29, 16, 'shirt_henley_45556e.jpg'),
(30, 17, 'shirt_polo_4e4b66.jpg'),
(31, 17, 'shirt_polo_cad0c9.jpg'),
(35, 19, 'sweatshirts_zipup_1b1b1d.jpg'),
(36, 19, 'sweatshirts_zipup_b6b6b6.jpg'),
(37, 20, 'tshirt_ringer_292728.jpg'),
(38, 20, 'tshirt_ringer_e7e7f2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `using_size_list`
--

CREATE TABLE `using_size_list` (
  `id_size` varchar(12) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `using_size_list`
--

INSERT INTO `using_size_list` (`id_size`, `id_product`, `id`) VALUES
('', 1, 1),
('S', 2, 2),
('M', 2, 3),
('L', 2, 4),
('S', 3, 5),
('M', 3, 6),
('L', 3, 7),
('37', 4, 8),
('38', 4, 9),
('39', 4, 10),
('40', 4, 11),
('41', 4, 12),
('42', 4, 13),
('43', 4, 14),
('S', 5, 15),
('M', 5, 16),
('L', 5, 17),
('XL', 5, 18),
('', 6, 19),
('', 7, 20),
('S', 8, 21),
('M', 8, 22),
('S', 9, 23),
('M', 9, 24),
('L', 9, 25),
('XL', 9, 26),
('XS', 10, 27),
('S', 10, 28),
('M', 10, 29),
('L', 10, 30),
('S', 11, 31),
('M', 11, 32),
('L', 11, 33),
('XL', 11, 34),
('XXL', 11, 35),
('S', 12, 36),
('M', 12, 37),
('L', 12, 38),
('XL', 12, 39),
('XS', 13, 40),
('S', 13, 41),
('M', 13, 42),
('S', 14, 43),
('M', 14, 44),
('L', 14, 45),
('XL', 14, 46),
('S', 15, 47),
('M', 15, 48),
('L', 15, 49),
('XL', 15, 50),
('S', 16, 51),
('M', 16, 52),
('L', 16, 53),
('M', 17, 54),
('L', 17, 55),
('XL', 17, 56),
('S', 19, 62),
('M', 19, 63),
('L', 19, 64),
('XL', 19, 65),
('S', 20, 66),
('M', 20, 67),
('L', 20, 68);

-- --------------------------------------------------------

--
-- Table structure for table `verify_code`
--

CREATE TABLE `verify_code` (
  `email` varchar(32) NOT NULL,
  `code` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify_code`
--

INSERT INTO `verify_code` (`email`, `code`) VALUES
('cutohaynho386@gmail.com', '051ab5'),
('huy61915@gmail.com', 'bb0a57'),
('mnnd02062004@gmail.com', '93e7e0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conmment_product` (`id_product`),
  ADD KEY `fk_comment_customer` (`id_customer`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_location`
--
ALTER TABLE `customer_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_location` (`id_customer`);

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_order_product` (`id_product`),
  ADD KEY `fk_detail_order_orders` (`id_customer`,`id_cart`);

--
-- Indexes for table `image_store`
--
ALTER TABLE `image_store`
  ADD PRIMARY KEY (`id_image`);

--
-- Indexes for table `language_filter`
--
ALTER TABLE `language_filter`
  ADD PRIMARY KEY (`unvalid_string`);

--
-- Indexes for table `new_product`
--
ALTER TABLE `new_product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_cart`,`id_customer`),
  ADD KEY `fk_orders_cart` (`id_customer`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_product_type` (`id_type`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `size_list`
--
ALTER TABLE `size_list`
  ADD PRIMARY KEY (`size`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trending_product`
--
ALTER TABLE `trending_product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `using_image_product`
--
ALTER TABLE `using_image_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_using_image_product_product` (`id_product`),
  ADD KEY `fk_using_image_product_image_store` (`id_image`);

--
-- Indexes for table `using_size_list`
--
ALTER TABLE `using_size_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_using_size_list_size_list` (`id_size`),
  ADD KEY `fk_using_size_list_product` (`id_product`);

--
-- Indexes for table `verify_code`
--
ALTER TABLE `verify_code`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer_location`
--
ALTER TABLE `customer_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `using_image_product`
--
ALTER TABLE `using_image_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `using_size_list`
--
ALTER TABLE `using_size_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `fk_conmment_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `customer_location`
--
ALTER TABLE `customer_location`
  ADD CONSTRAINT `fk_customer_location` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);

--
-- Constraints for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `fk_detail_order_orders` FOREIGN KEY (`id_customer`,`id_cart`) REFERENCES `orders` (`id_customer`, `id_cart`),
  ADD CONSTRAINT `fk_detail_order_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `new_product`
--
ALTER TABLE `new_product`
  ADD CONSTRAINT `fk_new_product_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_cart` FOREIGN KEY (`id_customer`) REFERENCES `cart` (`id_customer`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product_type` FOREIGN KEY (`id_type`) REFERENCES `product_type` (`id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `fk_sale_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `trending_product`
--
ALTER TABLE `trending_product`
  ADD CONSTRAINT `fk_trending_product_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `using_image_product`
--
ALTER TABLE `using_image_product`
  ADD CONSTRAINT `fk_using_image_product_image_store` FOREIGN KEY (`id_image`) REFERENCES `image_store` (`id_image`),
  ADD CONSTRAINT `fk_using_image_product_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `using_size_list`
--
ALTER TABLE `using_size_list`
  ADD CONSTRAINT `fk_using_size_list_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_using_size_list_size_list` FOREIGN KEY (`id_size`) REFERENCES `size_list` (`size`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
