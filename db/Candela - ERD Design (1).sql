CREATE TABLE `users` (
  `user_id` mediumint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL,
  `type` bool NOT NULL
);

CREATE TABLE `addresses` (
  `address_id` mediumint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` mediumint NOT NULL,
  `address` text NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL
);

CREATE TABLE `products` (
  `product_id` mediumint PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  `stocks` smallint NOT NULL,
  `description` text NOT NULL,
  `product_added_date` timestamp NOT NULL
);

CREATE TABLE `contacts` (
  `contact_id` mediumint NOT NULL,
  `user_id` mediumint,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `feedback_date` timestamp NOT NULL
);

CREATE TABLE `basket_items` (
  `basket_id` mediumint NOT NULL,
  `user_id` mediumint NOT NULL,
  `product_id` mediumint NOT NULL,
  `quantity` mediumint NOT NULL,
  `item_added_date` timestamp NOT NULL
);

CREATE TABLE `checkout_orders` (
  `checkout_id` mediumint NOT NULL,
  `user_id` mediumint NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `address_id` mediumint NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `products` text NOT NULL,
  `total` int NOT NULL,
  `checked_out` timestamp NOT NULL,
  `delivered` varchar(255) NOT NULL
);

ALTER TABLE `contacts` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `basket_items` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `checkout_orders` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `addresses` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `basket_items` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

ALTER TABLE `checkout_orders` ADD FOREIGN KEY (`address_id`) REFERENCES `addresses` (`address_id`);
