
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-light-blue">
                        <th style="min-width: 120px;">Periode</th>
                        <th style="min-width: 120px;">Jumlah Deposit</th>
                        <th style="min-width: 100px;">Deposit</th>
                        <th style="min-width: 130px;">Jumlah Withdraw</th>
                        <th style="min-width: 100px;">Withdraw</th>
                        <th style="min-width: 120px;">SBOBET(gvip58)</th>
                        <th style="min-width: 120px;">SBOBET(ain5858)</th>
                        <th style="min-width: 120px;">SBOBET(ehoki9)</th>
                        <th style="min-width: 120px;">SBOBET(ajc92)</th>
                        <th style="min-width: 120px;">IBCBET</th>
                        <th style="min-width: 120px;">HOREY4D</th>
                        <th style="min-width: 120px;">TANGKASNET</th>
                        <th style="min-width: 120px;">SDSB ONLINE</th>
                        <th style="min-width: 120px;">Total</th>
                        <th style="min-width: 120px;">Comm Bonus</th>
                        <th style="min-width: 120px;">Referral Bonus</th>
                        <th style="min-width: 120px;">Win/Lose Gross</th>
                        <th style="min-width: 150px;">Biaya Operasional</th>
                        <th style="min-width: 150px;">Win/Lose Nett</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
                    $cdeposit=0;
                    $cdepositrp=0;
                    $cwithdraw=0;
                    $cwithdrawrp=0;
                    $cwinlose6=0;
                    $cwinlose7=0;
                    $cwinlose8=0;
                    $cwinlose9=0;
                    $cwinlose2=0;
                    $cwinlose3=0;
                    $cwinlose4=0;
                    $cwinlose5=0;
                    $ctotalwinlose=0;
                    $ccommbonus=0;
                    $creferralbonus=0;
                    $cwinlosegross=0;
                    $cbiayaoperasional=0;
                    foreach($lists as $list) {  

                        if($list->rwinlose6 < 0){
                            $style3 = 'class="col-red"';
                        }else{
                            $style3 = '';
                        }

                        if($list->rwinlose7 < 0){
                            $style4 = 'class="col-red"';
                        }else{
                            $style4 = '';
                        }

                        if($list->rwinlose8 < 0){
                            $style5 = 'class="col-red"';
                        }else{
                            $style5 = '';
                        }

                        if($list->rwinlose9 < 0){
                            $style6 = 'class="col-red"';
                        }else{
                            $style6 = '';
                        }

                        if($list->rwinlose2 < 0){
                            $style7 = 'class="col-red"';
                        }else{
                            $style7 = '';
                        }

                        if($list->rwinlose3 < 0){
                            $style8 = 'class="col-red"';
                        }else{
                            $style8 = '';
                        } 

                        if($list->rwinlose4 < 0){
                            $style9 = 'class="col-red"';
                        }else{
                            $style9 = '';
                        } 

                        if($list->rwinlose5 < 0){
                            $style10 = 'class="col-red"';
                        }else{
                            $style10 = '';
                        } 

                        if($list->rtotalwinlose < 0){
                            $style11 = 'class="col-red"';
                        }else{
                            $style11 = '';
                        } 

                        if($list->rwinlosegross < 0){
                            $style12 = 'class="col-red"';
                        }else{
                            $style12 = '';
                        } 

                        if($list->rbiayaoperasional < 0){
                            $style13 = 'class="col-red"';
                        }else{
                            $style13 = '';
                        }
				?>
                    <tr>
                        <td scope="row"><?php echo date('d-M-Y', strtotime($list->rperiode)); ?></td>
                        <td>
                            <?php echo $list->rjmhdeposit; ?>
                        </td>
                        <td>
                            <?php echo number_format($list->rjmhdepositrp); ?>
                        </td>
                        <td>
                            <p class="col-red"><?php echo $list->rjmhwithdraw; ?>
                        </td>
                        <td>
                            <p class="col-red"><?php echo number_format($list->rjmhwithdrawrp); ?>
                        </td>
                        <td <?php echo $style3; ?>>
                            <?php echo number_format($list->rwinlose6); ?>
                        </td>
                        <td <?php echo $style4;?>>
                            <?php echo number_format($list->rwinlose7); ?>
                        </td>
                        <td <?php echo $style5;?>>
                            <?php echo number_format($list->rwinlose8); ?>
                        </td>
                        <td <?php echo $style6;?>>
                            <?php echo number_format($list->rwinlose9); ?>
                        </td>
                        <td <?php echo $style7;?>>
                            <?php echo number_format($list->rwinlose2); ?>
                        </td>
                        <td <?php echo $style8;?>>
                            <?php echo number_format($list->rwinlose3); ?>
                        </td>
                        <td <?php echo $style9;?>>
                            <?php echo number_format($list->rwinlose4); ?>
                        </td>
                        <td <?php echo $style10;?>>
                            <?php echo number_format($list->rwinlose5); ?>
                        </td>
                        <td <?php echo $style11;?>>
                            <?php echo number_format($list->rtotalwinlose); ?>
                        </td>
                        <td>
                            <p class="col-red"><?php echo number_format($list->rcommbonus); ?>
                        </td>
                        <td>
                            <p class="col-red"><?php echo number_format($list->rreferralbonus); ?>
                        </td>
                        <td <?php echo $style12;?>>
                            <?php echo number_format($list->rwinlosegross); ?>
                        </td>
                        <td <?php echo $style13;?>>
                            <?php echo number_format($list->rbiayaoperasional); ?>
                        </td>
                        <td></td>
                    </tr>
    			<?php 
                    $cdeposit += $list->rjmhdeposit;
                    $cdepositrp += $list->rjmhdepositrp;
                    $cwithdraw += $list->rjmhwithdraw;
                    $cwithdrawrp += $list->rjmhwithdrawrp;
                    $cwinlose6 += $list->rwinlose6;
                    $cwinlose7 += $list->rwinlose7;
                    $cwinlose8 += $list->rwinlose8;
                    $cwinlose9 += $list->rwinlose9;
                    $cwinlose2 += $list->rwinlose2;
                    $cwinlose3 += $list->rwinlose3;
                    $cwinlose4 += $list->rwinlose4;
                    $cwinlose5 += $list->rwinlose5;
                    $ctotalwinlose += $list->rtotalwinlose;
                    $ccommbonus += $list->rcommbonus;
                    $creferralbonus += $list->rreferralbonus;
                    $cwinlosegross += $list->rwinlosegross;
                    $cbiayaoperasional += $list->rbiayaoperasional;
                    $cnett = $cwinlosegross-$cbiayaoperasional;
                    } 

                        if($cwinlose6 < 0){
                            $class1 = 'class="col-red"';
                        }else{
                            $class1 = '';
                        }
                        
                        if($cwinlose7 < 0){
                            $class2 = 'class="col-red"';
                        }else{
                            $class2 = '';
                        }

                        if($cwinlose8 < 0){
                            $class3 = 'class="col-red"';
                        }else{
                            $class3 = '';
                        }

                        if($cwinlose9 < 0){
                            $class4 = 'class="col-red"';
                        }else{
                            $class4 = '';
                        }

                        if($cwinlose2 < 0){
                            $class5 = 'class="col-red"';
                        }else{
                            $class5 = '';
                        }

                        if($cwinlose3 < 0){
                            $class6 = 'class="col-red"';
                        }else{
                            $class6 = '';
                        }

                        if($cwinlose4 < 0){
                            $class7 = 'class="col-red"';
                        }else{
                            $class7 = '';
                        }

                        if($cwinlose5 < 0){
                            $class8 = 'class="col-red"';
                        }else{
                            $class8 = '';
                        }

                        if($ctotalwinlose < 0){
                            $class9 = 'class="col-red"';
                        }else{
                            $class9 = '';
                        }

                        if($cwinlosegross < 0){
                            $class10 = 'class="col-red"';
                        }else{
                            $class10 = '';
                        }

                        if($cbiayaoperasional < 0){
                            $class11 = 'class="col-red"';
                        }else{
                            $class11 = '';
                        }
                ?>
                </tbody>
                <tfoot class="bg-grey">
                        <th></th>
                        <th><?php echo $cdeposit; ?></th>
                        <th><?php echo number_format($cdepositrp); ?></th>
                        <th class="col-red"><?php echo $cwithdraw; ?></th>
                        <th class="col-red"><?php echo number_format($cwithdrawrp); ?></th>
                        <th <?php echo $class1;?>>
                            <?php echo number_format($cwinlose6); ?>
                        </th>
                        <th <?php echo $class2;?>>
                            <?php echo number_format($cwinlose7); ?>
                        </th>
                        <th <?php echo $class3;?>>
                            <?php echo number_format($cwinlose8); ?>
                        </th>
                        <th <?php echo $class4;?>>
                            <?php echo number_format($cwinlose9); ?>
                        </th>
                        <th <?php echo $class5;?>>
                            <?php echo number_format($cwinlose2); ?>
                        </th>
                        <th <?php echo $class6;?>>
                            <?php echo number_format($cwinlose3); ?>
                        </th>
                        <th <?php echo $class7;?>>
                            <?php echo number_format($cwinlose4); ?>
                        </th>
                        <th <?php echo $class8;?>>
                            <?php echo number_format($cwinlose5); ?>
                        </th>
                        <th <?php echo $class9;?>>
                            <?php echo number_format($ctotalwinlose); ?>
                        </th>
                        <th class="col-red"><?php echo number_format($ccommbonus); ?></th>
                        <th class="col-red"><?php echo number_format($creferralbonus); ?></th>
                        <th <?php echo $class10;?>>
                            <?php echo number_format($cwinlosegross); ?>
                        </th>
                        <th <?php echo $class11;?>>
                            <?php echo number_format($cbiayaoperasional); ?>
                        </th>
                        <th style="font-size: 15px;">Rp. <strong><?php echo number_format($cnett); ?></strong></th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
</div>