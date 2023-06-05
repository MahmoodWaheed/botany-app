-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 03:07 PM
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

--
-- Dumping data for table `box_number`
--

INSERT INTO `box_number` (`id`, `box-number`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 5),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27);

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

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `family`, `latine_name`) VALUES
(1, 'Batrachospermaceae', 'Batrachospermum'),
(2, 'Chaetophoraceae', 'Chaetophora'),
(3, 'Cladophoraceae', 'Cladophora'),
(4, 'null', 'Diatoms'),
(5, 'Dictyotaceae', 'Dictyota'),
(6, 'Ulvaceae', 'Enteromorpha'),
(7, 'Adiantacea', 'Adiantum'),
(8, 'Anthocerotaceae', 'Anthoceros'),
(9, 'Aspleniaceae', 'Asplenium scolopendrium'),
(10, 'Bryophyta(mosses)', 'Bryophytes'),
(11, 'Dryopteridaceae', 'Dryopteris'),
(12, 'Equisetaceae', 'Equisetum'),
(13, 'Araucariaceae', 'Araucaria'),
(14, 'Cycadaceae', 'Cycas'),
(15, 'Pinaceae', 'Pinus'),
(16, 'Asphodelaceae', 'Aloe'),
(17, 'Asparagaceae', 'Asparagus'),
(18, 'Cannaceae', 'Canna'),
(19, 'Cyperaceae', 'Cyperus'),
(20, 'Asparagaceae', 'Dracaena'),
(21, 'Araceae', 'Epipremnum'),
(22, 'Malvaceae', 'Abutilon'),
(23, 'Sapindaceae', 'Acer'),
(24, 'Leguminosae(Fabaceae)', 'Albizia'),
(25, 'Amaranthaceae', 'Alternanthera'),
(26, 'Amaranthaceae', 'Amaranthus'),
(27, 'Umbelliferae(Apiaceae)', 'Apiumgraveolens');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `user_id` int(20) NOT NULL,
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
  `users_id` int(20) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `returned_state` tinyint(4) DEFAULT NULL,
  `request_state` varchar(45) DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_types`
--

CREATE TABLE `section_types` (
  `other_id` int(11) NOT NULL,
  `SectionType` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section_types`
--

