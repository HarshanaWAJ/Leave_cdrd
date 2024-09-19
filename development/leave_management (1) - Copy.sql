-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 07:17 AM
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
-- Database: `leave_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `intern`
--

CREATE TABLE `intern` (
  `intern_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_in_full` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `trade` varchar(255) NOT NULL,
  `wing` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `applied_leaves` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intern`
--

INSERT INTO `intern` (`intern_id`, `name`, `name_in_full`, `permanent_address`, `university`, `trade`, `wing`, `email`, `username`, `password`, `applied_leaves`) VALUES
('10', 'Shashini', 'Shashini Prawarditha', 'hjmmng', 'Uva Wellassa', 'intern', 'IT/GIS', 'fgh@gmail.com', 'shashi', 'ghj', 0),
('15', 'Saman', 'Saman Kumara', 'hjmmng', 'Uva Wellassa', 'intern', 'ELECTRICAL AND MECHANICAL', 'fgh@gmail.com', 'saman', 'ghjm', 0),
('2', '2', '2', '2', '2', '2', 'ELECTRICAL AND MECHANICAL', '2@cdrd.lk', '2', '2', 0),
('intern1', 'intern', 'intern', 'intern', 'intern', 'intern', 'IT/GIS', 'intern1@cdrd.lk', 'intern', 'intern', 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `number_of_days` decimal(5,1) NOT NULL,
  `intern_id` varchar(20) NOT NULL,
  `wing` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `status1` varchar(10) NOT NULL,
  `status2` varchar(10) NOT NULL,
  `status3` varchar(10) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `name`, `leave_type`, `from_date`, `to_date`, `from_time`, `to_time`, `number_of_days`, `intern_id`, `wing`, `reason`, `status1`, `status2`, `status3`, `submission_date`) VALUES
(1, 'intern', 'Casual Leave', '2024-05-15', '2024-05-16', '11:42:00', '11:42:00', 1.0, 'intern1', '', 'hiii', '', '', '', '2024-05-31 06:12:33'),
(2, 'intern', 'Sick Leave', '2024-05-22', '2024-05-23', '15:45:00', '15:45:00', 1.0, 'intern1', 'IT/GIS', 'sick', '', '', '', '2024-05-31 09:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications_officers`
--

CREATE TABLE `leave_applications_officers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `number_of_days` decimal(5,1) NOT NULL,
  `officer_number` varchar(20) NOT NULL,
  `position` varchar(20) NOT NULL,
  `wing` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `assigned_officer_id` int(255) NOT NULL,
  `assigned_officer_name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `status1` varchar(10) NOT NULL,
  `status2` varchar(10) NOT NULL,
  `status3` varchar(10) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_applications_officers`
--

INSERT INTO `leave_applications_officers` (`id`, `name`, `leave_type`, `from_date`, `to_date`, `from_time`, `to_time`, `number_of_days`, `officer_number`, `position`, `wing`, `reason`, `assigned_officer_id`, `assigned_officer_name`, `status`, `status1`, `status2`, `status3`, `submission_date`) VALUES
(1, 'Himasha', 'Casual Leave', '2024-05-22', '2024-05-23', '08:30:00', '16:31:00', 2.0, '8', 'Wing Head', '', 'Visit Docter', 0, '', '', '', '', '', '2024-05-21 03:48:21'),
(2, 'Himasha', 'Sick Leave', '2024-05-06', '2024-05-08', '09:25:00', '16:30:00', 3.0, '7', 'Research Officer', '', 'sick', 0, '', '', '', '', '', '2024-05-21 03:55:57'),
(3, 'Himasha', 'Casual Leave', '2024-05-09', '2024-05-12', '11:43:00', '13:45:00', 3.0, '', 'Research Officer', '', 'ghj', 0, '', '', '', '', '', '2024-05-30 06:13:33'),
(4, 'Himasha', 'Casual Leave', '2024-05-09', '2024-05-11', '11:55:00', '12:56:00', 2.0, '2', 'Research Officer', '', 'gh', 0, '', '', '', '', '', '2024-05-30 06:26:01'),
(5, 'Shashini', 'Casual Leave', '2024-05-09', '2024-05-10', '14:15:00', '13:14:00', 1.0, '1', 'Research Officer', '', 'ghj', 0, '', '', '', '', '', '2024-05-30 06:43:51'),
(6, 'Shashini', 'Casual Leave', '2024-05-07', '2024-05-08', '01:31:00', '13:30:00', 1.0, '1', 'Research Officer', '', 'ghj', 0, '', '', '', '', '', '2024-05-30 07:01:07'),
(7, 'Shashini', 'Casual Leave', '2024-05-07', '2024-05-08', '22:10:00', '12:12:00', 1.0, '45', 'Research Officer', '', 'visit a doctor', 5, 'aseni', '', '', '', '', '2024-05-31 03:40:58'),
(8, 'Shashini', 'Casual Leave', '2024-05-15', '2024-05-17', '09:12:00', '09:12:00', 2.0, '45', 'Research Officer', '', 'go  to home', 5, 'aseni', '', '', '', '', '2024-05-31 03:43:11'),
(9, 'Nimal', 'Sick Leave', '2024-05-22', '2024-05-23', '14:22:00', '14:22:00', 1.0, '202', 'Research Officer', '', 'sick', 201, 'Kodithuwakku', '', '', '', '', '2024-05-31 08:53:04'),
(11, 'Kodithuwakku', 'Casual Leave', '2024-06-06', '2024-06-07', '09:52:00', '09:52:00', 1.0, '201', 'Research Officer', '', 'go to home', 202, 'Nimal', '', '', '', '', '2024-06-03 04:22:22'),
(12, 'Kodithuwakku', 'Casual Leave', '2024-06-03', '2024-06-04', '10:02:00', '10:02:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'go to hospital', 202, 'Nimal', '', '', '', '', '2024-06-03 04:35:00'),
(13, 'Kodithuwakku', 'Sick Leave', '2024-06-03', '2024-06-04', '10:09:00', '10:07:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'sick', 202, 'Nimal', '', '', '', '', '2024-06-03 04:40:16'),
(14, 'aseni', 'Casual Leave', '2024-06-03', '2024-06-04', '10:35:00', '10:35:00', 1.0, '9', 'Staff Officer 1', '', 'go to home', 0, '', '', '', '', '', '2024-06-03 05:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` int(11) NOT NULL,
  `officer_number` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `name_in_full` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `temporary_address` varchar(255) NOT NULL,
  `trade` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `gs_division` varchar(255) NOT NULL,
  `nearest_police_station` varchar(255) NOT NULL,
  `wing` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`id`, `officer_number`, `rank`, `name`, `unit`, `name_in_full`, `permanent_address`, `temporary_address`, `trade`, `position`, `district`, `gs_division`, `nearest_police_station`, `wing`, `email`, `username`, `password`) VALUES
