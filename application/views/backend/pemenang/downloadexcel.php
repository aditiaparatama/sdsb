<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Data-Pemenang.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

?>

<table>
    <tr>
        <td><strong>Nama Excel</strong></td>
    </tr>    
    <tr>
        <td>Data Pemenang Mingguan #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td>Hari</td>
        <td colspan="2">Tanggal</td>
        <td>Voucher</td>
        <td>Pemenang</td>
        <td colspan="2">Customer</td>
    </tr>
    <?php 
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td><?php echo date('l', strtotime($list->tanggal_pemenang)); ?></td>
        <td colspan="2"><?php echo date('d F Y', strtotime($list->tanggal_pemenang)); ?></td>
        <td><b><?php echo $list->nomor_pemenang; ?></b></td>
        <td>Pemenang <?php echo $list->order_pemenang; ?></td>
        <td colspan="2"><?php echo $list->nama_customer; ?></td>
    </tr>
    <?php } ?>
</table>