INSERT INTO `section_types` (`other_id`, `SectionType`) VALUES
(1, 'null'),
(2, 'null'),
(3, 'null'),
(4, 'null'),
(5, 'null'),
(6, 'null'),
(7, 'Gametophte'),
(7, 'Gametophyte carrying sporophyte'),
(7, 'Sorus'),
(8, 'Spore tetrad'),
(9, 'Sporangia'),
(10, 'Archegonia of a moss plant'),
(10, 'L.S. male moss flower'),
(10, 'L.S.fe male moss flower'),
(10, 'Protonema of a moss plant'),
(11, 'Frond'),
(11, 'Sori'),
(12, 'Prothallus'),
(12, 'Spores'),
(12, 'T.S. of cone'),
(12, 'T.S. of stem'),
(13, 'Stem'),
(14, 'Leaf petiole'),
(15, 'Cone'),
(15, 'Leaf'),
(15, 'Root'),
(15, 'Seed'),
(15, 'Stem'),
(16, 'Leaf'),
(17, 'Stem'),
(18, 'Leaf'),
(19, 'Leaf'),
(19, 'Stem'),
(20, 'Leaf'),
(20, 'Stem'),
(21, 'Leaf'),
(21, 'Petiole'),
(21, 'Stem'),
(22, 'Petiole'),
(22, 'Stem'),
(23, 'Stem'),
(24, 'Stem'),
(25, 'Stem'),
(26, 'Stem'),
(27, 'Petiole');

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

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `arabicName`, `count`, `slide_number`, `cupbord`, `english_name`, `image`, `group_name`) VALUES
(1, 'باتراخوسبرموم', 100, 1, 1, 'null', '', 'Phycology'),
(2, 'كيتوفورا', 100, 2, 1, 'null', NULL, 'Phycology'),
(3, 'كلادفورا', 100, 3, 1, 'null', NULL, 'Phycology'),
(4, 'دياتومات', 100, 4, 1, 'null', NULL, 'Phycology'),
(5, 'دكتيوتا', 100, 5, 1, 'null', NULL, 'Phycology'),
(6, 'انتيرومورفا', 100, 6, 1, 'nulll', NULL, 'Phycology'),
(7, 'كزبرة البذر', 150, 1, 1, 'null', NULL, 'Archegoniate'),
(8, 'أنثوسيروس(زهقرن)', 30, 2, 1, 'null', NULL, 'Archegoniate'),
(9, 'عقربان', 30, 3, 1, 'null', NULL, 'Archegoniate'),
(10, 'حزاز', 30, 4, 1, 'null', NULL, 'Archegoniate'),
(11, 'خنشار', 20, 5, 1, 'null', NULL, 'Archegoniate'),
(12, 'ذيل الحصان', 400, 6, 1, 'null', NULL, 'Archegoniate'),
(13, 'اروكاريا', 300, 1, 1, 'null', NULL, 'Gymnosperm'),
(14, 'سيكاس', 200, 2, 1, 'null', NULL, 'Gymnosperm'),
(15, 'صنوبر', 1500, 1, 1, 'null', NULL, 'Gymnosperm'),
(16, 'صبار', 200, 1, 1, 'null', NULL, 'Monocotyledon'),
(17, 'اسبرجس', 300, 2, 1, 'null', NULL, 'Monocotyledon'),
(18, 'كنا', 300, 3, 1, 'null', NULL, 'Monocotyledon'),
(19, 'سعد', 300, 4, 1, 'null', NULL, 'Monocotyledon'),
(20, 'دراسينا', 400, 5, 1, 'null', NULL, 'Monocotyledon'),
(21, 'بوتس', 300, 6, 1, 'null', NULL, 'Monocotyledon'),
(22, 'ابو تيلون', 400, 1, 1, 'null', NULL, 'Dicotyledon'),
(23, 'اسر', 100, 2, 1, 'null', NULL, 'Dicotyledon'),
(24, 'اللبخ', 200, 3, 1, 'null', NULL, 'Dicotyledon'),
(25, 'الالينتيرا', 100, 4, 1, 'null', NULL, 'Dicotyledon'),
(26, 'الامرنتس', 200, 5, 1, 'null', NULL, 'Dicotyledon'),
(27, 'كرفس', 100, 6, 1, 'null', NULL, 'Dicotyledon'),
(28, 'ساق رتما (صحراوي)', 300, 1, 2, 'null', NULL, 'Special groups '),
(29, 'ساق قصب الرمال (طبيعي)', 100, 2, 2, 'null', NULL, 'Special groups '),
(30, 'ورقة قصب الرمال (صحرواي)', 300, 3, 2, 'null', NULL, 'Special groups '),
(31, 'ساق ايلوديا (ماني)', 300, 4, 2, 'null', NULL, 'Special groups '),
(32, 'ساق بوتاموجتم (ماني)', 200, 5, 2, 'null', NULL, 'Special groups '),
(33, 'ورقة و عنق بشنين (ماني)', 200, 6, 2, 'null', NULL, 'Special groups ');

-- --------------------------------------------------------

--
-- Table structure for table `slide_box_numbers`
--

