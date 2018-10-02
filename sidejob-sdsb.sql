-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id_customer` int(10) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(100) NOT NULL,
  `email_customer` varchar(100) NOT NULL,
  `username_customer` varchar(100) DEFAULT NULL,
  `usersbobet_customer` varchar(100) DEFAULT NULL,
  `useribcbet_customer` varchar(100) DEFAULT NULL,
  `userhoreybet_customer` varchar(100) DEFAULT NULL,
  `usertangkasbet_customer` varchar(100) DEFAULT NULL,
  `pass_customer` text NOT NULL,
  `tlp_customer` varchar(25) NOT NULL,
  `alamat_customer` text NOT NULL,
  `bank_customer` varchar(100) NOT NULL,
  `nmrrekening_customer` varchar(100) NOT NULL,
  `nmrekening_customer` varchar(25) NOT NULL,
  `deposito_customer` int(10) DEFAULT NULL,
  `depositsbobet_customer` int(10) DEFAULT NULL,
  `depositibcbet_customer` int(10) DEFAULT NULL,
  `deposithoreybet_customer` int(10) DEFAULT NULL,
  `deposittangkasbet_customer` int(10) DEFAULT NULL,
  `profile_customer` varchar(100) DEFAULT NULL,
  `status_customer` tinyint(1) NOT NULL,
  `date_customer` datetime NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`id_customer`, `nama_customer`, `email_customer`, `username_customer`, `usersbobet_customer`, `useribcbet_customer`, `userhoreybet_customer`, `usertangkasbet_customer`, `pass_customer`, `tlp_customer`, `alamat_customer`, `bank_customer`, `nmrrekening_customer`, `nmrekening_customer`, `deposito_customer`, `depositsbobet_customer`, `depositibcbet_customer`, `deposithoreybet_customer`, `deposittangkasbet_customer`, `profile_customer`, `status_customer`, `date_customer`) VALUES
(1,	'Aditia Paratama',	'aditiaparatama@gmail.com',	'admin',	'usersbo',	'useribc',	'userhorey',	'usertangkas',	'202cb962ac59075b964b07152d234b70',	'081219917563',	'Jl. Cendana 6 No.6 Rt:04/06 Kutabaru Pasar Kemis                                                                ',	'BCA',	'1056273856',	'aditiaparatama',	1000000,	10000,	10000,	10000,	10000,	'1537558229.png',	1,	'2018-09-15 03:11:00');

DROP TABLE IF EXISTS `deposit`;
CREATE TABLE `deposit` (
  `id_deposit` int(15) NOT NULL AUTO_INCREMENT,
  `customer_deposit` int(10) NOT NULL,
  `nomor_deposit` varchar(50) NOT NULL,
  `voucher_deposit` varchar(50) DEFAULT NULL,
  `potongan_deposit` int(8) DEFAULT NULL,
  `grandtotal_deposit` int(12) NOT NULL,
  `link_deposit` varchar(100) NOT NULL,
  `status_deposit` tinyint(1) NOT NULL,
  `read_deposit` tinyint(1) NOT NULL,
  `date_deposit` datetime NOT NULL,
  PRIMARY KEY (`id_deposit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `deposit` (`id_deposit`, `customer_deposit`, `nomor_deposit`, `voucher_deposit`, `potongan_deposit`, `grandtotal_deposit`, `link_deposit`, `status_deposit`, `read_deposit`, `date_deposit`) VALUES
(1,	1,	'1537952334',	'',	0,	1200000,	'',	1,	0,	'2018-09-26 10:58:54'),
(2,	1,	'1537956437',	'POTONGAN12',	0,	500000,	'',	1,	0,	'2018-09-26 12:07:17');

