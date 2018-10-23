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
                            Edit Brand
                            <small>Edit brand baru 
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

                        <form action="<?php echo base_url('brand/editbrand_act'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <select class="form-control show-tick" name="brand" required>
                                    <option value="0">PARENT</option>
                                    <?php foreach ($brands as $brand) {?>
                                        <option value="<?php echo $brand->bid; ?>" <?php if($detail->bchild==$brand->bid) echo 'selected="selected"'?>><?php echo $brand->bnama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-12" style="margin-top: 25px;">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="subbrand" class="form-control" value="<?php echo $detail->bnama; ?>" required>
                                        <label class="form-label">SubBrand</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="url" class="form-control" value="<?php echo $detail->burl; ?>">
                                        <label class="form-label">URL</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" id="photo" name="photo" class="file" accept="image/jpg, image/jpeg, image/png">
                                    </div>
                                </div>
                                <a href="<?php echo URL_ASSETS; ?>images/dashboard/profile/<?php echo $detail->bfoto; ?>" target="_blank">
                                    <?php echo $detail->bfoto; ?>
                                </a><br>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="id" value="<?php echo $detail->bid; ?>">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">UPDATE</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('brand/listsubbrand'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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