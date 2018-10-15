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
                            Edit Transfer Dana
                            <small>Edit transaksi transfer dana
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

                        <form action="<?php echo base_url('transaksi/edittransfer_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <select class="form-control show-tick" id="brand" name="brand" readonly>
                                        <option value="<?php echo $detail->bnama; ?>" selected="selected">DEPOSIT <?php echo $detail->bnama; ?></option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="user" name="user" class="form-control" value="<?php echo $detail->cuser; ?>" readonly>
                                        <label class="form-label">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div id="customer">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="deposit" class="form-control" value="Rp. <?php echo number_format($detail->cdeposit); ?>" readonly>
                                        <label class="form-label">Deposit User</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="dari" class="form-control" value="<?php echo $detail->tdari; ?>" readonly>
                                        <label class="form-label">Sumber Dana</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="nominal" class="form-control" value="<?php echo $detail->tgrandtotal; ?>" required>
                                        <label class="form-label">Nominal Transfer</label>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-12" style="margin: -10px 0px 30px 0px;">                                        
                            	<select class="form-control show-tick" name="dari" required>
	                                <?php
	                                  foreach ($lists as $list) { 
	                                ?>
                                    <option value="<?php echo $list->rno; ?>" <?php if($detail->tdari==$list->rno) echo 'selected="selected"'?>>
                                    	<?php echo $list->rno; ?> - <?php echo $list->rbank; ?> (<?php echo $list->rnama; ?>)
                                    </option>
	                                <?php } ?>
	                            </select>
                            </div> -->
                            <div class="col-sm-12">
                                <select class="form-control show-tick" name="tujuan" required>
                                    <option>- TUJUAN TRANSFER -</option>
                                    <?php foreach ($brands as $brand) {?>
                                        <option value="<?php echo $brand->bnama; ?>" <?php if($detail->ttujuan==$brand->bnama) echo 'selected="selected"'?> > <?php echo $brand->bnama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="cid" value="<?php echo $detail->cid; ?>">
                                <input type="hidden" name="nomor" value="<?php echo $detail->tnomor; ?>">
                                <input type="hidden" name="oldnominal" value="<?php echo $detail->tgrandtotal; ?>">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">UPDATE</button>&nbsp;&nbsp;
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