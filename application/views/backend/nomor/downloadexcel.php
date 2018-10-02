<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Data-Nomor-Kupon.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

?>

<table>
    <tr>
        <td><strong>Nama Excel</strong></td>
    </tr>    
    <tr>
        <td>Data Nomor Kupon #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="blue">
        <td colspan="2">Nomor Kupon</td>
    </tr>
    <?php 
        foreach($lists as $list) {     
    ?>
    <tr border="1px solid black;">
        <td colspan="2">'<?php echo $list->nomor; ?>'</td>
    </tr>
    <?php } ?>
</table>
