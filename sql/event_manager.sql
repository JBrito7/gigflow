-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2025 at 03:16 PM
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
-- Database: `event_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `event_id`, `quantity`) VALUES
(171, 1, 11, 1),
(172, 1, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `bio_page` varchar(100) DEFAULT NULL,
  `category` enum('comedy','pop','rock','festival') NOT NULL,
  `description` text NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `location` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `bio_page`, `category`, `description`, `event_date`, `event_time`, `location`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Kevin Hart', 'kevin_hart.html', 'comedy', 'Espetáculo de stand-up cheio de histórias hilárias e improvisos.', '2025-09-15', '20:00:00', 'O2 Arena, Londres, UK', 65.00, '2025-08-24 11:34:06', '2025-09-06 11:37:31'),
(2, 'Ali Wong', 'ali_wong.html', 'comedy', 'Humor ácido e irreverente misturado com críticas sociais afiadas.', '2025-09-16', '19:30:00', 'Ziggo Dome, Amsterdã, Países Baixos', 55.00, '2025-08-24 11:34:06', '2025-09-06 11:37:31'),
(3, 'John Mulaney', 'john_mulaney.html', 'comedy', 'Stand-up de humor inteligente e observacional.', '2025-09-19', '20:00:00', 'Accor Arena, Paris, França', 50.00, '2025-08-24 11:34:06', '2025-09-06 11:37:31'),
(4, 'Hannah Gadsby', 'hannah_gadsby.html', 'comedy', 'Stand-up inovador que mistura humor e reflexão.', '2025-09-21', '20:30:00', 'Royal Arena, Copenhague, Dinamarca', 48.00, '2025-08-24 11:34:06', '2025-09-06 11:37:31'),
(5, 'Trevor Noah', 'trevor_noah.html', 'comedy', 'Stand-up global sobre política e cultura com muito carisma.', '2025-09-24', '19:45:00', 'Lanxess Arena, Colônia, Alemanha', 60.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(6, 'Billie Eilish', 'billie_eilish.html', 'pop', 'Show cinematográfico com visuais sombrios e atmosfera imersiva.', '2025-09-13', '20:00:00', 'Accor Arena, Paris, França', 80.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(7, 'Harry Styles', 'harry_styles.html', 'pop', 'Show de 2h15min misturando pop e rock.', '2025-09-17', '20:00:00', 'O2 Arena, Londres, UK', 95.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(8, 'Katy Perry', 'katy_perry.html', 'pop', 'Espetáculo teatral cheio de cores e hits pop.', '2025-09-21', '20:00:00', 'Ziggo Dome, Amsterdã, Países Baixos', 75.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(9, 'Olivia Rodrigo', 'olivia_rodrigo.html', 'pop', 'Show pop-rock visceral e energético.', '2025-09-23', '19:30:00', 'Lanxess Arena, Colônia, Alemanha', 70.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(10, 'Shakira', 'shakira.html', 'pop', 'Show de 2h de pop latino vibrante e multicultural.', '2025-09-25', '21:00:00', 'Accor Arena, Paris, França', 85.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(11, 'Green Day', 'green_day.html', 'rock', 'Show explosivo de punk rock com clássicos e muita energia.', '2025-09-12', '20:00:00', 'O2 Arena, Londres, UK', 90.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(12, 'Foo Fighters', 'foo_fighters.html', 'rock', 'Espetáculo intenso com hits que atravessam décadas.', '2025-09-14', '19:30:00', 'Wembley Stadium, Londres, UK', 100.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(13, 'Iron Maiden', 'iron_maiden.html', 'rock', 'Heavy metal clássico com pirotecnia e energia inigualável.', '2025-09-18', '21:00:00', 'Accor Arena, Paris, França', 95.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(14, 'Red Hot Chili Peppers', 'red_hot_chilli.html', 'rock', 'Show funk rock vibrante cheio de improviso e energia.', '2025-09-20', '20:00:00', 'Ziggo Dome, Amsterdã, Países Baixos', 92.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(15, 'Arctic Monkeys', 'artic_monkeys.html', 'rock', 'Indie rock atmosférico com hits nostálgicos.', '2025-09-26', '20:00:00', 'Royal Arena, Copenhague, Dinamarca', 85.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(17, 'Download Festival UK', 'download_festival.html', 'festival', 'Três dias de rock e metal com Slipknot e Metallica.', '2025-09-19', '14:00:00', 'Donington Park, Reino Unido', 180.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(18, 'Tomorrowland', 'tomorrowland.html', 'festival', 'Festival de música eletrônica com DJs de renome.', '2025-09-26', '16:00:00', 'Boom, Bélgica', 200.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(19, 'Rock in Rio Lisboa', 'rock_in_rio.html', 'festival', 'Três dias de música com Muse, Coldplay e Ed Sheeran.', '2025-10-10', '17:00:00', 'Parque da Bela Vista, Lisboa, Portugal', 175.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(20, 'Creamfields UK', 'creamfields.html', 'festival', 'Três dias de música eletrônica com os maiores DJs.', '2025-10-17', '15:00:00', 'Daresbury, Reino Unido', 160.00, '2025-08-24 11:34:06', '2025-09-06 11:37:32'),
(21, 'Lollapalooza Berlin', 'lollapalooza.html', 'festival', 'Dois dias de pura energia musical! Mais de 22h de shows com Tame Impala, Doja Cat, Travis Scott e Florence + The Machine, palcos espetaculares, iluminação incrível, zonas interativas, arte urbana e gastronomia internacional. Uma experiência para sentir cada batida e performance de perto!', '2025-09-06', '12:00:00', 'Berlin Tempelhof, Alemanha', 150.00, '2025-08-31 22:01:29', '2025-09-06 11:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `total`, `status`, `created_at`) VALUES
(1, 1, 230.00, 'paid', '2025-08-31 16:32:31'),
(2, 1, 65.00, 'pending', '2025-09-01 15:56:17'),
(3, 1, 480.00, 'pending', '2025-09-06 10:55:09'),
(4, 4, 150.00, 'paid', '2025-09-08 22:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `event_id`, `quantity`, `price`) VALUES
(2, 1, 6, 1, 80.00),
(3, 2, 1, 1, 65.00),
(4, 3, 21, 2, 150.00),
(5, 3, 17, 1, 180.00),
(6, 4, 21, 1, 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`) VALUES
(1, 'Jessica', 'example@gmail.com', '$2y$10$uN8yjax4o2XnYdGaaYbnX.VkRqnMGvo80CmjSuLQPlIBQ67fKM0LK', '098765432100', 'example adress, 22', 'admin', '2025-08-24 15:59:06'),
(2, 'Morgane', 'morgane@gmail.com', '$2y$10$QYJIP.X2AgpyYVFcySSMQuJUNtjH3Aqh0YeEhQEea7nGNeHH2nP6u', '12345678900', 'morgane adress, 22', 'user', '2025-08-24 16:01:35'),
(4, 'Admin', 'Adminflow@gigflow.com', '$2y$10$GVbHY4vzMVEt2hS2h5/2KuwmuuDScUGN9hjfe9OJKM4o5ow6lz2LW', '000352666999888', 'Rue du flow', 'admin', '2025-09-06 10:56:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_items_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
