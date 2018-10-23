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
(1,	'SBOBET',	1,	0,	1,	NULL,	'cusersbo',	'cdepositsbo',	'rwinlose1',	NULL,	1,	'2018-10-11 22:31:55'),
(2,	'MAXBET',	1,	0,	1,	NULL,	'cuseribc',	'cdepositibc',	'rwinlose2',	NULL,	1,	'2018-10-11 22:32:10'),
(3,	'HOREY4D',	1,	0,	1,	NULL,	'cuserhorey',	'cdeposithorey',	'rwinlose3',	NULL,	1,	'2018-10-11 22:32:32'),
(4,	'TANGKASNET',	1,	0,	1,	NULL,	'cusertangkas',	'cdeposittangkas',	'rwinlose4',	NULL,	1,	'2018-10-11 22:32:46'),
(5,	'SDSB ONLINE',	1,	0,	1,	NULL,	'cuser',	'cdeposit',	'rwinlose5',	NULL,	1,	'2018-10-12 10:32:59'),
(6,	'gvip58',	0,	1,	1,	NULL,	'cusersbo',	'cdepositsbo',	'rwinlose6',	NULL,	1,	'2018-10-22 10:33:08'),
(7,	'ain5858',	0,	1,	1,	NULL,	'cusersbo',	'cdepositsbo',	'rwinlose7',	NULL,	1,	'2018-10-13 00:41:34'),
(8,	'ehoki9',	0,	1,	1,	NULL,	'cusersbo',	'cdepositsbo',	'rwinlose8',	NULL,	1,	'2018-10-13 00:42:03'),
(9,	'ajc92',	0,	1,	1,	NULL,	'cusersbo',	'cdepositsbo',	'rwinlose9',	NULL,	1,	'2018-10-13 00:42:28');

-- 2018-10-22 10:34:50
