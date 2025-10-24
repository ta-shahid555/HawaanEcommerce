-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2025 at 11:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerceweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_to_cart`
--

CREATE TABLE `add_to_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `payment_method` enum('cod','bank') NOT NULL,
  `order_notes` text DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','processing','shipped','delivered','completed','cancelled','removed') DEFAULT 'pending',
  `tracking_number` varchar(100) DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `products_names` text DEFAULT NULL,
  `products_quantities` text DEFAULT NULL,
  `products_categories` text DEFAULT NULL,
  `order_total` text DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `coupon_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `full_name`, `email`, `mobile`, `address`, `city`, `zip_code`, `payment_method`, `order_notes`, `order_date`, `status`, `tracking_number`, `admin_notes`, `products_names`, `products_quantities`, `products_categories`, `order_total`, `discount_amount`, `coupon_code`) VALUES
(1, 'Ali Khan', 'ali.khan@example.com', '03001234567', 'House 123, Street 45, Gulshan', 'karachi', '75300', 'cod', 'Please deliver after 5pm', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(2, 'Fatima Ahmed', 'fatima.ahmed@example.com', '03111234567', 'Flat 302, Block B, DHA Phase 5', 'lahore', '54000', 'bank', 'Gift wrapping required', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(3, 'Usman Malik', 'usman.malik@example.com', '03221234567', 'Shop 5, Main Market, Blue Area', 'islamabad', '44000', 'cod', NULL, '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(4, 'Ayesha Raza', 'ayesha.raza@example.com', '03331234567', 'Village Kotli, Near Main Bazaar', 'multan', '60000', 'bank', 'Call before delivery', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(5, 'Bilal Hassan', 'bilal.hassan@example.com', '03441234567', 'Office 401, Trade Tower, I.I. Chundrigar Road', 'karachi', '74000', 'cod', 'Deliver to reception', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(6, 'Hina Shah', 'hina.shah@example.com', '03051234567', 'House 78, Street 12, F-7/4', 'islamabad', '44200', 'bank', 'Leave at gate if not home', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(7, 'Kamran Ali', 'kamran.ali@example.com', '03161234567', 'Flat 15, Rose Heights, MM Alam Road', 'lahore', '54600', 'cod', NULL, '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(8, 'Sana Malik', 'sana.malik@example.com', '03271234567', 'Shop 23, Saddar Bazaar', 'karachi', '75550', 'bank', 'Fragile items - handle with care', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(9, 'Zubair Ahmed', 'zubair.ahmed@example.com', '03381234567', 'House 45, Street 9, Cantt', 'multan', '60100', 'cod', 'Ring bell twice', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(10, 'Nadia Khan', 'nadia.khan@example.com', '03491234567', 'Office 12, 2nd Floor, Plaza 123', 'lahore', '54700', 'bank', NULL, '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(11, 'Farhan Siddiqui', 'farhan.siddiqui@example.com', '03001234568', 'House 90, Street 34, PECHS', 'karachi', '75400', 'cod', 'Weekend delivery only', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(12, 'Sara Rizvi', 'sara.rizvi@example.com', '03111234568', 'Flat 8, Block C, Bahria Town', 'islamabad', '44300', 'bank', 'Neighbor can receive if not home', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(13, 'Tariq Mahmood', 'tariq.mahmood@example.com', '03221234568', 'Shop 2, Main Market, Model Town', 'lahore', '54500', 'cod', NULL, '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(14, 'Zainab Akhtar', 'zainab.akhtar@example.com', '03331234568', 'Village Mohra, Near Railway Station', 'multan', '60200', 'bank', 'Call one hour before delivery', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(15, 'Imran Baig', 'imran.baig@example.com', '03441234568', 'Office 305, Finance Center, Shahrah-e-Faisal', 'karachi', '75350', 'cod', 'Security deposit required', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(16, 'Mehak Nadeem', 'mehak.nadeem@example.com', '03051234568', 'House 67, Street 23, G-10/4', 'islamabad', '44100', 'bank', NULL, '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(17, 'Adnan Qureshi', 'adnan.qureshi@example.com', '03161234568', 'Flat 12, Sky Gardens, Main Boulevard', 'lahore', '54800', 'cod', 'Deliver to back entrance', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(18, 'Fariha Aslam', 'fariha.aslam@example.com', '03271234568', 'Shop 45, Tariq Road', 'karachi', '75600', 'bank', 'Gift message required', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(19, 'Saad Malik', 'saad.malik@example.com', '03381234568', 'House 34, Street 5, Cantt', 'multan', '60300', 'cod', 'Leave with security guard', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(20, 'Amina Sheikh', 'amina.sheikh@example.com', '03491234568', 'Office 201, Business Plaza, Jinnah Avenue', 'islamabad', '44400', 'bank', 'Urgent delivery required', '2025-07-09 09:37:28', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(21, 'Ali Khan', 'ali.khan@example.com', '03001234567', 'House 123, Street 45, Gulshan', 'karachi', '75300', 'cod', 'Please deliver after 5pm', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(22, 'Fatima Ahmed', 'fatima.ahmed@example.com', '03111234567', 'Flat 302, Block B, DHA Phase 5', 'lahore', '54000', 'bank', 'Gift wrapping required', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(23, 'Usman Malik', 'usman.malik@example.com', '03221234567', 'Shop 5, Main Market, Blue Area', 'islamabad', '44000', 'cod', NULL, '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(24, 'Ayesha Raza', 'ayesha.raza@example.com', '03331234567', 'Village Kotli, Near Main Bazaar', 'multan', '60000', 'bank', 'Call before delivery', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(25, 'Bilal Hassan', 'bilal.hassan@example.com', '03441234567', 'Office 401, Trade Tower, I.I. Chundrigar Road', 'karachi', '74000', 'cod', 'Deliver to reception', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(26, 'Hina Shah', 'hina.shah@example.com', '03051234567', 'House 78, Street 12, F-7/4', 'islamabad', '44200', 'bank', 'Leave at gate if not home', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(27, 'Kamran Ali', 'kamran.ali@example.com', '03161234567', 'Flat 15, Rose Heights, MM Alam Road', 'lahore', '54600', 'cod', NULL, '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(28, 'Sana Malik', 'sana.malik@example.com', '03271234567', 'Shop 23, Saddar Bazaar', 'karachi', '75550', 'bank', 'Fragile items - handle with care', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(29, 'Zubair Ahmed', 'zubair.ahmed@example.com', '03381234567', 'House 45, Street 9, Cantt', 'multan', '60100', 'cod', 'Ring bell twice', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(30, 'Nadia Khan', 'nadia.khan@example.com', '03491234567', 'Office 12, 2nd Floor, Plaza 123', 'lahore', '54700', 'bank', NULL, '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(31, 'Farhan Siddiqui', 'farhan.siddiqui@example.com', '03001234568', 'House 90, Street 34, PECHS', 'karachi', '75400', 'cod', 'Weekend delivery only', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(32, 'Sara Rizvi', 'sara.rizvi@example.com', '03111234568', 'Flat 8, Block C, Bahria Town', 'islamabad', '44300', 'bank', 'Neighbor can receive if not home', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(33, 'Tariq Mahmood', 'tariq.mahmood@example.com', '03221234568', 'Shop 2, Main Market, Model Town', 'lahore', '54500', 'cod', NULL, '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(34, 'Zainab Akhtar', 'zainab.akhtar@example.com', '03331234568', 'Village Mohra, Near Railway Station', 'multan', '60200', 'bank', 'Call one hour before delivery', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(35, 'Imran Baig', 'imran.baig@example.com', '03441234568', 'Office 305, Finance Center, Shahrah-e-Faisal', 'karachi', '75350', 'cod', 'Security deposit required', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(36, 'Mehak Nadeem', 'mehak.nadeem@example.com', '03051234568', 'House 67, Street 23, G-10/4', 'islamabad', '44100', 'bank', NULL, '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(37, 'Adnan Qureshi', 'adnan.qureshi@example.com', '03161234568', 'Flat 12, Sky Gardens, Main Boulevard', 'lahore', '54800', 'cod', 'Deliver to back entrance', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(38, 'Fariha Aslam', 'fariha.aslam@example.com', '03271234568', 'Shop 45, Tariq Road', 'karachi', '75600', 'bank', 'Gift message required', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(39, 'Saad Malik', 'saad.malik@example.com', '03381234568', 'House 34, Street 5, Cantt', 'multan', '60300', 'cod', 'Leave with security guard', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(40, 'Amina Sheikh', 'amina.sheikh@example.com', '03491234568', 'Office 201, Business Plaza, Jinnah Avenue', 'islamabad', '44400', 'bank', 'Urgent delivery required', '2025-07-09 09:38:15', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(41, 'Wasi Karan', 'test@example.us', '03353683239', 'plot-719 sector-b ali muhammad goth, taiser town, karrachi\r\nplot-719 sector-b ali muhammad goth, taiser town, karrachi', 'karachi', '75660', 'cod', 'no nedd', '2025-07-09 10:13:02', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(42, 'Wasi Karan', 'test@example.us', '03353683239', 'plot-719 sector-b ali muhammad goth, taiser town, karrachi\r\nplot-719 sector-b ali muhammad goth, taiser town, karrachi', 'karachi', '75660', 'cod', 'no nedd', '2025-07-09 10:14:10', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(43, 'Brain Master', 'wasi@test.com', '03193000722', 'brainmaster816@gmail.com', 'karachi', '75660', 'cod', 'no nedd', '2025-07-09 10:14:49', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(44, 'Brain Master', 'wasi@test.com', '03193000722', 'brainmaster816@gmail.com', 'karachi', '75660', 'cod', 'no nedd', '2025-07-09 10:14:56', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(45, 'Brain Master', 'wasi@test.com', '03193000722', 'brainmaster816@gmail.com', 'karachi', '75660', 'cod', 'no nedd', '2025-07-09 10:15:33', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(48, 'Wasi Karan', 'wasi@test.com', '03353683239', 'plot-719 sector-b ali muhammad goth, taiser town, karrachi\r\nplot-719 sector-b ali muhammad goth, taiser town, karrachi', 'karachi', '75660', 'cod', 'no nedd', '2025-07-09 10:17:24', 'completed', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL),
(63, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'House #1, Karachi', 'Karachi', '75000', '', 'Deliver after 5pm', '2025-07-09 13:36:51', 'pending', NULL, NULL, 'Shirt,Jeans', '1,2', 'Fabrics,Fabrics', '3500', 0.00, NULL),
(64, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'House #2, Karachi', 'Karachi', '75000', '', 'Urgent delivery', '2025-07-09 13:36:51', 'completed', NULL, NULL, 'Face Wash,Lipstick', '2,1', 'Cosmetics,Cosmetics', '2100', 0.00, NULL),
(65, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'House #3, Karachi', 'Karachi', '75000', '', 'Gift packing required', '2025-07-09 13:36:51', 'pending', NULL, NULL, 'Watch,Perfume', '1,1', 'Accessories,Accessories', '4800', 0.00, NULL),
(66, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'Street 4, Karachi', 'Karachi', '75000', '', '', '2025-07-09 13:36:51', 'completed', NULL, NULL, 'Shawl,Lotion', '1,2', 'Fabrics,Cosmetics', '2300', 0.00, NULL),
(67, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'Block 5, Gulshan', 'Karachi', '75000', '', 'Handle with care', '2025-07-09 13:36:51', 'pending', NULL, NULL, 'T-Shirt,Bag', '3,1', 'Fabrics,Accessories', '3100', 0.00, NULL),
(68, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'Plot 14, DHA', 'Karachi', '75000', '', '', '2025-07-09 13:36:51', 'pending', NULL, NULL, 'Wallet,Earrings', '1,2', 'Accessories,Accessories', '2700', 0.00, NULL),
(69, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'Main Road, Karachi', 'Karachi', '75000', '', 'No perfume', '2025-07-09 13:36:51', 'removed', NULL, NULL, 'Mascara,Brush', '1,1', 'Cosmetics,Cosmetics', '1500', 0.00, NULL),
(70, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'Lane 7, PECHS', 'Karachi', '75000', '', 'Delivery Sunday only', '2025-07-09 13:36:51', 'completed', NULL, NULL, 'Hijab,Abaya', '1,1', 'Fabrics,Fabrics', '3200', 0.00, NULL),
(71, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'Sector 15, Korangi', 'Karachi', '75000', '', '', '2025-07-09 13:36:51', 'pending', NULL, NULL, 'Handbag,Necklace', '1,1', 'Accessories,Accessories', '4100', 0.00, NULL),
(72, 'Wasi Karan', 'brainmaster816@gmail.com', '03001234567', 'Gulistan-e-Johar', 'Karachi', '75000', '', '', '2025-07-09 13:36:51', 'completed', NULL, NULL, 'Foundation,Compact', '2,1', 'Cosmetics,Cosmetics', '1900', 0.00, NULL),
(73, 'MUHAMMAD HAMZA', 'hamzarashid@gmail.com', '03124545455', '233asdasca', 'lahore', '75850', 'cod', '\n\nProducts:\nBlack Floral Wrap Midi Skirt (Qty: 1, Category: General)', '2025-07-09 15:42:58', 'completed', NULL, NULL, 'Black Floral Wrap Midi Skirt', '1', 'General', '25', 0.00, NULL),
(74, 'MUHAMMAD HAMZA', 'hamzarashid@gmail.com', '03124545455', 'surjani', 'karachi', '75850', 'cod', '\n\nProducts:\nDiamond Stud Earrings (Qty: 1, Category: General)', '2025-07-09 15:52:55', 'completed', NULL, NULL, 'Diamond Stud Earrings', '1', 'General', '199.99', 0.00, NULL),
(75, 'MUHAMMAD HAMZA', 'hamzarashid@gmail.com', '03124545455', 'dsadsd', 'karachi', '75850', 'cod', '\n\nProducts:\n4K Smart TV (Qty: 1, Category: General)\nClassic Black Suit (Qty: 1, Category: General)', '2025-07-09 16:03:25', 'completed', NULL, NULL, '4K Smart TV, Classic Black Suit', '1, 1', 'General, General', '1099.98', 0.00, NULL),
(76, 'hamza rashid', 'hamzarashid7966@gmail.com', '03124545455', 'aptech north karachi', 'karachi', '75850', 'bank', 'dasdasda\n\nProducts:\nWasi Karan (Qty: 1, Category: General)', '2025-07-10 10:30:48', 'completed', NULL, NULL, 'Wasi Karan', '1', 'General', '4673', 0.00, NULL),
(77, 'ASDASD', 'hamzarashid@gmail.com', '03124545455', '2ASDASDASD', 'karachi', '75782', 'cod', '\n\nProducts:\nDiamond Stud Earrings (Qty: 1, Category: earrings)', '2025-07-17 20:00:55', 'pending', NULL, NULL, 'Diamond Stud Earrings', '1', 'earrings', '199.99', 0.00, NULL),
(78, 'MUHAMMAD HAMZA', 'hamzarashid@gmail.com', '03124545455', 'your address', 'karachi', '43212', 'cod', 's\n\nProducts:\nLeather Formal Shoes (Qty: 1, Category: formal)\nPersonal Formal Shirt (Qty: 1, Category: General)', '2025-07-17 20:43:26', 'completed', NULL, NULL, 'Leather Formal Shoes, Personal Formal Shirt', '1, 1', 'formal, General', '249.98', 0.00, NULL),
(79, 'MUHAMMAD HAMZA', 'hamzarashid@gmail.com', '03124545455', '231', 'karachi', '2313', 'cod', '13\n\nProducts:\nLeather Formal Shoes (Qty: 1, Category: formal)', '2025-07-17 20:47:11', 'pending', NULL, NULL, 'Leather Formal Shoes', '1', 'formal', '159.99', 0.00, NULL),
(80, 'asd', 'hara@gmail.com', '03124545455', 'sadasdad', 'karachi', '23413', 'cod', '\n\nProducts:\nLeather Formal Shoes (Qty: 1, Category: formal)', '2025-07-17 21:05:14', 'pending', NULL, NULL, 'Leather Formal Shoes', '1', 'formal', '159.99', 0.00, NULL),
(81, 'MUHAMMAD HAMZA', 'hara@gmail.com', '03124545455', '2313', 'karachi', '21212', 'bank', '\n\nProducts:\nClassic Black Suit (Qty: 1, Category: formal)', '2025-07-17 21:07:11', 'pending', NULL, NULL, 'Classic Black Suit', '1', 'formal', '299.99', 0.00, NULL),
(82, 'Hamza Rashid', 'hara@gmail.com', '123123', '231', 'karachi', '23131', 'cod', '\n\nProducts:\nKids Casual Outfit (Qty: 1, Category: casual)\nCouple Wedding Rings (Qty: 3, Category: couplerings)\nWaterproof Eyeliner (Qty: 3, Category: eyeliner)', '2025-07-17 21:08:44', 'pending', NULL, NULL, 'Kids Casual Outfit, Couple Wedding Rings, Waterproof Eyeliner', '1, 3, 3', 'casual, couplerings, eyeliner', '999.93', 0.00, NULL),
(83, 'MUHAMMAD HAMZA', 'hamzarashid7966@gmail.com', '03124545455', '231313', 'karachi', '23131', 'bank', '13\n\nProducts:\nDiamond Stud Earrings (Qty: 1, Category: earrings)', '2025-07-17 21:10:33', 'pending', NULL, NULL, 'Diamond Stud Earrings', '1', 'earrings', '199.99', 0.00, NULL),
(84, 'Hamza Rashid', 'hamzarashid7966@gmail.com', '03124545455', '2313sdasd', 'karachi', '24312', 'cod', '\n\nProducts:\nCotton T-Shirt (Qty: 3, Category: tshirts)', '2025-07-17 23:05:14', 'completed', NULL, NULL, 'Cotton T-Shirt', '3', 'tshirts', '89.97', 0.00, NULL),
(85, 'Hamza Rashid', 'hamzarashid7966@gmail.com', '03124545455', 'asdadsdas', 'karachi', '23121', 'cod', '\n\nProducts:\nLeather Formal Shoes (Qty: 2, Category: formal)', '2025-07-18 14:54:17', 'pending', NULL, NULL, 'Leather Formal Shoes', '2', 'formal', '319.98', 0.00, NULL),
(86, 'Hamza Rashid', 'hamzarashid7966@gmail.com', '03124545455', '231312', 'karachi', '23122', 'cod', '\n\nProducts:\nadas (Qty: 1, Category: General)', '2025-07-18 14:57:10', 'completed', NULL, NULL, 'adas', '1', 'General', '24', 0.00, NULL),
(87, 'Hamza Rashid', 'hamzarashid7966@gmail.com', '03124545455', 'ssssss', 'karachi', '212121', 'cod', 'sscs\n\nProducts:\nadas (Qty: 1, Category: General)', '2025-08-21 18:19:27', 'pending', NULL, NULL, 'adas', '1', 'General', '12', 0.00, ''),
(88, 'Hamza Rashid', 'hamzarashid7966@gmail.com', '03124545455', '2222222222', 'karachi', '22121', 'cod', 'sss\nCoupon Applied: SPINBB417976 (Discount: $9.60)\n\nProducts:\nadas (Qty: 1, Category: General)', '2025-08-21 18:25:24', 'processing', NULL, NULL, 'adas', '1', 'General', '2.4', 9.60, 'SPINBB417976'),
(91, 'Hamza Rashid', 'hamzarashid221@gmail.com', '03124545455', '232313', 'karachi', '23132', 'cod', 'ssssssss\nCoupon Applied: SPINF55C30B2 (Discount: $178.20)\n\nProducts:\nCasual Brown Shoes (Qty: 3, Category: formal)', '2025-08-21 21:24:40', 'completed', NULL, NULL, 'Casual Brown Shoes', '3', 'formal', '118.8', 178.20, 'SPINF55C30B2');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `category`) VALUES
(4, 73, 'wf001', 'Black Floral Wrap Midi Skirt', 25.00, 1, 'General'),
(5, 74, 'je001', 'Diamond Stud Earrings', 199.99, 1, 'General'),
(6, 75, 'estv001', '4K Smart TV', 799.99, 1, 'General'),
(7, 75, 'mf001', 'Classic Black Suit', 299.99, 1, 'General'),
(8, 76, 'mf686d17c25fa76', 'Wasi Karan', 4673.00, 1, 'General'),
(9, 77, 'je001', 'Diamond Stud Earrings', 199.99, 1, 'earrings'),
(10, 78, 'mf003', 'Leather Formal Shoes', 159.99, 1, 'formal'),
(11, 78, 'mf002', 'Personal Formal Shirt', 89.99, 1, 'General'),
(12, 79, 'mf003', 'Leather Formal Shoes', 159.99, 1, 'formal'),
(13, 80, 'mf003', 'Leather Formal Shoes', 159.99, 1, 'formal'),
(14, 81, 'mf001', 'Classic Black Suit', 299.99, 1, 'formal'),
(15, 82, 'kc001', 'Kids Casual Outfit', 39.99, 1, 'casual'),
(16, 82, 'jc001', 'Couple Wedding Rings', 299.99, 3, 'couplerings'),
(17, 82, 'me001', 'Waterproof Eyeliner', 19.99, 3, 'eyeliner'),
(18, 83, 'je001', 'Diamond Stud Earrings', 199.99, 1, 'earrings'),
(19, 84, 'mt001', 'Cotton T-Shirt', 29.99, 3, 'tshirts'),
(20, 85, 'mf003', 'Leather Formal Shoes', 159.99, 2, 'formal'),
(21, 86, 'mf687a6078a8df4', 'adas', 24.00, 1, 'General'),
(22, 87, 'wf688bb43630607', 'adas', 12.00, 1, 'General'),
(23, 88, 'wf688bb43630607', 'adas', 12.00, 1, 'General'),
(26, 91, 'mf004', 'Casual Brown Shoes', 99.00, 3, 'formal');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `hover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `in_stock` tinyint(1) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `original_price`, `image`, `hover_image`, `description`, `brand`, `rating`, `in_stock`, `category`) VALUES
('em001', 'Wireless Gaming Mouse', 59.99, 79.99, '/assets/images/electronics-banner-2.jpg', '/assets/images/electronics-banner-1.jpg', 'High-precision wireless gaming mouse', 'GameTech', 4, 1, 'mouse'),
('emic001', 'USB Microphone', 89.99, 120.00, '/assets/images/electronics-banner-1.jpg', '/assets/images/electronics-banner-2.jpg', 'Professional USB microphone for streaming', 'AudioPro', 4, 1, 'microphone'),
('estv001', '4K Smart TV', 799.99, 999.99, '/assets/images/electronics-banner-1.jpg', '/assets/images/electronics-banner-2.jpg', 'Ultra HD 4K Smart TV with streaming apps', 'VisionTech', 5, 1, 'stv'),
('esw001', 'Smart Watch Pro', 299.99, 399.99, '/assets/images/products/watch-1.jpg', '/assets/images/products/watch-2.jpg', 'Advanced smartwatch with health monitoring', 'TechPro', 5, 1, 'sw'),
('jb001', 'Gold Bracelet', 179.99, 229.99, '/assets/images/products/jewellery-1.jpg', '/assets/images/products/jewellery-2.jpg', 'Elegant gold bracelet', 'GoldCraft', 4, 1, 'bracelet'),
('jc001', 'Couple Wedding Rings', 299.99, 399.99, '/assets/images/products/jewellery-1.jpg', '/assets/images/products/jewellery-2.jpg', 'Beautiful couple wedding rings set', 'LoveRings', 5, 1, 'couplerings'),
('je001', 'Diamond Stud Earrings', 199.99, 299.99, '/assets/images/products/jewellery-1.jpg', '/assets/images/products/jewellery-2.jpg', 'Elegant diamond stud earrings', 'DiamondLux', 5, 1, 'earrings'),
('jn001', 'Pearl Necklace', 149.99, 199.99, '/assets/images/products/jewellery-1.jpg', '/assets/images/products/jewellery-2.jpg', 'Classic pearl necklace', 'PearlElegance', 4, 1, 'necklace'),
('kc001', 'Kids Casual Outfit', 39.99, 49.99, '/assets/images/products/3.jpg', '/assets/images/products/4.jpg', 'Comfortable casual outfit for kids', 'KidsComfort', 5, 1, 'casual'),
('kf001', 'Kids Formal Suit', 79.99, 99.99, '/assets/images/products/1.jpg', '/assets/images/products/2.jpg', 'Adorable formal suit for kids', 'KidsFashion', 4, 1, 'formal'),
('ks001', 'Kids Summer Shorts', 24.99, 29.99, '/assets/images/products/shorts-1.jpg', '/assets/images/products/shorts-2.jpg', 'Comfortable summer shorts for kids', 'SummerKids', 4, 1, 'shorts'),
('kt001', 'Kids Formal Trousers', 34.99, 44.99, '/assets/images/products/1.jpg', '/assets/images/products/2.jpg', 'Formal trousers for kids', 'KidsFormal', 4, 1, 'trousers'),
('kt001b', 'Kids Cotton T-Shirt', 19.99, 24.99, '/assets/images/products/2.jpg', '/assets/images/products/3.jpg', 'Soft cotton t-shirt for kids', 'KidsComfort', 5, 1, 'tshirts'),
('mas001', 'Aviator Sunglasses', 89.99, 120.00, '/assets/images/products/glasses.jpg', '/assets/images/products/glasses.jpg', 'Classic aviator sunglasses', 'SunStyle', 4, 1, 'sunglasses'),
('mas002', 'Casual Sneakers', 79.99, 99.99, '/assets/images/products/sports-2.jpg', '/assets/images/products/sports-4.jpg', 'Comfortable casual sneakers', 'SportStyle', 4, 1, 'shoes'),
('maw001', 'Luxury Watch', 299.99, 399.99, '/assets/images/products/watch-1.jpg', '/assets/images/products/watch-2.jpg', 'Premium luxury watch', 'TimeLux', 5, 1, 'watches'),
('maw002', 'Leather Wallet', 59.99, 79.99, '/assets/images/products/shoe-1.jpg', '/assets/images/products/shoe-1_1.jpg', 'Premium leather wallet', 'LeatherCraft', 4, 1, 'wallets'),
('mc001', 'Casual Brown Shoes', 99.00, 105.00, '/assets/images/products/shoe-2.jpg', '/assets/images/products/shoe-2_1.jpg', 'Comfortable brown casual shoes for everyday wear', 'ComfortStep', 5, 1, 'casual'),
('mc002', 'Winter Leather Jacket', 189.99, 250.00, '/assets/images/products/jacket-1.jpg', '/assets/images/products/jacket-2.jpg', 'Stylish winter leather jacket for casual wear', 'StyleCraft', 4, 1, 'casual'),
('me001', 'Waterproof Eyeliner', 19.99, 24.99, '/assets/images/products/perfume.jpg', '/assets/images/products/perfume.jpg', 'Smudge-proof waterproof eyeliner', 'EyePerfect', 5, 1, 'eyeliner'),
('mf001', 'Classic Black Suit', 299.99, 399.99, '/assets/images/products/jacket-3.jpg', '/assets/images/products/jacket-4.jpg', 'Premium wool blend suit perfect for formal occasions', 'StyleCraft', 4, 1, 'formal'),
('mf002', 'Personal Formal Shirt', 89.99, 120.00, '/assets/images/products/shirt-1.jpg', '/assets/images/products/shirt-2.jpg', 'Cotton formal shirt with modern fit', 'FormalWear', 5, 1, 'formal'),
('mf003', 'Leather Formal Shoes', 159.99, 199.99, '/assets/images/products/shoe-1.jpg', '/assets/images/products/shoe-1_1.jpg', 'Genuine leather formal shoes with comfortable sole', 'FormalStep', 4, 1, 'formal'),
('mf004', 'Casual Brown Shoes', 99.00, 105.00, '/assets/images/products/shoe-2.jpg', '/assets/images/products/shoe-2_1.jpg', 'Comfortable brown casual shoes for everyday wear', 'ComfortStep', 5, 1, 'formal'),
('mj001', 'Fleece Full-Zip Jacket', 58.00, 65.00, '/assets/images/products/jacket-5.jpg', '/assets/images/products/jacket-6.jpg', 'Warm fleece jacket with full-zip design', 'StyleCraft', 3, 1, 'jackets'),
('ml001', 'Matte Lipstick', 24.99, 29.99, '/assets/images/products/perfume.jpg', '/assets/images/products/perfume.jpg', 'Long-lasting matte lipstick', 'BeautyPro', 4, 1, 'lipstick'),
('mm001', 'Volume Mascara', 29.99, 34.99, '/assets/images/products/perfume.jpg', '/assets/images/products/perfume.jpg', 'Volumizing mascara for dramatic lashes', 'LashPerfect', 5, 1, 'mascara'),
('mp001', 'Face Primer', 34.99, 39.99, '/assets/images/products/perfume.jpg', '/assets/images/products/perfume.jpg', 'Smoothing face primer for flawless makeup', 'PrimePerfect', 4, 1, 'primer'),
('ms001', 'French Terry Sweatshorts', 78.00, 85.00, '/assets/images/products/shorts-1.jpg', '/assets/images/products/shorts-2.jpg', 'Comfortable French terry sweatshorts', 'ComfortWear', 3, 1, 'shorts'),
('mt001', 'Cotton T-Shirt', 29.99, 39.99, '/assets/images/products/2.jpg', '/assets/images/products/3.jpg', '100% cotton comfortable t-shirt', 'ComfortWear', 4, 1, 'tshirts'),
('pf001', 'Rose Garden Perfume', 89.99, 120.00, '/assets/images/products/perfume.jpg', '/assets/images/products/perfume.jpg', 'Elegant floral perfume with rose notes', 'FloralScents', 5, 1, 'floral'),
('pfo001', 'Fresh Fougère', 69.99, 89.99, '/assets/images/products/perfume.jpg', '/assets/images/products/perfume.jpg', 'Fresh fougère perfume with herbal notes', 'FreshScents', 4, 1, 'fougere'),
('po001', 'Oriental Spice', 99.99, 130.00, '/assets/images/products/perfume.jpg', '/assets/images/products/perfume.jpg', 'Rich oriental perfume with spicy notes', 'OrientalLux', 4, 1, 'oriental'),
('pw001', 'Sandalwood Essence', 79.99, 99.99, '/assets/images/products/perfume.jpg', '/assets/images/products/perfume.jpg', 'Warm woody perfume with sandalwood base', 'WoodScents', 4, 1, 'woody'),
('wd001', 'Silk Dupatta', 49.99, 69.99, '/assets/images/products/clothes-3.jpg', '/assets/images/products/clothes-4.jpg', 'Elegant silk dupatta with beautiful embroidery', 'SilkCraft', 4, 1, 'dupattas&shawls'),
('wf001', 'Black Floral Wrap Midi Skirt', 25.00, 35.00, '/assets/images/products/clothes-3.jpg', '/assets/images/products/clothes-4.jpg', 'Elegant floral wrap midi skirt perfect for formal occasions', 'FashionPlus', 5, 1, 'formal'),
('wk001', 'Traditional Kurta Set', 89.99, 120.00, '/assets/images/products/clothes-3.jpg', '/assets/images/products/clothes-4.jpg', 'Beautiful traditional kurta with matching dupatta', 'EthnicWear', 4, 1, 'kurtas&suits'),
('wl001', 'Designer Lehenga Choli', 299.99, 450.00, '/assets/images/products/clothes-3.jpg', '/assets/images/products/clothes-4.jpg', 'Stunning designer lehenga choli for special occasions', 'DesignerWear', 5, 1, 'lehenga&cholis'),
('ws001', 'Silk Saree', 199.99, 299.99, '/assets/images/products/clothes-3.jpg', '/assets/images/products/clothes-4.jpg', 'Premium silk saree with intricate designs', 'SilkTradition', 5, 1, 'saree');

