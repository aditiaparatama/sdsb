<section class="content">
    <div class="container-fluid">

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">archive</i>
                    </div>
                    <div class="content">
                        <div class="text">NOMOR KUPON</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $nomor; ?>" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">swap_horiz</i>
                    </div>
                    <div class="content">
                        <div class="text">TRANSAKSI</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $deposit; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">repeat</i>
                    </div>
                    <div class="content">
                        <div class="text">TRANSFER DANA</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $dana; ?>" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">supervisor_account</i>
                    </div>
                    <div class="content">
                        <div class="text">CUSTOMER</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $customer; ?>" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>CPU USAGE (%)</h2>
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">
                                <div class="switch panel-switch-btn">
                                    <span class="m-r-10 font-12">REAL TIME</span>
                                    <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                </div>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="real_time_chart" class="dashboard-flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-pink">
                        <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                             data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                             data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                             data-fill-Color="rgba(0, 188, 212, 0)">
                            12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                        </div>
                        <ul class="dashboard-stat-list">
                            <?php foreach($transharis as $transhari) { ?>
                            <li>
                                <?php echo date('d F Y', strtotime($transhari->date)); ?>
                                <span class="pull-right"><b><?php echo $transhari->jumlah; ?></b> <small>TOTAL KUPON</small></span>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Latest Social Trends -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-cyan">
                        <div class="m-b--35 font-bold">LIST PEMENANG PERTAMA</div>
                        <ul class="dashboard-stat-list">
                            <?php foreach($pemenanglist as $pemenang) { ?>
                            <li>
                                <?php echo date('d F Y', strtotime($pemenang->pperiode)); ?>
                                <span class="pull-right">
                                   <?php echo $pemenang->pnomor; ?>
                                </span>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Answered Tickets -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-teal">
                        <div class="font-bold m-b--35">PEMBELIAN KUPON TERBARU</div>
                        <ul class="dashboard-stat-list">
                            <?php foreach($latestkupon as $latest) { ?>
                            <li>
                                <?php echo $latest->cnama; ?>
                                <span class="pull-right"><b><?php echo $latest->jumlah; ?></b> <small>KUPON</small></span>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>TRANSAKSI</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach($deposits as $deposit) { 
                                        if($deposit->tstatus == 3){
                                            $status = '<span class="label bg-red">Pending Pembayaran</span>';
                                        }elseif($deposit->tstatus == 2){
                                            $status = '<span class="label bg-light-blue">Validasi Pembayaran</span>';
                                        }elseif($deposit->tstatus == 1){
                                            $status = '<span class="label bg-blue">Lunas</span>';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $deposit->cnama; ?></td>
                                        <td>Rp. <?php echo number_format($deposit->tgrandtotal); ?></td>
                                        <td><?php echo $status; ?></span></td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                

                <div class="card">
                    <div class="header">
                        <h2>TRANSFER DANA</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Tujuan</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach($transfers as $list) { 
                                        if($list->tstatus == 3){
                                            $status = '<span class="label bg-green">Pending Transfer</span>';
                                        }else{
                                            $status = '<span class="label bg-orange">Transfer Berhasil</span>';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $list->cnama; ?></td>
                                        <td><?php echo $list->ttujuan; ?></td>
                                        <td>Rp. <?php echo number_format($list->tgrandtotal); ?></td>
                                        <td><?php echo $status; ?></span></td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Browser Usage -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="header">
                        <h2>BROWSER USAGE</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="donut_chart" class="dashboard-donut-chart"></div>
                    </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
        </div>
    </div>
</section>

<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery/jquery.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-select/js/bootstrap-select.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/node-waves/waves.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-countto/jquery.countTo.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/raphael/raphael.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/morrisjs/morris.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/chartjs/Chart.bundle.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/flot-charts/jquery.flot.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/flot-charts/jquery.flot.resize.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/flot-charts/jquery.flot.pie.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/flot-charts/jquery.flot.categories.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/flot-charts/jquery.flot.time.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/index.js"></script>