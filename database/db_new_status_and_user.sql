-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Nov 2018 pada 05.51
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
-- Struktur dari tabel `table_status`
--

CREATE TABLE `table_status` (
  `ID` int(11) NOT NULL,
  `keterangan_status` varchar(100) NOT NULL,
  `index_color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_status`
--

INSERT INTO `table_status` (`ID`, `keterangan_status`, `index_color`) VALUES
(1, 'Trial', 'info'),
(2, 'Aktif', 'success'),
(3, 'Suspened', 'danger');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_users`
--

CREATE TABLE `table_users` (
  `ID` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `nama_web` varchar(200) NOT NULL,
  `id_status` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_users`
--

INSERT INTO `table_users` (`ID`, `nama`, `username`, `email`, `password`, `no_telp`, `nama_web`, `id_status`, `gambar`, `tanggal_daftar`, `expired`) VALUES
(1, 'Ardhi Ramadhan', 'ardhir10', 'ramadhn10@gmail.com', '2b88c029dfc5805ad6ca4201c663ea71', '082113666778', '', 1, '', '2018-11-08 19:38:02', '2018-11-08 19:38:02'),
(6, 'faiz', 'faizseeguns@gmail.com', 'faizseeguns@gmail.com', '9d4d4ab0dfdb72a54b895d78b90b09c7', '', '', 3, '', '2018-11-12 10:40:36', '0000-00-00 00:00:00'),
(10, 'Ardhi Ramadhan', 'rmdhan95@gmail.com', 'rmdhan95@gmail.com', 'e04f28cc33cb20274dd3ff44e600a923', '', '', 2, '', '2018-11-12 12:04:57', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_status`
--
ALTER TABLE `table_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_users`
--
ALTER TABLE `table_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_status`
--
ALTER TABLE `table_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_users`
--
ALTER TABLE `table_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
