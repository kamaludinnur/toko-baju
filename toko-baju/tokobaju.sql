SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `agen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hp` varchar(50) NOT NULL,
  `alamat` tinytext NOT NULL,
  `diskon` decimal(10,5) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `merek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `merek` int(11) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `warna` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_beli` decimal(12,4) NOT NULL,
  `harga_jual` decimal(12,4) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `record_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `jenis` enum('konsumen','agen','tambah','retur_agen','retur_konsumen','retur_pabrik','reject_agen','reject_konsumen','reject_pabrik','kehilangan') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `setting` (
  `item` varchar(255) NOT NULL,
  `value` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `transaksi_agen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `agen` int(11) NOT NULL,
  `produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `keuntungan` decimal(12,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `transaksi_kehilangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `agen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `transaksi_konsumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `keuntungan` decimal(12,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `transaksi_reject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `agen` int(11) NOT NULL,
  `refund` decimal(12,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `transaksi_retur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(12,4) NOT NULL,
  `agen` int(11) NOT NULL,
  `refund` decimal(12,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Kalo konsumen, agen = 0, selainnya pake ID agen' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ukuran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(10) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `warna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `keterangan` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
