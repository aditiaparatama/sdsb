<link href="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            List Customer
                            <small>Daftar customer yang aktif
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2>
                        <a href="<?php echo base_url('customer/addcustomer'); ?>" type="button" class="btn bg-orange waves-effect pull-right" 
                            style="color:#fff;margin-top: -4%;">
                            <i class="material-icons">add_box</i><span>Customer Baru</span>
                        </a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-light-blue">
                                        <th>Nama</th>
                                        <th>User SBOBET</th>
                                        <th>User MAXBET</th>
                                        <th>User HOREY4D</th>
                                        <th>User TANGKASNET</th>
                                        <th>User SDSB</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                        <th>Nama</th>
                                        <th>User SBOBET</th>
                                        <th>User MAXBET</th>
                                        <th>User HOREY4D</th>
                                        <th>User TANGKASNET</th>
                                        <th>User SDSB</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach($lists as $list) { ?>
                                    <tr>
                                        <td><a href="<?php echo base_url('customer/detail/'.$list->cid); ?>">
                                            <?php echo $list->cnama; ?>
                                        </a></td>
                                        <td><?php echo $list->cusersbo; ?></td>
                                        <td><?php echo $list->cusermax; ?></td>
                                        <td><?php echo $list->cuserhorey; ?></td>
                                        <td><?php echo $list->cusertangkas; ?></td>
                                        <td><?php echo $list->cuser; ?></td>
                                        <td>
                                        <?php 
                                            if ($this->session->userdata('role') == 1){
                                        ?>
                                        <a href="<?php echo base_url('customer/editcustomer/'.$list->cid); ?>" type="button" class="btn bg-light-blue 
                                            btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Edit Customer" style="color:#fff;">
                                            <i class="material-icons">border_color</i>
                                        </a>

                                        <a href="<?php echo base_url('customer/hapuscustomer/'.$list->cid); ?>" type="button" class="btn bg-red 
                                            btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Hapus"style="color:#fff;">
                                            <i class="material-icons">delete</i>
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