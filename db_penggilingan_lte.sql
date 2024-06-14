-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 03:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penggilingan_lte`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_barang`
--

CREATE TABLE `t_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `id_jenis` int(50) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `berat_kotor` int(11) NOT NULL,
  `tgl_diterima` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_barang`
--

INSERT INTO `t_barang` (`id_barang`, `kode_barang`, `id_jenis`, `id_pelanggan`, `berat_kotor`, `tgl_diterima`, `status`) VALUES
(50, 'BRG00001', 14, 56, 100, '2024-06-12 17:44:00', 3),
(51, 'BRG00002', 15, 57, 100, '2024-06-12 17:44:00', 3),
(52, 'BRG00003', 16, 58, 100, '2024-06-12 17:44:00', 3),
(53, 'BRG00004', 14, 56, 100, '2024-06-12 20:56:00', 0),
(54, 'BRG00005', 20, 59, 200, '1970-01-01 07:00:00', 3),
(55, 'BRG00006', 14, 56, 45, '1970-01-01 07:00:00', 3),
(56, 'BRG00007', 14, 56, 100, '1970-01-01 07:00:00', 3),
(57, 'BRG00008', 14, 56, 66, '1970-01-01 07:00:00', 0),
(58, 'BRG00009', 14, 56, 11, '1970-01-01 07:00:00', 0),
(59, 'BRG00010', 14, 56, 66, '1970-01-01 07:00:00', 0),
(60, 'BRG00011', 14, 56, 5656, '1970-01-15 07:00:00', 0),
(61, 'BRG00012', 14, 56, 111, '2024-06-13 01:12:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis`
--

CREATE TABLE `t_jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis`
--

INSERT INTO `t_jenis` (`id_jenis`, `nama_jenis`, `harga`) VALUES
(14, 'Padi 1', 5000),
(15, 'Padi 2', 4000),
(16, 'Padi 3', 1000),
(17, 'Padi 4', 6000),
(20, 'Padi 5', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggan`
--

CREATE TABLE `t_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `kode_pelanggan` varchar(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pelanggan`
--

INSERT INTO `t_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `nama_pelanggan`, `alamat`, `no_hp`, `tgl_daftar`) VALUES
(56, 'PLG00001', 'A1', 'Malang', '001', '2024-06-12 17:42:52'),
(57, 'PLG00002', 'A2', 'Malang', '002', '2024-06-12 17:43:08'),
(58, 'PLG00003', 'A3', 'Malang', '003', '2024-06-12 17:43:30'),
(59, 'PLG00004', 'A4', 'Malang', '004', '2024-06-13 00:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembayaran`
--

CREATE TABLE `t_pembayaran` (
  `id_pembayaran` int(50) NOT NULL,
  `kode_pembayaran` varchar(20) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `total_all` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembayaran`
--

INSERT INTO `t_pembayaran` (`id_pembayaran`, `kode_pembayaran`, `id_pelanggan`, `total_all`, `bayar`, `kembali`, `tgl_bayar`) VALUES
(63, 'INV24061300001', 57, 400000, 0, 0, '2024-06-13 00:20:50'),
(64, 'INV24061300002', 56, 50000, 500000, 450000, '2024-06-13 00:41:39'),
(65, 'INV24061300003', 58, 99000, 99000, 0, '2024-06-13 00:42:34'),
(66, 'INV24061300004', 59, 150000, 200000, 50000, '2024-06-13 00:58:10'),
(67, 'INV24061300005', 56, 725000, 1000000, 275000, '2024-06-13 01:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembayaran_detail`
--

CREATE TABLE `t_pembayaran_detail` (
  `id_pembayaran_detail` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `berat_kotor` int(11) NOT NULL,
  `berat_bersih` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembayaran_detail`
--

INSERT INTO `t_pembayaran_detail` (`id_pembayaran_detail`, `id_pembayaran`, `id_barang`, `berat_kotor`, `berat_bersih`, `harga`, `total`) VALUES
(40, 63, 51, 100, 100, 4000, 400000),
(41, 64, 50, 100, 10, 5000, 50000),
(42, 65, 52, 100, 99, 1000, 99000),
(43, 66, 54, 200, 150, 1000, 150000),
(44, 67, 55, 45, 45, 5000, 225000),
(45, 67, 56, 100, 100, 5000, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `t_proses`
--

CREATE TABLE `t_proses` (
  `id_proses` int(11) NOT NULL,
  `kode_proses` varchar(20) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `berat_kotor` int(11) NOT NULL,
  `berat_bersih` int(11) NOT NULL,
  `tgl_proses` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_proses`
--

INSERT INTO `t_proses` (`id_proses`, `kode_proses`, `id_barang`, `id_pelanggan`, `berat_kotor`, `berat_bersih`, `tgl_proses`, `tgl_selesai`) VALUES
(69, 'PRS24061200001', 50, 56, 100, 10, '2024-06-12 21:18:00', '2024-06-12 21:21:00'),
(75, 'PRS24061200001', 51, 57, 100, 100, '2024-06-12 22:08:00', '2024-06-12 22:09:00'),
(76, 'PRS24061200001', 52, 58, 100, 99, '2024-06-12 22:09:00', '2024-06-12 22:09:00'),
(77, 'PRS70010100001', 54, 59, 200, 150, '1970-01-01 07:00:00', '1970-01-01 07:00:00'),
(78, 'PRS13062400001', 55, 56, 45, 45, '2024-06-13 01:14:00', '2024-06-13 01:13:00'),
(79, 'PRS24061300002', 56, 56, 100, 100, '2024-06-13 01:16:00', '2024-06-13 01:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `role_id` int(11) NOT NULL,
  `akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`role_id`, `akses`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'pemilik'),
(4, 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `nama`, `username`, `password`, `role_id`) VALUES
(6, 'Khamal', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 4),
(7, 'Yai', 'pemilik', '58399557dae3c60e23c78606771dfa3d', 3),
(8, 'Haikal', 'admin', '21232f297a57a5a743894a0e4a801fc3', 2),
(9, 'Angler Laut Selatan', 'Angler', '17c4520f6cfd1ab53d8745e84681eb49', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_barang`
--
ALTER TABLE `t_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `t_jenis`
--
ALTER TABLE `t_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `t_pembayaran_detail`
--
ALTER TABLE `t_pembayaran_detail`
  ADD PRIMARY KEY (`id_pembayaran_detail`);

--
-- Indexes for table `t_proses`
--
ALTER TABLE `t_proses`
  ADD PRIMARY KEY (`id_proses`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_barang`
--
ALTER TABLE `t_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `t_jenis`
--
ALTER TABLE `t_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  MODIFY `id_pembayaran` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `t_pembayaran_detail`
--
ALTER TABLE `t_pembayaran_detail`
  MODIFY `id_pembayaran_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `t_proses`
--
ALTER TABLE `t_proses`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
