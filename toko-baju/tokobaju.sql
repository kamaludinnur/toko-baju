-- Adminer 2.2.0 dump
SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `agen`;
CREATE TABLE `agen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hp` varchar(50) NOT NULL,
  `alamat` tinytext NOT NULL,
  `diskon` decimal(10,5) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `agen` (`id`, `kode`, `nama`, `hp`, `alamat`, `diskon`, `keterangan`) VALUES
(1,	'X0097',	'Arief',	'0856890004',	'Kp geledug RT sekian RW sekian',	30.00000,	'Dia suka sekali belanja dalam jumlah banyak'),
(2,	'X0909',	'Abrar',	'',	'',	20.00000,	'ksdf');

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('53ef6edbab9029ab0b5c4ef7cdd202a3',	'0.0.0.0',	'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.1',	1296051729,	'a:5:{s:11:\"prod_sort_0\";s:5:\"merek\";s:11:\"prod_sort_1\";s:5:\"model\";s:11:\"prod_sort_2\";s:5:\"warna\";s:11:\"prod_sort_3\";s:9:\"id_ukuran\";s:9:\"transaksi\";s:18:\"transaksi_konsumen\";}'),
('858ac388376c5273443ed66384849c25',	'0.0.0.0',	'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.1',	1296111293,	'a:1:{s:9:\"transaksi\";s:18:\"transaksi_konsumen\";}'),
('acf8f519f6648c79695d410fd1625167',	'0.0.0.0',	'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.1',	1296121910,	'a:1:{s:9:\"transaksi\";s:18:\"transaksi_konsumen\";}');

DROP TABLE IF EXISTS `merek`;
CREATE TABLE `merek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `merek` (`id`, `nama`, `keterangan`) VALUES
(1,	'Qirani',	'Arief Hidayatulloh'),
(2,	'Nevada',	'Ini Ketarangan Nevada'),
(3,	'Bonanze',	'Ini keterangan Bonanze'),
(4,	'Coffe Park',	'Ini ketarangan Coffe Park'),
(5,	'Hugo',	'Ini keterangan Hugo'),
(6,	'Jakie Clothe',	'Merek yang sangat bagus');

DROP TABLE IF EXISTS `metode_pembayaran`;
CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `metode_pembayaran` (`id`, `nama`) VALUES
(1,	'Cash'),
(2,	'EDC'),
(3,	'Transfer');

DROP TABLE IF EXISTS `model`;
CREATE TABLE `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `merek` int(11) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `model` (`id`, `nama`, `merek`, `keterangan`) VALUES
(1,	'Sunny Monday',	1,	'Sunny Monday itu model yang bagus'),
(2,	'Sweater Nice Party',	4,	'lumayan bagus'),
(3,	'QGood',	1,	'model yang baguss'),
(4,	'Clening',	3,	'kerenns'),
(5,	'Markotop',	5,	'Ni dari nevadas'),
(6,	'J-Holiday',	6,	'Good'),
(7,	'J-Party',	6,	'good design'),
(8,	'Nevada-Gurun',	2,	''),
(9,	'Joninshu',	5,	''),
(10,	'QD001',	1,	'');

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `total` decimal(12,4) NOT NULL,
  `lunas` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `jumlah` decimal(12,4) NOT NULL,
  `metode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `warna` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_beli` decimal(12,4) NOT NULL,
  `harga_jual` decimal(12,4) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

