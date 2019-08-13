-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2019 at 09:33 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

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
  `no_rekening` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `telp`, `email`, `password`, `alamat`, `latitude`, `longitude`, `bank`, `nama_rekening`, `no_rekening`, `jam_buka`, `jam_tutup`) VALUES
(3, '081910088345', 'Bawet@gmail.com', '$2y$10$zeqOlYs7HxnM.nXcUwDrYeCh4ns7Ctl.QLD3E2OBoyb9LHv2Ku6tW', 'Tamansari, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40116', '-6.889080', '107.607225', 'Bank Negara Indonesia (BNI)', 'Bawet Futsal', '0346244387', '08:00:00', '22:00:00'),
(4, '081321869910', 'YPKPFutsal@gmail.com', '$2y$10$vXtZUIKBSR3NQtEWqWGI3eUfIMNRwGQarXi5MqYn8x/Jxm2nW1HzO', 'Jl. Penghulu Haji Jl. PH.H. Mustofa No.70, Cikutra, Kec. Cibeunying Kidul, Kota Bandung, Jawa Barat 40124', '-6.899740', '107.640873', 'Bank Rakyat Indonesia (BRI)', 'YPKP Futsal', '678523439876', '08:00:00', '23:00:00'),
(5, '(022)2020980', 'sampoernafutsal@gmail.com', '$2y$10$R4TB9tNdwPrA1UyFIK3I2ugLfrTtQd7v3eC3LucL/PMNKnCga20.a', 'Jl. Padasaluyu No.10, Isola, Kec. Sukasari, Kota Bandung, Jawa Barat 40154', '-6.850381', '107.594880', 'Bank Central Asia (BCA)', 'Sampoerna Futsal', '12389766578', '07:00:00', '23:00:00'),
(13, '089653911382', 'puzzle@gmail.com', '$2y$10$0y/mBmRR9q4x9gLCCg0sd.cOmeoKI9TF6.EP6/KPWazpOV7PX811e', 'Jl. Sadang Serang No.5, Sadang Serang, Kecamatan Coblong, Bandung, Jawa Barat 40134', '-6.891539', '107.626789', 'Bank Central Asia (BCA)', 'Puzzle Futsal', '876754347665', '07:00:00', '22:00:00'),
(14, '085101624989', 'dewafutsal@gmail.com', '$2y$10$jLJTnaLZL4DzoLgaaUHJauNiLCmiVMKevtMD9.aUZJ9Zjz/YZnahO', 'Jl. Parakan Saat No.224, Antapani Tengah, Kec. Antapani, Kota Bandung, Jawa Barat 40291', '-6.927169', '107.666522', 'Bank Mandiri', 'Dewa Futsal', '09876547865', '07:00:00', '23:00:00'),
(17, '(022)7801616', 'progresiffutsal@gmail.com', '$2y$10$choTF8KyhkUAHCtnuubHfeKAYWKeEbxh5F5YkWsmEsqIB6RBVu9R.', 'Jl. Soekarno Hatta No.785A, Babakan Penghulu, Cinambo, Kota Bandung, Jawa Barat 40293', '-6.937376', '107.685755', 'Bank Central Asia (BCA)', 'Progresif Futsal', '766567665431', '08:00:00', '23:00:00'),
(18, '(022)20521343', 'queenfutsal@gmail.com', '$2y$10$QF.wjyBWLS87lGxr0Fy14ef98HP8tiI9MznkXEeSkNbbDyWMeUHZq', 'Jl.Brigjen Katamso No.66, Cicadas, Cibeunying Kidul, Cicadas, Kec. Cibeunying Kidul, Kota Bandung, Jawa Barat 40122', '-6.902799', '107.633451', 'Bank Negara Indonesia (BNI)', 'Queen Futsal', '667598784321', '07:00:00', '23:00:00'),
(19, '(022)92630499', 'meteorfutsal@gmail.com', '$2y$10$K8qChixbhKoelTO/gWTRo.Al.QAI0.5B4VaDQzDLo/vNsjubLXhvi', 'Jl. Terusan Jakarta, Antapani Kulon, Kec. Antapani, Kota Bandung, Jawa Barat 40291', '-6.912271', '107.656883', 'Bank Central Asia (BCA)', 'Meteor Futsal', '46587673214', '06:00:00', '22:00:00'),
(20, '085100015535', 'futsal35@email.com', '$2y$10$c7wmHnl55fRUWQd3D4vj2udFL0gsRWEEVLKd6gDv16G8Uw5O9h0GC', 'Jl. International School No. 8 A, Cicaheum, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40282', '-6.910429', '107.649111', 'Bank Negara Indonesia (BNI)', 'Futsal 35', '7767544365', '07:00:00', '22:00:00'),
(21, '(022) 2030915', 'obcfutsal@email.com', '$2y$10$7ZmIhaKykBR8iE85nxy.oeGtXtiL66yaVlNeLYGGvReo6ZmjRphqm', 'Jl. Rancabentang I No.3A, Ciumbuleuit, Kec. Cidadap, Kota Bandung, Jawa Barat 40141', '-6.874744', '107.607233', 'Bank Central Asia (BCA)', 'OBC Futsal', '335477869841', '07:00:00', '23:00:00');

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
(1, 'Toilet'),
(4, 'Tribun'),
(5, 'ATM'),
(6, 'Kantin'),
(7, 'Free WiFi'),
(8, 'Taman Bermain'),
(9, 'Toko'),
(10, 'Minimarket'),
(11, 'Musholla');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_lapangan`
--

CREATE TABLE `fasilitas_lapangan` (
  `id` int(4) NOT NULL,
  `id_fasilitas` int(4) NOT NULL,
  `id_lapangan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fasilitas_lapangan`
--

INSERT INTO `fasilitas_lapangan` (`id`, `id_fasilitas`, `id_lapangan`) VALUES
(7, 1, 13),
(8, 9, 13),
(9, 1, 16),
(10, 11, 16),
(11, 9, 16),
(12, 1, 14),
(13, 6, 14),
(14, 11, 14),
(15, 10, 14),
(16, 5, 14),
(17, 7, 14),
(18, 1, 15),
(19, 6, 15),
(20, 8, 15),
(21, 11, 15),
(22, 7, 15),
(23, 1, 17),
(24, 6, 17),
(25, 11, 17),
(26, 7, 17),
(27, 4, 17),
(28, 1, 18),
(29, 6, 18),
(30, 7, 18),
(31, 4, 18),
(32, 9, 19),
(33, 6, 19),
(34, 1, 19),
(35, 11, 19),
(36, 4, 19),
(37, 7, 19),
(38, 1, 20),
(39, 11, 20),
(40, 9, 20),
(41, 4, 20),
(42, 1, 21),
(43, 6, 21),
(44, 11, 21),
(45, 7, 21),
(46, 4, 21),
(47, 6, 22),
(48, 11, 22),
(49, 1, 22),
(50, 8, 22),
(51, 7, 22),
(52, 4, 22);

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id` int(4) NOT NULL,
  `id_admin` int(4) NOT NULL,
  `nama` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `harga` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `id_admin`, `nama`, `harga`, `foto`, `deleted_at`) VALUES
