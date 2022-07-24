-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3309
-- Generation Time: Jun 09, 2022 at 04:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  `product_price` double NOT NULL,
  `product_availability` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_price`, `product_availability`, `product_image`) VALUES
(1, 'BMW iX', '    Born from a vision. Created for electric mobility. Thanks to efficient BMW eDrive technology and its fully electric all-wheel drive, the BMW iX achieves an exceptional range and delivers powerful acceleration from a standstill. The intelligent BMW Operati    ', 79990, 2, 'BMWiX.png'),
(2, 'BMW iX M60', '  The BMW iX M60 combines the innovative power of BMW i and BMW M. Explore the first purely electric BMW M automobile in the performance segment of the Sports Activity Vehicle (SAV):\r\n \r\nFully electric drive with two BMW M eDrive motors, electric all-wheel   ', 121750, 3, 'BMWixM60.png'),
(3, 'BMW i4 Gran Coupé', ' The first all-electric Gran Coupé, the BMW i4 delivers outstanding dynamics with a high level of comfort and the ideal qualities to make it your daily driver. The four-door model comes equipped with fifth-generation BMW eDrive technology for sporty performance. ', 54990, 5, 'BMWi4GC.png'),
(4, 'BMW i4 M50 xDrive', 'Sporty performance that electrifies: for the first time, the BMW i4 M50 xDrive combines the innovative power of BMW M with that of BMW i. As a result, the BMW i4 M50 xDrive with its fully electric drive fed by two BMW M eDrive motors develops up to a trem ', 72990, 2, 'BMWi4M50.png'),
(5, 'BMW i7', ' The first fully-electric BMW i7 combines electric performance and multisensory entertainment to produce an unforgettable motoring experience.\r\n\r\nWelcoming scenario “Great Entrance Moments”\r\nBMW Crystal Headlights and Illuminated Kidney Grille\r\nLuxurious l ', 147000, 8, 'BMWi7.png'),
(6, 'BMW X5 PHEV xDrive45e', '   The connectivity and driver technology inside the BMW X5 xDrive45e is thoughtfully designed to cater to your every whim. From the intelligent digital services to the intuitive driver assistant systems, discover a full suite of premium technology that of   ', 80600, 2, 'BMWX4PHEV.png'),
(9, 'BMW M235i xDrive GC', '  The extroverted athleticism of the BMW M235i xDrive Gran Coupé dominates from every perspective: thanks to the muscular shoulder line, gently sloping roof line and the powerful rear. The perfectly tuned driving dynamics components and extremely powerful e  ', 52700, 4, 'BMWM235i.png'),
(10, 'BMW M3 Competition Sedan', ' The BMW M3 vehicles combine powerful proportions and distinctive four-door 3-box design with the sportiness typical of M. Leading these bold characters is the BMW M3 Competition Sedan with its impressive 510 hp and 479 ft/lb of torque. Equipped with a hig ', 86800, 5, 'BMWM3S.png'),
(11, 'BMW M4 CSL', ' The BMW 4 Series Coupé M Automobiles offer a fascinating combination of aesthetics, character and typical M athleticism.\r\nLeading the selection is the BMW M4 CSL with an impressive output of 543 hp and 479 lb. ft. of torque. Estimated weight savings of up ', 166500, 2, 'BMWM4CSL.png'),
(12, 'BMW X3 PHEV', '  The advanced technology of the BMW X3 xDrive30e answers to your every need. From keeping you plugged-in to your digital life, to enhancing your connection to the road, discover a full suite of premium technology designed to help you stay connected with what’s important to you.', 54900, 3, 'BMWX3PHEV.png'),
(14, 'BMW M70Li xDrive Sedan', ' The flowing silhouette of the BMW M760Li xDrive Sedan is in itself enough to promise the perfect symbiosis of the most sublime elegance and maximum performance. The undisputed top model of the 7 Series displays everything that can only be described with s ', 171900, 5, 'MBWM70LI.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `is_admin`) VALUES
(1, 'admin@bmw.com', '5416d7cd6ef195a0f7622a9c56b55e84', 1),
(2, 'user@user.com', '49de0b99449a968e114c7d0b20cf94d8', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
