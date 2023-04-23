-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 01:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `botanydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `box_number`
--

CREATE TABLE `box_number` (
  `id` int(11) NOT NULL,
  `box-number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` int(11) NOT NULL,
  `family` varchar(45) NOT NULL,
  `latine_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `user_id` int(11) NOT NULL,
  `slide_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `returned_state` tinyint(4) DEFAULT NULL,
  `request_state` varchar(45) DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_archives`
--

CREATE TABLE `request_archives` (
  `slides_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `returned_state` tinyint(4) DEFAULT NULL,
  `request_state` varchar(45) DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_types`
--

CREATE TABLE `section_types` (
  `other_id` int(11) NOT NULL,
  `SectionType` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `arabicName` varchar(45) NOT NULL,
  `count` int(11) NOT NULL,
  `slide_number` int(11) NOT NULL,
  `cupbord` int(11) NOT NULL,
  `english_name` varchar(45) NOT NULL,
  `image` varchar(195) DEFAULT NULL,
  `group_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slide_box_numbers`
--

CREATE TABLE `slide_box_numbers` (
  `slide_id` int(11) NOT NULL,
  `box_number_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slide_ceils`
--

CREATE TABLE `slide_ceils` (
  `id` int(11) NOT NULL,
  `ceil_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slide_slide_ceils`
--

CREATE TABLE `slide_slide_ceils` (
  `slide_id` int(11) NOT NULL,
  `slide_ceils_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `special_groups`
--

CREATE TABLE `special_groups` (
  `id` int(11) NOT NULL,
  `specimen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `ssn` varchar(45) DEFAULT NULL,
  `blocked` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_favorites`
--

CREATE TABLE `user_favorites` (
  `slides_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `box_number`
--
ALTER TABLE `box_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`user_id`,`slide_id`),
  ADD KEY `fk_Person_has_Slide_Slide1_idx` (`slide_id`),
  ADD KEY `fk_Person_has_Slide_Person_idx` (`user_id`);

--
-- Indexes for table `request_archives`
--
ALTER TABLE `request_archives`
  ADD PRIMARY KEY (`slides_id`,`users_id`),
  ADD KEY `fk_slides_has_users_users2_idx` (`users_id`),
  ADD KEY `fk_slides_has_users_slides2_idx` (`slides_id`);

--
-- Indexes for table `section_types`
--
ALTER TABLE `section_types`
  ADD PRIMARY KEY (`other_id`,`SectionType`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide_box_numbers`
--
ALTER TABLE `slide_box_numbers`
  ADD PRIMARY KEY (`slide_id`,`box_number_id`),
  ADD KEY `fk_Slide_has_BoxNo_BoxNo1_idx` (`box_number_id`),
  ADD KEY `fk_Slide_has_BoxNo_Slide1_idx` (`slide_id`);

--
-- Indexes for table `slide_ceils`
--
ALTER TABLE `slide_ceils`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide_slide_ceils`
--
ALTER TABLE `slide_slide_ceils`
  ADD PRIMARY KEY (`slide_id`,`slide_ceils_id`),
  ADD KEY `fk_Slide_has_SlideCeils_SlideCeils1_idx` (`slide_ceils_id`),
  ADD KEY `fk_Slide_has_SlideCeils_Slide1_idx` (`slide_id`);

--
-- Indexes for table `special_groups`
--
ALTER TABLE `special_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`slides_id`,`users_id`),
  ADD KEY `fk_slides_has_users_users1_idx` (`users_id`),
  ADD KEY `fk_slides_has_users_slides1_idx` (`slides_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `others`
--
ALTER TABLE `others`
  ADD CONSTRAINT `fk_Others_Slide1` FOREIGN KEY (`id`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_Person_has_Slide_Person` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Person_has_Slide_Slide1` FOREIGN KEY (`slide_id`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_archives`
--
ALTER TABLE `request_archives`
  ADD CONSTRAINT `fk_slides_has_users_slides2` FOREIGN KEY (`slides_id`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_slides_has_users_users2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section_types`
--
ALTER TABLE `section_types`
  ADD CONSTRAINT `fk_SectionType_Others1` FOREIGN KEY (`other_id`) REFERENCES `others` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slide_box_numbers`
--
ALTER TABLE `slide_box_numbers`
  ADD CONSTRAINT `fk_Slide_has_BoxNo_BoxNo1` FOREIGN KEY (`box_number_id`) REFERENCES `box_number` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Slide_has_BoxNo_Slide1` FOREIGN KEY (`slide_id`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slide_slide_ceils`
--
ALTER TABLE `slide_slide_ceils`
  ADD CONSTRAINT `fk_Slide_has_SlideCeils_Slide1` FOREIGN KEY (`slide_id`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Slide_has_SlideCeils_SlideCeils1` FOREIGN KEY (`slide_ceils_id`) REFERENCES `slide_ceils` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `special_groups`
--
ALTER TABLE `special_groups`
  ADD CONSTRAINT `fk_SpecialGroups_Slide1` FOREIGN KEY (`id`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD CONSTRAINT `fk_slides_has_users_slides1` FOREIGN KEY (`slides_id`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_slides_has_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
