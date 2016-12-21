-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.6-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk topik
CREATE DATABASE IF NOT EXISTS `topik` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `topik`;

-- membuang struktur untuk table topik.attribute
CREATE TABLE IF NOT EXISTS `attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `code` smallint(6) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.attribute: 13 rows
/*!40000 ALTER TABLE `attribute` DISABLE KEYS */;
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(48, 46, 'Matic', NULL, 2, 'JENIS', 2, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(47, 46, 'Bebek', NULL, 1, 'JENIS', 1, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(46, 0, 'JENIS', NULL, 0, 'JENIS', 0, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(49, 0, 'MEREK', NULL, 0, 'MEREK', 0, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(50, 49, 'Honda', NULL, 1, 'MEREK', 1, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(51, 0, 'TIPE', NULL, 0, 'TIPE', 0, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(52, 46, 'Sport', NULL, 3, 'JENIS', 3, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(53, 51, 'SUPRA X 125 CW-HELM IN FI MMC', NULL, 1, 'TIPE', 1, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(54, 51, 'Vario eSP', NULL, 2, 'TIPE', 2, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(55, 0, 'Count Kode Service', '(NULL)', 0, 'Count Code Service', 10, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(56, 0, 'Status Service', NULL, 0, 'STATUS_SERVICE', 0, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(57, 56, 'Belum', NULL, 1, 'STATUS_SERVICE', 1, 1);
INSERT INTO `attribute` (`id`, `parent`, `name`, `content`, `code`, `type`, `position`, `status`) VALUES
	(58, 56, 'Sudah', NULL, 2, 'STATUS_SERVICE', 2, 1);
/*!40000 ALTER TABLE `attribute` ENABLE KEYS */;

-- membuang struktur untuk table topik.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.auth_assignment: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('admin', '1', 1481038218);
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('admin', '2', 1481037485);
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('manager', '1', 1481038218);
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('operator', '1', 1481038218);
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('webmaster', '1', 1481038218);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- membuang struktur untuk table topik.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.auth_item: ~126 rows (lebih kurang)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/*', 2, NULL, NULL, NULL, 1481038176, 1481038176);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/customer/*', 2, NULL, NULL, NULL, 1481037732, 1481037732);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/customer/create', 2, NULL, NULL, NULL, 1481038176, 1481038176);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/customer/delete', 2, NULL, NULL, NULL, 1481038176, 1481038176);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/customer/delete-items', 2, NULL, NULL, NULL, 1481038176, 1481038176);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/customer/index', 2, NULL, NULL, NULL, 1481038176, 1481038176);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/customer/update', 2, NULL, NULL, NULL, 1481038176, 1481038176);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/customer/view', 2, NULL, NULL, NULL, 1481038177, 1481038177);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/debug/*', 2, NULL, NULL, NULL, 1481038177, 1481038177);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/debug/default/*', 2, NULL, NULL, NULL, 1481038177, 1481038177);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/debug/default/db-explain', 2, NULL, NULL, NULL, 1481038177, 1481038177);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/debug/default/download-mail', 2, NULL, NULL, NULL, 1481038177, 1481038177);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/debug/default/index', 2, NULL, NULL, NULL, 1481038178, 1481038178);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/debug/default/toolbar', 2, NULL, NULL, NULL, 1481038178, 1481038178);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/debug/default/view', 2, NULL, NULL, NULL, 1481038178, 1481038178);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/gii/*', 2, NULL, NULL, NULL, 1481038178, 1481038178);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/gii/default/*', 2, NULL, NULL, NULL, 1481038179, 1481038179);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/gii/default/action', 2, NULL, NULL, NULL, 1481038179, 1481038179);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/gii/default/diff', 2, NULL, NULL, NULL, 1481038179, 1481038179);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/gii/default/index', 2, NULL, NULL, NULL, 1481038179, 1481038179);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/gii/default/preview', 2, NULL, NULL, NULL, 1481038179, 1481038179);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/gii/default/view', 2, NULL, NULL, NULL, 1481038179, 1481038179);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/kendaraan/*', 2, NULL, NULL, NULL, 1481037736, 1481037736);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/kendaraan/create', 2, NULL, NULL, NULL, 1481038179, 1481038179);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/kendaraan/delete', 2, NULL, NULL, NULL, 1481038179, 1481038179);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/kendaraan/delete-items', 2, NULL, NULL, NULL, 1481038180, 1481038180);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/kendaraan/index', 2, NULL, NULL, NULL, 1481038180, 1481038180);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/kendaraan/update', 2, NULL, NULL, NULL, 1481038180, 1481038180);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/kendaraan/view', 2, NULL, NULL, NULL, 1481038180, 1481038180);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/*', 2, NULL, NULL, NULL, 1481038180, 1481038180);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/cek-ongkir', 2, NULL, NULL, NULL, 1481038180, 1481038180);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/cek-resi', 2, NULL, NULL, NULL, 1481038180, 1481038180);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/get-cek-resi', 2, NULL, NULL, NULL, 1481038180, 1481038180);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/get-city', 2, NULL, NULL, NULL, 1481038181, 1481038181);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/get-province', 2, NULL, NULL, NULL, 1481038181, 1481038181);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/index', 2, NULL, NULL, NULL, 1481038181, 1481038181);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/list-bank', 2, NULL, NULL, NULL, 1481038181, 1481038181);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/rest/send-sms', 2, NULL, NULL, NULL, 1481038181, 1481038181);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/restful/*', 2, NULL, NULL, NULL, 1481038181, 1481038181);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/restful/get-users', 2, NULL, NULL, NULL, 1481038181, 1481038181);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/restful/index', 2, NULL, NULL, NULL, 1481038182, 1481038182);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/service/*', 2, NULL, NULL, NULL, 1481037737, 1481037737);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/service/create', 2, NULL, NULL, NULL, 1481038182, 1481038182);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/service/delete', 2, NULL, NULL, NULL, 1481038182, 1481038182);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/service/delete-items', 2, NULL, NULL, NULL, 1481038182, 1481038182);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/service/index', 2, NULL, NULL, NULL, 1481038182, 1481038182);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/service/update', 2, NULL, NULL, NULL, 1481038182, 1481038182);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/service/view', 2, NULL, NULL, NULL, 1481038182, 1481038182);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/*', 2, NULL, NULL, NULL, 1481037739, 1481037739);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/about', 2, NULL, NULL, NULL, 1481038183, 1481038183);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/auth', 2, NULL, NULL, NULL, 1481038183, 1481038183);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/captcha', 2, NULL, NULL, NULL, 1481038183, 1481038183);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/change-language', 2, NULL, NULL, NULL, 1481038183, 1481038183);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/contact', 2, NULL, NULL, NULL, 1481038183, 1481038183);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/dashboard', 2, NULL, NULL, NULL, 1481038183, 1481038183);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/error', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/index', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/logout', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/request-password-reset', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/reset-password', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/site/signup', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sms-gateway/*', 2, NULL, NULL, NULL, 1481126694, 1481126694);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sms-gateway/send-sms', 2, NULL, NULL, NULL, 1481048523, 1481048523);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/smsgatewayme/*', 2, NULL, NULL, NULL, 1481126661, 1481126661);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/smsgatewayme/list-messages/*', 2, NULL, NULL, NULL, 1481126703, 1481126703);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/social-media/*', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/social-media/baru', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/social-media/delete', 2, NULL, NULL, NULL, 1481038184, 1481038184);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/social-media/hapusitems', 2, NULL, NULL, NULL, 1481038185, 1481038185);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/social-media/index', 2, NULL, NULL, NULL, 1481038185, 1481038185);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/social-media/update', 2, NULL, NULL, NULL, 1481038185, 1481038185);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/social-media/view', 2, NULL, NULL, NULL, 1481038185, 1481038185);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sparepart/*', 2, NULL, NULL, NULL, 1481037741, 1481037741);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sparepart/create', 2, NULL, NULL, NULL, 1481038185, 1481038185);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sparepart/delete', 2, NULL, NULL, NULL, 1481038186, 1481038186);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sparepart/delete-items', 2, NULL, NULL, NULL, 1481038186, 1481038186);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sparepart/index', 2, NULL, NULL, NULL, 1481038186, 1481038186);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sparepart/update', 2, NULL, NULL, NULL, 1481038186, 1481038186);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/sparepart/view', 2, NULL, NULL, NULL, 1481038186, 1481038186);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/transaksi/*', 2, NULL, NULL, NULL, 1481037741, 1481037741);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/transaksi/create', 2, NULL, NULL, NULL, 1481038187, 1481038187);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/transaksi/delete', 2, NULL, NULL, NULL, 1481038187, 1481038187);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/transaksi/delete-items', 2, NULL, NULL, NULL, 1481038187, 1481038187);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/transaksi/index', 2, NULL, NULL, NULL, 1481038187, 1481038187);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/transaksi/update', 2, NULL, NULL, NULL, 1481038187, 1481038187);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/transaksi/view', 2, NULL, NULL, NULL, 1481038187, 1481038187);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/*', 2, NULL, NULL, NULL, 1481038187, 1481038187);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/attribute/*', 2, NULL, NULL, NULL, 1481038188, 1481038188);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/attribute/create', 2, NULL, NULL, NULL, 1481038188, 1481038188);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/attribute/delete', 2, NULL, NULL, NULL, 1481038188, 1481038188);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/attribute/delete-items', 2, NULL, NULL, NULL, 1481038188, 1481038188);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/attribute/index', 2, NULL, NULL, NULL, 1481038188, 1481038188);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/attribute/update', 2, NULL, NULL, NULL, 1481038189, 1481038189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/attribute/view', 2, NULL, NULL, NULL, 1481038189, 1481038189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/clean-assets/*', 2, NULL, NULL, NULL, 1481038189, 1481038189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/clean-assets/index', 2, NULL, NULL, NULL, 1481038189, 1481038189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/dashboard/*', 2, NULL, NULL, NULL, 1481038189, 1481038189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/dashboard/index', 2, NULL, NULL, NULL, 1481038189, 1481038189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/login/*', 2, NULL, NULL, NULL, 1481038189, 1481038189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/login/error', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/login/index', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/*', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/create', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/delete', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/detail', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/generateall', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/index', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/permission', 2, NULL, NULL, NULL, 1481038190, 1481038190);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/selectreset', 2, NULL, NULL, NULL, 1481038191, 1481038191);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/selectrole', 2, NULL, NULL, NULL, 1481038191, 1481038191);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/update', 2, NULL, NULL, NULL, 1481038191, 1481038191);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/role/view', 2, NULL, NULL, NULL, 1481038191, 1481038191);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/route/*', 2, NULL, NULL, NULL, 1481038191, 1481038191);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/route/create', 2, NULL, NULL, NULL, 1481038191, 1481038191);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/route/delete', 2, NULL, NULL, NULL, 1481038191, 1481038191);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/route/generate', 2, NULL, NULL, NULL, 1481038191, 1481038191);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/route/hapusitems', 2, NULL, NULL, NULL, 1481038192, 1481038192);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/route/index', 2, NULL, NULL, NULL, 1481038192, 1481038192);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/route/update', 2, NULL, NULL, NULL, 1481038192, 1481038192);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/route/view', 2, NULL, NULL, NULL, 1481038192, 1481038192);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/site/*', 2, NULL, NULL, NULL, 1481038192, 1481038192);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/site/error', 2, NULL, NULL, NULL, 1481038192, 1481038192);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/site/index', 2, NULL, NULL, NULL, 1481038192, 1481038192);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/site/login', 2, NULL, NULL, NULL, 1481038193, 1481038193);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/site/logout', 2, NULL, NULL, NULL, 1481038193, 1481038193);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/webmaster/site/profile', 2, NULL, NULL, NULL, 1481038193, 1481038193);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('admin', 1, NULL, NULL, NULL, 1481037405, 1481037405);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('manager', 1, NULL, NULL, NULL, 1481037421, 1481037421);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('operator', 1, NULL, NULL, NULL, 1481037428, 1481037428);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('webmaster', 1, NULL, NULL, NULL, 1481037416, 1481037416);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- membuang struktur untuk table topik.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.auth_item_child: ~128 rows (lebih kurang)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', '/customer/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', '/kendaraan/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', '/service/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', '/site/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', '/sms-gateway/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', '/smsgatewayme/list-messages/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', '/sparepart/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', '/transaksi/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/customer/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/customer/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/customer/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/customer/delete-items');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/customer/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/customer/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/customer/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/debug/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/debug/default/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/debug/default/db-explain');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/debug/default/download-mail');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/debug/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/debug/default/toolbar');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/debug/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/gii/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/gii/default/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/gii/default/action');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/gii/default/diff');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/gii/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/gii/default/preview');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/gii/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/kendaraan/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/kendaraan/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/kendaraan/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/kendaraan/delete-items');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/kendaraan/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/kendaraan/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/kendaraan/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/cek-ongkir');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/cek-resi');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/get-cek-resi');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/get-city');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/get-province');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/list-bank');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/rest/send-sms');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/restful/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/restful/get-users');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/restful/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/service/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/service/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/service/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/service/delete-items');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/service/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/service/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/service/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/about');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/auth');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/captcha');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/change-language');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/contact');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/dashboard');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/error');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/logout');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/request-password-reset');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/reset-password');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/site/signup');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/sms-gateway/send-sms');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/smsgatewayme/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/social-media/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/social-media/baru');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/social-media/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/social-media/hapusitems');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/social-media/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/social-media/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/social-media/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/sparepart/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/sparepart/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/sparepart/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/sparepart/delete-items');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/sparepart/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/sparepart/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/sparepart/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/transaksi/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/transaksi/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/transaksi/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/transaksi/delete-items');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/transaksi/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/transaksi/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/transaksi/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/attribute/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/attribute/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/attribute/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/attribute/delete-items');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/attribute/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/attribute/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/attribute/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/clean-assets/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/clean-assets/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/dashboard/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/dashboard/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/login/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/login/error');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/login/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/detail');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/generateall');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/permission');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/selectreset');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/selectrole');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/role/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/route/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/route/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/route/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/route/generate');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/route/hapusitems');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/route/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/route/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/route/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/site/*');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/site/error');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/site/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/site/login');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/site/logout');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('webmaster', '/webmaster/site/profile');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- membuang struktur untuk table topik.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.auth_rule: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- membuang struktur untuk table topik.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel topik.config: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `code`, `key`, `value`) VALUES
	(7, 'CONFIG', 'name', 'Topik App');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- membuang struktur untuk table topik.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.customer: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`id`, `nama`, `alamat`, `no_telp`, `email`) VALUES
	(9, 'Fahrul', 'Bogor', '0857105685710', 'haifahrul@gmail.com');
INSERT INTO `customer` (`id`, `nama`, `alamat`, `no_telp`, `email`) VALUES
	(10, 'Topik', 'jakbar', '08', '');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- membuang struktur untuk table topik.jasa_service
CREATE TABLE IF NOT EXISTS `jasa_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `biaya` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.jasa_service: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `jasa_service` DISABLE KEYS */;
INSERT INTO `jasa_service` (`id`, `nama`, `biaya`) VALUES
	(1, 'Tune UP', '87000');
