-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 05:21 AM
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
('0', 'intern', 'intern', 'intern', 'intern', 'intern', 'IT/GIS', 'intern1@cdrd.lk', 'intern', '$2y$10$PQJD9AapH12j1OU75Q9I9u/9Cp0EaWNSIiEPdH/HILvgF/YpkoeoK', 0),
('10', 'Shashini', 'Shashini Prawarditha', 'hjmmng', 'Uva Wellassa', 'intern', 'IT/GIS', 'fgh@gmail.com', 'shashi', '$2y$10$OmAQJBqBnvHuGaZmTXD2meRVh6b6VhH6NTXMuh1h1eOt0vHlMMDri', 0),
('15', 'Saman', 'Saman Kumara', 'hjmmng', 'Uva Wellassa', 'intern', 'ELECTRICAL AND MECHANICAL', 'fgh@gmail.com', 'saman', '$2y$10$EhI6bJ9z92mcDKuW40mVG.adRzz2uff2AroYZc1NTtx09OY.s3kMi', 0),
('2', '2', '2', '2', '2', '2', 'ELECTRICAL AND MECHANICAL', '2@cdrd.lk', '2', '$2y$10$nSSGOIHBfNqjrHIEp4vwvuK6m4wkQ9THpBdLfURIXUIubaXpSf6/O', 0),
('448', 'Aseni', 'Himasha Aseni', 'homagama', 'Uva Wellassa', 'intern', 'IT/GIS', 'asi@cdrd.lk', 'aseni', '$2y$10$2vb2sCSSxjGjyz7VYqAnxe1Jn4jiGcfSQohGYKtOq7RqENPP5H3NC', 0);

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
  `number_of_days` decimal(10,0) NOT NULL,
  `intern_id` varchar(20) NOT NULL,
  `wing` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `remarks` text NOT NULL,
  `status1` varchar(10) NOT NULL,
  `status2` varchar(10) NOT NULL,
  `status3` varchar(10) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `name`, `leave_type`, `from_date`, `to_date`, `from_time`, `to_time`, `number_of_days`, `intern_id`, `wing`, `reason`, `remarks`, `status1`, `status2`, `status3`, `submission_date`) VALUES
