-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2018 at 01:56 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `barang_id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `cara_perolehan` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`barang_id`, `nama_barang`, `kategori_id`, `jumlah`, `gambar`, `satuan`, `cara_perolehan`, `deskripsi`) VALUES
(1, 'Lampu', 3, 1, '15148553271.jpg', 'buah', 'beli', 'lampu ini di berikan untuk ruangan yang memiliki daya listrik yang sulit di jangkayu sehingga lampu ini bisa di tempatkan pada ruangan tersebut'),
(2, 'mouse', 3, 24, '15152503122.jpg', 'pcs', 'beli', 'Mouse ini merupakan mouse yang sering di gunakan untuk menggerakan pointer yang ada di komputer'),
(3, 'CPU', 1, 5, 'lampu.jpg', 'buah', 'beli', 'ini adalah cpu mahal yang harus tetap di jaga kelestariannya agar tidak punah'),
(9, 'Kursi', 6, 5, '15145982649.jpg', 'buah', 'Hibah', 'ini adalah kursi yang memiliki kualitas yang sangat bagus'),
(10, 'Meja', 6, 5, '151462142110.jpg', 'buah', 'Hibah', 'ini adalah Meja yang memiliki kualitas yang sangat bagus'),
(11, 'Lampu Philip', 3, 5, 'cdm.PNG', 'buah', 'beli', 'ini lampu baru');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kategori_id`, `nama_kategori`, `keterangan`) VALUES
(1, 'Hardware', 'Berbentuk PC'),
(2, 'Kertas', 'ini kertas'),
(3, 'Elektronik', 'ini elektronik'),
(4, 'Mudah Rusak', 'Jangan Sering Di Pinjamkan'),
(5, 'Mudah Pecah', 'Jangan sering di pinjamkan'),
(6, 'Kayu', 'Berbahan kayu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjam`
--

CREATE TABLE `tb_pinjam` (
  `pinjam_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah_barang` int(15) NOT NULL,
  `tanggal_pengambilan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pinjam`
--

INSERT INTO `tb_pinjam` (`pinjam_id`, `barang_id`, `jumlah_barang`, `tanggal_pengambilan`) VALUES
(631521718, 2, 6, '2018-04-16'),
(1221878725, 2, 5, '2018-01-15'),
(1279432242, 2, 5, '2018-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `pinjam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `alasan` text NOT NULL,
  `persetujuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`transaksi_id`, `pinjam_id`, `user_id`, `alasan`, `persetujuan`) VALUES
(41, 1279432242, 5, 'untuk kelas', 'selesai'),
(42, 1221878725, 7, 'penting', 'selesai'),
(43, 631521718, 1, 'lap', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`, `nama`, `email`, `level`) VALUES
(1, 'iqbalcakep', 'iqbal123', 'Muhammad Iqbal', 'admin@iqbalcakep.com', 'admin'),
(2, 'intan123', 'intan123', 'Intan Muslimah 404', 'intan@iqbalcakep.com', 'user'),
(3, 'benibaru1', 'beni123', 'M beny Pangestoe', 'beny@gmail.com', 'user'),
(4, 'hyldan', 'hyldan123', 'Hyldan Doyok', 'hyldan@gmail.com', 'user'),
(5, 'rio', '123', 'rio irv', 'rioirvansyah6@gmail.com', 'user'),
(6, 'Nina Bobo', 'ninaae', 'Faninana', 'fanina@yahoo.com', 'user'),
(7, 'clara', 'clara', 'clara', 'claranadya123@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD PRIMARY KEY (`pinjam_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `pinjam_id` (`pinjam_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  MODIFY `pinjam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1279432243;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategori` (`kategori_id`);

--
-- Constraints for table `tb_pinjam`
--
ALTER TABLE `tb_pinjam`
  ADD CONSTRAINT `tb_pinjam_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `tb_barang` (`barang_id`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`pinjam_id`) REFERENCES `tb_pinjam` (`pinjam_id`),
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
