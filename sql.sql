/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `dosyatakip` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dosyatakip`;

CREATE TABLE IF NOT EXISTS `acente` (
  `id` binary(16) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `acente` DISABLE KEYS */;
INSERT INTO `acente` (`id`, `name`, `image`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x92E394EDF8E73F743A569E2203019444, 'Yeni Acente 1', '', '2020-11-18 23:39:09', '2020-11-18 23:39:09', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `acente` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `forms` (
  `id` binary(16) NOT NULL,
  `type` binary(16) NOT NULL,
  `user` binary(16) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `form_fields` (
  `id` binary(16) NOT NULL,
  `form_type_id` binary(16) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `form_fields` DISABLE KEYS */;
INSERT INTO `form_fields` (`id`, `form_type_id`, `name`, `order`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x40139BB30EF463063FD53A72DE4E84DD, _binary 0xEA2D13A5FC2E13E793CEC5DA26099347, 'TC No', NULL, '2020-11-18 23:41:31', '2020-11-18 23:41:31', '2020-11-18 23:41:46'),
	(_binary 0x43ED20C5CEF4919DEC1ECF6C73D741EE, _binary 0xEA2D13A5FC2E13E793CEC5DA26099347, 'Soyad', NULL, '2020-11-18 23:41:24', '2020-11-18 23:41:24', '2020-11-18 23:41:50'),
	(_binary 0x6FFBCFE63829080D0FD732067333FCC1, _binary 0xEA2D13A5FC2E13E793CEC5DA26099347, 'eviniz', NULL, '2020-11-18 23:42:07', '2020-11-18 23:42:07', '0000-00-00 00:00:00'),
	(_binary 0x9066DF861F15CEE6F459F84E3169D28D, _binary 0xEA2D13A5FC2E13E793CEC5DA26099347, 'Ad', NULL, '2020-11-18 23:41:21', '2020-11-18 23:41:21', '2020-11-18 23:41:53'),
	(_binary 0xB5512685F8E8B30CEC4618148D027059, _binary 0xEA2D13A5FC2E13E793CEC5DA26099347, 'Kabul et', NULL, '2020-11-18 23:41:59', '2020-11-18 23:41:59', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `form_fields` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `form_require` (
  `id` binary(16) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `required_foms` text,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `form_require` DISABLE KEYS */;
INSERT INTO `form_require` (`id`, `name`, `required_foms`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x6065A528BB28A73808C6377233577181, 'Ehliyet', 'EA2D13A5FC2E13E793CEC5DA26099347', '2020-11-18 23:42:58', '2020-11-18 23:42:58', NULL);
/*!40000 ALTER TABLE `form_require` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `form_types` (
  `id` binary(16) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `form_types` DISABLE KEYS */;
INSERT INTO `form_types` (`id`, `name`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0xEA2D13A5FC2E13E793CEC5DA26099347, 'Kimlik', '2020-11-18 23:41:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `form_types` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `form_variables` (
  `id` binary(16) NOT NULL,
  `field_id` binary(16) DEFAULT NULL,
  `name` text CHARACTER SET utf8mb4,
  `order` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `form_variables` DISABLE KEYS */;
INSERT INTO `form_variables` (`id`, `field_id`, `name`, `order`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x1063A1B1C874090AC98367CD3A1BFC55, _binary 0xB5512685F8E8B30CEC4618148D027059, 'evet', NULL, '2020-11-18 23:42:18', '2020-11-18 23:42:18', NULL),
	(_binary 0x25CF7946C5DFD4BA76F01EB287462DD3, _binary 0x6FFBCFE63829080D0FD732067333FCC1, 'var', NULL, '2020-11-18 23:42:28', '2020-11-18 23:42:28', NULL),
	(_binary 0x4754D321B3DACDB1A1FAFED3097A6487, _binary 0xB5512685F8E8B30CEC4618148D027059, 'hayır', NULL, '2020-11-18 23:42:25', '2020-11-18 23:42:25', NULL),
	(_binary 0x8E2916F65C5D723B11877D5EDEA0818A, _binary 0x6FFBCFE63829080D0FD732067333FCC1, 'yok', NULL, '2020-11-18 23:42:37', '2020-11-18 23:42:37', NULL);
/*!40000 ALTER TABLE `form_variables` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `createdate` datetime NOT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`name`, `value`, `createdate`, `modifydate`, `deletedate`) VALUES
	('admin.email', 'admin@admin.com', '2020-11-15 01:28:16', '2020-11-15 02:05:15', NULL),
	('admin.password', '21232f297a57a5a743894a0e4a801fc3', '2020-11-15 01:28:16', '2020-11-15 01:28:16', NULL),
	('appname', 'FormTakip', '2020-11-15 21:22:35', '2020-11-15 21:22:36', NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user` (
  `id` binary(16) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` datetime NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `acente_id` binary(16) DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `surname`, `password`, `role`, `birthday`, `image`, `email`, `extra`, `acente_id`, `createdate`, `deletedate`, `modifydate`) VALUES
	(_binary 0x5B5B299F876D69AF65C61F1A72C99CB8, 'Abdussamed', 'ULUTAŞ', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-13 00:00:00', '8b75c8cae37621b9ec318245d7b2a117.jpg', 'zences-software@hotmail.com', '', _binary 0x92E394EDF8E73F743A569E2203019444, '2020-11-18 23:39:32', '0000-00-00 00:00:00', '2020-11-18 23:40:03'),
	(_binary 0x8F6A7FF01A5FDE1782D312788B33A57F, 'AHMET', 'CANPOLAT', '250cf8b51c773f3f8dc8b4be867a9a02', 'personel', '2020-11-19 00:00:00', '', 'gloextim@gmail.com', '', _binary 0x92E394EDF8E73F743A569E2203019444, '2020-11-18 23:40:21', '0000-00-00 00:00:00', '2020-11-18 23:40:21');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
