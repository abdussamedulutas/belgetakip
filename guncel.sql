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


-- dosyatakip için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `dosyatakip` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dosyatakip`;

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
	(_binary 0x534F59258F0E528454778B2E32716C53, 'Sivas', '', '2020-11-21 17:35:37', '2020-11-21 17:35:37', '0000-00-00 00:00:00');
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
	(_binary 0xFB6B3AAA7CE9868FF442FA9D26C1732B, 'Sivas Hasar Kaydı', 'BB4385FBB7E45741F726B1BAB64D861A', _binary 0x534F59258F0E528454778B2E32716C53, _binary 0xB767DBA6AC94D54AA57FDB07B4A480A8, NULL, '2020-11-21 17:42:02', '2020-11-21 17:42:02', NULL);
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

-- dosyatakip.form_fields: ~11 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_fields` DISABLE KEYS */;
INSERT INTO `form_fields` (`id`, `form_type_id`, `name`, `order`, `type`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x0E197596B375F87BF555E7E0FC66B033, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Tanzim Türü', 4, 'select', '2020-11-21 17:32:05', '2020-11-21 17:32:05', '0000-00-00 00:00:00'),
	(_binary 0x1CBABD29430186A557D8AFE4D2E00506, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Acente', 1, 'select', '2020-11-21 17:30:05', '2020-11-21 17:30:05', '0000-00-00 00:00:00'),
	(_binary 0x1E1AD5E2D1FFC57874C649330E00C616, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Hasar Tarihi', 5, 'date', '2020-11-21 17:32:31', '2020-11-21 17:32:31', '0000-00-00 00:00:00'),
	(_binary 0x27E7DA38DD9C8470495641E8D2135DE9, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Hasar  Hukuk Teslim Tarihi', 7, 'date', '2020-11-21 17:32:46', '2020-11-21 17:32:46', '0000-00-00 00:00:00'),
	(_binary 0x3B76685651F3BB0437C5149130B53388, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'İlgili Personel', 2, 'select', '2020-11-21 17:31:10', '2020-11-21 17:31:10', '0000-00-00 00:00:00'),
	(_binary 0x6C992EB31884960D8F4D72E10600B93D, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Tazminat Türü', 10, 'select', '2020-11-21 17:33:24', '2020-11-21 17:33:24', '0000-00-00 00:00:00'),
	(_binary 0xB3398FFF0A711D905AFB8E3AC458305A, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Dosya Durumu', 0, 'select', '2020-11-21 17:27:21', '2020-11-21 17:27:21', '0000-00-00 00:00:00'),
	(_binary 0xE576748CCC7B97524C8CC38F508B001C, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Hasar Adli Tıp Teslim Tarihi', 8, 'date', '2020-11-21 17:33:00', '2020-11-21 17:33:00', '0000-00-00 00:00:00'),
	(_binary 0xEEC6F9CEB78783728C230B29FA35D370, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Adli Tıp Hukuk Teslim Tarihi', 9, 'date', '2020-11-21 17:33:12', '2020-11-21 17:33:12', '0000-00-00 00:00:00'),
	(_binary 0xFBF58E1F59AB1F594856A843A73E876C, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Dosya Geliş Tarihi', 6, 'date', '2020-11-21 17:32:40', '2020-11-21 17:32:40', '0000-00-00 00:00:00'),
	(_binary 0xFCF905AD0A74410FF41748EA7B70C842, _binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Mağdurun Konumu', 3, 'select', '2020-11-21 17:31:36', '2020-11-21 17:31:36', '0000-00-00 00:00:00');
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

-- dosyatakip.form_require: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_require` DISABLE KEYS */;
INSERT INTO `form_require` (`id`, `name`, `required_forms`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0xBB4385FBB7E45741F726B1BAB64D861A, 'Hasar Kaydı Dosyası', '629E0ABAC93AE267D8E19BB971A73C1F', '2020-11-21 17:34:42', '2020-11-21 17:34:42', NULL);
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
	(_binary 0x629E0ABAC93AE267D8E19BB971A73C1F, 'Hasar Kaydı Formu', '2020-11-21 15:34:34', '2020-11-21 17:35:07', '0000-00-00 00:00:00');
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

-- dosyatakip.form_variables: ~27 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `form_variables` DISABLE KEYS */;
INSERT INTO `form_variables` (`id`, `field_id`, `name`, `order`, `createdate`, `modifydate`, `deletedate`) VALUES
	(_binary 0x08C63E451415D598924929E4F6185801, _binary 0xFCF905AD0A74410FF41748EA7B70C842, 'Sürücü', NULL, '2020-11-21 17:31:45', '2020-11-21 17:31:45', NULL),
	(_binary 0x0F568F2871C7F1EEE1BF71B248657CBC, _binary 0xB3398FFF0A711D905AFB8E3AC458305A, 'Hazırlık', NULL, '2020-11-21 17:27:34', '2020-11-21 17:27:34', NULL),
	(_binary 0x204F3EFCD2C1D8F7BDEE4A2D9D503203, _binary 0x1CBABD29430186A557D8AFE4D2E00506, 'Adana', NULL, '2020-11-21 17:30:32', '2020-11-21 17:30:32', NULL),
	(_binary 0x2723B0F4CFBA5353351CE1C99FB035C4, _binary 0x1CBABD29430186A557D8AFE4D2E00506, 'Kayseri', NULL, '2020-11-21 17:30:18', '2020-11-21 17:30:18', NULL),
	(_binary 0x330295C850E64D808B2F25369AE4797C, _binary 0x0E197596B375F87BF555E7E0FC66B033, 'Sakatlık Tazminatı', NULL, '2020-11-21 17:32:18', '2020-11-21 17:32:18', NULL),
	(_binary 0x3B3B0812457967BE8EA9005F86E62356, _binary 0xB3398FFF0A711D905AFB8E3AC458305A, 'Arşiv', NULL, '2020-11-21 17:28:04', '2020-11-21 17:28:04', NULL),
	(_binary 0x4A030E1E85F4A74A2AF474B5448E28E7, _binary 0x6C992EB31884960D8F4D72E10600B93D, 'Maddi', NULL, '2020-11-21 17:33:34', '2020-11-21 17:33:34', NULL),
	(_binary 0x55FBA23C8103B9ED3AE35FABDA217340, _binary 0xB3398FFF0A711D905AFB8E3AC458305A, 'İstinaf', NULL, '2020-11-21 17:28:24', '2020-11-21 17:28:24', NULL),
	(_binary 0x710C20B9276E9170C9151EDBCA84D48A, _binary 0x6C992EB31884960D8F4D72E10600B93D, 'Gecici Bakıcı', NULL, '2020-11-21 17:33:52', '2020-11-21 17:33:52', NULL),
	(_binary 0x72AFA912FE9C0AFE0C42D6A690DB71B2, _binary 0xFCF905AD0A74410FF41748EA7B70C842, 'Yolcu', NULL, '2020-11-21 17:31:51', '2020-11-21 17:31:51', NULL),
	(_binary 0x72B9560C769DD698AC88FDDF2F96EA87, _binary 0xB3398FFF0A711D905AFB8E3AC458305A, 'Tahsilatsız Arşiv', NULL, '2020-11-21 17:28:19', '2020-11-21 17:28:19', NULL),
	(_binary 0x7CD0B1097057AF74BD3522FABA475DC4, _binary 0x1CBABD29430186A557D8AFE4D2E00506, 'Yozgat', NULL, '2020-11-21 17:30:47', '2020-11-21 17:30:47', NULL),
	(_binary 0x7FC3D7640A2D9FB3949B01E1187D16B0, _binary 0x1CBABD29430186A557D8AFE4D2E00506, 'İstanbul', NULL, '2020-11-21 17:30:42', '2020-11-21 17:30:42', NULL),
	(_binary 0x8295A03BED73BD2F8C12F30F404BA9C2, _binary 0x1CBABD29430186A557D8AFE4D2E00506, 'Sivas', NULL, '2020-11-21 17:30:23', '2020-11-21 17:30:23', NULL),
	(_binary 0x9B9D7400085F0BA8AEDD045E19450E7A, _binary 0xB3398FFF0A711D905AFB8E3AC458305A, 'Yargıtay', NULL, '2020-11-21 17:28:36', '2020-11-21 17:28:36', NULL),
	(_binary 0x9D5DDA62DAAF9D8F4370594C76783235, _binary 0x0E197596B375F87BF555E7E0FC66B033, 'Vefaat Tazminaatı', NULL, '2020-11-21 17:32:23', '2020-11-21 17:32:23', NULL),
	(_binary 0xAF2FBD201CD78025575DA97B4851796F, _binary 0xB3398FFF0A711D905AFB8E3AC458305A, 'Tahkim', NULL, '2020-11-21 17:28:30', '2020-11-21 17:28:30', NULL),
	(_binary 0xB79059CE1DDD653345A525D71329CB1B, _binary 0x1CBABD29430186A557D8AFE4D2E00506, 'Konya', NULL, '2020-11-21 17:30:37', '2020-11-21 17:30:37', NULL),
	(_binary 0xBAABC46E33BD6112EF3A78376A657B68, _binary 0x3B76685651F3BB0437C5149130B53388, 'A. Özdemir', NULL, '2020-11-21 17:31:23', '2020-11-21 17:31:23', NULL),
	(_binary 0xC1D6BF4923389B86A02A6F5F501EDEFE, _binary 0x6C992EB31884960D8F4D72E10600B93D, 'Gecici İş göremezlik', NULL, '2020-11-21 17:33:46', '2020-11-21 17:33:46', NULL),
	(_binary 0xC29D61C43DACECAF99CFBFFD980CF620, _binary 0x3B76685651F3BB0437C5149130B53388, 'A. Cengiz', NULL, '2020-11-21 17:31:19', '2020-11-21 17:31:19', NULL),
	(_binary 0xC68E8F20064196FB0F2BCF166A1B23AF, _binary 0x1CBABD29430186A557D8AFE4D2E00506, 'Bursa', NULL, '2020-11-21 17:30:52', '2020-11-21 17:30:52', NULL),
	(_binary 0xDEFFEF32AFAD6A0D1F598932C947B07F, _binary 0x6C992EB31884960D8F4D72E10600B93D, 'Manevi', NULL, '2020-11-21 17:33:40', '2020-11-21 17:33:40', NULL),
	(_binary 0xE6987C6155705726BEE92652D706363D, _binary 0xFCF905AD0A74410FF41748EA7B70C842, 'Yaya', NULL, '2020-11-21 17:31:57', '2020-11-21 17:31:57', NULL),
	(_binary 0xEDBD04629CA04C78B2ADE6764CFFB8FA, _binary 0xB3398FFF0A711D905AFB8E3AC458305A, 'Tahsilatlı arşiv', NULL, '2020-11-21 17:28:14', '2020-11-21 17:28:14', NULL),
	(_binary 0xEF4307AC37F46E03ACD9C4574532E4FF, _binary 0xB3398FFF0A711D905AFB8E3AC458305A, 'Derdest', NULL, '2020-11-21 17:27:40', '2020-11-21 17:27:40', NULL),
	(_binary 0xF007BF6B75470F8804EC525C15EABF6B, _binary 0x1CBABD29430186A557D8AFE4D2E00506, 'Niğde', NULL, '2020-11-21 17:30:27', '2020-11-21 17:30:27', NULL);
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
  `acente_id` int(11) DEFAULT NULL,
  `birthday` datetime NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `deletedate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- dosyatakip.user: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `surname`, `password`, `role`, `acente_id`, `birthday`, `image`, `email`, `extra`, `createdate`, `deletedate`, `modifydate`) VALUES
	(_binary 0xB767DBA6AC94D54AA57FDB07B4A480A8, 'Personel', 'soyadı', '202cb962ac59075b964b07152d234b70', 'personel', 0, '2020-11-17 00:00:00', '', 'haci58ac@gmail.com', '', '2020-11-21 17:38:25', '0000-00-00 00:00:00', '2020-11-21 17:38:25');
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
