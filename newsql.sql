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

-- dosyatakip.acente: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `acente` DISABLE KEYS */;
INSERT INTO `acente` (`id`, `name`, `image`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x01AAA44F815E5E6F9DBB54C1B4E7F1B9, 'Acente 1', '', '2020-11-20 12:30:33', '2020-11-20 12:30:33', '0000-00-00 00:00:00');
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

-- dosyatakip.file: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` (`id`, `name`, `required_forms`, `acente_id`, `personel_id`, `lastinsetdate`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0xA59935A8A0E28CA7F9FE8E40E23DDC3A, 'Dava 1 ', '172AA75437E77465D3F0273FA3D369DE,D8991CA14B9F2A330C7697B15D13550B', _binary 0x01AAA44F815E5E6F9DBB54C1B4E7F1B9, _binary 0x6F8E0CEC073AEF06A13E6286254B1E19, NULL, '2020-11-20 14:46:50', '2020-11-20 14:46:50', NULL);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` binary(16) NOT NULL,
  `type_id` binary(16) NOT NULL,
  `file_id` binary(16) DEFAULT NULL,
  `user` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- dosyatakip.forms: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` (`id`, `type_id`, `file_id`, `user`, `data`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x9414C7F9BBBBA52410185AA8ED514492, _binary 0x57CA0F6EF6679B617BC82CC8E3DC1693, _binary 0xA59935A8A0E28CA7F9FE8E40E23DDC3A, _binary 0x6F8E0CEC073AEF06A13E6286254B1E19, '', '2020-11-20 15:05:18', '2020-11-20 15:05:18', '0000-00-00 00:00:00');
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

-- dosyatakip.form_fields: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_fields` DISABLE KEYS */;
INSERT INTO `form_fields` (`id`, `form_type_id`, `name`, `order`, `type`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x2025BD3149D14516258CEA6D8CECEBD7, _binary 0x57CA0F6EF6679B617BC82CC8E3DC1693, 'Cinsiyet', NULL, 'select', '2020-11-20 14:40:14', '2020-11-20 14:40:14', '0000-00-00 00:00:00'),
	(_binary 0x24EC96D73510E8E574D93DD47D333044, _binary 0x57CA0F6EF6679B617BC82CC8E3DC1693, 'Yaş', NULL, 'text', '2020-11-20 14:40:06', '2020-11-20 14:40:06', '0000-00-00 00:00:00'),
	(_binary 0x86341DF55779C90C01B408F1409E30BD, _binary 0x57CA0F6EF6679B617BC82CC8E3DC1693, 'Soy isim', NULL, 'text', '2020-11-20 14:39:59', '2020-11-20 14:39:59', '0000-00-00 00:00:00'),
	(_binary 0xD3239C38979427BCCF26BDC2115C53E8, _binary 0x57CA0F6EF6679B617BC82CC8E3DC1693, 'İsim', NULL, 'text', '2020-11-20 14:39:55', '2020-11-20 14:39:55', '0000-00-00 00:00:00');
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

-- dosyatakip.form_require: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_require` DISABLE KEYS */;
INSERT INTO `form_require` (`id`, `name`, `required_forms`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x172AA75437E77465D3F0273FA3D369DE, 'Gine', '57CA0F6EF6679B617BC82CC8E3DC1693', '2020-11-20 14:46:16', '2020-11-20 14:46:16', NULL),
	(_binary 0xD8991CA14B9F2A330C7697B15D13550B, 'Gaye', '57CA0F6EF6679B617BC82CC8E3DC1693', '2020-11-20 14:46:26', '2020-11-20 14:46:26', NULL);
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

-- dosyatakip.form_types: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_types` DISABLE KEYS */;
INSERT INTO `form_types` (`id`, `name`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x57CA0F6EF6679B617BC82CC8E3DC1693, 'Kimlik', '2020-11-20 14:39:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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

-- dosyatakip.form_variables: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_variables` DISABLE KEYS */;
INSERT INTO `form_variables` (`id`, `field_id`, `name`, `order`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x98E8ED829F845818AE3E060A8D1B4762, _binary 0x2025BD3149D14516258CEA6D8CECEBD7, 'Erkek', NULL, '2020-11-20 14:44:06', '2020-11-20 14:44:06', NULL),
	(_binary 0xF88B70A8E13138D7BD88DD6100E0C2B9, _binary 0x2025BD3149D14516258CEA6D8CECEBD7, 'Kadın', NULL, '2020-11-20 14:44:11', '2020-11-20 14:44:11', NULL);
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

-- dosyatakip.notification: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` (`id`, `islem`, `dosya`, `form`, `personel`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x28DB16C501EEC915A1541F48B07D1439, 'Yeni Dosya açıldı', NULL, NULL, _binary 0x00000000000000000000000000000000, '2020-11-20 14:46:51', '2020-11-20 14:46:51', NULL),
	(_binary 0xC8C8E0305462B13D700C9A8DE16EF730, 'Yeni Dosya açıldı', NULL, NULL, _binary 0x00000000000000000000000000000000, '2020-11-20 14:47:00', '2020-11-20 14:47:00', NULL);
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

-- dosyatakip.user: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `surname`, `password`, `role`, `birthday`, `image`, `email`, `extra`, `acente_id`, `createdate`, `deletedate`, `modifydate`) VALUES
	(_binary 0x6F8E0CEC073AEF06A13E6286254B1E19, 'personel 1', 'rseg', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-18 00:00:00', '', 'A@admin.com', '', _binary 0x01AAA44F815E5E6F9DBB54C1B4E7F1B9, '2020-11-20 12:31:06', '0000-00-00 00:00:00', '2020-11-20 13:09:00'),
	(_binary 0x71D830B9C9587A3ECD2FBC5183813275, 'yeni', 'yeni', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-10 00:00:00', '', 'acente@acente.com', '', _binary 0x01AAA44F815E5E6F9DBB54C1B4E7F1B9, '2020-11-20 13:10:29', '0000-00-00 00:00:00', '2020-11-20 13:10:29');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.values
CREATE TABLE IF NOT EXISTS `values` (
  `id` binary(16) DEFAULT NULL,
  `field` binary(16) DEFAULT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- dosyatakip.values: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `values` DISABLE KEYS */;
INSERT INTO `values` (`id`, `field`, `text`) VALUES
	(_binary 0x65396165623730376539323332633138, _binary 0x2025BD3149D14516258CEA6D8CECEBD7, 'Seçin'),
	(_binary 0x63633162623538666431313336353130, _binary 0x24EC96D73510E8E574D93DD47D333044, '18'),
	(_binary 0x64323830323131376339623061656136, _binary 0x86341DF55779C90C01B408F1409E30BD, 'ULUTAŞ'),
	(_binary 0x31666234653936353735643336353238, _binary 0xD3239C38979427BCCF26BDC2115C53E8, 'abdussamed');
/*!40000 ALTER TABLE `values` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
