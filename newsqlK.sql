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

-- dosyatakip.acente: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `acente` DISABLE KEYS */;
INSERT INTO `acente` (`id`, `name`, `image`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x350ED04B7AA1B8AF4F5F4BB923B4AF5C, 'Acente 1', '', '2020-11-19 15:23:16', '2020-11-19 15:23:16', '0000-00-00 00:00:00'),
	(_binary 0x3EC1EAC30063DE430931C3C83CD1BBBA, 'Acente 2', '', '2020-11-19 15:23:26', '2020-11-19 15:23:26', '0000-00-00 00:00:00'),
	(_binary 0xDD48C24AE72D9D2F9A7CEABFEB88515C, 'Acente 3', '', '2020-11-19 15:23:33', '2020-11-19 15:23:33', '0000-00-00 00:00:00');
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
	(_binary 0xDF1AA93784B6494FF3358D8F048A36A4, 'Dava 1 ', 'F7445F77621079B16D96408C72FF67DC,6AD9B0C8FEA6891560F9DF8B44F51E7B,5FB20D98E3A2C817A9D9E4F49A57D688', _binary 0xDD48C24AE72D9D2F9A7CEABFEB88515C, _binary 0xFB68721831D897CADFCE9FE8C53C57E3, NULL, '2020-11-19 15:53:41', '2020-11-19 15:53:41', NULL);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;

-- tablo yapısı dökülüyor dosyatakip.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` binary(16) NOT NULL,
  `form_id` binary(16) NOT NULL,
  `file_id` binary(16) DEFAULT NULL,
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
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- dosyatakip.form_fields: ~7 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_fields` DISABLE KEYS */;
INSERT INTO `form_fields` (`id`, `form_type_id`, `name`, `order`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x3063C3F671EBDF4090ED16F72A9053E5, _binary 0x945FCC7E9576897EF04EB53AFE1A3B63, 'Hosting', NULL, '2020-11-19 15:46:06', '2020-11-19 15:46:06', '0000-00-00 00:00:00'),
	(_binary 0x5137B02BD33101542BFD45BB2C347020, _binary 0x945FCC7E9576897EF04EB53AFE1A3B63, 'Domain', NULL, '2020-11-19 15:45:49', '2020-11-19 15:45:49', '0000-00-00 00:00:00'),
	(_binary 0x6D7E6B15CE511E6D8B4B33CF51F69A66, _binary 0x945FCC7E9576897EF04EB53AFE1A3B63, 'İsim Soyisim', NULL, '2020-11-19 15:45:31', '2020-11-19 15:45:31', '2020-11-19 15:45:38'),
	(_binary 0x830586B5DF9EF692AB02B5C8587EB8C4, _binary 0x318FBFC41BF38106EF82105846DD0DD8, 'Süre', NULL, '2020-11-19 15:49:14', '2020-11-19 15:49:14', '0000-00-00 00:00:00'),
	(_binary 0x9F41EF91A54EC16682D5BA2A657ED7C3, _binary 0x318FBFC41BF38106EF82105846DD0DD8, 'Ünvan', NULL, '2020-11-19 15:48:22', '2020-11-19 15:48:22', '0000-00-00 00:00:00'),
	(_binary 0xA04CE1FD4142BCEB506C2CC6106B3899, _binary 0x945FCC7E9576897EF04EB53AFE1A3B63, 'Sunucu', NULL, '2020-11-19 15:45:59', '2020-11-19 15:45:59', '0000-00-00 00:00:00'),
	(_binary 0xE7775256B620EE5AC84603D8B074C15D, _binary 0x945FCC7E9576897EF04EB53AFE1A3B63, 'Mail Kaydı', NULL, '2020-11-19 15:45:53', '2020-11-19 15:45:53', '0000-00-00 00:00:00');
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

