-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2024 at 02:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candela_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket_items`
--

CREATE TABLE `basket_items` (
  `id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `product_id` mediumint(9) NOT NULL,
  `basket_content` varchar(255) NOT NULL,
  `quantity` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout_orders`
--

CREATE TABLE `checkout_orders` (
  `id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `p1` mediumint(9) NOT NULL,
  `p2` mediumint(9) NOT NULL,
  `p3` mediumint(9) NOT NULL,
  `p4` mediumint(9) NOT NULL,
  `p5` mediumint(9) NOT NULL,
  `p6` mediumint(9) NOT NULL,
  `total` int(11) NOT NULL,
  `checked_out` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivered` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` mediumint(9) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `ContactNumber` varchar(11) NOT NULL,
  `Comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` mediumint(9) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `productpage` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `stocks` mediumint(9) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pname`, `image`, `productpage`, `price`, `stocks`, `description`) VALUES
(1, 'Vanilla Milk and Cookie', 'images/product_1.jpeg', 'product1.php', '95.55', 15, 'Indulge your senses with our Vanilla Milk and Cookie Candle. This visually captivating candle features swirls of creamy white wax, reminiscent of fresh milk, merging seamlessly with a luscious layer of chocolate-brown wax. The result is a visually enticing and aromatic treat that brings the comforting scents of warm milk and rich chocolate to any space. Perfect for creating a cozy atmosphere and making a sweet statement in your decor.'),
(2, 'Mint Ice Cream', 'images/product_2.jpeg', 'product2.php', '120.73', 24, 'Introducing our Mint Ice Cream Cone Candle, a delightful fusion of aesthetics and indulgence. This charming candle captures the essence of mint green ice cream in a playful cone design. The candle features a vibrant green wax, mimicking the distinct color of mint, and is carefully sculpted to resemble the swirls and texture of a delicious cone. The cone base adds a touch of authenticity, creating a whimsical and visually appealing treat for the eyes. As you light the wick, the Mint Ice Cream Candle releases a subtle yet enticing aroma, evoking the soothing and earthy fragrance of matcha.'),
(3, 'Apple Pie', 'images/product_3.jpeg', 'product3.php', '167.31', 24, 'The Apple Pie Candle is delicately molded to replicate the smooth texture of yema candies, creating a visually enticing and authentic representation. The design is both charming and elegant, making it a tasteful addition to any space.'),
(4, 'Lemon Cupcake', 'images/product_4.jpeg', 'product4.php', '130.10', 21, 'Introducing our Sweet Mini Lemon Cupcake Candle, a delightful and charming addition to your space. This petite candle is crafted to resemble a delectable cupcake, complete with intricate frosting swirls and adorable details. The wax is carefully colored to match the whimsical and appetizing shades of a classic cupcake.'),
(5, 'Blueberry Cake', 'images/product_5.jpeg', 'product5.php', '150.25', 7, 'a delectable olfactory and visual delight that captures the essence of a freshly baked blueberry cake. This artisanal candle is meticulously designed to replicate the irresistible charm of a blueberry-infused confection. The Blueberry Bliss Cake Candle features a rich, deep-blue wax, reminiscent of plump, juicy blueberries. The candle is skillfully shaped to mirror the layers of a cake, with intricate details that add a touch of authenticity to the design. The blue hue adds a pop of color, making it a visually appealing and stylish addition to any room.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `ContactNumber` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket_items`
--
ALTER TABLE `basket_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout_orders`
--
ALTER TABLE `checkout_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `basket_items`
--
ALTER TABLE `basket_items`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkout_orders`
--
ALTER TABLE `checkout_orders`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
