SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
SET time_zone = "+00:00";
SET NAMES utf8mb4;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
START TRANSACTION;
CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`acente` (
	`id` binary(16) NOT NULL,
	`name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`file` (
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

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`form_fields` (
	`id` binary(16) NOT NULL,
	`name` varchar(255) COLLATE utf8mb4_general_ci,
	`order` int(11),
	`type` varchar(50) COLLATE latin1_swedish_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`form_files` (
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

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`form_notes` (
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

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`form_require` (
	`id` binary(16),
	`name` varchar(50) COLLATE utf8mb4_general_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime
);

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`form_types` (
	`id` binary(16) NOT NULL,
	`name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`form_variables` (
	`id` binary(16) NOT NULL,
	`field_id` binary(16),
	`name` text COLLATE utf8mb4_general_ci,
	`order` int(11),
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`forms` (
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

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`notification` (
	`id` binary(16),
	`islem` text COLLATE utf8mb4_general_ci,
	`dosya` binary(16),
	`form` binary(16),
	`personel` binary(16),
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime
);

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`settings` (
	`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`value` longtext COLLATE utf8mb4_unicode_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime
);

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`user` (
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

CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`values` (
	`id` binary(16),
	`formid` binary(16),
	`field` binary(16),
	`text` text COLLATE utf8mb4_general_ci
);


TRUNCATE TABLE `u7417506_dosyatakip`.`acente`;
TRUNCATE TABLE `u7417506_dosyatakip`.`file`;
TRUNCATE TABLE `u7417506_dosyatakip`.`form_fields`;
TRUNCATE TABLE `u7417506_dosyatakip`.`form_files`;
TRUNCATE TABLE `u7417506_dosyatakip`.`form_notes`;
TRUNCATE TABLE `u7417506_dosyatakip`.`form_require`;
TRUNCATE TABLE `u7417506_dosyatakip`.`form_types`;
TRUNCATE TABLE `u7417506_dosyatakip`.`form_variables`;
TRUNCATE TABLE `u7417506_dosyatakip`.`forms`;
TRUNCATE TABLE `u7417506_dosyatakip`.`notification`;
TRUNCATE TABLE `u7417506_dosyatakip`.`settings`;
TRUNCATE TABLE `u7417506_dosyatakip`.`user`;
TRUNCATE TABLE `u7417506_dosyatakip`.`values`;

SET sql_notes = 1;
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),'Kayseri','','2020-11-24 14:29:05','2020-11-24 14:29:05',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('4c87fa5ac62b1da2e618f8431d1759e4'),'Yozgat','','2020-11-24 14:29:28','2020-11-24 14:29:28',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('5394864051d9f4b04c56c5b0ae13fd47'),'Bursa','','2020-11-24 14:29:32','2020-11-24 14:29:32',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('62465906f0ccf5ddac733ea86eacc061'),'Konya','','2020-11-24 14:29:21','2020-11-24 14:29:21',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('6664ac6c3249d2994d395a750d26fdc3'),'İstanbul','','2020-11-24 14:29:25','2020-11-24 14:29:25',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('86a3bc863225834cf244dfcf7840c56f'),'Sivas','','2020-11-24 14:29:08','2020-11-24 14:29:08',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('c0c3ff36086b4b0708fc80f17a8e9f9c'),'Niğde','','2020-11-24 14:29:14','2020-11-24 14:29:14',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`image`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fb4ae21e062fa3c50f836cf74d779573'),'ADANA','','2020-11-24 14:29:17','2020-11-24 14:29:17',NULL);
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('6b719eea9a81191fb6263e990d5e1b46'),'Leyla Çimen 17-05-2019 ','',UNHEX('86a3bc863225834cf244dfcf7840c56f'),UNHEX('13349a8a38be11709be1f6308c1e2295'),NULL,'2020-11-24 16:09:51','2020-11-24 16:09:51',NULL,'1');
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('41faf4f06727ac3d6ffc5074c1b0abff'),'','',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),UNHEX('af9ef6b10f0fe1a3b6f39e758f03097d'),NULL,'2020-11-24 16:37:41','2020-11-24 16:37:41',NULL,'2');
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('7a198283b095f1b93db9cdbfb9596b22'),'wdefghjkç','',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),UNHEX('13349a8a38be11709be1f6308c1e2295'),NULL,'2020-11-26 14:02:27','2020-11-26 14:02:27',NULL,'3');
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('34a3217e96df249e089a6f33496a6ab1'),'','',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),UNHEX('13349a8a38be11709be1f6308c1e2295'),NULL,'2020-11-26 14:08:35','2020-11-26 14:08:35',NULL,'4');
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'Hasar Adli Tıp Teslim Tarihi','7','date','2020-11-24 08:51:41','2020-11-24 08:51:41',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Mağdurun konumu','2','select','2020-11-24 08:50:35','2020-11-24 08:50:35',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('21d25dcf24373baeb847f52815bbd746'),'Sigorta Şirketleri','11','select','2020-11-24 17:10:09','2020-11-24 17:10:22',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Tazminat Türü','9','select','2020-11-24 08:51:54','2020-11-24 08:51:54',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('44a9c75c7e4763114699697a6307bd00'),'Dosya Durumu','0','select','2020-11-24 08:48:57','2020-11-24 08:48:57',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'Hasar  Hukuk Teslim Tarihi','6','date','2020-11-24 08:51:36','2020-11-24 08:51:36',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('91a88b64d7685a98ac35414143de41da'),'Taraf Şirketi','1','select','2020-11-24 08:50:14','2020-11-24 08:50:14',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('9ad70292ddac62f604f79c57e78896d9'),'Müvekkil','10','text','2020-11-24 11:23:22','2020-11-24 11:23:22',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'Hasar Tarihi','4','date','2020-11-24 08:51:16','2020-11-24 08:51:16',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('de359388539e4d1e2ad32756ed576fd6'),'Adli Tıp Hukuk Teslim Tarihi','8','date','2020-11-24 08:51:48','2020-11-24 08:51:48',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'Dosya Geliş Tarihi','5','date','2020-11-24 08:51:25','2020-11-24 08:51:25',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Tanzim Türü','3','select','2020-11-24 08:50:57','2020-11-24 08:50:57',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_files` (`id`,`user`,`requireid`,`fileid`,`filepath`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('64731ff66acb36a1d48b91368af6455e'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),UNHEX('ba2bb3d918e53f43e4f31b8540bfe3f0'),UNHEX('6b719eea9a81191fb6263e990d5e1b46'),'c1e1ccf7afb3d9262b8d84b4f2eb9b9e.jpg','2020-11-24 16:15:47','2020-11-24 16:15:47',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_files` (`id`,`user`,`requireid`,`fileid`,`filepath`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('9eac243bbb7e1f445f04f00252e022f8'),UNHEX('2939a0b6843da113dd2999f6e20cbc07'),UNHEX('dd595578e638171bd69f0b9efea7c5d5'),UNHEX('6b719eea9a81191fb6263e990d5e1b46'),'fc25e66f241727ce48ca925d4e41aba5.xlsx','2020-11-24 16:39:34','2020-11-24 16:39:34',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('35313631643164663066316562316263'),UNHEX('6b719eea9a81191fb6263e990d5e1b46'),UNHEX('2939a0b6843da113dd2999f6e20cbc07'),'DENEME','Adli Tıp','2020-11-24 17:08:11',NULL,NULL);
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('37663339666638386537376465386230'),UNHEX('2eb83f191477f89df6c6d11f3b69dd61'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'deneme','Hasar','2020-11-24 15:31:52',NULL,'2020-11-24 15:32:00');
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('65393031623065333964623930343037'),UNHEX('6b719eea9a81191fb6263e990d5e1b46'),UNHEX('2939a0b6843da113dd2999f6e20cbc07'),'deneme','Hasar','2020-11-24 16:35:11',NULL,NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('b9b06a5ffb7b3bd62fc70a73d9e7013e'),'Vekaletname','2020-11-24 08:45:45','2020-11-24 08:45:45',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('262e41cbd5de10bf121c1ffe5e02b5fe'),'Sözleşme','2020-11-24 08:45:52','2020-11-24 08:45:52',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('00e1d4ad694712587e485828ba6a4d4c'),'Poliçe','2020-11-24 08:45:57','2020-11-24 08:45:57',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('efa13b1c2aa092d46df4d7bee243da6e'),'Kaza Tespit Tutanağı','2020-11-24 08:46:10','2020-11-24 08:46:10',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('ba2bb3d918e53f43e4f31b8540bfe3f0'),'Ruhsat','2020-11-24 08:46:15','2020-11-24 08:46:15',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('5514f7256f1b2a160c73f8d63860fda0'),'Ehliyet','2020-11-24 08:46:20','2020-11-24 08:46:20',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('dd595578e638171bd69f0b9efea7c5d5'),'Alkol Raporu','2020-11-24 08:46:28','2020-11-24 08:46:28',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7e0edcbcb37791f4d6064764d977308e'),'İfade Tutanakları','2020-11-24 08:46:38','2020-11-24 08:46:38',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7b46673ed7a97e0616750c6ba5b54acf'),'İddianame','2020-11-24 08:46:43','2020-11-24 08:46:43',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e58db53ea13b32bdb77f70e1d2de3e7a'),'Bilir Kişi Raporu','2020-11-24 08:46:55','2020-11-24 08:46:55',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7159727ea59c6a267fb8c1ff4ce21b33'),'Mahkeme Kararı','2020-11-24 08:47:03','2020-11-24 08:47:03',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f7b39df7d75dce5f37b6def64faa7c50'),'Engelli Sağlık Kurul Raporu','2020-11-24 08:47:17','2020-11-24 08:47:17',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('ec40215b95eb29eaf6dddd00dbffeab9'),'Tedavi Evrakları','2020-11-24 08:47:24','2020-11-24 08:47:24',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7a69774fa6b472b0bacb2db942951f95'),'Gelir Belgesi','2020-11-24 08:47:30','2020-11-24 08:47:30',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('9028ea420516b019a03fc9f89e70aeeb'),'Vuk. Nüf. Kayıt Örneği','2020-11-24 08:47:45','2020-11-24 08:47:45',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('d30e0d52ba5480edaf5674b4c92073fc'),'Diğer','2020-11-24 08:48:05','2020-11-24 08:48:05',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('0af0caf76201c3e2246d730b0b26dcc2'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Vefaat Tazminaatı','0','2020-11-24 08:51:09','2020-11-24 08:51:09',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('10744252eb9739899160157ba27ebefa'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Türk Nippon Sigorta','0','2020-11-24 17:19:32','2020-11-24 17:19:32',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('1539ebc16366851579264a52ff6b255d'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Unico Sigorta','0','2020-11-24 17:19:41','2020-11-24 17:19:41',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('15c251c60a73c448b7f9c18acc32af20'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'HDI Sigorta','0','2020-11-24 17:17:44','2020-11-24 17:17:44',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('1a403e90179cefcd582ebba90d52d512'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Hazırlık','0','2020-11-24 08:49:12','2020-11-24 08:49:12',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('262b29ea6482f14f73d1c942a2e6f57a'),UNHEX('91a88b64d7685a98ac35414143de41da'),'A. Cengiz','0','2020-11-24 08:50:20','2020-11-24 08:50:20',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('2aee9d86b6ce734bf0ff33839a2d470b'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'İstinaf','0','2020-11-24 08:49:57','2020-11-24 08:49:57',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('2e4fe27cc8dc59cde5ea61e2e133a4cb'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ray Sigorta','0','2020-11-24 17:18:53','2020-11-24 17:18:53',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('380862adeb08d334ab9b90a9bbd54c93'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Tahkim','0','2020-11-24 08:50:05','2020-11-24 08:50:05',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('3ca6c3a96185b20fb28088a0455f700b'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'SBN Sigorta','0','2020-11-24 17:19:01','2020-11-24 17:19:01',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('3d24f1e52e52b5237df409950e65bc6d'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Mapfre Sigorta','0','2020-11-24 17:18:29','2020-11-24 17:18:29',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('40b73697149b94ac44534b921bc98d3e'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ergo Sigorta','0','2020-11-24 17:11:55','2020-11-24 17:11:55',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('5e855b10418081b955629777a6138c87'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Tahsilatlı Arşiv','0','2020-11-24 08:49:33','2020-11-24 08:49:33',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('6337e4de93f1c98e5d235f76237e242e'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Tahsilatsız Arşiv','0','2020-11-24 08:49:52','2020-11-24 08:49:52',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('65762d7583d8c21aedfaf3a8e6d43460'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Yolcu','0','2020-11-24 08:50:45','2020-11-24 08:50:45',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('728c82c8ad58b3857f1148c806c42faa'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Geçici İş göremezlik','0','2020-11-24 08:52:15','2020-11-24 08:52:15',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('74174aee618a6a6f4d8278e16a624577'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ak Sigorta','0','2020-11-24 17:10:56','2020-11-24 17:10:56',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('76e09d7fd6e3dba8342d64d1bbf61ce2'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Neova Sigorta','0','2020-11-24 17:18:48','2020-11-24 17:18:48',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7b30e562434a2fedea969b592e802dab'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ege Sigorta','0','2020-11-24 17:19:53','2020-11-24 17:19:53',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7beb50c6a8c7e85522722bb5a6677f7e'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Sürücü','0','2020-11-24 08:50:41','2020-11-24 08:50:41',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('8210397a5ba30760c2610576fbb7f8d0'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Manevi','0','2020-11-24 08:52:10','2020-11-24 08:52:10',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('831432218d977a0440de83bd0bcc92c3'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ankara Sigorta','0','2020-11-24 17:19:47','2020-11-24 17:19:47',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('8775df7b97d7305f0a8f831863077239'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Halk Sigorta','0','2020-11-24 17:16:36','2020-11-24 17:16:36',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('94d2e72fe6c5a13e1d414fa9e8cfca74'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Güneş Sigorta','0','2020-11-24 17:15:34','2020-11-24 17:15:34',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('955c2ca1b2a3dcaee07de11ea31d7b1d'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Aksa Sigorta','0','2020-11-24 17:11:14','2020-11-24 17:11:14',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('98c4626cfc9789a95b5b8dd500303f88'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Eureko Sigorta','0','2020-11-24 17:12:07','2020-11-24 17:12:07',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('a882a198daf7e7782fe5cef6c9cc2bc4'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Arşiv','0','2020-11-24 08:49:23','2020-11-24 08:49:23',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('af4b2c4b2e038eb2ac219b301f1a5be2'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Geçici Bakıcı','0','2020-11-24 08:52:20','2020-11-24 08:52:20',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('b8a20656f1898b350ea8d65a66533cbd'),UNHEX('91a88b64d7685a98ac35414143de41da'),'A. Özdemir','0','2020-11-24 08:50:27','2020-11-24 08:50:27',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('bfae27c2a8f18889c396ad3d9a55564a'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Maddi','0','2020-11-24 08:52:03','2020-11-24 08:52:03',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('c042e5cab09c98865da1e49310631376'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Sompojapan Sigorta','0','2020-11-24 17:19:18','2020-11-24 17:19:18',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('cbd433a9c6934a1d18bec4207ed1fd1c'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Sakatlık Tazminatı','0','2020-11-24 08:51:02','2020-11-24 08:51:02',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('d0fc09adb61e7f8bebaa6d5d814c5484'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Allians Sigorta','0','2020-11-24 17:11:04','2020-11-24 17:11:04',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('dae445c77cccd91c349326aa087b1719'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Güneş','0','2020-11-24 17:16:20','2020-11-24 17:16:20',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e2409ced920fc3a8d8f3ae0e7e109e82'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Doğa Sigorta','0','2020-11-24 17:11:30','2020-11-24 17:11:30',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e4f8366a49fdf6070ddde1121f873ec3'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Yaya','0','2020-11-24 08:50:49','2020-11-24 08:50:49',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('eb6d647b6241efca87290d4a281ff5d8'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Generali Sigorta','0','2020-11-24 17:13:02','2020-11-24 17:13:02',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f396dd1613508799af3189595522ff00'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Yargıtay','0','2020-11-24 08:50:01','2020-11-24 08:50:01',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fabdd185ff77f71328f58d81893672f8'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Desdest','0','2020-11-24 08:49:17','2020-11-24 08:49:17',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fd0d3e54fb342610bab6e9951c825867'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Grupama Sigorta','0','2020-11-24 17:14:48','2020-11-24 17:14:48',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`type_id`,`file_id`,`require_id`,`user`,`data`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('00000000000000000000000000000000'),UNHEX('41faf4f06727ac3d6ffc5074c1b0abff'),UNHEX('00000000000000000000000000000000'),UNHEX('af9ef6b10f0fe1a3b6f39e758f03097d'),'','2020-11-24 16:37:41','2020-11-24 16:37:41',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`type_id`,`file_id`,`require_id`,`user`,`data`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('00000000000000000000000000000000'),UNHEX('6b719eea9a81191fb6263e990d5e1b46'),UNHEX('00000000000000000000000000000000'),UNHEX('13349a8a38be11709be1f6308c1e2295'),'','2020-11-24 16:09:51','2020-11-24 16:09:51',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`type_id`,`file_id`,`require_id`,`user`,`data`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('00000000000000000000000000000000'),UNHEX('7a198283b095f1b93db9cdbfb9596b22'),UNHEX(''),UNHEX('13349a8a38be11709be1f6308c1e2295'),'','2020-11-26 14:02:27','2020-11-26 14:02:27',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`type_id`,`file_id`,`require_id`,`user`,`data`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('00000000000000000000000000000000'),UNHEX('34a3217e96df249e089a6f33496a6ab1'),UNHEX(''),UNHEX('13349a8a38be11709be1f6308c1e2295'),'','2020-11-26 14:08:35','2020-11-26 14:08:35',NULL);
INSERT INTO `u7417506_dosyatakip`.`settings` (`name`,`value`,`createdate`,`modifydate`,`deletedate`) VALUES ('appname','FormTakip','2020-11-15 21:22:35','2020-11-15 21:22:36',NULL);
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('13349a8a38be11709be1f6308c1e2295'),'Rıfat','kalay','45477d5e61015d7d6c1b0a31529e4d84','personel',UNHEX('00000000000000000000000000000000'),NULL,'2806584f7b72d145a1c0f888d515eca7.png','rifat_kalay58@gmail.com','','2020-11-24 14:32:06',NULL,'2020-11-24 14:32:06');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('2939a0b6843da113dd2999f6e20cbc07'),'Ayhan','GÜN','d48f761c9fbfbfc83793d270da71acc1','admin',UNHEX('00000000000000000000000000000000'),NULL,'c00ed1c9f1d361710e5441fd761ee396.png','ayhan.gun@hotmail.com','','2020-11-24 14:26:04',NULL,'2020-11-24 14:26:16');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('2dbac54d0cd70d924e053901be7c1975'),'Yaşar','ÖZKAN','70ac75b505363ee613123c61c6d07dea','kullanici',UNHEX('86a3bc863225834cf244dfcf7840c56f'),NULL,'','sivas@acente.com','','2020-11-24 14:32:31',NULL,'2020-11-24 14:32:31');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'admin','admin','20036a9ec3a8751ae987e6b7afbcbd5e','admin',UNHEX('00000000000000000000000000000000'),NULL,'c0038627badacc71c3c5d0b940d01541.png','admin@admin.com','','2020-11-24 08:43:13',NULL,'2020-11-24 14:28:35');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('af9ef6b10f0fe1a3b6f39e758f03097d'),'A','Cengiz','6d64c44225c7e36d91af33fafe3ece1d','personel',UNHEX('00000000000000000000000000000000'),NULL,'000a1e8d27390bfda1df6642aefc7246.png','a.cengiz@gmail.com','','2020-11-24 14:31:07',NULL,'2020-11-24 14:31:07');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('b9c2876e3d84c004c2bb476fe6e34f30'),'A','Özdemir','ee55effc578699e492353d737b181325','personel',UNHEX('00000000000000000000000000000000'),NULL,'128eca507a63e4b620347478ffc194dc.png','a.ozdemir@gmail.com','','2020-11-24 14:31:36',NULL,'2020-11-24 14:31:36');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('e90f682506ea030bf4d55637502f82bf'),'Nimet','ÖZÇELEN','5195dacabbea185567e62b2bcdd6de7c','kullanici',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),NULL,'','kayseri@acente.com','','2020-11-24 14:32:53',NULL,'2020-11-24 14:32:53');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('f803eb6037c38e5ed2688a5e8c57f01d'),'Gaye','DONUK','adad9c13083453576aae113363b240d6','admin',UNHEX('00000000000000000000000000000000'),NULL,'eb78e56096d635aa8c2453079bc6a021.png','gaye_donuk@hotmail.com','','2020-11-24 14:28:17',NULL,'2020-11-24 14:28:26');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('ffa7221607b9d99541d73b1ed3eaad7a'),'Günay','Bakırcı','e7e3bd39979b105c743d212b75d89cf4','admin',UNHEX('00000000000000000000000000000000'),NULL,'969f3aefdf670717e6f3f452404eb3a5.png','gunay.bakirci@hotmail.com','','2020-11-24 14:26:58',NULL,'2020-11-24 14:26:58');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('2bf7a64db61d27d90fe39a6576a672db'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'6337E4DE93F1C98E5D235F76237E242E');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('330e4b155f9b48ab0ef219f359172074'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('91a88b64d7685a98ac35414143de41da'),'B8A20656F1898B350EA8D65A66533CBD');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('aa397bdbc3a48f3b1aa786b21acdb6a9'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'65762D7583D8C21AEDFAF3A8E6D43460');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('2729714358b3967847e8887200eeb822'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'CBD433A9C6934A1D18BEC4207ED1FD1C');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('7747818e846f074e27f9d4d7b0af7515'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('f50e00101e4133c02597e72d239cb5bf'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('39933671c1f8fce2ee1cad34bac710a0'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('e57198e2f5d6e1c82dec494346bbf4fe'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('a1cb941f6e0700caa7a746a8cafda316'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('84f9c9f43ee6e9e98d1f37d2217ad86e'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'AF4B2C4B2E038EB2AC219B301F1A5BE2');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('220600ed881338854011cb449150eb1f'),UNHEX('d572851de96790961fca0d3daff1c296'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'arif toy');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('d7581667056c3e6bfa25e8e8e99abcc1'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'F396DD1613508799AF3189595522FF00');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('be1b985ff30d22856583a53e9627f2f4'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('91a88b64d7685a98ac35414143de41da'),'262B29EA6482F14F73D1C942A2E6F57A');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('dcbb61a64c47f883eaf4cafb8495b33d'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'65762D7583D8C21AEDFAF3A8E6D43460');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('816b74e65daf371a3adcad3e5d0c4254'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'0AF0CAF76201C3E2246D730B0B26DCC2');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('4dbd94f9812c05cf41f25d1f0846d902'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('5992d1b3731ac672a474d8bfe26c2364'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('6f73ce59fc8129ba708e4d6952fc9fde'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('efc81542ed48ec665c7d80522c969de4'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b29434a3ea58786d8e6682dd112a55e3'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'2020-11-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('c42bd30a67849b6e95b87ce029d192b9'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'BFAE27C2A8F18889C396AD3D9A55564A');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('d98352ac7787d340f6860e10fc4df86a'),UNHEX('6461d5539b42f0dfc154aa60a8d58eb8'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'mesut badem');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('8b6d67706a3e513e3dacbc2b5d1603c5'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('62d195d98f4e8b6afcf0188b27ad3748'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('91a88b64d7685a98ac35414143de41da'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('4d6b3ed71735b5de7a759cf3ced3cc5a'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('10d806f0fe7054a573c13e4c16bdec23'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b1ce72f5345c645840bc0d89ae584bf8'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('fa2347da5c5afe85b7203856c6683e85'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('ebebe525b3ff7b603e0e1f4e2223b365'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('665a763678c8aac39215408a5bbd975b'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('d0683d4990b1b88c32bea75eaf264639'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b0d3a58db1860e80d2d80aae35153455'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('f97673673c0c0dd6a13ae62c65f4df96'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('5550d498881ad6108b54466fb885565d'),UNHEX('22edb12e2e7f60407ccff4ddba895426'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b35bb6ff362ab7e46e0f8e20a1099280'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('0fd7c167ab4f00d6dbb3ae77a44f6dbb'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('91a88b64d7685a98ac35414143de41da'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('6d8bfff9bc78deb29056e716621a8f70'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('d9a5692c380334ba76999a2e5173abd2'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('ebddae01ff87a8aa8a5555d81dc8d1b6'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('4674f45eab97b842da3dcfa10ca0fbf5'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('aa30a8a80a0e7fdfafd68b1faf0dd9ce'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('8a6f3ba9d8cd7939e4cd4bb8a6e90616'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('32d34b746bcee49761c88d79577869ec'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('3d01faa3d7bd05bb6ebb3da9ea9ff4de'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('3fbe43a6a1edf848dfa60093747fecd2'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b50696e2d9efd03785b62c3221f1c9dc'),UNHEX('af26d2e1e97c62dbd8b931380e7b8637'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Seçin');

COMMIT;