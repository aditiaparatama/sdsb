<div class="row clearfix" style="margin-top:-50px">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="bg-light-blue">
                        <th style="min-width: 150px;">Nama</th>
                        <th style="min-width: 120px;">Email</th>
                        <th>Telepon</th>
                        <th style="min-width: 250px;">Alamat</th>
                        <th>Bank</th>
                        <th style="min-width: 120px;">Nama Rekening</th>
                        <th>No Rekening</th>
                        <th style="min-width: 120px;">User SBOBET</th>
                        <th style="min-width: 120px;">User MAXBET</th>
                        <th style="min-width: 120px;">User HOREY4D</th>
                        <th style="min-width: 160px;">User TANGKASNET	</th>
                        <th style="min-width: 160px;">User SDSB ONLINE</th>
                        <th style="min-width: 140px;">Deposit SBOBET</th>
                        <th style="min-width: 140px;">Deposit MAXBET</th>
                        <th style="min-width: 140px;">Deposit HOREY4D</th>
                        <th style="min-width: 180px;">Deposit TANGKASNET</th>
                        <th style="min-width: 160px;">Deposit SDSB ONLINE</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
			    	$cdepo1=0; $cdepo2=0; $cdepo3=0; $cdepo4=0; $cdepo5=0;
					foreach($lists as $list) {   
				?>
                    <tr>
                        <td><?php echo $list->cnama; ?></td>
                        <td><?php echo $list->cemail; ?></td>
                        <td><?php echo $list->ctlp; ?></td>
                        <td><?php echo $list->calamat; ?></td>
                        <td><?php echo $list->cbank; ?></td>
                        <td><?php echo $list->cnamarek; ?></td>
                        <td><?php echo $list->cnorek; ?></td>
                        <td><?php echo $list->cusersbo; ?></td>
                        <td><?php echo $list->cusermax; ?></td>
                        <td><?php echo $list->cuserhorey; ?></td>
                        <td><?php echo $list->cusertangkas; ?></td>
                        <td><?php echo $list->cuser; ?></td>
                        <td>Rp. <?php echo number_format($list->cdepositsbo); ?></td>
                        <td>Rp. <?php echo number_format($list->cdepositmax); ?></td>
                        <td>Rp. <?php echo number_format($list->cdeposithorey); ?></td>
                        <td>Rp. <?php echo number_format($list->cdeposittangkas); ?></td>
                        <td>Rp. <?php echo number_format($list->cdeposit); ?></td>
                    </tr>
    			<?php $cdepo1 += $list->cdepositsbo; $cdepo2 += $list->cdepositmax; $cdepo3 += $list->cdeposithorey; $cdepo4 += $list->cdeposittangkas; $cdepo5 += $list->cdeposit; } ?>
                </tbody>
                <tfoot class="bg-grey">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Rp. <?php echo number_format($cdepo1); ?></th>
                        <th>Rp. <?php echo number_format($cdepo2); ?></th>
                        <th>Rp. <?php echo number_format($cdepo3); ?></th>
                        <th>Rp. <?php echo number_format($cdepo4); ?></th>
                        <th>Rp. <?php echo number_format($cdepo5); ?></th>
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