CREATE TABLE `slide_box_numbers` (
  `slide_id` int(11) NOT NULL,
  `box_number_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slide_box_numbers`
--

INSERT INTO `slide_box_numbers` (`slide_id`, `box_number_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(4, 2),
(5, 3),
(6, 3),
(7, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 3),
(12, 4),
(12, 5),
(12, 6),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 5),
(15, 6),
(15, 7),
(15, 8),
(15, 9),
(15, 10),
(15, 11),
(15, 12),
(15, 13),
(15, 14),
(15, 15),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(17, 3),
(18, 1),
(18, 2),
(18, 3),
(19, 1),
(19, 2),
(19, 3),
(20, 1),
(20, 2),
(20, 3),
(20, 4),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(22, 2),
(22, 4),
(22, 23),
(23, 1),
(24, 1),
(24, 2),
(25, 1),
(26, 1),
(26, 2),
(27, 1),
(28, 1),
(28, 2),
(28, 3),
(29, 4),
(30, 5),
(30, 6),
(30, 7),
(31, 8),
(31, 9),
(31, 10),
(32, 11),
(32, 12),
(33, 13),
(33, 14);

-- --------------------------------------------------------

--
-- Table structure for table `slide_ceils`
--

CREATE TABLE `slide_ceils` (
  `id` int(11) NOT NULL,
  `ceil_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slide_ceils`
--

INSERT INTO `slide_ceils` (`id`, `ceil_name`) VALUES
(1, 'x'),
(2, 'x'),
(3, 'y'),
(4, 'x'),
(5, 'x'),
(6, 'y'),
(7, 'x'),
(8, 'y'),
(9, 'x'),
(10, 'y'),
(11, 'x'),
(12, 'x'),
(13, 'y'),
(14, 'y'),
(15, 'x'),
(16, 'y'),
(17, 'x'),
(18, 'y'),
(19, 'x'),
(20, 'x'),
(21, 'y'),
(22, 'y'),
(23, 'x'),
(24, 'y'),
(25, 'x'),
(26, 'y'),
(27, 'x'),
(28, 'x'),
(29, 'y'),
(30, 'y'),
(31, 'x'),
(32, 'y'),
(33, 'x');

-- --------------------------------------------------------

--
-- Table structure for table `slide_slide_ceils`
--

CREATE TABLE `slide_slide_ceils` (
  `slide_id` int(11) NOT NULL,
  `slide_ceils_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slide_slide_ceils`
--

INSERT INTO `slide_slide_ceils` (`slide_id`, `slide_ceils_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 1),
(5, 1),
(5, 2),
(6, 4),
(7, 5),
(8, 12),
(9, 1),
(10, 5),
(11, 4),
(12, 17),
(13, 21),
(14, 25),
(15, 31),
(16, 32),
(17, 33),
(18, 10),
(19, 11),
(20, 2),
(21, 30),
(22, 18),
(23, 17),
(24, 7),
(25, 19),
(26, 21),
(27, 3),
(28, 25),
(29, 20),
(30, 6),
(31, 9),
(32, 14),
(33, 26);

-- --------------------------------------------------------

--
-- Table structure for table `special_groups`
--

CREATE TABLE `special_groups` (
  `id` int(11) NOT NULL,
  `specimen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `special_groups`
--

INSERT INTO `special_groups` (`id`, `specimen`) VALUES
(28, 'Retama stem (xerophytic)'),
(29, 'Ammophila stem (normal stem)'),
(30, 'Ammophila  (xerophytic)'),
(31, 'Elodea stem (hydrophytic)'),
(32, 'Potamogeton stem (hydrophytic)'),
(33, 'Nymphaea leaf & petiole (hydrophytic)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `ssn` varchar(45) NOT NULL,
  `blocked` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email_verified_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `type`, `ssn`, `blocked`, `created_at`, `updated_at`, `email_verified_at`, `remember_token`) VALUES
(1, 'Mahmoud waheed', '123456789', 'mahmoud.waheed.moh@gmail.com', '0123456789', 'doctor', '01234567891234', 0, '2023-04-30 21:00:00', '2023-05-01 21:00:00', NULL, NULL),
(2, 'Hagar Abdelaliem', '123456789', 'yaom.200011@gmail.com', '0123456789', 'student', '01478523691234', 0, '2023-04-30 21:00:00', '2023-05-01 21:00:00', NULL, NULL),
(3, 'Rehab Hamdy', '123456789', 'rehab123selim@gmail.com', '0123456789', 'student', '03698521479517', 0, '2023-04-30 21:00:00', '2023-05-01 21:00:00', NULL, NULL),
(4, 'Rehab Hamy Mohamed', '123456789', 'rehab.hamdy.selim@gmail.com', '0123456789', 'admain', '01478528527894', 0, '2023-04-30 21:00:00', '2023-05-04 21:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_favorites`
--

CREATE TABLE `user_favorites` (
  `slides_id` int(11) NOT NULL,
  `users_id` int(20) NOT NULL
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
  ADD PRIMARY KEY (`id`,`users_id`,`slides_id`),
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
-- AUTO_INCREMENT for table `request_archives`
--
ALTER TABLE `request_archives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
