-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 07:06 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(100) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`) VALUES
(1, 'Wockoder'),
(2, 'Victrola'),
(3, 'Retrolife'),
(4, 'Byron Statics'),
(5, 'LP&No.1'),
(6, 'Audio-Technica'),
(7, 'Voksun'),
(8, 'Angels Horn'),
(9, 'SeeYing'),
(10, 'Wrcibo');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `total_price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(100) NOT NULL,
  `category_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_title`) VALUES
(1, 'Vinyl Record Player'),
(4, 'MP3 Player'),
(5, 'MP4 Player');

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_quantity` int(100) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_orders`
--

INSERT INTO `customer_orders` (`id`, `user_id`, `product_id`, `product_title`, `product_price`, `product_quantity`, `transaction_id`, `order_status`) VALUES
(17, 1, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dc54116f232', 'COMPLETED'),
(18, 1, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 1, 'tr60dc5427e938d', 'COMPLETED'),
(19, 1, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 10, 'tr60dc543ce91cc', 'COMPLETED'),
(20, 1, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 1, 'tr60dc550b9c015', 'COMPLETED'),
(21, 1, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dc55b3acf0d', 'COMPLETED'),
(22, 1, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dc55c3b562d', 'COMPLETED'),
(23, 1, 1, 'Wockoder Vinyl Record Player', 460, 2, 'tr60dc6681be46b', 'COMPLETED'),
(24, 1, 1, 'Wockoder Vinyl Record Player', 460, 5, 'tr60dc6b2877058', 'COMPLETED'),
(25, 1, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 2, 'tr60dc6b2877058', 'COMPLETED'),
(26, 1, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 2, 'tr60dc6b2877058', 'COMPLETED'),
(27, 1, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 1, 'tr60dc6b2877058', 'COMPLETED'),
(28, 1, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 1, 'tr60dc6b2877058', 'COMPLETED'),
(29, 1, 9, 'Voksun Record Player, Bluetooth Turntable with Built-in Stereo Speakers, 3-Speed Nostalgic Suitcase LP Vinyl Player, Supports Vinyl to MP3 Recording', 643, 1, 'tr60dc6b2877058', 'COMPLETED'),
(30, 1, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 5, 'tr60dc7841011c6', 'COMPLETED'),
(31, 1, 1, 'Wockoder Vinyl Record Player', 460, 5, 'tr60dc84b1daf10', 'COMPLETED'),
(32, 1, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 2, 'tr60dc84b1daf10', 'COMPLETED'),
(33, 1, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 2, 'tr60dc84b1daf10', 'COMPLETED'),
(34, 1, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 1, 'tr60dc84b1daf10', 'COMPLETED'),
(35, 1, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 1, 'tr60dc84b1daf10', 'COMPLETED'),
(36, 1, 9, 'Voksun Record Player, Bluetooth Turntable with Built-in Stereo Speakers, 3-Speed Nostalgic Suitcase LP Vinyl Player, Supports Vinyl to MP3 Recording', 643, 1, 'tr60dc84b1daf10', 'COMPLETED'),
(37, 3, 1, 'Wockoder Vinyl Record Player', 460, 2, 'tr60dc94fc1f3b1', 'COMPLETED'),
(38, 1, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 22, 'tr60dc99734738a', 'COMPLETED'),
(39, 4, 5, 'LP&No.1 Retro Bluetooth Record Player with Stereo External Speakers, 3-Speed Belt-Drive Turntable', 1070, 2, 'tr60dc9a708c93b', 'COMPLETED'),
(40, 4, 11, 'SeeYing Record Player Bluetooth Turntable with Stereo Speakers Portable Belt-Driven 3-Speed', 478, 2, 'tr60dc9a708c93b', 'COMPLETED'),
(41, 4, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dc9a708c93b', 'COMPLETED'),
(42, 4, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 1, 'tr60dc9a708c93b', 'COMPLETED'),
(43, 4, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 1, 'tr60dc9a708c93b', 'COMPLETED'),
(44, 4, 4, 'Byron Statics Vinyl Record Player, 3 Speed Turntable Record Player with 2 Built in Stereo Speakers', 390, 1, 'tr60dc9a708c93b', 'COMPLETED'),
(45, 4, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 1, 'tr60dc9a708c93b', 'COMPLETED'),
(46, 4, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 1, 'tr60dc9a708c93b', 'COMPLETED'),
(47, 4, 9, 'Voksun Record Player, Bluetooth Turntable with Built-in Stereo Speakers, 3-Speed Nostalgic Suitcase LP Vinyl Player, Supports Vinyl to MP3 Recording', 643, 1, 'tr60dc9a708c93b', 'COMPLETED'),
(48, 4, 10, 'ANGELS HORN Turntables for Vinyl Records, Vinyl Record Player, Built-in Phono Preamp Belt Drive 2-Speed', 1622, 1, 'tr60dc9a708c93b', 'COMPLETED'),
(49, 4, 5, 'LP&No.1 Retro Bluetooth Record Player with Stereo External Speakers, 3-Speed Belt-Drive Turntable', 1070, 2, 'tr60dc9ad47977a', 'COMPLETED'),
(50, 4, 11, 'SeeYing Record Player Bluetooth Turntable with Stereo Speakers Portable Belt-Driven 3-Speed', 478, 2, 'tr60dc9ad47977a', 'COMPLETED'),
(51, 4, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dc9ad47977a', 'COMPLETED'),
(52, 4, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 1, 'tr60dc9ad47977a', 'COMPLETED'),
(53, 4, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 1, 'tr60dc9ad47977a', 'COMPLETED'),
(54, 4, 4, 'Byron Statics Vinyl Record Player, 3 Speed Turntable Record Player with 2 Built in Stereo Speakers', 390, 1, 'tr60dc9ad47977a', 'COMPLETED'),
(55, 4, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 1, 'tr60dc9ad47977a', 'COMPLETED'),
(56, 4, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 1, 'tr60dc9ad47977a', 'COMPLETED'),
(57, 4, 9, 'Voksun Record Player, Bluetooth Turntable with Built-in Stereo Speakers, 3-Speed Nostalgic Suitcase LP Vinyl Player, Supports Vinyl to MP3 Recording', 643, 1, 'tr60dc9ad47977a', 'COMPLETED'),
(58, 4, 10, 'ANGELS HORN Turntables for Vinyl Records, Vinyl Record Player, Built-in Phono Preamp Belt Drive 2-Speed', 1622, 1, 'tr60dc9ad47977a', 'COMPLETED'),
(59, 1, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dca548d9c72', 'COMPLETED'),
(60, 2, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 1, 'tr60dcd74a11b23', 'COMPLETED'),
(61, 2, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dcd74a11b23', 'COMPLETED'),
(62, 1, 1, 'Wockoder Vinyl Record Player', 460, 5, 'tr60dcddd0c9430', 'COMPLETED'),
(63, 1, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 2, 'tr60dcddd0c9430', 'COMPLETED'),
(64, 1, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 2, 'tr60dcddd0c9430', 'COMPLETED'),
(65, 1, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 1, 'tr60dcddd0c9430', 'COMPLETED'),
(66, 1, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 1, 'tr60dcddd0c9430', 'COMPLETED'),
(67, 1, 9, 'Voksun Record Player, Bluetooth Turntable with Built-in Stereo Speakers, 3-Speed Nostalgic Suitcase LP Vinyl Player, Supports Vinyl to MP3 Recording', 643, 1, 'tr60dcddd0c9430', 'COMPLETED'),
(68, 5, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dda0a26c4fb', 'COMPLETED'),
(69, 5, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 1, 'tr60dda0a26c4fb', 'COMPLETED'),
(70, 5, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 1, 'tr60dda0a26c4fb', 'COMPLETED'),
(71, 6, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dda1f0932f2', 'COMPLETED'),
(72, 6, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 1, 'tr60dda1f0932f2', 'COMPLETED'),
(73, 6, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dda366f1239', 'COMPLETED'),
(74, 6, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 1, 'tr60dda366f1239', 'COMPLETED'),
(75, 7, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 1, 'tr60ddd69bb0d57', 'COMPLETED'),
(76, 7, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 1, 'tr60ddd69bb0d57', 'COMPLETED'),
(77, 7, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 2, 'tr60ddd69bb0d57', 'COMPLETED'),
(78, 8, 5, 'LP&No.1 Retro Bluetooth Record Player with Stereo External Speakers, 3-Speed Belt-Drive Turntable', 1070, 1, 'tr60ddd79060ece', 'COMPLETED'),
(79, 7, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 3, 'tr60dddbf37eb3c', 'COMPLETED'),
(80, 7, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 3, 'tr60dddbf37eb3c', 'COMPLETED'),
(81, 7, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 3, 'tr60dddbfb35ae1', 'COMPLETED'),
(82, 7, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 3, 'tr60dddbfb35ae1', 'COMPLETED'),
(83, 7, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 3, 'tr60dddc05d831c', 'COMPLETED'),
(84, 7, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 3, 'tr60dddc05d831c', 'COMPLETED'),
(85, 7, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60dddc2c403d8', 'COMPLETED'),
(86, 7, 1, 'Wockoder Vinyl Record Player', 460, 2, 'tr60dddc3c83851', 'COMPLETED'),
(87, 8, 1, 'Wockoder Vinyl Record Player', 460, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(88, 8, 2, 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(89, 8, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(90, 8, 4, 'Byron Statics Vinyl Record Player, 3 Speed Turntable Record Player with 2 Built in Stereo Speakers', 390, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(91, 8, 5, 'LP&No.1 Retro Bluetooth Record Player with Stereo External Speakers, 3-Speed Belt-Drive Turntable', 1070, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(92, 8, 6, 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(93, 8, 9, 'Voksun Record Player, Bluetooth Turntable with Built-in Stereo Speakers, 3-Speed Nostalgic Suitcase LP Vinyl Player, Supports Vinyl to MP3 Recording', 643, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(94, 8, 10, 'ANGELS HORN Turntables for Vinyl Records, Vinyl Record Player, Built-in Phono Preamp Belt Drive 2-Speed', 1622, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(95, 8, 11, 'SeeYing Record Player Bluetooth Turntable with Stereo Speakers Portable Belt-Driven 3-Speed', 478, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(96, 8, 12, 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 1, 'tr60ddf0f3bf910', 'COMPLETED'),
(97, 9, 3, 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 2, 'tr60ddf4bcbf81a', 'COMPLETED');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  `product_stars` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category`, `product_brand`, `product_title`, `product_price`, `product_description`, `product_image`, `product_keywords`, `product_stars`) VALUES
(1, 'Vinyl Record Player', 'Wockoder', 'Wockoder Vinyl Record Player  Record Player with Speakers Turntables for Vinyl Records 3 Speed Belt Driven Vintage Record Player', 460, 'Brand: WOCKODER\r\nConnectivity Technology: Wired\r\nColor: Brown\r\nMaterial: Vinyl, Wood\r\nItem Weight: 4.7 Pounds\r\nMotor Type: AC Motor', './product_images/wockoder_record_player.jpg', 'record player, vinyl, vinyl record player', 4),
(2, 'Vinyl Record Player', 'Victrola', 'Victrola Vintage 3-Speed Bluetooth Portable Suitcase Record Player with Built-in Speakers', 510, 'Brand: Victrola\r\nConnectivity Technology: Bluetooth\r\nColor: Red\r\nMaterial: Plastic\r\nItem Weight: 2.69 Pounds\r\nMotor Type: AC Motor', './product_images/victrola_record_player.jpg', 'record player, vinyl, vinyl record player', 4),
(3, 'Vinyl Record Player', 'Retrolife', 'Retrolife Vinyl Record Player 3-Speed Bluetooth Suitcase Portable Belt-Driven Record Player with Built-in Speakers', 660, 'Brand: Retrolife\r\nConnectivity Technology: Wireless, Wired\r\nColor: Black\r\nMaterial: Vinyl\r\nSignal Format: Digital', './product_images/retrolife_record_player.jpg', 'record player, vinyl, vinyl record player', 4),
(4, 'Vinyl Record Player', 'Byron Statics', 'Byron Statics Vinyl Record Player, 3 Speed Turntable Record Player with 2 Built in Stereo Speakers', 390, 'Brand: Byron Statics\r\nConnectivity Technology: Wired\r\nColor: Black\r\nMaterial: Vinyl\r\nItem Weight: 5.46 Pounds\r\nMotor Type: DC Motor\r\nVoltage: 9 Volts', './product_images/byronstatics_record_player.jpg', 'record player, vinyl, vinyl record player', 2),
(5, 'Vinyl Record Player', 'LP&No.1', 'LP&No.1 Retro Bluetooth Record Player with Stereo External Speakers, 3-Speed Belt-Drive Turntable', 1070, 'Model Name: LPSC-008\r\nBrand: LP&No.1\r\nConnectivity Technology: Bluetooth\r\nColor: Yellow Brown\r\nMaterial: Engineered Wood, Wood\r\nItem Weight: 6.7 Kilograms\r\nMotor Type: DC Motor\r\nSignal Format: Analog\r\nVoltage: 12 Volts\r\nPower Source: Corded Electric', './product_images/lpno1_record_player.jpg', 'record player, vinyl, vinyl record player', 4),
(6, 'Vinyl Record Player', 'Audio-Technica', 'Audio-Technica AT-LP120XUSB-BK Direct-Drive Turntable (Analog & USB), Fully Manual, Hi-Fi, 3 Speed', 2520, 'Model Name: AT-LP120XUSB-BK\r\nBrand: Audio-Technica\r\nConnectivity Technology: Wired\r\nColor: Black\r\nMaterial: Plastic\r\nItem Weight: 17.5 Pounds\r\nMotor Type: DC Motor\r\nSignal Format: Analog\r\nVoltage: 230 Volts\r\nSignal-to-Noise Ratio: 100 dB', './product_images/audiotechnica_record_player.jpg', 'record player, vinyl, vinyl record player', 5),
(9, 'Vinyl Record Player', 'Voksun', 'Voksun Record Player, Bluetooth Turntable with Built-in Stereo Speakers, 3-Speed Nostalgic Suitcase LP Vinyl Player, Supports Vinyl to MP3 Recording', 643, 'Brand: VOKSUN\r\nConnectivity Technology: Wireless, Wired\r\nColor: Black\r\nMaterial: Plastic', './product_images/voksun_record_player.jpg', 'record player, vinyl, vinyl record player', 3),
(10, 'Vinyl Record Player', 'Angels Horn', 'ANGELS HORN Turntables for Vinyl Records, Vinyl Record Player, Built-in Phono Preamp Belt Drive 2-Speed', 1622, 'Brand: ANGELS HORN\r\nConnectivity Technology: Wired\r\nColor: Mahogany Wood\r\nMaterial: Vinyl\r\nMotor Type: DC Motor', './product_images/angelshorn_record_player.jpg', 'record player, vinyl, vinyl record player', 4),
(11, 'Vinyl Record Player', 'SeeYing', 'SeeYing Record Player Bluetooth Turntable with Stereo Speakers Portable Belt-Driven 3-Speed', 478, 'Model Name: TT-138\r\nBrand: SeeYing\r\nConnectivity Technology: Wireless, Wired\r\nColor: Vintage Wood\r\nMaterial: Vinyl\r\nItem Weight: 4.85 Pounds\r\nMotor Type: AC Motor', './product_images/seeying_record_player.jpg', 'record player, vinyl, vinyl record player', 3),
(12, 'Vinyl Record Player', 'Wrcibo', 'Wrcibo Record Player, Vintage Turntable 3-Speed Belt Drive Vinyl Player LP Record Player with Built-in Stereo Speaker', 633, 'Brand: Wrcibo\r\nConnectivity Technology: Wired\r\nMaterial: Wood\r\nMotor Type: AC Motor', './product_images/wrcibo_record_player.jpg', 'record player, vinyl, vinyl record player', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `rating`) VALUES
(7, 6, 1, 3),
(8, 6, 2, 4),
(9, 1, 3, 4),
(10, 1, 2, 4),
(11, 1, 1, 4),
(12, 1, 6, 5),
(13, 1, 9, 3),
(14, 1, 12, 4),
(15, 3, 1, 4),
(16, 5, 1, 4),
(17, 5, 2, 5),
(18, 5, 3, 5),
(19, 2, 2, 5),
(20, 2, 1, 5),
(21, 7, 3, 5),
(22, 7, 6, 5),
(23, 7, 12, 4),
(24, 7, 1, 5),
(25, 8, 5, 4),
(26, 8, 1, 3),
(27, 8, 2, 4),
(28, 8, 3, 4),
(29, 8, 4, 2),
(30, 8, 6, 5),
(31, 8, 9, 3),
(32, 8, 10, 4),
(33, 8, 11, 3),
(34, 8, 12, 3),
(35, 9, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address`) VALUES
(1, 'ozy', 'mozy', 'asdas@as.com', '$2y$10$Z/zHtk3fl.So.mgjen6A1eN4lnnSY303sG74mKb0l9WWpqTSgQ2xO', '+901283721', 'asd'),
(2, 'Oguz', 'Sabitay', '112@112.com', '$2y$10$nl82a0/TBNOSQCxVzfgFV.oyfy89/7.wooQtREmHDs4L7sHTZD9S.', '+02222222', 'my address 312312'),
(3, 'John', 'Cena', '123@123.com', '$2y$10$vHDOTmMjYYugUVlkiujwSemkq/ycuRWuQ3T/ko6E8fRcjWR8orvIu', '+1293819', 'not correct address'),
(5, 'guest', 'try', 'aa@aa.com', '$2y$10$ZlvF.cL/ZOsUrDkKNM7poe5Kvt5lPZS50/aEZe2bwq5TNwrsWDYne', '+12093812', 'my address 2'),
(6, '123', '123', 'a@a.com', '$2y$10$ZkHjql89UGfpsxeYGkIe2.7a1Vtq.FVWM/aZO98sNZ00RCCuy0UiW', '+129381', 'asdasda'),
(7, 'Test', 'User', '1a@1a.com', '$2y$10$PaPmGv8oA9lXmcquvFbIG.djhBp1YlfqzTkfwfrQqkcRw.P26/uha', '+1238912', 'this is not my address'),
(8, 'LeBron', 'James', 'lebron@lebron.com', '$2y$10$vDcYcrg1kXMUt1qNOSWfFuG.k.t62tflxGLJkkq8Q07oomfq62P8q', '+023232323', 'lebron\'s address'),
(9, 'Irem', 'Uc', 'asd@asd.com', '$2y$10$WuaV4upY0uKXhppEmKN7Ee4J0foPf5Xwy2rbu0yI.ZhzmEf1Ndxly', '+1923812', 'another incorrect address');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