/*!40000 ALTER TABLE `jasa_service` ENABLE KEYS */;

-- membuang struktur untuk table topik.kendaraan
CREATE TABLE IF NOT EXISTS `kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `tahun` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `no_plat` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_kendaraan_customer` (`customer_id`),
  CONSTRAINT `FK_kendaraan_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.kendaraan: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `kendaraan` DISABLE KEYS */;
INSERT INTO `kendaraan` (`id`, `customer_id`, `merek`, `tipe`, `tahun`, `jenis`, `no_plat`) VALUES
	(6, 10, '1', '1', '2010', '1', 'B 2456 FF');
INSERT INTO `kendaraan` (`id`, `customer_id`, `merek`, `tipe`, `tahun`, `jenis`, `no_plat`) VALUES
	(7, 9, '1', '2', '2014', '2', 'F 2540 GT');
INSERT INTO `kendaraan` (`id`, `customer_id`, `merek`, `tipe`, `tahun`, `jenis`, `no_plat`) VALUES
	(8, 9, '1', '2', '2016', '3', 'A 444 BA');
INSERT INTO `kendaraan` (`id`, `customer_id`, `merek`, `tipe`, `tahun`, `jenis`, `no_plat`) VALUES
	(9, 10, '1', '1', '2015', '1', 'E 2123 ER');
/*!40000 ALTER TABLE `kendaraan` ENABLE KEYS */;

-- membuang struktur untuk table topik.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.migration: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1478082191);
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m130524_201442_user_init', 1478082193);
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m140506_102106_rbac_init', 1478082195);
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m151024_072453_create_route_table', 1478082195);
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m160313_153426_session_init', 1478082196);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- membuang struktur untuk table topik.route
CREATE TABLE IF NOT EXISTS `route` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.route: ~122 rows (lebih kurang)
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/*', '*', '', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/customer/*', '*', 'customer', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/customer/create', 'create', 'customer', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/customer/delete', 'delete', 'customer', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/customer/delete-items', 'delete-items', 'customer', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/customer/index', 'index', 'customer', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/customer/update', 'update', 'customer', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/customer/view', 'view', 'customer', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/debug/*', '*', 'debug', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/debug/default/*', '*', 'debug/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/debug/default/db-explain', 'db-explain', 'debug/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/debug/default/download-mail', 'download-mail', 'debug/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/debug/default/index', 'index', 'debug/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/debug/default/toolbar', 'toolbar', 'debug/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/debug/default/view', 'view', 'debug/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/gii/*', '*', 'gii', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/gii/default/*', '*', 'gii/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/gii/default/action', 'action', 'gii/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/gii/default/diff', 'diff', 'gii/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/gii/default/index', 'index', 'gii/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/gii/default/preview', 'preview', 'gii/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/gii/default/view', 'view', 'gii/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/kendaraan/*', '*', 'kendaraan', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/kendaraan/create', 'create', 'kendaraan', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/kendaraan/delete', 'delete', 'kendaraan', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/kendaraan/delete-items', 'delete-items', 'kendaraan', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/kendaraan/index', 'index', 'kendaraan', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/kendaraan/update', 'update', 'kendaraan', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/kendaraan/view', 'view', 'kendaraan', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/*', '*', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/cek-ongkir', 'cek-ongkir', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/cek-resi', 'cek-resi', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/get-cek-resi', 'get-cek-resi', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/get-city', 'get-city', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/get-province', 'get-province', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/index', 'index', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/list-bank', 'list-bank', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/rest/send-sms', 'send-sms', 'rest', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/restful/*', '*', 'restful', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/restful/get-users', 'get-users', 'restful', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/restful/index', 'index', 'restful', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/service/*', '*', 'service', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/service/create', 'create', 'service', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/service/delete', 'delete', 'service', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/service/delete-items', 'delete-items', 'service', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/service/index', 'index', 'service', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/service/update', 'update', 'service', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/service/view', 'view', 'service', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/*', '*', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/about', 'about', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/auth', 'auth', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/captcha', 'captcha', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/change-language', 'change-language', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/contact', 'contact', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/dashboard', 'dashboard', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/error', 'error', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/index', 'index', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/logout', 'logout', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/request-password-reset', 'request-password-reset', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/reset-password', 'reset-password', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/site/signup', 'signup', 'site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sms-gateway/*', '*', 'sms-gateway', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sms-gateway/send-sms', 'send-sms', 'sms-gateway', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/*', '*', 'smsgatewayme', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/config/*', '*', 'smsgatewayme/config', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/config/create', 'create', 'smsgatewayme/config', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/config/delete', 'delete', 'smsgatewayme/config', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/config/delete-items', 'delete-items', 'smsgatewayme/config', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/config/index', 'index', 'smsgatewayme/config', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/config/update', 'update', 'smsgatewayme/config', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/config/view', 'view', 'smsgatewayme/config', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/default/*', '*', 'smsgatewayme/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/default/index', 'index', 'smsgatewayme/default', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/list-messages/*', '*', 'smsgatewayme/list-messages', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/smsgatewayme/list-messages/index', 'index', 'smsgatewayme/list-messages', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/social-media/*', '*', 'social-media', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/social-media/baru', 'baru', 'social-media', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/social-media/delete', 'delete', 'social-media', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/social-media/hapusitems', 'hapusitems', 'social-media', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/social-media/index', 'index', 'social-media', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/social-media/update', 'update', 'social-media', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/social-media/view', 'view', 'social-media', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sparepart/*', '*', 'sparepart', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sparepart/create', 'create', 'sparepart', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sparepart/delete', 'delete', 'sparepart', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sparepart/delete-items', 'delete-items', 'sparepart', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sparepart/index', 'index', 'sparepart', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sparepart/update', 'update', 'sparepart', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/sparepart/view', 'view', 'sparepart', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/transaksi/*', '*', 'transaksi', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/transaksi/create', 'create', 'transaksi', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/transaksi/delete', 'delete', 'transaksi', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/transaksi/delete-items', 'delete-items', 'transaksi', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/transaksi/index', 'index', 'transaksi', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/transaksi/update', 'update', 'transaksi', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/transaksi/view', 'view', 'transaksi', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/*', '*', 'webmaster', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/attribute/*', '*', 'webmaster/attribute', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/attribute/create', 'create', 'webmaster/attribute', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/attribute/delete', 'delete', 'webmaster/attribute', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/attribute/delete-items', 'delete-items', 'webmaster/attribute', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/attribute/index', 'index', 'webmaster/attribute', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/attribute/update', 'update', 'webmaster/attribute', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/attribute/view', 'view', 'webmaster/attribute', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/clean-assets/*', '*', 'webmaster/clean-assets', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/clean-assets/index', 'index', 'webmaster/clean-assets', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/dashboard/*', '*', 'webmaster/dashboard', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/dashboard/index', 'index', 'webmaster/dashboard', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/login/*', '*', 'webmaster/login', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/login/error', 'error', 'webmaster/login', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/login/index', 'index', 'webmaster/login', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/*', '*', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/create', 'create', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/delete', 'delete', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/detail', 'detail', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/generateall', 'generateall', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/index', 'index', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/permission', 'permission', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/selectreset', 'selectreset', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/selectrole', 'selectrole', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/update', 'update', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/role/view', 'view', 'webmaster/role', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/route/*', '*', 'webmaster/route', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/route/create', 'create', 'webmaster/route', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/route/delete', 'delete', 'webmaster/route', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/route/generate', 'generate', 'webmaster/route', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/route/hapusitems', 'hapusitems', 'webmaster/route', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/route/index', 'index', 'webmaster/route', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/route/update', 'update', 'webmaster/route', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/route/view', 'view', 'webmaster/route', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/site/*', '*', 'webmaster/site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/site/error', 'error', 'webmaster/site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/site/index', 'index', 'webmaster/site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/site/login', 'login', 'webmaster/site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/site/logout', 'logout', 'webmaster/site', 1);
INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
	('/webmaster/site/profile', 'profile', 'webmaster/site', 1);
/*!40000 ALTER TABLE `route` ENABLE KEYS */;

-- membuang struktur untuk table topik.service
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_service` varchar(50) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `keluhan` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_kendaraan` (`kendaraan_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `FK_service_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_service_kendaraan` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.service: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(16, 'SRVC-00000001', 10, 6, 'asd', '2016-12-20 01:33:02', 0, 1);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(17, 'SRVC-00000002', 10, 7, 'sdd', '2016-12-19 23:30:38', 0, 1);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(20, 'SRVC-00000003', 10, 6, 'd', '2016-12-20 01:33:02', 0, 1);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(21, 'SRVC-00000004', 10, 6, 'dd', '2016-12-20 01:33:02', 0, 1);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(22, 'SRVC-00000005', 9, 8, 'e', '2016-12-19 23:37:52', 0, 1);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(23, 'SRVC-00000006', 10, 6, 'ddd', '2016-12-20 01:33:02', 2, 0);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(24, 'SRVC-00000007', 10, 6, 'asd', '2016-12-20 01:33:02', 1, 0);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(25, 'SRVC-00000008', 9, 8, 'asd', '2016-12-19 23:37:52', 1, 0);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(26, 'SRVC-00000009', 10, 9, 'asd', '2016-12-19 23:30:43', 1, 0);
INSERT INTO `service` (`id`, `kode_service`, `customer_id`, `kendaraan_id`, `keluhan`, `created_at`, `status`, `deleted`) VALUES
	(27, 'SRVC-00000010', 9, 7, 'asd', '2016-12-19 23:30:43', 1, 0);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- membuang struktur untuk table topik.session
