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
                            Transfer Dana
                            <small>Transfer dana antar rekening
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

                        <form action="<?php echo base_url('rekening/addtransfer_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="transfer" required onchange="getsaldo(this.value)">
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
                                </div>
                            </div>
                            <div class="col-sm-12" id="saldo">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="saldo" class="form-control" value="Rp. <?php echo number_format($transfer->rsaldo); ?>" readonly>
                                        <label class="form-label">Saldo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="penerima" required>
                                            <option value="" selected="selected">
                                                - REKENING PENERIMA -
                                            </option>
                                            <?php
                                              foreach ($penerima as $terima) { 
                                            ?>
                                            <option value="<?php echo $terima->rno; ?>">
                                                <?php echo $terima->rno; ?> - <?php echo $terima->rbank; ?> (<?php echo $terima->rnama; ?>)
                                            </option>
                                            <?php } ?>
                                        </select>
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
                                <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">TRANSFER</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('rekening/listrekening'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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
function getsaldo(id){
   $.ajax({
        type: "POST",
        url: "<?php echo base_url('rekening/getsaldo'); ?>",
        data: "id="+id,
        success: function(data){
            $("#saldo").show();
            $("#saldo").html(data);
        }
    })
};
</script>