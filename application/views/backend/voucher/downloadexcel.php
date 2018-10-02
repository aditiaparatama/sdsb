<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Data-Voucher.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

?>

<table>
    <tr>
        <td><strong>Nama Excel</strong></td>
    </tr>    
    <tr>
        <td>Data Voucher #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td colspan="2">Kode Voucher</td>
        <td colspan="2">Tanggal Aktif</td>
        <td colspan="2">Tanggal Non-Aktif</td>
        <td colspan="3">Potongan</td>
    </tr>
    <?php 
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td colspan="2"><?php echo $list->kode_voucher; ?></td>
        <td colspan="2"><?php echo date('d F Y', strtotime($list->aktif_voucher)); ?></td>
        <td colspan="2"><?php echo date('d F Y', strtotime($list->nonaktif_voucher)); ?></td>
        <td colspan="3"><?php echo $list->potongan_voucher; ?>%</td>
    </tr>
    <?php } ?>
</table>
