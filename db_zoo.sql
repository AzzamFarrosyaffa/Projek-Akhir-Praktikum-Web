-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2026 at 02:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_zoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'admin2', 'admin999'),
(3, 'admin3', 'admin456');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_tiket`
--

CREATE TABLE `pemesanan_tiket` (
  `id_tiket` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jenis_tiket` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan_tiket`
--

INSERT INTO `pemesanan_tiket` (`id_tiket`, `id_user`, `nama_pemesan`, `tanggal_kunjungan`, `jenis_tiket`, `jumlah`, `total_bayar`, `tanggal_transaksi`) VALUES
(2, NULL, 'Siti Aminah', '2026-11-12', 'Anak', 3, 105000, '2026-11-09 12:26:11'),
(3, NULL, 'Andi Pratama', '2026-11-14', 'Keluarga', 1, 150000, '2026-11-09 12:26:11'),
(4, NULL, 'Rina Melati', '2026-11-15', 'Dewasa', 4, 200000, '2026-11-09 12:26:11'),
(5, NULL, 'Hendra Wijaya', '2026-11-15', 'Keluarga', 2, 300000, '2026-11-09 12:26:11'),
(6, NULL, 'Maya Sari', '2026-11-18', 'Anak', 1, 35000, '2026-11-09 12:26:11'),
(7, NULL, 'Dimas Anggara', '2026-11-20', 'Dewasa', 1, 50000, '2026-11-09 12:26:11'),
(8, NULL, 'Keluarga Bapak Joko', '2026-11-21', 'Keluarga', 1, 150000, '2026-11-09 12:26:11'),
(9, NULL, 'Nisa Rahmawati', '2026-11-21', 'Dewasa', 3, 150000, '2026-11-09 12:26:11'),
(10, NULL, 'Reza Pahlevi', '2026-11-22', 'Anak', 2, 70000, '2026-11-09 12:26:11'),
(11, NULL, 'Tika Panggabean', '2026-11-25', 'Keluarga', 3, 450000, '2026-11-09 12:26:11'),
(12, NULL, 'Gilang Dirga', '2026-11-28', 'Dewasa', 5, 250000, '2026-11-09 12:26:11'),
(13, NULL, 'azz', '2026-11-01', 'Dewasa', 1, 0, '2026-11-09 12:45:34'),
(14, NULL, 'w', '2026-11-01', 'Dewasa', 1, 50000, '2026-11-09 13:38:30'),
(15, 2, 'Azz', '2026-11-14', 'Anak', 1, 35000, '2026-11-09 14:15:10'),
(16, 3, 'iwanhaha', '2026-11-27', 'Dewasa', 1, 50000, '2026-11-11 00:55:12'),
(17, 3, 'iwan', '2026-12-11', 'Dewasa', 1, 50000, '2026-11-17 12:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(2, 'Azz', 'azzam', '123', 'user'),
(3, 'iwan', 'iwan', 'iwan123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `pemesanan_tiket`
--
ALTER TABLE `pemesanan_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesanan_tiket`
--
ALTER TABLE `pemesanan_tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
