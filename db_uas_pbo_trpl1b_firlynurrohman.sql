-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 01:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1b_firlynurrohman`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hari_kerja_masuk` date NOT NULL,
  `gaji_dasar_per_hari` decimal(15,2) NOT NULL,
  `jenis_karyawan` enum('Kontrak','Tetap','Magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(100) DEFAULT NULL,
  `tunjangan_kesehatan` decimal(15,2) DEFAULT NULL,
  `opsi_saham_id` varchar(50) DEFAULT NULL,
  `uang_saku_bulanan` decimal(15,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
(1, 'Budi Santoso', 'IT', '2024-01-15', '250000.00', 'Kontrak', 12, 'PT Teknologi Jaya', '500000.00', NULL, NULL, NULL),
(2, 'Siti Rahayu', 'HRD', '2024-02-01', '200000.00', 'Kontrak', 6, 'PT Sumber Daya Manusia', '400000.00', NULL, NULL, NULL),
(3, 'Ahmad Fauzi', 'Marketing', '2024-03-10', '230000.00', 'Kontrak', 12, 'PT Pemasaran Digital', '450000.00', NULL, NULL, NULL),
(4, 'Dewi Lestari', 'Finance', '2024-04-05', '260000.00', 'Kontrak', 8, 'PT Keuangan Sejahtera', '550000.00', NULL, NULL, NULL),
(5, 'Rudi Hermawan', 'IT', '2024-05-20', '270000.00', 'Kontrak', 10, 'PT Solusi Teknologi', '600000.00', NULL, NULL, NULL),
(6, 'Maya Anggraini', 'HRD', '2024-06-12', '210000.00', 'Kontrak', 7, 'PT Human Capital', '420000.00', NULL, NULL, NULL),
(7, 'Andi Wijaya', 'Operasional', '2024-07-01', '240000.00', 'Kontrak', 9, 'PT Operasi Prima', '480000.00', NULL, NULL, NULL),
(8, 'Dr. Ir. Haryanto', 'Direksi', '2020-01-10', '500000.00', 'Tetap', NULL, NULL, '2000000.00', 'SAHAM001', NULL, NULL),
(9, 'Prof. Dr. Sri Mulyani', 'Finance', '2019-06-15', '450000.00', 'Tetap', NULL, NULL, '1800000.00', 'SAHAM002', NULL, NULL),
(10, 'Ir. Bambang Supriyadi', 'IT', '2021-03-01', '400000.00', 'Tetap', NULL, NULL, '1500000.00', 'SAHAM003', NULL, NULL),
(11, 'Dra. Ratna Dewi', 'HRD', '2020-08-20', '380000.00', 'Tetap', NULL, NULL, '1400000.00', 'SAHAM004', NULL, NULL),
(12, 'Drs. Agus Salim', 'Marketing', '2019-11-01', '420000.00', 'Tetap', NULL, NULL, '1600000.00', 'SAHAM005', NULL, NULL),
(13, 'Ir. Joko Widodo', 'Operasional', '2021-05-10', '390000.00', 'Tetap', NULL, NULL, '1450000.00', 'SAHAM006', NULL, NULL),
(14, 'Dr. Susi Pudjiastuti', 'IT', '2020-12-01', '460000.00', 'Tetap', NULL, NULL, '1900000.00', 'SAHAM007', NULL, NULL),
(15, 'Fitriana Putri', 'IT', '2024-09-01', '100000.00', 'Magang', NULL, NULL, NULL, NULL, '1500000.00', 'KM-2024-001'),
(16, 'Rizki Pratama', 'Marketing', '2024-09-15', '90000.00', 'Magang', NULL, NULL, NULL, NULL, '1300000.00', 'KM-2024-002'),
(17, 'Nadia Safitri', 'HRD', '2024-10-01', '95000.00', 'Magang', NULL, NULL, NULL, NULL, '1400000.00', 'KM-2024-003'),
(18, 'Fajar Nugroho', 'Finance', '2024-10-15', '85000.00', 'Magang', NULL, NULL, NULL, NULL, '1200000.00', 'KM-2024-004'),
(19, 'Citra Kirana', 'IT', '2024-11-01', '110000.00', 'Magang', NULL, NULL, NULL, NULL, '1600000.00', 'KM-2024-005'),
(20, 'Dian Puspita', 'Operasional', '2024-11-15', '88000.00', 'Magang', NULL, NULL, NULL, NULL, '1250000.00', 'KM-2024-006');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
