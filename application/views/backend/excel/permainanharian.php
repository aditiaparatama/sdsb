<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Report-Permainan-Harian-$dari.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
?>

<table>
    <tr>
        <td><strong>Report Permainan Harian</strong></td>
    </tr>    
    <tr>
        <td>Permainan Harian Periode <?php echo  date('d F Y', strtotime($dari)); ?> - <?php echo  date('d F Y', strtotime($sampai)); ?> #ContentManagenetSystem(CMS)</td>
    </tr>
</table>
<br>
<table border-collapse="collapse">
    <tr bgcolor="#03A9F4">
        <td>#</td>
        <td colspan="2">Email</td>
        <td>Brand</td>
        <td>Win/Lose</td>
        <td>Comm Bonus</td>
        <td>Referral Bonus</td>
        <td colspan="2">Date</td>
    <?php 
        $i=1; $cbonus=0; $cwin=0; $close=0; $cmember=0;
        foreach($lists as $list) {     
            if($list->tbrand == 1){
                $brand = 'SBOBET';
            }else if($list->tbrand == 2){
                $brand = 'IBCBET';
            }else if($list->tbrand == 3){
                $brand = 'HOREY4D';
            }else if($list->tbrand == 4){
                $brand = 'TANGKASNET';
            }else if($list->tbrand == 5){
                $brand = 'SDSB Online';
            }

            if($list->tbonus < 0){
                $class1 = 'class="col-red"';
            }else{
                $class1 = '';
            }
            if($list->twin < 0){
                $class3 = 'class="col-red"';
            }else{
                $class3 = '';
            }
            if($list->tlose < 0){
                $class4 = 'class="col-red"';
            }else{
                $class4 = 'class="col-red"';
            }
            if($list->tmembercomm < 0){
                $class5 = 'class="col-red"';
            }else{
                $class5 = '';
            }
    ?>
    <tr border="1px solid black;">
        <td><?php echo $i; ?></td>
        <td colspan="2"><?php echo $list->cemail; ?></td>
        <td><?php echo $brand; ?></td>
        <td><span <?php echo $class3; ?>><?php echo $list->twin.'</span>/<span '.$class4.'>'.$list->tlose; ?></span></td>
        <td><?php echo number_format($list->tmembercomm); ?></td>
        <td><?php echo number_format($list->tbonus); ?></td>
        <td colspan="2"><?php echo date('d F Y', strtotime($list->tperiode)); ?></td>
    </tr>
    <?php $i++; $cbonus += $list->tbonus; $cwin += $list->twin; $close += $list->tlose; $cmember += $list->tmembercomm; } ?>
    <tr>
    	<td></td>
        <td colspan="2"></td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2"></td>
    </tr>    
    <?php
        if($list->tbonus < 0){
            $clas1 = 'class="col-red"';
        }else{
            $clas1 = '';
        }
        if($list->twin < 0){
            $clas3 = 'class="col-red"';
        }else{
            $clas3 = '';
        }
        if($list->tlose < 0){
            $clas4 = 'class="col-red"';
        }else{
            $clas4 = 'class="col-red"';
        }
        if($cmember < 0){
            $clas5 = 'class="col-red"';
        }else{
            $clas5 = '';
        }
    ?>
    <tr bgcolor="#9E9E9E">
        <td></td>
        <td colspan="2"></td>
        <td></td>
        <td><span <?php echo $clas3; ?>><?php echo $cwin; ?></span>/<span <?php echo $class4; ?>><?php echo $close; ?></span></td>
        <td><?php echo $cmember; ?></td>
        <td><?php echo $cbonus; ?></td>
        <td colspan="2"></td>
    </tr>
</table>
