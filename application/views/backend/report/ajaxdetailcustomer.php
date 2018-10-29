<div class="row clearfix" style="margin-top:-50px">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-light-blue">                        
                        <th style="min-width: 120px;">Email</th>
                        <th style="min-width: 120px;">Brand</th>
                        <th style="min-width: 120px;">Deposit</th>
                        <th style="min-width: 120px;">Win/Lose</th>
                        <th style="min-width: 120px;">Withdraw</th>
                        <th style="min-width: 120px;">Balance</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
					foreach($lists as $list) {   
                        if($list->rdbrand == 1){
                            $brand   = 'SBOBET';
                            $deposit = $list->cdepositsbo; 
                        }else if($list->rdbrand == 2){
                            $brand   = 'MAXBET';
                            $deposit = $list->cdepositmax; 
                        }else if($list->rdbrand == 3){
                            $brand   = 'HOREY4D';
                            $deposit = $list->cdeposithorey; 
                        }else if($list->rdbrand == 4){
                            $brand   = 'TANGKASNET';
                            $deposit = $list->cdeposittangkas; 
                        }else if($list->rdbrand == 5){
                            $brand   = 'SDSB ONLINE';
                            $deposit = $list->cdeposit; 
                        }


                        if($list->rddeposit < 0){
                            $class3 = 'class="col-red"';
                        }else{
                            $class3 = '';
                        }
                        if($list->rdwinlose < 0){
                            $class4 = 'class="col-red"';
                        }else{
                            $class4 = '';
                        }
                        if($list->rdwithdraw < 0){
                            $class5 = 'class="col-red"';
                        }else{
                            $class5 = 'class="col-red"';
                        }
                        if($deposit < 0){
                            $class6 = 'class="col-red"';
                        }else{
                            $class6 = '';
                        }
				?>
                    <tr>
                        <td><?php echo $list->cemail; ?></td>
                        <td><?php echo $brand; ?></td>
                        <td <?php echo $class3; ?>>Rp. <?php echo number_format($list->rddeposit); ?></td>
                        <td <?php echo $class4; ?>>Rp. <?php echo number_format($list->rdwinlose); ?></td>
                        <td <?php echo $class5; ?>>Rp. <?php echo number_format($list->rdwithdraw); ?></td>
                        <td <?php echo $class6; ?>>Rp. <?php echo number_format($deposit); ?></td>
                    </tr>
    			<?php } ?>
                </tbody>
                <tfoot class="bg-grey">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
<!--             <form action="<?php echo base_url('general/reportbiaya_excel'); ?>" method="POST">
                <input type="hidden" name="dari" value="<?php echo $dari;?>">
                <input type="hidden" name="sampai" value="<?php echo $sampai;?>">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect pull-left">Download Excel</button>
            </form> -->
        </div>
    </div>
</div>
</div>