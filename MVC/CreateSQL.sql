/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `dosyatakip` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dosyatakip`;

CREATE TABLE IF NOT EXISTS `acente` (
  `id` binary(16) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `acente` DISABLE KEYS */;
/*!40000 ALTER TABLE `acente` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `forms` (
  `id` binary(16) NOT NULL,
  `type` varchar(50) NOT NULL,
  `burono` int(11) NOT NULL,
  `tarafsirketi_id` binary(16) NOT NULL,
  `durum_id` binary(16) NOT NULL,
  `karsitaraf_id` binary(16) NOT NULL,
  `acente_id` binary(16) NOT NULL,
  `acentepersonel_id` binary(16) NOT NULL,
  `magdurundurumu_id` binary(16) NOT NULL,
  `tanzimturu_id` binary(16) NOT NULL,
  `hasarturu_id` binary(16) NOT NULL,
  `dosyagelistarihi_id` binary(16) NOT NULL,
  `hasarhukukteslim_id` binary(16) NOT NULL,
  `hasaradlitipteslim_id` binary(16) NOT NULL,
  `adlitiphukukteslim_id` binary(16) NOT NULL,
  `tazminatturu_id` binary(16) NOT NULL,
  `mahkemetahkim_id` binary(16) NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `form_variables` (
  `id` binary(16) NOT NULL,
  `fieldname` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `form_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_variables` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user` (
  `id` binary(16) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(10) NOT NULL,
  `birthday` datetime NOT NULL,
  `image` text NOT NULL,
  `email` text NOT NULL,
  `extra` text NOT NULL,
  `acente_id` binary(50) DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
