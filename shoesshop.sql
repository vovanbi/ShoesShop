-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2020 at 01:45 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoesshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `address`, `email`, `password`, `phone`, `created_at`, `updated_at`) VALUES
(12, 'Nguyễn Phúc Hưng', '459 Tôn Đức Thắng, Hoà Khánh Nam, Liên Chiểu, Đà Nẵng', 'ShoesShop.UED@gmail.com', '658a27dfe04c2262b3c30adf816722db', '0528152815', '2020-07-14 10:25:51', '2020-11-30 12:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `banner`, `home`, `created_at`, `updated_at`) VALUES
(1, 'Adidas', 'adidas', 'Adidas.jpg', 1, '2020-07-11 06:30:12', '2020-07-22 09:11:31'),
(2, 'Nike', 'nike', 'Nike.jpg', 1, '2020-07-11 06:30:30', '2020-07-22 09:11:46'),
(3, 'Puma', 'puma', 'Puma.jpg', 1, '2020-07-11 06:30:40', '2020-07-22 09:11:58'),
(4, 'Balenciaga', 'balenciaga', 'Balenciaga.jpg', 1, '2020-07-11 06:30:47', '2020-07-22 09:12:11'),
(5, 'Converse', 'converse', 'Converse.jpg', 1, '2020-07-11 06:30:54', '2020-07-22 09:12:22'),
(6, 'Fila', 'fila', 'Fila.jpg', 1, '2020-07-11 06:31:01', '2020-07-22 09:12:43'),
(7, 'Phụ kiện', 'phu-kien', 'phukien.jpg', 0, '2020-07-23 03:51:10', '2020-12-21 11:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` tinyint(4) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `product_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(74, 69, 34, 1, '2300000', '2020-12-21 07:18:36', '2020-12-21 07:18:36'),
(75, 70, 34, 1, '2300000', '2020-12-21 07:28:12', '2020-12-21 07:28:12'),
(76, 70, 47, 2, '70000', '2020-12-21 07:28:12', '2020-12-21 07:28:12'),
(77, 71, 47, 2, '70000', '2020-12-21 07:45:02', '2020-12-21 07:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale` tinyint(4) DEFAULT 0,
  `thumbar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(20) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `number` int(100) DEFAULT NULL,
  `buy` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `price`, `sale`, `thumbar`, `category_id`, `content`, `created_at`, `updated_at`, `number`, `buy`) VALUES
(15, 'Giày Adidas Edge Runner', 'giay-adidas-edge-runner', '1100000', 10, '5.jpg', 1, ' Hàng chất lượng', '2020-07-16 11:15:08', '2020-12-12 15:09:18', 79, 14),
(16, 'Giày Adidas Equipment Running Support 93 Eqt', 'giay-adidas-equipment-running-support-93-eqt', '1600000', 10, '6.jpg', 1, ' Hàng đẹp chất lượng cao', '2020-07-16 11:16:06', '2020-12-12 15:09:18', 93, 7),
(17, 'Giày Adidas X_PLR', 'giay-adidas-xplr', '900000', 10, '7.jpg', 1, ' Hàng chất lượng giá rẻ', '2020-07-16 11:17:03', '2020-12-12 15:09:18', 90, 10),
(19, 'Giày Nike Air Force 1 Mid 07 Black and White', 'giay-nike-air-force-1-mid-07-black-and-white', '2100000', 10, '23.jpg', 2, 'Hàng đẹp chất lượng', '2020-07-19 17:02:19', '2020-10-26 03:01:59', 100, 0),
(20, 'Giày Nike Air Force 1 Premium Low Burgundy Ash Celestine Blue', 'giay-nike-air-force-1-premium-low-burgundy-ash-celestine-blue', '1400000', 10, '24.jpg', 2, ' Hàng mới', '2020-07-19 17:04:37', '2020-10-26 03:02:10', 100, 0),
(21, 'Giày Adidas AlphaBounce', 'giay-adidas-alphabounce', '1400000', 10, '3.jpg', 1, 'Hàng đẹp', '2020-07-19 17:07:43', '2020-12-12 15:09:18', 92, 8),
(22, 'Giày Nike Air Jordan 1 Ret Hi Prem Mid', 'giay-nike-air-jordan-1-ret-hi-prem-mid', '1100000', 0, '25.jpg', 2, 'Hàng đẹp', '2020-07-19 17:08:45', '2020-10-26 03:02:20', 100, 0),
(23, 'Giày Nike Wmns Air Force 107', 'giay-nike-wmns-air-force-107', '1800000', 0, '26.jpg', 2, 'Hàng chất lượng cao', '2020-07-19 17:10:43', '2020-10-26 03:02:51', 100, 0),
(24, 'Nike Air Jordan 13 Premio Bin Limited Wine Red', 'nike-air-jordan-13-premio-bin-limited-wine-red', '3500000', 10, '33.jpg', 2, 'Hàng chất lượng cao', '2020-07-19 17:11:22', '2020-10-26 03:03:49', 100, 0),
(25, 'Giày Nữ PUMA Rihanna 2020', 'giay-nu-puma-rihanna-2020', '800000', 0, '27.jpg', 3, 'Hàng chất lượng cao', '2020-07-19 17:12:07', '2020-10-26 03:03:07', 100, 0),
(26, 'Giày PUMA Cali Taped', 'giay-puma-cali-taped', '1200000', 10, '28.jpg', 3, 'Hàng chất lượng cao', '2020-07-19 17:12:31', '2020-10-26 03:03:15', 100, 0),
(27, 'Giày Puma California Vintage', 'giay-puma-california-vintage', '900000', 0, '29.jpg', 3, 'Hàng chất lượng cao', '2020-07-19 17:12:55', '2020-10-26 03:03:20', 100, 0),
(28, 'Giày Puma Han Kjobenhavn X Puma Clyde Stitched', 'giay-puma-han-kjobenhavn-x-puma-clyde-stitched', '2200000', 10, '30.jpg', 3, 'Hàng chất lượng cao', '2020-07-19 17:13:22', '2020-10-26 03:03:28', 100, 0),
(29, 'Giày Sue Tsai x PUMA Cali Women\'s Leather JG Y3', 'giay-sue-tsai-x-puma-cali-womens-leather-jg-y3', '3300000', 0, '31.jpg', 3, 'Hàng chất lượng cao', '2020-07-19 17:13:50', '2020-10-26 03:03:35', 100, 0),
(30, 'Puma LQD OMEGA DENSITY', 'puma-lqd-omega-density', '2500000', 10, '34.jpg', 3, ' Hàng chất lượng cao', '2020-07-19 17:14:14', '2020-10-26 03:04:01', 100, 0),
(32, 'Giày Balenciaga Cao Cổ', 'giay-balenciaga-cao-co', '900000', 0, '10.jpg', 4, 'Hàng chất lượng cao', '2020-07-19 17:15:39', '2020-10-26 03:00:35', 100, 0),
(33, 'Giày Balenciaga Sneaker Tess sGomma MAILLE WHITEORANGE', 'giay-balenciaga-sneaker-tess-sgomma-maille-whiteorange', '2200000', 0, '11.jpg', 4, 'Hàng chất lượng cao', '2020-07-19 17:16:09', '2020-12-13 18:18:08', 99, 1),
(34, 'Giày Converse Chuck Taylor 1970 Suede', 'giay-converse-chuck-taylor-1970-suede', '2300000', 0, '12.jpg', 5, 'Hàng chất lượng cao', '2020-07-19 17:16:39', '2020-12-21 07:32:18', 98, 2),
(35, 'Giày Converse GaibangxikirCarhartt Wip x Converse Converse Chuck 70', 'giay-converse-gaibangxikircarhartt-wip-x-converse-converse-chuck-70', '1400000', 10, '13.jpg', 5, ' Hàng chất lượng cao', '2020-07-19 17:17:05', '2020-10-26 03:00:52', 100, 0),
(36, 'Giày Converse I Stand For', 'giay-converse-i-stand-for', '800000', 10, '14.jpg', 5, ' Hàng chất lượng cao', '2020-07-19 17:17:42', '2020-10-26 03:01:01', 100, 0),
(37, 'Giày Converse One Star', 'giay-converse-one-star', '700000', 0, '15.jpg', 5, 'Hàng chất lượng cao', '2020-07-19 17:18:04', '2020-10-26 03:01:06', 100, 0),
(38, 'Giày Converse REACT Lunarlon', 'giay-converse-react-lunarlon', '1900000', 0, '16.jpg', 5, 'Hàng chất lượng cao', '2020-07-19 17:18:39', '2020-10-26 03:01:12', 100, 0),
(39, 'Giày Fila  OAKMONT', 'giay-fila-oakmont', '4200000', 1, '17.jpg', 6, 'Hàng chất lượng cao', '2020-07-19 17:19:17', '2020-10-26 03:01:19', 100, 0),
(40, 'Giày FILA Disruptor 2 Pink', 'giay-fila-disruptor-2-pink', '1500000', 10, '18.jpg', 6, 'Hàng chất lượng cao', '2020-07-19 17:20:09', '2020-10-26 14:44:06', 100, 0),
(41, 'Giày FILA Fei Le Ray Tracer UNISEX Tracker Retro', 'giay-fila-fei-le-ray-tracer-unisex-tracker-retro', '2200000', 0, '19.jpg', 6, 'Hàng chất lượng cao', '2020-07-19 17:20:37', '2020-10-26 03:01:33', 100, 0),
(42, 'Giày Fila Fusion Jagger', 'giay-fila-fusion-jagger', '900000', 0, '20.jpg', 6, 'Hàng chất lượng cao', '2020-07-19 17:20:55', '2020-10-26 03:01:39', 100, 0),
(43, 'Giày Fila Fusioncage', 'giay-fila-fusioncage', '1650000', 0, '21.jpg', 6, 'Hàng chất lượng cao', '2020-07-19 17:21:24', '2020-10-26 03:01:45', 100, 0),
(44, 'Giày FILA JAGGER', 'giay-fila-jagger', '3650000', 10, '22.jpg', 6, ' Hàng chất lượng cao', '2020-07-19 17:21:46', '2020-10-26 03:01:51', 100, 0),
(45, 'Tất Dài OFF WHITE', 'tat-dai-off-white', '200000', 0, '35.jpg', 7, 'Hàng chất lượng cao', '2020-07-23 04:34:40', '2020-10-26 03:04:09', 100, 0),
(46, 'Tất Dài OFF WHITE Quân Sự', 'tat-dai-off-white-quan-su', '200000', 0, '36.jpg', 7, ' Hàng chất lượng cao', '2020-07-23 04:35:07', '2020-10-26 03:04:15', 100, 0),
(47, 'Tất Vớ Nam/Nữ 2 Màu Sọc Kẻ P198', 'tat-vo-namnu-2-mau-soc-ke-p198', '70000', 0, '38.jpg', 7, 'Hàng chất lượng cao', '2020-07-23 04:37:53', '2020-12-21 07:45:58', 96, 3),
(48, 'Tất Ngắn P20', 'tat-ngan-p20', '30000', 0, '37.jpg', 7, 'Hàng chất lượng cao', '2020-07-23 04:38:47', '2020-10-26 03:04:21', 100, 0),
(49, 'Hộp 10 đôi tất Nhật', 'hop-10-doi-tat-nhat', '250000', 0, '32.jpg', 7, 'Hàng chất lượng cao', '2020-07-23 04:39:42', '2020-10-26 03:03:44', 100, 0),
(50, 'Chai Xịt Nano Chống Thấm Giày', 'chai-xit-nano-chong-tham-giay', '220000', 10, '1.jpg', 7, 'Hàng chất lượng cao', '2020-07-23 04:40:17', '2020-12-17 05:46:56', 97, 3),
(51, 'Chai Xịt Tạo Bọt Vệ Sinh Giày 3M Scotchgard', 'chai-xit-tao-bot-ve-sinh-giay-3m-scotchgard', '220000', 10, '2.jpg', 7, 'Hàng chất lượng cao', '2020-07-23 04:40:48', '2020-12-12 15:19:30', 86, 8),
(52, 'Giày Adidas Alphabounce Instinct CC', 'giay-adidas-alphabounce-instinct-cc', '1400000', 10, '4.jpg', 1, '    Hàng chất lượng cao', '2020-07-11 06:31:55', '2020-10-26 02:58:54', 100, 2),
(53, 'Giày BALENCIAGA Basirka Triple S', 'giay-balenciaga-basirka-triple-s', '6500000', 10, '9.jpg', 4, 'Hàng chất lượng cao', '2020-07-19 17:15:21', '2020-12-12 15:09:18', 82, 18),
(54, 'Giày Adidas Yeezy 350 Boost V2 Antlia', 'giay-adidas-yeezy-350-boost-v2-antlia', '7000000', 10, '8.jpg', 1, 'Vải đẹp chất lượng', '2020-07-19 17:01:02', '2020-12-13 18:17:44', 91, 9);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `users_id`, `product_id`, `note`, `created_at`) VALUES
(7, 3, 17, 'Giày đẹp chất lượng, rất vừa ý mình', '2020-11-11 05:44:50'),
(9, 3, 53, 'Giày đẹp\r\n', '2020-11-21 02:42:23'),
(12, 3, 53, 'Hàng chất lượng cao', '2020-11-21 02:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `note` text DEFAULT NULL,
  `type` tinyint(4) DEFAULT 0,
  `vnp_BankCode` varchar(20) DEFAULT NULL,
  `vnp_BankTranNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `amount`, `users_id`, `status`, `created_at`, `updated_at`, `note`, `type`, `vnp_BankCode`, `vnp_BankTranNo`) VALUES
(69, 2300000, 3, 1, '2020-12-21 07:18:36', '2020-12-21 07:29:50', '123', 1, 'NCB', 2147483647),
(70, 2440000, 3, 1, '2020-12-21 07:28:12', '2020-12-21 07:32:18', 'giao đúng nơi', 0, NULL, NULL),
(71, 140000, 3, 1, '2020-12-21 07:45:02', '2020-12-21 07:45:58', '123', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `created_at`, `update_at`) VALUES
(3, 'Nguyễn Phúc Hưng', 'hungbbtbbt10@gmail.com', '0528152815', '459 Tôn Đức Thắng, Hoà Khánh Nam, Liên Chiểu, Đà Nẵng.', '202cb962ac59075b964b07152d234b70', '2020-07-24 04:14:44', '2020-12-21 08:41:30'),
(4, 'Võ Văn Bi', 'ShoesShop2@gmail.com', '0528152815', '459 Tôn Đức Thắng, Hoà Khánh Nam, Liên Chiểu, Đà Nẵng', '202cb962ac59075b964b07152d234b70', '2020-07-24 04:20:00', '2020-07-24 04:20:00'),
(7, 'Huỳnh Văn Phú', 'ShoesShop3@gmail.com', '0528152815', '459 Tôn Đức Thắng, Hoà Khánh Nam, Liên Chiểu, Đà Nẵng', '202cb962ac59075b964b07152d234b70', '2020-07-24 04:24:08', '2020-10-13 08:26:21'),
(8, 'Hà Thị Nga', 'ShoesShop4@gmail.com', '0528152815', '459 Tôn Đức Thắng, Hoà Khánh Nam, Liên Chiểu, Đà Nẵng', '202cb962ac59075b964b07152d234b70', '2020-07-24 04:24:08', '2020-10-13 08:26:28'),
(10, 'Trương Hữu Hòa', 'ShoesShop5@gmail.com', '0528152815', '459 Tôn Đức Thắng, Hoà Khánh Nam, Liên Chiểu, Đà Nẵng', '202cb962ac59075b964b07152d234b70', '2020-07-24 04:24:08', '2020-10-13 08:26:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
