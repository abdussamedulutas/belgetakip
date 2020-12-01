SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
SET time_zone = "+00:00";
SET NAMES utf8mb4;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
START TRANSACTION;
CREATE TABLE IF NOT EXISTS `acente` (
	`id` binary(16) NOT NULL,
	`name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `file` (
	`id` binary(16),
	`name` varchar(50) COLLATE utf8mb4_general_ci,
	`required_forms` text COLLATE utf8mb4_general_ci,
	`acente_id` binary(16),
	`personel_id` binary(16),
	`lastinsetdate` datetime,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	`order` int(11)
);

CREATE TABLE IF NOT EXISTS `form_fields` (
	`id` binary(16) NOT NULL,
	`name` varchar(255) COLLATE utf8mb4_general_ci,
	`order` int(11),
	`type` varchar(50) COLLATE latin1_swedish_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `form_files` (
	`id` binary(16) NOT NULL,
	`user` binary(16),
	`requireid` binary(16),
	`fileid` binary(16),
	`filepath` text COLLATE utf8mb4_general_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `form_notes` (
	`id` binary(16) NOT NULL,
	`file_id` binary(16),
	`user` binary(16),
	`text` text COLLATE utf8mb4_general_ci,
	`type` varchar(45) COLLATE utf8mb4_general_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `form_require` (
	`id` binary(16),
	`name` varchar(50) COLLATE utf8mb4_general_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime
);

CREATE TABLE IF NOT EXISTS `form_types` (
	`id` binary(16) NOT NULL,
	`name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `form_variables` (
	`id` binary(16) NOT NULL,
	`field_id` binary(16),
	`name` text COLLATE utf8mb4_general_ci,
	`order` int(11),
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `forms` (
	`id` binary(16) NOT NULL,
	`type_id` binary(16) NOT NULL,
	`file_id` binary(16),
	`require_id` binary(16),
	`user` binary(16) NOT NULL,
	`data` text COLLATE utf8mb4_unicode_ci NOT NULL,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `notification` (
	`id` binary(16),
	`islem` text COLLATE utf8mb4_general_ci,
	`dosya` binary(16),
	`form` binary(16),
	`personel` binary(16),
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime
);

CREATE TABLE IF NOT EXISTS `settings` (
	`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`value` longtext COLLATE utf8mb4_unicode_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime
);

CREATE TABLE IF NOT EXISTS `user` (
	`id` binary(16) NOT NULL,
	`name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	`surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	`password` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
	`acente_id` binary(16),
	`birthday` datetime,
	`image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`extra` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`createdate` datetime,
	`deletedate` datetime,
	`modifydate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `values` (
	`id` binary(16),
	`formid` binary(16),
	`field` binary(16),
	`text` text COLLATE utf8mb4_general_ci
);


TRUNCATE TABLE `acente`;
TRUNCATE TABLE `file`;
TRUNCATE TABLE `form_fields`;
TRUNCATE TABLE `form_files`;
TRUNCATE TABLE `form_notes`;
TRUNCATE TABLE `form_require`;
TRUNCATE TABLE `form_types`;
TRUNCATE TABLE `form_variables`;
TRUNCATE TABLE `forms`;
TRUNCATE TABLE `notification`;
TRUNCATE TABLE `settings`;
TRUNCATE TABLE `user`;
TRUNCATE TABLE `values`;

SET sql_notes = 1;
INSERT INTO `acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),'Kayseri','','2020-11-24 14:29:05','2020-11-24 14:29:05',NULL);
INSERT INTO `acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('4c87fa5ac62b1da2e618f8431d1759e4'),'Yozgat','','2020-11-24 14:29:28','2020-11-24 14:29:28',NULL);
INSERT INTO `acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('5394864051d9f4b04c56c5b0ae13fd47'),'Bursa','','2020-11-24 14:29:32','2020-11-24 14:29:32',NULL);
INSERT INTO `acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('62465906f0ccf5ddac733ea86eacc061'),'Konya','','2020-11-24 14:29:21','2020-11-24 14:29:21',NULL);
INSERT INTO `acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('6664ac6c3249d2994d395a750d26fdc3'),'İstanbul','','2020-11-24 14:29:25','2020-11-24 14:29:25',NULL);
INSERT INTO `acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('86a3bc863225834cf244dfcf7840c56f'),'Sivas','','2020-11-24 14:29:08','2020-11-24 14:29:08',NULL);
INSERT INTO `acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('c0c3ff36086b4b0708fc80f17a8e9f9c'),'Niğde','','2020-11-24 14:29:14','2020-11-24 14:29:14',NULL);
INSERT INTO `acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fb4ae21e062fa3c50f836cf74d779573'),'ADANA','','2020-11-24 14:29:17','2020-11-24 14:29:17',NULL);
INSERT INTO `file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('c3b142010929f59595a7137bd2adc089'),'kafaası patlamış','',UNHEX('4c87fa5ac62b1da2e618f8431d1759e4'),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),NULL,'2020-11-27 17:17:09','2020-11-27 17:17:09',NULL,'1');
INSERT INTO `file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('7aa54a99c1db61f25daa0bfa6650a6de'),'mesuttan gelen','',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),NULL,'2020-11-28 13:40:00','2020-11-28 13:40:00','2020-11-28 13:40:32','2');
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'Hasar Adli Tıp Teslim Tarihi','7','date','2020-11-24 08:51:41','2020-11-24 08:51:41',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Mağdurun konumu','2','select','2020-11-24 08:50:35','2020-11-24 08:50:35',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('21d25dcf24373baeb847f52815bbd746'),'Sigorta Şirketleri','11','select','2020-11-24 17:10:09','2020-11-24 17:10:22',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Tazminat Türü','9','select','2020-11-24 08:51:54','2020-11-24 08:51:54',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('44a9c75c7e4763114699697a6307bd00'),'Dosya Durumu','0','select','2020-11-24 08:48:57','2020-11-24 08:48:57',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'Hasar  Hukuk Teslim Tarihi','6','date','2020-11-24 08:51:36','2020-11-24 08:51:36',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('91a88b64d7685a98ac35414143de41da'),'Taraf Şirketi','1','select','2020-11-24 08:50:14','2020-11-24 08:50:14',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('9ad70292ddac62f604f79c57e78896d9'),'Müvekkil İsmi','10','text','2020-11-24 11:23:22','2020-11-28 11:44:42',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'Hasar Tarihi','4','date','2020-11-24 08:51:16','2020-11-24 08:51:16',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('de359388539e4d1e2ad32756ed576fd6'),'Adli Tıp Hukuk Teslim Tarihi','8','date','2020-11-24 08:51:48','2020-11-24 08:51:48',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'Dosya Geliş Tarihi','5','date','2020-11-24 08:51:25','2020-11-24 08:51:25',NULL);
INSERT INTO `form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Tanzim Türü','3','select','2020-11-24 08:50:57','2020-11-24 08:50:57',NULL);
INSERT INTO `form_files` (`id`,`user`,`requireid`,`fileid`,`filepath`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('913703ac4959068516ddf940cb4ba2ee'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),UNHEX('dd595578e638171bd69f0b9efea7c5d5'),UNHEX('c3b142010929f59595a7137bd2adc089'),'c0dfa3926c26ea45ff58c7f5da458fc4.xlsx','2020-11-27 17:18:14','2020-11-27 17:18:14',NULL);
INSERT INTO `form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('61653736313864666636636633633833'),UNHEX('c3b142010929f59595a7137bd2adc089'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'durumu vahim','Hasar','2020-11-27 17:17:35',NULL,NULL);
INSERT INTO `form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('64373962393335383834643966343439'),UNHEX('c3b142010929f59595a7137bd2adc089'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'bel kırıgı   inönü %12 rapor','Adli Tıp','2020-11-27 17:23:10',NULL,NULL);
INSERT INTO `form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('30376262376235313632333435363634'),UNHEX('c3b142010929f59595a7137bd2adc089'),UNHEX('c5306a3585dd5138bf7e4a8c71bbb963'),'adli evraklar tamamlandı ','Avukat','2020-11-27 17:24:15',NULL,NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('b9b06a5ffb7b3bd62fc70a73d9e7013e'),'Vekaletname','2020-11-24 08:45:45','2020-11-24 08:45:45',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('262e41cbd5de10bf121c1ffe5e02b5fe'),'Sözleşme','2020-11-24 08:45:52','2020-11-24 08:45:52',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('00e1d4ad694712587e485828ba6a4d4c'),'Poliçe','2020-11-24 08:45:57','2020-11-24 08:45:57',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('efa13b1c2aa092d46df4d7bee243da6e'),'Kaza Tespit Tutanağı','2020-11-24 08:46:10','2020-11-24 08:46:10',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('ba2bb3d918e53f43e4f31b8540bfe3f0'),'Ruhsat','2020-11-24 08:46:15','2020-11-24 08:46:15',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('5514f7256f1b2a160c73f8d63860fda0'),'Ehliyet','2020-11-24 08:46:20','2020-11-24 08:46:20',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('dd595578e638171bd69f0b9efea7c5d5'),'Alkol Raporu','2020-11-24 08:46:28','2020-11-24 08:46:28',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7e0edcbcb37791f4d6064764d977308e'),'İfade Tutanakları','2020-11-24 08:46:38','2020-11-24 08:46:38',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7b46673ed7a97e0616750c6ba5b54acf'),'İddianame','2020-11-24 08:46:43','2020-11-24 08:46:43',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e58db53ea13b32bdb77f70e1d2de3e7a'),'Bilir Kişi Raporu','2020-11-24 08:46:55','2020-11-24 08:46:55',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7159727ea59c6a267fb8c1ff4ce21b33'),'Mahkeme Kararı','2020-11-24 08:47:03','2020-11-24 08:47:03',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f7b39df7d75dce5f37b6def64faa7c50'),'Engelli Sağlık Kurul Raporu','2020-11-24 08:47:17','2020-11-24 08:47:17',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('ec40215b95eb29eaf6dddd00dbffeab9'),'Tedavi Evrakları','2020-11-24 08:47:24','2020-11-24 08:47:24',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7a69774fa6b472b0bacb2db942951f95'),'Gelir Belgesi','2020-11-24 08:47:30','2020-11-24 08:47:30',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('9028ea420516b019a03fc9f89e70aeeb'),'Vuk. Nüf. Kayıt Örneği','2020-11-24 08:47:45','2020-11-24 08:47:45',NULL);
INSERT INTO `form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('d30e0d52ba5480edaf5674b4c92073fc'),'Diğer','2020-11-24 08:48:05','2020-11-24 08:48:05',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('0af0caf76201c3e2246d730b0b26dcc2'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Vefaat Tazminaatı','0','2020-11-24 08:51:09','2020-11-24 08:51:09',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('10744252eb9739899160157ba27ebefa'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Türk Nippon Sigorta','0','2020-11-24 17:19:32','2020-11-24 17:19:32',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('1539ebc16366851579264a52ff6b255d'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Unico Sigorta','0','2020-11-24 17:19:41','2020-11-24 17:19:41',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('15c251c60a73c448b7f9c18acc32af20'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'HDI Sigorta','0','2020-11-24 17:17:44','2020-11-24 17:17:44',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('1a403e90179cefcd582ebba90d52d512'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Hazırlık','0','2020-11-24 08:49:12','2020-11-24 08:49:12',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('262b29ea6482f14f73d1c942a2e6f57a'),UNHEX('91a88b64d7685a98ac35414143de41da'),'A. Cengiz','0','2020-11-24 08:50:20','2020-11-24 08:50:20',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('2aee9d86b6ce734bf0ff33839a2d470b'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'İstinaf','0','2020-11-24 08:49:57','2020-11-24 08:49:57',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('2e4fe27cc8dc59cde5ea61e2e133a4cb'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ray Sigorta','0','2020-11-24 17:18:53','2020-11-24 17:18:53',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('380862adeb08d334ab9b90a9bbd54c93'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Tahkim','0','2020-11-24 08:50:05','2020-11-24 08:50:05',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('3ca6c3a96185b20fb28088a0455f700b'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'SBN Sigorta','0','2020-11-24 17:19:01','2020-11-24 17:19:01',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('3d24f1e52e52b5237df409950e65bc6d'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Mapfre Sigorta','0','2020-11-24 17:18:29','2020-11-24 17:18:29',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('40b73697149b94ac44534b921bc98d3e'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ergo Sigorta','0','2020-11-24 17:11:55','2020-11-24 17:11:55',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('5e855b10418081b955629777a6138c87'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Tahsilatlı Arşiv','0','2020-11-24 08:49:33','2020-11-24 08:49:33',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('6337e4de93f1c98e5d235f76237e242e'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Tahsilatsız Arşiv','0','2020-11-24 08:49:52','2020-11-24 08:49:52',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('65762d7583d8c21aedfaf3a8e6d43460'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Yolcu','0','2020-11-24 08:50:45','2020-11-24 08:50:45',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('728c82c8ad58b3857f1148c806c42faa'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Geçici İş göremezlik','0','2020-11-24 08:52:15','2020-11-24 08:52:15',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('74174aee618a6a6f4d8278e16a624577'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ak Sigorta','0','2020-11-24 17:10:56','2020-11-24 17:10:56',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('76e09d7fd6e3dba8342d64d1bbf61ce2'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Neova Sigorta','0','2020-11-24 17:18:48','2020-11-24 17:18:48',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7b30e562434a2fedea969b592e802dab'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ege Sigorta','0','2020-11-24 17:19:53','2020-11-24 17:19:53',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7beb50c6a8c7e85522722bb5a6677f7e'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Sürücü','0','2020-11-24 08:50:41','2020-11-24 08:50:41',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('8210397a5ba30760c2610576fbb7f8d0'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Manevi','0','2020-11-24 08:52:10','2020-11-24 08:52:10',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('831432218d977a0440de83bd0bcc92c3'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ankara Sigorta','0','2020-11-24 17:19:47','2020-11-24 17:19:47',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('8775df7b97d7305f0a8f831863077239'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Halk Sigorta','0','2020-11-24 17:16:36','2020-11-24 17:16:36',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('94d2e72fe6c5a13e1d414fa9e8cfca74'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Güneş Sigorta','0','2020-11-24 17:15:34','2020-11-24 17:15:34',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('955c2ca1b2a3dcaee07de11ea31d7b1d'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Aksa Sigorta','0','2020-11-24 17:11:14','2020-11-24 17:11:14',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('98c4626cfc9789a95b5b8dd500303f88'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Eureko Sigorta','0','2020-11-24 17:12:07','2020-11-24 17:12:07',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('a882a198daf7e7782fe5cef6c9cc2bc4'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Arşiv','0','2020-11-24 08:49:23','2020-11-24 08:49:23',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('af4b2c4b2e038eb2ac219b301f1a5be2'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Geçici Bakıcı','0','2020-11-24 08:52:20','2020-11-24 08:52:20',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('b8a20656f1898b350ea8d65a66533cbd'),UNHEX('91a88b64d7685a98ac35414143de41da'),'A. Özdemir','0','2020-11-24 08:50:27','2020-11-24 08:50:27',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('bfae27c2a8f18889c396ad3d9a55564a'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Maddi','0','2020-11-24 08:52:03','2020-11-24 08:52:03',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('c042e5cab09c98865da1e49310631376'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Sompojapan Sigorta','0','2020-11-24 17:19:18','2020-11-24 17:19:18',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('cbd433a9c6934a1d18bec4207ed1fd1c'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Sakatlık Tazminatı','0','2020-11-24 08:51:02','2020-11-24 08:51:02',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('d0fc09adb61e7f8bebaa6d5d814c5484'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Allians Sigorta','0','2020-11-24 17:11:04','2020-11-24 17:11:04',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('dae445c77cccd91c349326aa087b1719'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Güneş','0','2020-11-24 17:16:20','2020-11-24 17:16:20','2020-11-27 16:46:29');
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e2409ced920fc3a8d8f3ae0e7e109e82'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Doğa Sigorta','0','2020-11-24 17:11:30','2020-11-24 17:11:30',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e4f8366a49fdf6070ddde1121f873ec3'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Yaya','0','2020-11-24 08:50:49','2020-11-24 08:50:49',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('eb6d647b6241efca87290d4a281ff5d8'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Generali Sigorta','0','2020-11-24 17:13:02','2020-11-24 17:13:02',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f396dd1613508799af3189595522ff00'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Yargıtay','0','2020-11-24 08:50:01','2020-11-24 08:50:01',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fabdd185ff77f71328f58d81893672f8'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Derdest','0','2020-11-24 08:49:17','2020-11-24 08:49:17',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fd0d3e54fb342610bab6e9951c825867'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Grupama Sigorta','0','2020-11-24 17:14:48','2020-11-24 17:14:48',NULL);
INSERT INTO `form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('c7ee2762302182ebbf1ea9c1a56875f9'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Türkiye Sigorta','','2020-11-27 16:45:47','2020-11-27 16:45:47',NULL);
INSERT INTO `forms` (`id`,`type_id`,`file_id`,`require_id`,`user`,`data`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('00000000000000000000000000000000'),UNHEX('c3b142010929f59595a7137bd2adc089'),UNHEX(''),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'','2020-11-27 17:17:09','2020-11-27 17:17:09',NULL);
INSERT INTO `forms` (`id`,`type_id`,`file_id`,`require_id`,`user`,`data`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('00000000000000000000000000000000'),UNHEX('7aa54a99c1db61f25daa0bfa6650a6de'),UNHEX(''),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'','2020-11-28 13:40:00','2020-11-28 13:40:00',NULL);
INSERT INTO `settings` (`name`,`value`,`createdate`,`modifydate`,`deletedate`) VALUES ('appname','FormTakip','2020-11-15 21:22:35','2020-11-15 21:22:36',NULL);
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('13349a8a38be11709be1f6308c1e2295'),'Rıfat','kalay','45477d5e61015d7d6c1b0a31529e4d84','personel',UNHEX('00000000000000000000000000000000'),NULL,'2806584f7b72d145a1c0f888d515eca7.png','rifat_kalay58@gmail.com','','2020-11-24 14:32:06','2020-11-27 13:47:57','2020-11-24 14:32:06');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('2939a0b6843da113dd2999f6e20cbc07'),'Ayhan','GÜN','d48f761c9fbfbfc83793d270da71acc1','admin',UNHEX('00000000000000000000000000000000'),NULL,'c00ed1c9f1d361710e5441fd761ee396.png','ayhan.gun@hotmail.com','','2020-11-24 14:26:04','2020-11-27 13:47:02','2020-11-24 14:26:16');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('2dbac54d0cd70d924e053901be7c1975'),'Yaşar','ÖZKAN','70ac75b505363ee613123c61c6d07dea','kullanici',UNHEX('86a3bc863225834cf244dfcf7840c56f'),NULL,'','sivas@acente.com','','2020-11-24 14:32:31','2020-11-27 13:48:19','2020-11-24 14:32:31');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'admin','admin','20036a9ec3a8751ae987e6b7afbcbd5e','admin',UNHEX('00000000000000000000000000000000'),NULL,'c0038627badacc71c3c5d0b940d01541.png','admin@admin.com','','2020-11-24 08:43:13',NULL,'2020-11-24 14:28:35');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('af9ef6b10f0fe1a3b6f39e758f03097d'),'A','Cengiz','6d64c44225c7e36d91af33fafe3ece1d','personel',UNHEX('00000000000000000000000000000000'),NULL,'000a1e8d27390bfda1df6642aefc7246.png','a.cengiz@gmail.com','','2020-11-24 14:31:07','2020-11-27 13:47:59','2020-11-24 14:31:07');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('b9c2876e3d84c004c2bb476fe6e34f30'),'A','Özdemir','ee55effc578699e492353d737b181325','personel',UNHEX('00000000000000000000000000000000'),NULL,'128eca507a63e4b620347478ffc194dc.png','a.ozdemir@gmail.com','','2020-11-24 14:31:36','2020-11-27 16:33:58','2020-11-24 14:31:36');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('e90f682506ea030bf4d55637502f82bf'),'Nimet','ÖZÇELEN','5195dacabbea185567e62b2bcdd6de7c','kullanici',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),NULL,'','kayseri@acente.com','','2020-11-24 14:32:53','2020-11-27 13:48:21','2020-11-24 14:32:53');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('f803eb6037c38e5ed2688a5e8c57f01d'),'Gaye','DONUK','adad9c13083453576aae113363b240d6','admin',UNHEX('00000000000000000000000000000000'),NULL,'eb78e56096d635aa8c2453079bc6a021.png','gaye_donuk@hotmail.com','','2020-11-24 14:28:17','2020-11-27 13:47:00','2020-11-24 14:28:26');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('ffa7221607b9d99541d73b1ed3eaad7a'),'Günay','Bakırcı','e7e3bd39979b105c743d212b75d89cf4','admin',UNHEX('00000000000000000000000000000000'),NULL,'969f3aefdf670717e6f3f452404eb3a5.png','gunay.bakirci@hotmail.com','','2020-11-24 14:26:58','2020-11-27 13:46:57','2020-11-24 14:26:58');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('004ed586c5378cbd940a31c0f01b9a97'),'Mesut','Badem','e4c6a2be3b94d07ebebc6577a500b6c1','admin',UNHEX(''),NULL,'46b1b2bf23111d2a3f0d3c96fa877a6d.jpeg','mesut@dogruarabuluculuk.com','','2020-11-27 16:15:43',NULL,'2020-11-27 16:15:43');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('3ad4e17021bdf6ccb708e26637651d55'),'konya','deneme','e10adc3949ba59abbe56e057f20f883e','kullanici',UNHEX('62465906f0ccf5ddac733ea86eacc061'),NULL,'','konya@dogruarabuluculuk.com','','2020-11-27 16:18:31',NULL,'2020-11-27 16:18:31');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'Aysun','Özer','e10adc3949ba59abbe56e057f20f883e','personel',UNHEX(''),NULL,'','aysun@dogruarabuluculuk.com','','2020-11-27 16:32:28',NULL,'2020-11-27 16:32:28');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('c5306a3585dd5138bf7e4a8c71bbb963'),'Mecit ','Bilgiç','1acb3591de8d054c4d36a0f52b5dfdfa','admin',UNHEX(''),NULL,'34facee8a7903b1b31473568caa02f3d.jpeg','mecit@dogruarabuluculuk.com','','2020-11-27 17:09:35',NULL,'2020-11-27 17:12:28');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('a4211e9ca6683d4382b0aafe582fc541'),'Mehmet Emin','Arpacı','e10adc3949ba59abbe56e057f20f883e','kullanici',UNHEX('fb4ae21e062fa3c50f836cf74d779573'),NULL,'','emin@dogruarabuluculuk.com','','2020-11-27 17:15:21',NULL,'2020-11-27 17:15:21');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('3dc3c26df2b2babdcc9533c10d90fe3c'),'Ömer','Tarı','d20f973077774a3fcdb353452f9b647a','admin',UNHEX(''),NULL,'','omer@dogruarabuluculuk.com','','2020-11-27 17:37:36',NULL,'2020-11-27 17:37:36');
INSERT INTO `user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('dabcb94b4d54eaecdc5bb6d6917fb870'),'emre','dogan','e10adc3949ba59abbe56e057f20f883e','personel',UNHEX(''),NULL,'','emre@dogruarabuluculuk.com','','2020-11-27 19:59:51',NULL,'2020-11-27 19:59:51');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('7c21ae9dd9df5a4f614ab2a6d9b47378'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'1A403E90179CEFCD582EBBA90D52D512');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('0fa46f61c2458d245b4104a14e8efb24'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('91a88b64d7685a98ac35414143de41da'),'262B29EA6482F14F73D1C942A2E6F57A');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b8eacc4b5a617e3e67bc4e97a41e3a4d'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'65762D7583D8C21AEDFAF3A8E6D43460');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('1d0bd2efbe4adab5d053a2a4f47fcaf1'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'CBD433A9C6934A1D18BEC4207ED1FD1C');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('f161014a848a76f6d468ec58fac2225b'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'2020-11-27');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('7d1b0036f4465955cffc1d89a449236a'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'2020-11-27');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('8d864e9ecf965937ac2ade399a37e876'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'2009-03-27');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('fd4924d5cc47a51b9f0dbb8fa6b07469'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('f7428b8642b0fecbad92b0bf2b78e205'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('712fa718be8501ec9b2cb302e829a44d'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'BFAE27C2A8F18889C396AD3D9A55564A');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('3f3a8b763f69586f3794ed03c8c7db07'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'ömer tarı');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('72834fa3629835bb22f904213117e7c9'),UNHEX('70ecca997f2459f63ad54cde0dc547e1'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'3D24F1E52E52B5237DF409950E65BC6D');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('f8e79031cbc91312e17d8db36b9035c4'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'1A403E90179CEFCD582EBBA90D52D512');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b0f4b793e4119f2c498c72cef1f9c9ee'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('91a88b64d7685a98ac35414143de41da'),'262B29EA6482F14F73D1C942A2E6F57A');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('c0b456d39250948631c48827946c5638'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'65762D7583D8C21AEDFAF3A8E6D43460');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('13d5b2315fe36e7bb206c462c467f9ce'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Seçin');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('969b29459ba3dc858f04fe3cc2d6b3e5'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('bc778b3074c9bc9843d345848cf39af8'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('7122983b42682b4f7a9b24283bba096c'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('3b9400e538190c234d213ca5f4701ff6'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('5dc524a69d390a340c41bebd11a1875a'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('832cf7f11450e99279514f76a9226bdd'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'728C82C8AD58B3857F1148C806C42FAA');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b3e1e5406f70ab5759db754a7cf9ed94'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'njnjnjbhbvhbh');
INSERT INTO `values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('537106a3368b4f823ceac740612d37cd'),UNHEX('7861c534b1c19945624b626af576016e'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'E2409CED920FC3A8D8F3AE0E7E109E82');

COMMIT;