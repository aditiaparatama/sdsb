<?php $this->load->view("dashboard/global/header.php"); ?>

<div class="page-container">
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
        <div class="col-md-12">


        <?php $this->load->view("dashboard/global/sidebar.php"); ?>
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="todo-container">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-red-sunglo">
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                        <span class="caption-subject bold uppercase"> Update Profile</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form action="<?php echo base_url('dashboard/profile_act'); ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Nama*</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder="First Name" name="nama" value="<?php echo $detail->cnama; ?>" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="email" class="col-md-3 control-label">Email*</label>
                                                        <div class="col-md-9">
                                                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $detail->cemail; ?>" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Telepon*</label>
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control" placeholder="Telepon" name="tlp" value="<?php echo $detail->ctlp; ?>" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Alamat*</label>
                                                        <div class="col-md-9">
                                                            <textarea name="alamat" class="form-control" required><?php echo $detail->calamat; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Bank*</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder="Bank" name="bank" value="<?php echo $detail->cbank; ?>" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Pemilik Rekening*</label>
                                                        <div class="col-md-9" style="margin-top:10px;">
                                                            <input type="text" class="form-control" placeholder="Pemilik Rekening" name="nmrek" value="<?php echo $detail->cnamarek; ?>" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Nomor Rekening*</label>
                                                        <div class="col-md-9" style="margin-top:10px;">
                                                            <input type="number" class="form-control" placeholder="Nomor Rekening" name="norek" value="<?php echo $detail->cnorek; ?>" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Profile Photo</label>
                                                        <div class="col-md-9">
                                                            <input type="file" class="form-control" id="photo" name="photo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12"> 
                                        <hr>
                                        Pastikan anda mengisi semua data dengan benar, karena akan berpengaruh <br>pada proses pembayaran dan penarikan deposit anda<br><br>
                                        </div>
                                        <div class="col-md-12"> 
                                            <button type="submit" name="submit" class="btn red btn-lg">Update Profile</button>
                                        </div>
                                    </div>

                                    </form>                                                                
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
        </div>
    </div>
</div>
</div>