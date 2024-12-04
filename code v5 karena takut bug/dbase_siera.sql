-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 04:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbase_siera`
--

-- --------------------------------------------------------

--
-- Table structure for table `katalog_tugas`
--

CREATE TABLE `katalog_tugas` (
  `id_tugas` int(11) NOT NULL,
  `nama_tugas` varchar(10) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_dibuat` date NOT NULL,
  `tanggal_deadline` date NOT NULL,
  `tipe` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `katalog_tugas`
--

INSERT INTO `katalog_tugas` (`id_tugas`, `nama_tugas`, `deskripsi`, `tanggal_dibuat`, `tanggal_deadline`, `tipe`) VALUES
(1, 'Ekspedisi ', 'Buat video mengenai daerah asal kalian.\nSilahkan upload ke Google Drive dan kumpulkan link upload dengan file PDF.', '2024-11-01', '2024-11-15', 'PDF'),
(2, 'Get to Kno', 'Buat video perkenalan diri.', '2024-11-05', '2024-11-20', 'PDF'),
(3, 'Infografis', 'Buat poster infografis dengan tema bela negara.', '2024-11-10', '2024-11-25', 'PDF/Foto'),
(4, 'Keseruan P', 'Buat video mengenai keseruan Patribera.', '2024-11-12', '2024-11-30', 'PDF');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_user` int(5) DEFAULT NULL,
  `nim_mhs` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `domisili` varchar(25) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `fakultas` varchar(25) DEFAULT NULL,
  `jurusan` varchar(30) DEFAULT NULL,
  `asal_sma` varchar(25) DEFAULT NULL,
  `kelompok` int(3) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `instagram` varchar(30) DEFAULT NULL,
  `id_line` varchar(25) DEFAULT NULL,
  `profile_mhs` varchar(100) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_user`, `nim_mhs`, `nama`, `domisili`, `tanggal_lahir`, `fakultas`, `jurusan`, `asal_sma`, `kelompok`, `bio`, `no_telp`, `instagram`, `id_line`, `profile_mhs`) VALUES
(1, '2410512107', 'Arsya Rafidya', 'Jakarta', '2024-11-26', 'Ilmu Komputer', 'Sistem Informasi - S1', 'SMAN 46 Jakarta', 1, 'Alhamdulillah Luar Biasa', '087808780878', 'arsya_ing', 'arsya_line', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `id_user` int(5) DEFAULT NULL,
  `nim_mentor` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `fakultas` varchar(25) DEFAULT NULL,
  `jurusan` varchar(30) DEFAULT NULL,
  `kelompok` int(3) DEFAULT NULL,
  `id_line` varchar(25) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `instagram` varchar(30) DEFAULT NULL,
  `profile_mtr` varchar(100) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`id_user`, `nim_mentor`, `nama`, `fakultas`, `jurusan`, `kelompok`, `id_line`, `no_telp`, `instagram`, `profile_mtr`) VALUES
(2, '2310512096', 'Hilmansyah Putra', 'Ilmu Komputer', 'Sistem Informasi - S1', 1, 'hilman_line', '087808780878', 'hilman_ing', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_tugas`
--

CREATE TABLE `penilaian_tugas` (
  `id_pengumpulan` int(11) NOT NULL,
  `nim_mhs` varchar(10) DEFAULT NULL,
  `nim_mentor` varchar(10) DEFAULT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `nilai` float DEFAULT 0,
  `komentar` text DEFAULT 'Tidak ada komentar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian_tugas`
--

INSERT INTO `penilaian_tugas` (`id_pengumpulan`, `nim_mhs`, `nim_mentor`, `id_tugas`, `file_path`, `nilai`, `komentar`) VALUES
(3, '2410512107', '2310512096', 1, 'Uploads/Link Pengumpulan Video Presentasi - 2310512095 (1).pdf', 100, 'Tidak ada komentar...');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `nim_mhs` varchar(10) DEFAULT NULL,
  `tanggal_presensi` date NOT NULL,
  `status_presensi` enum('Hadir','Tidak Hadir','Izin') NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `role` enum('mahasiswa','mentor') NOT NULL,
  `nim_user` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `kelompok` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `role`, `nim_user`, `email`, `password`, `kelompok`) VALUES
(1, 'mahasiswa', '2410512107', '2410512107@mahasiswa.upnvj.ac.id', 'password123', 1),
(2, 'mentor', '2310512096', '2310512096@mahasiswa.upnvj.ac.id', 'securepass456', 1),
(3, 'mahasiswa', '2410512095', '2410512095@mahasiswa.upnvj.ac.id', 'mypass789', 1),
(4, 'mentor', '2310512100', '2310512100@mahasiswa.upnvj.ac.id', 'mentorpass001', 2),
(5, 'mahasiswa', '2410512119', '2410512119@mahasiswa.upnvj.ac.id', 'password999', 2),
(6, 'mentor', '2310512120', '2310512120@mahasiswa.upnvj.ac.id', 'mentorlagi123', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `katalog_tugas`
--
ALTER TABLE `katalog_tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim_mhs`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`nim_mentor`),
  ADD UNIQUE KEY `kelompok` (`kelompok`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `penilaian_tugas`
--
ALTER TABLE `penilaian_tugas`
  ADD PRIMARY KEY (`id_pengumpulan`),
  ADD KEY `nim_mhs` (`nim_mhs`),
  ADD KEY `nim_mentor` (`nim_mentor`),
  ADD KEY `id_tugas` (`id_tugas`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `nim_mhs` (`nim_mhs`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `nim` (`nim_user`),
  ADD UNIQUE KEY `nim_user` (`nim_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `katalog_tugas`
--
ALTER TABLE `katalog_tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penilaian_tugas`
--
ALTER TABLE `penilaian_tugas`
  MODIFY `id_pengumpulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `mentor`
--
ALTER TABLE `mentor`
  ADD CONSTRAINT `mentor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian_tugas`
--
ALTER TABLE `penilaian_tugas`
  ADD CONSTRAINT `penilaian_tugas_ibfk_1` FOREIGN KEY (`nim_mhs`) REFERENCES `mahasiswa` (`nim_mhs`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_tugas_ibfk_2` FOREIGN KEY (`nim_mentor`) REFERENCES `mentor` (`nim_mentor`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_tugas_ibfk_3` FOREIGN KEY (`id_tugas`) REFERENCES `katalog_tugas` (`id_tugas`) ON DELETE CASCADE;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`nim_mhs`) REFERENCES `mahasiswa` (`nim_mhs`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
