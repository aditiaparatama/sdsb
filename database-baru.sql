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
(1,	'SBOBET',	1,	0,	1,	'http://www.birusbo.com',	'cusersbo',	'cdepositsbo',	'rwinlose1',	'1540795042.jpeg',	1,	'2018-10-29 07:38:22'),
(2,	'MAXBET',	1,	0,	1,	'http://google.com',	'cusermax',	'cdepositmax',	'rwinlose2',	'1540309877.jpeg',	1,	'2018-10-23 17:51:17'),
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
  `gperiodeawal` date DEFAULT NULL,
  `gperiodeakhir` date DEFAULT NULL,
  `gbrand` tinyint(1) DEFAULT NULL,
  `gstatus` tinyint(1) DEFAULT NULL,
  `gdate` datetime DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `general` (`gid`, `gname`, `gdolar`, `grate`, `gharga`, `gpotongan`, `gdiskon`, `gqtydari`, `gqtysampai`, `gketerangan`, `gketerangan2`, `gperiodeawal`, `gperiodeakhir`, `gbrand`, `gstatus`, `gdate`) VALUES
(1,	'Harga Kupon',	NULL,	NULL,	10000,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2018-11-07 23:31:50'),
(2,	'Periode Kupon',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Periode Pertama',	NULL,	'2018-11-01',	'2018-11-19',	5,	9,	'2018-11-13 22:22:59'),
(3,	'Periode Kupon',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Periode Kedua',	NULL,	'2018-11-20',	'2018-11-26',	5,	9,	'2018-11-13 22:27:16'),
(4,	'Potongan Pembelian',	NULL,	NULL,	NULL,	NULL,	3,	10,	20,	NULL,	NULL,	NULL,	NULL,	NULL,	2,	'2018-11-14 17:03:27'),
(5,	'Potongan Pembelian',	NULL,	NULL,	NULL,	NULL,	5,	21,	30,	NULL,	NULL,	NULL,	NULL,	NULL,	2,	'2018-11-14 17:03:35');

DROP TABLE IF EXISTS `nomor`;
CREATE TABLE `nomor` (
  `nid` int(15) NOT NULL AUTO_INCREMENT,
  `ncustomer` int(15) DEFAULT NULL,
  `nnomor` varchar(10) NOT NULL,
  `nperiode` date DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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


DROP TABLE IF EXISTS `pesan`;
CREATE TABLE `pesan` (
  `pid` int(15) NOT NULL AUTO_INCREMENT,
  `ptitle` varchar(100) NOT NULL,
  `ppesan` text NOT NULL,
  `puser` int(15) NOT NULL,
  `padmin` int(15) DEFAULT NULL,
  `pstatus` tinyint(1) NOT NULL,
  `pterbaca` tinyint(1) NOT NULL,
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
(1,	'BCA',	'SDSB Online',	'121212121212',	5000000,	0,	1,	'2018-11-14 19:26:39'),
(2,	'Mandiri',	'Mike Mohede',	'151515151515',	50000,	0,	1,	'2018-11-14 19:27:04');

DROP TABLE IF EXISTS `reportdetailcustomer`;
CREATE TABLE `reportdetailcustomer` (
  `rdid` int(15) NOT NULL AUTO_INCREMENT,
  `rdperiode` date NOT NULL,
  `rdcustomerid` int(15) NOT NULL,
  `rdbrand` int(2) NOT NULL,
  `rddeposit` int(15) NOT NULL,
  `rdwinlose` int(15) NOT NULL,
  `rdwithdraw` int(15) NOT NULL,
  `rdstatus` tinyint(1) NOT NULL,
  `rddate` datetime NOT NULL,
  PRIMARY KEY (`rdid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
(1,	NULL,	'uXYkcmn23EoAVl0',	'0',	NULL,	0,	NULL,	NULL,	'121212121212',	0,	0,	0,	0,	0,	5000000,	5000000,	5,	51,	0,	5,	NULL,	0,	'Saldo awal',	1,	NULL,	1,	'2018-11-14 19:26:39'),
(2,	NULL,	'hQenUFW6JB5fkoY',	'0',	NULL,	0,	NULL,	NULL,	'151515151515',	0,	0,	0,	0,	0,	50000,	50000,	5,	51,	0,	5,	NULL,	0,	'Saldo awal',	1,	NULL,	1,	'2018-11-14 19:27:04');

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
(1,	'SDSB Super Admin	',	'admin',	'202cb962ac59075b964b07152d234b70',	'admin@sdsb.com',	'081219917799',	'Jl. Penjaringan Utara No. 15 Rt: 01/06, Jakarta',	'user.png',	1,	1,	'2018-11-07 12:57:10'),
(2,	'Aan',	'aan',	'202cb962ac59075b964b07152d234b70',	'aan@sdsb.online',	'0812152352323',	'Jl. Kecubung Raya No.15 Pasar Minggu - Jakarta',	'1542220185.jpeg',	2,	1,	'2018-11-07 08:41:07');

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


-- 2018-11-14 18:31:06
