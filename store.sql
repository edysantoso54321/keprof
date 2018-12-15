-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2018 at 04:20 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `tipe` varchar(15) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `harga`, `tipe`, `gambar`, `stok`, `deskripsi`) VALUES
(3, 'sound portable (hitam)', 100000, 'sewa', '5c0f1a70170b7.jpg', 1, 'sound portable ini cocok untuk berbagai acara misalnya acara-acara ukm atau organisasi lainnya. dalam acara rapat, musyawarah dan lain-lain'),
(4, 'gantungan kunci telkom university', 10000, 'jual', '5c0f1af968879.jpg', 100, 'gantungan kunci telkom university cocok bagi siapa saja yang ingin memilikinya. terlihat cantik dan menawan pada kunci anda'),
(5, 'gantungan kunci', 10000, 'jual', '5c0f1b41649fd.jpg', 100, 'gantungan kunci ini cocok bagi yang suka dengan kata-kata.\r\ncocok untuk kunci motor, kunci kos, kunci kontrakan.'),
(6, 'jaket', 150000, 'jual', '5c0f1b9366914.jpg', 100, 'jaket telkom yang mempesona ini sangat cocok dimusim dingin seperti ini'),
(7, 'binder', 80000, 'jual', '5c0f1bf574606.jpg', 100, 'binder buku yang cantik ini cocok untuk buku kamu. agar terlihat lebih cantik dan menawan.'),
(8, 'tas', 25000, 'jual', '5c0f1c3cab5c8.jpg', 100, 'tas ini cocok bagi kamu yang tidak mau ribet. tas yang simple ini sangat mudah dibawa kemana-mana.'),
(9, 'kaos kaki tapak hitam', 8000, 'jual', '5c0f372195921.jpg', 100, 'kaos kaki tapak hitam sangat cocok bagi kalian para pejuang kampus.'),
(10, 'proyektor', 60000, 'sewa', '5c0f1cdc41671.jpg', 1, 'bagi kalian pengurus organisasi atau yang lain. proyektor ini sangat cocok untuk acara kecil maupun besar.'),
(11, 'layar tripod', 60000, 'sewa', '5c0f1d1db6810.jpg', 1, 'sangat diperlukan agar tampilan proyektor terlihat lebih rapi.'),
(12, 'handy talkie', 10000, 'sewa', '5c0f1d6098325.jpg', 1, 'bagi kalian penggiat organisasi kampus maupun kemahasiswaan. handy talkie ini sangat berguna untuk komunikasi.');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id_barang` int(10) NOT NULL,
  `persen_disc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id_barang`, `persen_disc`) VALUES
(6, 20),
(8, 30);

-- --------------------------------------------------------

--
-- Table structure for table `formulir`
--

CREATE TABLE `formulir` (
  `nama` varchar(50) NOT NULL,
  `nim` int(10) NOT NULL,
  `id_line` varchar(50) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formulir`
--

INSERT INTO `formulir` (`nama`, `nim`, `id_line`, `id_transaksi`, `status`) VALUES
('qwe', 123456, 'qwe', 'b41a823f44901', 'kredit'),
('qwe', 123, 'qwe', '0bf3e4032fac4', 'kredit'),
('qwe', 121, 'qwe', '96f4046b5121c', 'kredit');

-- --------------------------------------------------------

--
-- Table structure for table `shop_chart`
--

CREATE TABLE `shop_chart` (
  `jumlah` int(11) NOT NULL,
  `durasi_sewa` int(11) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `id_transaksi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_chart`
--

INSERT INTO `shop_chart` (`jumlah`, `durasi_sewa`, `id_barang`, `tgl_peminjaman`, `id_transaksi`) VALUES
(0, 5, 3, '2018-12-22', 'b41a823f44901'),
(0, 4, 3, '2018-12-15', '0bf3e4032fac4'),
(10, 0, 6, '0000-00-00', '96f4046b5121c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `shop_chart`
--
ALTER TABLE `shop_chart`
  ADD KEY `id_barang` (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `shop_chart`
--
ALTER TABLE `shop_chart`
  ADD CONSTRAINT `shop_chart_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `shop_chart_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