CREATE TABLE IF NOT EXISTS `session` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_write` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.session: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;

-- membuang struktur untuk table topik.sms_gateway
CREATE TABLE IF NOT EXISTS `sms_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `messages` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `FK_sms_gateway_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.sms_gateway: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `sms_gateway` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_gateway` ENABLE KEYS */;

-- membuang struktur untuk table topik.sms_gateway_me_config
CREATE TABLE IF NOT EXISTS `sms_gateway_me_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel topik.sms_gateway_me_config: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `sms_gateway_me_config` DISABLE KEYS */;
INSERT INTO `sms_gateway_me_config` (`id`, `code`, `key`, `value`) VALUES
	(1, 'CONFIG', 'email', 'topiksmsgateway@zain.site');
INSERT INTO `sms_gateway_me_config` (`id`, `code`, `key`, `value`) VALUES
	(2, 'CONFIG', 'password', 'topiksmsgateway');
INSERT INTO `sms_gateway_me_config` (`id`, `code`, `key`, `value`) VALUES
	(3, 'CONFIG', 'device_id', '34759');
INSERT INTO `sms_gateway_me_config` (`id`, `code`, `key`, `value`) VALUES
	(4, 'CONFIG', 'page', '500');
INSERT INTO `sms_gateway_me_config` (`id`, `code`, `key`, `value`) VALUES
	(5, 'CONFIG', 'send_at', '0 minutes');
INSERT INTO `sms_gateway_me_config` (`id`, `code`, `key`, `value`) VALUES
	(6, 'CONFIG', 'expires_at', '+15 minutes');
INSERT INTO `sms_gateway_me_config` (`id`, `code`, `key`, `value`) VALUES
	(7, 'CONFIG', 'messages', 'Ayo service kendaraan Anda dengan rutin. Sudah saatnya service. \r\n');
/*!40000 ALTER TABLE `sms_gateway_me_config` ENABLE KEYS */;

-- membuang struktur untuk table topik.sparepart
CREATE TABLE IF NOT EXISTS `sparepart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.sparepart: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `sparepart` DISABLE KEYS */;
INSERT INTO `sparepart` (`id`, `nama`, `harga`, `stok`) VALUES
	(1, 'Oli SPX 2', '45000', '30');
