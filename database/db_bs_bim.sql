-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2025 at 09:26 AM
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
-- Database: `db_bs_bim`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_project`
--

CREATE TABLE `add_project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `desc_project` varchar(300) NOT NULL,
  `category_project` varchar(15) NOT NULL,
  `img_project` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_project`
--

INSERT INTO `add_project` (`id`, `project_name`, `desc_project`, `category_project`, `img_project`) VALUES
(31, 'مستشفى حكومي', ' لوحة تحكم إدارة المشاريع\r\nمرحباً a', 'تجاري', 'images/projects/33022.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `created_at`, `comment`, `rating`, `approved`) VALUES
(20, 'سارة العتيبي', 'mhmdaldshwm27@gmail.com', '2025-09-14 17:20:45', 'كانت تجربة ممتعة ولديهم خبرة عاليه شكرا شركة BS_BIM', 3, 0),
(21, 'سارة العتيبي', 'mhmdaldshwm27@gmail.com', '2025-09-14 17:20:51', 'كانت تجربة ممتعة ولديهم خبرة عاليه شكرا شركة BS_BIM', 3, 0),
(22, 'سارة العتيبي', 'mhmdaldshwm27@gmail.com', '2025-09-14 18:17:39', 'كانت تجربة ممتازة بخدمات ممتازة', 2, 1),
(23, 'على الحارثي', 'jsfjgjdsgfsdjh@gmail.com', '2025-09-14 23:27:54', 'كانت تجربة ممتعة معكم', 5, 1),
(24, 'محمد صادق عبدالرب', 'mhmdalqhwm27@gmail.com', '2025-09-15 17:33:27', 'jhdkhfhdkjkdhfggdfd', 5, 1),
(25, 'مجاهد الفقيه', 'mojasd@gmil.com', '2025-10-04 08:59:15', 'ugjhkgjgjhgjg', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(6, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE `project_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_category`
--

INSERT INTO `project_category` (`id`, `category_name`) VALUES
(3, 'سكني'),
(4, 'تجاري'),
(5, 'صناعي'),
(6, 'BIM'),
(7, 'حكومي');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_project`
--
ALTER TABLE `add_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_project`
--
ALTER TABLE `add_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
