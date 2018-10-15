<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">
                            Beli nomor Kupon Baru
                            <small>Tambah transaksi pembelian nomor kupon baru
                                <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a>
                            </small>
                        </h2><br>

                        <form action="<?php echo base_url('transaksi/addkupon_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="user" name="user" class="form-control" onchange="getcustomer()" required>
                                        <label class="form-label">Username SDSB</label>
                                    </div>
                                </div>
                            </div>
                            <div id="customer">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="deposit" class="form-control" required>
                                        <label class="form-label">Deposit User</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="jumlah" class="form-control" onkeyup="getjumlah(this.value)" required>
                                        <label class="form-label">Jumlah Nomor Kupon</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" id="total">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="biaya" class="form-control" required>
                                        <label class="form-label">Total Biaya</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" id="brand" value="SDSB ONLINE">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('transaksi/listdeposit'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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
        url: "<?php echo base_url('customer/caridepositcustomer'); ?>",
        data: {brand:brand,user:user},
        success: function(data){
            $("#customer").show();
            $("#customer").html(data);
        }
    })
};

function getjumlah(jumlah){
   $.ajax({
        type: "POST",
        url: "<?php echo base_url('nomor/jumlah'); ?>",
        data: "jumlah="+jumlah,
        success: function(data){
            $("#total").show();
            $("#total").html(data);
        }
    })
};
</script>