-- dosyatakip.form_require: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_require` DISABLE KEYS */;
INSERT INTO `form_require` (`id`, `name`, `required_forms`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0xF7445F77621079B16D96408C72FF67DC, 'Giriş Değiştirme', '318FBFC41BF38106EF82105846DD0DD8,945FCC7E9576897EF04EB53AFE1A3B63', '2020-11-19 15:50:11', '2020-11-19 15:50:11', NULL),
	(_binary 0x6AD9B0C8FEA6891560F9DF8B44F51E7B, 'Giriş Kaldırma', '318FBFC41BF38106EF82105846DD0DD8', '2020-11-19 15:50:28', '2020-11-19 15:50:28', NULL),
	(_binary 0x5FB20D98E3A2C817A9D9E4F49A57D688, 'Abonelikten çıkma', '945FCC7E9576897EF04EB53AFE1A3B63', '2020-11-19 15:50:42', '2020-11-19 15:50:42', NULL);
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

-- dosyatakip.form_types: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_types` DISABLE KEYS */;
INSERT INTO `form_types` (`id`, `name`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x318FBFC41BF38106EF82105846DD0DD8, 'Kimlik', '2020-11-19 15:48:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(_binary 0x945FCC7E9576897EF04EB53AFE1A3B63, 'Giriş Formu', '2020-11-19 15:45:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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

-- dosyatakip.form_variables: ~20 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_variables` DISABLE KEYS */;
INSERT INTO `form_variables` (`id`, `field_id`, `name`, `order`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x0629A29AB4AE90E0B30DE1A148F1FC0D, _binary 0x5137B02BD33101542BFD45BB2C347020, 'toymedya.com', NULL, '2020-11-19 15:47:08', '2020-11-19 15:47:08', NULL),
	(_binary 0x06BAC1CB86F1F87158AF19EFB7A0DA73, _binary 0x3063C3F671EBDF4090ED16F72A9053E5, 'Paylaşımlı', NULL, '2020-11-19 15:47:35', '2020-11-19 15:47:35', NULL),
	(_binary 0x0BC66E7F28713565BF6DAFC7CF4CE773, _binary 0x9F41EF91A54EC16682D5BA2A657ED7C3, 'font back web stack', NULL, '2020-11-19 15:48:54', '2020-11-19 15:48:54', NULL),
	(_binary 0x0BDB06D24282CA76CF7ACADEF40E7B6C, _binary 0x830586B5DF9EF692AB02B5C8587EB8C4, '2 yıl', NULL, '2020-11-19 15:49:27', '2020-11-19 15:49:27', NULL),
	(_binary 0x0DE22904C58AED01CA72B42569FE7892, _binary 0xA04CE1FD4142BCEB506C2CC6106B3899, 'isimtescil', NULL, '2020-11-19 15:46:52', '2020-11-19 15:46:52', NULL),
	(_binary 0x11A84BD51B86BA6D5E63108887D24664, _binary 0xE7775256B620EE5AC84603D8B074C15D, 'MX Mail', NULL, '2020-11-19 15:46:18', '2020-11-19 15:46:18', NULL),
	(_binary 0x1C5DFAAE582D6957CFE73FBEA62E8FB7, _binary 0x5137B02BD33101542BFD45BB2C347020, 'Diğer', NULL, '2020-11-19 15:47:19', '2020-11-19 15:47:19', NULL),
	(_binary 0x1E195BB4F30CC8B936EF0D30871828D4, _binary 0x3063C3F671EBDF4090ED16F72A9053E5, 'KWM Linux', NULL, '2020-11-19 15:47:47', '2020-11-19 15:47:47', NULL),
	(_binary 0x4031A13E887D06B164055C0FF90376CC, _binary 0xE7775256B620EE5AC84603D8B074C15D, 'Yandex Kurumsal', NULL, '2020-11-19 15:46:29', '2020-11-19 15:46:29', NULL),
	(_binary 0x478C463296F9990961DFF1605EE3F8B1, _binary 0x830586B5DF9EF692AB02B5C8587EB8C4, '1 yıl', NULL, '2020-11-19 15:49:22', '2020-11-19 15:49:22', NULL),
	(_binary 0x5FBBFD27A1C5719C903B01033D7AC212, _binary 0xA04CE1FD4142BCEB506C2CC6106B3899, 'Natro', NULL, '2020-11-19 15:46:40', '2020-11-19 15:46:40', NULL),
	(_binary 0x793E8488088363AFD2C1498F1339292A, _binary 0x9F41EF91A54EC16682D5BA2A657ED7C3, 'back end web stack', NULL, '2020-11-19 15:48:44', '2020-11-19 15:48:44', NULL),
	(_binary 0x79DACE19E7FE7205109D84721AD81137, _binary 0x9F41EF91A54EC16682D5BA2A657ED7C3, 'Full stack web developer', NULL, '2020-11-19 15:49:08', '2020-11-19 15:49:08', NULL),
	(_binary 0x94ADF677D4F39DBF256A4F47F932DA81, _binary 0x3063C3F671EBDF4090ED16F72A9053E5, 'VPS', NULL, '2020-11-19 15:47:55', '2020-11-19 15:47:55', NULL),
	(_binary 0x991DE23FE2B56F4BF1D713A2483F8CCD, _binary 0x3063C3F671EBDF4090ED16F72A9053E5, 'VDS', NULL, '2020-11-19 15:47:58', '2020-11-19 15:47:58', NULL),
	(_binary 0x9B06B115FD5FDE9CEC74BA617BCF8BBB, _binary 0x3063C3F671EBDF4090ED16F72A9053E5, 'Dedicated', NULL, '2020-11-19 15:47:26', '2020-11-19 15:47:26', NULL),
	(_binary 0xD1D685D8E298272DD34D26B3D444C8A1, _binary 0xA04CE1FD4142BCEB506C2CC6106B3899, 'Goddady', NULL, '2020-11-19 15:46:45', '2020-11-19 15:46:45', NULL),
	(_binary 0xE31012A7386BE05E9950A1C259D829DB, _binary 0xE7775256B620EE5AC84603D8B074C15D, 'Goddady', NULL, '2020-11-19 15:46:35', '2020-11-19 15:46:35', NULL),
	(_binary 0xF1154CD197D8319B9C2FE293A06F78B1, _binary 0x5137B02BD33101542BFD45BB2C347020, 'esosyete.com', NULL, '2020-11-19 15:47:01', '2020-11-19 15:47:01', NULL),
	(_binary 0xF788CDDAAF6E591F6F4DE8183E989332, _binary 0x9F41EF91A54EC16682D5BA2A657ED7C3, 'Front end web stack', NULL, '2020-11-19 15:48:37', '2020-11-19 15:48:37', NULL);
/*!40000 ALTER TABLE `form_variables` ENABLE KEYS */;

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

-- dosyatakip.user: ~9 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `surname`, `password`, `role`, `birthday`, `image`, `email`, `extra`, `acente_id`, `createdate`, `deletedate`, `modifydate`) VALUES
	(_binary 0x1F4A6DF91B05E0181A40FB89A4A14259, 'Nejdat', 'uyanık', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-16 00:00:00', '', 'nejdat@hotmail.com', '', _binary 0x350ED04B7AA1B8AF4F5F4BB923B4AF5C, '2020-11-19 15:44:36', '0000-00-00 00:00:00', '2020-11-19 15:44:36'),
	(_binary 0x389785256ED98E55192AF33D01864C2F, 'Kürşat', 'kefil', '202cb962ac59075b964b07152d234b70', 'personel', '2020-06-09 00:00:00', '', 'kursat_gefil@hotmail.com', '', _binary 0x350ED04B7AA1B8AF4F5F4BB923B4AF5C, '2020-11-19 15:29:50', '0000-00-00 00:00:00', '2020-11-19 15:29:50'),
	(_binary 0x3DA156CCD61C751C66739A33F2E5F6F3, 'Kim', 'Yong', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-08 00:00:00', '', 'yunyang@in.com', '', _binary 0x350ED04B7AA1B8AF4F5F4BB923B4AF5C, '2020-11-19 15:29:11', '0000-00-00 00:00:00', '2020-11-19 15:29:11'),
	(_binary 0xB368D7E179ECCC28792B3EF1F1BEF7D2, 'Demir', 'yumak', '202cb962ac59075b964b07152d234b70', 'personel', '2020-12-10 00:00:00', '', 'demir.yumak@hotmail.com', '', _binary 0x3EC1EAC30063DE430931C3C83CD1BBBA, '2020-11-19 15:25:37', '0000-00-00 00:00:00', '2020-11-19 15:25:37'),
	(_binary 0xC53036A738DF72E14FD07E5EA9C21A6F, 'Özcan', 'kaner', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-11 00:00:00', '', 'ozcan_kjaner@hotmail.com', '', _binary 0xDD48C24AE72D9D2F9A7CEABFEB88515C, '2020-11-19 15:24:19', '0000-00-00 00:00:00', '2020-11-19 15:24:19'),
	(_binary 0xCE84763B2B595F57DFF429E27A10DC48, 'Kasım', 'han', '202cb962ac59075b964b07152d234b70', 'personel', '2021-05-06 00:00:00', '', 'kasim@han.com', '', _binary 0x3EC1EAC30063DE430931C3C83CD1BBBA, '2020-11-19 15:26:10', '0000-00-00 00:00:00', '2020-11-19 15:26:10'),
	(_binary 0xDDD7F3B8CE01D414699DB0989CF409BA, 'Ramazan', 'özsoy', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-10 00:00:00', '', 'rama@zan.com', '', _binary 0xDD48C24AE72D9D2F9A7CEABFEB88515C, '2020-11-19 15:23:59', '0000-00-00 00:00:00', '2020-11-19 15:23:59'),
	(_binary 0xEA3E7C6E6F05FFF4A1D666DE1AEA0AEF, 'kamil', 'Can', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-18 00:00:00', '', 'kamil@yine.com', '', _binary 0x3EC1EAC30063DE430931C3C83CD1BBBA, '2020-11-19 15:25:11', '0000-00-00 00:00:00', '2020-11-19 15:25:11'),
	(_binary 0xFB68721831D897CADFCE9FE8C53C57E3, 'Raci', 'inan', '202cb962ac59075b964b07152d234b70', 'personel', '2020-11-28 00:00:00', '', 'raci_inan@hotmail.com', '', _binary 0xDD48C24AE72D9D2F9A7CEABFEB88515C, '2020-11-19 15:24:45', '0000-00-00 00:00:00', '2020-11-19 15:24:45');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
