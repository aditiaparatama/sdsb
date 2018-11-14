<link href="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            List Withdraw Dana
                            <small>Daftar list withdraw dana
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2>
                        <a href="<?php echo base_url('transaksi/addwithdraw'); ?>" type="button" class="btn bg-orange waves-effect pull-right" 
                            style="color:#fff;margin-top: -4%;"><i class="material-icons">add_box</i><span>Withdraw Dana Baru</span>
                        </a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-light-blue">
                                        <th>Tanggal</th>
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
                                        <td><a href="<?php echo base_url('customer/detail/'.$list->cemail); ?>">
                                            <?php echo $list->cuser; ?>
                                        </a></td>
                                        <td style="min-width: 150px"><?php echo $list->tdari; ?></td>
                                        <td style="min-width: 150px"><?php echo $list->ttujuan; ?></td>
                                        <td style="min-width: 100px">Rp. <?php echo number_format($list->tgrandtotal); ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                        <?php 
                                            if ($this->session->userdata('role') == 1){
                                        ?>
                                        <a href="<?php echo base_url('transaksi/withdrawkonfirmasi_act/'.$list->tnomor); ?>" style="color:#fff;">
                                            <button type="button" class="btn bg-lime btn-circle waves-effect waves-circle waves-float" 
                                            data-toggle="tooltip" data-placement="top" title="Konfirmasi Withdraw" <?php echo $style;?>>
                                                <i class="material-icons">done_all</i>
                                            </button>
                                        </a>

                                        <a href="<?php echo base_url('transaksi/hapuswithdraw/'.$list->tnomor); ?>" style="color:#fff;">
                                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="material-icons">delete</i>
                                            </button>
                                        </a>
                                        <?php } ?>
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