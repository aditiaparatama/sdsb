<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Laporan-Pengeluaran-Bulanan.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>

<table>
    <tr>
        <td><strong>Laporan Pengeluaran Bulanan</strong></td>
    </tr>    
    <tr>
        <td>Pengeluaran Bulanan #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td colspan="2">Keterangan</td>
        <td colspan="2">Biaya</td>
        <td colspan="2">Periode</td>
    </tr>
    <?php 
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td colspan="2"><?php echo $list->name_general; ?></td>
        <td colspan="2">Rp. <?php echo number_format($list->harga_general); ?></td>
        <td colspan="2"><?php echo date('F', strtotime($list->periode_general)); ?></td>
    </tr>
    <?php } ?>
</table>
