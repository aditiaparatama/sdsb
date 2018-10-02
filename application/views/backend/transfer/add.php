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
                            Transfer Dana Baru
                            <small>Transfer Dana Customer 
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

                        <form action="<?php echo base_url('transfer/addtransfer_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" name="email" class="form-control" onkeyup="getcustomer(this.value)" required>
                                        <label class="form-label">Email Customer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12" id="customer">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" required>
                                        <label class="form-label">Nama Customer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <select class="form-control show-tick" name="dari" required>
                                    <option>- TRANSFER DARI -</option>
                                    <option value="DEPOSIT">DEPOSIT</option>
                                    <option value="SBOBET">SBOBET</option>
                                    <option value="IBCBET">IBCBET</option>
                                    <option value="HOREY4D">HOREY4D</option>
                                    <option value="TANGKASNET">TANGKASNET</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <select class="form-control show-tick" name="tujuan" required>
                                    <option>- TUJUAN TRANSFER -</option>
                                    <option value="REKENING PRIBADI">REKENING PRIBADI</option>
                                    <option value="SBOBET">SBOBET</option>
                                    <option value="IBCBET">IBCBET</option>
                                    <option value="HOREY4D">HOREY4D</option>
                                    <option value="TANGKASNET">TANGKASNET</option>
                                </select>
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
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('transfer/listtransfer'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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
function getcustomer(email){
   $.ajax({
        type: "POST",
        url: "<?php echo base_url('transfer/searchtransfer'); ?>",
        data: "email="+email,
        success: function(data){
            $("#customer").show();
            $("#customer").html(data);
        }
    })
};
</script>