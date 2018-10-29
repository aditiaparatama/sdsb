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
(1,	'Ujang Gonzales',	'ujang5',	'ujang1',	'',	'ujang3',	'',	'ujanggonzales123@gmail.com',	'202cb962ac59075b964b07152d234b70',	'0856325362325',	'Jl. Kecubung Raya No.10',	'BCA',	'Ujang Gonzales',	'4543567382599',	1000000,	50000,	0,	50000,	0,	'1540789787.jpeg',	1,	1,	'2018-10-29 06:09:47');

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
(1,	'Harga Kupon',	NULL,	NULL,	250000,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2018-10-29 12:06:04'),
(2,	'Potongan Pembelian',	NULL,	NULL,	NULL,	NULL,	2,	5,	10,	NULL,	NULL,	NULL,	NULL,	2,	'2018-10-29 06:08:23');

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
(1,	'BCA',	'SDSB Online',	'131313131555',	5000000,	2,	1,	'2018-10-29 06:07:09'),
(2,	'Mandiri',	'Mike Mohede',	'151515151666',	1150000,	1,	1,	'2018-10-29 06:07:38');

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

INSERT INTO `reportdetailcustomer` (`rdid`, `rdperiode`, `rdcustomerid`, `rdbrand`, `rddeposit`, `rdwinlose`, `rdwithdraw`, `rdstatus`, `rddate`) VALUES
(1,	'2018-10-29',	1,	1,	50000,	0,	0,	1,	'2018-10-29 06:09:47'),
(2,	'2018-10-29',	1,	3,	50000,	0,	0,	1,	'2018-10-29 06:09:48'),
(3,	'2018-10-29',	1,	5,	1000000,	0,	0,	1,	'2018-10-29 06:09:48');

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
(1,	'2018-10-29',	3,	1100000,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	'2018-10-29 06:09:47');

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
(1,	NULL,	'qa8JrU9LfRuncQl',	'0',	NULL,	0,	NULL,	NULL,	'131313131555',	0,	0,	0,	0,	0,	5000000,	5000000,	5,	51,	0,	5,	NULL,	0,	'Saldo awal',	1,	NULL,	1,	'2018-10-29 06:07:09'),
(2,	NULL,	'vbafgSN9ATX8nlE',	'0',	NULL,	0,	NULL,	NULL,	'151515151666',	0,	0,	0,	0,	0,	50000,	50000,	5,	51,	0,	5,	NULL,	0,	'Saldo awal',	1,	NULL,	1,	'2018-10-29 06:07:38'),
(3,	1,	'Yj76TlBod8wN1c5',	'0',	NULL,	0,	NULL,	'ujang1',	'151515151666',	0,	0,	0,	0,	0,	50000,	50000,	1,	51,	61,	1,	NULL,	0,	'Saldo awal SBOBET customer ujang1',	1,	'2018-10-29',	1,	'2018-10-29 06:09:47'),
(4,	1,	'AX5yuqWDmTLfI2J',	'0',	NULL,	0,	NULL,	'ujang3',	'151515151666',	0,	0,	0,	0,	0,	50000,	50000,	1,	51,	61,	3,	NULL,	0,	'Saldo awal HOREY4D customer ujang3',	1,	'2018-10-29',	1,	'2018-10-29 06:09:47'),
(5,	1,	'zFk0j7QEuLAxCnt',	'0',	NULL,	0,	NULL,	'ujang5',	'151515151666',	0,	0,	0,	0,	0,	1000000,	1000000,	1,	51,	61,	5,	NULL,	0,	'Saldo awal SDSB customer ujang5',	1,	'2018-10-29',	1,	'2018-10-29 06:09:48');

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


-- 2018-10-29 05:29:33
