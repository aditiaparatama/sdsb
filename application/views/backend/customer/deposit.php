<link href="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            List Deposit Customer
                            <small>Daftar deposit customer yang aktif
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2>
                        <a href="<?php echo base_url('customer/addcustomer'); ?>" type="button" class="btn bg-orange waves-effect pull-right" style="color:#fff;margin-top: -4%;">
                            <i class="material-icons">add_box</i><span>Customer Baru</span>
                        </a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-light-blue">
                                        <th>Nama</th>
                                        <th>Deposit SBOBET</th>
                                        <th>Deposit MAXBET</th>
                                        <th>Deposit HOREY4D</th>
                                        <th>Deposit TANGKASNET</th>
                                        <th>Deposit SDSB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sbo=0; $max=0; $horey=0; $tangkas=0; $sdsb=0;
                                        foreach($lists as $list) { 
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo base_url('customer/detail/'.$list->cid); ?>">
                                            <?php echo $list->cnama; ?>
                                        </a></td>
                                        <td>Rp. <?php echo number_format($list->cdepositsbo); ?></td>
                                        <td>Rp. <?php echo number_format($list->cdepositmax); ?></td>
                                        <td>Rp. <?php echo number_format($list->cdeposithorey); ?></td>
                                        <td>Rp. <?php echo number_format($list->cdeposittangkas); ?></td>
                                        <td>Rp. <?php echo number_format($list->cdeposit); ?></td>
                                    </tr>
                                    <?php
                                        $sbo += $list->cdepositsbo; 
                                        $max += $list->cdepositmax; 
                                        $horey += $list->cdeposithorey; 
                                        $tangkas += $list->cdeposittangkas; 
                                        $sdsb += $list->cdeposit; 
                                        } 
                                    ?>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Rp. <?php echo number_format($sbo); ?></th>
                                        <th>Rp. <?php echo number_format($max); ?></th>
                                        <th>Rp. <?php echo number_format($horey); ?></th>
                                        <th>Rp. <?php echo number_format($tangkas); ?></th>
                                        <th>Rp. <?php echo number_format($sdsb); ?></th>
                                    </tr>
                                </tfoot>
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