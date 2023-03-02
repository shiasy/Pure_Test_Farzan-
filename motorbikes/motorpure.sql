-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 01:45 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motorpure`
--

-- --------------------------------------------------------

--
-- Table structure for table `msh_motors`
--

CREATE TABLE `msh_motors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company` enum('هیوندا','کاوازاکی','سوزوکی','یاما') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kind` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` double NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `msh_motors`
--

INSERT INTO `msh_motors` (`id`, `user_id`, `company`, `kind`, `color`, `weight`, `price`, `image`, `created_at`, `updated_at`) VALUES
(101, 14, 'یاما', 'Cs560', 'قرمز', 1350, 650000000, 'includes/uploads/16777546898042638627.jpg', 1677754511, 1677754689),
(102, 14, 'کاوازاکی', 'K8000', 'زرد', 650, 150000000, 'includes/uploads/16777586603961622196.jpg', 1677758660, 1677758660);

-- --------------------------------------------------------

--
-- Table structure for table `msh_users`
--

CREATE TABLE `msh_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(510) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `msh_users`
--

INSERT INTO `msh_users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(14, 'محمد شیاسی', 'admin@admin.com', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.ImFkbWluIg.j5F9nqsvAE-i5Yp7jmFBGKBQfsHSx--32FTTDvQE_Gg ', 1677752178, 1677752178),
(16, 'test2', 'test@test.com', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.InRlc3Qi.QTMYTneoXUF88mEiosfHAS0GTUXAKu9QPKzfsCV5iS8', 1677752341, 1677752702);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msh_motors`
--
ALTER TABLE `msh_motors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motors_user_id_foreign` (`user_id`);

--
-- Indexes for table `msh_users`
--
ALTER TABLE `msh_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msh_motors`
--
ALTER TABLE `msh_motors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `msh_users`
--
ALTER TABLE `msh_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `msh_motors`
--
ALTER TABLE `msh_motors`
  ADD CONSTRAINT `motors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `msh_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