DROP TABLE IF EXISTS `general`;
CREATE TABLE `general` (
  `id_general` int(10) NOT NULL AUTO_INCREMENT,
  `name_general` varchar(100) NOT NULL,
  `harga_general` int(12) DEFAULT NULL,
  `potongan_general` tinyint(5) DEFAULT NULL,
  `diskon_general` tinyint(5) DEFAULT NULL,
  `qty_general` tinyint(5) DEFAULT NULL,
  `periode_general` date DEFAULT NULL,
  `status_general` tinyint(1) DEFAULT NULL,
  `date_general` datetime DEFAULT NULL,
  PRIMARY KEY (`id_general`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `general` (`id_general`, `name_general`, `harga_general`, `potongan_general`, `diskon_general`, `qty_general`, `periode_general`, `status_general`, `date_general`) VALUES
(1,	'Harga Kupon',	250000,	NULL,	NULL,	NULL,	NULL,	1,	'2018-09-24 03:35:33'),
(2,	'Potongan Jumlah Pembelian',	NULL,	NULL,	10,	10,	NULL,	2,	'2018-09-24 03:36:51'),
(3,	'Potongan Jumlah Pembelian',	NULL,	NULL,	15,	20,	NULL,	2,	'2018-09-24 03:37:53'),
(4,	'Potongan Jumlah Pembelian',	NULL,	NULL,	2,	5,	NULL,	2,	'2018-09-24 01:26:49'),
(5,	'Biaya Listrik',	350000,	NULL,	NULL,	NULL,	'2018-09-01',	4,	'2018-09-25 09:28:47'),
(6,	'Gaji Admin',	2000000,	NULL,	NULL,	NULL,	'2018-09-01',	4,	'2018-09-25 09:29:47');

DROP TABLE IF EXISTS `nomor`;
CREATE TABLE `nomor` (
  `id_nomor` int(10) NOT NULL AUTO_INCREMENT,
  `customer_nomor` int(10) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `periode_nomor` date NOT NULL,
  PRIMARY KEY (`id_nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `nomor` (`id_nomor`, `customer_nomor`, `nomor`, `periode_nomor`) VALUES
(1,	1,	'490821',	'0000-00-00'),
(2,	1,	'649023',	'0000-00-00');

DROP TABLE IF EXISTS `pemenang`;
CREATE TABLE `pemenang` (
  `id_pemenang` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_pemenang` date NOT NULL,
  `nomor_pemenang` varchar(25) NOT NULL,
  `customer_pemenang` int(10) DEFAULT NULL,
  `order_pemenang` tinyint(1) NOT NULL,
  `status_pemenang` tinyint(1) NOT NULL,
  `date_pemenang` datetime NOT NULL,
  PRIMARY KEY (`id_pemenang`),
  KEY `nomor_pemenang` (`nomor_pemenang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` int(15) NOT NULL AUTO_INCREMENT,
  `customer_transaksi` int(10) NOT NULL,
  `nomor_transaksi` varchar(10) NOT NULL,
  `harga_transaksi` int(12) DEFAULT NULL,
  `voucher_transaksi` varchar(50) DEFAULT NULL,
  `potongan_transaksi` int(8) DEFAULT NULL,
  `grandtotal_transaksi` int(12) NOT NULL,
  `link_transaksi` varchar(100) DEFAULT NULL,
  `status_transaksi` tinyint(1) NOT NULL,
  `date_transaksi` datetime NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `transaksi` (`id_transaksi`, `customer_transaksi`, `nomor_transaksi`, `harga_transaksi`, `voucher_transaksi`, `potongan_transaksi`, `grandtotal_transaksi`, `link_transaksi`, `status_transaksi`, `date_transaksi`) VALUES
(1,	1,	'1537969012',	NULL,	'490821',	NULL,	500000,	NULL,	1,	'2018-09-26 15:36:52'),
(2,	1,	'1537969012',	NULL,	'649023',	NULL,	500000,	NULL,	1,	'2018-09-26 15:36:52');

DROP TABLE IF EXISTS `transfer`;
CREATE TABLE `transfer` (
  `id_transfer` int(10) NOT NULL AUTO_INCREMENT,
  `customer_transfer` int(10) NOT NULL,
  `dari_transfer` varchar(100) NOT NULL,
  `tujuan_transfer` varchar(100) NOT NULL,
  `nominal_transfer` int(12) NOT NULL,
  `status_transfer` tinyint(1) NOT NULL,
  `date_transfer` datetime NOT NULL,
  PRIMARY KEY (`id_transfer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `transfer` (`id_transfer`, `customer_transfer`, `dari_transfer`, `tujuan_transfer`, `nominal_transfer`, `status_transfer`, `date_transfer`) VALUES
(1537956604,	1,	'DEPOSIT',	'SBOBET',	200000,	3,	'2018-09-26 12:10:04');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(100) DEFAULT NULL,
  `username_user` varchar(100) DEFAULT NULL,
  `password_user` varchar(100) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `tlp_user` varchar(13) DEFAULT NULL,
  `alamat_user` text,
  `kota_user` varchar(255) DEFAULT NULL,
  `prov_user` varchar(255) DEFAULT NULL,
  `foto_user` text,
  `role_user` tinyint(1) DEFAULT NULL,
  `status_user` tinyint(1) DEFAULT NULL,
  `date_user` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id_user`, `nama_user`, `username_user`, `password_user`, `email_user`, `tlp_user`, `alamat_user`, `kota_user`, `prov_user`, `foto_user`, `role_user`, `status_user`, `date_user`) VALUES
(1,	'Administrator',	'admin',	'202cb962ac59075b964b07152d234b70',	'aditiaparatama@gmail.com',	'081219917563',	'Jl. Cendana 6 No. 6 Rt: 04/06 Kutabaru Tangerang',	NULL,	NULL,	'user.png',	1,	1,	'2016-03-24 04:26:57'),
(2,	'Bernardus Kunto',	'bimbim',	'202cb962ac59075b964b07152d234b70',	'bernard@gmail.com',	'081219917563',	'Jl. Kecubung 10 No. 10 Rt:01/010 Pasar Baru Jakarta',	NULL,	NULL,	'1537719275.png',	2,	1,	'2018-09-23 18:14:35'),
(4,	'Fathur Muhamad',	'fathur',	'202cb962ac59075b964b07152d234b70',	'fathurmuhamad@gmail.com',	'81219917560',	'Jl. Cendana 6',	NULL,	NULL,	'1537092644.jpeg',	2,	0,	'2018-09-16 12:10:44');

DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher` (
  `id_voucher` int(5) NOT NULL AUTO_INCREMENT,
  `kode_voucher` varchar(50) NOT NULL,
  `aktif_voucher` date NOT NULL,
  `nonaktif_voucher` date NOT NULL,
  `potongan_voucher` int(2) NOT NULL,
  `status_voucher` tinyint(1) NOT NULL,
  `date_voucher` datetime NOT NULL,
  PRIMARY KEY (`id_voucher`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `voucher` (`id_voucher`, `kode_voucher`, `aktif_voucher`, `nonaktif_voucher`, `potongan_voucher`, `status_voucher`, `date_voucher`) VALUES
(1,	'BONUS100',	'2018-01-05',	'2018-01-21',	5,	1,	'2018-09-15 13:55:16'),
(2,	'POTONGAN11',	'0000-00-00',	'0000-00-00',	10,	1,	'2018-09-15 12:56:03'),
(3,	'POTONGAN12',	'2018-09-14',	'2018-09-25',	11,	1,	'2018-09-15 13:55:29');

-- 2018-09-29 16:43:37
