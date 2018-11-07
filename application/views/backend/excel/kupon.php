<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-Pembelian-Kupon.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>

<table>
    <tr>
        <td><strong>Report Pembelian Kupon</strong></td>
    </tr>    
    <tr>
        <td>Periode <?php echo  date('d F Y', strtotime($dari)); ?> - <?php echo  date('d F Y', strtotime($sampai)); ?> #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="#03A9F4">
        <td>#</td>
        <td>User</td>
        <td>Nomor Kupon</td>
        <td>Periode</td>
        <td>Harga</td>
    <?php 
        $i=1; $charga=0;
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td><?php echo $i; ?></td>
        <td><?php echo $list->cuser; ?></td>
        <td><?php echo $list->tkupon; ?></td>
        <td><?php echo date('d-M-Y', strtotime($list->nperiode)); ?></td>
        <td>Rp. <?php echo number_format($list->tharga); ?></td>
    </tr>
    <?php $i++; $charga += $list->tharga; } ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>   
    <tr>
        <td><strong>Keuntungan</strong></td>
    	<td></td>
        <td></td>
        <td></td>
        <td><strong>Rp. <?php echo number_format($charga); ?></strong></td>
    </tr>    
</table>
