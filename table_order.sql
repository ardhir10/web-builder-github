-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02 Des 2018 pada 21.28
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_web_builder`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_order`
--

CREATE TABLE `table_order` (
  `ID` int(11) NOT NULL,
  `no_order` varchar(200) NOT NULL,
  `id_website` int(11) NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `id_package` int(11) NOT NULL,
  `nama_package` varchar(255) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `expired` datetime NOT NULL,
  `harga` int(11) NOT NULL,
  `type_order` varchar(150) NOT NULL,
  `tanggal_order` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_order`
--

INSERT INTO `table_order` (`ID`, `no_order`, `id_website`, `nama_website`, `id_user`, `status`, `id_package`, `nama_package`, `jumlah_bayar`, `bukti_pembayaran`, `expired`, `harga`, `type_order`, `tanggal_order`) VALUES
(20, 'PBL20181543780421-1', 151, 'My Website', 1, 1, 5, 'Publish Website', 0, '', '0000-00-00 00:00:00', 50000, 'publish', '2018-12-03 02:53:41'),
(22, 'PKG20181543781140-1', 0, '-', 1, 1, 2, 'Premium', 0, '', '0000-00-00 00:00:00', 250000, 'package', '2018-12-03 03:05:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_order`
--
ALTER TABLE `table_order`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_order`
--
ALTER TABLE `table_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
