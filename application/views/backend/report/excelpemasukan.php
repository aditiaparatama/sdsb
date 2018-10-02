<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-Pemasukan-Bulan-$periode.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>

<table>
    <tr>
        <td><strong>Report Pemasukan Bulanan</strong></td>
    </tr>    
    <tr>
        <td>Pemasukan Bulanan <?php echo $periode; ?> #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td>#</td>
        <td>No Transaksi</td>
        <td colspan="2">Customer</td>
        <td colspan="2">Hal</td>
        <td colspan="2">Harga</td>
        <td colspan="2">Date</td>
    </tr>
    <?php 
    	$i = 1;
    	$total = 0;
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td><?php echo $i; ?></td>
        <td><?php echo $list->nomor_transaksi; ?></td>
        <td colspan="2"><?php echo $list->nama_customer; ?></td>
        <td colspan="2">Pembelian Nomor Kupon</td>
        <td colspan="2">Rp. <?php echo number_format($list->grandtotal_transaksi); ?></td>
        <td colspan="2"><?php echo date('d F Y H:i:s', strtotime($list->date_transaksi)); ?></td>
    </tr>
    <?php $i++; $total += $list->grandtotal_transaksi; } ?>
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
