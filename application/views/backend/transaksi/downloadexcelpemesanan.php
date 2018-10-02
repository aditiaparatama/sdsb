<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Transaksi-Penambahan-Deposit.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

?>

<table>
    <tr>
        <td><strong>Transaksi Penambahan Deposit</strong></td>
    </tr>    
    <tr>
        <td>Daftar pemesanan transaksi penambahan deposit customer #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td>No Transaksi</td>
        <td colspan="2">Nama</td>
        <td>Potongan</td>
        <td colspan="2">Total</td>
        <td colspan="2">Status</td>
        <td colspan="2">Bukti Transfer</td>
    </tr>
    <?php 
        foreach($lists as $list) {      
        if($list->status_deposit == 3){
            $status = 'Pending Pembayaran';
        }else{
            $status = 'Validasi Pembayaran';
        }
    ?>
    <tr border="1px solid black;">
        <td><?php echo $list->nomor_deposit; ?></td>
        <td colspan="2"><?php echo $list->nama_customer; ?></td>
        <td><?php echo $list->potongan_deposit; ?>%</td>
        <td colspan="2">Rp. <?php echo number_format($list->grandtotal_deposit); ?></td>
        <td colspan="2"><?php echo $status; ?></td>
        <td><a href="<?php echo URL_ASSETS."images/backend/upload/".$list->link_deposit; ?>" target="_blank"><?php echo $list->link_deposit; ?></a></td>
    </tr>
    <?php } ?>
</table>
