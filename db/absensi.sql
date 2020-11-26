-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 06:43 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `absen_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `jam_masuk` varchar(255) NOT NULL,
  `jam_pulang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`absen_id`, `users_id`, `jam_masuk`, `jam_pulang`) VALUES
(20, 21, '26 Nov 2020 13:26:38', '26 Nov 2020 13:26:39'),
(21, 22, '26 Nov 2020 13:27:42', '26 Nov 2020 13:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan_name`) VALUES
(2, 'keuangan'),
(3, 'Kabid'),
(4, 'Humas'),
(5, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id` int(11) NOT NULL,
  `jk_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id`, `jk_name`) VALUES
(3, 'Laki Laki'),
(4, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kegiatan_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`kegiatan_id`, `users_id`, `kegiatan`, `tgl_kegiatan`, `jam`) VALUES
(18, 21, 'Pertemuan', '2020-11-11', '10:42:00'),
(19, 21, 'kunjungan keluarga ciamis', '2020-11-11', '10:42:00'),
(21, 21, 'perjalanan keluar kota', '2020-11-29', '10:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `level_name`) VALUES
(1, 'admin'),
(2, 'pegawai\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pekerja`
--

CREATE TABLE `pekerja` (
  `pekerja_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `id_jk` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerja`
--

INSERT INTO `pekerja` (`pekerja_id`, `users_id`, `id_jk`, `id_jabatan`, `photo`) VALUES
(49, 21, 3, 5, '5fbf226d79640.jpg'),
(50, 22, 3, 3, '5fbf3e5df0c6f.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `id_level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `nama`, `email`, `password`, `id_level`, `created_at`) VALUES
(20, 'admin', 'admin@admin.com', '$2y$10$bLYPTU7k06FkEw0t.hHEpeNmvV1UZTDZ8YMOCsL7xaJbUNRcvWB.C', 1, '2020-11-25 18:37:04'),
(21, 'Chan Chan Bayu Bahari', 'chanchanbayub@gmail.com', '$2y$10$BMAcpOZRdtivV4aQep99SeC8WztiBOS6Nov3QkKd8LUC/UhFqViXK', 2, '2020-11-26 03:34:15'),
(22, 'bayu bahari ', 'bayubahari98@gmail.com', '$2y$10$deeoHmsoSiNpGKoKP.OYsusY7kOim0rtvBrAp5rDKU3MQFdrPbRmq', 2, '2020-11-26 04:53:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`absen_id`),
  ADD KEY `ids` (`users_id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`kegiatan_id`),
  ADD KEY `kegiatan_id` (`users_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD PRIMARY KEY (`pekerja_id`),
  ADD KEY `jenis_kelamin` (`id_jk`),
  ADD KEY `jabatan` (`id_jabatan`),
  ADD KEY `id` (`users_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `kegiatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pekerja`
--
ALTER TABLE `pekerja`
  MODIFY `pekerja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `ids` FOREIGN KEY (`users_id`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_id` FOREIGN KEY (`users_id`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD CONSTRAINT `id` FOREIGN KEY (`users_id`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jenis_kelamin` FOREIGN KEY (`id_jk`) REFERENCES `jenis_kelamin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `level` FOREIGN KEY (`id_level`) REFERENCES `level` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