INSERT INTO `produk` (`id`, `model`, `ukuran`, `warna`, `stok`, `harga_beli`, `harga_jual`, `keterangan`) VALUES
(1,	1,	1,	1,	19,	12000.0000,	26000.0000,	''),
(2,	1,	1,	2,	15,	12000.0000,	26000.0000,	''),
(3,	1,	1,	3,	17,	12000.0000,	26000.0000,	''),
(4,	1,	1,	4,	20,	12000.0000,	26000.0000,	''),
(25,	2,	3,	2,	30,	63000.0000,	150000.0000,	''),
(6,	1,	2,	2,	30,	12000.0000,	26000.0000,	''),
(7,	1,	2,	3,	20,	12000.0000,	26000.0000,	''),
(8,	1,	2,	4,	20,	12000.0000,	26000.0000,	''),
(9,	2,	1,	2,	22,	60000.0000,	150000.0000,	''),
(10,	2,	2,	2,	20,	61000.0000,	153000.0000,	''),
(11,	2,	2,	4,	17,	63000.0000,	160000.0000,	''),
(32,	4,	1,	3,	66,	15000.0000,	40000.0000,	''),
(31,	3,	1,	4,	20,	26000.0000,	56000.0000,	''),
(14,	3,	2,	1,	22,	26000.0000,	56000.0000,	''),
(30,	3,	1,	4,	20,	26000.0000,	56000.0000,	''),
(16,	3,	2,	2,	20,	26000.0000,	56000.0000,	''),
(17,	3,	2,	4,	20,	26000.0000,	56000.0000,	''),
(18,	3,	1,	1,	19,	26000.0000,	56000.0000,	''),
(19,	3,	1,	4,	20,	26000.0000,	56000.0000,	''),
(20,	3,	3,	4,	10,	17000.0000,	30000.0000,	'produk yang baik'),
(21,	1,	5,	3,	90,	17000.0000,	40000.0000,	'testing'),
(22,	6,	1,	3,	99,	11000.0000,	28000.0000,	''),
(23,	8,	1,	5,	8,	15000.0000,	40000.0000,	''),
(24,	2,	3,	1,	36,	62000.0000,	170000.0000,	''),
(26,	9,	3,	1,	28,	15000.0000,	40000.0000,	''),
(27,	9,	1,	1,	18,	15400.0000,	42000.0000,	''),
(28,	9,	2,	1,	50,	15000.0000,	42000.0000,	''),
(33,	3,	1,	4,	20,	26000.0000,	56000.0000,	''),
(34,	4,	2,	3,	100,	15200.0000,	42000.0000,	''),
(35,	4,	3,	3,	100,	15200.0000,	42000.0000,	''),
(36,	4,	4,	3,	70,	15300.0000,	42000.0000,	''),
(37,	3,	1,	4,	20,	26000.0000,	56000.0000,	''),
(38,	2,	2,	1,	30,	60000.0000,	160000.0000,	'');

