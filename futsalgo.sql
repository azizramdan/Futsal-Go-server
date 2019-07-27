-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2019 at 04:30 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futsalgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(4) NOT NULL,
  `telp` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `bank` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nama_rekening` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `no_rekening` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `telp`, `email`, `password`, `alamat`, `latitude`, `longitude`, `bank`, `nama_rekening`, `no_rekening`) VALUES
(1, '081321655', 'fauzan@gmail.com', '$2y$10$D0p0E3LKK6qPdK2xPYs1VeFvA5vjT0ZY22wdXEhdW3NnRY/ODC4Fi', 'ger ertg erg er654g er gre g885', '-6.524842', '107.448613', 'BNI', 'Fauzan', '7898756654'),
(2, '082232654641', 'aziz@gmail.com', '$2y$10$D0p0E3LKK6qPdK2xPYs1VeFvA5vjT0ZY22wdXEhdW3NnRY/ODC4Fi', 'fgt re thre6546 the ht', '-6.483249', '107.479635', 'BCA', 'Aziz', '798654654');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(4) NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`) VALUES
(1, 'toilet'),
(2, 'kafe'),
(3, 'kamar ganti'),
(4, 'tribun');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_lapangan`
--

CREATE TABLE `fasilitas_lapangan` (
  `id` int(4) NOT NULL,
  `id_fasilitas` int(4) NOT NULL,
  `id_lapangan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id` int(4) NOT NULL,
  `id_admin` int(4) NOT NULL,
  `nama` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `harga` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `id_admin`, `nama`, `harga`, `foto`) VALUES
(6, 1, 'Puzzle 1', '100000', 'https://rumus.web.id/wp-content/uploads/2018/08/lapangan-futsal.jpg'),
(7, 1, 'Puzzle 2', '150000', 'https://s.kaskus.id/r480x480/images/fjb/2016/02/29/take_over_lapangan_futsal_batam_684052_1456738328.jpg'),
(8, 2, 'YPKP', '200000', 'https://www.jaringfutsalpengaman.com/wp-content/uploads/2018/07/37.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(4) NOT NULL,
  `id_user` int(4) NOT NULL,
  `id_lapangan` int(4) NOT NULL,
  `waktu_pilih` datetime NOT NULL,
  `metode_bayar` enum('cod','transfer') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('bayar','belum') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `nama` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `telp`, `password`) VALUES
(1, 'fauzanw', 'fauzan@email.com', '1111111111111', '$2y$10$1VDV6zw7k1NXnOyd.7josO/PFe2Vh3AmQ4AApEr1iKiySH1w03C0e'),
(2, 'aziz', 'aziz@email.com', '465654654', '$2y$10$D0p0E3LKK6qPdK2xPYs1VeFvA5vjT0ZY22wdXEhdW3NnRY/ODC4Fi'),
(3, 'aziz ramdan', 'azizr@email.com', '089600000', '$2y$10$umw3a2ljwD5O0IgSqau0.ehc1cM5tClrvKvi9r2HVAnDDyyc/q8Nu'),
(4, 'lapangan 2', 'puzzle@email.com', '7687687686876', '$2y$10$/iqMWt2.NechyY6uV7MGF.Qpu4KOPgfyCawiHrlcUg3hPHLVjEGV.'),
(5, 'kjhjkdfhs', 'azizwr@email.com', '', '$2y$10$CaqIfWp4hNZVum6NRC9u9e/Cra83b72y7P9Bjh25ZM9baTvP1Fxzi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_lapangan`
--
ALTER TABLE `fasilitas_lapangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fasilitas` (`id_fasilitas`),
  ADD KEY `id_fasilitas_2` (`id_fasilitas`),
  ADD KEY `id_lapangan` (`id_lapangan`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lapangan` (`id_lapangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas_lapangan`
--
ALTER TABLE `fasilitas_lapangan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fasilitas_lapangan`
--
ALTER TABLE `fasilitas_lapangan`
  ADD CONSTRAINT `fasilitas_lapangan_ibfk_1` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id`),
  ADD CONSTRAINT `fasilitas_lapangan_ibfk_2` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id`);

--
-- Constraints for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD CONSTRAINT `lapangan_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
