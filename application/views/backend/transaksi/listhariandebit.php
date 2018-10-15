<link href="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<style>
.theme-red .nav > li > a {
    /*color: #fff !important;*/
}
</style>

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Transaksi Harian Deposit <?php echo $brand; ?>
                            <small>List dari transaksi harian deposit <?php echo $brand; ?> 
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?php echo base_url('transaksi/addtransaksidebit/'.$idbrand); ?>">Input Deposit</a></li>
                                    <li><a href="<?php echo base_url('transaksi/addtransaksikredit/'.$idbrand); ?>">Input Withdraw</a></li>
                                    <li><a href="<?php echo base_url('transaksi/addtransaksipermainan/'.$idbrand); ?>">Input Data Permainan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active">
                                <a href="<?php echo base_url('transaksi/listhariandebit/'.$idbrand); ?>">DEPOSIT</a>
                            </li>
                            <li role="presentation">
                                <a href="<?php echo base_url('transaksi/listhariankredit/'.$idbrand); ?>">WITHDRAW</a>
                            </li>
                            <li role="presentation">
                                <a href="<?php echo base_url('transaksi/listharianpermainan/'.$idbrand); ?>">DATA PERMAINAN</a>
                            </li>
                        </ul><br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-light-blue">
                                        <th>Tanggal</th>
                                        <th>Username</th>
                                        <th>Nominal</th>
                                        <th>Rek Penerima</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                        <th>Tanggal</th>
                                        <th>Username</th>
                                        <th>Nominal</th>
                                        <th>Rek Penerima</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        foreach($lists as $list) { 
                                    ?>
                                    <tr>
                                        <td><?php echo date('d F Y', strtotime($list->tperiode)); ?></td>
                                        <td><a href="<?php echo base_url('transaksi/detailtransaksi/'.$idbrand.'/'.$list->$user); ?>">
                                            <?php echo $list->$user; ?></a>
                                        </td>
                                        <td>Rp. <?php echo number_format($list->tgrandtotal); ?></td>
                                        <td><?php echo $list->ttujuan.'( '.$list->rnama.' - '.$list->rbank.' )'; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-amber dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="material-icons">more_vert</i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo base_url('transaksi/edittransaksidebit/'.$idbrand.'/'.$list->tnomor); ?>" class=" waves-effect waves-block">Edit transaksi</a></li>
                                                    <li><a href="<?php echo base_url('transaksi/hapustransaksidebit/'.$idbrand.'/'.$list->tnomor); ?>" class=" waves-effect waves-block">Hapus</a></li>
                                                </ul>
                                            </div>
                                        </td>
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
