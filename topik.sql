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
DROP DATABASE IF EXISTS `topik`;
CREATE DATABASE IF NOT EXISTS `topik` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `topik`;

-- membuang struktur untuk table topik.auth_assignment
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.auth_assignment: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- membuang struktur untuk table topik.auth_item
DROP TABLE IF EXISTS `auth_item`;
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

-- Membuang data untuk tabel topik.auth_item: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- membuang struktur untuk table topik.auth_item_child
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.auth_item_child: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- membuang struktur untuk table topik.auth_rule
DROP TABLE IF EXISTS `auth_rule`;
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

-- membuang struktur untuk table topik.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.customer: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
REPLACE INTO `customer` (`id`, `nama`, `alamat`, `no_telp`, `email`) VALUES
	(1, 'Topik', 'Kali Deres', '085712123131', 'topik@gmail.com');
REPLACE INTO `customer` (`id`, `nama`, `alamat`, `no_telp`, `email`) VALUES
	(2, 'Fahrul', 'Bogor', '085710568571', 'haifahrul@gmail.com');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- membuang struktur untuk table topik.kendaraan
DROP TABLE IF EXISTS `kendaraan`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.kendaraan: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `kendaraan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kendaraan` ENABLE KEYS */;

-- membuang struktur untuk table topik.migration
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.migration: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1478082191);
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m130524_201442_user_init', 1478082193);
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m140506_102106_rbac_init', 1478082195);
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m151024_072453_create_route_table', 1478082195);
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m160313_153426_session_init', 1478082196);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- membuang struktur untuk table topik.route
DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Membuang data untuk tabel topik.route: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
/*!40000 ALTER TABLE `route` ENABLE KEYS */;

-- membuang struktur untuk table topik.service
DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `keluhan` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_kendaraan` (`kendaraan_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `FK_service_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_service_kendaraan` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.service: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- membuang struktur untuk table topik.session
DROP TABLE IF EXISTS `session`;
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

-- membuang struktur untuk table topik.sparepart
DROP TABLE IF EXISTS `sparepart`;
CREATE TABLE IF NOT EXISTS `sparepart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.sparepart: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `sparepart` DISABLE KEYS */;
/*!40000 ALTER TABLE `sparepart` ENABLE KEYS */;

-- membuang struktur untuk table topik.transaksi
DROP TABLE IF EXISTS `transaksi`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Membuang data untuk tabel topik.transaksi: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- membuang struktur untuk table topik.user
DROP TABLE IF EXISTS `user`;
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
REPLACE INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `loged_at`, `created_at`, `updated_at`) VALUES
	(1, 'webmaster', '9ulMcoALyohjmKZVsslEFgTxKaQId4LU', '$2y$13$z9idfjFonTTzxvN4VoQH0ezumTcmXHz9p.iu98ubhQQv.xyjtk24e', NULL, 'webmaster@gmail.com', 10, 1467734709, 1467734709, 1469896729);
REPLACE INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `loged_at`, `created_at`, `updated_at`) VALUES
	(2, 'admin', '9ulMcoALyohjmKZVsslEFgTxKaQId4LU', '$2y$13$ZhQRNEm5WMXVaHUSaa7kZOt69IEH3SHiclvWiuYP.U4EIQpXNN3Ye', NULL, 'admin@gmail.com', 10, NULL, 1467737664, 1470323331);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
