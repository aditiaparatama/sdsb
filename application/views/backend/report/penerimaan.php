<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">
                            REPORT PENERIMAAN DANA
                            <small>Silahkan pilih periode penerimaan dana
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

<!--                         <form action="<?php echo base_url('general/addreportpemasukan_act'); ?>" method="POST"> -->
                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="dari" name="dari" class="datepicker form-control" placeholder="Dari" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="sampai" name="sampai" class="datepicker form-control" placeholder="Sampai" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" name="submit" id="submit" onclick="GetCari()" class="btn btn-primary btn-lg waves-effect">CARI</button>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        </div>
                        <!-- </form> -->
                        <div id="hasilreport"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function GetCari(){
  var dari      = $('#dari').val();
  var sampai    = $('#sampai').val();
  var email     = $('#email').val();

  $.ajax({
  type: "POST",
  url: "<?php echo base_url('general/penerimaan_act'); ?>",
  data: {dari:dari,sampai:sampai,email:email}
  }).done(function( result ) {
  $("#hasilreport").html( result );       
  });
};
</script>
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