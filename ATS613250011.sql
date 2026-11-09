-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ats613250011
DROP DATABASE IF EXISTS `ats613250011`;
CREATE DATABASE IF NOT EXISTS `ats613250011` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ats613250011`;

-- Dumping structure for table ats613250011.member_011
DROP TABLE IF EXISTS `member_011`;
CREATE TABLE IF NOT EXISTS `member_011` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(34) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `aktive` enum('1','0') NOT NULL DEFAULT '1' COMMENT 'Aktif=1, Pasif=0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ats613250011.member_011: ~2 rows (approximately)
INSERT INTO `member_011` (`id`, `email`, `password`, `nama`, `aktive`) VALUES
	(1, 'admineva@rentalmobil.com', '0192023a7bbd73250516f069df18b500', 'Administrator', '1'),
	(2, 'admineva@rentalmobil.com', '0192023a7bbd73250516f069df18b500', 'Administrator', '1');

-- Dumping structure for table ats613250011.mobil011
DROP TABLE IF EXISTS `mobil011`;
CREATE TABLE IF NOT EXISTS `mobil011` (
  `no_id` int NOT NULL AUTO_INCREMENT,
  `nomor_kendaraan` varchar(12) NOT NULL,
  `jenis_kendaraan` enum('Sedan','Pickup','Truk','Bemo') NOT NULL,
  `pemilik` varchar(50) NOT NULL,
  `tahun_pembuatan` char(4) NOT NULL,
  PRIMARY KEY (`no_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ats613250011.mobil011: ~6 rows (approximately)
INSERT INTO `mobil011` (`no_id`, `nomor_kendaraan`, `jenis_kendaraan`, `pemilik`, `tahun_pembuatan`) VALUES
	(1, 'D 1234 AB', 'Sedan', 'Eva Selvia', '2020'),
	(2, 'D 5678 CD', 'Pickup', 'Rhesa Naufal', '2018'),
	(3, 'D 9012 EF', 'Truk', 'Naila Azizah', '2016'),
	(4, 'D 1234 AB', 'Sedan', 'Eva Selvia', '2020'),
	(5, 'D 5678 CD', 'Pickup', 'Rhesa Naufal', '2018'),
	(6, 'D 9012 EF', 'Truk', 'Naila Azizah', '2016');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
