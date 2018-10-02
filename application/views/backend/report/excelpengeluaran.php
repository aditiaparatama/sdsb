<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-Pengeluaran-Bulan-$periode.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>

<table>
    <tr>
        <td><strong>Report Pengeluaran Bulanan <?php echo $periode; ?></strong></td>
    </tr>    
    <tr>
        <td>Pengeluaran Bulanan <?php echo $periode; ?> #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td>#</td>
        <td colspan="2">Keterangan</td>
        <td colspan="2">Periode</td>
        <td colspan="2">Biaya</td>
    </tr>
    <?php 
        $i = 1;
        $total = 0;
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td><?php echo $i; ?></td>
        <td colspan="2"><?php echo $list->name_general; ?></td>
        <td colspan="2"><?php echo date('F Y', strtotime($list->periode_general)); ?></td>
        <td colspan="2">Rp. <?php echo number_format($list->harga_general); ?></td>
    </tr>
    <?php $i++; $total += $list->harga_general; } ?>    
    <tr>
        <td></td>
    </tr>
    <tr border="1px solid black;">
        <td><strong>Grand Total:</strong></td>
        <td><strong>Rp. <?php echo number_format($total); ?></strong></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
    </tr>
</table>
