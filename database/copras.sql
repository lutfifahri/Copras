-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2021 at 06:51 AM
-- Server version: 5.7.15-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_copras`
--

-- --------------------------------------------------------

--
-- Table structure for table `daun`
--

CREATE TABLE `daun` (
  `id_daun` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `daun`
--

INSERT INTO `daun` (`id_daun`, `nama`) VALUES
(30, 'Daun Teh TRI'),
(31, 'Daun Teh BT'),
(32, 'Daun Teh Hitam'),
(33, 'Daun Teh Gambung'),
(34, 'Daun Teh Hijau');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_daun` int(11) NOT NULL,
  `perhitungan` text NOT NULL,
  `nilai` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_daun`, `perhitungan`, `nilai`) VALUES
(1, 30, '18.3243 / 23.3243', '78.56'),
(2, 31, '19.4026 / 23.3243', '83.19'),
(3, 32, '18.0473 / 23.3243', '77.38'),
(4, 33, '20.9026 / 23.3243', '89.62'),
(5, 34, '23.3243 / 23.3243', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL,
  `kelompok` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama`, `bobot`, `kelompok`) VALUES
(1, 'Aroma', 20, 'Menguntungkan'),
(2, 'Warna ', 20, 'Menguntungkan'),
(3, 'Rasa', 10, 'Merugikan'),
(17, 'Luas', 50, 'Menguntungkan');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_daun`
--

CREATE TABLE `kriteria_daun` (
  `id_daun` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `id_subkriteria` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `kriteria_daun`
--

INSERT INTO `kriteria_daun` (`id_daun`, `id_kriteria`, `id_subkriteria`) VALUES
(30, 1, 20),
(30, 2, 22),
(30, 3, 26),
(30, 17, 54),
(31, 1, 21),
(31, 2, 22),
(31, 3, 25),
(31, 17, 53),
(32, 1, 20),
(32, 2, 23),
(32, 3, 27),
(32, 17, 54),
(33, 1, 21),
(33, 2, 23),
(33, 3, 25),
(33, 17, 52),
(34, 1, 20),
(34, 2, 22),
(34, 3, 26),
(34, 17, 52);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `hak_akses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `username`, `password`, `hak_akses`) VALUES
(1, 'Administrator', 'admin', '12345', 'Administrator'),
(2, 'Pimpinan', 'pimpinan', 'pimpinan', 'Pimpinan');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `nama`, `bobot`) VALUES
(20, 1, 'Sangat Bagus', 5),
(21, 1, 'Bagus', 4),
(22, 2, 'Sangat Bagus', 5),
(23, 2, 'Bagus', 4),
(24, 2, 'Cukup', 3),
(25, 3, 'Sangat Bagus', 5),
(26, 3, 'Bagus', 4),
(27, 3, 'Cukup ', 3),
(36, 1, 'Cukup', 3),
(37, 1, 'Buruk', 2),
(38, 2, 'Buruk', 2),
(39, 2, 'Sangat Buruk', 1),
(40, 3, 'Buruk', 2),
(41, 3, 'Sangat Buruk', 1),
(52, 17, 'Sangat Bagus', 5),
(53, 17, 'Bagus', 4),
(54, 17, 'Cukup', 3),
(55, 17, 'Buruk', 2),
(56, 17, 'Sangat Buruk', 1),
(57, 1, 'Sangat Buruk', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daun`
--
ALTER TABLE `daun`
  ADD PRIMARY KEY (`id_daun`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_mobil` (`id_daun`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `kriteria_daun`
--
ALTER TABLE `kriteria_daun`
  ADD KEY `id_alternatif` (`id_daun`,`id_kriteria`,`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_subkriteria` (`id_subkriteria`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daun`
--
ALTER TABLE `daun`
  MODIFY `id_daun` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `kriteria_daun`
--
ALTER TABLE `kriteria_daun`
  MODIFY `id_daun` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_daun`) REFERENCES `daun` (`id_daun`) ON DELETE CASCADE;

--
-- Constraints for table `kriteria_daun`
--
ALTER TABLE `kriteria_daun`
  ADD CONSTRAINT `kriteria_daun_ibfk_1` FOREIGN KEY (`id_daun`) REFERENCES `daun` (`id_daun`) ON DELETE CASCADE,
  ADD CONSTRAINT `kriteria_daun_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE,
  ADD CONSTRAINT `kriteria_daun_ibfk_3` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`) ON DELETE CASCADE;

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