DROP TABLE IF EXISTS `record_stok`;
CREATE TABLE `record_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `jenis` enum('konsumen','agen','tambah','retur_agen','retur_konsumen','retur_pabrik','reject_agen','reject_konsumen','reject_pabrik','kehilangan') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

INSERT INTO `record_stok` (`id`, `tanggal`, `produk`, `jumlah`, `stok_akhir`, `jenis`) VALUES
(1,	'2010-12-26 10:06:27',	1,	20,	20,	'tambah'),
(2,	'2010-12-26 10:06:59',	2,	20,	20,	'tambah'),
(3,	'2010-12-26 10:07:05',	3,	20,	20,	'tambah'),
(4,	'2010-12-26 10:07:10',	4,	20,	20,	'tambah'),
(41,	'2010-12-29 16:17:03',	25,	30,	30,	'tambah'),
(6,	'2010-12-26 10:07:31',	6,	20,	20,	'tambah'),
(7,	'2010-12-26 10:07:36',	7,	20,	20,	'tambah'),
(8,	'2010-12-26 10:07:41',	8,	20,	20,	'tambah'),
(9,	'2010-12-26 10:08:10',	9,	20,	20,	'tambah'),
(10,	'2010-12-26 10:08:27',	10,	20,	20,	'tambah'),
(11,	'2010-12-26 10:08:41',	11,	20,	20,	'tambah'),
(12,	'2010-12-26 10:10:09',	1,	-2,	18,	'konsumen'),
(13,	'2010-12-26 10:10:09',	2,	-2,	18,	'konsumen'),
(14,	'2010-12-26 10:10:09',	3,	-1,	19,	'konsumen'),
(15,	'2010-12-26 10:10:09',	11,	-2,	18,	'konsumen'),
(16,	'2010-12-26 10:13:26',	1,	2,	20,	'konsumen'),
(17,	'2010-12-26 10:16:03',	2,	2,	20,	'retur_konsumen'),
(18,	'2010-12-26 10:32:03',	1,	-5,	15,	'agen'),
(19,	'2010-12-26 10:32:03',	2,	-5,	15,	'agen'),
(20,	'2010-12-26 10:32:03',	3,	-5,	14,	'agen'),
(21,	'2010-12-26 10:52:35',	1,	2,	17,	'retur_agen'),
(22,	'2010-12-26 11:07:40',	1,	2,	19,	'reject_agen'),
(23,	'2010-12-26 11:11:38',	11,	1,	19,	'reject_konsumen'),
(24,	'2010-12-26 11:35:57',	11,	-2,	17,	'kehilangan'),
(25,	'2010-12-26 11:37:57',	11,	2,	19,	'reject_konsumen'),
(26,	'2010-12-26 11:38:53',	11,	2,	21,	'reject_agen'),
(27,	'2010-12-26 11:40:07',	3,	1,	15,	'reject_agen'),
(28,	'2010-12-26 11:40:36',	3,	2,	17,	'reject_agen'),
(48,	'2010-12-30 08:53:58',	27,	-2,	38,	'konsumen'),
(47,	'2010-12-30 06:56:25',	30,	20,	20,	'tambah'),
(31,	'2010-12-27 08:29:13',	14,	20,	20,	'tambah'),
(46,	'2010-12-29 21:44:34',	6,	10,	30,	'tambah'),
(33,	'2010-12-27 08:29:27',	16,	20,	20,	'tambah'),
(34,	'2010-12-27 08:29:34',	17,	20,	20,	'tambah'),
(35,	'2010-12-27 08:29:44',	18,	20,	20,	'tambah'),
(36,	'2010-12-27 08:29:57',	19,	20,	20,	'tambah'),
(37,	'2010-12-28 22:13:17',	21,	90,	90,	'tambah'),
(38,	'2010-12-29 05:20:26',	22,	100,	100,	'tambah'),
(39,	'2010-12-29 06:33:20',	23,	10,	10,	'tambah'),
(40,	'2010-12-29 06:50:36',	24,	50,	50,	'tambah'),
(42,	'2010-12-29 16:21:36',	26,	30,	30,	'tambah'),
(43,	'2010-12-29 16:22:14',	27,	40,	40,	'tambah'),
(44,	'2010-12-29 16:23:10',	28,	50,	50,	'tambah'),
(49,	'2010-12-30 08:53:58',	24,	-1,	49,	'konsumen'),
(50,	'2010-12-30 08:54:27',	27,	-2,	36,	'konsumen'),
(51,	'2010-12-30 08:54:27',	24,	-1,	48,	'konsumen'),
(52,	'2010-12-30 08:55:06',	27,	-2,	34,	'konsumen'),
(53,	'2010-12-30 08:55:06',	24,	-1,	47,	'konsumen'),
(54,	'2010-12-30 08:56:06',	27,	-2,	32,	'konsumen'),
(55,	'2010-12-30 08:56:06',	24,	-1,	46,	'konsumen'),
(56,	'2010-12-30 08:56:16',	27,	-2,	30,	'konsumen'),
(57,	'2010-12-30 08:56:16',	24,	-1,	45,	'konsumen'),
(58,	'2010-12-30 08:57:28',	27,	-2,	28,	'konsumen'),
(59,	'2010-12-30 08:57:28',	24,	-1,	44,	'konsumen'),
(60,	'2010-12-30 08:57:36',	27,	-2,	26,	'konsumen'),
(61,	'2010-12-30 08:57:36',	24,	-1,	43,	'konsumen'),
(62,	'2010-12-30 08:57:59',	27,	-2,	24,	'konsumen'),
(63,	'2010-12-30 08:57:59',	24,	-1,	42,	'konsumen'),
(64,	'2010-12-30 08:58:01',	27,	-2,	22,	'konsumen'),
(65,	'2010-12-30 08:58:01',	24,	-1,	41,	'konsumen'),
(66,	'2010-12-30 08:58:03',	27,	-2,	20,	'konsumen'),
(67,	'2010-12-30 08:58:03',	24,	-1,	40,	'konsumen'),
(68,	'2010-12-30 09:02:58',	27,	-2,	18,	'konsumen'),
(69,	'2010-12-30 09:02:58',	24,	-1,	39,	'konsumen'),
(70,	'2010-12-31 05:26:19',	22,	-1,	99,	'agen'),
(71,	'2010-12-31 06:30:25',	11,	-1,	20,	'konsumen'),
(72,	'2010-12-31 06:40:03',	11,	1,	21,	'retur_konsumen'),
(73,	'2010-12-31 07:32:16',	11,	-1,	20,	'agen'),
(74,	'2010-12-31 07:34:34',	11,	-1,	19,	'agen'),
(75,	'2010-12-31 07:45:20',	11,	1,	20,	'retur_agen'),
(76,	'2010-12-31 07:51:06',	11,	-1,	19,	'agen'),
(77,	'2010-12-31 08:56:30',	14,	-2,	18,	'agen'),
(78,	'2010-12-31 09:02:30',	14,	2,	20,	'retur_konsumen'),
(79,	'2010-12-31 09:04:11',	14,	2,	22,	'reject_agen'),
(80,	'2010-12-31 09:13:58',	14,	-2,	20,	'konsumen'),
(81,	'2010-12-31 09:14:52',	14,	2,	22,	'reject_konsumen'),
(82,	'2011-01-01 20:07:02',	31,	20,	20,	'tambah'),
(83,	'2011-01-02 05:40:11',	32,	100,	100,	'tambah'),
(84,	'2011-01-04 19:22:29',	33,	20,	20,	'tambah'),
(85,	'2011-01-04 19:24:31',	11,	-2,	17,	'konsumen'),
(86,	'2011-01-04 19:24:31',	23,	-2,	8,	'konsumen'),
(87,	'2011-01-05 04:59:49',	34,	100,	100,	'tambah'),
(88,	'2011-01-05 05:01:55',	35,	100,	100,	'tambah'),
(89,	'2011-01-05 05:02:56',	36,	70,	70,	'tambah'),
(90,	'2011-01-05 22:30:48',	37,	20,	20,	'tambah'),
(91,	'2011-01-05 22:33:27',	32,	-33,	67,	'konsumen'),
(92,	'2011-01-07 06:32:30',	24,	-1,	38,	'konsumen'),
(93,	'2011-01-07 16:29:40',	24,	-2,	36,	'konsumen'),
(94,	'2011-01-07 16:29:40',	18,	-1,	19,	'konsumen'),
(95,	'2011-01-07 16:31:21',	32,	-1,	66,	'agen'),
(96,	'2011-01-07 16:46:04',	9,	2,	22,	'retur_konsumen'),
(97,	'2011-01-07 16:49:02',	38,	30,	30,	'tambah'),
(98,	'2011-01-07 18:35:13',	32,	-1,	65,	'konsumen'),
(99,	'2011-01-07 18:35:13',	26,	-2,	28,	'konsumen'),
(100,	'2011-01-25 06:49:54',	32,	1,	66,	'reject_konsumen');

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `item` varchar(255) NOT NULL,
  `value` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `transaksi_agen`;
CREATE TABLE `transaksi_agen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `agen` int(11) NOT NULL,
  `produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `keuntungan` decimal(12,4) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `transaksi_agen` (`id`, `tanggal`, `agen`, `produk`, `jumlah`, `harga`, `keuntungan`, `order`) VALUES
(1,	'2010-12-26 10:32:03',	1,	1,	5,	18200.0000,	31000.0000,	0),
(2,	'2010-12-26 10:32:03',	1,	2,	5,	18200.0000,	31000.0000,	0),
(3,	'2010-12-26 10:32:03',	1,	3,	5,	18200.0000,	31000.0000,	0),
(4,	'2010-12-31 05:26:19',	1,	22,	1,	19600.0000,	8600.0000,	0),
(5,	'2010-12-31 07:32:16',	2,	11,	1,	128000.0000,	65000.0000,	0),
(6,	'2010-12-31 07:34:34',	2,	11,	1,	128000.0000,	65000.0000,	0),
(7,	'2010-12-31 07:51:06',	1,	11,	1,	112000.0000,	49000.0000,	0),
(8,	'2010-12-31 08:56:30',	2,	14,	2,	44800.0000,	37600.0000,	0),
(9,	'2011-01-07 16:31:21',	1,	32,	1,	28000.0000,	13000.0000,	0);

DROP TABLE IF EXISTS `transaksi_kehilangan`;
CREATE TABLE `transaksi_kehilangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `kerugian` decimal(12,4) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen';

