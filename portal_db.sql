-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 07:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `stop_time` timestamp NULL DEFAULT NULL,
  `notes` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `start_time`, `stop_time`, `notes`, `description`, `created_at`) VALUES
(1, 2, '2025-02-05 12:00:00', '2025-02-06 12:01:00', 'nothing ', 'just testing', '2025-02-05 12:03:59'),
(2, 2, '2021-04-05 17:24:00', '1979-06-16 22:30:00', 'Eu ex laudantium op', 'Suscipit non quos as', '2025-02-05 12:04:10'),
(3, 2, '2021-04-05 17:24:00', '1979-06-16 22:30:00', 'Eu ex laudantium op', 'Suscipit non quos as', '2025-02-05 12:26:22'),
(4, 2, '2021-04-05 17:24:00', '1979-06-16 22:30:00', 'Eu ex laudantium op', 'Suscipit non quos as', '2025-02-05 12:28:48'),
(5, 2, '2021-04-05 17:24:00', '1979-06-16 22:30:00', 'Eu ex laudantium op', 'Suscipit non quos as', '2025-02-05 14:26:58'),
(6, 2, '2025-02-07 06:21:00', '2025-02-15 06:21:00', 'testing 2nd time', 'testing 2nd time', '2025-02-06 06:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `last_password_change` timestamp NULL DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `last_login`, `last_password_change`, `role`, `created_at`) VALUES
(1, 'Admin', 'User', 'admin@test.com', '1234567890', '$2y$10$H3AM4FK3kd2cGRaKAuvyDeUze..GpxTREKULZEec1EcWxvTk.q9Qq', '2025-02-06 05:58:45', '2025-02-06 05:58:58', 'admin', '2025-02-05 11:37:22'),
(2, 'Hasad', 'England', 'dowuby@mailinator.com', '+1 (893) 869-63', '$2y$10$OFuVRton.ZEiV7WEdtpLA.OleO4U3qf9yeXK8RJTbHrY7R1r8BIgS', '2025-02-06 06:09:30', '2025-02-06 05:59:56', 'user', '2025-02-05 11:46:18'),
(3, 'Kimberly', 'Mayer', 'tiby@mailinator.com', '+1 (442) 879-25', '$2y$10$qMYAITZEWcUW3i4eEQNk6.pdO0POt7sBoeJMygZtmqqwQfKx.rjEu', NULL, '2025-02-06 06:03:24', 'user', '2025-02-06 06:03:24'),
(4, 'Erasmus', 'Finley', 'supycyzan@mailinator.com', '+1 (105) 233-20', '$2y$10$49iEooEt5Pv/MOIIUokxb.Rs0wgXOAWFiSol51ZhhEVozqlerLPyu', '2025-02-06 06:26:45', '2025-02-06 06:26:19', 'user', '2025-02-06 06:24:47'),
(5, 'Damian', 'Mcgowan', 'kityjyb@mailinator.com', '+1 (345) 437-90', '$2y$10$pXaK2zx3N1lZ1u8CzCu09OKvShjqQnqFISf7WDQfLA.ruBcldMkXO', '2025-02-06 06:30:03', '2025-02-06 06:35:37', 'user', '2025-02-06 06:29:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
