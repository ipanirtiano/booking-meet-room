-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 09:01 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_meet_room`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_booking` varchar(10) NOT NULL,
  `kode_cabang` varchar(10) NOT NULL,
  `kode_room` varchar(10) NOT NULL,
  `topik` varchar(150) NOT NULL,
  `tanggal_meeting` varchar(10) NOT NULL,
  `jam_mulai` varchar(5) NOT NULL,
  `jam_akhir` varchar(5) NOT NULL,
  `pemesan` varchar(10) NOT NULL,
  `status` varchar(7) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `kode_booking`, `kode_cabang`, `kode_room`, `topik`, `tanggal_meeting`, `jam_mulai`, `jam_akhir`, `pemesan`, `status`, `created_at`, `updated_at`) VALUES
(6, 'BO-389046', 'CB-148469', 'ROOM-0013', 'Meeting Mingguan', '03-03-2021', '11:00', '12:00', 'USR-128189', 'Booking', '2021-03-03 22:11:01', '2021-03-03 22:31:49'),
(8, 'BO-579278', 'CB-148469', 'ROOM-0013', 'Meeting QC', '04-03-2021', '10:00', '14:00', 'USR-259026', 'Out', '2021-03-04 00:25:44', '2021-03-04 01:28:38'),
(9, 'BO-018358', 'CB-148469', 'ROOM-0167', 'Meeting HRD', '04-03-2021', '08:00', '10:00', 'USR-259026', 'Booking', '2021-03-04 00:28:13', '2021-03-04 00:28:13'),
(11, 'BO-679136', 'CB-235237', 'ROOM-0045', 'Meeting Laporan', '04-03-2021', '08:00', '10:00', 'USR-259026', 'Booking', '2021-03-04 00:32:14', '2021-03-04 00:32:14'),
(12, 'BO-468123', 'CB-148469', 'ROOM-0013', 'Meeting Karyawan', '04-03-2021', '09:00', '12:00', 'USR-128189', 'Out', '2021-03-04 00:40:01', '2021-03-04 19:36:20'),
(14, 'BO-467457', 'CB-148469', 'ROOM-0167', 's', '04-03-2021', '10:00', '11:00', 'USR-128189', 'Booking', '2021-03-04 01:10:08', '2021-03-04 01:10:08'),
(15, 'BO-259678', 'CB-148469', 'ROOM-0167', 'a', '04-03-2021', '13:00', '14:00', 'USR-128189', 'Booking', '2021-03-04 01:12:15', '2021-03-04 01:27:42'),
(16, 'BO-027234', 'CB-148469', 'ROOM-0013', 'Meeting', '04-03-2021', '14:00', '15:00', 'USR-259026', 'Booking', '2021-03-04 01:12:38', '2021-03-04 01:12:38'),
(17, 'BO-136246', 'CB-148469', 'ROOM-0013', 'Meeting Harian', '05-03-2021', '08:00', '10:00', 'USR-128189', 'Booking', '2021-03-05 22:54:04', '2021-03-05 22:54:04'),
(18, 'BO-268025', 'CB-148469', 'ROOM-0013', 'HHH', '06-03-2021', '10:00', '11:00', 'USR-128189', 'Booking', '2021-03-06 04:25:00', '2021-03-06 04:25:00'),
(19, 'BO-136023', 'CB-148469', 'ROOM-0013', 'hah', '06-03-2021', '09:00', '10:00', 'USR-128189', 'Booking', '2021-03-06 04:48:13', '2021-03-06 04:48:13'),
(29, 'BO-478467', 'CB-148469', 'ROOM-0167', 'Meeting HRD', '11-03-2021', '10:00', '13:00', 'USR-128189', 'Booking', '2021-03-11 01:25:44', '2021-03-11 01:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_cabang` varchar(10) NOT NULL,
  `nama_cabang` varchar(25) NOT NULL,
  `kota_cabang` varchar(50) NOT NULL,
  `alamat_cabang` varchar(50) NOT NULL,
  `telpon_cabang` varchar(13) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `kode_cabang`, `nama_cabang`, `kota_cabang`, `alamat_cabang`, `telpon_cabang`, `created_at`, `updated_at`) VALUES
(2, 'CB-148469', 'ANCOL', 'JAKARTA', 'Jl. Jendral Sudirman Jakarta Utara', '089602745844', '2021-02-25 08:46:39', '2021-02-25 08:46:39'),
(4, 'CB-235237', 'PARUNG PANJANG', 'BOGOR', 'Parung Bogor', '0896035655', '2021-02-25 09:11:20', '2021-02-25 09:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_booking`
--

CREATE TABLE `cancel_booking` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_booking` varchar(10) NOT NULL,
  `kode_cabang` varchar(10) NOT NULL,
  `kode_room` varchar(10) NOT NULL,
  `topik` varchar(255) NOT NULL,
  `tanggal_meeting` varchar(50) NOT NULL,
  `jam_mulai` varchar(50) NOT NULL,
  `jam_akhir` varchar(50) NOT NULL,
  `pemesan` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `alasan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cancel_booking`
--

INSERT INTO `cancel_booking` (`id`, `kode_booking`, `kode_cabang`, `kode_room`, `topik`, `tanggal_meeting`, `jam_mulai`, `jam_akhir`, `pemesan`, `status`, `alasan`, `created_at`, `updated_at`) VALUES
(1, 'BO-468679', 'CB-148469', 'ROOM-0167', 'Meeting Produksi', '03-03-2021', '08:00', '12:00', 'USR-128189', 'Booking Cancel', 'Update Schedule', '2021-03-03 23:51:00', '2021-03-03 23:51:00'),
(2, 'BO-015126', 'CB-148469', 'ROOM-0013', 'Meeting', '04-03-2021', '08:00', '10:00', 'USR-259026', 'Booking Cancel', 'h', '2021-03-04 01:29:57', '2021-03-04 01:29:57'),
(3, 'BO-138027', 'CB-148469', 'ROOM-0167', 'Meeting Kain', '04-03-2021', '11:00', '14:00', 'USR-259026', 'Booking Cancel', 'Ganti Scedule', '2021-03-04 19:33:28', '2021-03-04 19:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_dept` varchar(10) NOT NULL,
  `nama_departemen` varchar(35) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `kode_dept`, `nama_departemen`, `created_at`, `updated_at`) VALUES
