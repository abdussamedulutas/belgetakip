-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                10.4.14-MariaDB - mariadb.org binary distribution
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- tablo yapısı dökülüyor dosyatakip.acente
CREATE TABLE IF NOT EXISTS `acente` (
  `id` binary(16) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- dosyatakip.acente: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `acente` DISABLE KEYS */;
/*!40000 ALTER TABLE `acente` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.file
CREATE TABLE IF NOT EXISTS `file` (
  `id` binary(16) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `required_forms` text DEFAULT NULL,
  `acente_id` binary(16) DEFAULT NULL,
  `personel_id` binary(16) DEFAULT NULL,
  `lastinsetdate` datetime DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- dosyatakip.file: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` binary(16) NOT NULL,
  `type_id` binary(16) NOT NULL,
  `file_id` binary(16) DEFAULT NULL,
  `require_id` binary(16) DEFAULT NULL,
  `user` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- dosyatakip.forms: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.form_fields
CREATE TABLE IF NOT EXISTS `form_fields` (
  `id` binary(16) NOT NULL,
  `form_type_id` binary(16) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- dosyatakip.form_fields: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_fields` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.form_require
CREATE TABLE IF NOT EXISTS `form_require` (
  `id` binary(16) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `required_forms` text DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- dosyatakip.form_require: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_require` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_require` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.form_types
CREATE TABLE IF NOT EXISTS `form_types` (
  `id` binary(16) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- dosyatakip.form_types: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_types` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.form_variables
CREATE TABLE IF NOT EXISTS `form_variables` (
  `id` binary(16) NOT NULL,
  `field_id` binary(16) DEFAULT NULL,
  `name` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- dosyatakip.form_variables: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_variables` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.notification
CREATE TABLE IF NOT EXISTS `notification` (
  `id` binary(16) DEFAULT NULL,
  `islem` text DEFAULT NULL,
  `dosya` binary(16) DEFAULT NULL,
  `form` binary(16) DEFAULT NULL,
  `personel` binary(16) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- dosyatakip.notification: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- dosyatakip.settings: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`name`, `value`, `createdate`, `modifydate`, `deletedate`) VALUES
	('admin.email', 'admin@admin.com', '2020-11-15 01:28:16', '2020-11-15 02:05:15', NULL),
	('admin.password', '21232f297a57a5a743894a0e4a801fc3', '2020-11-15 01:28:16', '2020-11-15 01:28:16', NULL),
	('appname', 'FormTakip', '2020-11-15 21:22:35', '2020-11-15 21:22:36', NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.user
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

-- dosyatakip.user: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.values
CREATE TABLE IF NOT EXISTS `values` (
  `id` binary(16) DEFAULT NULL,
  `formid` binary(16) DEFAULT NULL,
  `field` binary(16) DEFAULT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- dosyatakip.values: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `values` DISABLE KEYS */;
/*!40000 ALTER TABLE `values` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