INSERT INTO `transaksi_kehilangan` (`id`, `produk`, `tanggal`, `jumlah`, `harga`, `kerugian`, `order`) VALUES
(1,	11,	'2010-12-26 11:35:57',	2,	63000.0000,	126000.0000,	0);

DROP TABLE IF EXISTS `transaksi_konsumen`;
CREATE TABLE `transaksi_konsumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `keuntungan` decimal(12,4) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO `transaksi_konsumen` (`id`, `tanggal`, `produk`, `jumlah`, `harga`, `keuntungan`, `order`) VALUES
(1,	'2010-12-26 10:10:09',	1,	2,	26000.0000,	28000.0000,	0),
(2,	'2010-12-26 10:10:09',	2,	2,	26000.0000,	28000.0000,	0),
(3,	'2010-12-26 10:10:09',	3,	1,	26000.0000,	14000.0000,	0),
(4,	'2010-12-26 10:10:09',	11,	2,	160000.0000,	194000.0000,	0),
(5,	'2010-12-30 08:53:58',	27,	2,	42000.0000,	53200.0000,	0),
(6,	'2010-12-30 08:53:58',	24,	1,	170000.0000,	108000.0000,	0),
(7,	'2010-12-30 08:54:27',	27,	2,	42000.0000,	53200.0000,	0),
(8,	'2010-12-30 08:54:27',	24,	1,	170000.0000,	108000.0000,	0),
(9,	'2010-12-30 08:55:06',	27,	2,	42000.0000,	53200.0000,	0),
(10,	'2010-12-30 08:55:06',	24,	1,	170000.0000,	108000.0000,	0),
(11,	'2010-12-30 08:56:06',	27,	2,	42000.0000,	53200.0000,	0),
(12,	'2010-12-30 08:56:06',	24,	1,	170000.0000,	108000.0000,	0),
(13,	'2010-12-30 08:56:16',	27,	2,	42000.0000,	53200.0000,	0),
(14,	'2010-12-30 08:56:16',	24,	1,	170000.0000,	108000.0000,	0),
(15,	'2010-12-30 08:57:28',	27,	2,	42000.0000,	53200.0000,	0),
(16,	'2010-12-30 08:57:28',	24,	1,	170000.0000,	108000.0000,	0),
(17,	'2010-12-30 08:57:36',	27,	2,	42000.0000,	53200.0000,	0),
(18,	'2010-12-30 08:57:36',	24,	1,	170000.0000,	108000.0000,	0),
(19,	'2010-12-30 08:57:59',	27,	2,	42000.0000,	53200.0000,	0),
(20,	'2010-12-30 08:57:59',	24,	1,	170000.0000,	108000.0000,	0),
(21,	'2010-12-30 08:58:01',	27,	2,	42000.0000,	53200.0000,	0),
(22,	'2010-12-30 08:58:01',	24,	1,	170000.0000,	108000.0000,	0),
(23,	'2010-12-30 08:58:03',	27,	2,	42000.0000,	53200.0000,	0),
(24,	'2010-12-30 08:58:03',	24,	1,	170000.0000,	108000.0000,	0),
(25,	'2010-12-30 09:02:58',	27,	2,	42000.0000,	53200.0000,	0),
(26,	'2010-12-30 09:02:58',	24,	1,	170000.0000,	108000.0000,	0),
(27,	'2010-12-31 06:30:25',	11,	1,	160000.0000,	97000.0000,	0),
(28,	'2010-12-31 09:13:58',	14,	2,	56000.0000,	60000.0000,	0),
(29,	'2011-01-04 19:24:31',	11,	2,	160000.0000,	194000.0000,	0),
(30,	'2011-01-04 19:24:31',	23,	2,	40000.0000,	50000.0000,	0),
(31,	'2011-01-05 22:33:27',	32,	33,	40000.0000,	825000.0000,	0),
(32,	'2011-01-07 06:32:30',	24,	1,	170000.0000,	108000.0000,	0),
(33,	'2011-01-07 16:29:40',	24,	2,	170000.0000,	216000.0000,	0),
(34,	'2011-01-07 16:29:40',	18,	1,	56000.0000,	30000.0000,	0),
(35,	'2011-01-07 18:35:13',	32,	1,	40000.0000,	25000.0000,	0),
(36,	'2011-01-07 18:35:13',	26,	2,	40000.0000,	50000.0000,	0);

DROP TABLE IF EXISTS `transaksi_reject`;
CREATE TABLE `transaksi_reject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `agen` int(11) NOT NULL,
  `refund` decimal(12,4) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen';

