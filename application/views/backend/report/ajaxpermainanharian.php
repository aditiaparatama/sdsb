<div class="row clearfix" style="margin-top:-50px">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-light-blue">
                        <th>#</th>
                        <th>Email</th>
                        <th>Brand</th>
                        <th>Win/Lose</th>
                        <th>Comm Bonus</th>
                        <th>Referral Bonus</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
			    	$i=1; $cbonus=0; $cwin=0; $close=0; $cmember=0;
					foreach($lists as $list) {   
                        if($list->tbrand == 1){
                            $brand = 'SBOBET';
                        }else if($list->tbrand == 2){
                            $brand = 'MAXBET';
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
                    <tr>
                        <td scope="row"><?php echo $i; ?></td>
                        <td><a href="<?php echo base_url('customer/detail/'.$list->cemail); ?>" target="_blank">
                            <?php echo $list->cemail; ?>
                        </a></td>
                        <td><?php echo $brand; ?></td>
                        <td>
                            <span <?php echo $class3; ?>><?php echo $list->twin.'</span>/<span '.$class4.'>'.$list->tlose; ?></span>
                        </td>
                        <td <?php echo $class5; ?>>
                            <?php echo number_format($list->tmembercomm); ?>
                        </td>
                        <td <?php echo $class1; ?>>
                            <?php echo number_format($list->tbonus); ?>
                        </td>
                        <td><a href="<?php echo base_url('general/periodepermainanharian/'.$list->tperiode); ?>" target="_blank">
                            <?php echo date('d F Y', strtotime($list->tperiode)); ?>
                        </a></td>
                    </tr>
    			<?php $i++; $cbonus += $list->tbonus; $cwin += $list->twin; $close += $list->tlose; $cmember += $list->tmembercomm; } ?>
                </tbody>
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
                <tfoot class="bg-grey">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><span <?php echo $clas3; ?>><?php echo $cwin; ?></span>/<span <?php echo $class4; ?>><?php echo $close; ?></span></th>
                        <th <?php echo $clas5; ?>><?php echo number_format($cmember); ?></th>
                        <th <?php echo $clas1; ?>><?php echo number_format($cbonus); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <form action="<?php echo base_url('general/reportpermainanharian_excel'); ?>" method="POST">
                <input type="hidden" name="dari" value="<?php echo $dari;?>">
                <input type="hidden" name="sampai" value="<?php echo $sampai;?>">
                <input type="hidden" name="brand" value="<?php echo $filter;?>">
                <input type="hidden" name="email" value="<?php echo $filter2;?>">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect pull-left">Download Excel</button>
            </form>
        </div>
    </div>
</div>
</div>