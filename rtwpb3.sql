-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 07:53 AM
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
-- Database: `rtwpb3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(8, 'admin', '$2y$10$cokJLJQ7FD/7RTBsdxgosegMRi1LYeBfGYhC.I3xqiaB5nlmvrqZ2'),
(9, 'kian', '$2y$10$.4ibBVUPa/uJryfX0hMORurQH7FzM8sL60rzBeHS0Yi4W0aFxsLqe'),
(10, 'benj', '$2y$10$ukQsB9YjMC5XlINCL/FebemZLjMb.uWh8sCgLdR/jq21/FWVOZUD6');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `address`, `description`, `link`, `picture`) VALUES
(1, 'Improving Productivity Through Brand Reputation', '2025-03-06', 'City of San Fernando, Pampanga', 'Lorem ipsum dolor sit amet. Inventore rerum sed voluptatem porro est mollitia laboriosam sed exercitationem delectus rem quas omnis.', 'https://www.facebook.com/share/p/15uBpUnHrb/', 'events5.jpg'),
(2, 'Marketing Productivity Learning Session', '2025-03-07', 'Balanga, Bataan', 'Lorem ipsum dolor sit amet. Inventore rerum sed voluptatem porro est mollitia laboriosam sed exercitationem delectus rem quas omnis. dawdwad', 'https://www.facebook.com/share/p/18rkZQgpqA/', 'events4.jpg'),
(3, '2025 National Women\'s Month', '2025-03-01', 'Region 3', 'HDKJAHSKJHASHAJSHAKJSHAKJSHAKJSHAKJSHAJSHAJSHAJSKAHSKAHSKAHSKAHSAKJHSAJKSHAKSJHAKSHAKJSHASJKAHSAHKSAHSKAHSAKJ', 'https://www.facebook.com/share/p/1Bcq1FHdyZ/', 'events3.jpg'),
(4, 'Marketing Productivity Learning Session', '2025-03-13', 'Malolos, Bulacan<', 'dskdjskdjsdksjdksajdksadjkdjsadjk', 'https://www.facebook.com/share/p/19wWBKDvtz/', 'events2.jpg'),
(5, 'Productivity Training at Sacop', '2025-05-15', 'Maimpis, CSFP, Pampanga', 'fsadadwdddwa', 'https://www.facebook.com/share/p/1RAdHrqWyj/', 'events1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `date`, `description`, `link`, `picture`) VALUES
(1, 'New Wage Order', '2025-04-24', 'SALJSJKDjnbcjsabjdsahdlksandKNDKJANSKJANDKJANSJABSJABSJANdjNdkskdasdsadsadawda', 'https://www.facebook.com/share/p/19TFNAzgy7/', '1.jpg'),
(2, 'New Open Position', '2025-04-28', 'Lorem ipsum dolor sit amet. Inventore rerum sed voluptatem porro est mollitia laboriosam sed exercitationem delectus rem quas omnis.', 'https://www.facebook.com/share/p/18SJuXYSJ6/', '2.jpg'),
(3, 'Labor Day', '2025-05-01', 'dsadjksajdsdsakdnsakjdnsdkjanwjdnwaddnwadwadwadwadaw', 'https://www.facebook.com/share/p/1CTPo36sjj/', '3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff`, `position`, `picture`) VALUES
(2, 'Sir Kenneth', 'Board Secretary VI', 'staff1.jpg'),
(3, 'Sir Bob', 'Main Dancer', 'staff2.jpg'),
(4, 'Sir Carlo', 'Main Vocalist', 'staff3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
