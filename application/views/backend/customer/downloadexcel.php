<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Data-Customer.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

?>

<table>
    <tr>
        <td><strong>Nama Excel</strong></td>
    </tr>    
    <tr>
        <td>Data Customer #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td colspan="2">Nama Customer</td>
        <td colspan="2">Email Customer</td>
        <td colspan="2">Telepon Customer</td>
        <td colspan="3">Alamat Customer</td>
        <td colspan="2">Bank Customer</td>
        <td colspan="2">Nama Pemilik Rekening</td>
        <td colspan="2">Nomor Rekening</td>
    </tr>
    <?php 
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td colspan="2"><?php echo $list->nama_customer; ?></td>
        <td colspan="2"><?php echo $list->email_customer; ?></td>
        <td colspan="2">'<?php echo $list->tlp_customer; ?></td>
        <td colspan="3"><?php echo $list->alamat_customer.', '. $list->kota_customer.' - '.$list->prov_customer; ?></td>
        <td colspan="2"><?php echo $list->bank_customer; ?></td>
        <td colspan="2"><?php echo $list->nmrekening_customer; ?></td>
        <td colspan="2"><?php echo $list->nmrrekening_customer; ?></td>
    </tr>
    <?php } ?>
</table>