(13, 3, 'Lapangan Futsal Bawet', '50000', 'https://lh5.googleusercontent.com/p/AF1QipPGJt59jwSYyMEL90rj7h3aYZJQH5u_TvlHLBDn=w426-h240-k-no', NULL),
(14, 4, 'YPKP Futsal', '120000', 'https://lh5.googleusercontent.com/p/AF1QipPC1OpesBFDHVWLFavLJI6FgfVhv0E9IDh6U3sd=w408-h725-k-no', NULL),
(15, 5, 'Sampoerna Sport Club', '130000', 'http://infolapangan.co.id/upload/owner/Sampoerna%20Futsal/sampoerna-futsal-05.JPG', NULL),
(16, 13, 'Puzzle Futsal', '90000', 'https://lh4.googleusercontent.com/proxy/qbHSIbdVcDAul6TZ1a1_Lb8XGX8YbzaehpMFWbG0HLh3xvA1rUqb2MYXNPgvsUpWnyV_wGcuuP-fsxtICkYKItAOl7MlDXLXchPcv6KuoMmiyHOaSkUz4yiKPrqZUNrNarBXX1XHTLJxJjld5ACjhHbW7A=w408-h306-k-no', NULL),
(17, 14, 'Dewa Futsal', '120000', 'https://lh5.googleusercontent.com/p/AF1QipOLGbXmBN2z-AALGeQt4SdrCF0uKUSinZeSAMtS=w426-h240-k-no', NULL),
(18, 17, 'Progresif Futsal', '160000', 'https://lh5.googleusercontent.com/p/AF1QipMb4bDEncdBWvfMCvkYg3UgD6yv2_mJz6JWOVZh=w1133-h240-k-no', NULL),
(19, 18, 'Queen Futsal', '180000', 'https://lh5.googleusercontent.com/p/AF1QipMxRUZRhCbg6QS84oU_OMPvj7kOM47Mzh4V4chB=w426-h240-k-no', NULL),
(20, 19, 'Meteor Futsal', '130000', 'https://lh5.googleusercontent.com/p/AF1QipPtGFsfHYPKWHJUNJtcX0F7ROpVokd8gnJXp65Q=w408-h306-k-no', NULL),
(21, 20, 'Futsal 35', '150000', 'https://lh5.googleusercontent.com/p/AF1QipMbcxnTYt5QfAPuwYStxERJnpyOAPfgue8MsZKZ=w408-h306-k-no', NULL),
(22, 21, 'OBC Sport Center', '120000', 'https://lh5.googleusercontent.com/p/AF1QipMXUmmmyr7R2Ji9XhfBP9jg2ybxOHWUu0MplV5e=w408-h272-k-no', NULL);

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
  `status` enum('belum','sudah','batal','kadaluarsa') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_user`, `id_lapangan`, `waktu_pilih`, `metode_bayar`, `status`, `created_at`) VALUES
(30, 11, 13, '2019-08-14 13:00:00', 'cod', 'sudah', '2019-08-13 07:59:32'),
(31, 11, 13, '2019-08-13 14:00:00', 'cod', 'sudah', '2019-08-13 07:59:32'),
(32, 11, 16, '2019-08-13 20:00:00', 'cod', 'belum', '2019-08-13 07:59:32'),
(33, 12, 13, '2019-08-31 16:00:00', 'cod', 'belum', '2019-08-13 07:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `telp`, `password`) VALUES
(11, 'Fauzan Adzima', 'fauzanadzima944@gmail.com', '087823770952', '$2y$10$8hbrUrtRGnSUzW9g1MKGLOQWismOHkxvYN.pXu2HRYuPx6tTugGvy'),
(12, 'Senny Febrianti', 'sennyfebrianti1997@gmail.com', '085724049254', '$2y$10$X5bE/bba/HTePQeAID1XOuHLLZsRRpwpi6T87PbeoieaOqRBKavgq');

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fasilitas_lapangan`
--
ALTER TABLE `fasilitas_lapangan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