-- --------------------------------------------------------

--
-- Table structure for table `session_cart`
--

CREATE TABLE `session_cart` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(500) NOT NULL,
  `product_category` varchar(100) DEFAULT 'General',
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spin_wheel_coupons`
--

CREATE TABLE `spin_wheel_coupons` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prize_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `used_at` datetime DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spin_wheel_coupons`
--

INSERT INTO `spin_wheel_coupons` (`id`, `user_id`, `prize_id`, `code`, `is_used`, `used_at`, `expires_at`, `created_at`) VALUES
(1, 105, 1, 'SPIN815E3765', 0, NULL, '2025-08-17 11:25:20', '2025-08-16 09:25:20'),
(2, 104, 2, 'SPINFC9891CF', 0, NULL, '2025-08-17 11:29:55', '2025-08-16 09:29:55'),
(3, 105, 6, 'SPINBB417976', 1, '2025-08-21 23:25:24', '2025-08-22 19:27:39', '2025-08-21 17:27:39'),
(4, 104, 5, 'SPINF44BA6C9', 1, '2025-08-22 00:31:29', '2025-08-22 21:30:53', '2025-08-21 19:30:53'),
(5, 116, 5, 'SPINB5F12FEF', 1, '2025-08-22 00:47:42', '2025-08-22 21:45:57', '2025-08-21 19:45:57'),
(6, 117, 8, 'SPINF55C30B2', 1, '2025-08-22 02:24:40', '2025-08-22 23:23:51', '2025-08-21 21:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `spin_wheel_prizes`
--

CREATE TABLE `spin_wheel_prizes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL DEFAULT 'percentage',
  `discount_value` decimal(10,2) NOT NULL,
  `probability` int(11) NOT NULL DEFAULT 10 COMMENT '1-100, higher means more chance',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spin_wheel_prizes`
--

INSERT INTO `spin_wheel_prizes` (`id`, `name`, `description`, `discount_type`, `discount_value`, `probability`, `is_active`, `created_at`, `updated_at`) VALUES
(2, '100%discount', 'get 100% discount', 'percentage', 100.00, 100, 1, '2025-08-16 09:28:11', '2025-08-16 09:28:11'),
(5, '90% discount', 'get 90 % off', 'percentage', 90.00, 80, 1, '2025-08-16 09:47:24', '2025-08-16 09:47:24'),
(6, '80% discount', 'get 80% off', 'percentage', 80.00, 90, 1, '2025-08-16 09:48:32', '2025-08-16 09:48:32'),
(7, '70% discount', 'get 70% discount', 'percentage', 70.00, 90, 1, '2025-08-21 18:47:40', '2025-08-21 18:47:40'),
(8, '60% discount	', 'get 60% discount', 'percentage', 60.00, 90, 1, '2025-08-21 18:48:05', '2025-08-21 18:48:05'),
(9, '50% discount	', 'get 50% discount', 'percentage', 50.00, 90, 1, '2025-08-21 18:48:26', '2025-08-21 18:48:26'),
(10, '40% discount', 'get 40% discount', 'percentage', 40.00, 90, 1, '2025-08-21 18:48:44', '2025-08-21 18:48:44'),
(11, '30% discount', 'get 30% discount', 'percentage', 30.00, 90, 1, '2025-08-21 18:48:58', '2025-08-21 18:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`id`, `category`, `question`, `answer`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'orders', 'How can I track my order?', 'Once your order is shipped, you\'ll receive a tracking number via email. You can use this number to track your package on our website or the carrier\'s website. You can also log into your account to view order status and tracking information.', 1, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(2, 'orders', 'What are your shipping options and costs?', 'We offer several shipping options:\n\n• Standard Shipping (5-7 business days): $5.99\n• Express Shipping (2-3 business days): $12.99\n• Overnight Shipping (1 business day): $24.99\n• Free Standard Shipping on orders over $55', 2, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(3, 'orders', 'Do you ship internationally?', 'Yes, we ship to over 100 countries worldwide. International shipping costs and delivery times vary by destination. Additional customs duties and taxes may apply and are the responsibility of the customer.', 3, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(4, 'orders', 'How long does processing take before my order ships?', 'Most orders are processed within 1-2 business days. During peak seasons or sales events, processing may take up to 3-5 business days. You\'ll receive a confirmation email once your order has been processed and shipped.', 4, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(5, 'returns', 'What is your return policy?', 'We offer a 30-day return policy for most items. Items must be in original condition with tags attached and in original packaging. Some items like underwear, swimwear, and personalized items are not eligible for return for hygiene reasons.', 5, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(6, 'returns', 'How do I initiate a return or exchange?', 'To start a return or exchange:\n\n1. Log into your account and go to \"Order History\"\n2. Select the order and click \"Return Items\"\n3. Choose the items you want to return and the reason\n4. Print the prepaid return label\n5. Package the items and ship them back to us', 6, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(7, 'returns', 'Who pays for return shipping?', 'Return shipping is free for defective items or our errors. For other returns, a $6.99 return shipping fee will be deducted from your refund. Exchanges for size or color are free if initiated within 14 days of delivery.', 7, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(8, 'returns', 'How long does it take to process a refund?', 'Once we receive your returned items, refunds are typically processed within 3-5 business days. It may take an additional 3-7 business days for the refund to appear on your original payment method, depending on your bank or credit card company.', 8, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(9, 'account', 'What payment methods do you accept?', 'We accept all major credit cards (Visa, MasterCard, American Express, Discover), PayPal, Apple Pay, Google Pay, and Shop Pay. All payments are processed securely using SSL encryption.', 9, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(10, 'account', 'Do I need to create an account to place an order?', 'No, you can checkout as a guest. However, creating an account allows you to track orders, save addresses, view order history, and receive exclusive offers. It also makes future purchases faster and easier.', 10, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(11, 'account', 'How do I reset my password?', 'Click \"Forgot Password\" on the login page, enter your email address, and we\'ll send you a password reset link. Follow the instructions in the email to create a new password. If you don\'t receive the email, check your spam folder.', 11, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(12, 'account', 'Is my personal information secure?', 'Yes, we take your privacy and security seriously. We use industry-standard SSL encryption to protect your personal and payment information. We never store your credit card details on our servers, and we don\'t share your information with third parties without your consent.', 12, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(13, 'products', 'How do I find the right size?', 'Each product page includes a detailed size chart. We recommend measuring yourself and comparing to our size guide for the best fit. If you\'re between sizes, we generally recommend sizing up. You can also read customer reviews for fit feedback.', 13, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(14, 'products', 'Are the colors accurate on your website?', 'We strive to display colors as accurately as possible, but colors may vary slightly due to monitor settings and lighting conditions. If color is critical to your purchase, we recommend ordering samples when available or taking advantage of our easy return policy.', 14, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(15, 'products', 'How do I care for my items?', 'Care instructions are provided on each product page and on the care label attached to your item. Generally, we recommend following the care label instructions, washing in cold water, and air drying when possible to maintain the quality and longevity of your items.', 15, '2025-07-09 10:26:48', '2025-07-09 10:26:48'),
(16, 'products', 'Do you restock sold-out items?', 'We regularly restock popular items, but availability depends on various factors. You can sign up for restock notifications on product pages to be alerted when items become available again. Follow us on social media for updates on new arrivals and restocks.', 16, '2025-07-09 10:26:48', '2025-07-09 10:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer_settings`
--

CREATE TABLE `tbl_footer_settings` (
  `id` int(11) NOT NULL,
  `footer_copyright` text DEFAULT NULL,
  `contact_address` text DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_footer_settings`
--

INSERT INTO `tbl_footer_settings` (`id`, `footer_copyright`, `contact_address`, `contact_email`, `contact_phone`) VALUES
(1, '© 2025 My E-Commerce Website. All rights reserved.', '123 Main Street, Karachi, Pakistan', 'hawaan@gmail.com', '+92-300-1234567');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `icon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`id`, `title`, `content`, `photo`, `icon`) VALUES
(0, 'Curated Collections', 'Our fashion experts handpick every item to ensure quality, style, and current trends.', '', 'bi-stars'),
(0, 'Fast Fashion', 'New arrivals every week to keep your wardrobe fresh and on-trend.', '', 'bi-rocket-fill'),
(0, 'Perfect Fit', 'Detailed sizing guides and fit recommendations for every body type.', '', 'bi-shirt'),
(0, 'Easy Exchanges', 'Hassle-free returns and exchanges within 30 days of purchase.', '', 'bi-arrow-repeat'),
(0, 'Eco-Conscious', 'Increasing selection of sustainable fabrics and ethical production.', '', 'bi-leaf'),
(0, 'Style Advice', 'Personal stylists available to help you create perfect outfits.', '', 'bi-star'),
(0, 'Hamza', 'nothing', '', 'bi bi-rocket-fill');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `footer_about` text DEFAULT NULL,
  `footer_copyright` text DEFAULT NULL,
  `contact_address` text DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_fax` varchar(255) DEFAULT NULL,
  `contact_map_iframe` text DEFAULT NULL,
  `receive_email` varchar(255) DEFAULT NULL,
  `receive_email_subject` varchar(255) DEFAULT NULL,
  `receive_email_thank_you_message` text DEFAULT NULL,
  `forget_password_message` text DEFAULT NULL,
  `total_recent_post_footer` int(10) DEFAULT 0,
  `total_popular_post_footer` int(10) DEFAULT 0,
  `total_recent_post_sidebar` int(11) DEFAULT 0,
  `total_popular_post_sidebar` int(11) DEFAULT 0,
  `total_featured_product_home` int(11) DEFAULT 0,
  `total_latest_product_home` int(11) DEFAULT 0,
  `total_popular_product_home` int(11) DEFAULT 0,
  `meta_title_home` text DEFAULT NULL,
  `meta_keyword_home` text DEFAULT NULL,
  `meta_description_home` text DEFAULT NULL,
  `banner_login` varchar(255) DEFAULT NULL,
  `banner_registration` varchar(255) DEFAULT NULL,
  `banner_forget_password` varchar(255) DEFAULT NULL,
  `banner_reset_password` varchar(255) DEFAULT NULL,
  `banner_search` varchar(255) DEFAULT NULL,
  `banner_cart` varchar(255) DEFAULT NULL,
  `banner_checkout` varchar(255) DEFAULT NULL,
  `banner_product_category` varchar(255) DEFAULT NULL,
  `banner_blog` varchar(255) DEFAULT NULL,
  `cta_title` varchar(255) DEFAULT NULL,
  `cta_content` text DEFAULT NULL,
  `cta_read_more_text` varchar(255) DEFAULT NULL,
  `cta_read_more_url` varchar(255) DEFAULT NULL,
  `cta_photo` varchar(255) DEFAULT NULL,
  `featured_product_title` varchar(255) DEFAULT NULL,
  `featured_product_subtitle` varchar(255) DEFAULT NULL,
  `latest_product_title` varchar(255) DEFAULT NULL,
  `latest_product_subtitle` varchar(255) DEFAULT NULL,
  `popular_product_title` varchar(255) DEFAULT NULL,
  `popular_product_subtitle` varchar(255) DEFAULT NULL,
  `testimonial_title` varchar(255) DEFAULT NULL,
  `testimonial_subtitle` varchar(255) DEFAULT NULL,
  `testimonial_photo` varchar(255) DEFAULT NULL,
  `blog_title` varchar(255) DEFAULT NULL,
  `blog_subtitle` varchar(255) DEFAULT NULL,
  `newsletter_text` text DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `stripe_public_key` varchar(255) DEFAULT NULL,
  `stripe_secret_key` varchar(255) DEFAULT NULL,
  `bank_detail` text DEFAULT NULL,
  `before_head` text DEFAULT NULL,
  `after_body` text DEFAULT NULL,
  `before_body` text DEFAULT NULL,
  `home_service_on_off` int(11) DEFAULT 0,
  `home_welcome_on_off` int(11) DEFAULT 0,
  `home_featured_product_on_off` int(11) DEFAULT 0,
  `home_latest_product_on_off` int(11) DEFAULT 0,
  `home_popular_product_on_off` int(11) DEFAULT 0,
  `home_testimonial_on_off` int(11) DEFAULT 0,
  `home_blog_on_off` int(11) DEFAULT 0,
  `newsletter_on_off` int(11) DEFAULT 0,
  `ads_above_welcome_on_off` int(1) DEFAULT 0,
  `ads_above_featured_product_on_off` int(1) DEFAULT 0,
  `ads_above_latest_product_on_off` int(1) DEFAULT 0,
  `ads_above_popular_product_on_off` int(1) DEFAULT 0,
  `ads_above_testimonial_on_off` int(1) DEFAULT 0,
  `ads_category_sidebar_on_off` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `logo`, `favicon`, `footer_about`, `footer_copyright`, `contact_address`, `contact_email`, `contact_phone`, `contact_fax`, `contact_map_iframe`, `receive_email`, `receive_email_subject`, `receive_email_thank_you_message`, `forget_password_message`, `total_recent_post_footer`, `total_popular_post_footer`, `total_recent_post_sidebar`, `total_popular_post_sidebar`, `total_featured_product_home`, `total_latest_product_home`, `total_popular_product_home`, `meta_title_home`, `meta_keyword_home`, `meta_description_home`, `banner_login`, `banner_registration`, `banner_forget_password`, `banner_reset_password`, `banner_search`, `banner_cart`, `banner_checkout`, `banner_product_category`, `banner_blog`, `cta_title`, `cta_content`, `cta_read_more_text`, `cta_read_more_url`, `cta_photo`, `featured_product_title`, `featured_product_subtitle`, `latest_product_title`, `latest_product_subtitle`, `popular_product_title`, `popular_product_subtitle`, `testimonial_title`, `testimonial_subtitle`, `testimonial_photo`, `blog_title`, `blog_subtitle`, `newsletter_text`, `paypal_email`, `stripe_public_key`, `stripe_secret_key`, `bank_detail`, `before_head`, `after_body`, `before_body`, `home_service_on_off`, `home_welcome_on_off`, `home_featured_product_on_off`, `home_latest_product_on_off`, `home_popular_product_on_off`, `home_testimonial_on_off`, `home_blog_on_off`, `newsletter_on_off`, `ads_above_welcome_on_off`, `ads_above_featured_product_on_off`, `ads_above_latest_product_on_off`, `ads_above_popular_product_on_off`, `ads_above_testimonial_on_off`, `ads_category_sidebar_on_off`) VALUES
(1, 'logo.jpg', 'favicon.jpg', '<p>Lorem ipsum dolor sit amet, omnis signiferumque in mei, mei ex enim concludaturque. Senserit salutandi euripidis no per, modus maiestatis scribentur est an.Â Ea suas pertinax has.</p>\r\n', 'Copyright Â© 2022 - Ecommerce Website PHP - Developed By ', '', '', '', '', NULL, 'wasi@ecommercephp.com', 'Visitor Email Message from Ecommerce Site PHP', 'Thank you for sending email. We will contact you shortly.', 'A confirmation link is sent to your email address. You will get the password reset information in there.', 4, 4, 5, 5, 5, 6, 8, 'Ecommerce PHP', 'online fashion store, garments shop, online garments', 'ecommerce php project with mysql database', 'banner_login.jpg', 'banner_registration.jpg', 'banner_forget_password.jpg', 'banner_reset_password.jpg', 'banner_search.jpg', 'banner_cart.jpg', 'banner_checkout.jpg', 'banner_product_category.jpg', 'banner_blog.jpg', 'Welcome To Our Ecommerce Website', 'Lorem ipsum dolor sit amet, an labores explicari qui, eu nostrum copiosae argumentum has. Latine propriae quo no, unum ridens expetenda id sit, \r\nat usu eius eligendi singulis. Sea ocurreret principes ne. At nonumy aperiri pri, nam quodsi copiosae intellegebat et, ex deserunt euripidis usu. ', 'Read More', '#', 'cta.jpg', 'Featured Products', 'Our list on Top Featured Products', 'Latest Products', 'Our list of recently added products', 'Popular Products', 'Popular products based on customer\'s choice', 'Testimonials', 'See what our clients tell about us', 'testimonial.jpg', 'Latest Blog', 'See all our latest articles and news from below', 'Sign-up to our newsletter for latest promotions and discounts.', 'admin@ecom.com', 'pk_test_xxxxxxxxxxxxxxxxxxxxx', 'sk_test_xxxxxxxxxxxxxxxxxxxxx', 'Bank Name: WestView Bank\r\nAccount Number: CA100270589600\r\nBranch Name: CA Branch\r\nCountry: USA', '', '<div id=\"fb-root\"></div>\r\n<script>(function(d, s, id) {\r\n  var js, fjs = d.getElementsByTagName(s)[0];\r\n  if (d.getElementById(id)) return;\r\n  js = d.createElement(s); js.id = id;\r\n  js.src = \"//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=323620764400430\";\r\n  fjs.parentNode.insertBefore(js, fjs);\r\n}(document, \'script\', \'facebook-jssdk\'));</script>', '<!--Start of Tawk.to Script-->\r\n<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5ae370d7227d3d7edc24cb96/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>\r\n<!--End of Tawk.to Script-->', 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price_text` varchar(50) NOT NULL,
  `button_text` varchar(50) NOT NULL,
  `button_url` varchar(255) NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `image_url`, `subtitle`, `title`, `price_text`, `button_text`, `button_url`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'assets/images/banner-1.jpg', 'Trending item', 'Women\'s latest fashion sale', 'starting at $20.00', 'Shop now', '#', 1, 1, '2025-07-08 13:29:13', '2025-07-08 13:29:13'),
(2, 'assets/images/banner-2.jpg', 'Trending accessories', 'Modern sunglasses', 'starting at $15.00', 'Shop now', '#', 2, 1, '2025-07-08 13:29:13', '2025-07-08 13:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social`
--

CREATE TABLE `tbl_social` (
  `social_id` int(11) NOT NULL,
  `social_name` varchar(30) NOT NULL,
  `social_url` varchar(255) NOT NULL,
  `social_icon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_social`
--

INSERT INTO `tbl_social` (`social_id`, `social_name`, `social_url`, `social_icon`) VALUES
(1, 'Facebook', 'https://www.facebook.com', 'fa fa-facebook'),
(2, 'Twitter', 'https://www.twitter.com', 'fa fa-twitter'),
(3, 'LinkedIn', 'https://www.linkedin.com', 'fa fa-linkedin'),
(4, 'Google Plus', 'https://plus.google.com', 'fa fa-google-plus'),
(5, 'Pinterest', 'https://www.pinterest.com', 'fa fa-pinterest'),
(6, 'YouTube', 'https://www.youtube.com', 'fa fa-youtube'),
(7, 'Instagram', 'https://www.instagram.com', 'fa fa-instagram'),
(8, 'Tumblr', 'https://www.tumblr.com', 'fa fa-tumblr'),
(9, 'Flickr', 'https://www.flickr.com', 'fa fa-flickr'),
(10, 'Reddit', 'https://www.reddit.com', 'fa fa-reddit'),
(11, 'Snapchat', 'https://www.snapchat.com', 'fa fa-snapchat'),
(12, 'WhatsApp', 'https://www.whatsapp.com', 'fa fa-whatsapp'),
(13, 'Quora', 'https://www.quora.com', 'fa fa-quora'),
(14, 'StumbleUpon', 'https://www.stumbleupon.com', 'fa fa-stumbleupon'),
(15, 'Delicious', 'https://www.delicious.com', 'fa fa-delicious'),
(16, 'Digg', 'https://www.digg.com', 'fa fa-digg'),
(0, 'Facebook', 'https://www.facebook.com', ''),
(0, 'Twitter', 'https://www.twitter.com', ''),
(0, 'LinkedIn', 'https://www.linkedin.com', ''),
(0, 'Google Plus', 'https://plus.google.com', ''),
(0, 'Pinterest', 'https://www.pinterest.com', ''),
(0, 'YouTube', 'https://www.youtube.com', ''),
(0, 'Instagram', 'https://www.instagram.com', ''),
(0, 'Tumblr', 'https://www.tumblr.com', ''),
(0, 'Flickr', 'https://www.flickr.com', ''),
(0, 'Reddit', 'https://www.reddit.com', ''),
(0, 'Snapchat', 'https://www.snapchat.com', ''),
(0, 'WhatsApp', 'https://www.whatsapp.com', ''),
(0, 'Quora', 'https://www.quora.com', ''),
(0, 'StumbleUpon', 'https://www.stumbleupon.com', ''),
(0, 'Delicious', 'https://www.delicious.com', ''),
(0, 'Digg', 'https://www.digg.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriber`
--

CREATE TABLE `tbl_subscriber` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subscriber`
--

INSERT INTO `tbl_subscriber` (`id`, `name`, `email`, `subscribed_at`) VALUES
(1, 'wasi karan', 'wasik5738@gmail.com', '2025-07-08 15:13:42'),
(2, 'Ali Khan', 'ali.khan@example.com', '2025-07-09 11:27:41'),
(3, 'Sara Ahmed', 'sara.ahmed@example.com', '2025-07-09 11:27:41'),
(4, 'Usman Tariq', 'usman.tariq@example.com', '2025-07-09 11:27:41'),
(5, 'Fatima Noor', 'fatima.noor@example.com', '2025-07-09 11:27:41'),
(6, 'Zain Raza', 'zain.raza@example.com', '2025-07-09 11:27:41'),
(7, 'Hira Saeed', 'hira.saeed@example.com', '2025-07-09 11:27:41'),
(8, 'Hamza Ali', 'hamza.ali@example.com', '2025-07-09 11:27:41'),
(9, 'Ayesha Shah', 'ayesha.shah@example.com', '2025-07-09 11:27:41'),
(10, 'Bilal Mehmood', 'bilal.mehmood@example.com', '2025-07-09 11:27:41'),
(11, 'Maha Nadeem', 'maha.nadeem@example.com', '2025-07-09 11:27:41'),
(12, 'Tariq Jamil', 'tariq.jamil@example.com', '2025-07-09 11:27:41'),
(13, 'Laiba Khan', 'laiba.khan@example.com', '2025-07-09 11:27:41'),
(14, 'Omar Farooq', 'omar.farooq@example.com', '2025-07-09 11:27:41'),
(15, 'Anaya Iqbal', 'anaya.iqbal@example.com', '2025-07-09 11:27:41'),
(16, 'Shahid Rehman', 'shahid.rehman@example.com', '2025-07-09 11:27:41'),
(17, 'Komal Zafar', 'komal.zafar@example.com', '2025-07-09 11:27:41'),
(18, 'Sohail Ahmed', 'sohail.ahmed@example.com', '2025-07-09 11:27:41'),
(19, 'Iqra Javaid', 'iqra.javaid@example.com', '2025-07-09 11:27:41'),
(20, 'Imran Qureshi', 'imran.qureshi@example.com', '2025-07-09 11:27:41'),
(23, 'Nimra Saleem', 'nimra.saleem@example.com', '2025-07-09 11:27:41'),
(24, 'Zeeshan Ali', 'zeeshan.ali@example.com', '2025-07-09 11:27:41'),
(25, 'Hania Mirza', 'hania.mirza@example.com', '2025-07-09 11:27:41'),
(26, 'Farhan Zubair', 'farhan.zubair@example.com', '2025-07-09 11:27:41'),
(27, 'Kiran Aslam', 'kiran.aslam@example.com', '2025-07-09 11:27:41'),
(28, 'Abdullah Yasin', 'abdullah.yasin@example.com', '2025-07-09 11:27:41'),
(30, 'Jawad Anwar', 'jawad.anwar@example.com', '2025-07-09 11:27:41'),
(31, 'Neha Riaz', 'neha.riaz@example.com', '2025-07-09 11:27:41'),
(32, 'Rehan Sheikh', 'rehan.sheikh@example.com', '2025-07-09 11:27:41'),
(33, 'Momal Khan', 'momal.khan@example.com', '2025-07-09 11:27:41'),
(34, 'Faisal Shah', 'faisal.shah@example.com', '2025-07-09 11:27:41'),
(35, 'Lubna Irfan', 'lubna.irfan@example.com', '2025-07-09 11:27:41'),
(36, 'Salman Ayub', 'salman.ayub@example.com', '2025-07-09 11:27:41'),
(37, 'Nashit Iqbal', 'nashit.iqbal@example.com', '2025-07-09 11:27:41'),
(38, 'Maria Khan', 'maria.khan@example.com', '2025-07-09 11:27:41'),
(39, 'Yasir Mehmood', 'yasir.mehmood@example.com', '2025-07-09 11:27:41'),
(40, 'Nadia Farooq', 'nadia.farooq@example.com', '2025-07-09 11:27:41'),
(42, 'Hamza Rashid', 'hamzarashid7966@gmail.com', '2025-07-09 15:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `status`, `created_at`) VALUES
(3, 'Ali Raza', 'ali3@example.com', '$2y$10$abcdefghij1234567890uv', '1', '2025-07-08 12:27:23'),
(4, 'Fatima Noor', 'fatima4@example.com', '$2y$10$abcdefghij1234567890uv', '1', '2025-07-08 12:27:23'),
(5, 'Usman Tariq', 'usman5@example.com', '$2y$10$abcdefghij1234567890uv', '1', '2025-07-08 12:27:23'),
(6, 'Hina Sheikh', 'hina6@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(7, 'Bilal Qureshi', 'bilal7@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(8, 'Amna Iqbal', 'amna8@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(9, 'Hamza Ali', 'hamza9@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(10, 'Sara Zubair', 'sara10@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(11, 'Taha Jamil', 'taha11@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(12, 'Sania Khan', 'sania12@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(13, 'Noman Saleem', 'noman13@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(14, 'Hira Fatima', 'hira14@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(15, 'Kashif Raza', 'kashif15@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(16, 'Ayesha Malik', 'ayesha16@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(17, 'Zain Shah', 'zain17@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(18, 'Noor Jahan', 'noor18@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(19, 'Danish Iqbal', 'danish19@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(20, 'Mahnoor Azam', 'mahnoor20@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(21, 'Rehan Siddiqui', 'rehan21@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(22, 'Mehwish Tariq', 'mehwish22@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(23, 'Faisal Khan', 'faisal23@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(24, 'Sidra Noor', 'sidra24@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(25, 'Shahbaz Ali', 'shahbaz25@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(26, 'Iqra Jameel', 'iqra26@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(27, 'Jawad Khan', 'jawad27@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(28, 'Sadaf Qureshi', 'sadaf28@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(29, 'Omar Malik', 'omar29@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(30, 'Areeba Naveed', 'areeba30@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(31, 'Arsalan Khan', 'arsalan31@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(32, 'Maryam Shahid', 'maryam32@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(33, 'Farhan Aziz', 'farhan33@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(34, 'Rubina Aslam', 'rubina34@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(35, 'Hassan Rauf', 'hassan35@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(36, 'Beenish Khalid', 'beenish36@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(37, 'Saad Ahsan', 'saad37@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(38, 'Nida Ameen', 'nida38@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(39, 'Imran Shaikh', 'imran39@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(40, 'Kiran Faisal', 'kiran40@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(41, 'Wasif Rehman', 'wasif41@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(42, 'Nimra Asif', 'nimra42@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(43, 'Shayan Tariq', 'shayan43@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(44, 'Aqsa Kamal', 'aqsa44@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(45, 'Zohaib Khan', 'zohaib45@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(46, 'Rida Zahid', 'rida46@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(47, 'Asad Mehmood', 'asad47@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(48, 'Anum Yousaf', 'anum48@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(49, 'Waqas Gill', 'waqas49@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(50, 'Lubna Ansari', 'lubna50@example.com', '$2y$10$abcdefghij1234567890uv', 'active', '2025-07-08 12:27:23'),
(101, 'wasi', 'wasik5738@gmail.com', '$2y$10$F.dWbTE6SuGR8beoGJSqWeoWLorcHrDj63swuoDR2lKiE2IflkCju', '1', '2025-07-08 12:51:38'),
(102, 'Admin', 'admin@example.com', '0192023a7bbd73250516f069df18b500', '0', '2025-07-09 07:57:52'),
(104, 'wasi', 'brainmaster816@gmail.com', '$2y$10$0fxCTGXELPJHeTikCnVo..mSoo7oOiXPsoEpFB6MqoF8htqzFgGki', '0', '2025-07-09 12:57:45'),
(105, 'Hamza Rashid', 'hamzarashid7966@gmail.com', '$2y$10$t3XRfxfnuzvyqcrlq7L6k.U.6oD0O.mZ3oYiKicgzH0tsbkdGnoGq', '1', '2025-07-10 10:25:23'),
(106, 'suhaib hamza', 'suhaibhamza@gmail.com', '$2y$10$IsvBbXE2fJNEVEHaouTW.uEHC2EhTWbxl75Pyr0xU3BiqRCn1cgN2', 'active', '2025-07-17 19:18:37'),
(107, 'suhaib hamza', 'hara@gmail.com', '$2y$10$CEknvJIiVVdMNYtRHVXYEeOgzI8j4gjWVk9YOTR35.h66Onwhtp0C', 'active', '2025-07-17 20:36:51'),
(108, 'Hamza Rashid', 'suhaibhamz2a@gmail.com', '$2y$10$xzpGLEb6e5uYgkposUtYOOY.UwBiqLWcNQzafyAdbv20VoMsNvV7q', 'active', '2025-07-17 21:40:30'),
(109, 'adas', 'no@gmail.com', '$2y$10$p8MRDWETOa4RRD0mZJkeJOWVA3wyWWpbdZugaKzmjdG7dLIbMyJvO', 'active', '2025-07-17 22:06:22'),
(110, 'adas', 'dadasd@sd.cs', '$2y$10$k00IkGUq9Qqzlf33BEoOfudstpqax5JQ2nugF2vgUMfJNfyy3F4Ou', 'active', '2025-07-17 22:14:06'),
(111, 'adas', 'adasd@ddd.x', '$2y$10$fjZR7Qc5iCmH0/AzWB9oMes4pr.eb6k2ugEvw/K5dXNdJXVLh8ywe', 'active', '2025-07-17 22:14:27'),
(112, 'adas', 'dfsfdf@gmail.com', '$2y$10$Tvo0XH7EZSOjFR8BB9Ma1OP.iezxNPh5TfWuiCsToG/xXYnXhod2O', 'active', '2025-07-17 22:15:35'),
(113, 'adas', '2dsa@gmail.com', '$2y$10$JrH2IzQFZu8fv2zwNtWnDe9OXiDdxOJmlxa7.JcYDh83KLNIzR69W', 'active', '2025-07-17 22:16:48'),
(114, 'hamzarashid7966@gmail.com', 'ham2shid7966@gmail.com', '$2y$10$hUNWaG/M/XzkMKyy6xF2de5zT98kcDAI3YcjWpDTpVtW.yewq31uC', 'active', '2025-07-17 22:56:41'),
(115, 'adas', 'hamza2966@gmail.com', '$2y$10$c7Txy/3ijqgY60jPt/ZQ2ee/a4ZUvPrx9wYaSH2GuVZFYMOj7R3Nq', '0', '2025-07-17 23:09:41'),
(116, 'Hamza', 'hamzarashid796@gmail.com', '$2y$10$6769XD6y.8.OyB4bYxQjBuUgB09s0VKI6wsGgP9yK15qjNcWL73.K', 'active', '2025-08-21 19:45:52'),
(117, 'Hamza', 'hamzarashid221@gmail.com', '$2y$10$Ceu7COHkmVTKbYdO8pCrZ.S1HDkd.RsqadNQh/2VyJwHpIAA8i6PO', 'active', '2025-08-21 21:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(500) NOT NULL,
  `product_category` varchar(100) DEFAULT 'General',
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`id`, `user_id`, `product_id`, `product_name`, `product_price`, `product_image`, `product_category`, `quantity`, `created_at`, `updated_at`) VALUES
(8, 106, 'mf001', 'Classic Black Suit', 299.99, '/e commerce - Copy/assets/images/products/jacket-3.jpg', 'formal', 1, '2025-07-17 19:18:37', '2025-07-17 19:18:37'),
(21, 107, 'pf001', 'Rose Garden Perfume', 89.99, '/e commerce - Copy/assets/images/products/perfume.jpg', 'floral', 6, '2025-07-17 21:08:59', '2025-07-17 21:09:00'),
(48, 105, 'po688b9e2d1c456', 'Oriental', 12.00, '/HawaanEcommerce/assets/images/products/shoe-1.jpg', 'General', 7, '2025-08-21 19:15:37', '2025-08-21 21:19:19'),
(51, 116, 'wf688bb43630607', 'adas', 12.00, '/HawaanEcommerce/assets/images/products/shoe-1.jpg', 'General', 1, '2025-08-21 20:07:18', '2025-08-21 20:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_spin_logs`
--

CREATE TABLE `user_spin_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `spin_date` date NOT NULL,
  `spin_count` int(11) NOT NULL DEFAULT 1,
  `last_spin_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_spin_logs`
--

INSERT INTO `user_spin_logs` (`id`, `user_id`, `spin_date`, `spin_count`, `last_spin_at`) VALUES
(1, 105, '2025-08-16', 1, '2025-08-16 09:25:20'),
(2, 104, '2025-08-16', 1, '2025-08-16 09:29:55'),
(3, 105, '2025-08-21', 1, '2025-08-21 17:27:39'),
(4, 104, '2025-08-21', 1, '2025-08-21 19:30:53'),
(5, 116, '2025-08-21', 1, '2025-08-21 19:45:57'),
(6, 117, '2025-08-21', 1, '2025-08-21 21:23:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_cart`
--
ALTER TABLE `session_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_session_product` (`session_id`,`product_id`),
  ADD KEY `idx_session_id` (`session_id`),
  ADD KEY `idx_product_id` (`product_id`);

--
-- Indexes for table `spin_wheel_coupons`
--
ALTER TABLE `spin_wheel_coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prize_id` (`prize_id`);

--
-- Indexes for table `spin_wheel_prizes`
--
ALTER TABLE `spin_wheel_prizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_footer_settings`
--
ALTER TABLE `tbl_footer_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscriber`
--
ALTER TABLE `tbl_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_product` (`user_id`,`product_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_product_id` (`product_id`);

--
-- Indexes for table `user_spin_logs`
--
ALTER TABLE `user_spin_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_date` (`user_id`,`spin_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `session_cart`
--
ALTER TABLE `session_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `spin_wheel_coupons`
--
ALTER TABLE `spin_wheel_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `spin_wheel_prizes`
--
ALTER TABLE `spin_wheel_prizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_footer_settings`
--
ALTER TABLE `tbl_footer_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_subscriber`
--
ALTER TABLE `tbl_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_spin_logs`
--
ALTER TABLE `user_spin_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  ADD CONSTRAINT `add_to_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `add_to_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `cleanup_session_cart` ON SCHEDULE EVERY 1 DAY STARTS '2025-07-17 23:38:38' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM session_cart WHERE created_at < DATE_SUB(NOW(), INTERVAL 7 DAY)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