INSERT INTO `sparepart` (`id`, `nama`, `harga`, `stok`) VALUES
	(2, 'Oli SPX 1', '45000', '20');
INSERT INTO `sparepart` (`id`, `nama`, `harga`, `stok`) VALUES
	(3, 'Oli MPX 2', '35000', '40');
INSERT INTO `sparepart` (`id`, `nama`, `harga`, `stok`) VALUES
	(4, 'Oli MPX 1', '35000', '32');
/*!40000 ALTER TABLE `sparepart` ENABLE KEYS */;

-- membuang struktur untuk table topik.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `sparepart_id` int(11) NOT NULL,
  `nota` varchar(50) NOT NULL,
  `total_pembayaran` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_service` (`service_id`),
  KEY `id_sparepart` (`sparepart_id`),
  CONSTRAINT `FK_transaksi_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_transaksi_sparepart` FOREIGN KEY (`sparepart_id`) REFERENCES `sparepart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.transaksi: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id`, `service_id`, `sparepart_id`, `nota`, `total_pembayaran`) VALUES
	(1, 17, 3, 'qwerty', '50000');
INSERT INTO `transaksi` (`id`, `service_id`, `sparepart_id`, `nota`, `total_pembayaran`) VALUES
	(2, 20, 2, 'asd', '20000');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- membuang struktur untuk table topik.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `loged_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.user: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `loged_at`, `created_at`, `updated_at`) VALUES
	(1, 'webmaster', '9ulMcoALyohjmKZVsslEFgTxKaQId4LU', '$2y$13$z9idfjFonTTzxvN4VoQH0ezumTcmXHz9p.iu98ubhQQv.xyjtk24e', NULL, 'webmaster@gmail.com', 10, 1467734709, 1467734709, 1469896729);
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `loged_at`, `created_at`, `updated_at`) VALUES
	(2, 'admin', '9ulMcoALyohjmKZVsslEFgTxKaQId4LU', '$2y$13$ZhQRNEm5WMXVaHUSaa7kZOt69IEH3SHiclvWiuYP.U4EIQpXNN3Ye', NULL, 'admin@gmail.com', 10, NULL, 1467737664, 1470323331);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
