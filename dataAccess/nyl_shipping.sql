-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 03:30 PM
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
-- Database: `nyl_shipping`
--

-- --------------------------------------------------------

--
-- Table structure for table `container`
--

CREATE TABLE `container` (
  `id` int(11) NOT NULL,
  `info_id` int(11) NOT NULL,
  `marks_and_nos_container_and_seals` varchar(50) NOT NULL,
  `number_of_containers` int(3) NOT NULL,
  `no_and_kind_of_packages` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `gross_weight_cargo` varchar(50) NOT NULL,
  `measurement` varchar(50) NOT NULL,
  `tare` varchar(50) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `container`
--

INSERT INTO `container` (`id`, `info_id`, `marks_and_nos_container_and_seals`, `number_of_containers`, `no_and_kind_of_packages`, `description`, `gross_weight_cargo`, `measurement`, `tare`, `create_by`, `create_time`) VALUES
(11, 25, 'BEJHBJHDSBFSHBGSJNDSFJHB', 15, 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 1, '2023-06-09 13:13:27'),
(12, 25, 'BEJHBJHDSBFSHBGSJNDSFJHB', 10, 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 1, '2023-06-09 13:13:27'),
(13, 26, 'sfdsfsdfsdf', 15, 'sdadsadsadasd', 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like', '12', '15', '12', 1, '2023-06-09 13:20:57'),
(14, 26, 'dfgdfgg', 10, 'asfdfgdfg', 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like', '10', '15', '10', 1, '2023-06-09 13:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `shipper` text NOT NULL,
  `consignee` text NOT NULL,
  `notify_party` text NOT NULL,
  `voyage_number` varchar(50) NOT NULL,
  `pre_carriage_by` varchar(50) NOT NULL,
  `vessel` varchar(50) NOT NULL,
  `freight_to_be_paid_at` varchar(50) NOT NULL,
  `port_of_discharge` varchar(50) NOT NULL,
  `bill_of_lading_number` varchar(50) NOT NULL,
  `place_of_receipt` varchar(50) NOT NULL,
  `port_of_loading` varchar(50) NOT NULL,
  `number_of_original_bill_of_loding` varchar(50) NOT NULL,
  `final_place_of_delivery` varchar(50) NOT NULL,
  `date_of_issue` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `shipper`, `consignee`, `notify_party`, `voyage_number`, `pre_carriage_by`, `vessel`, `freight_to_be_paid_at`, `port_of_discharge`, `bill_of_lading_number`, `place_of_receipt`, `port_of_loading`, `number_of_original_bill_of_loding`, `final_place_of_delivery`, `date_of_issue`, `created_by`, `created_time`) VALUES
(3, 'asdsa', 'dsadad', 'sadasda', 'dsadsad', 'asdasdas', 'asdasdas', 'd', 'asdasd', 'adasd', 'adasd', 'sadasd', 'asdsadsa', 'dasdasda', '0000-00-00', 1, '2023-06-08 12:13:52'),
(4, 'asdsa', 'dsadad', 'sadasda', 'dsadsad', 'asdasdas', 'd', 'asdasd', 'adasd', 'adasd', 'sadasd', 'asdsadsa', 'dasdasda', 'dasdda', '0000-00-00', 1, '2023-06-08 12:15:01'),
(5, 'sdfghjhgfdsa', 'dfgdsfghgfds', 'fghfdsadfghfdsfgh', 'fdsfgh', 'fdsfghfdsfg', 'fdfghnmgfdfg', 'hgfhfghfhfg', 'fghgfhfghfg', 'fghgfuvhvhgv', 'hgv', 'hgv', 'hgv', 'hgv', '0000-00-00', 1, '2023-06-08 12:15:19'),
(6, 'asdfghjk', 'dfsghjk', 'asdfghj', 'jasdfghnm', 'xtcvbhgvhg', 'vgyv', 'ygvyg', 'vyg', 'vyv', 'yv', 'yv', 'ygv', 'gyv', '2023-06-25', 1, '2023-06-08 12:21:40'),
(7, 'ads', 'asd', 'sad', 'asd', 'sad', 'assa', 'as', 'asd', 'asd', 'asd', 'asd', 'asd', 'sdasd', '2023-06-13', 1, '2023-06-09 06:01:16'),
(8, 'asdasd', 'vvhgv', 'ghvhgvgh', 'vghvgh', 'vhgvgh', 'vghvgh', 'vhgvhgv', 'ghvghv', 'hgvhgv', 'ghvhgvgh', 'vghvghv', 'hgvghvgh', 'vhgvhgvhgvh', '2023-06-21', 1, '2023-06-09 07:54:22'),
(9, 'asdasd', 'vvhgv', 'ghvhgvgh', 'vghvgh', 'vhgvgh', 'vghvgh', 'vhgvhgv', 'ghvghv', 'hgvhgv', 'ghvhgvgh', 'vghvghv', 'hgvghvgh', 'vhgvhgvhgvh', '2023-06-21', 1, '2023-06-09 07:54:56'),
(10, 'asdasd', 'vvhgv', 'ghvhgvgh', 'vghvgh', 'vhgvgh', 'vghvgh', 'vhgvhgv', 'ghvghv', 'hgvhgv', 'ghvhgvgh', 'vghvghv', 'hgvghvgh', 'vhgvhgvhgvh', '2023-06-21', 1, '2023-06-09 07:55:12'),
(11, 'asdasd', 'vvhgv', 'ghvhgvgh', 'vghvgh', 'vhgvgh', 'vghvgh', 'vhgvhgv', 'ghvghv', 'hgvhgv', 'ghvhgvgh', 'vghvghv', 'hgvghvgh', 'vhgvhgvhgvh', '2023-06-21', 1, '2023-06-09 07:55:19'),
(12, 'asdasd', 'asdasdasd', 'sadasd', 'jbjhbj', 'bjhb', 'hjb', 'jhb', 'jhb', 'jhb', 'jhb', 'jhb', 'jhb', 'jb', '2023-06-15', 1, '2023-06-09 07:58:50'),
(13, 'asdasd', 'asdasdasd', 'sadasd', 'jbjhbj', 'bjhb', 'hjb', 'jhb', 'jhb', 'jhb', 'jhb', 'jhb', 'jhb', 'jb', '2023-06-15', 1, '2023-06-09 08:00:33'),
(14, 'asdasd', 'asdsad', 'asdasd', 'jhbjhb', 'jhbjhb', 'jhbjhb', 'jhb', 'jhbjhb', 'jbjb', 'jhbjh', 'bjhb', 'jhbjhb', 'jbjhbjhb', '2023-06-23', 1, '2023-06-09 08:00:53'),
(15, 'asdasd', 'asdsad', 'asdasd', 'jhbjhb', 'jhbjhb', 'jhbjhb', 'jhb', 'jhbjhb', 'jbjb', 'jhbjh', 'bjhb', 'jhbjhb', 'jbjhbjhb', '2023-06-23', 1, '2023-06-09 08:02:06'),
(16, 'dxcfvhbj', 'bjbjhb', 'hjbjhb', 'jhb', 'jhbjh', 'bjhb', 'jhb', 'jhbjh', 'bjhb', 'jhbjh', 'bjhb', 'jhb', 'jhbjh', '2023-06-14', 1, '2023-06-09 08:02:23'),
(17, 'adsad', 'sadsadasd', 'asdasd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', '2023-06-28', 1, '2023-06-09 11:46:28'),
(18, 'adsad', 'sadsadasd', 'asdasd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', '2023-06-28', 1, '2023-06-09 11:47:17'),
(19, 'asd', 'bhbjhb', 'jhb', 'jhbjh', 'bjhb', 'jhbjh', 'bjh', 'bjhb', 'jhbjhbjbj', 'bjhb', 'jhb', 'jhb', 'jhbjh', '2023-06-16', 1, '2023-06-09 11:47:39'),
(20, 'asd', 'bhbjhb', 'jhb', 'jhbjh', 'bjhb', 'jhbjh', 'bjh', 'bjhb', 'jhbjhbjbj', 'bjhb', 'jhb', 'jhb', 'jhbjh', '2023-06-16', 1, '2023-06-09 11:48:49'),
(21, 'sadasd', 'asdasdasd', 'asdasda', 'asdasd', 'bjbjbjhb', 'jbjhbj', 'hbjhbjh', 'bjhbjh', 'bjhbjhb', 'jhbjhb', 'jhbjh', 'bjhbjhb', 'jhbjhb', '2023-06-23', 1, '2023-06-09 11:49:23'),
(22, 'asdds', 'sadsad', 'asdad', 'adad', 'asdasd', 'sdsfsdf', 'sfsdfsdg', 'fsdfsbb', 'bbjbjbb', 'bjbjbjbjhb', 'jbhbhjbhjbjhb', 'jhbjhbjhbjh', 'bjhbjhbjhb', '2023-06-30', 1, '2023-06-09 12:39:33'),
(23, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '1234567897654321', 'non-characteristic words etc.', '13245678', 'asdasd', 'Tianjin', '161561', '131321', 'Tianjin', '131321', 'Tianjin', '2023-06-15', 1, '2023-06-09 13:03:51'),
(24, 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '1234567897654321', 'non-characteristic words etc.', '13245678', 'asdasd', 'Tianjin', '161561', '131321', 'Tianjin', '131321', 'Tianjin', '2023-06-15', 1, '2023-06-09 13:04:50'),
(25, 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', 'BEJHBJHDSBFSHBGSJNDSFJHB', '2023-06-23', 1, '2023-06-09 13:13:27'),
(26, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', 'Various versions have evolved over the years, some', '2023-06-24', 1, '2023-06-09 13:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `role`, `password`, `status`, `created_by`, `created_time`) VALUES
(1, 'vidusha wijekoon', 'admin@admin.com', 'vidusha wijekoon', 2, '63b4bacc828939706ea2a84822a4505efa73ee3e', 0, 'Vidusha', '2023-06-07 12:21:23'),
(2, 'vidusha wijekoon123', 'vdisu@gmail.com', 'vidusha wijekoon123123', 1, 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 1, 'Vidusha', '2023-06-07 13:57:42'),
(4, 'asdasdasd', 'admin@admin.com123213', 'asdasdasd', 1, '00ea1da4192a2030f9ae023de3b3143ed647bbab', 0, 'Vidusha', '2023-06-07 16:37:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_id` (`info_id`),
  ADD KEY `create_by` (`create_by`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `container`
--
ALTER TABLE `container`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `container`
--
ALTER TABLE `container`
  ADD CONSTRAINT `container_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `container_ibfk_2` FOREIGN KEY (`info_id`) REFERENCES `information` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `information_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
