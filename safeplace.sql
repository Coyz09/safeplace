-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2023 at 06:42 AM
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
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `barangay_name`, `barangay_captain`, `barangay_location`, `latitude`, `longitude`, `barangay_schedule`, `barangay_contact`, `img`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Western Bicutan Barangay Hall', 'Brgy. Chairman', 'Barangay Western Bicutan, Sampaguita, Taguig, Metro Manila, Philippines', '14.5095559', '121.0381195', '24/7', '09867869785', 'storage/images/1670563899.jpg', '21', '2022-10-31 05:53:59', '2022-12-08 21:31:41'),
(4, 'Upper Bicutan Barangay Hall', 'Chairman', 'Upper Bicutan Barangay Hall, A. Bonifacio Street, Taguig, Metro Manila, Philippines', '14.4969381', '121.0503622', '24/7', '093842234213', 'storage/images/1670563257.jpg', '87', '2022-11-15 05:55:13', '2022-12-08 21:20:57'),
(6, 'Pinagsama Barangay Hall', 'Sama', 'Pinagsama Brgy. Hall, Taguig, Metro Manila, Philippines', '14.5230383', '121.0555691', '24/7', '07687606856', 'storage/images/1670509451.jpg', '101', '2022-12-08 05:35:18', '2022-12-08 06:24:11'),
(7, 'Fort Bonifacio Barangay Hall', 'Bonifacio', 'Fort Bonifacio Barangay Hall, Lawton Avenue, Taguig, Metro Manila, Philippines', '14.5256223', '121.0268444', '24/7', '07687606856', 'storage/images/1670508908.jpg', '102', '2022-12-08 06:01:03', '2022-12-08 06:15:08');

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
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `hospital_name`, `hospital_type`, `hospital_medical_director`, `hospital_location`, `latitude`, `longitude`, `hospital_schedule`, `hospital_contact`, `img`, `created_at`, `updated_at`) VALUES
(3, 'Taguig Pateros Hospital', 'Public', 'Dr. Doctoral', 'Taguig-Pateros District Hospital, East Service Road, Taguig, Metro Manila, Philippines', '14.5108121', '121.0341273', '24/7', '09797334653', 'storage/images/1670595584.jpg', '2022-10-31 05:52:58', '2022-12-09 06:19:44'),
(4, 'Recuenco General Hospital', 'Private', 'Recuenco', '68 Sampaloc Ext, Taguig, 1630 Metro Manila, Philippines', '14.5133646', '121.059499', '24/7', '0971231235', NULL, '2022-11-15 06:28:46', '2022-11-15 06:28:46'),
(5, 'osmak', 'Public', 'ospital direct', 'Ospital ng Makati, Sampaguita Street, Makati, Metro Manila, Philippines', '14.5465028', '121.0617574', '24/7', '095262362652', 'storage/images/1670595629.jpg', '2022-12-09 06:20:29', '2022-12-09 06:20:29');

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
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `police_stations`
--

