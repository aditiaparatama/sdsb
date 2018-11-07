<div class="row clearfix" style="margin-top:-50px">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-light-blue">
                        <th>User</th>
                        <th>Nomor Kupon</th>
                        <th>Periode</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
			    	$charga=0;
					foreach($lists as $list) {   
				?>
                    <tr>
                        <td><?php echo $list->cuser; ?></td>
                        <td><?php echo $list->tkupon; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($list->nperiode)); ?></td>
                        <td>Rp. <?php echo number_format($list->tharga); ?></td>
                    </tr>
    			<?php $charga += $list->tharga; } ?>
                </tbody>
                <tfoot class="bg-grey">
                        <th>Keuntungan</th>
                        <th></th>
                        <th></th>
                        <th>Rp. <?php echo number_format($charga); ?></th>
                    </tr>
                </tfoot>
            </table>
            <form action="<?php echo base_url('general/reportkupon_excel'); ?>" method="POST">
                <input type="hidden" name="dari" value="<?php echo $dari;?>">
                <input type="hidden" name="sampai" value="<?php echo $sampai;?>">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect pull-left">Download Excel</button>
            </form>
        </div>
    </div>
</div>
</div>