-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 11:31 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `status` varchar(11) DEFAULT 'Active',
  `faculty_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `title`, `description`, `file`, `status`, `faculty_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'New Acitivity', 'Nulla quis lorem ut libero malesuada feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.', '1615776784_0ff6bc7b435e65ca9312.pdf', 'Active', 7, '2021-03-15 02:53:04', NULL, '2021-03-14 21:55:03'),
(13, 'New Acitivity 2', 'Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', '1615777094_a8c2acca49eb50788ecf.pdf', 'Active', 7, '2021-03-15 02:54:12', '2021-03-14 21:58:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_group`
--

CREATE TABLE `activity_group` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `start_date` varchar(200) DEFAULT NULL,
  `deadline` varchar(100) DEFAULT NULL,
  `status` varchar(11) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_group`
--

INSERT INTO `activity_group` (`id`, `activity_id`, `section_id`, `faculty_id`, `start_date`, `deadline`, `status`) VALUES
(9, 13, 14, 7, '03/29/2021', '04/10/2021', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `activity_status`
--

CREATE TABLE `activity_status` (
  `activity_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_status`
--

INSERT INTO `activity_status` (`activity_id`, `student_id`, `status`) VALUES
(7, 17, 'done');

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_activation_attempts`
--

INSERT INTO `auth_activation_attempts` (`id`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'ae93740556ee50f7210be20fdf27e2aa', '2021-01-17 03:36:30'),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '46cace716b86b9c5eb4168af020bb2d7', '2021-01-18 06:39:39'),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '46cace716b86b9c5eb4168af020bb2d7', '2021-01-18 06:41:32'),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '46cace716b86b9c5eb4168af020bb2d7', '2021-01-18 06:41:58'),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'd0b3726072a16cdfc98acc364f27e160', '2021-01-18 07:54:49'),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'd0b3726072a16cdfc98acc364f27e160', '2021-01-18 07:55:02'),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '3f4d61d63330bc117b2d0d7e93687177', '2021-01-18 07:56:39'),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '3f4d61d63330bc117b2d0d7e93687177', '2021-01-18 07:56:48'),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '3f4d61d63330bc117b2d0d7e93687177', '2021-01-18 07:56:56'),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.152 Safari/537.36', '26f1359c0cc0735f34fbeb5ba09c2be6', '2021-02-07 07:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Superadmin'),
(2, 'staff', 'staffing user');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'cajanr02@gmail.com', 1, '2021-01-17 03:36:36', 1),
(2, '::1', 'cajan@gmail.com', NULL, '2021-01-17 04:17:54', 0),
(3, '::1', 'cajan@gmail.com', 2, '2021-01-17 04:18:08', 1),
(4, '::1', 'cajanr02@gmail.com', 1, '2021-01-17 04:27:29', 1),
(5, '::1', 'cajanr02@gmail.com', 1, '2021-01-17 04:28:30', 1),
(6, '::1', 'cajanr02@gmail.com', 1, '2021-01-17 04:31:10', 1),
(7, '::1', 'cajanr02@gmail.com', 1, '2021-01-17 04:33:05', 1),
(8, '::1', 'cajanr02@gmail.com', 1, '2021-01-17 04:44:42', 1),
(9, '::1', 'cajanr02@gmail.com', 1, '2021-01-18 06:04:09', 1),
(10, '::1', 'ronil.cajan@gmail.com', 6, '2021-01-18 06:42:18', 1),
(11, '::1', 'cajanr02@gmail.com', 1, '2021-01-18 07:12:01', 1),
(12, '::1', 'cajanr02@gmail.com', 1, '2021-01-18 07:19:14', 1),
(13, '::1', 'cajanr02@gmail.com', 1, '2021-01-18 07:55:16', 1),
(14, '::1', 'cajanr02@gmail.com', 1, '2021-01-18 07:57:09', 1),
(15, '::1', 'cajanr02@gmail.com', 1, '2021-01-19 04:36:05', 1),
(16, '::1', 'cajanr02@gmail.com', NULL, '2021-01-20 04:29:17', 0),
(17, '::1', 'cajanr02@gmail.com', 1, '2021-01-20 04:29:25', 1),
(18, '::1', 'cajanr02@gmail.com', 1, '2021-01-20 04:44:23', 1),
(19, '::1', 'cajanr02@gmail.com', 1, '2021-01-24 22:53:15', 1),
(20, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 01:23:55', 1),
(21, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 01:25:34', 1),
(22, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 01:29:03', 1),
(23, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 01:40:50', 1),
(24, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 02:02:27', 1),
(25, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 02:13:33', 1),
(26, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 02:51:56', 1),
(27, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 03:03:53', 1),
(28, '::1', 'cajanr02@gmail.com', 1, '2021-01-26 03:05:47', 1),
(29, '::1', 'cajanr02@gmail.com', NULL, '2021-01-29 00:27:12', 0),
(30, '::1', 'cajanr02@gmail.com', 1, '2021-01-29 00:27:20', 1),
(31, '::1', 'cajanr02@gmail.com', 1, '2021-01-29 01:47:49', 1),
(32, '::1', 'cajanr02@gmail.com', 1, '2021-01-31 03:09:30', 1),
(33, '::1', 'cajanr02@gmail.com', 1, '2021-02-01 00:04:48', 1),
(34, '::1', 'cajanr02@gmail.com', 1, '2021-02-01 00:06:46', 1),
(35, '::1', 'cajanr02@gmail.com', 1, '2021-02-01 02:17:54', 1),
(36, '::1', 'cajanr02@gmail.com', NULL, '2021-02-01 02:46:14', 0),
(37, '::1', 'cajanr02@gmail.com', 1, '2021-02-01 02:46:19', 1),
(38, '::1', 'cajanr02@gmail.com', 1, '2021-02-05 01:33:53', 1),
(39, '::1', 'cajanr02@gmail.com', 1, '2021-02-05 06:12:59', 1),
(40, '::1', 'cajanr02@gmail.com', 1, '2021-02-05 19:59:41', 1),
(41, '127.0.0.1', 'cajanr02@gmail.com', 1, '2021-02-05 20:16:30', 1),
(42, '127.0.0.1', 'ronil.cajan@gmail.com', 6, '2021-02-05 20:25:30', 1),
(43, '::1', 'cajanr02@gmail.com', 1, '2021-02-07 07:07:39', 1),
(44, '::1', 'cajanr02@gmail.com', 1, '2021-02-07 07:16:35', 1),
(45, '::1', 'omgsystem00@gmail.com', 9, '2021-02-07 07:18:45', 1),
(46, '::1', 'omgsystem00@gmail.com', 9, '2021-02-07 07:27:31', 1),
(47, '::1', 'cajanr02@gmail.com', 1, '2021-03-14 19:39:53', 1),
(48, '::1', 'cajanr02@gmail.com', 1, '2021-03-14 19:40:29', 1),
(49, '::1', 'cajanr02@gmail.com', 1, '2021-03-17 19:57:12', 1),
(50, '::1', 'cajanr02@gmail.com', 1, '2021-03-17 19:58:36', 1),
(51, '::1', 'cajanr02@gmail.com', 1, '2021-03-17 19:59:38', 1),
(52, '::1', 'cajanr02@gmail.com', 1, '2021-03-17 21:44:42', 1),
(53, '::1', 'cajanr02@gmail.com', 1, '2021-03-17 21:48:20', 1),
(54, '::1', 'cajanr02@gmail.com', 1, '2021-03-17 22:07:25', 1),
(55, '::1', 'cajanr02@gmail.com', 1, '2021-04-06 06:38:25', 1),
(56, '::1', 'cajanr02@gmail.com', 1, '2021-04-06 06:39:25', 1),
(57, '::1', 'cajanr02@gmail.com', 1, '2021-04-06 06:48:48', 1),
(58, '::1', 'cajanr02@gmail.com', 1, '2021-04-07 03:44:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_reset_attempts`
--

INSERT INTO `auth_reset_attempts` (`id`, `email`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, 'cajanr02@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', '990ef4286b78086b55a1a91183b02404', '2021-01-18 07:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`id`, `student_id`, `faculty_id`, `title`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 18, 7, 'Point of Sale on PHP', 'ffhfhggfhhfg', 'Active', '2021-03-15 02:58:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `done_task`
--

CREATE TABLE `done_task` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT '',
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birthdate` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `street` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `postal` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `img` varchar(100) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `email`, `firstname`, `lastname`, `gender`, `birthdate`, `phone`, `street`, `city`, `province`, `postal`, `status`, `img`, `cover`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'cajanr02@gmail.com', 'Ronil', 'Cajan', 'M', '02/15/1994', '19512659595', '310 W Las Colinas Blvd', 'Irving', 'Tx', 75039, 1, NULL, NULL, '2021-03-15 02:10:52', '2021-03-17 21:44:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_section`
--

CREATE TABLE `faculty_section` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `group_section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_section`
--

INSERT INTO `faculty_section` (`id`, `faculty_id`, `group_section_id`) VALUES
(45, 7, 19);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `f_phone` varchar(50) DEFAULT NULL,
  `f_email` varchar(100) DEFAULT NULL,
  `f_address` text DEFAULT NULL,
  `m_name` varchar(50) DEFAULT NULL,
  `m_phone` varchar(50) DEFAULT NULL,
  `m_email` varchar(100) DEFAULT NULL,
  `m_address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `student_id`, `f_name`, `f_phone`, `f_email`, `f_address`, `m_name`, `m_phone`, `m_email`, `m_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 18, 'Ron James', '19512659595', 'cajanr02@gmail.com', '310 W Las Colinas Blvd', 'Jane Nond', '2145322292', 'cajanr02@gmail.com', '123 Road Street', '2021-03-15 02:00:51', '2021-03-17 21:48:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_1` varchar(20) DEFAULT NULL,
  `grade_2` varchar(20) DEFAULT NULL,
  `grade_3` varchar(20) DEFAULT NULL,
  `grade_4` varchar(20) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `subject_id`, `grade_1`, `grade_2`, `grade_3`, `grade_4`, `remarks`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, '18', 7, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-06 12:48:58', NULL, NULL),
(7, '18', 8, '20', '80', '', '', '', NULL, '2021-04-06 12:48:58', NULL, NULL),
(8, '18', 9, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-06 12:48:58', NULL, NULL),
(9, '18', 10, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-06 12:48:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_section`
--

CREATE TABLE `group_section` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_section`
--

INSERT INTO `group_section` (`id`, `section_id`, `subject_id`) VALUES
(18, 14, 7),
(19, 14, 8),
(20, 14, 9),
(21, 14, 10);

-- --------------------------------------------------------

--
-- Table structure for table `login_portal`
--

CREATE TABLE `login_portal` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_portal`
--

INSERT INTO `login_portal` (`id`, `email`, `id_number`, `password`, `user_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, NULL, '0392FDSF ', '$2y$10$zXNCOKX7B7LboBNyYzTXB.BsiJMJzD7vrFsYWd5kHtdiXoCXo//TC', 'student', '2021-03-15 02:00:51', NULL, NULL),
(20, 'cajanr02@gmail.com', NULL, '$2y$10$yJoKotuBlWkRirEG5mSvAO1MuGexs0RMiU44nRO3pTY/riMj2RA.m', 'faculty', '2021-03-15 02:10:52', NULL, NULL),
(21, NULL, '903212193', '$2y$10$sSTgYdjVDnGmCOf8H2eFAegO3.5jJxCfycfNtaCHY1VzYxUjY0ft6', 'student', '2021-03-18 03:12:04', NULL, NULL),
(22, NULL, 'ID03294932', '$2y$10$ekOXpeajOXc3za31taD6jOjUzEaS5UiIgI4lkw672h/2wzc1nll2y', 'student', '2021-04-06 12:47:42', NULL, NULL),
(23, NULL, 'ID#@$#@#432', '$2y$10$10u72efwQHUAswgmSh6uMexgEOzeibVBGicc2.9CwiDaKw7jX5cTa', 'student', '2021-04-06 12:48:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1610876056, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `section_name` varchar(50) DEFAULT NULL,
  `section_year` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `school_year` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `section_name`, `section_year`, `description`, `school_year`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'Diamond', 7, 'Diamoand for all', '2020-2021', 1, '2021-03-15 01:44:39', '2021-03-14 20:49:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_ID` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `birthday` varchar(30) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `postal` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT '1',
  `img` varchar(100) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_ID`, `firstname`, `lastname`, `email`, `gender`, `birthday`, `phone`, `street`, `city`, `province`, `postal`, `status`, `img`, `cover`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, '0392FDSF ', 'Ronil', 'Cajan', 'cajanr02@gmail.com', 'M', '03/01/2021', '19512659595', '310 W Las Colinas Blvd', 'Irving', 'Tx', '75039', '1', NULL, NULL, '2021-03-15 02:00:51', '2021-03-17 21:48:42', NULL),
(19, '903212193', 'Jon', 'Jones', 'ssantostx@gmail.com', 'M', '03/23/2021', '9512659595', 'PH', 'Looc', 'Tx', '75039', '1', NULL, NULL, '2021-03-18 03:12:03', '2021-03-17 22:14:34', NULL),
(20, 'ID03294932', 'Ronil', 'Cajan', 'cajanfsdfsdfr02@gmail.com', 'M', '04/20/2021', '19512659595', '310 W Las Colinas Blvd', 'Irving', 'Tx', '75039', '1', NULL, NULL, '2021-04-06 12:47:42', NULL, NULL),
(21, 'ID#@$#@#432', 'Ronil', 'Cajan', 'cajafdsfsdfnr02@gmail.comde', 'M', '01/04/2021', '19512659595', '310 W Las Colinas Blvd', 'Irving', 'Tx', '75039', '1', NULL, NULL, '2021-04-06 12:48:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_section`
--

CREATE TABLE `student_section` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_section`
--

INSERT INTO `student_section` (`id`, `student_id`, `section_id`, `created_at`, `update_at`, `deleted_at`) VALUES
(17, 18, 14, '2021-03-15 02:00:51', NULL, NULL),
(18, 19, 14, '2021-03-18 03:12:04', NULL, NULL),
(19, 20, 14, '2021-04-06 12:47:42', NULL, NULL),
(20, 21, 14, '2021-04-06 12:48:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Fil-101', 'Filipino - 2', 'Para sa Filipino', 1, '2021-03-15 01:24:30', NULL, NULL),
(8, 'Eng-101', 'English 2', 'English for all', 1, '2021-03-15 01:24:45', NULL, NULL),
(9, 'Sci-101', 'Science - 2', 'Science for all', 1, '2021-03-15 01:25:02', NULL, NULL),
(10, 'Math-101', 'Mathematics', 'Math for all', 1, '2021-03-15 01:44:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'cajanr02@gmail.com', 'admin', '$2y$10$B2QcqBxY8ksW5AW0V7mTwO0w6/7NTuwXvDRca6oWENjWe8W.Ct7KW', 'd22f41a2eac7b3f0d54c566866955803', '2021-01-18 07:19:00', '2021-02-07 05:51:52', NULL, NULL, NULL, 1, 0, '2021-01-17 03:35:57', '2021-03-17 20:08:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `name`, `phone`, `address`, `bio`, `img`, `cover`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 1, 'Name', 'Phone', 'Location...', 'Write something about yourself...', '1616029684_0def95e75046e517a4c5.jpg', '1616029689_406a2d008edac7fe645c.jpg', '2021-02-07 13:17:43', '2021-03-17 20:08:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_group`
--
ALTER TABLE `activity_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `done_task`
--
ALTER TABLE `done_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `faculty_section`
--
ALTER TABLE `faculty_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_section_ibfk_1` (`faculty_id`),
  ADD KEY `group_section_id` (`group_section_id`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_section`
--
ALTER TABLE `group_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `login_portal`
--
ALTER TABLE `login_portal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_ID` (`student_ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_section`
--
ALTER TABLE `student_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `activity_group`
--
ALTER TABLE `activity_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `done_task`
--
ALTER TABLE `done_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty_section`
--
ALTER TABLE `faculty_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `group_section`
--
ALTER TABLE `group_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `login_portal`
--
ALTER TABLE `login_portal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `student_section`
--
ALTER TABLE `student_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faculty_section`
--
ALTER TABLE `faculty_section`
  ADD CONSTRAINT `faculty_section_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_section_ibfk_2` FOREIGN KEY (`group_section_id`) REFERENCES `group_section` (`id`);

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `family_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_section`
--
ALTER TABLE `group_section`
  ADD CONSTRAINT `group_section_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `group_section_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `login_portal`
--
ALTER TABLE `login_portal`
  ADD CONSTRAINT `login_portal_ibfk_1` FOREIGN KEY (`email`) REFERENCES `faculty` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `login_portal_ibfk_2` FOREIGN KEY (`id_number`) REFERENCES `students` (`student_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
