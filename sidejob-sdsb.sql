-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `bid` int(15) NOT NULL AUTO_INCREMENT,
  `bnama` varchar(100) NOT NULL,
  `bparent` tinyint(1) DEFAULT NULL,
  `bchild` tinyint(1) DEFAULT NULL,
  `buser` tinyint(1) DEFAULT NULL,
  `bfield1` varchar(100) DEFAULT NULL,
  `bfield2` varchar(100) DEFAULT NULL,
  `bfield3` varchar(100) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT NULL,
  `bdate` datetime NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `brand` (`bid`, `bnama`, `bparent`, `bchild`, `buser`, `bfield1`, `bfield2`, `bfield3`, `bstatus`, `bdate`) VALUES
(1,	'SBOBET',	1,	0,	1,	'cusersbo',	'cdepositsbo',	'rwinlose1',	1,	'2018-10-11 22:31:55'),
(2,	'IBCBET',	1,	0,	1,	'cuseribc',	'cdepositibc',	'rwinlose2',	1,	'2018-10-11 22:32:10'),
(3,	'HOREY4D',	1,	0,	1,	'cuserhorey',	'cdeposithorey',	'rwinlose3',	1,	'2018-10-11 22:32:32'),
(4,	'TANGKASNET',	1,	0,	1,	'cusertangkas',	'cdeposittangkas',	'rwinlose4',	1,	'2018-10-11 22:32:46'),
(5,	'SDSB ONLINE',	1,	0,	1,	'cuser',	'cdeposit',	'rwinlose5',	1,	'2018-10-12 10:32:59'),
(6,	'gvip58',	0,	1,	1,	'cusersbo',	'cdepositsbo',	'rwinlose6',	1,	'2018-10-13 00:40:47'),
(7,	'ain5858',	0,	1,	1,	'cusersbo',	'cdepositsbo',	'rwinlose7',	1,	'2018-10-13 00:41:34'),
(8,	'ehoki9',	0,	1,	1,	'cusersbo',	'cdepositsbo',	'rwinlose7',	1,	'2018-10-13 00:42:03'),
(9,	'ajc92',	0,	1,	1,	'cusersbo',	'cdepositsbo',	'rwinlose8',	1,	'2018-10-13 00:42:28');

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `cid` int(15) NOT NULL AUTO_INCREMENT,
  `cnama` varchar(100) NOT NULL,
  `cuser` varchar(100) DEFAULT NULL,
  `cusersbo` varchar(100) DEFAULT NULL,
  `cuseribc` varchar(100) DEFAULT NULL,
  `cuserhorey` varchar(100) DEFAULT NULL,
  `cusertangkas` varchar(100) DEFAULT NULL,
  `cemail` varchar(100) DEFAULT NULL,
  `cpass` text,
  `ctlp` varchar(15) DEFAULT NULL,
  `calamat` varchar(255) DEFAULT NULL,
  `cbank` varchar(100) DEFAULT NULL,
  `cnamarek` varchar(100) DEFAULT NULL,
  `cnorek` varchar(50) DEFAULT NULL,
  `cdeposit` int(15) DEFAULT NULL,
  `cdepositsbo` int(15) DEFAULT NULL,
  `cdepositibc` int(15) DEFAULT NULL,
  `cdeposithorey` int(15) DEFAULT NULL,
  `cdeposittangkas` int(15) DEFAULT NULL,
  `cfoto` varchar(100) DEFAULT NULL,
  `cterbaca` tinyint(1) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`cid`, `cnama`, `cuser`, `cusersbo`, `cuseribc`, `cuserhorey`, `cusertangkas`, `cemail`, `cpass`, `ctlp`, `calamat`, `cbank`, `cnamarek`, `cnorek`, `cdeposit`, `cdepositsbo`, `cdepositibc`, `cdeposithorey`, `cdeposittangkas`, `cfoto`, `cterbaca`, `cstatus`, `cdate`) VALUES
(1,	'Aditia Paratama',	'adit99',	'adit9',	'adit9',	'adit9',	'adit9',	'aditiaparatama@gmail.com',	'202cb962ac59075b964b07152d234b70',	'081219917563',	'Jl. Cendana 6 No. 6 Rt:04/06 Kutabaru, Tangerang                                ',	'BCA',	'Aditia Paratama',	'1056273856',	6250000,	4000000,	0,	0,	0,	'1537558229.png',	1,	1,	'2018-09-30 13:26:36'),
(8,	'Ujang Solihin',	'',	'ujang5',	'ujang5',	'',	'ujang5',	'ujangsolihin@gmail.com',	'202cb962ac59075b964b07152d234b70',	'081219917766',	'Jl. Kecubung 5                                                                ',	'BCA',	'Ujang Solihin',	'1012124152',	0,	3010000,	10000,	0,	15000,	'1539278825.jpeg',	1,	1,	'2018-10-11 19:27:05');