INSERT INTO `police_stations` (`id`, `policestation_name`, `policestation_commander`, `policestation_location`, `latitude`, `longitude`, `policestation_schedule`, `policestation_contact`, `img`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Tenement Police Station', 'PCol. Bosita', 'G24P+Q8 Taguig, Metro Manila, Philippines', '14.5069375', '121.0358125', '24/7', '0967868876', 'storage/images/1670587180.jpg', '22', '2022-10-31 05:54:18', '2022-12-09 03:59:40'),
(4, 'Maharlika Station', 'Chief', 'G22X+JVQ Taguig, Metro Manila, Philippines', '14.5015875', '121.0497344', '24/7', '097287387', 'storage/images/1670587510.jpg', '75', '2022-11-08 22:26:33', '2022-12-09 04:05:10'),
(5, 'BGC Police', 'Bonifacio', 'BGC Police Community Precinct, 28th Street Corner 7th Avenue, Taguig, Metro Manila, Philippines', '14.548775', '121.0486593', '24/7', '0984821412', 'storage/images/1670587400.jpg', '103', '2022-12-09 04:03:22', '2022-12-09 04:03:22');

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
  `id_picture_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_picture_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `face_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_attempt` int(11) DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unverified_users`
--

INSERT INTO `unverified_users` (`id`, `fname`, `mname`, `lname`, `gender`, `birthdate`, `address`, `contact`, `email`, `id_picture_front`, `id_picture_back`, `id_type`, `id_number`, `face_img`, `status`, `verification_attempt`, `user_id`, `created_at`, `updated_at`) VALUES
(31, 'asdsadas kjkhjfhj', '', '', 'Male', '2022-11-12', 'Makati', '24642524', 'ghjetyer@gmail.com', NULL, NULL, '', NULL, NULL, 'Rejected', NULL, '47', '2022-11-01 07:40:08', '2022-11-01 07:43:11'),
(36, 'tryrte wrwerew', '', '', 'Male', '2022-11-19', 'Makati', '123123', 'tryrte@gmail.com', NULL, NULL, '', NULL, NULL, 'Pending', NULL, '58', '2022-11-02 06:47:28', '2022-11-02 06:47:28'),
(38, 'asdasd sdasdasd', '', '', 'Male', '2022-11-12', 'Makati', '123123', 'rarara@gmail.com', NULL, NULL, '', NULL, NULL, 'Pending', NULL, '60', '2022-11-02 06:55:03', '2022-11-02 06:55:03'),
(39, 'asdasd sdasdasd', '', '', 'Male', '2022-11-26', 'Makati', '123123', 'rarara@gmail.com', NULL, NULL, '', NULL, NULL, 'Pending', NULL, '61', '2022-11-02 06:55:54', '2022-11-02 06:55:54'),
(45, 'Jaysddfdsfsdon', 'fd', 'Juapa', 'Male', '2022-11-12', 'Taguig', '09298519195', 'Fraaa@gmail.com', NULL, NULL, '', NULL, NULL, 'Pending', NULL, '73', '2022-11-08 18:48:27', '2022-11-08 18:48:27'),
(53, 'sdasd', 'asdas', 'asdasd', 'Female', '2022-11-23', 'dsadas', '123123', 'dsadsa@gmail.com', NULL, NULL, '', NULL, NULL, 'Pending', NULL, '84', '2022-11-08 22:50:49', '2022-11-08 22:50:49'),
(55, 'dsad', 'asda', 'asdas', 'Female', '2022-11-10', 'sadsad', '12312', 'dsad@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, '86', '2022-11-15 04:51:30', '2022-11-15 04:51:30'),
(56, 'asdssad', 'asdasdas', 'asddasdsa', 'Male', '2022-11-12', 'dsadas', '+639616955725', 'dasdas@gmaul', NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, '88', '2022-11-24 06:10:28', '2022-11-24 06:10:28');

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
(21, 'Western Bicutan Barangay Hall', 'westernbicutan@gmail.com', NULL, '$2y$10$29XHVbRyT.KhNlU2XJRkZ.4hKCUoSDA4qvNBETkz.hCDmr5MG9NAi', NULL, 'barangay', 'storage/images/1670563899.jpg', '2022-10-31 05:53:57', '2022-12-08 04:49:01'),
(22, 'Tenement Police Station', 'tenementpolicestation@gmail.com', NULL, '$2y$10$L5MxGn7TP13E18jk7QoC6u5yhxb272UUuUdgFnzpf1EzYqS4A0o7K', NULL, 'police_station', 'storage/images/1670587180.jpg', '2022-10-31 05:54:18', '2022-10-31 05:54:18'),
(47, 'asdsadas kjkhjfhj', 'ghjetyer@gmail.com', NULL, '$2y$10$JcB/iTtnjMBfIy9btmraIesUuUUi2OaROZeubDAOQnoL7bYyoNjdu', NULL, 'unverified_user', '', '2022-11-01 07:40:08', '2022-11-01 07:40:08'),
(58, 'tryrte wrwerew', 'tryrte@gmail.com', NULL, '$2y$10$xUC07Sb5.g./yNvNGFcuc.gzMWQDtCXxtOxHxDgeHYS3FIEJy4tqm', NULL, 'unverified_user', 'storage/images/signature.png', '2022-11-02 06:47:28', '2022-11-02 06:47:28'),
(61, 'asdasd sdasdasd', 'rarara@gmail.com', NULL, '$2y$10$vJZKnjPBvQguPRM6ZF7e1eLmuVwFAsV7ZvxKuuAxeydhgJmQsVdRW', NULL, 'unverified_user', 'storage/images/signature.png', '2022-11-02 06:55:54', '2022-11-02 06:55:54'),
(63, 'arturo vertico bradul', 'bradul@gmail.com', NULL, '$2y$10$Mh3hpx2I1eFPvYKWvnEV5OID8uvaKqZUQLEKHT48.8AgEgfr9YZx.', NULL, 'verified_user', 'storage/images/unlockall.jpg', '2022-11-04 05:00:23', '2022-11-21 05:20:17'),
(69, 'Jayson', 'sdasdasdas@gmail.com', NULL, '$2y$10$.hgWU6xgOKcDsiGeuX0NxegpUIHStqIlILqBdgqGmkVcrfh/qZwJa', NULL, 'unverified_user', NULL, '2022-11-08 18:33:22', '2022-11-08 22:34:23'),
(73, 'Jaysddfdsfsdon fd Juapa', 'Fraaa@gmail.com', NULL, '$2y$10$sOU7cJ6laeWLvfoFaWGYMeSz/5qzPh8tILgPwCdqQxKOWArSUN68S', NULL, 'unverified_user', NULL, '2022-11-08 18:48:27', '2022-11-08 18:48:27'),
(75, 'Maharlika Station', 'maharlika@gmail.com', NULL, '$2y$10$fsHAK.3MTzaG5amPtDGUZuuBcaEfliux87hJjvLmsqKIwUiBYVy12', NULL, 'police_station', 'storage/images/1670587510.jpg', '2022-11-08 22:26:33', '2022-11-08 22:26:33'),
(84, 'sdasd asdas asdasd', 'dsadsa@gmail.com', NULL, '$2y$10$PdWeIvbGqVegwwRv/D39BuI3E7kETk3AoH9xF5Ymu.6gh861cwify', NULL, 'unverified_user', 'storage/images/119026547_319329019392651_175697884311729412_n.jpg', '2022-11-08 22:50:49', '2022-11-08 22:50:49'),
(86, 'dsad asda asdas', 'dsad@gmail.com', NULL, '$2y$10$R.Mly8CTUwEMopgJrt0jZeliCvUOxHaf1E/Ol83BDZHfKovYZIMZ.', NULL, 'unverified_user', 'storage/images/signature.png', '2022-11-15 04:51:30', '2022-11-15 04:51:30'),
(87, 'Upper Bicutan Barangay Hall', 'upperbicutan@gmail.com', NULL, '$2y$10$ylBL5ql37nImraEDgL86G..jOkVe3EIeVzQ4IhQGLdNnctzKD1WOO', NULL, 'barangay', 'storage/images/1670563257.jpg', '2022-11-15 05:55:11', '2022-12-07 21:33:06'),
(88, 'asdssad', 'dasdas@gmail.com', NULL, '$2y$10$uAm2ot9CylcvINB.LKkpwOt5pM.5p5gB4m54XdD.v74YJZwbWPU06', NULL, 'verified_user', 'storage/images/1670593547.jpg', '2022-11-24 06:10:28', '2022-12-09 05:45:47'),
(94, 'barangayadmin', 'barangayadmin@gmail.com', NULL, '$2y$10$aUn0mS5fRAc5FMRIEAZbo.lgwK1wxGC5wQVb/7U.zD.sNoyLdSAUi', NULL, 'barangay_admin', 'storage/images/1670477524.jpg', '2022-12-07 21:20:36', '2022-12-07 21:32:04'),
(95, 'usersadmin', 'useradmin@gmail.com', NULL, '$2y$10$yvymeVyeI5GkoseBJXHE5e5Nr/s72LVXpMleWYF9KAs2nB6Rgstw.', NULL, 'user_admin', 'storage/images/1670478840.png', '2022-12-07 21:54:01', '2022-12-07 21:54:01'),
(96, 'policestationadmin', 'policestationadmin@gmail.com', NULL, '$2y$10$fYuqTDdnpbSbQCPFm7PPSOzmUw1VBaUvDmCzVuCUTblspaOI4IOvS', NULL, 'policestation_admin', 'storage/images/1670478889.jpg', '2022-12-07 21:54:49', '2022-12-07 21:54:49'),
(97, 'hospitalsadmin', 'hospitaladmin@gmail.com', NULL, '$2y$10$HCT7LjIjUfn27BF3yjYvx.tYgZpciJspEKhaOcfwadosQJ.rsxvFK', NULL, 'hospital_admin', 'storage/images/1670478928.jpg', '2022-12-07 21:55:28', '2022-12-07 21:55:28'),
(101, 'Pinagsama Barangay Hall', 'pinagsama@gmail.com', NULL, '$2y$10$TeId602Uz69nOo55avzFaekpv6tUZ64Imqi8b3emloMDIa//Qv4le', NULL, 'barangay', 'storage/images/1670509451.jpg', '2022-12-08 05:35:18', '2022-12-08 05:35:18'),
(102, 'Fort Bonifacio Barangay Hall', 'fortbonifacio@gmail.com', NULL, '$2y$10$6MXn6cxkY68wRcQiRaZ17.5cc534w1pHyz4rq2auHz.IcE7weltI2', NULL, 'barangay', 'storage/images/1670508908.jpg', '2022-12-08 06:01:03', '2022-12-08 06:01:03'),
(103, 'BGC Police', 'bgc@gmail.com', NULL, '$2y$10$h9hw3MSgtVwGNx/vtSuUDemnHKFQrdU7cCkHHmyJ3G3a05IdIaSTW', NULL, 'police_station', 'storage/images/1670587400.jpg', '2022-12-09 04:03:20', '2022-12-09 04:03:20');

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
  `id_picture_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_picture_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `face_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verified_users`
--

INSERT INTO `verified_users` (`id`, `fname`, `mname`, `lname`, `gender`, `birthdate`, `address`, `contact`, `email`, `id_picture_front`, `id_picture_back`, `id_type`, `id_number`, `face_img`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(29, 'arturo', 'vertico', 'bradul', 'Male', '2022-11-18', 'Taguig', '09886968', 'bradul@gmail.com', NULL, NULL, NULL, NULL, NULL, '', '63', '2022-11-04 05:06:46', '2022-11-04 05:06:46');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `police_stations`
--
ALTER TABLE `police_stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `verified_users`
--
ALTER TABLE `verified_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
