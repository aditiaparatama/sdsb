<section class="content">
<div class="container-fluid">

    <div class="row">
    <div class="block-header">
        <h2>DETAIL REKENING <?php echo $detail->rno; ?></h2>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-pink hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">credit_card</i>
                </div>
                <div class="content">
                    <div class="text">REKENING</div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;"><?php echo $detail->rno; ?></div>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-blue hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">record_voice_over</i>
                </div>
                <div class="content">
                    <div class="text">ATAS NAMA</div>
                    <div class="number" style="font-size: 18px;margin-top: 5px;"><?php echo $detail->rnama; ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-green hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">account_balance</i>
                </div>
                <div class="content">
                    <div class="text">BANK</div>
                    <div class="number" style="font-size: 18px;margin-top: 5px;"><?php echo $detail->rbank; ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box-3 bg-lime hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text">SALDO</div>
                    <div class="number" style="font-size: 20px;margin-top: 4px;">Rp. <?php echo number_format($detail->rsaldo); ?></div>
                </div>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>PEMASUKAN</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr class="bg-light-blue">
                                    <th>Transaksi</th>
                                    <th style="min-width: 120px;">Sumber Dana</th>
                                    <th style="min-width: 120px;">Nominal</th>
                                    <th>Keterangan</th>
                                    <th style="min-width: 200px;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($penerimaan as $terima) { 
                                ?>
                                <tr>
                                    <td><?php echo $terima->tnomor; ?></td>
                                    <td><?php echo $terima->tdari; ?></td>
                                    <td>Rp. <?php echo number_format($terima->tgrandtotal); ?></td>
                                    <td><span class="label bg-blue-grey"><?php echo $terima->tketerangan; ?></span></td>
                                    <td><?php echo date('d F Y H:i:s', strtotime($terima->tdate)); ?></td>
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
                    <h2>PENGELUARAN</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr class="bg-red">
                                    <th>Transaksi</th>
                                    <th style="min-width: 180px;">Tujuan Transfer</th>
                                    <th style="min-width: 120px;">Nominal</th>
                                    <th>Keterangan</th>
                                    <th style="min-width: 200px;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($pengeluaran as $luaran) { 
                                ?>
                                    <tr>
                                        <td><?php echo $luaran->tnomor; ?></td>
                                        <td><?php echo $luaran->ttujuan; ?></td>
                                        <td>Rp. <?php echo number_format($luaran->tgrandtotal); ?></td>
                                        <td><span class="label bg-orange"><?php echo $luaran->tketerangan; ?></span></td>
                                        <td><?php echo date('d F Y H:i:s', strtotime($luaran->tdate)); ?></td>
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