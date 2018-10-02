<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Transfer-Dana.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

?>

<table>
    <tr>
        <td><strong>Transfer Dana</strong></td>
    </tr>    
    <tr><td></td></tr>
    <tr>
        <td>Daftar transfer dana customer #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td>ID</td>
        <td colspan="2">Customer</td>
        <td>Tujuan</td>
        <td>Nominal</td>
        <td colspan="2">Status</td>
        <td colspan="2">Tanggal</td>
    </tr>
    <?php 
        foreach($lists as $list) { 
        if($list->status_transfer == 3){
            $status = 'Pending Transfer';
        }else{
            $status = 'Transfer Berhasil';
        }
    ?>
    <tr border="1px solid black;">
        <td><?php echo $list->id_transfer; ?></td>
        <td colspan="2"><?php echo $list->nama_customer; ?></td>
        <td><?php echo $list->tujuan_transfer; ?></td>
        <td>Rp. <?php echo number_format($list->nominal_transfer); ?></td>
        <td colspan="2"><?php echo $status; ?></td>
        <td colspan="2"><?php echo date('d F Y H:i:s', strtotime($list->date_transfer)); ?></td>
    </tr>
    <?php } ?>
</table>
