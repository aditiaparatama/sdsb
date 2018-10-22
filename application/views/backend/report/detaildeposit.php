<link href="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Detail Deposit
                            <small>List dari transaksi deposit user
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-light-blue">
                                        <th>Tanggal</th>
                                        <th>Email</th>
                                        <th>Brand</th>
                                        <th>Nominal</th>
                                        <th>Rek Penerima</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                        <th>Tanggal</th>
                                        <th>Email</th>
                                        <th>Brand</th>
                                        <th>Nominal</th>
                                        <th>Rek Penerima</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
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
                                                $brand = 'SDSB ONLINE';
                                            }
                                    ?>
                                    <tr>
                                        <td><?php echo date('d F Y', strtotime($list->tperiode)); ?></td>
                        				<td><a href="<?php echo base_url('customer/detail/'.$list->cemail); ?>" target="_blank">
                                            <?php echo $list->cemail; ?></a>
                                        </td>
                                        <td><?php echo $brand; ?></td>
                                        <td>Rp. <?php echo number_format($list->tgrandtotal); ?></td>
                                        <td><?php echo $list->ttujuan.'( '.$list->rnama.' - '.$list->rbank.' )'; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery/jquery.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-select/js/bootstrap-select.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/node-waves/waves.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/tables/jquery-datatable.js"></script>
