CATATAN

-> Status
	1  = debit
	2  = withdraw
	5  = rekening
	8  = pengeluaran bulanan
	- tjenis

-> Rekening
	51 = uang masuk
	52 = uang keluar
	53 = perubahan
	- tsubjenis

-> Deposit
	61 = uang masuk
	62 = uang keluar
	63 = perubahan
	- tsubdeposit

INSERT INTO `user` (`uid`, `unama`, `uuser`, `upass`, `uemail`, `utlp`, `ualamat`, `ufoto`, `urole`, `ustatus`, `udate`) VALUES
(1,	'SDSB Super Admin',	'admin',	'202cb962ac59075b964b07152d234b70',	'admin@sdsb.com',	'081219917799',	'Jl. Penjaringan Utara No. 15 Rt: 01/06, Jakarta',	'user.png',	1,	1,	'2018-09-30 13:05:32')

update
- deposit customer belom masuk laba rugi