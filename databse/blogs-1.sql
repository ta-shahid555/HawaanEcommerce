-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 08:06 AM
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
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `blog_name` varchar(255) NOT NULL,
  `auther_name` varchar(255) NOT NULL,
  `auther_img` varchar(500) DEFAULT NULL,
  `blog_img` varchar(500) DEFAULT NULL,
  `heading` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `blog_name`, `auther_name`, `auther_img`, `blog_img`, `heading`, `content`, `date`) VALUES
(1, 'Style Tips', 'Emily Rodriguez', 'assets/uploads/author-1.jpg', 'assets/uploads/blog-1.jpg', 'How to Build a Capsule Wardrobe', 'Learn the art of creating a versatile wardrobe with fewer pieces that work together seamlessly.', '2025-01-12'),
(2, 'Sustainable Fashion', 'Sarah Johnson', 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=50', 'https://images.pexels.com/photos/1040945/pexels-photo-1040945.jpeg?auto=compress&cs=tinysrgb&w=400', 'Eco-Friendly Fashion Brands to Watch', 'Discover sustainable fashion brands that are making a positive impact on the environment.', '2025-01-10'),
(3, 'Fashion Trends', 'Michael Chen', 'https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=50', 'https://images.pexels.com/photos/1183266/pexels-photo-1183266.jpeg?auto=compress&cs=tinysrgb&w=400', 'Color Trends for 2025', 'Explore the color palette that will dominate fashion in 2025 and how to incorporate them into your style.', '2025-01-08'),
(4, 'Shopping Guides', 'David Kim', 'https://images.pexels.com/photos/3760263/pexels-photo-3760263.jpeg?auto=compress&cs=tinysrgb&w=50', 'https://images.pexels.com/photos/1536619/pexels-photo-1536619.jpeg?auto=compress&cs=tinysrgb&w=400', 'Smart Shopping: Quality vs. Price', 'Learn how to make smart purchasing decisions and invest in quality pieces that last longer.', '2025-01-05'),
(5, 'Style Tips', 'Emily Rodriguez', 'https://images.pexels.com/photos/3785079/pexels-photo-3785079.jpeg?auto=compress&cs=tinysrgb&w=50', 'https://images.pexels.com/photos/1598505/pexels-photo-1598505.jpeg?auto=compress&cs=tinysrgb&w=400', 'Accessorizing 101: Complete Your Look', 'Master the art of accessorizing with our comprehensive guide to jewelry, bags, and more.', '2025-01-03'),
(6, 'Fashion Trends', 'Sarah Johnson', 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=50', 'https://images.pexels.com/photos/1884581/pexels-photo-1884581.jpeg?auto=compress&cs=tinysrgb&w=400', 'Winter to Spring Transition Outfits', 'Navigate the tricky weather transition with versatile outfit ideas that work for both seasons.', '2025-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