INSERT INTO `transaksi_reject` (`id`, `produk`, `tanggal`, `jumlah`, `harga`, `agen`, `refund`, `order`) VALUES
(1,	1,	'2010-12-26 11:07:40',	2,	18200.0000,	1,	18200.0000,	0),
(2,	11,	'2010-12-26 11:11:38',	1,	160000.0000,	0,	160000.0000,	0),
(3,	11,	'2010-12-26 11:37:57',	2,	160000.0000,	0,	320000.0000,	0),
(4,	11,	'2010-12-26 11:38:53',	2,	160000.0000,	1,	320000.0000,	0),
(5,	3,	'2010-12-26 11:40:07',	1,	18200.0000,	1,	18200.0000,	0),
(6,	3,	'2010-12-26 11:40:36',	2,	18200.0000,	1,	36400.0000,	0),
(7,	3,	'2010-12-26 16:49:07',	2,	18200.0000,	1,	36400.0000,	0),
(8,	3,	'2010-12-27 06:22:33',	2,	18200.0000,	1,	36400.0000,	0),
(9,	14,	'2010-12-31 08:58:06',	2,	44800.0000,	1,	89600.0000,	0),
(10,	14,	'2010-12-31 09:02:30',	2,	44800.0000,	1,	89600.0000,	0),
(11,	14,	'2010-12-31 09:04:11',	2,	44800.0000,	1,	89600.0000,	0),
(12,	14,	'2010-12-31 09:14:52',	2,	56000.0000,	0,	112000.0000,	0),
(13,	32,	'2011-01-25 06:49:54',	1,	40000.0000,	0,	40000.0000,	0);

