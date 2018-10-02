<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-Bulan-$periode.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>

<table>
    <tr>
        <td><strong>Report</strong></td>
    </tr>    
    <tr>
        <td>Report Bulanan <?php echo $periode; ?> #ContentManagenetSystem(CMS)</td>
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
        foreach($pemasukan as $masukan) {     
    ?>
    <tr border="1px solid black;">
        <td><?php echo $i; ?></td>
        <td><?php echo $masukan->nomor_transaksi; ?></td>
        <td colspan="2"><?php echo $masukan->nama_customer; ?></td>
        <td colspan="2">Pembelian Nomor Kupon</td>
        <td colspan="2">Rp. <?php echo number_format($masukan->grandtotal_transaksi); ?></td>
        <td colspan="2"><?php echo date('d F Y H:i:s', strtotime($masukan->date_transaksi)); ?></td>
    </tr>
    <?php $i++; $total += $masukan->grandtotal_transaksi; } ?>
    <tr>
        <td></td>
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
        $total1 = 0;
        foreach($pengeluaran as $keluaran) {     
    ?>
    <tr border="1px solid black;">
        <td><?php echo $i; ?></td>
        <td colspan="2"><?php echo $keluaran->name_general; ?></td>
        <td colspan="2"><?php echo date('F Y', strtotime($keluaran->periode_general)); ?></td>
        <td colspan="2">Rp. <?php echo number_format($keluaran->harga_general); ?></td>
    </tr>
    <?php $i++; $total1 += $keluaran->harga_general; } ?>    
    <tr>
        <td></td>
    </tr>
</table>
<br>
<table>    
    <tr border="1px solid black;">
        <td colspan="2"><strong>PEMASUKAN:</strong></td>
        <td><strong>Rp. <?php echo number_format($total); ?></strong></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
    </tr>
    <tr border="1px solid black;">
        <td colspan="2"><strong>PENGELUARAN:</strong></td>
        <td><strong>Rp. <?php echo number_format($total1); ?></strong></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
    </tr>

    <tr border="1px solid black;">
        <td colspan="2"><strong>KEUNTUNGAN:</strong></td>
        <td><strong>Rp. <?php echo number_format($total-$total1); ?></strong></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="2"></td>
    </tr>
</table>