DROP TABLE IF EXISTS `general`;
CREATE TABLE `general` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `gname` varchar(100) NOT NULL,
  `gdolar` int(12) DEFAULT NULL,
  `grate` int(12) DEFAULT NULL,
  `gharga` int(12) DEFAULT NULL,
  `gpotongan` tinyint(5) DEFAULT NULL,
  `gdiskon` tinyint(5) DEFAULT NULL,
  `gqty` tinyint(5) DEFAULT NULL,
  `gketerangan` varchar(255) DEFAULT NULL,
  `gketerangan2` varchar(255) DEFAULT NULL,
  `gperiode` date DEFAULT NULL,
  `gbrand` tinyint(1) DEFAULT NULL,
  `gstatus` tinyint(1) DEFAULT NULL,
  `gdate` datetime DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `general` (`gid`, `gname`, `gdolar`, `grate`, `gharga`, `gpotongan`, `gdiskon`, `gqty`, `gketerangan`, `gketerangan2`, `gperiode`, `gbrand`, `gstatus`, `gdate`) VALUES
(1,	'Harga Kupon',	NULL,	NULL,	250000,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2018-09-24 03:35:33'),
(2,	'Potongan Jumlah Pembelian',	NULL,	NULL,	NULL,	NULL,	10,	10,	NULL,	NULL,	NULL,	NULL,	2,	'2018-09-24 03:36:51'),
(3,	'Potongan Jumlah Pembelian',	NULL,	NULL,	NULL,	NULL,	15,	20,	NULL,	NULL,	NULL,	NULL,	2,	'2018-09-24 03:37:53'),
(4,	'Potongan Jumlah Pembelian',	NULL,	NULL,	NULL,	NULL,	2,	5,	NULL,	NULL,	NULL,	NULL,	2,	'2018-09-24 01:26:49'),
(15,	'Transport',	1,	12000,	12000,	NULL,	NULL,	NULL,	'Uang transport untuk 3 karyawan',	NULL,	'2018-10-08',	NULL,	4,	'2018-10-14 15:33:42'),
(16,	'Uang Makan',	1,	15000,	15000,	NULL,	NULL,	NULL,	'Ini uang makan untuk 3 orang',	NULL,	'2018-10-09',	NULL,	4,	'2018-10-14 18:18:41');

DROP TABLE IF EXISTS `nomor`;
CREATE TABLE `nomor` (
  `nid` int(15) NOT NULL AUTO_INCREMENT,
  `ncustomer` int(15) DEFAULT NULL,
  `nnomor` varchar(10) NOT NULL,
  `nperiode` date DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `nomor` (`nid`, `ncustomer`, `nnomor`, `nperiode`) VALUES
(1,	1,	'503498',	'2018-10-14');

DROP TABLE IF EXISTS `pemenang`;
CREATE TABLE `pemenang` (
  `pid` int(15) NOT NULL AUTO_INCREMENT,
  `pperiode` date NOT NULL,
  `pnomor` varchar(10) NOT NULL,
  `pcustomer` int(15) DEFAULT NULL,
  `porder` tinyint(1) DEFAULT NULL,
  `pbrand` tinyint(1) DEFAULT NULL,
  `pstatus` tinyint(1) NOT NULL,
  `pdate` datetime NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `rekening`;
CREATE TABLE `rekening` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `rbank` varchar(100) NOT NULL,
  `rnama` varchar(100) NOT NULL,
  `rno` varchar(50) NOT NULL,
  `rsaldo` int(15) DEFAULT NULL,
  `rjenis` tinyint(1) NOT NULL DEFAULT '0',
  `rstatus` tinyint(1) NOT NULL,
  `rdate` datetime NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `rekening` (`rid`, `rbank`, `rnama`, `rno`, `rsaldo`, `rjenis`, `rstatus`, `rdate`) VALUES
(1,	'BCA',	'SDSB Online',	'1123234234',	8969700,	2,	1,	'2018-10-14 15:01:11'),
(2,	'Mandiri',	'Mike Mohede',	'99325235323',	14500000,	1,	1,	'2018-10-14 15:01:42');

DROP TABLE IF EXISTS `reportlabarugi`;
CREATE TABLE `reportlabarugi` (
  `reportid` int(15) NOT NULL AUTO_INCREMENT,
  `rperiode` date DEFAULT NULL,
  `rjmhdeposit` int(15) DEFAULT '0',
  `rjmhdepositrp` int(15) DEFAULT '0',
  `rjmhwithdraw` int(15) DEFAULT '0',
  `rjmhwithdrawrp` int(15) DEFAULT '0',
  `rwinlose1` int(15) DEFAULT '0',
  `rwinlose2` int(15) DEFAULT '0',
  `rwinlose3` int(15) DEFAULT '0',
  `rwinlose4` int(15) DEFAULT '0',
  `rwinlose5` int(15) DEFAULT '0',
  `rwinlose6` int(15) DEFAULT '0',
  `rwinlose7` int(15) DEFAULT '0',
  `rwinlose8` int(15) DEFAULT '0',
  `rwinlose9` int(15) DEFAULT '0',
  `rwinlose10` int(15) DEFAULT '0',
  `rwinlose11` int(15) DEFAULT '0',
  `rwinlose12` int(15) DEFAULT '0',
  `rwinlose13` int(15) DEFAULT '0',
  `rwinlose14` int(15) DEFAULT '0',
  `rwinlose15` int(15) DEFAULT '0',
  `rtotalwinlose` int(15) DEFAULT '0',
  `rcommbonus` int(15) DEFAULT '0',
  `rreferralbonus` int(15) DEFAULT '0',
  `rwinlosegross` int(15) DEFAULT '0',
  `rbiayaoperasional` int(15) DEFAULT '0',
  `rstatus` tinyint(1) NOT NULL,
  `rdate` datetime NOT NULL,
  PRIMARY KEY (`reportid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `reportlabarugi` (`reportid`, `rperiode`, `rjmhdeposit`, `rjmhdepositrp`, `rjmhwithdraw`, `rjmhwithdrawrp`, `rwinlose1`, `rwinlose2`, `rwinlose3`, `rwinlose4`, `rwinlose5`, `rwinlose6`, `rwinlose7`, `rwinlose8`, `rwinlose9`, `rwinlose10`, `rwinlose11`, `rwinlose12`, `rwinlose13`, `rwinlose14`, `rwinlose15`, `rtotalwinlose`, `rcommbonus`, `rreferralbonus`, `rwinlosegross`, `rbiayaoperasional`, `rstatus`, `rdate`) VALUES
(1,	'2018-10-08',	2,	7000000,	1,	1000000,	0,	0,	0,	0,	10000,	3000,	-500,	0,	0,	0,	0,	0,	0,	0,	0,	12500,	300,	700,	11500,	12000,	1,	'2018-10-14 15:06:55'),
(2,	'2018-10-09',	0,	0,	0,	0,	0,	0,	0,	0,	0,	15000,	11000,	0,	0,	0,	0,	0,	0,	0,	0,	26000,	200,	2100,	23700,	15000,	1,	'2018-10-14 15:18:31');

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `tid` int(15) NOT NULL AUTO_INCREMENT,
  `tcustomer` int(15) DEFAULT NULL,
  `tnomor` varchar(50) DEFAULT '0',
  `tkupon` varchar(20) DEFAULT '0',
  `tvoucher` varchar(100) DEFAULT NULL,
  `tpotongan` int(5) DEFAULT '0',
  `tdari` varchar(100) DEFAULT NULL,
  `ttujuan` varchar(100) DEFAULT NULL,
  `twin` int(15) DEFAULT '0',
  `tlose` int(15) DEFAULT '0',
  `tmembercomm` int(15) DEFAULT '0',
  `tbonus` int(15) DEFAULT '0',
  `tbonus2` int(15) DEFAULT '0',
  `tharga` int(15) DEFAULT NULL,
  `tgrandtotal` int(15) DEFAULT NULL,
  `tjenis` tinyint(1) DEFAULT '0',
  `tsubjenis` tinyint(1) DEFAULT '0',
  `tsubdeposit` tinyint(1) DEFAULT '0',
  `tbrand` tinyint(1) DEFAULT '0',
  `tsubbrand` tinyint(1) DEFAULT NULL,
  `tterbaca` tinyint(1) DEFAULT '0',
  `tketerangan` varchar(100) DEFAULT '0',
  `tstatus` tinyint(1) DEFAULT NULL,
  `tperiode` date DEFAULT NULL,
  `tuser` int(10) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `transaksi` (`tid`, `tcustomer`, `tnomor`, `tkupon`, `tvoucher`, `tpotongan`, `tdari`, `ttujuan`, `twin`, `tlose`, `tmembercomm`, `tbonus`, `tbonus2`, `tharga`, `tgrandtotal`, `tjenis`, `tsubjenis`, `tsubdeposit`, `tbrand`, `tsubbrand`, `tterbaca`, `tketerangan`, `tstatus`, `tperiode`, `tuser`, `tdate`) VALUES
(1,	NULL,	'8ZrYtMO1EQDVyIG',	'0',	NULL,	0,	NULL,	'1123234234',	0,	0,	0,	0,	0,	10000000,	10000000,	5,	51,	0,	5,	NULL,	0,	'Saldo awal',	1,	NULL,	1,	'2018-10-14 15:01:11'),
(2,	NULL,	'PBM2lkSt4INrnAy',	'0',	NULL,	0,	NULL,	'99325235323',	0,	0,	0,	0,	0,	1000000,	1000000,	5,	51,	0,	5,	NULL,	0,	'Saldo awal',	1,	NULL,	1,	'2018-10-14 15:01:42'),
(3,	1,	'GOSu32o9ZnFlMg1',	'0',	'',	0,	'adit99',	'99325235323',	0,	0,	0,	0,	0,	5000000,	5000000,	1,	51,	61,	5,	NULL,	0,	'Deposit customer sdsb adit99',	1,	NULL,	1,	'2018-10-14 15:06:12'),
(4,	1,	'2SRxdcyCejTLYB4',	'0',	NULL,	0,	'adit9',	'99325235323',	0,	0,	0,	0,	0,	5000000,	5000000,	4,	51,	61,	1,	NULL,	0,	'Deposit dana SBOBET - adit9',	1,	'2018-10-08',	1,	'2018-10-14 15:06:55'),
(5,	8,	'zrHkbpABw7WZJvs',	'0',	NULL,	0,	'ujang5',	'99325235323',	0,	0,	0,	0,	0,	2000000,	2000000,	4,	51,	61,	1,	NULL,	0,	'Deposit dana SBOBET - ujang5',	1,	'2018-10-08',	1,	'2018-10-14 15:10:28'),
(6,	1,	'iqBLgVIFTmkGDdP',	'0',	NULL,	0,	'1123234234',	'1056273856',	0,	0,	0,	0,	0,	1000000,	1000000,	4,	52,	62,	1,	NULL,	0,	'Withdraw dana harian  - adit9',	1,	'2018-10-08',	1,	'2018-10-14 15:12:46'),
(7,	1,	'Wxtn4Bsgv85GMNC',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bonus',	1000,	0,	100,	100,	0,	200,	200,	9,	52,	0,	1,	6,	0,	'Data pengeluaran bonus gvip58 - SBOBET',	1,	'2018-10-08',	1,	'2018-10-14 15:13:46'),
(8,	1,	'iKwOQGWF4n8BzMJ',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bonus',	0,	500,	0,	300,	0,	300,	300,	9,	52,	0,	1,	7,	0,	'Data pengeluaran bonus ain5858 - SBOBET',	1,	'2018-10-08',	1,	'2018-10-14 15:14:50'),
(9,	8,	'ZbjNuaRW7OhQY0H',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bonus',	2000,	0,	100,	100,	0,	200,	200,	9,	52,	0,	1,	6,	0,	'Data pengeluaran bonus gvip58 - SBOBET',	1,	'2018-10-08',	1,	'2018-10-14 15:17:47'),
(10,	1,	'3yhiCUN6HLDcIrX',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bonus',	1000,	0,	0,	100,	0,	100,	100,	9,	52,	0,	1,	7,	0,	'Data pengeluaran bonus ain5858 - SBOBET',	1,	'2018-10-09',	1,	'2018-10-14 15:18:31'),
(11,	NULL,	'lVTQiuFhd51xkeE',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bulanan',	0,	0,	0,	0,	0,	12000,	12000,	8,	52,	62,	0,	NULL,	0,	'Pengeluaran Bulanan - Biaya Transport',	1,	'2018-10-08',	1,	'2018-10-14 15:33:42'),
(12,	1,	'ouIMvCsYADnhdUB',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bonus',	10000,	0,	200,	1000,	0,	1200,	1200,	9,	52,	0,	1,	7,	0,	'Data pengeluaran bonus ain5858 - SBOBET',	1,	'2018-10-09',	1,	'2018-10-14 15:21:24'),
(13,	8,	'bF94uTKhsO5ydZS',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bonus',	15000,	0,	0,	1000,	0,	1000,	1000,	9,	52,	0,	1,	6,	0,	'Data pengeluaran bonus gvip58 - SBOBET',	1,	'2018-10-09',	1,	'2018-10-14 15:24:20'),
(14,	1,	'6dcQiworGglDq1n',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bonus',	10000,	0,	100,	200,	0,	300,	300,	9,	52,	0,	5,	5,	0,	'Data pengeluaran bonus SDSB ONLINE - SDSB ONLINE',	1,	'2018-10-08',	1,	'2018-10-14 16:11:47'),
(15,	NULL,	'4QqmKMhGBHFLz3O',	'0',	NULL,	0,	'1123234234',	'Pengeluaran Bulanan',	0,	0,	0,	0,	0,	15000,	15000,	8,	52,	62,	0,	NULL,	0,	'Pengeluaran Bulanan - Biaya Uang Makan',	1,	'2018-10-09',	1,	'2018-10-14 18:18:41'),
(16,	1,	'kMxbnqjQDC90rFE',	'0',	'',	0,	'adit99',	'99325235323',	0,	0,	0,	0,	0,	1000000,	1000000,	1,	51,	61,	5,	NULL,	0,	'Deposit customer sdsb adit99',	1,	NULL,	1,	'2018-10-14 19:16:32'),
(17,	1,	'oRWlGgCyfi7D8E3',	'0',	'',	0,	'adit99',	'99325235323',	0,	0,	0,	0,	0,	500000,	500000,	1,	51,	61,	5,	NULL,	0,	'Deposit customer sdsb adit99',	1,	NULL,	1,	'2018-10-14 19:22:15'),
(18,	1,	'b1N3g8xtvhUwzsJ',	'503498',	NULL,	0,	'adit99',	'99325235323',	0,	0,	0,	0,	0,	250000,	250000,	2,	0,	62,	5,	NULL,	0,	'Pembelian nomor kupon sdsb adit99',	1,	NULL,	1,	'2018-10-14 19:40:39');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `unama` varchar(100) NOT NULL,
  `uuser` varchar(100) NOT NULL,
  `upass` text NOT NULL,
  `uemail` varchar(100) NOT NULL,
  `utlp` varchar(15) NOT NULL,
  `ualamat` varchar(255) DEFAULT NULL,
  `ufoto` varchar(100) DEFAULT NULL,
  `urole` tinyint(1) NOT NULL,
  `ustatus` tinyint(1) NOT NULL,
  `udate` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`uid`, `unama`, `uuser`, `upass`, `uemail`, `utlp`, `ualamat`, `ufoto`, `urole`, `ustatus`, `udate`) VALUES
(1,	'SDSB Super Admin',	'admin',	'202cb962ac59075b964b07152d234b70',	'admin@sdsb.com',	'081219917799',	'Jl. Penjaringan Utara No. 15 Rt: 01/06, Jakarta',	'user.png',	1,	1,	'2018-09-30 13:05:32'),
(2,	'Sulaeman',	'sule',	'202cb962ac59075b964b07152d234b70',	'sule@gmail.com',	'81219913557',	'Jl. Kelomang 5 No. 15 Rt:09/16 Kemayoran, Jakarta',	'1538292541.jpeg',	3,	1,	'2018-09-30 09:23:56');

DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher` (
  `vid` int(10) NOT NULL AUTO_INCREMENT,
  `vkode` varchar(50) NOT NULL,
  `vawal` date NOT NULL,
  `vakhir` date NOT NULL,
  `vpotongan` tinyint(5) NOT NULL,
  `vbrand` tinyint(1) NOT NULL,
  `vstatus` tinyint(1) NOT NULL,
  `vdate` datetime NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `voucher` (`vid`, `vkode`, `vawal`, `vakhir`, `vpotongan`, `vbrand`, `vstatus`, `vdate`) VALUES
(1,	'BONUS10',	'2018-10-10',	'2018-10-30',	10,	0,	1,	'2018-09-30 23:30:38'),
(2,	'BONUS5',	'2018-10-10',	'2018-10-30',	5,	0,	1,	'2018-09-30 18:43:37');

-- 2018-10-15 01:31:45
