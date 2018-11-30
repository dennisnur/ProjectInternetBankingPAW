-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Nov 2018 pada 13.18
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `USERNAME_ADM` varchar(64) COLLATE utf8_bin NOT NULL,
  `PASSWORD_ADM` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`USERNAME_ADM`, `PASSWORD_ADM`) VALUES
('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `ID_CUST` int(11) NOT NULL,
  `NAMA` varchar(100) COLLATE utf8_bin NOT NULL,
  `JENIS_KELAMIN` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `TANGGAL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `EMAIL` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `NO_TELP` char(12) COLLATE utf8_bin DEFAULT NULL,
  `USERNAME_CUST` varchar(64) COLLATE utf8_bin NOT NULL,
  `PASSWORD_CUST` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`ID_CUST`, `NAMA`, `JENIS_KELAMIN`, `TANGGAL_LAHIR`, `ALAMAT`, `EMAIL`, `NO_TELP`, `USERNAME_CUST`, `PASSWORD_CUST`) VALUES
(1, 'Dennis Thandy', 'Laki-Laki', '2017-10-24', 'dennisthandy@yahoo.co.id', 'Bojonegoro', '082234266892', 'dennis', 'b56f3b8a7b87e7f880091bc76972621b62fa75039688a6585f3c9ac11b1b0891'),
(2, 'Thandy Dennis', 'Laki-Laki', '1996-10-01', 'example@gmail.com', 'Bojonegoro', '082234366892', 'thandy', '4e65d94a3278a5141b37b6d9b254713189a8e68809bd644269a72b63a840e745');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_transaksi`
--

CREATE TABLE `daftar_transaksi` (
  `ID_TRANSAKSI` int(11) NOT NULL,
  `ID_STATUS` int(11) DEFAULT NULL,
  `NO_REK_PENGIRIM` char(16) COLLATE utf8_bin DEFAULT NULL,
  `NO_REK_PENERIMA` char(16) COLLATE utf8_bin DEFAULT NULL,
  `JUMLAH_UANG` float NOT NULL,
  `TANGGAL` date DEFAULT NULL,
  `WAKTU` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `SALDO_AKHIR` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `daftar_transaksi`
--

INSERT INTO `daftar_transaksi` (`ID_TRANSAKSI`, `ID_STATUS`, `NO_REK_PENGIRIM`, `NO_REK_PENERIMA`, `JUMLAH_UANG`, `TANGGAL`, `WAKTU`, `SALDO_AKHIR`) VALUES
(1, 1, '1111222267676767', '1111222289898989', 50000, '2018-11-26', '2018-11-26 01:12:31', 2147430000),
(2, 2, '1111222289898989', '1111222267676767', 50000, '2018-11-26', '2018-11-26 01:12:31', 50000),
(3, 1, '1111222298989898', '1111222267676767', 50000, '2018-11-26', '2018-11-26 02:04:46', 900000),
(4, 2, '1111222267676767', '1111222298989898', 50000, '2018-11-26', '2018-11-26 02:04:46', 2147480000),
(5, 1, '1111222267676767', '1111222289898989', 50000, '2018-11-26', '2018-11-26 04:56:38', 2147430000),
(6, 2, '1111222289898989', '1111222267676767', 50000, '2018-11-26', '2018-11-26 04:56:38', 100000),
(7, 1, '1111222289898989', '1111222267676767', 50000, '2018-11-27', '2018-11-27 06:17:52', 50000),
(8, 2, '1111222267676767', '1111222289898989', 50000, '2018-11-27', '2018-11-27 06:17:52', 2147480000),
(9, 1, '1111222298989898', '1111222267676767', 50000, '2018-11-27', '2018-11-27 07:53:20', 850000),
(10, 2, '1111222267676767', '1111222298989898', 50000, '2018-11-27', '2018-11-27 07:53:21', 2147530000),
(11, 1, '1111222267676767', '1111222289898989', 100000, '2018-11-27', '2018-11-27 14:59:13', 2147380000),
(12, 2, '1111222289898989', '1111222267676767', 100000, '2018-11-27', '2018-11-27 14:59:13', 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `ID_STATUS` int(11) NOT NULL,
  `KETERANGAN` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`ID_STATUS`, `KETERANGAN`) VALUES
(1, 'Debet'),
(2, 'Kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `NO_REK` char(16) COLLATE utf8_bin NOT NULL,
  `ID_CUST` int(11) DEFAULT NULL,
  `SALDO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`NO_REK`, `ID_CUST`, `SALDO`) VALUES
('1111222267676767', 2, 2147380000),
('1111222289898989', 1, 150000),
('1111222298989898', 1, 850000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`USERNAME_ADM`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID_CUST`);

--
-- Indeks untuk tabel `daftar_transaksi`
--
ALTER TABLE `daftar_transaksi`
  ADD PRIMARY KEY (`ID_TRANSAKSI`),
  ADD KEY `FK_MENCATAT_JENIS_TRANSAKSI` (`ID_STATUS`),
  ADD KEY `FK_MENCATAT_PENERIMA` (`NO_REK_PENERIMA`),
  ADD KEY `FK_MENCATAT_PENGIRIM` (`NO_REK_PENGIRIM`);

--
-- Indeks untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`ID_STATUS`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`NO_REK`),
  ADD KEY `FK_PUNYA_BANYAK_REKENING` (`ID_CUST`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `ID_CUST` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `daftar_transaksi`
--
ALTER TABLE `daftar_transaksi`
  MODIFY `ID_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `ID_STATUS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_transaksi`
--
ALTER TABLE `daftar_transaksi`
  ADD CONSTRAINT `FK_MENCATAT_JENIS_TRANSAKSI` FOREIGN KEY (`ID_STATUS`) REFERENCES `jenis_transaksi` (`ID_STATUS`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_MENCATAT_PENERIMA` FOREIGN KEY (`NO_REK_PENERIMA`) REFERENCES `rekening` (`NO_REK`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_MENCATAT_PENGIRIM` FOREIGN KEY (`NO_REK_PENGIRIM`) REFERENCES `rekening` (`NO_REK`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD CONSTRAINT `FK_PUNYA_BANYAK_REKENING` FOREIGN KEY (`ID_CUST`) REFERENCES `customer` (`ID_CUST`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
