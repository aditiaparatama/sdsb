<section class="content">
<div class="container-fluid">

    <div class="row">
    <div class="block-header">
        <h2>DETAIL TRANSAKSI HARIAN <?php echo strtoupper($brand); ?></h2>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-red hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">account_box</i>
                </div>
                <div class="content">
                    <div class="text">NAMA LENGKAP</div>
                    <div class="number" style="font-size: 15px;margin-top: 5px;"><?php echo $customer->cnama; ?></div>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-indigo hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">email</i>
                </div>
                <div class="content">
                    <div class="text">EMAIL</div>
                    <div class="number" style="font-size: 15px;margin-top: 5px;"><?php echo $customer->cemail; ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-teal hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="content">
                    <div class="text">USERNAME <?php echo strtoupper($brand); ?></div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;"><?php echo $customer->$user ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-brown hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">SALDO</div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;">Rp. <?php echo number_format($customer->$saldo); ?></div>
                </div>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>DEBIT</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr class="bg-light-blue">
                                    <th>Tanggal</th>
                                    <th>No Transaksi</th>
                                    <th>Rek Penerima</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($debits as $debit) {  ?>
                                <tr>
                                    <td><?php echo date('d F Y', strtotime($debit->tperiode)); ?></td>
                                    <td><?php echo $debit->tnomor; ?></td>
                                    <td><?php echo $debit->ttujuan.'( '.$debit->rnama.' - '.$debit->rbank.' )'; ?></td>
                                    <td>Rp. <?php echo number_format($debit->tgrandtotal); ?></td>
                                    <td><span class="label bg-light-blue"><?php echo $debit->tketerangan; ?></span></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>KREDIT</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr class="bg-red">
                                    <th>Tanggal</th>
                                    <th>No Transaksi</th>
                                    <th>Dari Rekening</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($kredits as $kredit) {  
                                    if(is_numeric($kredit->ttujuan)){
                                        $norek = " (Nomor Rekening)";
                                    }else{
                                        $norek = "";
                                    }
                                ?>
                                <tr>
                                    <td><?php echo date('d F Y', strtotime($kredit->tperiode)); ?></td>
                                    <td><?php echo $kredit->tnomor; ?></td>
                                    <td><?php echo $kredit->tdari.$norek; ?></td>
                                    <td class="col-red">Rp. <?php echo number_format($kredit->tgrandtotal); ?></td>
                                    <td><span class="label bg-red"><?php echo $kredit->tketerangan; ?></span></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>DATA PERMAINAN</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr class="bg-orange">
                                    <th>Tanggal</th>
                                    <th>Win/Lose</th>
                                    <th>Comm Bonus</th>
                                    <th>Referral Bonus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($permainans as $permainan) {                                      
                                    if($permainan->tbonus < 0){
                                        $class1 = 'class="col-red"';
                                    }else{
                                        $class1 = 'class="col-red"';
                                    }
                                    if($permainan->twin == 0){
                                        $class3 = 'class="col-red"';
                                        $win    = $permainan->tlose;
                                    }else{
                                        $class3 = '';
                                        $win    = $permainan->twin;
                                    }
                                    if($permainan->tlose < 0){
                                        $class4 = 'class="col-red"';
                                    }else{
                                        $class4 = 'class="col-red"';
                                    }
                                    if($permainan->tmembercomm < 0){
                                        $class5 = 'class="col-red"';
                                    }else{
                                        $class5 = 'class="col-red"';
                                    }
                                ?>
                                <tr>
                                    <td><?php echo date('d F Y', strtotime($permainan->tperiode)); ?></td>
                                    <td <?php echo $class3; ?>>
                                        <?php echo number_format($permainan->twin); ?>
                                    </td>
                                    <td <?php echo $class5; ?>>
                                        Rp. <?php echo number_format($permainan->tmembercomm); ?>
                                    </td>
                                    <td <?php echo $class1; ?>>
                                        Rp. <?php echo number_format($permainan->tbonus); ?>
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