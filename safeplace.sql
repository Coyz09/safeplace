-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 10:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safeplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barangay_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay_captain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay_contact` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `barangay_name`, `barangay_captain`, `barangay_location`, `latitude`, `longitude`, `barangay_schedule`, `barangay_contact`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Western Bicutan Barangay Hall', 'Brgy. Chairman', 'Barangay Western Bicutan, Sampaguita, Taguig, Metro Manila, Philippines', '14.5095559', '121.0381195', '24/7', '09867869785', '21', '2022-10-31 05:53:59', '2022-11-15 05:59:32'),
(4, 'Upper Bicutan Barangay Hall', 'Chairman', 'Upper Bicutan Barangay Hall, A. Bonifacio Street, Taguig, Metro Manila, Philippines', '14.4969381', '121.0503622', '24/7', '093842234213', '87', '2022-11-15 05:55:13', '2022-11-15 06:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `barangay_reports`
--

CREATE TABLE `barangay_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_medical_director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `hospital_name`, `hospital_type`, `hospital_medical_director`, `hospital_location`, `latitude`, `longitude`, `hospital_schedule`, `hospital_contact`, `created_at`, `updated_at`) VALUES
(3, 'Taguig Pateros Hospital', 'Public', 'Dr. Doctoral', 'Taguig-Pateros District Hospital, East Service Road, Taguig, Metro Manila, Philippines', '14.5108121', '121.0341273', '24/7', '09797334653', '2022-10-31 05:52:58', '2022-11-15 06:32:44'),
(4, 'Recuenco General Hospital', 'Private', 'Recuenco', '68 Sampaloc Ext, Taguig, 1630 Metro Manila, Philippines', '14.5133646', '121.059499', '24/7', '0971231235', '2022-11-15 06:28:46', '2022-11-15 06:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2022_08_09_124026_create_unverified_users_table', 4),
(21, '2022_08_28_102337_create_barangay_reports_table', 4),
(22, '2022_08_28_154741_create_police_station_reports_table', 4),
(23, '2022_08_09_124045_create_verified_users_table', 5),
(24, '2022_08_09_123702_create_police_stations_table', 6),
(26, '2022_08_09_124426_create_hospitals_table', 6),
(27, '2022_08_09_123845_create_barangays_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `police_stations`
--

CREATE TABLE `police_stations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policestation_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policestation_commander` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policestation_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policestation_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policestation_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `police_stations`
--

INSERT INTO `police_stations` (`id`, `policestation_name`, `policestation_commander`, `policestation_location`, `latitude`, `longitude`, `policestation_schedule`, `policestation_contact`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Tenement Police Station', 'PCol. Bosita', 'G24P+Q8 Taguig, Metro Manila, Philippines', '14.5069375', '121.0358125', '24/7', '0967868876', '22', '2022-10-31 05:54:18', '2022-11-09 00:46:36'),
(4, 'Maharlika Station', 'Chief', 'G22X+JVQ Taguig, Metro Manila, Philippines', '14.5015875', '121.0497344', '24/7', '097287387', '75', '2022-11-08 22:26:33', '2022-11-09 00:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `police_station_reports`
--

CREATE TABLE `police_station_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unverified_users`
--

CREATE TABLE `unverified_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_attempt` int(11) DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unverified_users`
--

INSERT INTO `unverified_users` (`id`, `fname`, `mname`, `lname`, `gender`, `birthdate`, `address`, `contact`, `email`, `id_type`, `id_number`, `id_picture`, `status`, `verification_attempt`, `user_id`, `created_at`, `updated_at`) VALUES
(31, 'asdsadas kjkhjfhj', '', '', 'Male', '2022-11-12', 'Makati', '24642524', 'ghjetyer@gmail.com', '', NULL, NULL, 'Rejected', NULL, '47', '2022-11-01 07:40:08', '2022-11-01 07:43:11'),
(36, 'tryrte wrwerew', '', '', 'Male', '2022-11-19', 'Makati', '123123', 'tryrte@gmail.com', '', NULL, NULL, 'Pending', NULL, '58', '2022-11-02 06:47:28', '2022-11-02 06:47:28'),
(38, 'asdasd sdasdasd', '', '', 'Male', '2022-11-12', 'Makati', '123123', 'rarara@gmail.com', '', NULL, NULL, 'Pending', NULL, '60', '2022-11-02 06:55:03', '2022-11-02 06:55:03'),
(39, 'asdasd sdasdasd', '', '', 'Male', '2022-11-26', 'Makati', '123123', 'rarara@gmail.com', '', NULL, NULL, 'Pending', NULL, '61', '2022-11-02 06:55:54', '2022-11-02 06:55:54'),
(45, 'Jaysddfdsfsdon', 'fd', 'Juapa', 'Male', '2022-11-12', 'Taguig', '09298519195', 'Fraaa@gmail.com', '', NULL, NULL, 'Pending', NULL, '73', '2022-11-08 18:48:27', '2022-11-08 18:48:27'),
(53, 'sdasd', 'asdas', 'asdasd', 'Female', '2022-11-23', 'dsadas', '123123', 'dsadsa@gmail.com', '', NULL, NULL, 'Pending', NULL, '84', '2022-11-08 22:50:49', '2022-11-08 22:50:49'),
(55, 'dsad', 'asda', 'asdas', 'Female', '2022-11-10', 'sadsad', '12312', 'dsad@gmail.com', NULL, NULL, NULL, 'Pending', NULL, '86', '2022-11-15 04:51:30', '2022-11-15 04:51:30'),
(56, 'asdssad', 'asdasdas', 'asddasdsa', 'Male', '2022-11-12', 'dsadas', '+639616955725', 'dasdas@gmaul', NULL, NULL, NULL, 'Pending', NULL, '88', '2022-11-24 06:10:28', '2022-11-24 06:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `img`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'superadmin@gmail.com', NULL, '$2y$10$NPkV.hbQ/XtZfQKCmxaaTuPASaG3g6bYlfiSrZwQmZVd9L4pzQMOO', NULL, 'superadmin', '', '2022-08-17 06:16:16', '2022-11-02 01:00:44'),
(3, 'admin admin', 'admin@gmail.com', NULL, '$2y$10$NPkV.hbQ/XtZfQKCmxaaTuPASaG3g6bYlfiSrZwQmZVd9L4pzQMOO', NULL, 'admin', '', '2022-08-17 06:35:43', '2022-11-02 01:01:09'),
(21, 'Western Bicutan Barangay Hall', 'westernbicutan@gmail.com', NULL, '$2y$10$.0apE21/.lWGLCQUDDTP5enZGSF4XnTvM7Kf64RaW9IrXgT2H9xCe', NULL, 'barangay', '', '2022-10-31 05:53:57', '2022-11-15 06:00:47'),
(22, 'FTI Police Station', 'tenementpolicestation@gmail.com', NULL, '$2y$10$m4GBGkRf/cdDPoaqo9..Ru9JGC5H1yXn7MLGbKV7/YhE740hdPh1q', NULL, 'police_station', '', '2022-10-31 05:54:18', '2022-10-31 05:54:18'),
(47, 'asdsadas kjkhjfhj', 'ghjetyer@gmail.com', NULL, '$2y$10$JcB/iTtnjMBfIy9btmraIesUuUUi2OaROZeubDAOQnoL7bYyoNjdu', NULL, 'unverified_user', '', '2022-11-01 07:40:08', '2022-11-01 07:40:08'),
(58, 'tryrte wrwerew', 'tryrte@gmail.com', NULL, '$2y$10$xUC07Sb5.g./yNvNGFcuc.gzMWQDtCXxtOxHxDgeHYS3FIEJy4tqm', NULL, 'unverified_user', 'storage/images/signature.png', '2022-11-02 06:47:28', '2022-11-02 06:47:28'),
(61, 'asdasd sdasdasd', 'rarara@gmail.com', NULL, '$2y$10$vJZKnjPBvQguPRM6ZF7e1eLmuVwFAsV7ZvxKuuAxeydhgJmQsVdRW', NULL, 'unverified_user', 'storage/images/signature.png', '2022-11-02 06:55:54', '2022-11-02 06:55:54'),
(63, 'arturo vertico bradul', 'bradul@gmail.com', NULL, '$2y$10$Mh3hpx2I1eFPvYKWvnEV5OID8uvaKqZUQLEKHT48.8AgEgfr9YZx.', NULL, 'verified_user', 'storage/images/unlockall.jpg', '2022-11-04 05:00:23', '2022-11-21 05:20:17'),
(69, 'Jayson', 'sdasdasdas@gmail.com', NULL, '$2y$10$.hgWU6xgOKcDsiGeuX0NxegpUIHStqIlILqBdgqGmkVcrfh/qZwJa', NULL, 'unverified_user', NULL, '2022-11-08 18:33:22', '2022-11-08 22:34:23'),
(73, 'Jaysddfdsfsdon fd Juapa', 'Fraaa@gmail.com', NULL, '$2y$10$sOU7cJ6laeWLvfoFaWGYMeSz/5qzPh8tILgPwCdqQxKOWArSUN68S', NULL, 'unverified_user', NULL, '2022-11-08 18:48:27', '2022-11-08 18:48:27'),
(75, 'Mharlika Station', 'maharlika@gmail.com', NULL, '$2y$10$IW3bjCtHkjRNbQW1O2zdo.HrBUeaSZ01ZbIngzlY4na.MrgvjJ.Ky', NULL, 'police_station', NULL, '2022-11-08 22:26:33', '2022-11-08 22:26:33'),
(84, 'sdasd asdas asdasd', 'dsadsa@gmail.com', NULL, '$2y$10$PdWeIvbGqVegwwRv/D39BuI3E7kETk3AoH9xF5Ymu.6gh861cwify', NULL, 'unverified_user', 'storage/images/119026547_319329019392651_175697884311729412_n.jpg', '2022-11-08 22:50:49', '2022-11-08 22:50:49'),
(86, 'dsad asda asdas', 'dsad@gmail.com', NULL, '$2y$10$R.Mly8CTUwEMopgJrt0jZeliCvUOxHaf1E/Ol83BDZHfKovYZIMZ.', NULL, 'unverified_user', 'storage/images/signature.png', '2022-11-15 04:51:30', '2022-11-15 04:51:30'),
(87, 'Upper Bicutan Barangay Hall', 'upperbicutan@gmail.com', NULL, '$2y$10$2jIZ3M4Z1aoSZr3qInOgCOhBAX9wAN2CnkkTgw78Nvscy232SQ8Ga', NULL, 'barangay', NULL, '2022-11-15 05:55:11', '2022-11-15 05:55:11'),
(88, 'asdssad asdasdas asddasdsa', 'dasdas@gmaul', NULL, '$2y$10$SHK6ebUuzPUO/u3zzOBcaemfZKlsunwvQGD/3TqnqYSkIiNDXO5PS', NULL, 'unverified_user', 'storage/images/SW.jpg', '2022-11-24 06:10:28', '2022-11-24 06:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `verified_users`
--

CREATE TABLE `verified_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verified_users`
--

INSERT INTO `verified_users` (`id`, `fname`, `mname`, `lname`, `gender`, `birthdate`, `address`, `contact`, `email`, `user_id`, `created_at`, `updated_at`) VALUES
(29, 'arturo', 'vertico', 'bradul', 'Male', '2022-11-18', 'Taguig', '09886968', 'bradul@gmail.com', '63', '2022-11-04 05:06:46', '2022-11-04 05:06:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangay_reports`
--
ALTER TABLE `barangay_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `police_stations`
--
ALTER TABLE `police_stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `police_station_reports`
--
ALTER TABLE `police_station_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unverified_users`
--
ALTER TABLE `unverified_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verified_users`
--
ALTER TABLE `verified_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barangay_reports`
--
ALTER TABLE `barangay_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `police_stations`
--
ALTER TABLE `police_stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `police_station_reports`
--
ALTER TABLE `police_station_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unverified_users`
--
ALTER TABLE `unverified_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `verified_users`
--
ALTER TABLE `verified_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
