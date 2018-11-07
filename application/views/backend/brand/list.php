<link href="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            List Brand
                            <small>Daftar brand yang aktif
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2>
                        <a href="<?php echo base_url('brand/addbrand'); ?>" type="button" class="btn bg-orange waves-effect pull-right" 
                            style="color:#fff;margin-top: -4%;">
                            <i class="material-icons">add_box</i><span>Brand Baru</span>
                        </a>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-light-blue">
                                        <th>#</th>
                                        <th>Brand</th>
                                        <th>SubBrand</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                        <th>#</th>
                                        <th>Brand</th>
                                        <th>SubBrand</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        $pg = 1;
                                        foreach($lists as $list) { 
                                        if($list->bchild == 1){
                                            $child = 'SBOBET';
                                            $subchild = $list->bnama;
                                        }else if($list->bchild == 2){
                                            $child = 'MAXBET';
                                            $subchild = $list->bnama;
                                        }else if($list->bchild == 3){
                                            $child = 'HOREY4D';
                                            $subchild = $list->bnama;
                                        }else if($list->bchild == 4){
                                            $child = 'TANGKASNET';
                                            $subchild = $list->bnama;
                                        }else if($list->bchild == 5){
                                            $child = 'SDSB ONLINE';
                                            $subchild = $list->bnama;
                                        }else if($list->bid == 1){
                                            $child = 'SBOBET';
                                            $subchild = '-';
                                        }else if($list->bid == 2){
                                            $child = 'MAXBET';
                                            $subchild = '-';
                                        }else if($list->bid == 3){
                                            $child = 'HOREY4D';
                                            $subchild = '-';
                                        }else if($list->bid == 4){
                                            $child = 'TANGKASNET';
                                            $subchild = '-';
                                        }else if($list->bid == 5){
                                            $child = 'SDSB ONLINE';
                                            $subchild = '-';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $pg; ?></td>
                                        <td><?php echo $child; ?></td>
                                        <td><?php echo $subchild; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('brand/editbrand/'.$list->bid); ?>" type="button" class="btn bg-light-blue 
                                                btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Edit Brand" style="color:#fff;">
                                                <i class="material-icons">border_color</i>
                                            </a>

                                            <a href="<?php echo base_url('brand/hapusbrand/'.$list->bid); ?>" type="button" class="btn bg-red 
                                                btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" 
                                                title="Hapus"style="color:#fff;">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $pg++; } ?>
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