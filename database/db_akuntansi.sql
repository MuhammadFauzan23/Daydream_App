-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_akuntansi
CREATE DATABASE IF NOT EXISTS `db_akuntansi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_akuntansi`;

-- Dumping structure for table db_akuntansi.akun
CREATE TABLE IF NOT EXISTS `akun` (
  `nama_akun` varchar(255) NOT NULL,
  `no_reff` int(10) NOT NULL,
  `ket_akun` varchar(255) NOT NULL,
  PRIMARY KEY (`no_reff`),
  KEY `nama_akun` (`nama_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_akuntansi.akun: ~26 rows (approximately)
INSERT INTO `akun` (`nama_akun`, `no_reff`, `ket_akun`) VALUES
	('101-KAS DI TANGAN', 101, 'DEBIT'),
	('105-KAS DI BANK', 105, 'KREDIT'),
	('126-PERSEDIAAN', 126, 'DEBIT'),
	('129-SEWA BAYAR DI MUKA', 129, 'DEBIT'),
	('130-ASURANSI BAYAR DIMUKA', 130, 'DEBIT'),
	('153-PERLENGKAPAN', 153, 'DEBIT'),
	('154-PENUSUTAN PERALATAN', 154, 'DEBIT'),
	('200-UTANG WESEL', 200, 'KREDIT'),
	('201-HUTANG', 201, 'KREDIT'),
	('209-PENDAPATAN DITERIMA DI MUKA', 209, 'KREDIT'),
	('212-HUTANG GAJI', 212, 'KREDIT'),
	('230-HUTANG BUNGA', 230, 'KREDIT'),
	('311-MODAL', 311, 'KREDIT'),
	('332-DIVIDEN', 332, 'KREDIT'),
	('400-PENDAPATAN JASA', 400, 'KREDIT'),
	('401-PENJUALAN', 401, 'KREDIT'),
	('610-BEBAN IKLAN', 610, 'DEBIT'),
	('621-BEBAN PENYUSUTAN PERALATAN', 621, 'DEBIT'),
	('631-BEBAN PERSEDIAAN', 631, 'DEBIT'),
	('726-BEBAN GAJI', 726, 'DEBIT'),
	('729-BEBAN SEWA', 729, 'DEBIT'),
	('730-BEBAN ASURANSI', 730, 'DEBIT'),
	('731-BIAYA UTILITAS', 731, 'DEBIT'),
	('735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN', 735, 'DEBIT'),
	('740-BIAYA BENSIN', 740, 'DEBIT'),
	('741-BEBAN BUNGA', 741, 'DEBIT');

-- Dumping structure for table db_akuntansi.backup
CREATE TABLE IF NOT EXISTS `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date NOT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 NOT NULL,
  `no_akun` int(10) NOT NULL,
  `nama_akun` varchar(255) CHARACTER SET latin1 NOT NULL,
  `saldo` int(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `umkm` enum('Sumber Agung Parahyangan','','','') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tgl_transaksi` (`tgl_transaksi`),
  KEY `no_akun` (`no_akun`),
  KEY `nama_akun` (`nama_akun`),
  KEY `saldo` (`saldo`),
  KEY `jenis` (`jenis`),
  KEY `user_id` (`user_id`),
  KEY `umkm` (`umkm`),
  CONSTRAINT `backup_1` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_reff`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `backup_2` FOREIGN KEY (`user_id`) REFERENCES `user2` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=341 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_akuntansi.backup: ~44 rows (approximately)
INSERT INTO `backup` (`id`, `tgl_transaksi`, `keterangan`, `no_akun`, `nama_akun`, `saldo`, `jenis`, `user_id`, `umkm`) VALUES
	(223, '0000-00-00', 'Membeli Persediaan', 631, '631-BEBAN PERSEDIAAN', 100000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(224, '0000-00-00', 'Membeli Persediaan', 101, '101-KAS DI TANGAN', 100000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(227, '0000-00-00', 'Penjualan', 401, '401-PENJUALAN', 250000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(228, '0000-00-00', 'Penjualan', 126, '126-PERSEDIAAN', 250000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(231, '0000-00-00', 'Membeli Tabung Gas', 631, '631-BEBAN PERSEDIAAN', 36000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(232, '0000-00-00', 'Membeli Tabung Gas', 101, '101-KAS DI TANGAN', 36000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(235, '0000-00-00', 'Membeli Bahan Bakar ', 740, '740-BIAYA BENSIN', 30000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(236, '0000-00-00', 'Membeli Bahan Bakar ', 101, '101-KAS DI TANGAN', 30000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(239, '0000-00-00', 'Penjualan Harian', 401, '401-PENJUALAN', 300000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(240, '0000-00-00', 'Penjualan Harian', 126, '126-PERSEDIAAN', 300000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(243, '0000-00-00', 'Biaya Bahan Bakar ', 740, '740-BIAYA BENSIN', 20000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(244, '0000-00-00', 'Biaya Bahan Bakar ', 101, '101-KAS DI TANGAN', 20000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(275, '2023-07-03', 'Membeli Persediaan', 126, 'Masukkan Nama Akun', 150000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(276, '2023-07-03', 'Membeli Persediaan', 101, 'Masukkan Nama Akun', 150000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(279, '2023-07-03', 'Penjualan selama sehari', 401, '401-PENJUALAN', 250000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(280, '2023-07-03', 'Penjualan selama sehari', 126, '126-PERSEDIAAN', 250000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(283, '2023-07-03', 'Biaya bensin ', 740, '740-BIAYA BENSIN', 30000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(284, '2023-07-03', 'Biaya bensin ', 101, '101-KAS DI TANGAN', 30000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(287, '2023-07-04', 'Membeli Styrofoam Box', 126, '126-PERSEDIAAN', 50000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(288, '2023-07-04', 'Membeli Styrofoam Box', 101, '101-KAS DI TANGAN', 50000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(291, '2023-07-04', 'Penjualan selama sehari', 401, 'Masukkan Nama Akun', 200000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(292, '2023-07-04', 'Penjualan selama sehari', 126, 'Masukkan Nama Akun', 200000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(295, '2023-07-05', 'Membeli Tabung Gas', 126, '126-PERSEDIAAN', 36000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(296, '2023-07-05', 'Membeli Tabung Gas', 101, '101-KAS DI TANGAN', 36000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(299, '2023-07-05', 'Bensin motor', 740, '740-BIAYA BENSIN', 25000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(300, '2023-07-05', 'Bensin motor', 101, '101-KAS DI TANGAN', 25000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(303, '2023-07-06', 'Penjualan selama sehari', 401, '401-PENJUALAN', 215000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(304, '2023-07-06', 'Penjualan selama sehari', 126, '126-PERSEDIAAN', 215000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(307, '2023-07-05', 'Penjualan selama sehari', 401, '401-PENJUALAN', 195000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(308, '2023-07-05', 'Penjualan selama sehari', 126, '126-PERSEDIAAN', 195000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(311, '2023-07-06', 'Menambah persediaan', 126, '126-PERSEDIAAN', 50000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(312, '2023-07-06', 'Menambah persediaan', 101, '101-KAS DI TANGAN', 50000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(315, '2023-07-07', 'Membeli telur ', 126, '126-PERSEDIAAN', 58000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(316, '2023-07-07', 'Membeli telur ', 101, '101-KAS DI TANGAN', 58000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(319, '2023-07-07', 'Penjualan sehari', 401, '401-PENJUALAN', 230000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(320, '2023-07-07', 'Penjualan sehari', 101, '101-KAS DI TANGAN', 230000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(323, '2023-07-04', 'Penjualan sehari', 401, '401-PENJUALAN', 200000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(324, '2023-07-04', 'Penjualan sehari', 126, '126-PERSEDIAAN', 200000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(327, '2023-07-10', 'Menambah persediaan ', 631, '631-BEBAN PERSEDIAAN', 170000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(328, '2023-07-10', 'Menambah persediaan ', 101, '101-KAS DI TANGAN', 170000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(331, '2023-07-10', 'Membeli gas', 631, '631-BEBAN PERSEDIAAN', 36000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(332, '2023-07-10', 'Membeli gas', 101, '101-KAS DI TANGAN', 36000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(335, '2023-07-10', 'Penjualan selama sehari', 401, '401-PENJUALAN', 220000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(336, '2023-07-10', 'Penjualan selama sehari', 126, '126-PERSEDIAAN', 220000, 'Kredit', 54, 'Sumber Agung Parahyangan');

-- Dumping structure for table db_akuntansi.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `no_akun` int(10) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `saldo` int(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `umkm` enum('Sumber Agung Parahyangan','','','') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tgl_transaksi` (`tgl_transaksi`),
  KEY `no_akun` (`no_akun`),
  KEY `nama_akun` (`nama_akun`),
  KEY `saldo` (`saldo`),
  KEY `jenis` (`jenis`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_reff`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user2` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=343 DEFAULT CHARSET=latin1;

-- Dumping data for table db_akuntansi.transaksi: ~30 rows (approximately)
INSERT INTO `transaksi` (`id`, `tgl_transaksi`, `keterangan`, `no_akun`, `nama_akun`, `saldo`, `jenis`, `user_id`, `umkm`) VALUES
	(275, '2023-07-03', 'Membeli Persediaan', 126, 'Masukkan Nama Akun', 150000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(276, '2023-07-03', 'Membeli Persediaan', 101, 'Masukkan Nama Akun', 150000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(279, '2023-07-03', 'Penjualan selama sehari', 401, '401-PENJUALAN', 250000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(280, '2023-07-03', 'Penjualan selama sehari', 126, '126-PERSEDIAAN', 250000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(283, '2023-07-03', 'Biaya bensin ', 740, '740-BIAYA BENSIN', 30000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(284, '2023-07-03', 'Biaya bensin ', 101, '101-KAS DI TANGAN', 30000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(287, '2023-07-04', 'Membeli Styrofoam Box', 126, '126-PERSEDIAAN', 50000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(288, '2023-07-04', 'Membeli Styrofoam Box', 101, '101-KAS DI TANGAN', 50000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(295, '2023-07-05', 'Membeli Tabung Gas', 126, '126-PERSEDIAAN', 36000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(296, '2023-07-05', 'Membeli Tabung Gas', 101, '101-KAS DI TANGAN', 36000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(299, '2023-07-05', 'Bensin motor', 740, '740-BIAYA BENSIN', 25000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(300, '2023-07-05', 'Bensin motor', 101, '101-KAS DI TANGAN', 25000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(303, '2023-07-06', 'Penjualan selama sehari', 401, '401-PENJUALAN', 215000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(304, '2023-07-06', 'Penjualan selama sehari', 126, '126-PERSEDIAAN', 215000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(307, '2023-07-05', 'Penjualan selama sehari', 401, '401-PENJUALAN', 195000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(308, '2023-07-05', 'Penjualan selama sehari', 126, '126-PERSEDIAAN', 195000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(311, '2023-07-06', 'Menambah persediaan', 126, '126-PERSEDIAAN', 50000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(312, '2023-07-06', 'Menambah persediaan', 101, '101-KAS DI TANGAN', 50000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(315, '2023-07-07', 'Membeli telur ', 126, '126-PERSEDIAAN', 58000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(316, '2023-07-07', 'Membeli telur ', 101, '101-KAS DI TANGAN', 58000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(319, '2023-07-07', 'Penjualan sehari', 401, '401-PENJUALAN', 230000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(320, '2023-07-07', 'Penjualan sehari', 101, '101-KAS DI TANGAN', 230000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(323, '2023-07-04', 'Penjualan sehari', 401, '401-PENJUALAN', 200000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(324, '2023-07-04', 'Penjualan sehari', 126, '126-PERSEDIAAN', 200000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(327, '2023-07-10', 'Menambah persediaan ', 631, '631-BEBAN PERSEDIAAN', 170000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(328, '2023-07-10', 'Menambah persediaan ', 101, '101-KAS DI TANGAN', 170000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(331, '2023-07-10', 'Membeli gas', 631, '631-BEBAN PERSEDIAAN', 36000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(332, '2023-07-10', 'Membeli gas', 101, '101-KAS DI TANGAN', 36000, 'Kredit', 54, 'Sumber Agung Parahyangan'),
	(335, '2023-07-10', 'Penjualan selama sehari', 401, '401-PENJUALAN', 220000, 'Debit', 54, 'Sumber Agung Parahyangan'),
	(336, '2023-07-10', 'Penjualan selama sehari', 126, '126-PERSEDIAAN', 220000, 'Kredit', 54, 'Sumber Agung Parahyangan');

-- Dumping structure for table db_akuntansi.user2
CREATE TABLE IF NOT EXISTS `user2` (
  `nama` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `umkm` enum('Sumber Agung Parahyangan','','','') NOT NULL,
  `gaji` int(20) NOT NULL,
  `role` enum('Pemilik','Karyawan','Developer','') NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `umkm` (`umkm`),
  KEY `umkm_2` (`umkm`),
  KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_akuntansi.user2: ~2 rows (approximately)
INSERT INTO `user2` (`nama`, `username`, `pass`, `user_id`, `umkm`, `gaji`, `role`) VALUES
	('Suci Sari', 'suci', '$2y$10$hussEYHIXqh.nqM6fim5Ter3MxfsAmv0GAGKUWycPTbbhtLNvErSa', 54, 'Sumber Agung Parahyangan', 2000000, 'Karyawan'),
	('Muhammad Fauzan', 'fauzan', '$2y$10$x.hB.pYHarQXwlEBGHotrOje99Dh4eHXTfJmDUdWBbleMY29exf0m', 55, 'Sumber Agung Parahyangan', 0, 'Pemilik');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
