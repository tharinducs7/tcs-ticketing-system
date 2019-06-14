-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2019 at 05:45 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `title_id` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `attachment` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `md_name` text NOT NULL,
  `md_code` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `icon` text,
  `url` text NOT NULL,
  `can_create` varchar(11) NOT NULL DEFAULT '0',
  `can_read` varchar(11) NOT NULL DEFAULT '0',
  `can_update` varchar(11) NOT NULL DEFAULT '0',
  `can_delete` varchar(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `md_name`, `md_code`, `active`, `icon`, `url`, `can_create`, `can_read`, `can_update`, `can_delete`, `created_at`, `updated_at`) VALUES
(2, 'Modules', 'modules', 1, NULL, '/modules/all', 'on', 'on', 'on', 'on', '2019-05-08 11:38:08', '2019-05-03 09:33:26'),
(3, 'User Roles', 'user-roles', 1, NULL, '/user-roles/all', 'on', 'on', 'on', 'on', '2019-05-08 11:38:34', '2019-05-03 09:34:06'),
(5, 'Support Tickets', 'support-tickets', 1, NULL, '/support-tickets/all', 'on', 'on', 'on', '0', '2019-05-08 06:37:46', '2019-05-08 06:37:46'),
(6, 'Users', 'users', 1, NULL, '/users/all', 'on', 'on', 'on', '0', '2019-05-08 10:37:36', '2019-05-08 10:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `reply_by` int(11) DEFAULT NULL,
  `description` text,
  `moved_to` enum('general','technical','finance','') DEFAULT NULL,
  `moved_from` enum('general','technical','finance','') DEFAULT NULL,
  `priority` enum('Normal','Medium','High','') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `ticket_id`, `reply_by`, `description`, `moved_to`, `moved_from`, `priority`, `created_at`, `updated_at`) VALUES
(7, 3, 1, 'WhatsApp is available in over 40 languages and up to 60 on Android. As a general rule, WhatsApp follows the language of your phone. For example, if you change the language of your phone to Spanish, WhatsApp will automatically be in Spanish.', NULL, NULL, NULL, '2019-05-07 21:38:19', '2019-05-07 21:38:19'),
(14, 3, 1, 'Ticket Solved', '', '', '', '2019-05-08 09:53:53', '2019-05-08 09:53:53'),
(17, 13, 3, 'there can be a technical issue. so i\'m forwarding this to technical department.', 'technical', 'general', '', '2019-05-08 11:26:03', '2019-05-08 11:26:03'),
(18, 13, 5, 'Checked with everything. there\'s a outstanding payment to be settled.', 'finance', 'technical', 'High', '2019-05-08 11:34:02', '2019-05-08 11:34:02'),
(19, 13, 4, 'Yes you need to settled the payment in order to connect.', '', '', '', '2019-05-08 11:35:22', '2019-05-08 11:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `client_id` int(11) DEFAULT NULL,
  `type` enum('general','technical','finance','') DEFAULT NULL,
  `priority` enum('Normal','Medium','High','') NOT NULL DEFAULT 'Medium',
  `status` int(11) NOT NULL DEFAULT '0',
  `image` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `client_id`, `type`, `priority`, `status`, `image`, `created_at`, `updated_at`) VALUES
