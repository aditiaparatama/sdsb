<section class="content">
<div class="container-fluid">

    <div class="row">
    <div class="block-header">
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header" style="height: 450px;">
                <h2>DETAIL CUSTOMER <?php echo strtoupper($detail->cnama); ?></h2>
                <div class="body">
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Nama</strong></li>
                          <li style="margin-left: 68px;">: <?php echo $detail->cnama; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Username SBOBET</strong></li>
                          <li style="margin-left: 36px;">: <?php echo $detail->cusersbo; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Email</strong></li>
                          <li style="margin-left: 70px;">: <?php echo $detail->cemail; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Username IBCBET</strong></li>
                          <li style="margin-left: 42px;">: <?php echo $detail->cuseribc; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Telepon</strong></li>
                          <li style="margin-left: 55px;">: <?php echo $detail->ctlp; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Username HOREY4D</strong></li>
                          <li style="margin-left: 28px;">: <?php echo $detail->cuserhorey; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Bank</strong></li>
                          <li style="margin-left: 75px;">: <?php echo $detail->cbank; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Username TANGKASNET</strong></li>
                          <li>: <?php echo $detail->cusertangkas; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Nama Rekening</strong></li>
                          <li style="margin-left: 7px;">: <?php echo $detail->cnamarek; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline">
                          <li><strong>Username SDSB</strong></li>
                          <li style="margin-left: 56px;">: <?php echo $detail->cuser; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <ul class="list-inline">
                          <li><strong>Nomor Rekening</strong></li>
                          <li>: <?php echo $detail->cnorek; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <ul class="list-inline">
                          <li><strong>Alamat</strong></li>
                          <li style="margin-left: 60px;">: <?php echo $detail->calamat; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-pink hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">DEPOSIT SBOBET</div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;">Rp. <?php echo number_format($detail->cdepositsbo); ?></div>
                </div>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-blue hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">DEPOSIT IBCBET</div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;">Rp. <?php echo number_format($detail->cdepositibc); ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-green hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">DEPOSIT HOREY4D</div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;">Rp. <?php echo number_format($detail->cdeposithorey); ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-lime hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">DEPOSIT TANGKASNET</div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;">Rp. <?php echo number_format($detail->cdeposittangkas); ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-deep-orange hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">DEPOSIT SDSB</div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;">Rp. <?php echo number_format($detail->cdeposit); ?></div>
                </div>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2><p class="col-default">DEPOSIT</p></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Transaksi</th>
                                    <th style="min-width: 120px;">Brand</th>
                                    <th style="min-width: 120px;">Nominal</th>
                                    <th>Keterangan</th>
                                    <th style="min-width: 130px;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($deposit as $data) { 
                                ?>
                                <tr>
                                    <td><?php echo $data->tnomor; ?></td>
                                    <td><?php echo $data->bnama; ?></td>
                                    <td>Rp. <?php echo number_format($data->tgrandtotal); ?></td>
                                    <td><span class="label bg-blue-grey"><?php echo $data->tketerangan; ?></span></td>
                                    <td><?php echo date('d F Y', strtotime($data->tperiode)); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2><p class="col-red">WITHDRAW</p></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Transaksi</th>
                                    <th style="min-width: 120px;">Brand</th>
                                    <th style="min-width: 120px;">Nominal</th>
                                    <th>Keterangan</th>
                                    <th style="min-width: 130px;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($withdraw as $row) { 
                                ?>
                                    <tr>
                                        <td><?php echo $row->tnomor; ?></td>
                                        <td><?php echo $row->bnama; ?></td>
                                        <td class="col-red">Rp. <?php echo number_format($row->tgrandtotal); ?></td>
                                        <td><span class="label bg-red"><?php echo $row->tketerangan; ?></span></td>
                                        <td><?php echo date('d F Y', strtotime($row->tperiode)); ?></td>
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