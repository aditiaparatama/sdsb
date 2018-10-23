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
  `burl` varchar(100) DEFAULT NULL,
  `bfield1` varchar(100) DEFAULT NULL,
  `bfield2` varchar(100) DEFAULT NULL,
  `bfield3` varchar(100) DEFAULT NULL,
  `bfoto` varchar(100) DEFAULT NULL,
  `bstatus` tinyint(1) DEFAULT NULL,
  `bdate` datetime NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `brand` (`bid`, `bnama`, `bparent`, `bchild`, `buser`, `burl`, `bfield1`, `bfield2`, `bfield3`, `bfoto`, `bstatus`, `bdate`) VALUES
(1,	'SBOBET',	1,	0,	1,	'http://google.com',	'cusersbo',	'cdepositsbo',	'rwinlose1',	'1540309814.png',	1,	'2018-10-23 17:50:14'),
(2,	'MAXBET',	1,	0,	1,	'http://google.com',	'cuseribc',	'cdepositibc',	'rwinlose2',	'1540309877.jpeg',	1,	'2018-10-23 17:51:17'),
(3,	'HOREY4D',	1,	0,	1,	'http://google.com',	'cuserhorey',	'cdeposithorey',	'rwinlose3',	'1540309888.jpeg',	1,	'2018-10-23 17:51:28'),
(4,	'TANGKASNET',	1,	0,	1,	'http://google.com',	'cusertangkas',	'cdeposittangkas',	'rwinlose4',	'1540309909.jpeg',	1,	'2018-10-23 17:51:49'),
(5,	'SDSB ONLINE',	1,	0,	1,	'http://google.com',	'cuser',	'cdeposit',	'rwinlose5',	'1540309925.jpeg',	1,	'2018-10-23 17:52:05'),
(6,	'gvip58',	0,	1,	1,	'http://sobet1.com',	'cusersbo',	'cdepositsbo',	'rwinlose6',	'1540207103.jpeg',	1,	'2018-10-22 13:18:23'),
(7,	'ain5858',	0,	1,	1,	NULL,	'cusersbo',	'cdepositsbo',	'rwinlose7',	NULL,	1,	'2018-10-13 00:41:34'),
(8,	'ehoki9',	0,	1,	1,	NULL,	'cusersbo',	'cdepositsbo',	'rwinlose8',	NULL,	1,	'2018-10-13 00:42:03'),
(9,	'ajc92',	0,	1,	1,	NULL,	'cusersbo',	'cdepositsbo',	'rwinlose9',	NULL,	1,	'2018-10-13 00:42:28');

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `cid` int(15) NOT NULL AUTO_INCREMENT,
  `cnama` varchar(100) NOT NULL,
  `cuser` varchar(100) DEFAULT NULL,
  `cusersbo` varchar(100) DEFAULT NULL,
  `cusermax` varchar(100) DEFAULT NULL,
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
  `cdepositmax` int(15) DEFAULT NULL,
  `cdeposithorey` int(15) DEFAULT NULL,
  `cdeposittangkas` int(15) DEFAULT NULL,
  `cfoto` varchar(100) DEFAULT NULL,
  `cterbaca` tinyint(1) DEFAULT NULL,
  `cstatus` tinyint(1) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`cid`, `cnama`, `cuser`, `cusersbo`, `cusermax`, `cuserhorey`, `cusertangkas`, `cemail`, `cpass`, `ctlp`, `calamat`, `cbank`, `cnamarek`, `cnorek`, `cdeposit`, `cdepositsbo`, `cdepositmax`, `cdeposithorey`, `cdeposittangkas`, `cfoto`, `cterbaca`, `cstatus`, `cdate`) VALUES
(1,	'Ujang Gonzales',	'ujang5',	'ujang1',	'',	'uajng3',	'',	'ujanggonzales123@gmail.com',	'202cb962ac59075b964b07152d234b70',	'08563537563',	'Jl. Beringin Utara No. 15 Rt:06/07',	'BCA',	'Ujang Gonzales',	'101241242443',	5075300,	206000,	0,	3000,	0,	'1540196136.jpeg',	1,	1,	'2018-10-22 03:38:26');

