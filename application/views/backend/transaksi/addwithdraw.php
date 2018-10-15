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
                            Input Withdraw Baru
                            <small>Tambah Withdraw baru
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2><br>

                        <form action="<?php echo base_url('transaksi/addwithdraw_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <select class="form-control show-tick" id="brand" name="brand" onchange="getcustomer()" required>
                                    <option>- PILIH SUMBER DANA DEPOSIT -</option>
                                    <?php foreach ($brands as $brand) {?>
                                        <option value="<?php echo $brand->bnama; ?>"><?php echo $brand->bnama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="user" name="user" class="form-control" onkeyup="getcustomer()" required>
                                        <label class="form-label">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div id="customer">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="deposit" class="form-control" readonly>
                                        <label class="form-label">Deposit User</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="dari" class="form-control" readonly>
                                        <label class="form-label">Sumber Dana</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="tujuan" class="form-control" readonly>
                                        <label class="form-label">Tujuan Transfer</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="nominal" class="form-control" required>
                                        <label class="form-label">Nominal Transfer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">                                     
                                <select class="form-control show-tick" name="rekening" required>
                                    <option value="<?php echo $transfer->rno; ?>" selected="selected">
                                        <?php echo $transfer->rno; ?> - <?php echo $transfer->rbank; ?> (<?php echo $transfer->rnama; ?>)
                                    </option>
                                    <?php
                                      foreach ($lists as $list) { 
                                    ?>
                                    <option value="<?php echo $list->rno; ?>">
                                        <?php echo $list->rno; ?> - <?php echo $list->rbank; ?> (<?php echo $list->rnama; ?>)
                                    </option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="col-sm-12">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('transaksi/listtransfer'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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
function getcustomer(){
    var brand     = $('#brand').val();
    var user      = $('#user').val();
   $.ajax({
        type: "POST",
        url: "<?php echo base_url('customer/carirekeningcustomer'); ?>",
        data: {brand:brand,user:user},
        success: function(data){
            $("#customer").show();
            $("#customer").html(data);
        }
    })
};
</script>