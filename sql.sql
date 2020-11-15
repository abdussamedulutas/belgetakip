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
INSERT INTO `acente` (`id`, `name`, `image`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x0A0BC2F26FD2D06C25F0C62A57119FD6, '68486', '', '2020-11-15 22:56:29', '2020-11-15 22:56:29', '0000-00-00 00:00:00'),
	(_binary 0x856941EC86A64D19A357C0DAD0A3C466, 'yrj dyj y', '', '2020-11-15 22:55:12', '2020-11-15 22:55:12', '0000-00-00 00:00:00');
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

CREATE TABLE IF NOT EXISTS `form_types` (
  `id` binary(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `form_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_types` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `form_variables` (
  `id` binary(16) NOT NULL,
  `fieldname` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `form_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_variables` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(255) NOT NULL,
  `value` text,
  `createdate` datetime NOT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`name`, `value`, `createdate`, `modifydate`, `deletedate`) VALUES
	('admin.email', 'admin@admin.com', '2020-11-15 01:28:16', '2020-11-15 02:05:15', NULL),
	('admin.password', '21232f297a57a5a743894a0e4a801fc3', '2020-11-15 01:28:16', '2020-11-15 01:28:16', NULL),
	('appname', 'FormTakip', '2020-11-15 21:22:35', '2020-11-15 21:22:36', NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

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
