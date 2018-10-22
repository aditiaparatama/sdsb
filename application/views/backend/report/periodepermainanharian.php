<link href="<?php echo URL_ASSETS; ?>vendors/backend/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Transaksi Harian Permainan
                            <small>List dari transaksi data permainan 
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
                                        <th>Username</th>
                                        <th>Win/Lose</th>
                                        <th>Comm Bonus</th>
                                        <th>Referral Bonus</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                        <th>Tanggal</th>
                                        <th>Username</th>
                                        <th>Win/Lose</th>
                                        <th>Comm Bonus</th>
                                        <th>Referral Bonus</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                    	foreach($lists as $list) {                              
                                        if($list->tbonus < 0){
                                            $class1 = 'class="col-red"';
                                        }else{
                                            $class1 = 'class="col-red"';
                                        }
                                        if($list->twin < 0){
                                            $class3 = 'class="col-red"';
                                        }else{
                                            $class3 = '';
                                        }
                                        if($list->tlose < 0){
                                            $class4 = 'class="col-red"';
                                        }else{
                                            $class4 = 'class="col-red"';
                                        }
                                        if($list->tmembercomm < 0){
                                            $class5 = 'class="col-red"';
                                        }else{
                                            $class5 = 'class="col-red"';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $list->tperiode; ?></td>
                                        <td><a href="<?php echo base_url('customer/detail/'.$list->cemail); ?>">
                                            <?php echo $list->cemail; ?></a>
                                        </td>
                                        <td>
                                        	<span <?php echo $class3; ?>><?php echo $list->twin.'</span>/<span '.$class4.'>'.$list->tlose; ?></span>
                                        </td>
                                        <td <?php echo $class5; ?>>
                                        	<?php echo $list->tmembercomm; ?>
                                        </td>
                                        <td <?php echo $class1; ?>>
                                            <?php echo $list->tbonus; ?>
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
