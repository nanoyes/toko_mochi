-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 05:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mochi`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembeli_mochi`
--

CREATE TABLE `pembeli_mochi` (
  `pembeli_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli_mochi`
--

INSERT INTO `pembeli_mochi` (`pembeli_id`, `nama`, `alamat`) VALUES
(5, 'nanda cantik', 'DEMAAN');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_mochi`
--

CREATE TABLE `transaksi_mochi` (
  `transaksi_id` int(11) NOT NULL,
  `id_pembeli` int(11) DEFAULT NULL,
  `jenis_mochi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_mochi`
--

INSERT INTO `transaksi_mochi` (`transaksi_id`, `id_pembeli`, `jenis_mochi`, `harga`, `tanggal`) VALUES
(5, 5, 'Matcha', 20000, '2023-12-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembeli_mochi`
--
ALTER TABLE `pembeli_mochi`
  ADD PRIMARY KEY (`pembeli_id`);

--
-- Indexes for table `transaksi_mochi`
--
ALTER TABLE `transaksi_mochi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembeli_mochi`
--
ALTER TABLE `pembeli_mochi`
  MODIFY `pembeli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_mochi`
--
ALTER TABLE `transaksi_mochi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_mochi`
--
ALTER TABLE `transaksi_mochi`
  ADD CONSTRAINT `transaksi_mochi_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli_mochi` (`pembeli_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
