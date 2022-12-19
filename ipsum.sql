-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2022 at 10:51 PM
-- Server version: 10.3.37-MariaDB
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipsum`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingId` int(10) NOT NULL,
  `userId` int(20) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `roomId` int(10) NOT NULL,
  `statusId` int(1) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `receiptId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingId`, `userId`, `startDate`, `endDate`, `roomId`, `statusId`, `date`, `receiptId`) VALUES
(28, 14, '2022-01-01', '2022-02-01', 1, 2, '2022-12-19 20:26:32', 16);

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `statusId` int(1) NOT NULL,
  `name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_status`
--

INSERT INTO `booking_status` (`statusId`, `name`) VALUES
(3, 'canceled'),
(2, 'confirmed'),
(1, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `pictureId` int(10) NOT NULL,
  `picturePath` varchar(100) NOT NULL,
  `thumbnailPath` varchar(256) NOT NULL,
  `caption` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`pictureId`, `picturePath`, `thumbnailPath`, `caption`) VALUES
(14, './public/images/hotelroom1.jpg', '', NULL),
(15, './public/images/hotelroom2.jpg', '', NULL),
(16, './public/images/hotelroom3.jpg', '', NULL),
(17, './public/images/hotelroom4.jpg', '', NULL),
(18, './public/images/hotelroom5.jpg', '', NULL),
(29, '/uploads/pictures/two.png', '/uploads/pictures/thumbnails/two.png', NULL),
(30, '/uploads/pictures/75299396_2432035490240539_2691254721127932858_n.jpg', '/uploads/pictures/thumbnails/75299396_2432035490240539_2691254721127932858_n.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(3) NOT NULL,
  `authorId` int(20) NOT NULL,
  `headline` varchar(50) NOT NULL,
  `content` blob NOT NULL,
  `subtitle` varchar(350) NOT NULL,
  `pictureid` int(10) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `authorId`, `headline`, `content`, `subtitle`, `pictureid`, `created`) VALUES
(11, 11, 'Willkommen im Hotel Ipsum', 0x3c68333e4c6f72656d20497073756d20646f6c6f723c2f68333e, '', 29, '2022-12-19 20:56:32'),
(12, 11, 'Lorem Ipsum', 0x3c703e4c6f72656d20497073756d20646f6c6f723c2f703e, '', 30, '2022-12-19 20:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(10) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `fk_bookingId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id`, `price`, `fk_bookingId`) VALUES
(16, '20.00', 28);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `userRoleId` int(1) NOT NULL,
  `roleName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`userRoleId`, `roleName`) VALUES
(1, 'guest'),
(2, 'admin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomId` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(500) DEFAULT '',
  `pictureId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomId`, `price`, `name`, `description`, `pictureId`) VALUES
(1, '89.00', '24K Suite', 'Lorem cillum duis voluptate aute nisi ipsum nisi commodo non. Consectetur incididunt sunt consectetur anim commodo proident nulla deserunt esse sunt nulla dolor adipisicing veniam. Ea officia aliquip cillum sunt.', 14),
(2, '160.00', '420K Suite', 'Lorem cillum duis voluptate aute nisi ipsum nisi commodo non. Consectetur incididunt sunt consectetur anim commodo proident nulla deserunt esse sunt nulla dolor adipisicing veniam. Ea officia aliquip cillum sunt.', 15);

-- --------------------------------------------------------

--
-- Table structure for table `serviceoverview`
--

CREATE TABLE `serviceoverview` (
  `serviceId` int(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` decimal(4,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceoverview`
--

INSERT INTO `serviceoverview` (`serviceId`, `name`, `price`) VALUES
(1, 'Parken', '19.90'),
(2, 'WIFI', '5.90'),
(3, 'Klima-Anlage', '5.90'),
(4, 'TV', '9.90');

-- --------------------------------------------------------

--
-- Table structure for table `serviceReceipt`
--

CREATE TABLE `serviceReceipt` (
  `bookingId` int(10) NOT NULL,
  `serviceId` int(3) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `serviceReceipt`
--

INSERT INTO `serviceReceipt` (`bookingId`, `serviceId`, `id`) VALUES
(28, 4, 27);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `userRole` int(1) DEFAULT 3,
  `email` varchar(319) NOT NULL,
  `password` varchar(256) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstname`, `surname`, `username`, `userRole`, `email`, `password`, `gender`, `phone`, `active`) VALUES
(2, 'Maximilian', 'Sinnl', 'msinnl', 2, 'max.sinnl@hotmail.com', '$2y$10$.BLgpjEHlI3KaEZ29YN06uVhx04peXsUc7FZnHwK9JZxz84iDdpzG', 'm', '+436607707635', 1),
(11, 'Markus', 'Roesner', 'markus', 2, 'markus.roesner@gmx.net', '$2y$10$og2EthL1RbWBf5.gYKCcA.kgagqmmMAlATFS1DVefkulpvJP5pLeO', 'm', '06644102225', 1),
(14, 'Lorelei', 'Ipsum', 'guest', 3, 'lorelei@ipsum.at', '$2y$10$5Ec78pGdO4b83JbcVITjD.GDa3be7YbDAjQmcC1OSXFMetUCBp6za', 'f', '0670234678', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingId`),
  ADD KEY `roomId` (`roomId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `statusId` (`statusId`),
  ADD KEY `fk_receiptId` (`receiptId`);

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`statusId`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`pictureId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `pictureid` (`pictureid`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_ibfk_1` (`fk_bookingId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`userRoleId`,`roleName`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomId`),
  ADD UNIQUE KEY `roomId` (`roomId`),
  ADD KEY `pictureId` (`pictureId`);

--
-- Indexes for table `serviceoverview`
--
ALTER TABLE `serviceoverview`
  ADD PRIMARY KEY (`serviceId`);

--
-- Indexes for table `serviceReceipt`
--
ALTER TABLE `serviceReceipt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serviceId` (`serviceId`),
  ADD KEY `serviceReceipt_ibfk_2` (`bookingId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `userRole` (`userRole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `statusId` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `pictureId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `serviceReceipt`
--
ALTER TABLE `serviceReceipt`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `rooms` (`roomId`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`statusId`) REFERENCES `booking_status` (`statusId`),
  ADD CONSTRAINT `fk_receiptId` FOREIGN KEY (`receiptId`) REFERENCES `receipt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`pictureid`) REFERENCES `pictures` (`pictureId`),
  ADD CONSTRAINT `posts_ibfk_3` FOREIGN KEY (`pictureid`) REFERENCES `pictures` (`pictureId`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`fk_bookingId`) REFERENCES `bookings` (`bookingId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`pictureId`) REFERENCES `pictures` (`pictureId`);

--
-- Constraints for table `serviceReceipt`
--
ALTER TABLE `serviceReceipt`
  ADD CONSTRAINT `serviceReceipt_ibfk_1` FOREIGN KEY (`serviceId`) REFERENCES `serviceoverview` (`serviceId`),
  ADD CONSTRAINT `serviceReceipt_ibfk_2` FOREIGN KEY (`bookingId`) REFERENCES `bookings` (`bookingId`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userRole`) REFERENCES `roles` (`userRoleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
