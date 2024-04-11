-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 06:58 PM
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
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(30) NOT NULL,
  `details` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `category`, `details`, `image`) VALUES
(4, 'Lemon Rice', 'rice', '3 tablespoon Cooking oil (I have used light olive oil)\r\n\r\n1 teaspoon Mustard seeds\r\n\r\n1/2 teaspoon Cumin seeds\r\n\r\n15 to 20 Curry leaves - fresh/dry/frozen\r\n\r\n(OPTIONAL)\r\n\r\n1 cup/130g Onion\r\n\r\n1 cup/150g Carrot\r\n\r\n1 cup/150 Red bell pepper\r\n\r\n2 cups/170g Snow peas (or snap peas)\r\n\r\n1 tablespoon/9 grams Ginger - finely chopped\r\n\r\n1 teaspoon Turmeric\r\n\r\n1/4 teaspoon Cayenne Pepper or to taste (OPTIONAL)\r\n\r\nSalt to taste (I have added total 1+1/4 teaspoon of pink Himalayan Salt)\r\n\r\n2 to 3 Tablespoon', '2.jpg'),
(5, 'Creamy Cucumber Pasta', 'pasta', '1/2 cup/125g Plant-Based Yogurt (I have added oats yogurt, but non-vegans can use regular yogurt)\r\n\r\n1/2 cup/125g Vegan Mayonnaise (Non-vegans can use regular mayonnaise)\r\n\r\n1 Teaspoon Dijon Mustard\r\n\r\n1+1/2 to 2 Tablespoon White Vinegar or White wine vinegar\r\n\r\nSalt to taste (I have added 1/2 Pink Himalayan Salt which is milder than the regular salt)\r\n\r\n1 Teaspoon Sugar or to taste (NOTE: I have added organic cane sugar but you could also add liquid sweetener of your choice eg. Maple syrup, aga', '3.jpg'),
(6, 'Vegie Burger', 'burger', '2 Cups/1 Can (540ml - low sodium) of Cooked Black Beans (Rinsed/well drained)\r\n\r\n3 Tablespoon Olive Oil\r\n\r\n2 Cups Onion - chopped\r\n\r\n2 Tablespoon Garlic\r\n\r\n2 Cups Finely Grated Carrot (240g)\r\n\r\n2 Teaspoon Paprika\r\n\r\n1 Teaspoon Cumin\r\n\r\n1/2 Teaspoon Ground Black Pepper\r\n\r\n1/4 Teaspoon Cayenne Pepper (Optional)\r\n\r\nSalt to taste (I added 1+1/4 Teaspoon of Pink Himalayan salt)\r\n\r\n1 Tablespoon White Vinegar (I added White Wine Vinegar)\r\n\r\n1 Tablespoon Balsamic Vinegar\r\n\r\n1/4 Cup/60ml Passata or Tomat', '4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `pid` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `pid`, `name`, `image`) VALUES
(9, 33, 4, 'Lemon Rice', '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `message`) VALUES
(8, 31, 'Hirushi', 'hirushiamaya392@gmail.com', 'hi'),
(9, 31, 'hiru', 'hiruniamasha19@gmail.com', 'hey');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(31, 'Hiru', 'hiruniamasha19@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'img1.jpg'),
(32, 'Hiru', 'hirushiamaya392@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'login_bg.jpg'),
(33, 'hiru', 'hiruni@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'cute-whatsapp-dp_2810_29.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
