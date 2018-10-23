<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-Laba-Rugi-$dari.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>

<table>
    <tr>
        <td><strong>Report Laba Rugi</strong></td>
    </tr>    
    <tr>
        <td>Permainan Laba Rugi Periode <?php echo  date('d F Y', strtotime($dari)); ?> - <?php echo  date('d F Y', strtotime($sampai)); ?> #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="#03A9F4">
        <td>Periode</td>
        <td colspan="2">Jumlah Deposit</td>
        <td colspan="2">Deposit</td>
        <td colspan="2">Jumlah Withdraw</td>
        <td colspan="2">Withdraw</td>
        <td colspan="2">SBOBET(gvip58)</td>
        <td colspan="2">SBOBET(ain5858)</td>
        <td colspan="2">SBOBET(ehoki9)</td>
        <td colspan="2">SBOBET(ajc92)</td>
        <td colspan="2">MAXBET</td>
        <td colspan="2">HOREY4D</td>
        <td colspan="2">TANGKASNET</td>
        <td colspan="2">SDSB ONLINE</td>
        <td colspan="2">Total</td>
        <td>Comm Bonus</td>
        <td>Referral Bonus</td>
        <td colspan="2">Win/Lose Gross</td>
        <td colspan="2">Biaya Operasional</td>
        <td colspan="2">Win/Lose Nett</td>
	<?php 
        $cdeposit=0;
        $cdepositrp=0;
        $cwithdraw=0;
        $cwithdrawrp=0;
        $cwinlose6=0;
        $cwinlose7=0;
        $cwinlose8=0;
        $cwinlose9=0;
        $cwinlose2=0;
        $cwinlose3=0;
        $cwinlose4=0;
        $cwinlose5=0;
        $ctotalwinlose=0;
        $ccommbonus=0;
        $creferralbonus=0;
        $cwinlosegross=0;
        $cbiayaoperasional=0;
        foreach($lists as $list) {  
	?>
    <tr border="1px solid black;">
        <td><?php echo date('d-M-Y', strtotime($list->rperiode)); ?></td>
        <td colspan="2">
            <?php echo $list->rjmhdeposit; ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rjmhdepositrp); ?>
        </td>
        <td colspan="2">
            <p class="col-red"><?php echo $list->rjmhwithdraw; ?>
        </td>
        <td colspan="2">
            <p class="col-red"><?php echo number_format($list->rjmhwithdrawrp); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlose6); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlose7); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlose8); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlose9); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlose2); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlose3); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlose4); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlose5); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rtotalwinlose); ?>
        </td>
        <td>
            <p class="col-red"><?php echo number_format($list->rcommbonus); ?>
        </td>
        <td>
            <p class="col-red"><?php echo number_format($list->rreferralbonus); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rwinlosegross); ?>
        </td>
        <td colspan="2">
            <?php echo number_format($list->rbiayaoperasional); ?>
        </td>
        <td colspan="2"></td>
    </tr>    
	<?php 
        $cdeposit += $list->rjmhdeposit;
        $cdepositrp += $list->rjmhdepositrp;
        $cwithdraw += $list->rjmhwithdraw;
        $cwithdrawrp += $list->rjmhwithdrawrp;
        $cwinlose6 += $list->rwinlose6;
        $cwinlose7 += $list->rwinlose7;
        $cwinlose8 += $list->rwinlose8;
        $cwinlose9 += $list->rwinlose9;
        $cwinlose2 += $list->rwinlose2;
        $cwinlose3 += $list->rwinlose3;
        $cwinlose4 += $list->rwinlose4;
        $cwinlose5 += $list->rwinlose5;
        $ctotalwinlose += $list->rtotalwinlose;
        $ccommbonus += $list->rcommbonus;
        $creferralbonus += $list->rreferralbonus;
        $cwinlosegross += $list->rwinlosegross;
        $cbiayaoperasional += $list->rbiayaoperasional;
        $cnett = $cwinlosegross-$cbiayaoperasional;
        }
    ?>
    <tr bgcolor="#9E9E9E">
	    <td></td>
	    <td colspan="2"><?php echo $cdeposit; ?></td>
	    <td colspan="2">Rp. <?php echo number_format($cdepositrp); ?></td>
	    <td colspan="2"><?php echo $cwithdraw; ?></td>
	    <td colspan="2">Rp. <?php echo number_format($cwithdrawrp); ?></td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlose6); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlose7); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlose8); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlose9); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlose2); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlose3); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlose4); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlose5); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($ctotalwinlose); ?>
	    </td>
	    <td>Rp. <?php echo number_format($ccommbonus); ?></td>
	    <td>Rp. <?php echo number_format($creferralbonus); ?></td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cwinlosegross); ?>
	    </td>
	    <td colspan="2">
	        Rp. <?php echo number_format($cbiayaoperasional); ?>
	    </td>
	    <td style="font-size: 15px;" colspan="2">Rp. <strong><?php echo number_format($cnett); ?></strong></td>
    </tr>
</table>
