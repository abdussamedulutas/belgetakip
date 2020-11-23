-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 23 Kas 2020, 23:04:44
-- Sunucu sürümü: 10.1.31-MariaDB
-- PHP Sürümü: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dosyatakip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `acente`
--

CREATE TABLE `acente` (
  `id` binary(16) NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `forms`
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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `form_fields`
--

CREATE TABLE `form_fields` (
  `id` binary(16) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `form_files`
--

CREATE TABLE `form_files` (
  `id` binary(16) NOT NULL,
  `name` text,
  `filepath` text,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `form_notes`
--

CREATE TABLE `form_notes` (
  `id` binary(16) NOT NULL,
  `file_id` binary(16) DEFAULT NULL,
  `text` text,
  `type` varchar(45) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `form_require`
--

CREATE TABLE `form_require` (
  `id` binary(16) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `form_types`
--

CREATE TABLE `form_types` (
  `id` binary(16) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdate` datetime NOT NULL,
  `modifydate` datetime NOT NULL,
  `deletedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `form_variables`
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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `file`
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
  `deletedate` datetime DEFAULT NULL,
  `order` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notification`
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
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `createdate` datetime NOT NULL,
  `modifydate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`name`, `value`, `createdate`, `modifydate`, `deletedate`) VALUES
('admin.email', 'admin@admin.com', '2020-11-15 01:28:16', '2020-11-15 02:05:15', NULL),
('admin.password', '21232f297a57a5a743894a0e4a801fc3', '2020-11-15 01:28:16', '2020-11-15 01:28:16', NULL),
('appname', 'FormTakip', '2020-11-15 21:22:35', '2020-11-15 21:22:36', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `values`
--

CREATE TABLE `values` (
  `id` binary(16) DEFAULT NULL,
  `formid` binary(16) DEFAULT NULL,
  `field` binary(16) DEFAULT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `acente`
--
ALTER TABLE `acente`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `form_files`
--
ALTER TABLE `form_files`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `form_notes`
--
ALTER TABLE `form_notes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `form_types`
--
ALTER TABLE `form_types`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `form_variables`
--
ALTER TABLE `form_variables`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
