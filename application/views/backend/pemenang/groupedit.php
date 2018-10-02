<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">
                            Edit Group Pemenang
                            <small>Edit pemenang <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>
                        <form action="<?php echo base_url('pemenang/editgrouppemenang_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="pemenang" value="<?php echo $detail->nomor_pemenang; ?>" class="form-control">
                                        <label class="form-label">Pemenang</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_pemenang" value="<?php echo $detail->id_pemenang; ?>">

                            <div class="col-sm-12">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('pemenang/listpemenang'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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