(1, '1', 'Captain', 'Saman', '5', 'Saman Kumara', 'hjmmng', 'hjmngh', 'cheif', 'Wing Head', 'ANURADHAPURA', 'jhjk', 'hnm', 'IT/GIS', 'ict20010@std.uwu.ac.lk', 'ict20010', 'dfg'),
(2, '2', 'Captain', '2', '2', 'Arshani Lakmali', '2', '2', '2', 'Wing Head', 'MATARA', '2', '2', 'RADIO AND ELECTRONICS', 'officer@cdrd.lk', '2oggg', 'officer@cdrd.lk'),
(3, '8', 'Colonel', 'Himasha', '8 unit', 'Himasha Aseni', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'Wing Head', 'Wing Head', 'PUTTALAM', 'Homagama', 'Homagama', 'IT/GIS', 'Winghead@cdrd.lk', 'WingHead', 'Winghead@cdrd.lk'),
(4, '9', 'Lieutenant', 'aseni', '9', 'SO1', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'SO1', 'Staff Officer 1', 'POLONNARUWA', 'Homagama', 'Homagama', 'None', 'so1@cdrd.lk', 'so1', 'so1@cdrd.lk'),
(5, '7', 'Commander', 'Himasha', '2', 'Sahiru Vithana', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'Research officer', 'Research Officer', 'AMPARA', 'ampara', 'ampara', 'IT/GIS', 'research@cdrd.lk', 'research', 'research@cdrd.lk'),
(6, '5', 'Captain', 'asenii', '5', 'Shashini Prawarditha', 'hjmmng', 'hjmngh', 'cheif', 'Cheif Controller', 'MULLAITIVU', 'jhjk', 'hnm', 'NANO AND MODERN TECHNOLOGY', 'cheif@cdrd.lk', 'cheif', 'cheif@cdrd.lk'),
(7, '10', 'Lieutenant Colonel', 'asenii', '10', 'nhhj', 'hjmmng', 'hjmngh', 'ddg', 'Deputy Director General', 'COLOMBO', 'jhjk', 'hnm', 'None', 'ddg@cdrd.lk', 'ddg', 'ddg@cdrd.lk'),
(14, '45', 'Captain', 'Shashini', '5', 'Arshani Lakmali', 'hjmmng', 'hjmngh', 'research officer', 'Research Officer', 'MONARAGALA', 'jhjk', 'hnm', 'CYBER', 'research1@cdrd.lk', 'ro', 'research1@cdrd.lk'),
(15, '201', 'Lieutenant', 'Kodithuwakku', '10', 'D.M.Kodithuwakku', 'homagama', 'homagama', 'research officer', 'Research Officer', 'MULLAITIVU', 'jhjk', 'hnm', 'IT/GIS', 'kodi@cdrd.lk', 'kodi', 'kodi@cdrd.lk'),
(16, '202', 'Captain', 'Nimal', '25', 'nimal rajapaksha', 'homagama', 'homagama', 'research officer', 'Research Officer', 'MONARAGALA', 'jhjk', 'hnm', 'IT/GIS', 'nimal@cdrd.lk', 'nimal', 'nimal@cdrd.lk'),
(17, '204', 'Lieutenant', 'A.A.Samarakoon', '5', 'A.A.Samarakoon', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'Director General', 'Director General', 'NUWARA ELIYA', 'ampara', 'ampara', 'None', 'dg@cdrd.lk', 'dg', 'dg@cdrd.lk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `intern`
--
ALTER TABLE `intern`
  ADD PRIMARY KEY (`intern_id`);

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_applications_officers`
--
ALTER TABLE `leave_applications_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_applications_officers`
--
ALTER TABLE `leave_applications_officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
