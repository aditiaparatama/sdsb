<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<link href="<?php echo URL_ASSETS; ?>vendors/backend/multi-select/css/multi-select.css" rel="stylesheet">
<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit Rekening</h2>
                    </div>
                    <div class="body">
                        <form action="<?php echo base_url('rekening/editrekening_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="bank" class="form-control" value="<?php echo $detail->rbank; ?>" required>
                                        <label class="form-label">Bank</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" value="<?php echo $detail->rnama; ?>" required>
                                        <label class="form-label">Atas Nama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="no" class="form-control" value="<?php echo $detail->rno; ?>" required>
                                        <label class="form-label">Nomor Rekening</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="saldo" class="form-control" value="<?php echo $detail->rsaldo; ?>" required>
                                        <label class="form-label">Saldo Rekening</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <select class="form-control show-tick" name="jenis">
                                    <option value="0" <?php if($detail->rjenis==0) echo 'selected="selected"'?>>- ATUR REKENING SEBAGAI -</option>
                                    <option value="1" <?php if($detail->rjenis==1) echo 'selected="selected"'?>>Penerima</option>
                                    <option value="2" <?php if($detail->rjenis==2) echo 'selected="selected"'?>>Pentransfer</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="id" value="<?php echo $detail->rid; ?>">
                                <input type="hidden" name="oldno" value="<?php echo $detail->rno; ?>">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
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