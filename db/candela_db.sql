-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 04:24 AM
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
-- Database: `candela_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `user_address` text DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `user_id`, `user_address`, `barangay`, `created_at`) VALUES
(1, 1, 'Bricklane Fake Subdivision Block 90 Lot 1', 'Medicion II-E', '2024-04-28 11:27:55'),
(2, 2, 'Block 78 Lot 9 Santa Barbara St. Skyflakes Subdivision', 'Anabu I-B', '2024-05-01 02:05:38'),
(3, 5, 'UAC Argent Facility', 'Maharlika', '2024-05-06 02:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `basket_items`
--

CREATE TABLE `basket_items` (
  `basket_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `product_id` mediumint(9) NOT NULL,
  `quantity` mediumint(9) NOT NULL,
  `item_added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout_orders`
--

CREATE TABLE `checkout_orders` (
  `checkout_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  `order_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `address` text NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `products` text NOT NULL,
  `shipping_fee` mediumint(9) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `checked_out` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivered` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `feedback_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` mediumint(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  `stocks` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `ordered` tinyint(4) NOT NULL,
  `hide` tinyint(4) NOT NULL,
  `product_added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `image`, `price`, `stocks`, `description`, `ordered`, `hide`, `product_added_date`) VALUES
(1, 'Vanilla Milk and Cookie', 'images/products/product_1.jpeg', '95.55', 100, 'Indulge your senses with our Vanilla Milk and Cookie Candle. This visually captivating candle features swirls of creamy white wax, reminiscent of fresh milk, merging seamlessly with a luscious layer of chocolate-brown wax. The result is a visually enticing and aromatic treat that brings the comforting scents of warm milk and rich chocolate to any space. Perfect for creating a cozy atmosphere and making a sweet statement in your decor.', 0, 0, '2024-05-05 05:27:49'),
(2, 'Matcha Ice Cream Candle', 'images/products/product_2.jpeg', '99.00', 100, 'Introducing our Matcha Ice Cream Cone Candle, a delightful fusion of aesthetics and indulgence. This charming candle captures the essence of matcha green tea ice cream in a playful cone design. The candle features a vibrant green wax, mimicking the distinct color of matcha, and is carefully sculpted to resemble the swirls and texture of a delicious cone. The cone base adds a touch of authenticity, creating a whimsical and visually appealing treat for the eyes. As you light the wick, the Matcha Ice Cream Cone Candle releases a subtle yet enticing aroma, evoking the soothing and earthy fragrance of matcha.', 0, 0, '2024-05-05 05:28:01'),
(3, 'Apple Pie', 'images/products/product_3.jpeg', '129.00', 100, 'The Apple Pie Candle is delicately molded to replicate the smooth texture of yema candies, creating a visually enticing and authentic representation. The design is both charming and elegant, making it a tasteful addition to any space.', 0, 0, '2024-05-05 05:28:08'),
(4, 'Lemon Cupcake', 'images/products/product_4.jpeg', '130.10', 100, 'Introducing our Sweet Mini Lemon Cupcake Candle, a delightful and charming addition to your space. This petite candle is crafted to resemble a delectable cupcake, complete with intricate frosting swirls and adorable details. The wax is carefully colored to match the whimsical and appetizing shades of a classic cupcake.', 0, 0, '2024-05-06 01:31:13'),
(5, 'Blueberry Cake', 'images/products/product_5.jpeg', '150.25', 100, 'A delectable olfactory and visual delight that captures the essence of a freshly baked blueberry cake. This artisanal candle is meticulously designed to replicate the irresistible charm of a blueberry-infused confection. The Blueberry Bliss Cake Candle features a rich, deep-blue wax, reminiscent of plump, juicy blueberries. The candle is skillfully shaped to mirror the layers of a cake, with intricate details that add a touch of authenticity to the design. The blue hue adds a pop of color, making it a visually appealing and stylish addition to any room.', 0, 0, '2024-05-06 01:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(9) NOT NULL,
  `username` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `lastname`, `email`, `contactnumber`, `password`, `registration_date`, `type`) VALUES
(1, 'Candela', 'Admin', 'candela.foodcandle@gmail.com', '09716970022', '$2y$10$70vTQYoI1VYc7z0Fl2Z/3ORxH8x7twZcGjPIipglHZ2tqQlA5QOdm', '2024-04-28 11:20:15', 1),
(2, 'John Lyrick', 'Jonson', 'lyrickjonson@gmail.com', '09716970022', '$2y$10$p5Inb.MMZzl0v0q8wnHXieHjYerM5DehoPNwZqeXy8WjDdK48x/3q', '2024-05-01 02:05:38', 1),
(3, 'User', 'TestingUser', 'testing@gmail.com', '', '$2y$10$YzFacafvLyVoFoV49jlWKO7w8WD1bNtQbzwjYtPceSMz7aAVZ6ed6', '2024-05-06 01:49:27', 0),
(4, 'Brian', 'Fury', 'brianfury89@gmail.com', '09876543211', '$2y$10$xGi8RwpR5ZwoEXRLk0naze2gG76Q6j4usir.cJ/Y0JP4DLqEVlH/C', '2024-05-06 01:50:17', 0),
(5, 'Samuel', 'Hayden', 'samuelhayden@gmail.com', '', '$2y$10$TOAw48P9OHhb7kQQB0rjN.QsMW.gkp90hb9dlHX/0iQmWMSHyq1Ia', '2024-05-06 02:12:09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `basket_items`
--
ALTER TABLE `basket_items`
  ADD PRIMARY KEY (`basket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `checkout_orders`
--
ALTER TABLE `checkout_orders`
  ADD PRIMARY KEY (`checkout_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `basket_items`
--
ALTER TABLE `basket_items`
  MODIFY `basket_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkout_orders`
--
ALTER TABLE `checkout_orders`
  MODIFY `checkout_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket_items`
--
ALTER TABLE `basket_items`
  ADD CONSTRAINT `basket_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `basket_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
