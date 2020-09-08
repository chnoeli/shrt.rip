-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             9.5.0.5293
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für urlshortener
CREATE DATABASE IF NOT EXISTS `urlshortener` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `urlshortener`;

-- Exportiere Struktur von Tabelle urlshortener.data
CREATE TABLE IF NOT EXISTS `data` (
  `id_data` int(11) NOT NULL,
  `longUrl` varchar(2000) NOT NULL,
  `shortUrl` varchar(2000) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expirationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle urlshortener.data: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `data` DISABLE KEYS */;
/*!40000 ALTER TABLE `data` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
