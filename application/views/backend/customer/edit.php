<section class="content">
    <div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>DETAIL CUSTOMER</h2>
                </div>
                <div class="body">
                <form id="form_validation" action="<?php echo base_url('customer/editcustomer_act'); ?>" method="POST">
                <div class="col-lg-12">
                        <div class="alert alert-warning">
                            <strong>Identitas Customer</strong>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="nama" value="<?php echo $detail->nama_customer; ?>" required>
                                <label class="form-label">Nama</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="username" value="<?php echo $detail->username_customer; ?>" required>
                                <label class="form-label">Username</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="pass" required>
                                <label class="form-label">Password</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" value="<?php echo $detail->email_customer; ?>" required>
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="tlp" value="<?php echo $detail->tlp_customer; ?>" required>
                                <label class="form-label">Telepon</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea name="alamat" cols="10" rows="3" class="form-control no-resize" required><?php echo $detail->alamat_customer; ?>
                                </textarea>
                                <label class="form-label">Alamat</label>
                            </div>
                        </div>
                        <div class="alert alert-danger">
                            <strong>Bank Customer</strong>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="bank" value="<?php echo $detail->bank_customer; ?>" required>
                                <label class="form-label">Bank</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="nmrek" value="<?php echo $detail->nmrekening_customer; ?>" required>
                                <label class="form-label">Nama Pemilik Rekening</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="norek" value="<?php echo $detail->nmrrekening_customer; ?>" required>
                                <label class="form-label">Nomor Rekening</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="alert alert-info" style="margin: -20px 0px -5px 0px;">
                            <strong>Data Tambahan</strong>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="usersbo" value="<?php echo $detail->usersbobet_customer; ?>" required>
                                <label class="form-label">Username SBOBET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="ibcbet" value="<?php echo $detail->useribcbet_customer; ?>" required>
                                <label class="form-label">Username IBCBET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="horey4d" value="<?php echo $detail->userhoreybet_customer; ?>" required>
                                <label class="form-label">Username HOREY4D</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="tangkasnet" value="<?php echo $detail->usertangkasbet_customer; ?>" required>
                                <label class="form-label">Username TANGKASNET</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dsbobet" value="<?php echo $detail->depositsbobet_customer; ?>" required>
                                <label class="form-label">Deposit SBOBET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dibcbet" value="<?php echo $detail->depositibcbet_customer; ?>" required>
                                <label class="form-label">Deposit IBCBET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dhorey4d" value="<?php echo $detail->deposithoreybet_customer; ?>" required>
                                <label class="form-label">Deposit HOREY4D</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dtangkas" value="<?php echo $detail->deposittangkasbet_customer   ; ?>" required>
                                <label class="form-label">Deposit TANGKASNET</label>
                            </div>
                        </div>
                    </div>
                    
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="hidden" name="id_customer" value="<?php echo $detail->id_customer; ?>">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                <a href="<?php echo base_url('customer/listcustomer'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-steps/jquery.steps.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/node-waves/waves.js"></script>

<!-- Custom Js -->
<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/form-validation.js"></script>