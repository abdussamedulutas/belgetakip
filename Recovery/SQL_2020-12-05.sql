SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
SET time_zone = "+00:00";
SET NAMES utf8mb4;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
START TRANSACTION;
DROP TABLE `u7417506_dosyatakip`.`acente`;
CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`acente` (
	`id` binary(16) NOT NULL,
	`name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

DROP TABLE `u7417506_dosyatakip`.`file`;
CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`file` (
	`id` binary(16),
	`name` varchar(50) COLLATE utf8mb4_general_ci,
	`required_forms` text COLLATE utf8mb4_general_ci,
	`acente_id` binary(16),
	`personel_id` binary(16),
	`avukat_id` binary(16),
	`lastinsetdate` datetime,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	`order` int(11)
);

DROP TABLE `u7417506_dosyatakip`.`form_fields`;
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

DROP TABLE `u7417506_dosyatakip`.`form_files`;
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

DROP TABLE `u7417506_dosyatakip`.`form_notes`;
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

DROP TABLE `u7417506_dosyatakip`.`form_require`;
CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`form_require` (
	`id` binary(16),
	`name` varchar(50) COLLATE utf8mb4_general_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime
);

DROP TABLE `u7417506_dosyatakip`.`form_types`;
CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`form_types` (
	`id` binary(16) NOT NULL,
	`name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

DROP TABLE `u7417506_dosyatakip`.`form_variables`;
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

DROP TABLE `u7417506_dosyatakip`.`forms`;
CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`forms` (
	`id` binary(16) NOT NULL,
	`file_id` binary(16),
	`require_id` binary(16),
	`user` binary(16) NOT NULL,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime,
	PRIMARY KEY(`id`)
);

DROP TABLE `u7417506_dosyatakip`.`notification`;
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

DROP TABLE `u7417506_dosyatakip`.`settings`;
CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`settings` (
	`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`value` longtext COLLATE utf8mb4_unicode_ci,
	`createdate` datetime,
	`modifydate` datetime,
	`deletedate` datetime
);

DROP TABLE `u7417506_dosyatakip`.`user`;
CREATE TABLE IF NOT EXISTS `u7417506_dosyatakip`.`user` (
	`id` binary(16) NOT NULL,
	`name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	`surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	`password` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
	`acente_id` binary(16),
	`birthday` datetime,
	`image` longtext COLLATE utf8mb4_unicode_ci,
	`email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
	`extra` longtext COLLATE utf8mb4_unicode_ci,
	`createdate` datetime,
	`deletedate` datetime,
	`modifydate` datetime,
	PRIMARY KEY(`id`)
);

DROP TABLE `u7417506_dosyatakip`.`values`;
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
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),'Kayseri','2020-11-24 14:29:05','2020-11-24 14:29:05',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('4c87fa5ac62b1da2e618f8431d1759e4'),'Yozgat','2020-11-24 14:29:28','2020-11-24 14:29:28','2020-12-04 11:33:50');
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('5394864051d9f4b04c56c5b0ae13fd47'),'Bursa','2020-11-24 14:29:32','2020-11-24 14:29:32',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('62465906f0ccf5ddac733ea86eacc061'),'Konya','2020-11-24 14:29:21','2020-11-24 14:29:21',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('6664ac6c3249d2994d395a750d26fdc3'),'İstanbul','2020-11-24 14:29:25','2020-11-24 14:29:25',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('86a3bc863225834cf244dfcf7840c56f'),'Sivas','2020-11-24 14:29:08','2020-11-24 14:29:08',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('c0c3ff36086b4b0708fc80f17a8e9f9c'),'Niğde','2020-11-24 14:29:14','2020-11-24 14:29:14',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fb4ae21e062fa3c50f836cf74d779573'),'Adana','2020-11-24 14:29:17','2020-11-24 14:29:17',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('2885195ca8cca49f5bc09a291433ebdb'),'jhgfcx','2020-12-04 11:59:08','2020-12-04 11:59:08','2020-12-04 11:59:22');
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('3012504a6fefd415a788edcdb6755286'),'Yozgat','2020-12-04 11:59:53','2020-12-04 11:59:53',NULL);
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('0c3b5b130a60541ab0e05247b01c40be'),'YOZGOT','2020-12-04 12:00:02','2020-12-04 12:00:02','2020-12-04 12:04:45');
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('8c01df717e02f6d0bb7b4678ae1f1b67'),'YOZGAT','2020-12-04 12:00:06','2020-12-04 12:00:06','2020-12-04 12:04:54');
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('0e5440149e6851d9e7bdb1500d90898d'),'Yozgat','2020-12-04 12:03:21','2020-12-04 12:03:21','2020-12-04 12:04:51');
INSERT INTO `u7417506_dosyatakip`.`acente` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('ce19972a1223c7b1327b9433e434d758'),'Yozgat','2020-12-04 12:04:41','2020-12-04 12:04:41','2020-12-04 12:04:48');
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`avukat_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('305119376d9cb88acd5be82400a02a64'),'Test dosya','',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),UNHEX('4b9a5dcef97c279fded0e89fe098a64d'),'2020-12-04 15:31:51','2020-12-04 15:19:24','2020-12-04 15:27:48',NULL,'1');
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`avukat_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('9a0c732b9d45112ab6c0680a44f824c0'),'','',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),UNHEX('4b9a5dcef97c279fded0e89fe098a64d'),'2020-12-04 15:26:48','2020-12-04 15:26:48','2020-12-04 15:26:48',NULL,'2');
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`avukat_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('cead6b7ef8cac72a63bfd9ee347fc322'),'Test','',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),UNHEX('4b9a5dcef97c279fded0e89fe098a64d'),'2020-12-04 15:27:28','2020-12-04 15:27:28','2020-12-05 09:01:34',NULL,'3');
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`avukat_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('86bfd5c3725492fbe359eedac863a324'),'Avukatlık','',UNHEX('62465906f0ccf5ddac733ea86eacc061'),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),UNHEX('81587627f25f5813d8ac0f3e8b62acd7'),'2020-12-04 15:33:12','2020-12-04 15:33:12','2020-12-04 15:33:12',NULL,'4');
INSERT INTO `u7417506_dosyatakip`.`file` (`id`,`name`,`required_forms`,`acente_id`,`personel_id`,`avukat_id`,`lastinsetdate`,`createdate`,`modifydate`,`deletedate`,`order`) VALUES (UNHEX('602c3457b3a1e4bdc1cef2656f1d90e6'),'Şebnemin dosyası','',UNHEX('c0c3ff36086b4b0708fc80f17a8e9f9c'),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),UNHEX('81587627f25f5813d8ac0f3e8b62acd7'),'2020-12-04 16:27:07','2020-12-04 16:26:25','2020-12-04 16:26:25',NULL,'5');
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'Hasar Adli Tıp Teslim Tarihi','5','date','2020-11-24 08:51:41','2020-12-05 09:03:35',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Mağdurun konumu','1','select','2020-11-24 08:50:35','2020-12-05 09:03:12',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('21d25dcf24373baeb847f52815bbd746'),'Sigorta Şirketi','8','select','2020-11-24 17:10:09','2020-12-05 09:04:01',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Tazminat Türü','9','select','2020-11-24 08:51:54','2020-11-24 08:51:54','2020-12-01 11:49:39');
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('44a9c75c7e4763114699697a6307bd00'),'Dosya Durumu','0','select','2020-11-24 08:48:57','2020-11-24 08:48:57',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'Hasar  Hukuk Teslim Tarihi','4','date','2020-11-24 08:51:36','2020-12-05 09:03:27',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('91a88b64d7685a98ac35414143de41da'),'İlgili Avukat','1','select','2020-11-24 08:50:14','2020-12-01 11:52:44','2020-12-02 13:35:41');
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('9ad70292ddac62f604f79c57e78896d9'),'Müvekkil İsmi','7','text','2020-11-24 11:23:22','2020-12-05 09:03:58',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'Hasar Tarihi','11','date','2020-11-24 08:51:16','2020-12-05 09:04:13',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('de359388539e4d1e2ad32756ed576fd6'),'Adli Tıp Hukuk Teslim Tarihi','6','date','2020-11-24 08:51:48','2020-12-05 09:03:36',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'Dosya Geliş Tarihi','3','date','2020-11-24 08:51:25','2020-12-05 09:03:26',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Dosya Türü','2','select','2020-11-24 08:50:57','2020-12-05 09:03:17',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('166ef8d7bb247111578c2e1f6bb0c484'),'Sigorta Başvuru','9','date','2020-12-01 11:45:31','2020-12-05 09:04:04',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_fields` (`id`,`name`,`order`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('097a549f860f84424aedf9c75a6eeb59'),'Tahkim Başvuru','10','date','2020-12-01 11:45:44','2020-12-05 09:04:10',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_files` (`id`,`user`,`requireid`,`fileid`,`filepath`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('a80105fb321a07b2b40afbc567136a04'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),UNHEX('dd595578e638171bd69f0b9efea7c5d5'),UNHEX('305119376d9cb88acd5be82400a02a64'),'74d5fc3dc3140e05145a31d8badf30ac.xls','2020-12-04 15:28:09','2020-12-04 15:28:09',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_files` (`id`,`user`,`requireid`,`fileid`,`filepath`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fad8487712729a9319b703179c19be1e'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),UNHEX('ec40215b95eb29eaf6dddd00dbffeab9'),UNHEX('305119376d9cb88acd5be82400a02a64'),'fc6cae2f0812041f7afc4e6692569372.xls','2020-12-04 15:28:39','2020-12-04 15:28:39',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_files` (`id`,`user`,`requireid`,`fileid`,`filepath`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('2af26bc7305346ac8ff0a8cea6f6c3c0'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),UNHEX('9028ea420516b019a03fc9f89e70aeeb'),UNHEX('602c3457b3a1e4bdc1cef2656f1d90e6'),'49b0b6448ff23a5a7da50af61b810eb1.jpg','2020-12-04 16:27:07','2020-12-04 16:27:07',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('834c93b5b93f259beed48f793b9f2ed9'),UNHEX('305119376d9cb88acd5be82400a02a64'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'Evraklar geldi','Avukat','2020-12-04 15:28:20',NULL,NULL);
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('4558f7f60dd304bafc4a868adf8e22a0'),UNHEX('305119376d9cb88acd5be82400a02a64'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'Kaza yok','İş Kazası','2020-12-04 15:28:31',NULL,NULL);
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('7018c004417521a5fbd00b91790f39b9'),UNHEX('305119376d9cb88acd5be82400a02a64'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'Yum','Avukat','2020-12-04 15:29:40',NULL,NULL);
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('bba80b3385beb104afd6fd016a29079c'),UNHEX('305119376d9cb88acd5be82400a02a64'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'Yum','Avukat','2020-12-04 15:30:42',NULL,NULL);
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('6f1b316c98f495a4f0ce184173214ac9'),UNHEX('305119376d9cb88acd5be82400a02a64'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'Araba arka camı kırık','Hasar','2020-12-04 15:31:18',NULL,NULL);
INSERT INTO `u7417506_dosyatakip`.`form_notes` (`id`,`file_id`,`user`,`text`,`type`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('cdb94d88b3e0fa666108bbc9bad4f127'),UNHEX('305119376d9cb88acd5be82400a02a64'),UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'Ayrıca perte çıkmış','Hasar','2020-12-04 15:31:51',NULL,NULL);
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
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('ce4274b3d794dddefd2e97990c5dca5a'),'Tahkim Başvurusu','2020-12-01 11:51:29','2020-12-01 11:51:29',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('720c8d8d57eaddf61f390996f393928a'),'Sigorta Başvurusu','2020-12-01 11:51:37','2020-12-01 11:51:37',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('35f877ec7cf4db5294d119748028891f'),'Tahkim Hesap Raporu','2020-12-01 11:51:46','2020-12-01 11:51:46',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('87d75ac32649bf70a1d9367e6dbc995c'),'Tahkim Kusur Raporu','2020-12-01 11:51:55','2020-12-01 11:51:55',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_require` (`id`,`name`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('77fcbe01ab9eb2159c6e663bea182a91'),'Tahkim Kararı','2020-12-01 11:52:04','2020-12-01 11:52:04',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('0af0caf76201c3e2246d730b0b26dcc2'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Destek Tazminatı','0','2020-11-24 08:51:09','2020-11-24 08:51:09',NULL);
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
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('955c2ca1b2a3dcaee07de11ea31d7b1d'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Axa Sigorta','0','2020-11-24 17:11:14','2020-11-24 17:11:14',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('98c4626cfc9789a95b5b8dd500303f88'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Eureko Sigorta','0','2020-11-24 17:12:07','2020-11-24 17:12:07',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('a882a198daf7e7782fe5cef6c9cc2bc4'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Arşiv','0','2020-11-24 08:49:23','2020-11-24 08:49:23',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('af4b2c4b2e038eb2ac219b301f1a5be2'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Geçici Bakıcı','0','2020-11-24 08:52:20','2020-11-24 08:52:20',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('b8a20656f1898b350ea8d65a66533cbd'),UNHEX('91a88b64d7685a98ac35414143de41da'),'A. Özdemir','0','2020-11-24 08:50:27','2020-11-24 08:50:27',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('bfae27c2a8f18889c396ad3d9a55564a'),UNHEX('223ed9aed75b31321b0e4c7b14d4741a'),'Maddi','0','2020-11-24 08:52:03','2020-11-24 08:52:03',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('c042e5cab09c98865da1e49310631376'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Sompo Sigorta','0','2020-11-24 17:19:18','2020-11-24 17:19:18',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('cbd433a9c6934a1d18bec4207ed1fd1c'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Sakatlık Tazminatı','0','2020-11-24 08:51:02','2020-11-24 08:51:02',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('d0fc09adb61e7f8bebaa6d5d814c5484'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Allianz Sigorta','0','2020-11-24 17:11:04','2020-11-24 17:11:04',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('dae445c77cccd91c349326aa087b1719'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Güneş','0','2020-11-24 17:16:20','2020-11-24 17:16:20','2020-11-27 16:46:29');
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e2409ced920fc3a8d8f3ae0e7e109e82'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Doğa Sigorta','0','2020-11-24 17:11:30','2020-11-24 17:11:30',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e4f8366a49fdf6070ddde1121f873ec3'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Yaya','0','2020-11-24 08:50:49','2020-11-24 08:50:49',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('eb6d647b6241efca87290d4a281ff5d8'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Generali Sigorta','0','2020-11-24 17:13:02','2020-11-24 17:13:02',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f396dd1613508799af3189595522ff00'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Yargıtay','0','2020-11-24 08:50:01','2020-11-24 08:50:01',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fabdd185ff77f71328f58d81893672f8'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Derdest','0','2020-11-24 08:49:17','2020-11-24 08:49:17',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('fd0d3e54fb342610bab6e9951c825867'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Groupama Sigorta','0','2020-11-24 17:14:48','2020-11-24 17:14:48',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('c7ee2762302182ebbf1ea9c1a56875f9'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Türkiye Sigorta','0','2020-11-27 16:45:47','2020-11-27 16:45:47',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('a6046fb956d4e13b5de05a94650b2926'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Adli Tıp','0','2020-12-01 11:44:31','2020-12-01 11:44:31',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('39449dfdf150d214ed67930552f106df'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Geçici İş Göremezlik','0','2020-12-01 11:48:41','2020-12-01 11:48:41',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('89f6c443aa4ee1ad2e523ed2f5b91875'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Geçici Bakıcı','0','2020-12-01 11:48:53','2020-12-01 11:48:53',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('ce0c98891a17fd134f7661f76834a63b'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Maddi','0','2020-12-01 11:48:59','2020-12-01 11:48:59',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('441a944e1e6b296bb9c23fb7095d719b'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Manevi','0','2020-12-01 11:49:05','2020-12-01 11:49:05',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('16d39d8b75526890fa1132c49fcebfa9'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'8/8 Destek Tazminatı','0','2020-12-01 11:49:27','2020-12-01 11:49:27',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('53a1427495fa72d9bab16474263e28ff'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Şeker Sigorta','0','2020-12-03 14:35:32','2020-12-03 14:35:32',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('ec0263b5f457428d397761ad855f9f33'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Anadolu Sigorta','0','2020-12-03 14:20:01','2020-12-03 14:20:01',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('56e8857f6dd39e42f0a6254b9e3a3513'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Bereket Sigorta','0','2020-12-03 14:20:54','2020-12-03 14:20:54',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('5a12917e96ed40550548dc6d49c821f1'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Corpus Sigorta','0','2020-12-03 14:21:43','2020-12-03 14:21:43',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('545b718b27bbb1200d04573bc565431d'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Dubai Starr Sigorta','0','2020-12-03 14:22:55','2020-12-03 14:22:55',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('088aea19d8b46036259c5bdd849eef44'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Ethica Sigorta','0','2020-12-03 14:23:44','2020-12-03 14:23:44',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('3e8731cd73396b0d7fda9a6afc6dac35'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Koru Sigorta','0','2020-12-03 14:25:35','2020-12-03 14:25:35',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('e1ef0418853396e839dc491498271794'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Orient Sigorta','0','2020-12-03 14:26:30','2020-12-03 14:26:30',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('bc3cdfd28efcf61816a48306ebd4a98f'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Quıck Sigorta','0','2020-12-03 14:27:34','2020-12-03 14:27:34',NULL);
INSERT INTO `u7417506_dosyatakip`.`form_variables` (`id`,`field_id`,`name`,`order`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('eb7cd75e7d0aea875cb45037a89a7666'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Zurich Sigorta','0','2020-12-03 14:36:52','2020-12-03 14:36:52',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`file_id`,`require_id`,`user`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('305119376d9cb88acd5be82400a02a64'),UNHEX(''),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'2020-12-04 15:19:24','2020-12-04 15:19:24',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`file_id`,`require_id`,`user`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('9a0c732b9d45112ab6c0680a44f824c0'),UNHEX(''),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'2020-12-04 15:26:48','2020-12-04 15:26:48',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`file_id`,`require_id`,`user`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('cead6b7ef8cac72a63bfd9ee347fc322'),UNHEX(''),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'2020-12-04 15:27:28','2020-12-04 15:27:28',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`file_id`,`require_id`,`user`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('86bfd5c3725492fbe359eedac863a324'),UNHEX(''),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'2020-12-04 15:33:12','2020-12-04 15:33:12',NULL);
INSERT INTO `u7417506_dosyatakip`.`forms` (`id`,`file_id`,`require_id`,`user`,`createdate`,`modifydate`,`deletedate`) VALUES (UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('602c3457b3a1e4bdc1cef2656f1d90e6'),UNHEX(''),UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'2020-12-04 16:26:25','2020-12-04 16:26:25',NULL);
INSERT INTO `u7417506_dosyatakip`.`settings` (`name`,`value`,`createdate`,`modifydate`,`deletedate`) VALUES ('appname','FormTakip','2020-11-15 21:22:35','2020-11-15 21:22:36',NULL);
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('13349a8a38be11709be1f6308c1e2295'),'Rıfat','kalay','45477d5e61015d7d6c1b0a31529e4d84','personel',UNHEX('00000000000000000000000000000000'),NULL,'2806584f7b72d145a1c0f888d515eca7.png','rifat_kalay58@gmail.com','','2020-11-24 14:32:06','2020-11-27 13:47:57','2020-11-24 14:32:06');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('2939a0b6843da113dd2999f6e20cbc07'),'Ayhan','GÜN','d48f761c9fbfbfc83793d270da71acc1','admin',UNHEX('00000000000000000000000000000000'),NULL,'c00ed1c9f1d361710e5441fd761ee396.png','ayhan.gun@hotmail.com','','2020-11-24 14:26:04','2020-11-27 13:47:02','2020-11-24 14:26:16');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('2dbac54d0cd70d924e053901be7c1975'),'Yaşar','ÖZKAN','70ac75b505363ee613123c61c6d07dea','kullanici',UNHEX('86a3bc863225834cf244dfcf7840c56f'),NULL,'','sivas@acente.com','','2020-11-24 14:32:31','2020-11-27 13:48:19','2020-11-24 14:32:31');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('a4fa877d9c9fbcfb2ad39eaa62c9f5ba'),'admin','admin','20036a9ec3a8751ae987e6b7afbcbd5e','admin',UNHEX('00000000000000000000000000000000'),NULL,'c0a62733776356ba131382891cf1d8e5.jpg','admin@admin.com','','2020-11-24 08:43:13',NULL,'2020-12-04 15:08:21');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('af9ef6b10f0fe1a3b6f39e758f03097d'),'A','Cengiz','6d64c44225c7e36d91af33fafe3ece1d','personel',UNHEX('00000000000000000000000000000000'),NULL,'000a1e8d27390bfda1df6642aefc7246.png','a.cengiz@gmail.com','','2020-11-24 14:31:07','2020-11-27 13:47:59','2020-11-24 14:31:07');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('b9c2876e3d84c004c2bb476fe6e34f30'),'A','Özdemir','ee55effc578699e492353d737b181325','personel',UNHEX('00000000000000000000000000000000'),NULL,'128eca507a63e4b620347478ffc194dc.png','a.ozdemir@gmail.com','','2020-11-24 14:31:36','2020-11-27 16:33:58','2020-11-24 14:31:36');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('e90f682506ea030bf4d55637502f82bf'),'Nimet','ÖZÇELEN','5195dacabbea185567e62b2bcdd6de7c','kullanici',UNHEX('11d8dbc5f4cfd1084da2c48d838c6ce1'),NULL,'','kayseri@acente.com','','2020-11-24 14:32:53','2020-11-27 13:48:21','2020-11-24 14:32:53');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('f803eb6037c38e5ed2688a5e8c57f01d'),'Gaye','DONUK','adad9c13083453576aae113363b240d6','admin',UNHEX('00000000000000000000000000000000'),NULL,'eb78e56096d635aa8c2453079bc6a021.png','gaye_donuk@hotmail.com','','2020-11-24 14:28:17','2020-11-27 13:47:00','2020-11-24 14:28:26');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('ffa7221607b9d99541d73b1ed3eaad7a'),'Günay','Bakırcı','e7e3bd39979b105c743d212b75d89cf4','admin',UNHEX('00000000000000000000000000000000'),NULL,'969f3aefdf670717e6f3f452404eb3a5.png','gunay.bakirci@hotmail.com','','2020-11-24 14:26:58','2020-11-27 13:46:57','2020-11-24 14:26:58');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('004ed586c5378cbd940a31c0f01b9a97'),'Mesut','Badem','e4c6a2be3b94d07ebebc6577a500b6c1','admin',UNHEX('00000000000000000000000000000000'),NULL,'46b1b2bf23111d2a3f0d3c96fa877a6d.jpeg','mesut@dogruarabuluculuk.com','','2020-11-27 16:15:43',NULL,'2020-11-27 16:15:43');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('3ad4e17021bdf6ccb708e26637651d55'),'konya','deneme','e10adc3949ba59abbe56e057f20f883e','kullanici',UNHEX('62465906f0ccf5ddac733ea86eacc061'),NULL,'','konya@dogruarabuluculuk.com','','2020-11-27 16:18:31','2020-12-03 13:30:13','2020-11-27 16:18:31');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('e45fd2ee4e4a5167a99117a9be1876aa'),'Aysun','Özer','e10adc3949ba59abbe56e057f20f883e','personel',UNHEX('00000000000000000000000000000000'),NULL,'','aysun@dogruarabuluculuk.com','','2020-11-27 16:32:28',NULL,'2020-11-27 16:32:28');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('c5306a3585dd5138bf7e4a8c71bbb963'),'Mecit ','Bilgiç','1acb3591de8d054c4d36a0f52b5dfdfa','admin',UNHEX('00000000000000000000000000000000'),NULL,'34facee8a7903b1b31473568caa02f3d.jpeg','mecit@dogruarabuluculuk.com','','2020-11-27 17:09:35',NULL,'2020-11-27 17:12:28');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('a4211e9ca6683d4382b0aafe582fc541'),'Mehmet Emin','Arpacı','e10adc3949ba59abbe56e057f20f883e','kullanici',UNHEX('fb4ae21e062fa3c50f836cf74d779573'),NULL,'','emin@dogruarabuluculuk.com','','2020-11-27 17:15:21','2020-12-03 13:30:10','2020-11-27 17:15:21');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('3dc3c26df2b2babdcc9533c10d90fe3c'),'Ömer','Tarı','d20f973077774a3fcdb353452f9b647a','admin',UNHEX('00000000000000000000000000000000'),NULL,'','omer@dogruarabuluculuk.com','','2020-11-27 17:37:36',NULL,'2020-11-27 17:37:36');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('dabcb94b4d54eaecdc5bb6d6917fb870'),'emre','dogan','e10adc3949ba59abbe56e057f20f883e','personel',UNHEX('00000000000000000000000000000000'),NULL,'','emre@dogruarabuluculuk.com','','2020-11-27 19:59:51','2020-12-03 13:27:44','2020-11-27 19:59:51');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('262081ce9bd67eff896324e65cab63ca'),'testavukat','testavukat','d013eecd1e63c4eb7317e2bc39d2ff22','avukat',UNHEX('00000000000000000000000000000000'),NULL,'','avukat@avukat.com','','2020-12-02 14:05:12','2020-12-03 13:27:17','2020-12-02 14:05:55');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('4b9a5dcef97c279fded0e89fe098a64d'),'Atakan','Cengiz','e10adc3949ba59abbe56e057f20f883e','avukat',UNHEX('00000000000000000000000000000000'),NULL,'','atakan@dogruarabuluculuk.com','','2020-12-03 13:25:11',NULL,'2020-12-03 13:25:11');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('81587627f25f5813d8ac0f3e8b62acd7'),'Erhan','Özdemir','e7a32fd5c708f22f9c81c5538b23c519','avukat',UNHEX('00000000000000000000000000000000'),NULL,'','erhan@dogruarabuluculuk.com','','2020-12-03 13:27:12',NULL,'2020-12-03 13:27:12');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('f757dcca11dca4e13228a6e6259408da'),'Türkan','Adıgüzel','e7a32fd5c708f22f9c81c5538b23c519','kullanici',UNHEX('c0c3ff36086b4b0708fc80f17a8e9f9c'),NULL,'','turkan@dogruarabuluculuk.com','','2020-12-03 13:30:02',NULL,'2020-12-03 13:30:02');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('365578f4f1e8983f3d7be6e9e1bd9900'),'eek','eeek','d2f2297d6e829cd3493aa7de4416a18f','personel',UNHEX(''),NULL,'','ee@ee.com','','2020-12-04 14:55:04','2020-12-04 14:55:14','2020-12-04 14:55:10');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('5d913968131cebb83cee7657083b107d'),'testk','testk','098f6bcd4621d373cade4e832627b4f6','avukat',UNHEX(''),NULL,'','test@test.com','','2020-12-04 14:55:39','2020-12-04 14:56:13','2020-12-04 14:56:09');
INSERT INTO `u7417506_dosyatakip`.`user` (`id`,`name`,`surname`,`password`,`role`,`acente_id`,`birthday`,`image`,`email`,`extra`,`createdate`,`deletedate`,`modifydate`) VALUES (UNHEX('e776d9afb0c2b061aacfe4c6125d1b46'),'testk','testk','f2fc2720249d97db37e2a5a3330baa4e','kullanici',UNHEX('c0c3ff36086b4b0708fc80f17a8e9f9c'),NULL,'','test@test.com','','2020-12-04 14:56:40',NULL,'2020-12-04 14:57:32');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('a3f417dae663a6db2cdaa5bb0872c99f'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'2AEE9D86B6CE734BF0FF33839A2D470B');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('4bf42b107764c910fd2eaa363db7f2bd'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'7BEB50C6A8C7E85522722BB5A6677F7E');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('7fa00100cfb05b1c895538bc5ea0093f'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'CE0C98891A17FD134F7661F76834A63B');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('e71b90397ec162ceb9768c8fb69ea628'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('abc787bd802884e89e32eb1412cda443'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('996098a6ff4db61d01003b8829aaf2e2'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('0a55365a97fd4a64db4d3e7fc680f29a'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b5d2262144ee5d79692c86858e5d28fe'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('a11efc21e7e1cf634827fc77c81dedb5'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('5884af140d71e5e87fc8e64f6707e32f'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('6dde92d208424f669c1479c7f4d75f1b'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('166ef8d7bb247111578c2e1f6bb0c484'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('12175fb810f05b5ce3f4a002f78091e2'),UNHEX('f2b291ba5d6e067a4e65cc92af1592cd'),UNHEX('097a549f860f84424aedf9c75a6eeb59'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('041ed00a841dbc300bcf3a369f3dddbd'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('28ca43d242f6ffdf5a3e121416d5291b'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('8005ddd806b195f58d216bc63b3fb4c9'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('5a4452c86e094d4848a35df0c4ef5c6f'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('491f4839d7dd8bf6a1caf310ef1a50c6'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('93f766bc06668b67e51f39c1596618c2'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('fd05eafdf9c29b7e3281dbd6087f4432'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('fa93bd234a0369815e1f0a2662373384'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('cad44c77ee9ad8e9af55b485d09295b7'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('167dadde8fb8e98f537b4fb7204c7e43'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('01f6c639db11519d232ec7d596a271e2'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('166ef8d7bb247111578c2e1f6bb0c484'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('22cfed145ffc2b16fc330fe100c17d26'),UNHEX('91af3a723536b0aee185eadbc2ac132a'),UNHEX('097a549f860f84424aedf9c75a6eeb59'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('74fedced40f0a100ebc5eef8095b6ede'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'1A403E90179CEFCD582EBBA90D52D512');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('bb07a90d30b066924be7ba2bb519d2b7'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'E4F8366A49FDF6070DDDE1121F873EC3');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('b1404ca17ae37b59ea8d66575070b210'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'89F6C443AA4EE1AD2E523ED2F5B91875');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('4730616440f36171fef4dc99d2e4c96a'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'2020-12-30');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('168f41036a001fa40124c914b7e54d0b'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'2020-12-10');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('fceb7f81c3bffdcf6ed783f5d5c98673'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'2020-12-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('fb8dc7f0e7394afcd1ed275d043c0128'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'2020-12-14');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('3c09e6009a3c17e36a09f1544e7c99b1'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'2020-12-22');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('685fdb0ad741888a1faa58333ad19202'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('9501c1314f447bf086aa28baa17692d4'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'Seçin');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('bc718835811316d96c5eff3dad0b4a88'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('166ef8d7bb247111578c2e1f6bb0c484'),'2015-06-10');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('35751a43b31ad999035902f4316e5fef'),UNHEX('59d2ebca0389327f9aea0adb430c6e3c'),UNHEX('097a549f860f84424aedf9c75a6eeb59'),'2020-12-11');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('4a0d62cfa70e2b077947b2c79d97454b'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'F396DD1613508799AF3189595522FF00');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('54f63335e8f0ddfbdb3dbedf878729f4'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'E4F8366A49FDF6070DDDE1121F873EC3');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('07023f78efc02fd0f454fa58fc81248b'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'16D39D8B75526890FA1132C49FCEBFA9');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('6c68677fa106848df7faee0e6822ad7d'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'2005-03-10');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('29e54b65fbb915f3af59e633321fcb14'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'2020-12-04');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('66b52b314fdadfb0edd329d6c1657209'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'2021-01-09');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('8f072e57cc77dca7788887baa400574b'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'2020-12-04');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('8419c605f2e4a843fca9876e9b12d057'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'2020-12-04');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('8e212217af387df96e0cd51f811795a9'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'Arif TOY');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('72c4e697fd138988ac6dfd7d1b6f8580'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'2E4FE27CC8DC59CDE5EA61E2E133A4CB');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('4483188a9ea61118e8599699c786c49e'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('166ef8d7bb247111578c2e1f6bb0c484'),'2020-12-28');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('706b52dee1272af058832392528d057e'),UNHEX('d286bdfdd13cf8825ca0d25b77f4d2ae'),UNHEX('097a549f860f84424aedf9c75a6eeb59'),'2027-03-18');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('51c4fb9c0fbc9abb83d20641b0ae9905'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('44a9c75c7e4763114699697a6307bd00'),'380862ADEB08D334AB9B90A9BBD54C93');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('3786dc05eadd59a10cabddad6842fa97'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('0b6072368adb397a71b6a742d984eb8a'),'7BEB50C6A8C7E85522722BB5A6677F7E');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('376647492f1538ed683b15cc0fbd85e6'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('f2d0e64de5f3425bad0811bfd26f8d81'),'39449DFDF150D214ED67930552F106DF');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('a56d0e2a4d455665d286ddf4310e8f3e'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('a97169a98f9e367527ef3f39ec8dbc65'),'2021-01-03');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('d1001066efe8fa3fec4576470d7e7390'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('eba9bfbf7bd43efae89813f1dac07bcd'),'2020-12-24');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('2f9a3d78140b628a685e89edfe71c2d0'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('4df05a2dae5fddf6b06cb7f9201427ab'),'2020-12-09');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('3dbe53b15454c9a79f753996e6ef079d'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('059cc94c8260ad2c5162613daa2ef5a2'),'2020-12-14');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('2c31c3092c9523e7f0fb49464e6c25c3'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('de359388539e4d1e2ad32756ed576fd6'),'2020-12-16');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('c8e7706795f67cf530cd1f8bf40bbda1'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('9ad70292ddac62f604f79c57e78896d9'),'Şebnem');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('c7fd0e39f45b4ddb089d7491646589be'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('21d25dcf24373baeb847f52815bbd746'),'15C251C60A73C448B7F9C18ACC32AF20');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('f0082580684c789966c339f413293b17'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('166ef8d7bb247111578c2e1f6bb0c484'),'2020-05-22');
INSERT INTO `u7417506_dosyatakip`.`values` (`id`,`formid`,`field`,`text`) VALUES (UNHEX('bf6264781a4329ab55d33acbe47d0017'),UNHEX('47594af79a79cb13832b533a4c2d0de1'),UNHEX('097a549f860f84424aedf9c75a6eeb59'),'2020-12-23');

COMMIT;