DROP TABLE IF EXISTS `transaksi_retur`;
CREATE TABLE `transaksi_retur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `agen` int(11) NOT NULL,
  `refund` decimal(12,4) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen';

INSERT INTO `transaksi_retur` (`id`, `produk`, `tanggal`, `jumlah`, `harga`, `agen`, `refund`, `order`) VALUES
(1,	1,	'2010-12-26 10:13:26',	2,	26000.0000,	0,	28000.0000,	0),
(2,	2,	'2010-12-26 10:16:03',	2,	26000.0000,	0,	28000.0000,	0),
(3,	1,	'2010-12-26 10:52:35',	2,	18200.0000,	1,	12400.0000,	0),
(4,	11,	'2010-12-31 06:40:03',	1,	160000.0000,	0,	97000.0000,	0),
(5,	11,	'2010-12-31 07:45:20',	1,	128000.0000,	2,	65000.0000,	0),
(6,	9,	'2011-01-07 16:46:04',	2,	150000.0000,	0,	180000.0000,	0);

DROP TABLE IF EXISTS `ukuran`;
CREATE TABLE `ukuran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(10) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `ukuran` (`id`, `nama`, `keterangan`) VALUES
(1,	'SS',	'ukuran yang kecil'),
(2,	'S',	'lumayan kecil'),
(3,	'M',	'Muat'),
(4,	'L',	'Lebar'),
(5,	'XL',	'Ekstra Lebar'),
(6,	'XXL',	'Ekstra dari ekstra lebar');

DROP TABLE IF EXISTS `warna`;
CREATE TABLE `warna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `warna` (`id`, `nama`, `keterangan`) VALUES
(1,	'Merah',	'Merah membara'),
(2,	'Hitam',	'Hitam'),
(3,	'Biru',	'Biru langit'),
(4,	'Pink',	'Merah Muda'),
(5,	'Silver Light',	'');

