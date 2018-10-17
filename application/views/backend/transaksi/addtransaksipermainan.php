<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<link href="<?php echo URL_ASSETS; ?>vendors/backend/multi-select/css/multi-select.css" rel="stylesheet">
<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">
                            Input Data Permainan <?php echo $brand; ?>
                            <small>Tambah dana permainan <?php echo $brand; ?>
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

                        <form action="<?php echo base_url('transaksi/addtransaksipermainan_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">                                        
                                <select class="form-control show-tick" name="idbrand" data-show-subtext="true" required>
                                    <option>- PILIH BRAND -</option>
                                    <?php
                                      foreach ($lists as $list) { 
                                    ?>
                                    <option value="<?php echo $list->bid; ?>" data-subtext="<?php echo $brand; ?>">
                                        <?php echo $list->bnama; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="user" class="form-control" required>
                                        <label class="form-label">Username <?php echo $brand; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" id="win" name="win" value="0" class="form-control" onchange="getwin()">
                                        <label class="form-label">Win</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" id="lose" name="lose" value="0" class="form-control" onchange="getlose()">
                                        <label class="form-label">Lose</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="commbonus" value="0" class="form-control">
                                        <label class="form-label">Comm Bonus</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="referral" value="0" class="form-control">
                                        <label class="form-label">Referral Bonus</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="tanggal" class="datepicker form-control" placeholder="Tanggal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="brand" value="<?php echo $idbrand; ?>">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('transaksi/listharianpermainan/'.$idbrand); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
                            </div>
                        </div>
                        </form>
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
<script src="<?php echo URL_ASSETS; ?>vendors/backend/multi-select/js/jquery.multi-select.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/node-waves/waves.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/autosize/autosize.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/momentjs/moment.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Custom Js -->
<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/basic-form-elements.js"></script>
<script>
function getwin(){
    $("#lose").attr('readonly', 'readonly');
};
function getlose(){
    $("#win").attr('readonly', 'readonly');
};
</script>