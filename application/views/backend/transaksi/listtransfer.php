<link href="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            List Transfer Dana
                            <small>Daftar list transfer dana
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?php echo base_url('transaksi/addtransfer'); ?>">Transfer Dana Baru</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-light-blue">
                                        <th>Tanggal</th>
                                        <th>Transaksi</th>
                                        <th>Username</th>
                                        <th>Sumber Dana</th>
                                        <th>Tujuan Transfer</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                        <th>Tanggal</th>
                                        <th>Transaksi</th>
                                        <th>Username</th>
                                        <th>Sumber Dana</th>
                                        <th>Tujuan Transfer</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        foreach($lists as $list) { 
                                        if($list->tstatus == 1){
                                            $status = 'Selesai';
                                            $style  = "style='display:none'"; 
                                        }else{
                                        	$status = 'Pending';
                                            $style  = ""; 
                                        }
                                    ?>
                                    <tr>
                                        <td style="min-width: 180px"><?php echo date('d F Y H:i:s', strtotime($list->tdate)); ?></td>
                                        <td><?php echo $list->tnomor; ?></td>
                                        <td><a href="<?php echo base_url('customer/detail/'.$list->cemail); ?>">
                                            <?php echo $list->cuser; ?>
                                        </a></td>
                                        <td style="min-width: 180px"><?php echo $list->tdari; ?></td>
                                        <td style="min-width: 140px"><?php echo $list->ttujuan; ?></td>
                                        <td style="min-width: 100px">Rp. <?php echo number_format($list->tgrandtotal); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-amber dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="material-icons">more_vert</i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li <?php echo $style;?>><a href="<?php echo base_url('transaksi/transferkonfirmasi_act/'.$list->tnomor); ?>" class=" waves-effect waves-block">Konfirmasi Transfer Dana</a></li>
                                                    <li><a href="<?php echo base_url('transaksi/edittransfer/'.$list->tnomor); ?>" class=" waves-effect waves-block">Edit Transfer Dana</a></li>
                                                    <li><a href="<?php echo base_url('transaksi/hapustransfer/'.$list->tnomor); ?>" class=" waves-effect waves-block">Hapus</a></li>
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