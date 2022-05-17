-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 07:27 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel-hebat`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `id` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `fasilitas` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`id`, `id_kamar`, `fasilitas`, `gambar`) VALUES
(31, 34, 'AC Pendingin Ruang', '627dbc0064b40.jpg'),
(38, 1, 'Wifi', '627dbc3a08cb7.jpg'),
(39, 1, 'PS 5', '627dbc91deb5e.jpg'),
(41, 1, 'TV LED 32 inch', '628322075c586.jpg'),
(42, 34, 'Set Handuk', '628322aea703f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_umum`
--

CREATE TABLE `fasilitas_umum` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas_umum`
--

INSERT INTO `fasilitas_umum` (`id`, `nama_fasilitas`, `keterangan`, `gambar`) VALUES
(13, 'Kolam renang', 'Kolam renang anak-anak dan dewasa', '627e7464aac1f.jpg'),
(14, 'Lapangan Badminton', 'Bermain bersama teman dan keluarga.', '627e7b22099ee.jpg'),
(15, 'TempatSantai', 'Bersantai dan menikmati suasana hotel', '627e7b31f18ee.png'),
(16, 'GYM', 'Buka Jam 7 pagi hingga jam 11 siang', '627e7b7394165.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `total_kamar` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `total_kamar`) VALUES
(1, 'Superior', 45),
(34, 'Deluxe', 45);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `no_reg` varchar(50) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` varchar(12) NOT NULL,
  `nama_tamu` varchar(50) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `jml_kamar` int(2) NOT NULL,
  `status` enum('Sedang Diproses','Telah Diproses') NOT NULL,
  `id_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `no_reg`, `nama_pemesan`, `email`, `hp`, `nama_tamu`, `tgl_pesan`, `checkin`, `checkout`, `jml_kamar`, `status`, `id_kamar`) VALUES
(17, 'REG-0522002', 'Fajri', 'fajri@gmail.com', '08524455', 'Muhammad Fajri', '2022-05-11 14:13:08', '2022-05-13', '2022-05-19', 2, 'Sedang Diproses', 34),
(18, 'REG-0522003', 'Deni', 'deniirawan683@gmail.com', '085316778388', 'Deni Irawan', '2022-05-15 00:00:00', '2022-05-15', '2022-05-17', 3, 'Telah Diproses', 1),
(30, 'REG-0522001', 'Azkiya', 'azkiya@gmail.com', '081233768801', 'Azkiya Alfiandri', '2022-05-17 00:00:00', '2022-05-17', '2022-05-18', 3, 'Sedang Diproses', 34),
(31, 'REG-0522004', 'Rian', 'muhammadfebrian683@gmail.com', '085316778388', 'Muhammad Febrian', '2022-05-16 00:00:00', '2022-05-16', '2022-05-17', 2, 'Sedang Diproses', 1),
(32, 'REG-0522005', 'Rhea', 'rhea@gmail.co', '081233768801', 'Rhea Havilah G.', '2022-05-17 00:00:00', '2022-05-18', '2022-05-19', 3, 'Sedang Diproses', 34),
(33, 'REG-0522006', 'teno', 'teno@gmail.com', '081233768801', 'teno', '2022-05-17 00:00:00', '2022-05-17', '2022-05-18', 2, 'Sedang Diproses', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `role` enum('Admin','Resepsionis','Tamu','') NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `gambar`, `role`, `nama`, `no_hp`, `alamat`) VALUES
('admin', '$2y$10$HWFmRbo9r/vbGEZ3lav50eW6ZGcDkiGLy34qdkr7L5Y1rZEttTtPu', '6263ef68bf766.jpg', 'Admin', 'A Khadafi', '082200000000', 'padang sikabu'),
('resepsionis', '$2y$10$3UvvXTt1xWt3cZYOpA8jVOqaQ/KdFJlH8KOG3C3G7x7Bf6jyOfyVe', '626624a565842.jpg', 'Resepsionis', 'resepsionis', '08', 'sikabu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `fasilitas_umum`
--
ALTER TABLE `fasilitas_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `fasilitas_umum`
--
ALTER TABLE `fasilitas_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD CONSTRAINT `fasilitas_kamar_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
