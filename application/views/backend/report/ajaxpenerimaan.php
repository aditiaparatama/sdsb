
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaksi</th>
                        <th>Customer</th>
                        <th>Hal</th>
                        <th>Harga</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
			    	$i = 1;
			    	$total = 0;
					foreach($lists as $list) { 
				?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $list->nomor_transaksi; ?></td>
                        <td><?php echo $list->nama_customer; ?></td>
                        <td>Pembelian Nomor Kupon</td>
                        <td>Rp. <?php echo number_format($list->grandtotal_transaksi); ?></td>
                        <td><?php echo date('d F Y H:i:s', strtotime($list->date_transaksi)); ?></td>
                    </tr>
    			<?php $i++; $total += $list->grandtotal_transaksi; } ?>
                </tbody>
                <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Rp. <?php echo number_format($total); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>