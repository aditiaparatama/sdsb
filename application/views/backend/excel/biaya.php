<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-Biaya-Bulanan-$dari.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>

<table>
    <tr>
        <td><strong>Report Biaya Bulanan</strong></td>
    </tr>    
    <tr>
        <td>Biaya Bulanan <?php echo  date('d F Y', strtotime($dari)); ?> - <?php echo  date('d F Y', strtotime($sampai)); ?> #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="#03A9F4">
        <td>#</td>
        <td>Tanggal</td>
        <td colspan="2">Field</td>
        <td colspan="2">Keterangan 1</td>
        <td colspan="2">Keterangan 2</td>
        <td>Harga</td>
        <td>Rate</td>
        <td>Total (Rupiah)</td>
    <?php 
        $i=1; $charga=0; $ctotal=0;
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td><?php echo $i; ?></td>
        <td scope="row"><?php echo date('d-M-Y', strtotime($list->gperiode)); ?></td>
        <td colspan="2"><?php echo $list->gname; ?></td>
        <td colspan="2"><?php echo $list->gketerangan; ?></td>
        <td colspan="2"><?php echo $list->gketerangan2; ?></td>
        <td>USD <?php echo number_format($list->gdolar); ?></td>
        <td>IDR <?php echo number_format($list->grate); ?></td>
        <td>Rp. <?php echo number_format($list->gharga); ?></td>
    </tr>
    <?php $i++; $charga += $list->gdolar; $ctotal += $list->gharga; } ?>
    <tr>
        <td></td>
    	<td></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>    
    <tr bgcolor="#9E9E9E">
        <td></td>
        <td></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td>USD <?php echo number_format($charga); ?></td>
        <td></td>
        <td>Rp. <?php echo number_format($ctotal); ?></td>
    </tr>
</table>