(1, 'Dept-16928', 'AUDIT DEPARTEMEN', '2021-02-24 09:20:04', '2021-02-24 09:20:04'),
(3, 'Dept-25724', 'IT CENTER', '2021-02-24 09:27:41', '2021-02-24 11:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_guest` varchar(10) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `departemen` varchar(30) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `kode_guest`, `nama_lengkap`, `email`, `phone`, `departemen`, `created_at`, `updated_at`) VALUES
(1, 'USR-467289', 'Almira Palastri Putri', 'ciaobella37@yahoo.com', '05979148433', 'AUDIT DEPARTEMEN', '2021-02-24 10:50:30', '2021-03-03 12:01:03'),
(2, 'USR-128189', 'Ipan Irtiano', 'ipanirtiano@gmail.com', '089602745844', 'IT CENTER', '2021-02-24 11:23:30', '2021-02-24 12:27:01'),
(4, 'USR-259026', 'Dwi Dzulqhori', 'dwi@gmail.com', '08977665432', 'AUDIT DEPARTEMEN', '2021-02-25 03:54:47', '2021-02-25 04:21:02'),
(5, 'USR-346237', 'Dede Amelia', 'dede@gmail.com', '089602745844', 'IT CENTER', '2021-03-03 11:56:14', '2021-03-03 11:56:14');

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
(1, '2021-02-23-140150', 'App\\Database\\Migrations\\Users', 'default', 'App', 1614090396, 1),
(2, '2021-02-23-140557', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1614090396, 1),
(3, '2021-02-24-061620', 'App\\Database\\Migrations\\Departemen', 'default', 'App', 1614147474, 2),
(4, '2021-02-24-153158', 'App\\Database\\Migrations\\Guest', 'default', 'App', 1614180762, 3),
(5, '2021-02-25-100618', 'App\\Database\\Migrations\\Ruangan', 'default', 'App', 1614247662, 4),
(6, '2021-02-25-141911', 'App\\Database\\Migrations\\Cabang', 'default', 'App', 1614262839, 5),
(7, '2021-02-26-062109', 'App\\Database\\Migrations\\Booking', 'default', 'App', 1614324050, 6),
(8, '2021-03-03-163632', 'App\\Database\\Migrations\\CancelBooking', 'default', 'App', 1614789454, 7);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_room` varchar(10) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `cabang` varchar(10) NOT NULL,
  `kapasitas` varchar(20) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `kode_room`, `nama_ruangan`, `cabang`, `kapasitas`, `fasilitas`, `created_at`, `updated_at`) VALUES
(1, 'ROOM-0013', 'Ruang Tunggu', 'CB-148469', '5 - 10 Orang', '[\"Wifi\",\"In Focus\",\"White Board\",\"Monitor LED\",\"Sound System\"]', '2021-02-27 11:09:51', '2021-03-03 12:00:51'),
(3, 'ROOM-0167', 'Ruang B', 'CB-148469', '10 - 15 Orang', '[\"Wifi\",\"In Focus\"]', '2021-02-27 11:12:11', '2021-02-27 11:26:37'),
(4, 'ROOM-0045', 'Ruang C', 'CB-235237', '10 - 15 Orang', '[\"In Focus\",\"White Board\",\"Monitor LED\"]', '2021-02-27 11:19:30', '2021-02-27 11:19:30'),
(6, 'ROOM-0037', 'Ruang E', 'CB-148469', '15 - 20 Orang', '[\"Wifi\",\"In Focus\"]', '2021-03-03 12:14:52', '2021-03-03 12:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_users` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_users`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'USR-467289', 'ciaobella37@yahoo.com', '$2y$10$oEYPjRkNag3zaiIYW5vMVutFcG8Zv0de5ZINgrjt4SXkb/VYW1H8i', 'guest', '2021-02-24 10:50:31', '2021-03-03 12:01:03'),
(2, 'USR-128189', 'ipanirtiano@gmail.com', '$2y$10$w2qFAW1yg4VVTyXyzjrHi.XoCybgmuLG62uZ3gqCfc06Tcdy9VUNe', 'admin', '2021-02-24 11:23:30', '2021-02-24 12:27:01'),
(4, 'USR-259026', 'dwi@gmail.com', '$2y$10$E1C56aLNxwahFYWUW8MoOeLCCWOm81Q3cEEZHMj6IsttBoS7eQcE.', 'guest', '2021-02-25 03:54:48', '2021-02-25 04:21:02'),
(5, 'USR-346237', 'dede@gmail.com', '$2y$10$RgApGrzxiLXUIprnw0X08O6pdkB0IJNBLq7m/ROe0fV1Yvq4OM0c6', 'guest', '2021-03-03 11:56:14', '2021-03-03 11:56:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel_booking`
--
ALTER TABLE `cancel_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cancel_booking`
--
ALTER TABLE `cancel_booking`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