(11, 'intern', 'Sick Leave', '2024-06-11', '2024-06-12', '10:45:00', '10:45:00', 1, '0', 'IT/GIS', 'sick', '', 'approve', 'decline', '', '2024-06-10 05:15:50'),
(12, 'intern', 'Casual Leave', '2024-06-10', '2024-06-11', '10:50:00', '10:50:00', 1, '0', 'IT/GIS', 'go to home', '', 'decline', '', '', '2024-06-10 05:20:21'),
(13, 'intern', 'Casual Leave', '2024-06-10', '2024-06-11', '16:38:00', '16:38:00', 1, '0', 'IT/GIS', 'go to home', '', '', '', '', '2024-06-10 10:08:47');

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
  `remarks` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `status1` varchar(10) NOT NULL,
  `status2` varchar(10) NOT NULL,
  `status3` varchar(10) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_applications_officers`
--

INSERT INTO `leave_applications_officers` (`id`, `name`, `leave_type`, `from_date`, `to_date`, `from_time`, `to_time`, `number_of_days`, `officer_number`, `position`, `wing`, `reason`, `assigned_officer_id`, `assigned_officer_name`, `remarks`, `status`, `status1`, `status2`, `status3`, `submission_date`) VALUES
(2, 'Himasha', 'Sick Leave', '2024-05-06', '2024-05-08', '09:25:00', '16:30:00', 3.0, '7', 'Research Officer', '', 'sick', 0, '', '', '', '', '', '', '2024-05-21 03:55:57'),
(3, 'Himasha', 'Casual Leave', '2024-05-09', '2024-05-12', '11:43:00', '13:45:00', 3.0, '', 'Research Officer', '', 'ghj', 0, '', '', '', '', '', '', '2024-05-30 06:13:33'),
(4, 'Himasha', 'Casual Leave', '2024-05-09', '2024-05-11', '11:55:00', '12:56:00', 2.0, '2', 'Research Officer', '', 'gh', 0, '', '', '', '', '', '', '2024-05-30 06:26:01'),
(5, 'Shashini', 'Casual Leave', '2024-05-09', '2024-05-10', '14:15:00', '13:14:00', 1.0, '1', 'Research Officer', '', 'ghj', 0, '', '', '', '', '', '', '2024-05-30 06:43:51'),
(6, 'Shashini', 'Casual Leave', '2024-05-07', '2024-05-08', '01:31:00', '13:30:00', 1.0, '1', 'Research Officer', '', 'ghj', 0, '', '', '', '', '', '', '2024-05-30 07:01:07'),
(7, 'Shashini', 'Casual Leave', '2024-05-07', '2024-05-08', '22:10:00', '12:12:00', 1.0, '45', 'Research Officer', '', 'visit a doctor', 5, 'aseni', '', '', '', '', '', '2024-05-31 03:40:58'),
(8, 'Shashini', 'Casual Leave', '2024-05-15', '2024-05-17', '09:12:00', '09:12:00', 2.0, '45', 'Research Officer', '', 'go  to home', 5, 'aseni', '', '', '', '', '', '2024-05-31 03:43:11'),
(11, 'Kodithuwakku', 'Casual Leave', '2024-06-06', '2024-06-07', '09:52:00', '09:52:00', 1.0, '201', 'Research Officer', '', 'go to home', 202, 'Nimal', '', 'approve', '', '', '', '2024-06-03 04:22:22'),
(12, 'Kodithuwakku', 'Casual Leave', '2024-06-03', '2024-06-04', '10:02:00', '10:02:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'go to hospital', 202, 'Nimal', '', 'approve', 'approve', 'approve', 'approve', '2024-06-03 04:35:00'),
(16, 'Shashini', 'Sick Leave', '2024-06-05', '2024-06-05', '11:12:00', '11:12:00', 0.0, '45', 'Research Officer', 'IT/GIS', 'sick', 202, 'Nimal', '', 'approve', '', '', '', '2024-06-04 05:49:00'),
(17, 'Kodithuwakku', 'Sick Leave', '2024-06-05', '2024-06-06', '01:06:00', '01:06:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'sick', 45, 'Shashini', '', '', '', '', '', '2024-06-04 06:39:07'),
(18, 'Kodithuwakku', 'Sick Leave', '2024-06-05', '2024-06-06', '01:06:00', '01:06:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'sick', 45, 'Shashini', 'sick', 'approve', 'approve', '', '', '2024-06-04 06:41:48'),
(19, 'Kodithuwakku', 'Sick Leave', '2024-06-05', '2024-06-06', '01:06:00', '01:06:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'sick', 45, 'Shashini', 'sick', 'approve', 'decline', '', '', '2024-06-04 06:59:07'),
(20, 'Kodithuwakku', 'Sick Leave', '2024-06-05', '2024-06-06', '01:06:00', '01:06:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'sick', 45, 'Shashini', 'sick', '', '', '', '', '2024-06-04 06:59:40'),
(21, 'Kodithuwakku', 'Casual Leave', '2024-06-05', '2024-06-06', '15:52:00', '15:52:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'dfgh', 202, 'Himasha', 'dfgh', 'decline', '', '', '', '2024-06-05 09:22:22'),
(22, 'Himasha', 'Casual Leave', '2024-06-05', '2024-06-06', '17:52:00', '18:52:00', 1.0, '8', 'Wing Head', '', 'go to colombo', 0, '', '', '', '', 'approve', 'approve', '2024-06-05 10:22:21'),
(24, 'Himasha', 'Sick Leave', '2024-06-06', '2024-06-07', '08:33:00', '08:33:00', 1.0, '8', 'Wing Head', '', 'sick', 0, '', 'sick', '', '', 'approve', 'approve', '2024-06-06 03:06:05'),
(26, 'aseni', 'Sick Leave', '2024-06-06', '2024-06-07', '09:47:00', '09:47:00', 1.0, '9', 'Staff Officer 1', '', 'sick', 0, '', '', '', '', '', 'decline', '2024-06-06 04:24:35'),
(29, 'aseni', 'Sick Leave', '2024-06-06', '2024-06-07', '09:59:00', '09:59:00', 1.0, '9', 'Staff Officer 1', '', 'feaver', 0, '', 'feaver', '', '', '', 'approve', '2024-06-06 04:29:28'),
(31, 'Himasha', 'Sick Leave', '2024-06-06', '2024-06-07', '15:03:00', '15:03:00', 1.0, '8', 'Wing Head', '', 'dffhjj', 45, 'Shashini', '', '', '', '', '', '2024-06-06 08:38:19'),
(32, 'Himasha', 'Sick Leave', '2024-06-05', '2024-06-06', '14:17:00', '15:17:00', 1.0, '8', 'Wing Head', '', 'dengue', 202, 'asenii', '', '', '', 'approve', 'decline', '2024-06-06 08:48:10'),
(33, 'Himasha', 'Sick Leave', '2024-06-04', '2024-06-05', '14:19:00', '14:19:00', 1.0, '8', 'Wing Head', '', 'una', 45, 'A.A.Samarakoon', 'una', '', '', 'approve', 'approve', '2024-06-06 08:51:18'),
(34, 'aseni', 'Casual Leave', '2024-06-06', '2024-06-07', '15:36:00', '15:36:00', 1.0, '9', 'Staff Officer 1', '', 'go to home', 257, 'A.A.Samara', '', '', '', '', 'approve', '2024-06-06 09:06:57'),
(35, 'aseni', 'Casual Leave', '2024-06-06', '2024-06-07', '15:43:00', '15:44:00', 1.0, '9', 'Staff Officer 1', '', 'go to hospital', 257, 'A.A.Samara', 'go to hospital', '', '', '', '', '2024-06-06 09:14:27'),
(36, 'A.A.Samara', 'Sick Leave', '2024-06-06', '2024-06-07', '16:05:00', '16:05:00', 1.0, '256', 'Cheif Controller', '', 'sick', 5, 'asenii', '', '', '', '', 'approve', '2024-06-06 09:35:46'),
(37, 'A.A.Samara', 'Sick Leave', '2024-06-06', '2024-06-08', '16:15:00', '16:15:00', 2.0, '256', 'Cheif Controller', '', 'fgh', 257, 'asenii', '', '', '', '', 'decline', '2024-06-06 09:45:56'),
(38, 'A.A.Samara', 'Sick Leave', '2024-06-06', '2024-06-07', '16:16:00', '16:16:00', 1.0, '256', 'Cheif Controller', '', 'feaver', 257, 'asenii', 'feaver', '', '', '', 'approve', '2024-06-06 09:47:11'),
(39, 'asenii', 'Sick Leave', '2024-06-06', '2024-06-07', '16:37:00', '16:37:00', 1.0, '10', 'Deputy Director Gene', '', 'sick', 201, 'A.A.Samara', '', '', '', '', '', '2024-06-06 10:08:13'),
(40, 'asenii', 'Casual Leave', '2024-06-09', '2024-06-11', '16:45:00', '16:45:00', 2.0, '10', 'Deputy Director Gene', '', 'go to maharagama', 2, 'A.A.Samara', '', '', '', '', '', '2024-06-06 10:15:27'),
(41, 'asenii', 'Casual Leave', '2024-06-05', '2024-06-06', '17:05:00', '17:05:00', 1.0, '10', 'Deputy Director Gene', '', 'go to colombo', 2, 'A.A.Samara', 'go to colombo', '', '', '', '', '2024-06-06 10:35:32'),
(42, 'dilshi', 'Sick Leave', '2024-06-07', '2024-06-08', '09:38:00', '09:38:00', 1.0, '345', 'Cheif Coordinator', '', 'sick', 257, 'asenii', '', '', '', '', '', '2024-06-07 04:08:31'),
(43, 'dilshi', 'Casual Leave', '2024-06-07', '2024-06-09', '09:42:00', '09:43:00', 2.0, '345', 'Cheif Coordinator', '', 'go to home', 45, 'asenii', '', '', '', '', '', '2024-06-07 04:13:16'),
(44, 'dilshi', 'Sick Leave', '2024-06-07', '2024-06-08', '09:44:00', '09:45:00', 1.0, '345', 'Cheif Coordinator', '', 'go to hospital', 45, 'A.A.Samara', 'go to hospital', '', '', '', '', '2024-06-07 04:15:25'),
(47, 'Account Officer', 'Sick Leave', '2024-06-06', '2024-06-07', '15:14:00', '16:14:00', 1.0, '456', 'Account Officer', '', 'dfgjk', 0, '', '', '', '', '', '', '2024-06-07 08:57:43'),
(48, 'Account Officer', 'Sick Leave', '2024-06-07', '2024-06-08', '15:29:00', '15:29:00', 1.0, '456', 'Account Officer', '', 'sick', 257, 'Quater Master', 'sick', '', '', '', '', '2024-06-07 08:59:44'),
(49, 'dilshi', 'Sick Leave', '2024-06-06', '2024-06-07', '21:42:00', '14:43:00', 0.5, '345', 'Cheif Coordinator', '', 'fghj', 201, 'Quater Master', 'dfgh', '', '', '', '', '2024-06-07 09:13:33'),
(50, 'dilshi', 'Sick Leave', '2024-06-06', '2024-06-07', '16:56:00', '16:57:00', 1.0, '345', 'Cheif Coordinator', '', 'sickkk', 2, 'Quater Master', 'sickkkk', '', '', '', '', '2024-06-07 09:27:20'),
(51, 'dilshi', 'Casual Leave', '2024-06-06', '2024-06-07', '17:06:00', '17:07:00', 1.0, '345', 'Cheif Coordinator', '', 'sdgh', 257, 'A.A.Samara', 'dghj', '', '', '', 'decline', '2024-06-07 09:37:15'),
(53, 'Quater Master', 'Sick Leave', '2024-06-06', '2024-06-07', '17:17:00', '17:17:00', 1.0, '266', 'Quater Master', '', 'ddg', 2, 'A.A.Samara', '', '', '', '', '', '2024-06-07 09:47:33'),
(54, 'Quater Master', 'Sick Leave', '2024-06-06', '2024-06-08', '17:18:00', '18:17:00', 2.0, '266', 'Quater Master', '', 'dfghjk', 5, 'A.A.Samarakoon', '', '', '', '', 'decline', '2024-06-07 09:48:04'),
(55, 'Quater Master', 'Sick Leave', '2024-06-06', '2024-06-07', '16:18:00', '16:18:00', 1.0, '266', 'Quater Master', '', 'sdfghj', 257, 'M.R. Pinnawala', 'sdfghj', '', '', '', '', '2024-06-07 09:49:03'),
(56, 'Quater Master', 'Sick Leave', '2024-05-31', '2024-06-01', '17:21:00', '17:21:00', 1.0, '266', 'Quater Master', '', 'dfg', 201, 'A.A.Samarakoon', 'dgh', '', '', '', 'approve', '2024-06-07 09:51:24'),
(57, 'Account Officer', 'Casual Leave', '2024-06-06', '2024-06-06', '04:27:00', '16:27:00', 0.5, '456', 'Account Officer', '', 'sdfgh', 2, 'Quater Master', '', '', '', '', 'decline', '2024-06-07 09:58:30'),
(58, 'Account Officer', 'Sick Leave', '2024-06-06', '2024-06-07', '16:33:00', '17:33:00', 1.0, '456', 'Account Officer', '', 'dfg', 2, 'Himasha', 'sdfg', '', '', '', 'approve', '2024-06-07 10:04:03'),
(59, 'Quater Master', 'Sick Leave', '2024-06-06', '2024-06-07', '16:41:00', '16:41:00', 1.0, '266', 'Quater Master', '', 'dfghj', 45, 'Nimal', 'sdfgh', '', '', '', 'approve', '2024-06-07 10:11:42'),
(60, 'dilshi', 'Sick Leave', '2024-06-06', '2024-06-07', '16:45:00', '17:45:00', 1.0, '345', 'Cheif Coordinator', '', 'df', 257, 'A.A.Samara', 'fgh', '', '', '', 'approve', '2024-06-07 10:15:26'),
(61, 'asenii', 'Sick Leave', '2024-06-06', '2024-06-07', '16:50:00', '16:50:00', 1.0, '10', 'Deputy Director Gene', '', 'sdfgh', 201, 'A.A.Samara', 'dfgh', '', '', '', 'approve', '2024-06-07 10:20:39'),
(62, 'A.A.Samara', 'Casual Leave', '2024-06-06', '2024-06-07', '17:54:00', '18:54:00', 1.0, '256', 'Cheif Controller', '', 'ghj', 257, 'asenii', 'sdfghj', '', '', '', 'approve', '2024-06-07 10:24:49'),
(63, 'A.A.Samara', 'Sick Leave', '2024-06-06', '2024-06-07', '16:57:00', '16:57:00', 1.0, '256', 'Cheif Controller', '', 'go go', 201, 'asenii', 'go go', '', '', '', 'decline', '2024-06-07 10:27:31'),
(64, 'aseni', 'Sick Leave', '2024-06-07', '2024-06-08', '17:01:00', '17:01:00', 1.0, '9', 'Staff Officer 1', '', 'gi to go', 45, 'M.R. Pinnawala', 'sdfgh', '', '', '', 'approve', '2024-06-07 10:31:40'),
(65, 'Himasha', 'Sick Leave', '2024-06-06', '2024-06-07', '18:05:00', '18:06:00', 1.0, '8', 'Wing Head', '', 'maha', 201, 'Quater Master', 'sdfghj', '', '', 'decline', '', '2024-06-07 10:36:16'),
(66, 'Nimal', 'Sick Leave', '2024-06-06', '2024-06-07', '17:09:00', '17:09:00', 1.0, '202', 'Research Officer', 'ELECTRICAL AND MECHANICAL', 'suuu', 2, 'dilshi', '', '', '', '', '', '2024-06-07 10:39:41'),
(67, 'Kodithuwakku', 'Sick Leave', '2024-06-06', '2024-06-07', '18:10:00', '19:10:00', 1.0, '201', 'Research Officer', 'IT/GIS', 'siiiii', 2, 'Nimal', 'siiiii', 'approve', '', '', '', '2024-06-07 10:41:01'),
(68, 'asenii', 'Sick Leave', '2024-06-06', '2024-06-07', '19:27:00', '19:27:00', 1.0, '10', 'Deputy Director Gene', '', 'go to clinic', 45, 'A.A.Samara', 'go to clinic', '', '', '', 'decline', '2024-06-07 13:57:58'),
(69, 'Deputy Director General', 'Sick Leave', '2024-06-07', '2024-06-08', '19:36:00', '19:36:00', 1.0, '5623', 'Deputy Director Gene', '', 'go', 257, 'A.A.Samara', '', '', '', '', 'approve', '2024-06-07 14:06:39'),
(70, 'Deputy Director General', 'Sick Leave', '2024-06-04', '2024-06-05', '19:38:00', '19:38:00', 1.0, '5623', 'Deputy Director Gene', '', 'go to maaa', 201, 'A.A.Samara', '', '', '', '', '', '2024-06-07 14:09:07'),
(71, 'Deputy Director General', 'Sick Leave', '2024-06-04', '2024-06-05', '19:38:00', '19:38:00', 1.0, '5623', 'Deputy Director Gene', '', 'go to maaa', 201, 'A.A.Samara', '', '', '', '', 'decline', '2024-06-07 14:09:57'),
(72, 'Nimal', 'Casual Leave', '2024-06-06', '2024-06-07', '20:33:00', '20:33:00', 1.0, '202', 'Research Officer', 'IT/GIS', 'go to gampaha', 10, 'Kodithuwakku', '', 'approve', 'approve', 'approve', 'approve', '2024-06-07 15:03:42'),
(73, 'Nimal', 'Casual Leave', '2024-06-06', '2024-06-07', '20:47:00', '20:47:00', 1.0, '202', 'Research Officer', 'IT/GIS', 'go to badulla', 10, 'Kodithuwakku', '', 'decline', '', '', '', '2024-06-07 15:17:39');

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
  `forcee` varchar(255) NOT NULL,
  `name_in_full` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `temporary_address` varchar(255) NOT NULL,
  `trade` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `birth` date DEFAULT NULL,
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

INSERT INTO `officers` (`id`, `officer_number`, `rank`, `name`, `unit`, `forcee`, `name_in_full`, `permanent_address`, `temporary_address`, `trade`, `position`, `birth`, `district`, `gs_division`, `nearest_police_station`, `wing`, `email`, `username`, `password`) VALUES
(3, '8', 'Colonel', 'Wing Head IT', '8 unit', '', 'Wing Head IT', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'Wing Head', 'Wing Head', NULL, 'PUTTALAM', 'Homagama', 'Homagama', 'IT/GIS', 'Winghead@cdrd.lk', 'WingHead', '$2y$10$lzPMwS6OGSl.KrbQoe.rruCsh5qvDMavQBgiw.lxh6XdRtNyZmDO.'),
(4, '9', 'Lieutenant', 'aseni', '9', '', 'SO1', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'SO1', 'Staff Officer 1', NULL, 'POLONNARUWA', 'Homagama', 'Homagama', 'None', 'so1@cdrd.lk', 'so1', '$2y$10$0KNQQxGL62zt0sobGUC4mezvVh3/6FvHuqJSYT8UKERKs1ek/23GW'),
(7, '10', 'Lieutenant Colonel', 'asenii', '10', '', 'ddg', 'hjmmng', 'hjmngh', 'ddg', 'Deputy Director General', NULL, 'COLOMBO', 'jhjk', 'hnm', 'None', 'ddg@cdrd.lk', 'ddg', '$2y$10$3dOgYd6cPMSN068ySfEWueNLiNoNBGwXU5jG8M8Zs/Krc8b6ugmtO'),
(14, '45', 'Captain', 'Arshani cyber', '5', '', 'Arshani cyber', 'hjmmng', 'hjmngh', 'research officer', 'Research Officer', NULL, 'MONARAGALA', 'jhjk', 'hnm', 'CYBER', 'research1@cdrd.lk', 'ro', '$2y$10$Gxbg0C9If8/rizhhtbxg1uH/ceYuPr5dwTztEGSTNIsqLmxItYPTm'),
(15, '201', 'Lieutenant', 'Kodithuwakku-IT', '10', '', 'D.M.Kodithuwakku-IT', 'homagama', 'homagama', 'research officer', 'Research Officer', NULL, 'MULLAITIVU', 'jhjk', 'hnm', 'IT/GIS', 'kodi@cdrd.lk', 'kodi', '$2y$10$FtG5T3vz4waDjX.cXSmmOuLJSr14F6K.pCFyGo3JEd7q/aT7SkZyu'),
(16, '202', 'Captain', 'Nimal', '25', '', 'nimal rajapaksha', 'homagama', 'homagama', 'research officer', 'Research Officer', NULL, 'MONARAGALA', 'jhjk', 'hnm', 'IT/GIS', 'nimal@cdrd.lk', 'nimal', '$2y$10$fg/Q3qEG4S5zwunR6OIE9uXV2JxFMOnKWdsIYi7ZTJcG2O4U05gyK'),
(17, '204', 'Lieutenant', 'A.A.Samarakoon', '5', '', 'A.A.Samarakoon', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'Director General', 'Director General', NULL, 'NUWARA ELIYA', 'ampara', 'ampara', 'None', 'dg@cdrd.lk', 'dg', '$2y$10$nih7mO7qgHYOku0DaVQPwOZQbQrOHrYb7FPnQCkqK08Yt4YE7RZO.'),
(18, '256', 'Captain', 'A.A.Samara', '5', '', 'A.A.Samara', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'cheif controller', 'Cheif Controller', NULL, 'MATARA', 'ampara', 'ampara', 'None', 'cc@cdrd.lk', 'cc', '$2y$10$BRzPpQ1K3yWD2rwHk/lSpOSwqffaXsNVtj2jGWS8Ol18QLQoVLxu.'),
(19, '345', 'Lieutenant', 'cheif coordinator', '10', '', 'cheif coordinator', 'homagama', 'homagama', 'cheif coordinator', 'Cheif Coordinator', NULL, 'MANNAR', 'jhjk', 'hnm', 'None', 'coordinator@cdrd.lk', 'coordinator', '$2y$10$M.XpLvXmGY8kqZfpxrGRbuKU9v0Sgp9RgwPCLVpJeZo1/NorP7CQC'),
(20, '266', 'Colonel', 'Quater Master', '5', '', 'Quater Master', 'homagama', 'homagama', 'Quater Master', 'Quater Master', NULL, 'COLOMBO', 'jhjk', 'hnm', 'None', 'QuaterMaster@cdrd.lk', 'Quater Master', '$2y$10$HHpXigShRu340gc4r6SZTuZCNJTcn7RESBcatULWr4BHDI3Cevk6y'),
(21, '456', 'Captain', 'Account Officer', '5', '', 'Account Officer', 'homagama', 'homagama', 'Account Officer', 'Account Officer', NULL, 'MATARA', 'jhjk', 'hnm', 'None', 'AccountOfficer@cdrd.lk', 'Account Officer', '$2y$10$E0tpW2B1JThQMwbmsb5Ns.Aq817..YIzFD/bh0wqkPpWalest9/Zm'),
(22, '4555', 'Captain', 'M.R. Pinnawala', 'DF', '', 'M.R. Pinnawala', 'homagama', 'homagama', 'Wing Head', 'Wing Head', NULL, 'MONARAGALA', 'jhjk', 'hnm', 'COMMERCIAL WING', 'pinnawala@cdrd.lk', 'pinnawala', '$2y$10$PxSB8D53WY0a25UWM7iYBOFY6p2OuXYVPJeVGVm5EpiMatf.UbCie'),
(23, '5623', 'Captain', 'Deputy Director General', '4', '', 'Deputy Director General', '21/2,Mullegama,Homagama.', '21/2,Mullegama,Homagama.', 'Deputy Director General', 'Deputy Director General', NULL, 'MATARA', 'ampara', 'ampara', 'None', 'newddg@cdrd.lk', 'Deputy Director General', '$2y$10$CZy7q/7Ork2KB0vidEipnexq50xXTHIqoAAfeNwFkb5tYyFhPtwnS'),
(24, '45622', 'Lieutenant', 'Saman', '5', '', 'Shashini Prawarditha', 'homagama', 'homagama', 'research officer', 'Research Officer', NULL, 'KURUNEGALA', 'jhjk', 'hnm', 'ELECTRICAL AND MECHANICAL', 'shashi@cdrd.lk', 'shashi', '$2y$10$L.PQav2HXkXKd7xovbZZLOY2JmfB7bLfHPlDRrKncHnzt7DkqBPeu'),
(25, '255', 'Captain', 'sudu', '5', 'Army', 'sudu', 'homagama', 'homagama', 'research officer', 'Research Officer', '1992-06-10', 'MATARA', 'jhjk', 'hnm', 'IT/GIS', 'sudu@cdrd.lk', 'sudu', '$2y$10$X6U0OxLWo6xNCmq8X/VlQe7xWkfK6GeGmxHboTrWwHBo6yVLz1yeu');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `leave_applications_officers`
--
ALTER TABLE `leave_applications_officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
