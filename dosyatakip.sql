-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Ãœretim ZamanÄ±: 22 Kas 2020, 22:49:08
-- Sunucu sÃ¼rÃ¼mÃ¼: 10.1.31-MariaDB
-- PHP SÃ¼rÃ¼mÃ¼: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- VeritabanÄ±: `dosyatakip`
--

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `acente`
--

CREATE TABLE `acente` (
  `id` binary(16) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo dÃ¶kÃ¼m verisi `acente`
--

INSERT INTO `acente` (`id`, `name`, `image`, `createdate`, `modifydate`, `deletedate`) VALUES
('ğñHÙÆ[å	uúÂë´6', 'Acente 1', '', '2020-11-22 21:06:01', '2020-11-22 21:06:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `forms`
--

CREATE TABLE `forms` (
  `id` binary(16) NOT NULL,
  `type_id` binary(16) NOT NULL,
  `file_id` binary(16) DEFAULT NULL,
  `require_id` binary(16) DEFAULT NULL,
  `user` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo dÃ¶kÃ¼m verisi `forms`
--

INSERT INTO `forms` (`id`, `type_id`, `file_id`, `require_id`, `user`, `data`, `createdate`, `modifydate`, `deletedate`) VALUES
('`0J*no&ŸEü2–q¶È', '#;—HÇQ–~¼-ís“F', 'éşZ€rI¥¬BHÊø.9ö`', 'Dr¯ò½‘gúÚêhîÊ', 'g6ûZÌC{/{ş4Îº‡À', '', '2020-11-22 23:24:45', '2020-11-22 23:24:45', '2020-11-22 23:35:36'),
('fÅ¹É¶ ~úO9†O¼¤', '‘Âh³%S½ŠU²¾—9', 'éşZ€rI¥¬BHÊø.9ö`', '|¼ÛX¹‡õ\0ÖÙ—­', 'g6ûZÌC{/{ş4Îº‡À', '', '2020-11-22 23:39:09', '2020-11-22 23:39:09', '0000-00-00 00:00:00'),
('ÚŒçŸŞå¢kPô‡Ñ i', '#;—HÇQ–~¼-ís“F', 'éşZ€rI¥¬BHÊø.9ö`', 'Dr¯ò½‘gúÚêhîÊ', 'g6ûZÌC{/{ş4Îº‡À', '', '2020-11-22 21:31:11', '2020-11-22 21:31:11', '2020-11-22 23:24:02');

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `form_fields`
--

CREATE TABLE `form_fields` (
  `id` binary(16) NOT NULL,
  `form_type_id` binary(16) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo dÃ¶kÃ¼m verisi `form_fields`
--

INSERT INTO `form_fields` (`id`, `form_type_id`, `name`, `order`, `type`, `createdate`, `modifydate`, `deletedate`) VALUES
('˜ >À=Â=S‚UGÓÙ', '#;—HÇQ–~¼-ís“F', 'FGHJKL', 2, 'date', '2020-11-22 21:07:26', '2020-11-22 21:07:26', '0000-00-00 00:00:00'),
('*Í+ŸX§ø:2ø÷õ', '#;—HÇQ–~¼-ís“F', 'ABC', 0, 'text', '2020-11-22 21:07:15', '2020-11-22 21:07:15', '0000-00-00 00:00:00'),
('Pttâ™ş+vÇTŞY', '#;—HÇQ–~¼-ís“F', 'RETYUJKL', 1, 'select', '2020-11-22 21:07:23', '2020-11-22 21:07:23', '0000-00-00 00:00:00'),
('†sÏ¾·ùŒöJªä)g', '~óab¨§|gÅÒW&¹I”', 'FGHJK', 0, 'select', '2020-11-22 21:08:14', '2020-11-22 21:08:14', '0000-00-00 00:00:00'),
('•iî­@´ƒN×iu·+', '‘Âh³%S½ŠU²¾—9', 'NBHMG', 2, 'date', '2020-11-22 21:09:06', '2020-11-22 21:09:06', '0000-00-00 00:00:00'),
('«Em_‚xï¬]±ÓĞ¿¨²±', '‘Âh³%S½ŠU²¾—9', 'SDFGH', 1, 'text', '2020-11-22 21:09:02', '2020-11-22 21:09:02', '0000-00-00 00:00:00'),
('®€-2á2V\Z/Şë[†', '~óab¨§|gÅÒW&¹I”', 'SDFGHJK', 1, 'text', '2020-11-22 21:08:17', '2020-11-22 21:08:17', '0000-00-00 00:00:00'),
('Ã\"¤ùğ­Û8Ùnv)|¿', '‘Âh³%S½ŠU²¾—9', 'QWERT', 0, 'select', '2020-11-22 21:08:59', '2020-11-22 21:08:59', '0000-00-00 00:00:00'),
('Ş™q}¢úS¬H_Ê|ób', '~óab¨§|gÅÒW&¹I”', 'FGHJKL', 2, 'date', '2020-11-22 21:08:20', '2020-11-22 21:08:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `form_notes`
--

CREATE TABLE `form_notes` (
  `id` binary(16) NOT NULL,
  `formid` binary(16) DEFAULT NULL,
  `text` text,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo dÃ¶kÃ¼m verisi `form_notes`
--

INSERT INTO `form_notes` (`id`, `formid`, `text`, `createdate`, `modifydate`, `deletedate`) VALUES
('09110af33edec556', 'fÅ¹É¶ ~úO9†O¼¤', 'falsezeth xy&nbsp; kfuy zeh hsrt hsrh srt hsfalsezeth xy&nbsp; kfuy zeh hsrt hsrh srt hsfalsezeth xy&nbsp; kfuy zeh hsrt hsrh srt hsfalsezeth xy&nbsp; kfuy zeh hsrt hsrh srt hs', '2020-11-23 00:20:02', '2020-11-23 00:33:31', '2020-11-23 00:33:41'),
('299186e7f84a6a4e', 'fÅ¹É¶ ~úO9†O¼¤', '<h1><span class=\"wysiwyg-color-red\">Merhaba</span></h1>Kes', '2020-11-23 00:36:48', NULL, '2020-11-23 00:38:56'),
('65a622a2c660ac75', 'fÅ¹É¶ ~úO9†O¼¤', '<h1><span class=\"wysiwyg-color-red\">Text</span></h1><b><i><u>Three&nbsp;</u></i></b>', '2020-11-23 00:30:20', NULL, '2020-11-23 00:33:49'),
('9d57029245ad60de', 'fÅ¹É¶ ~úO9†O¼¤', 'Lock', '2020-11-23 00:46:48', '2020-11-23 00:47:38', '2020-11-23 00:47:41');

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `form_require`
--

CREATE TABLE `form_require` (
  `id` binary(16) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `required_forms` text,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo dÃ¶kÃ¼m verisi `form_require`
--

INSERT INTO `form_require` (`id`, `name`, `required_forms`, `createdate`, `modifydate`, `deletedate`) VALUES
('Dr¯ò½‘gúÚêhîÊ', 'Ä°ÅŸlem 1', '233B9748C75196107E10BC2DED739346,7EF31C6162A8A77C67C5D25726B94994,91C268B3251E530BBD8A55B2BE973913', '2020-11-22 21:10:01', '2020-11-22 21:10:01', NULL),
('dqÊ‰Åè\rfİ!s’`Pö', 'Ä°ÅŸlem 2', '233B9748C75196107E10BC2DED739346,7EF31C6162A8A77C67C5D25726B94994', '2020-11-22 21:10:17', '2020-11-22 21:10:17', NULL),
('|¼ÛX¹‡õ\0ÖÙ—­', 'Ä°ÅŸlem 3', '7EF31C6162A8A77C67C5D25726B94994,91C268B3251E530BBD8A55B2BE973913', '2020-11-22 21:10:31', '2020-11-22 21:10:31', NULL);

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `form_types`
--

CREATE TABLE `form_types` (
  `id` binary(16) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo dÃ¶kÃ¼m verisi `form_types`
--

INSERT INTO `form_types` (`id`, `name`, `createdate`, `modifydate`, `deletedate`) VALUES
('#;—HÇQ–~¼-ís“F', 'FFF', '2020-11-22 21:07:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('~óab¨§|gÅÒW&¹I”', 'JJ', '2020-11-22 21:08:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('‘Âh³%S½ŠU²¾—9', 'KKK', '2020-11-22 21:07:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `form_variables`
--

CREATE TABLE `form_variables` (
  `id` binary(16) NOT NULL,
  `field_id` binary(16) DEFAULT NULL,
  `name` text CHARACTER SET utf8mb4,
  `order` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo dÃ¶kÃ¼m verisi `form_variables`
--

INSERT INTO `form_variables` (`id`, `field_id`, `name`, `order`, `createdate`, `modifydate`, `deletedate`) VALUES
('¤mç¢föÃãiÀÃt', 'Pttâ™ş+vÇTŞY', 'UTF', NULL, '2020-11-22 21:07:39', '2020-11-22 21:07:39', NULL),
('I9jïƒ™Ä­ˆÛ-ãƒÓ', 'Pttâ™ş+vÇTŞY', 'FET', NULL, '2020-11-22 21:07:44', '2020-11-22 21:07:44', NULL),
('iÔ¼y–n=m,§NCÛ', 'Ã\"¤ùğ­Û8Ùnv)|¿', 'Kabul ', NULL, '2020-11-22 21:09:18', '2020-11-22 21:09:18', NULL),
('À#¦}ßy=OqŞØâL4.', '†sÏ¾·ùŒöJªä)g', 'HayÄ±r', NULL, '2020-11-22 21:08:35', '2020-11-22 21:08:35', NULL),
('Ö¯_iyÈ`i3jSDG°', 'Ã\"¤ùğ­Û8Ùnv)|¿', 'Red', NULL, '2020-11-22 21:09:23', '2020-11-22 21:09:23', NULL),
('ğd[§kLã[î/Ê”Óñ×T', '†sÏ¾·ùŒöJªä)g', 'Evet', NULL, '2020-11-22 21:08:30', '2020-11-22 21:08:30', NULL);

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `file`
--

CREATE TABLE `file` (
  `id` binary(16) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `required_forms` text,
  `acente_id` binary(16) DEFAULT NULL,
  `personel_id` binary(16) DEFAULT NULL,
  `lastinsetdate` datetime DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo dÃ¶kÃ¼m verisi `file`
--

INSERT INTO `file` (`id`, `name`, `required_forms`, `acente_id`, `personel_id`, `lastinsetdate`, `createdate`, `modifydate`, `deletedate`) VALUES
('éşZ€rI¥¬BHÊø.9ö`', 'Askerlik Tecil iÅŸlemleri', '194472AFF212BD9167FA0CDAEA68EECA,1F037CBCDB58B987F500D6D99719AD8F', 'ğñHÙÆ[å	uúÂë´6', 'g6ûZÌC{/{ş4Îº‡À', NULL, '2020-11-22 21:22:45', '2020-11-22 21:22:45', NULL),
('§^D’Ú×gfıîœ€O', 'Askerlik Tecil iÅŸlemleri 12', '6471CA89C5E80D66DD217392605015F6', 'ğñHÙÆ[å	uúÂë´6', 'g6ûZÌC{/{ş4Îº‡À', NULL, '2020-11-22 23:28:20', '2020-11-22 23:28:20', NULL);

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `notification`
--

CREATE TABLE `notification` (
  `id` binary(16) DEFAULT NULL,
  `islem` text,
  `dosya` binary(16) DEFAULT NULL,
  `form` binary(16) DEFAULT NULL,
  `personel` binary(16) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `settings`
--

CREATE TABLE `settings` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `createdate` datetime NOT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo dÃ¶kÃ¼m verisi `settings`
--

INSERT INTO `settings` (`name`, `value`, `createdate`, `modifydate`, `deletedate`) VALUES
('admin.email', 'admin@admin.com', '2020-11-15 01:28:16', '2020-11-15 02:05:15', NULL),
('admin.password', '21232f297a57a5a743894a0e4a801fc3', '2020-11-15 01:28:16', '2020-11-15 01:28:16', NULL),
('appname', 'FormTakip', '2020-11-15 21:22:35', '2020-11-15 21:22:36', NULL);

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `user`
--

CREATE TABLE `user` (
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
  `modifydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo dÃ¶kÃ¼m verisi `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `password`, `role`, `acente_id`, `birthday`, `image`, `email`, `extra`, `createdate`, `deletedate`, `modifydate`) VALUES
('g6ûZÌC{/{ş4Îº‡À', 'Personel 1', 'Personel soyisim', '202cb962ac59075b964b07152d234b70', 'personel', NULL, '0000-00-00 00:00:00', '046e35113c2614b291fdb1315c8b0dee.jpg', 'personel@personel.com', '', '2020-11-22 21:06:31', '0000-00-00 00:00:00', '2020-11-22 21:06:51');

-- --------------------------------------------------------

--
-- Tablo iÃ§in tablo yapÄ±sÄ± `values`
--

CREATE TABLE `values` (
  `id` binary(16) DEFAULT NULL,
  `formid` binary(16) DEFAULT NULL,
  `field` binary(16) DEFAULT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo dÃ¶kÃ¼m verisi `values`
--

INSERT INTO `values` (`id`, `formid`, `field`, `text`) VALUES
('9ba4b95849c913da', 'ÚŒçŸŞå¢kPô‡Ñ i', '*Í+ŸX§ø:2ø÷õ', 'Bir ÅŸey'),
('0513bbcff118c7a9', 'ÚŒçŸŞå¢kPô‡Ñ i', 'Pttâ™ş+vÇTŞY', '4915396AEF8399C4AD7F88DB2DE383D3'),
('49bcfa85e1e501dc', 'ÚŒçŸŞå¢kPô‡Ñ i', '˜ >À=Â=S‚UGÓÙ', '2022-10-19'),
('a9a351cc4eb76575', '`0J*no&ŸEü2–q¶È', '*Í+ŸX§ø:2ø÷õ', 'Bir ÅŸey'),
('7b7a483a80bba0ae', '`0J*no&ŸEü2–q¶È', 'Pttâ™ş+vÇTŞY', '14A46DE7A26616F6C3E369C0C31E741F'),
('2a15cfd8578905f7', '`0J*no&ŸEü2–q¶È', '˜ >À=Â=S‚UGÓÙ', '2020-11-25'),
('bf5c53fa2e2bee24', 'fÅ¹É¶ ~úO9†O¼¤', 'Ã\"¤ùğ­Û8Ùnv)|¿', '69D4BC79966E3D6D2C15A74E104306DB'),
('aacf76aa508d5972', 'fÅ¹É¶ ~úO9†O¼¤', '«Em_‚xï¬]±ÓĞ¿¨²±', 'asdfghjk'),
('e221c06a47c6cb97', 'fÅ¹É¶ ~úO9†O¼¤', '•iî­@´ƒN×iu·+', '2020-11-12');

--
-- DÃ¶kÃ¼mÃ¼ yapÄ±lmÄ±ÅŸ tablolar iÃ§in indeksler
--

--
-- Tablo iÃ§in indeksler `acente`
--
ALTER TABLE `acente`
  ADD PRIMARY KEY (`id`);

--
-- Tablo iÃ§in indeksler `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Tablo iÃ§in indeksler `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`);

--
-- Tablo iÃ§in indeksler `form_notes`
--
ALTER TABLE `form_notes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo iÃ§in indeksler `form_types`
--
ALTER TABLE `form_types`
  ADD PRIMARY KEY (`id`);

--
-- Tablo iÃ§in indeksler `form_variables`
--
ALTER TABLE `form_variables`
  ADD PRIMARY KEY (`id`);

--
-- Tablo iÃ§in indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