(3, 'How to change the language?', 'I want to change the language to Spanish. How can I do that?', 2, 'technical', 'Medium', 2, 'uploads/images/login.PNG', '2019-05-07 21:37:05', '2019-05-08 09:59:24'),
(13, 'I can\'t connect to the Internet', 'Hi, My connection  number is 456-789-123 and i can\'t connect to the INTERNET.  why is that?', 2, 'finance', 'High', 2, '', '2019-05-08 11:18:06', '2019-05-08 11:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_code`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dumbledore', 'admin@support.com', 'AD001', NULL, 'uploads/profile/dumbledore.jpg', '$2y$10$1cQLjuoCCsZRuNi7D.P.O.K9fkfEUXRg0I3KLjTBTrByS/bV.NeBy', NULL, '2019-05-01 07:34:50', '2019-05-08 11:04:05'),
(2, 'Draco Malfoy', 'user@support.com', 'UR001', NULL, 'uploads/profile/draco.jpg', '$2y$10$3TvKcbO1VoJ5S34cA/ICAOBCKNkHoJ8uskq84roI7jTNtO6zPa2wK', NULL, '2019-05-08 10:59:44', '2019-05-08 10:59:44'),
(3, 'Hermione Granger', 'general@support.com', 'general', NULL, 'uploads/profile/download.jpg', '$2y$10$Lg1GZE8CtlNKILMIv73vuuIdn19/GWcbjLuyiHRtO1acvVmgDGdCO', NULL, '2019-05-08 10:52:04', '2019-05-08 10:53:15'),
(4, 'Ron weasley', 'finance@support.com', 'finance', NULL, 'uploads/profile/ron.jpg', '$2y$10$2sr8aXxe7qKBwSWVOcfq9.3jowg7LBUhK3X.5eVE8wAldYF5B6v72', NULL, '2019-05-08 10:56:43', '2019-05-08 10:56:43'),
(5, 'Harry Potter', 'tech@support.com', 'technical', NULL, 'uploads/profile/harry.jpg', '$2y$10$E0xLOL.WO1qjcZx4Yz3wyO3oUqtuG2.9oofKK/H3J8MvlVMB.aRSi', NULL, '2019-05-05 02:26:55', '2019-05-08 10:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `code` varchar(50) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `code`, `active`, `created_at`, `updated_at`) VALUES
(36, 'Administrator', 'AD001', 1, '2019-05-03 06:38:48', '2019-05-03 06:38:48'),
(37, 'User', 'UR001', 1, '2019-05-03 07:44:09', '2019-05-03 07:44:09'),
(40, 'General Department', 'general', 1, '2019-05-08 10:33:54', '2019-05-08 10:33:54'),
(41, 'Technical Department', 'technical', 1, '2019-05-08 10:34:47', '2019-05-08 10:34:47'),
(42, 'Finance Department', 'finance', 1, '2019-05-08 10:35:14', '2019-05-08 10:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_permissions`
--

CREATE TABLE `user_role_permissions` (
  `id` int(11) NOT NULL,
  `role_code` varchar(50) NOT NULL,
  `module_code` text NOT NULL,
  `is_enable` int(11) NOT NULL DEFAULT '0',
  `can_create` int(11) NOT NULL DEFAULT '0',
  `can_read` int(11) NOT NULL DEFAULT '0',
  `can_update` int(11) NOT NULL DEFAULT '0',
  `can_delete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role_permissions`
--

INSERT INTO `user_role_permissions` (`id`, `role_code`, `module_code`, `is_enable`, `can_create`, `can_read`, `can_update`, `can_delete`, `created_at`, `updated_at`) VALUES
(67, 'UR001', 'modules', 0, 0, 0, 0, 0, '2019-05-08 12:19:07', '2019-05-08 12:19:07'),
(68, 'UR001', 'user-roles', 0, 0, 0, 0, 0, '2019-05-08 12:19:07', '2019-05-08 12:19:07'),
(69, 'UR001', 'support-tickets', 1, 1, 1, 0, 0, '2019-05-08 12:19:07', '2019-05-08 12:19:07'),
(70, 'general', 'modules', 0, 0, 0, 0, 0, '2019-05-08 16:03:54', '2019-05-08 16:03:54'),
(71, 'general', 'user-roles', 0, 0, 0, 0, 0, '2019-05-08 16:03:54', '2019-05-08 16:03:54'),
(72, 'general', 'support-tickets', 1, 0, 1, 1, 0, '2019-05-08 16:03:54', '2019-05-08 16:03:54'),
(73, 'technical', 'modules', 0, 0, 0, 0, 0, '2019-05-08 16:04:47', '2019-05-08 16:04:47'),
(74, 'technical', 'user-roles', 0, 0, 0, 0, 0, '2019-05-08 16:04:47', '2019-05-08 16:04:47'),
(75, 'technical', 'support-tickets', 1, 0, 1, 1, 0, '2019-05-08 16:04:47', '2019-05-08 16:04:47'),
(76, 'finance', 'modules', 0, 0, 0, 0, 0, '2019-05-08 16:05:14', '2019-05-08 16:05:14'),
(77, 'finance', 'user-roles', 0, 0, 0, 0, 0, '2019-05-08 16:05:14', '2019-05-08 16:05:14'),
(78, 'finance', 'support-tickets', 1, 0, 1, 1, 0, '2019-05-08 16:05:14', '2019-05-08 16:05:14'),
(79, 'AD001', 'modules', 1, 1, 1, 1, 0, '2019-05-08 16:07:54', '2019-05-08 16:07:54'),
(80, 'AD001', 'user-roles', 1, 1, 1, 1, 0, '2019-05-08 16:07:54', '2019-05-08 16:07:54'),
(81, 'AD001', 'support-tickets', 1, 1, 1, 1, 0, '2019-05-08 16:07:54', '2019-05-08 16:07:54'),
(82, 'AD001', 'users', 1, 1, 1, 1, 0, '2019-05-08 16:07:54', '2019-05-08 16:07:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `user_role_permissions`
--
ALTER TABLE `user_role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_role_permissions`
--
ALTER TABLE `user_role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