DROP TABLE IF EXISTS `general`;
CREATE TABLE `general` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `gname` varchar(100) NOT NULL,
  `gdolar` int(12) DEFAULT NULL,
  `grate` int(12) DEFAULT NULL,
  `gharga` int(12) DEFAULT NULL,
  `gpotongan` tinyint(5) DEFAULT NULL,
  `gdiskon` tinyint(5) DEFAULT NULL,
  `gqtydari` int(5) DEFAULT NULL,
  `gqtysampai` int(5) DEFAULT NULL,
  `gketerangan` varchar(255) DEFAULT NULL,
  `gketerangan2` varchar(255) DEFAULT NULL,
  `gperiode` date DEFAULT NULL,
  `gbrand` tinyint(1) DEFAULT NULL,
  `gstatus` tinyint(1) DEFAULT NULL,
  `gdate` datetime DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `general` (`gid`, `gname`, `gdolar`, `grate`, `gharga`, `gpotongan`, `gdiskon`, `gqtydari`, `gqtysampai`, `gketerangan`, `gketerangan2`, `gperiode`, `gbrand`, `gstatus`, `gdate`) VALUES
(1,	'Harga Kupon',	NULL,	NULL,	250000,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2018-10-22 08:34:19'),
(2,	'Potongan Pembelian',	NULL,	NULL,	NULL,	NULL,	5,	2,	5,	NULL,	NULL,	NULL,	NULL,	2,	'2018-10-22 03:35:10'),
(3,	'Transport',	3,	15000,	45000,	NULL,	NULL,	NULL,	NULL,	'Ini adalah keterangan biaya transport',	'biaya transport karyawan',	'2018-10-22',	NULL,	8,	'2018-10-22 03:53:10'),
(4,	'Potongan Pembelian',	NULL,	NULL,	NULL,	NULL,	10,	6,	10,	NULL,	NULL,	NULL,	NULL,	2,	'2018-10-22 10:22:59'),
(5,	'Uang Makan',	3,	15000,	45000,	NULL,	NULL,	NULL,	NULL,	'ini uang makan',	'uang makan',	'2018-10-22',	NULL,	8,	'2018-10-22 10:26:25'),
(6,	'Potongan Pembelian',	NULL,	NULL,	NULL,	NULL,	15,	11,	15,	NULL,	NULL,	NULL,	NULL,	2,	'2018-10-22 16:29:34');

DROP TABLE IF EXISTS `nomor`;
CREATE TABLE `nomor` (
  `nid` int(15) NOT NULL AUTO_INCREMENT,
  `ncustomer` int(15) DEFAULT NULL,
  `nnomor` varchar(10) NOT NULL,
  `nperiode` date DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `nomor` (`nid`, `ncustomer`, `nnomor`, `nperiode`) VALUES
(1,	1,	'728063',	'2018-10-22'),
(2,	1,	'049625',	'2018-10-22'),
(3,	1,	'806213',	'2018-10-22'),
(4,	1,	'579036',	'2018-10-22'),
(5,	1,	'810263',	'2018-10-22'),
(6,	NULL,	'031694',	'2018-10-22'),
(7,	NULL,	'054391',	'2018-10-22'),
(8,	NULL,	'892345',	'2018-10-22'),
(9,	NULL,	'578091',	'2018-10-22'),
(10,	NULL,	'915648',	'2018-10-22'),
(11,	1,	'079216',	'2018-10-22'),
(12,	1,	'823741',	'2018-10-22');

DROP TABLE IF EXISTS `pemenang`;
CREATE TABLE `pemenang` (
  `pid` int(15) NOT NULL AUTO_INCREMENT,
  `pperiode` date NOT NULL,
  `pnomor` varchar(10) DEFAULT NULL,
  `pcustomer` int(15) DEFAULT NULL,
  `porder` tinyint(1) DEFAULT NULL,
  `pbrand` tinyint(1) DEFAULT NULL,
  `pstatus` tinyint(1) NOT NULL,
  `pdate` datetime NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pemenang` (`pid`, `pperiode`, `pnomor`, `pcustomer`, `porder`, `pbrand`, `pstatus`, `pdate`) VALUES
(1,	'2018-10-22',	'049625',	1,	1,	NULL,	1,	'2018-10-22 10:29:27'),
(2,	'2018-10-22',	'031694',	0,	2,	NULL,	1,	'2018-10-22 10:29:27'),
(3,	'2018-10-22',	'054391',	0,	3,	NULL,	1,	'2018-10-22 10:29:27'),
(4,	'2018-10-22',	'892345',	0,	4,	NULL,	1,	'2018-10-22 10:29:28'),
(5,	'2018-10-22',	'578091',	0,	5,	NULL,	1,	'2018-10-22 10:29:28'),
(6,	'2018-10-22',	'915648',	0,	6,	NULL,	1,	'2018-10-22 10:29:28');

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
(1,	'BCA',	'SDSB Online',	'112324324355',	3880700,	2,	1,	'2018-10-22 03:35:49'),
(2,	'Mandiri',	'Mike Mohede',	'103252353666',	8300000,	1,	1,	'2018-10-22 03:36:15');

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
(1,	'2018-10-22',	6,	7800000,	3,	930000,	0,	0,	-5000,	0,	992000,	0,	0,	1000000,	0,	0,	0,	0,	0,	0,	0,	1987000,	12100,	27200,	1947700,	90000,	1,	'2018-10-22 03:38:26'),
(2,	'2018-10-21',	0,	0,	0,	0,	0,	0,	0,	0,	300000,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	300000,	50000,	10000,	240000,	0,	1,	'2018-10-22 03:51:28');

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `tid` int(15) NOT NULL AUTO_INCREMENT,
  `tcustomer` int(15) DEFAULT NULL,
  `tnomor` varchar(50) DEFAULT '0',
  `tkupon` varchar(20) DEFAULT '0',
  `tvoucher` varchar(100) DEFAULT NULL,
  `tpotongan` int(5) DEFAULT '0',
  `trekeningdari` varchar(100) DEFAULT NULL,
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

INSERT INTO `transaksi` (`tid`, `tcustomer`, `tnomor`, `tkupon`, `tvoucher`, `tpotongan`, `trekeningdari`, `tdari`, `ttujuan`, `twin`, `tlose`, `tmembercomm`, `tbonus`, `tbonus2`, `tharga`, `tgrandtotal`, `tjenis`, `tsubjenis`, `tsubdeposit`, `tbrand`, `tsubbrand`, `tterbaca`, `tketerangan`, `tstatus`, `tperiode`, `tuser`, `tdate`) VALUES
(1,	NULL,	'6GzZNCovY8s3yUR',	'0',	NULL,	0,	NULL,	NULL,	'112324324355',	0,	0,	0,	0,	0,	5000000,	5000000,	5,	51,	0,	5,	NULL,	0,	'Saldo awal',	1,	NULL,	1,	'2018-10-22 03:35:49'),
(2,	NULL,	'eD3Mnyo1KbXuHw8',	'0',	NULL,	0,	NULL,	NULL,	'103252353666',	0,	0,	0,	0,	0,	500000,	500000,	5,	51,	0,	5,	NULL,	0,	'Saldo awal',	1,	NULL,	1,	'2018-10-22 03:36:15'),
(3,	1,	'lCPYAEFvLZgq79p',	'0',	NULL,	0,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	1000000,	1000000,	1,	51,	61,	5,	NULL,	0,	'Saldo awal SDSB customer ujang5',	1,	'2018-10-22',	1,	'2018-10-22 03:38:26'),
(4,	1,	'uLwVp5OSjQTermf',	'728063',	NULL,	10,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	450000,	450000,	3,	0,	62,	5,	NULL,	0,	'Pembelian nomor kupon sdsb ujang5',	1,	'2018-10-22',	1,	'2018-10-22 03:41:16'),
(5,	1,	'uLwVp5OSjQTermf',	'049625',	NULL,	10,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	450000,	450000,	3,	0,	62,	5,	NULL,	0,	'Pembelian nomor kupon sdsb ujang5',	1,	'2018-10-22',	1,	'2018-10-22 03:41:17'),
(6,	1,	'RxVZQvGu2lTnAc8',	'0',	'',	0,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	500000,	500000,	1,	51,	61,	5,	NULL,	0,	'Deposit customer sdsb ujang5',	1,	'2018-10-22',	1,	'2018-10-22 03:43:41'),
(7,	1,	'0OD2TmjUeqrV8Zd',	'0',	NULL,	0,	'112324324355',	'DEPOSIT SDSB ONLINE',	'101241242443',	0,	0,	0,	0,	0,	500000,	500000,	2,	52,	64,	5,	NULL,	0,	'Withdraw dana customer ujang5',	1,	'2018-10-22',	1,	'2018-10-22 03:44:17'),
(8,	1,	'SXb2vyAkZ9HjI1G',	'0',	NULL,	0,	'112324324355',	'112324324355',	'Pengeluaran Bonus',	1000000,	0,	10000,	20000,	0,	30000,	30000,	6,	52,	61,	5,	5,	0,	'Data pengeluaran bonus SDSB ONLINE - SDSB ONLINE',	1,	'2018-10-22',	1,	'2018-10-22 03:45:10'),
(9,	1,	'eEn5HphtcU7KuCr',	'0',	NULL,	0,	'112324324355',	'112324324355',	'Pengeluaran Bonus',	300000,	0,	50000,	10000,	0,	60000,	60000,	6,	52,	61,	5,	5,	0,	'Data pengeluaran bonus SDSB ONLINE - SDSB ONLINE',	1,	'2018-10-21',	1,	'2018-10-22 03:51:28'),
(10,	NULL,	'aJxfGRvDjh1ytEd',	'0',	NULL,	0,	'112324324355',	'112324324355',	'Pengeluaran Bulanan',	0,	0,	0,	0,	0,	45000,	45000,	8,	52,	62,	0,	NULL,	0,	'Pengeluaran bulanan Transport',	1,	'2018-10-22',	1,	'2018-10-22 03:53:10'),
(11,	1,	'1SWQYKjCRl3VJsL',	'806213',	NULL,	0,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	250000,	250000,	3,	0,	62,	5,	NULL,	0,	'Pembelian nomor kupon sdsb ujang5',	1,	'2018-10-22',	1,	'2018-10-22 04:01:43'),
(12,	1,	'elOfAN1EygdLpBr',	'0',	NULL,	0,	NULL,	'Deposit SDSB ONLINE',	'SBOBET',	0,	0,	0,	0,	0,	200000,	200000,	4,	0,	62,	5,	NULL,	0,	'Transfer dana customer ke SBOBET - ujang5',	2,	'2018-10-22',	1,	'2018-10-22 07:40:27'),
(13,	1,	'u1Z3TL2jHGOoa9x',	'0',	'',	0,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	300000,	300000,	1,	51,	61,	5,	NULL,	0,	'Deposit customer SDSB Online ujang5',	1,	'2018-10-22',	1,	'2018-10-22 10:11:08'),
(14,	1,	'wMkF1PCgqeL8csu',	'0',	NULL,	0,	NULL,	'Deposit SDSB ONLINE',	'101241242443',	0,	0,	0,	0,	0,	130000,	130000,	2,	52,	62,	5,	NULL,	0,	'Withdraw customer SDSB Online ujang5',	1,	'2018-10-22',	1,	'2018-10-22 10:18:30'),
(15,	1,	'rF0d2ivzT5EAK9m',	'579036',	NULL,	0,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	450000,	450000,	3,	0,	62,	5,	NULL,	0,	'Pembelian nomor kupon sdsbujang5',	1,	'2018-10-22',	NULL,	'2018-10-22 10:20:06'),
(16,	1,	'm7o3cX1T90KZiMA',	'810263',	NULL,	0,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	450000,	450000,	3,	0,	62,	5,	NULL,	0,	'Pembelian nomor kupon sdsbujang5',	1,	'2018-10-22',	NULL,	'2018-10-22 10:20:07'),
(17,	NULL,	'FU3l4Qxd0TCgVwH',	'0',	NULL,	0,	'112324324355',	'112324324355',	'Pengeluaran Bulanan',	0,	0,	0,	0,	0,	45000,	45000,	8,	52,	62,	0,	NULL,	0,	'Pengeluaran bulanan Uang Makan',	1,	'2018-10-22',	1,	'2018-10-22 10:26:25'),
(18,	1,	'b8AZwINvag39rpX',	'0',	NULL,	0,	NULL,	'ujang1',	'103252353666',	0,	0,	0,	0,	0,	500000,	500000,	1,	51,	61,	1,	NULL,	0,	'Deposit dana SBOBET - ujang1',	1,	'2018-10-22',	1,	'2018-10-22 10:33:57'),
(19,	1,	'JP6R3cnqx5Xi7LE',	'0',	NULL,	0,	'112324324355',	'DEPOSIT SBOBET',	'101241242443',	0,	0,	0,	0,	0,	300000,	300000,	2,	52,	62,	1,	NULL,	0,	'Withdraw dana harian  - ujang1',	1,	'2018-10-22',	1,	'2018-10-22 10:34:42'),
(20,	1,	's6VjgDO4XKAHrmW',	'0',	NULL,	0,	'112324324355',	'112324324355',	'Pengeluaran Bonus',	1000000,	0,	1000,	5000,	0,	6000,	6000,	6,	52,	61,	1,	8,	0,	'Data pengeluaran bonus ehoki9 - SBOBET',	1,	'2018-10-22',	1,	'2018-10-22 10:36:13'),
(21,	1,	'xEQ713gy5w4v80a',	'0',	NULL,	0,	'112324324355',	'112324324355',	'Pengeluaran Bonus',	0,	5000,	1000,	2000,	0,	3000,	3000,	6,	52,	61,	3,	3,	0,	'Data pengeluaran bonus HOREY4D - HOREY4D',	1,	'2018-10-22',	1,	'2018-10-22 10:43:18'),
(22,	1,	'jmPfKwb54svRT6G',	'0',	'',	0,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	500000,	500000,	1,	51,	61,	5,	NULL,	0,	'Deposit customer SDSB Online ujang5',	1,	'2018-10-22',	1,	'2018-10-22 11:51:44'),
(23,	1,	'SfAZbHrDEq7c2IW',	'0',	NULL,	0,	NULL,	'Deposit SDSB ONLINE',	'MAXBET',	0,	0,	0,	0,	0,	300000,	300000,	4,	0,	62,	5,	NULL,	0,	'Transfer dana customer ke MAXBET - ujang5',	2,	'2018-10-22',	1,	'2018-10-22 11:53:52'),
(24,	1,	'HQyMSqXuUp5ar0k',	'0',	'',	0,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	5000000,	5000000,	1,	51,	61,	5,	NULL,	0,	'Deposit customer sdsb ujang5',	1,	'2018-10-22',	1,	'2018-10-22 16:30:49'),
(25,	1,	'JwfYElHI4Ba5btD',	'079216',	NULL,	5,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	475000,	475000,	3,	0,	62,	5,	NULL,	0,	'Pembelian nomor kupon sdsb ujang5',	1,	'2018-10-22',	1,	'2018-10-22 17:47:23'),
(26,	1,	'JwfYElHI4Ba5btD',	'823741',	NULL,	5,	NULL,	'ujang5',	'103252353666',	0,	0,	0,	0,	0,	475000,	475000,	3,	0,	62,	5,	NULL,	0,	'Pembelian nomor kupon sdsb ujang5',	1,	'2018-10-22',	1,	'2018-10-22 17:47:23'),
(27,	1,	'a49TchG2kstKqVO',	'0',	NULL,	0,	'112324324355',	'112324324355',	'Pengeluaran Bonus',	0,	-3000,	100,	200,	0,	300,	300,	6,	52,	61,	5,	5,	0,	'Data pengeluaran bonus SDSB ONLINE - SDSB ONLINE',	1,	'2018-10-22',	1,	'2018-10-23 19:25:47');

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
(1,	'SDSB Super Admin',	'admin',	'202cb962ac59075b964b07152d234b70',	'admin@sdsb.com',	'081219917799',	'Jl. Penjaringan Utara No. 15 Rt: 01/06, Jakarta',	'user.png',	1,	1,	'2018-09-30 13:05:32');

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


-- 2018-10-23 17:38:31
