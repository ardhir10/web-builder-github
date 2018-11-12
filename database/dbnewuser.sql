-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 Nov 2018 pada 11.53
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `status` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_users`
--

INSERT INTO `table_users` (`ID`, `nama`, `username`, `email`, `password`, `no_telp`, `nama_web`, `status`, `gambar`, `tanggal_daftar`, `expired`) VALUES
(1, 'Ardhi Ramadhan', 'ardhir10', 'ramadhn10@gmail.com', '2b88c029dfc5805ad6ca4201c663ea71', '082113666778', '', 1, '', '2018-11-08 19:38:02', '2018-11-08 19:38:02'),
(2, 'faiz', 'username', 'email@e', '9d4d4ab0dfdb72a54b895d78b90b09c7', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'faiz', 'faizseeguns@gmail.com', 'faizseeguns@gmail.com', '9d4d4ab0dfdb72a54b895d78b90b09c7', '', '', 0, '', '2018-11-12 10:40:36', '0000-00-00 00:00:00'),
(7, 'faiz', 'admin@e', 'admin@e', '21232f297a57a5a743894a0e4a801fc3', '', '', 0, '', '2018-11-12 10:51:37', '0000-00-00 00:00:00'),
(8, 'faiz', 'faiz@gmail.com', 'faiz@gmail.com', '9d4d4ab0dfdb72a54b895d78b90b09c7', '', '', 0, '', '2018-11-12 10:52:04', '0000-00-00 00:00:00'),
(9, 'rama', 'rama1', 'rama@gmail.com', 'e04f28cc33cb20274dd3ff44e600a923', '123', 'webku', 0, 'dummy', '2018-11-12 11:07:22', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `table_users`
--
ALTER TABLE `table_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
