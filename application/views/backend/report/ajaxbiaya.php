<div class="row clearfix" style="margin-top:-50px">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-light-blue">
                        <th>Tanggal</th>
                        <th>Field</th>
                        <th>Keterangan 1</th>
                        <th>Keterangan 2</th>
                        <th>Harga</th>
                        <th>Rate</th>
                        <th>Total (Rupiah)</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
			    	$charga=0; $ctotal=0;
					foreach($lists as $list) {   
				?>
                    <tr>
                        <td scope="row"><?php echo date('d-M-Y', strtotime($list->gperiode)); ?></td>
                        <td><?php echo $list->gname; ?></td>
                        <td><?php echo $list->gketerangan; ?></td>
                        <td><?php echo $list->gketerangan2; ?></td>
                        <td><small>USD</small> <?php echo number_format($list->gdolar); ?></td>
                        <td><small>IDR</small> <?php echo number_format($list->grate); ?></td>
                        <td>Rp. <?php echo number_format($list->gharga); ?></td>
                    </tr>
    			<?php $charga += $list->gdolar; $ctotal += $list->gharga; } ?>
                </tbody>
                <tfoot class="bg-grey">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>USD <?php echo number_format($charga); ?></th>
                        <th></th>
                        <th>Rp. <?php echo number_format($ctotal); ?></th>
                    </tr>
                </tfoot>
            </table>
            <form action="<?php echo base_url('general/reportbiaya_excel'); ?>" method="POST">
                <input type="hidden" name="dari" value="<?php echo $dari;?>">
                <input type="hidden" name="sampai" value="<?php echo $sampai;?>">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect pull-left">Download Excel</button>
            </form>
        </div>
    </div>
</div>
</div>