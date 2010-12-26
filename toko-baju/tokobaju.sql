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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `agen` (`id`, `kode`, `nama`, `hp`, `alamat`, `diskon`, `keterangan`) VALUES
(1,	'X0097',	'Arief',	'0856890004',	'Kp geledug RT sekian RW sekian',	30.00000,	'Ini sangat rajin belanja');

DROP TABLE IF EXISTS `merek`;
CREATE TABLE `merek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `merek` (`id`, `nama`, `keterangan`) VALUES
(1,	'Qirani',	'ini keterangan qirani'),
(2,	'Nevada',	'Ini Ketarangan Nevada'),
(3,	'Bonanze',	'Ini keterangan Bonanze'),
(4,	'Coffe Park',	'Ini ketarangan Coffe Park');

DROP TABLE IF EXISTS `model`;
CREATE TABLE `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `merek` int(11) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `model` (`id`, `nama`, `merek`, `keterangan`) VALUES
(1,	'Sunny Monday',	1,	'Sunny Monday itu model yang bagus'),
(2,	'Sweater Nice Party',	4,	'lumayan bagus');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `produk` (`id`, `model`, `ukuran`, `warna`, `stok`, `harga_beli`, `harga_jual`, `keterangan`) VALUES
(1,	1,	1,	1,	20,	12000.0000,	26000.0000,	''),
(2,	1,	1,	2,	20,	12000.0000,	26000.0000,	''),
(3,	1,	1,	3,	19,	12000.0000,	26000.0000,	''),
(4,	1,	1,	4,	20,	12000.0000,	26000.0000,	''),
(5,	1,	2,	1,	20,	12000.0000,	26000.0000,	''),
(6,	1,	2,	2,	20,	12000.0000,	26000.0000,	''),
(7,	1,	2,	3,	20,	12000.0000,	26000.0000,	''),
(8,	1,	2,	4,	20,	12000.0000,	26000.0000,	''),
(9,	2,	1,	2,	20,	60000.0000,	150000.0000,	''),
(10,	2,	2,	2,	20,	61000.0000,	153000.0000,	''),
(11,	2,	2,	4,	18,	63000.0000,	160000.0000,	'');

DROP TABLE IF EXISTS `record_stok`;
CREATE TABLE `record_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `jenis` enum('konsumen','agen','tambah','retur_agen','retur_konsumen','retur_pabrik','reject_agen','reject_konsumen','reject_pabrik','kehilangan') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `record_stok` (`id`, `tanggal`, `produk`, `jumlah`, `stok_akhir`, `jenis`) VALUES
(1,	'2010-12-26 10:06:27',	1,	20,	20,	'tambah'),
(2,	'2010-12-26 10:06:59',	2,	20,	20,	'tambah'),
(3,	'2010-12-26 10:07:05',	3,	20,	20,	'tambah'),
(4,	'2010-12-26 10:07:10',	4,	20,	20,	'tambah'),
(5,	'2010-12-26 10:07:25',	5,	20,	20,	'tambah'),
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
(17,	'2010-12-26 10:16:03',	2,	2,	20,	'retur_konsumen');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `transaksi_kehilangan`;
CREATE TABLE `transaksi_kehilangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `agen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen';


DROP TABLE IF EXISTS `transaksi_konsumen`;
CREATE TABLE `transaksi_konsumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `keuntungan` decimal(12,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `transaksi_konsumen` (`id`, `tanggal`, `produk`, `jumlah`, `harga`, `keuntungan`) VALUES
(1,	'2010-12-26 10:10:09',	1,	2,	26000.0000,	28000.0000),
(2,	'2010-12-26 10:10:09',	2,	2,	26000.0000,	28000.0000),
(3,	'2010-12-26 10:10:09',	3,	1,	26000.0000,	14000.0000),
(4,	'2010-12-26 10:10:09',	11,	2,	160000.0000,	194000.0000);

DROP TABLE IF EXISTS `transaksi_reject`;
CREATE TABLE `transaksi_reject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `agen` int(11) NOT NULL,
  `refund` decimal(12,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen';


DROP TABLE IF EXISTS `transaksi_retur`;
CREATE TABLE `transaksi_retur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `agen` int(11) NOT NULL,
  `refund` decimal(12,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen';

INSERT INTO `transaksi_retur` (`id`, `produk`, `tanggal`, `jumlah`, `harga`, `agen`, `refund`) VALUES
(1,	1,	'2010-12-26 10:13:26',	2,	26000.0000,	0,	28000.0000),
(2,	2,	'2010-12-26 10:16:03',	2,	26000.0000,	0,	28000.0000);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `warna` (`id`, `nama`, `keterangan`) VALUES
(1,	'Merah',	''),
(2,	'Hitam',	'Hitam'),
(3,	'Biru',	''),
(4,	'Pink',	'');

