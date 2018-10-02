<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<link href="<?php echo URL_ASSETS; ?>vendors/backend/multi-select/css/multi-select.css" rel="stylesheet">
<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>EDIT USER</h2>
                    </div>
                    <div class="body">

                        <form action="<?php echo base_url('user/edituser_act'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" value="<?php echo $detail->nama_user; ?>" required>
                                        <label class="form-label">Nama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="user" class="form-control" value="<?php echo $detail->username_user; ?>" required>
                                        <label class="form-label">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" name="pass" class="form-control" required>
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" name="kpass" class="form-control" required>
                                        <label class="form-label">Konfirmasi Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" name="email" class="form-control" value="<?php echo $detail->email_user; ?>" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="tlp" class="form-control" value="<?php echo $detail->tlp_user; ?>" required>
                                        <label class="form-label">Telepon</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" id="foto" name="foto" class="file" accept="image/jpg, image/jpeg, image/png">
                                    </div>
                                        <img src="<?php echo URL_ASSETS; ?>images/backend/profile/<?php echo $detail->foto_user; ?>" class="img-thumbnail" style="width: 150px;margin-top:20px;">
                                </div>
                            </div>
                            <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea cols="30" rows="3" name="alamat" class="form-control no-resize" required aria-required="true"><?php echo $detail->alamat_user ?></textarea>
                                    <label class="form-label">Alamat</label>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12">
                                <select class="form-control show-tick" name="role">
                                    <option value="2" <?php if($detail->role_user==2) echo 'selected="selected"'?>>Admin</option>
                                    <option value="2" <?php if($detail->role_user==3) echo 'selected="selected"'?>>Accounting</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" name="id_user" value="<?php echo $detail->id_user; ?>">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('user/listuser'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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