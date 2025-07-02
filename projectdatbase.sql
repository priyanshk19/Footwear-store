-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 05:32 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_logo`) VALUES
(1, 'Nike', 'Nike.png'),
(2, 'Adidas', 'Adidas.png'),
(3, 'New-Balance', 'New-Balance.png'),
(4, 'Puma', 'Puma.png'),
(5, 'Asics', 'Asics.png'),
(6, 'Skechers', 'Skechers.png'),
(7, 'Under-Armour', 'Under-Armour.png'),
(8, 'Reebok', 'Reebok.png'),
(9, 'Bata', 'Bata.png'),
(10, 'Crocs', 'Crocs.png'),
(11, 'Campus', 'Campus.jpg'),
(12, 'Louis-Philippe', 'louis_philippe_logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'men'),
(2, 'women'),
(3, 'kids');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `added_on`) VALUES
(1, 'Priyansh', 'priyansh@gamil.com', '2147483647', 'I love Sneakers', '2024-05-16'),
(2, 'dcd', 'priyansh@gamil.com', '2147483647', 'I have Fun', '2024-05-23'),
(3, 'Priyansh Sanjaybhai Khalasi', 'priyanshkhalasi1903@gmail.com', 'Product', 'very Nice Sneakers', '2024-06-06'),
(4, 'Pk', 'priyanshkhalasi1903@gmail.com', 'Query', 'Refund', '2024-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `address`, `city`, `state`, `zip`, `payment_method`, `status`, `created_at`) VALUES
(1, 9, '900.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-14 17:54:59'),
(2, 9, '900.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-14 17:56:26'),
(3, 9, '700.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-14 17:58:46'),
(5, 9, '1000.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 1, '2024-06-14 18:01:45'),
(6, 9, '700.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 1, '2024-06-14 18:06:58'),
(7, 9, '1000.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 1, '2024-06-14 18:20:03'),
(8, 9, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-14 18:25:18'),
(9, 9, '900.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 1, '2024-06-14 18:26:17'),
(10, 2, '900.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-15 06:32:07'),
(11, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 1, '2024-06-15 06:32:56'),
(12, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-15 06:33:55'),
(13, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 2, '2024-06-15 06:34:42'),
(14, 2, '700.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 1, '2024-06-15 06:35:17'),
(15, 2, '900.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 2, '2024-06-15 06:36:30'),
(16, 2, '6399.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-15 07:10:18'),
(17, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-18 16:16:36'),
(18, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 2, '2024-06-18 16:17:46'),
(19, 2, '900.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 2, '2024-06-18 16:32:33'),
(20, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 2, '2024-06-18 16:35:57'),
(21, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 2, '2024-06-18 16:37:52'),
(22, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 2, '2024-06-18 16:38:45'),
(23, 2, '1200.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 2, '2024-06-18 16:39:29'),
(24, 2, '0.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'cod', 2, '2024-06-18 16:40:09'),
(25, 2, '7888.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 1, '2024-06-19 05:11:26'),
(26, 2, '1899.00', 'Rajiv Nagar, Gabheni Gam , Surat', 'Surat', 'GUJARAT', '394230', 'online', 0, '2024-06-19 09:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 7, 1, '900.00'),
(2, 2, 8, 1, '900.00'),
(3, 3, 17, 1, '700.00'),
(5, 5, 23, 1, '1000.00'),
(6, 6, 17, 1, '700.00'),
(7, 7, 30, 1, '1000.00'),
(8, 8, 3, 1, '1200.00'),
(9, 9, 10, 1, '900.00'),
(10, 10, 8, 1, '900.00'),
(11, 11, 2, 1, '1200.00'),
(12, 12, 2, 1, '1200.00'),
(13, 13, 2, 1, '1200.00'),
(14, 14, 17, 1, '700.00'),
(15, 15, 8, 1, '900.00'),
(16, 16, 58, 1, '4500.00'),
(17, 16, 46, 1, '1899.00'),
(18, 17, 2, 1, '1200.00'),
(19, 18, 2, 1, '1200.00'),
(20, 19, 6, 1, '900.00'),
(21, 20, 45, 1, '1200.00'),
(22, 21, 45, 1, '1200.00'),
(23, 22, 45, 1, '1200.00'),
(24, 23, 45, 1, '1200.00'),
(25, 24, 45, 0, '1200.00'),
(26, 25, 72, 1, '7888.00'),
(27, 26, 46, 1, '1899.00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_id` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_id`, `amount`, `status`, `created_at`) VALUES
(1, 1, '', '900.00', 'pending', '2024-06-14 17:54:59'),
(2, 1, 'pay_OMjMR90Y9aerem', '900.00', 'Success', '2024-06-14 17:55:18'),
(3, 2, '', '900.00', 'pending', '2024-06-14 17:56:26'),
(4, 2, 'pay_OMjOIku6a6y3v5', '900.00', 'Success', '2024-06-14 17:57:05'),
(5, 3, 'pay_OMjQPfzmzPbjPU', '700.00', 'Success', '2024-06-14 17:59:02'),
(6, 5, '', '1000.00', 'pending', '2024-06-14 18:01:45'),
(7, 6, '', '700.00', 'pending', '2024-06-14 18:06:58'),
(8, 7, '', '1000.00', 'success', '2024-06-14 18:20:03'),
(9, 8, 'pay_OMjsQrIg54e1dh', '1200.00', 'Success', '2024-06-14 18:25:35'),
(10, 9, '', '900.00', 'pending', '2024-06-14 18:26:17'),
(11, 10, 'pay_OMwGEYNMCDzCms', '900.00', 'Success', '2024-06-15 06:32:27'),
(12, 11, '', '1200.00', 'pending', '2024-06-15 06:32:56'),
(13, 12, 'pay_OMwI6G3HCbSK2t', '1200.00', 'Success', '2024-06-15 06:34:12'),
(14, 13, 'pay_OMwIvWgq7zvTYX', '1200.00', 'Success', '2024-06-15 06:34:59'),
(15, 14, '', '700.00', 'pending', '2024-06-15 06:35:17'),
(16, 15, 'pay_OMwKq1MRY5DuuY', '900.00', 'Success', '2024-06-15 06:36:47'),
(17, 16, 'pay_OMwuXkn0PsLc8k', '6399.00', 'Success', '2024-06-15 07:10:36'),
(18, 17, 'pay_OOHpC6uMMV0PS3', '1200.00', 'Success', '2024-06-18 16:17:07'),
(19, 18, 'pay_OOHqCycwToXaEn', '1200.00', 'Success', '2024-06-18 16:18:04'),
(20, 20, '', '1200.00', 'pending', '2024-06-18 16:35:57'),
(21, 21, '', '1200.00', 'pending', '2024-06-18 16:37:52'),
(22, 22, '', '1200.00', 'pending', '2024-06-18 16:38:45'),
(23, 23, '', '1200.00', 'pending', '2024-06-18 16:39:29'),
(24, 24, '', '0.00', 'pending', '2024-06-18 16:40:09'),
(25, 25, 'pay_OOV3lIeV4loHro', '7888.00', 'Success', '2024-06-19 05:14:45'),
(26, 26, 'pay_OOZpAc5DvbgjlN', '1899.00', 'Success', '2024-06-19 09:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `sub_cat_id`, `brand_id`, `name`, `mrp`, `price`, `qty`, `image`, `description`) VALUES
(1, 1, 1, 1, 'Green Nike Slipper', 1500, 1200, '10', 'Green Nike Slipper.jpeg', 'Green Nike Slipper'),
(2, 1, 1, 1, 'Black Nike Thong Slipper', 1500, 1200, '8', 'Nike Black Thong Slipper.jpeg', 'Nike Black Thong Slipper'),
(3, 1, 1, 1, 'Brow Nike Slipper', 1500, 1200, '10', 'Brown Nike Slipper.jpg', '10'),
(4, 1, 1, 1, 'Blue Nike Slipper', 1500, 1200, '10', 'Blue Nike Slipper.jpeg', 'Blue Nike Slipper'),
(5, 1, 1, 1, 'Black Nike  Slipper', 1500, 1200, '15', 'Black Nike Slipper.jpeg', 'Black Nike Slipper'),
(6, 1, 1, 5, 'Men Zorian AS Thong-Strap Flip-Flops Black', 1100, 900, '4', 'Men Zorian As Thong-Strap Flip-Flops Asics.jpg', 'Men Zorian AS Thong-Strap Flip-Flops Asics Black'),
(7, 1, 1, 5, 'Men Zorian AS Thong-Strap Flip-Flops Grey', 1100, 900, '7', 'Men Zorian B Thong Strap Flip-Flops Asics Grey.jpg', 'Men Zorian AS Thong-Strap Flip-Flops Asics Grey'),
(8, 1, 1, 5, 'Men Zorian AS Thong-Strap Flip-Flops Blue', 1100, 900, '10', 'Zorian AS Thong-Strap Flip-Flops Asics Blue.jpg', 'Men Zorian AS Thong-Strap Flip-Flops Asics Blue'),
(9, 1, 1, 5, 'Men Zorian AS Thong-Strap Flip-Flops Green', 1100, 900, '3', 'Men Zorian AS Thong-Strap Asics Green.jpg', 'Men Zorian AS Thong-Strap Flip-Flops Asics Green'),
(10, 1, 1, 5, 'Men Zorian AS Thong-Strap Flip-Flops Red', 1100, 900, '6', 'Zorian BM Thong-Strap Asics Red.jpg', 'Men Zorian AS Thong-Strap Flip-Flops Asics Red'),
(11, 1, 1, 4, 'Galaxy Comfort FlipFlops Puma', 700, 600, '5', 'Galaxy Comfort Flipflops Puma.jpg', 'Galaxy Comfort FlipFlops Puma'),
(12, 1, 1, 4, 'Galaxy Comfort FlipFlops Puma Grey', 700, 600, '8', 'Galaxy Comfort Flipflops Puma 1.jpg', 'Galaxy Comfort FlipFlops Puma Grey'),
(13, 1, 1, 4, 'Java Thong_strap Flip-Fliops Puma', 1300, 1200, '5', 'Java Thong-Strap Flip-Flops Puma.jpg', 'Java Thong_strap Flip-Fliops Puma Black'),
(14, 1, 1, 4, 'Capster V3 Thong-Strap Puma', 700, 500, '10', 'Capster V3 Thong-Strap Puma.jpg', 'Capster V3 Thong-Strap Puma'),
(15, 1, 1, 2, 'Men Hurtle M Flip-Flops Adidas', 1400, 1000, '8', 'Men Hurtle M Flip-Flops adidas.jpg', 'Men Hurtle M Flip-Flops Adidas Grey'),
(16, 1, 1, 2, 'Men Urbanscape Thong-Strap Adidas', 1100, 800, '7', 'Men Urbanscape Thong-Strap Adidas blue.jpg', 'Men Urbanscape Thong-Strap Adidas Blue'),
(17, 1, 1, 2, 'Solez Thong-Strap Flip-Flops Adidas', 800, 700, '11', 'Solez Thong-Strap Flip-Flops Adidas.jpg', 'Solez Thong-Strap Flip-Flops Red Adidas'),
(18, 1, 1, 10, 'Croslite Thong-Strap White Slipper', 1800, 1500, '6', 'Croslite Thong-Strap white Crocs.jpg', 'Croslite Thong-Strap White Crocs Slipper'),
(19, 1, 1, 10, 'Men Baya Thong-Strap Flip-flops Black', 1900, 1700, '5', 'Men Baya II Thong-Strap Flip-Flops Crocs.jpg', 'Men Baya Thong-Strap Flip-flops Black Crocs'),
(20, 1, 2, 1, 'Victori One Slide Sliders Nike', 1800, 1500, '7', 'Victori One Slide Sliders Nike Black.jpg', 'Victori One Slide Sliders Nike Black'),
(21, 1, 2, 2, 'Acteve Comfort On Slides Adidas', 1900, 1700, '10', 'Acteve Comfort On Slides Adidas.jpg', 'Acteve Comfort On Slides Adidas Black'),
(22, 1, 2, 4, 'Coot Cat 2.0 V BX Slides Puma Black', 1200, 100, '10', 'Cool Cat 2.0 V BX Slides Puma Black.jpg', 'Coot Cat 2.0 V BX Slides Puma Black'),
(23, 1, 2, 4, 'Divecat V2 Lite Slides Puma White', 1200, 1000, '4', 'Divecat V2 Lite Slides Puma White.jpg', 'Divecat V2 Lite Slides Puma White'),
(24, 1, 2, 11, 'Graphic Print Slides Campus', 800, 500, '6', 'Graphic Print Slides Campus.jpg', 'Graphic Print Slides Campus White'),
(25, 1, 2, 1, 'Jordan Post Slides Nike', 2200, 2000, '8', 'Jordan Post Slides Nike.jpg', 'Jordan Post Slides Nike Grey'),
(26, 1, 2, 4, 'LeadCat 2.0 Unisex Slides Puma', 1500, 1200, '10', 'Leadcat 2.0 Unisex Slides Puma White.jpg', 'LeadCat 2.0 Unisex Slides Puma White'),
(27, 1, 2, 4, 'LeadCat 2.0 Unisex Slides Puma Black', 1500, 1200, '10', 'Leadcat 2.0 Unisex Slides Puma.jpg', 'LeadCat 2.0 Unisex Slides Puma Black'),
(28, 1, 2, 4, 'Logo Applique Open-Toe Slides Puma', 1700, 1500, '8', 'Logo Applique Open-Toe Sliders Puma.jpg', 'Logo Applique Open-Toe Slides Puma Black'),
(29, 1, 2, 4, 'Logo Print Marin Slides Blue Puma', 1200, 1000, '12', 'Logo Print Marine Slides Asics Blue.jpg', 'Logo Print Marin Slides Blue Puma'),
(30, 1, 2, 0, 'Logo Print Marin Slides Red Puma', 1200, 1000, '10', 'Logo Print Marine Slides Puma Red.jpg', 'Logo Print Marin Slides Red Puma'),
(31, 1, 2, 4, 'Logo Print Marin Slides Black Puma', 1200, 1000, '11', 'Logo Print Marine Slides Puma.jpg', 'Logo Print Marin Slides Black Puma'),
(32, 1, 2, 0, 'Maka Stabler Sliders Reebok', 1199, 999, '12', 'Maka Stabler Sliders Reebok.jpg', 'Maka Stabler Sliders Reebok'),
(33, 1, 2, 8, 'Men Brand Print Slip-On Sliders Reebok', 1199, 999, '4', 'Men Brand Print Slip-On Sliders Reebok.jpg', 'Men Brand Print-On Sliders Reebok'),
(34, 1, 2, 5, 'SPRL Slides Asics Yellow', 1400, 1200, '7', 'SPRL Slides Asics Yellow.jpg', 'SPRL Slides Asics Yellow'),
(35, 1, 2, 5, 'SPRL Slides Asics White', 1400, 1200, '7', 'Sprl Logo Print Round-Toe Slides Asics White.jpg', 'SPRL Slides Asics White'),
(36, 1, 3, 1, 'Men Court Royale 2 NN Lace-Up Sneakers Nike', 5000, 4500, '8', 'Men Court Royale 2 NN Lace-Up Sneakers Nike.jpg', 'Men Court Royale 2 NN Lace Up Sneakers Nike'),
(37, 1, 3, 1, 'Blazer Low 77 Vintage Sneakers Nike', 5500, 4999, '2', 'Blazer Low 77 Vintage Sneakers Nike.jpg', 'Blazer Low 77 Vintage Sneakers Nike'),
(38, 1, 3, 1, 'MEn Full Force Sneakers Nike', 4000, 3800, '4', 'Men Full Force Sneakers Nike.jpg', 'Men Full Force Sneakers Nike'),
(39, 1, 3, 4, 'CA Pro Sport For Sneakers Puma', 3000, 2800, '3', 'CA Pro Sport For Sneakers Puma.jpg', 'CA Pro Sport For Sneakers Puma'),
(40, 1, 3, 2, 'Gazelle Lace-Up Sneakers Adidas', 6000, 5800, '4', 'Gazelle Lace-Up Sneakers Adidas.jpg', 'Gazelle Lace-Up Sneakers Adidas'),
(41, 1, 3, 4, 'Smashic Unisex Puma Sneakers', 2600, 2499, '5', 'Smashic Unisex Puma Sneakers.jpg', 'Smashic Unisex Puma Sneakers White'),
(42, 1, 3, 3, 'Men 574 Low-Top Lace-Up Sneakers New Balance', 7000, 6800, '5', 'Men 574 Low-Top Lace-Up Sneakers.jpg', 'Men 574 Low-Top Lace-Up Sneakers Red New Balance'),
(43, 1, 3, 3, 'Men 574 Lace-Up Sneakers New Balance', 8000, 7899, '3', 'Men 574 Lace-Up Sneakers New Balance.jpg', 'Men 574 Lace-Up Sneakers New Balance White'),
(44, 1, 4, 2, 'Adidas Sub Avior Thong-Strap Sandals', 1700, 1500, '5', 'Adidad Sub Avior Thong-Strap Sandals.jpg', 'Adidas Sub Avior Thong-Strap Sandals Black'),
(45, 1, 4, 0, 'Adidas Hopkar 2 Dual-Strap Sandal', 1300, 1200, '0', 'Adidas Hopkar 2 Dual-Strap Sandals.jpg', 'Adidas Hopkar 2 Dual-Strap Sandal Blue'),
(46, 1, 4, 2, 'Adidas Men Adisist Slip-on Sandals', 1999, 1899, '6', 'Adidas Men Adisist Slip-on Sandals.jpg', 'Adidas Men Adisist Slip-on Sandals Black'),
(47, 1, 4, 2, 'Adidas Men Hengat Multi-Strap Sandal', 1799, 1699, '8', 'Adidas Men Hengat Allnu Multi-Strap Sandals.jpg', 'Adidas Men Hengat Multi-Strap Sandal Blue'),
(48, 1, 4, 11, 'Campus Sandals with velcro Fastening', 799, 699, '3', 'Campus Sandals with Velcro Fastening.jpg', 'Campus Sandals with velcro Fastening Blue'),
(49, 1, 4, 11, 'Campus Sandals With velcro Fasting Orange', 799, 699, '4', 'Campus Sandals with Velcro Fastening1.jpg', 'Campus Sandals With velcro Fasting Orange'),
(50, 1, 4, 11, 'Campus Slip-on with velcro Fastening', 799, 699, '3', 'Campus Slip-On Sandals with Velcro Fastening.jpg', 'Campus Slip-on with velcro Fastening'),
(53, 1, 4, 4, 'Puma Glen Idp Flat Sandals With zero Velcro', 1699, 1599, '5', 'Puma Glen IDP Flat Sandals with Velcro Closure.jpg', 'Puma Glen Idp Flat Sandals With zero Velcro Black'),
(55, 1, 8, 1, 'Revolution 7 running Shoes Nike', 3999, 3899, '5', 'Revolution 7 Running Shoes Nike.jpg', 'Revolution 7 running Shoes Nike Black'),
(56, 1, 8, 4, 'Men Scorch Running V2 Shoes Puma', 5000, 4899, '8', 'Men Scorch Runner V2 Shoes puma.jpg', 'Men Scorch Running V2 Shoes Puma Black'),
(57, 1, 8, 1, 'Men Revolution 7 lace-Up Running Shoes', 8799, 8500, '2', 'Men Revolution 7 Lace-Up Running Shoes Nike.jpg', 'Men Revolution 7 lace-Up Running Shoes Black'),
(58, 1, 8, 5, 'Men jolt 4 Asics Running Shoes', 4799, 4500, '3', 'Men Jolt 4 Running Shoes Asics.jpg', 'Men jolt 4 Asics Running Shoes Blue'),
(60, 1, 8, 5, 'Gel-33 Asics Running Shoes', 7899, 7699, '4', 'Gel-33 Run Running Shoes Asics.jpg', 'Gel-33 Asics Running Shoes White'),
(61, 1, 8, 2, 'Dot-Track Adidas Running Shoes', 8999, 8799, '2', 'Dot-Track Running Shoes Adidas.jpg', 'Dot-Track Adidas Running Shoes Black'),
(62, 1, 9, 1, 'FLex Experience RN 12 Nike Training Shoes', 8999, 8799, '5', 'Flex Experience RN 12 Training Shoes Nike.jpg', 'FLex Experience RN 12 Nike Training Shoes black'),
(63, 1, 9, 1, 'Motive Nike Training Lace-Up Shoes', 6799, 6599, '2', 'Motiva Training Lace-Up Shoes nike.jpg', 'Motive Nike Training Lace-Up Shoes Black'),
(64, 1, 6, 1, 'tanjun Lace-Up Nike Causal Shoes', 5699, 5499, '3', 'Tanjun Lace-Up Casual Shoes Nike.jpg', 'tanjun Lace-Up Nike Causal Shoes Grey'),
(65, 1, 5, 11, 'Textured Lace-up Campus Sports Shoes', 1699, 1599, '2', 'Textured Lace-up Sports Shoes.jpg', 'Textured Lace-up Campus Sports Shoes'),
(66, 1, 5, 1, 'Men MC trainer 2 Nike Sports Shoes', 7999, 7899, '2', 'Men MC Trainer 2 Sports Shoes.jpg', 'Men MC trainer 2 Nike Sports Shoes'),
(67, 1, 5, 1, 'DownShifter 12 Nike Sports Shoes', 7888, 7500, '2', 'Downshifter 13 Shoes Nike.jpg', 'DownShifter 12 Nike Sports Shoes'),
(68, 1, 5, 4, 'Low-Top Puma Sports Shoes', 8999, 8700, '4', 'Low-Top Cricket Shoes.jpg', 'Low-Top Puma Sports Shoes'),
(69, 1, 7, 12, 'Almont-Toe Derby Louis-Philippe Formal Shoes', 4500, 4444, '2', 'Almond-Toe Derby Formal Shoes1.jpg', 'Almont-Toe Derby Louis-Philippe Formal Shoes Black'),
(70, 1, 7, 12, 'Derbys Louis-Philippe Formal Shoes', 4000, 3899, '2', 'Derbys Formal Shoes.jpg', 'Derbys Louis-Philippe Formal Shoes Black'),
(71, 1, 7, 12, 'Round-Tow Leathee Derby Louis-Phillippe Formal Sho', 4999, 4799, '3', 'Round-Toe Leather Derby Shoes.jpg', 'Round-Tow Leathee Derby Louis-Phillippe Formal Sho'),
(72, 1, 11, 1, 'Air Max Impact 4 Nike BasketBall Shoes', 7999, 7888, '1', 'Air Max Impact 4 Basketball Shoes.jpg', 'Air Max Impact 4 Nike BasketBall Shoes'),
(73, 1, 11, 1, 'Renew Elevate 3 Nike Basketball Shoes', 8999, 8888, '2', 'Renew Elevate 3 Basketball Shoes.jpg', 'Renew Elevate 3 Nike Basketball Shoes'),
(74, 1, 3, 1, 'Nike Low Brown Sneakers', 8000, 7777, '3', 'Nike Brown Sneakers.jpeg', 'Nike Low Brown Sneakers'),
(75, 1, 3, 1, 'Nike Low Red Sneaker', 9000, 8888, '2', 'Nike Red Sneakers.jpeg', 'Nike Low Red Sneaker');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_cat_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_cat_id`, `category_id`, `sub_cat_name`) VALUES
(1, 1, 'Flip-Flop & Slippers'),
(2, 1, 'Slides'),
(3, 1, 'Sneakers'),
(4, 1, 'Sandals'),
(5, 1, 'Sports Shoes'),
(6, 1, 'Casual Shoes'),
(7, 1, 'Formal Shoes'),
(8, 1, 'Running'),
(9, 1, 'Gym & Training'),
(10, 1, 'Football'),
(11, 1, 'Basketball'),
(12, 2, 'Flip-Flop & Slippers'),
(13, 2, 'Slides'),
(14, 2, 'Casual Shoes'),
(15, 2, 'Flat Sandals'),
(16, 2, 'Heeled Sandals'),
(17, 2, 'Heeled Shoes'),
(18, 2, 'Heeled Shoes'),
(19, 2, 'Boots'),
(20, 3, 'Flip Flops'),
(21, 3, 'Sandals'),
(22, 3, 'Sports Shoes'),
(23, 3, 'Casual Shoes'),
(24, 3, 'Flat Sandals');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `added_on`) VALUES
(1, 'Priyansh', 'priyansh1903@gmail.com', '6354173590', 'Priyansh@1903', '2024-05-28'),
(2, 'Pk', 'priyanshkhalasi1903@gmail.com', '09316118409', 'Pk', '2024-05-01'),
(4, 'PRIYANSH', 'priyanshkhalasi190@gmail.com', '6354173590', 'Priyansh', '2024-05-29'),
(5, 'PRIYANSH', 'priyanshkhalasi19@gmail.com', '6354173590', 'Priyansh', '2024-05-29'),
(7, 'aayush', 'mahiaayush72@gmail.com', '9999999999', '1111', '2024-06-07'),
(8, 'Parthik', 'parthik12@gmail.com', '9999888999', 'Parthik12', '2024-06-14'),
(9, 'kushal', 'kushal12@gmail.com', '8877688990', '123', '2024-06-14'),
(10, 'deev', 'deev123@gmail.com', '234567899', 'Deev1234', '2024-06-14'),
(11, 'Harsh', 'harsh12@gmail.com', '8790689945', 'Harsh99', '2024-06-14'),
(12, 'jonny', 'jonny123@gmail.com', '9316118409', 'Jonny1234', '2024-06-14'),
(13, 'Ragnar', 'ragnar12@gmail.com', '8798006578', 'Ragnar123', '2024-06-14'),
(14, 'vicky', 'vicky12@gmail.com', '6756473833', 'Vicky123', '2024-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(6, 1, 3, '2024-06-15 10:00:02'),
(15, 2, 45, '2024-06-18 22:20:01'),
(16, 2, 46, '2024-06-18 22:20:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
