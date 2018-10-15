<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet ">
        <div class="profile-userpic">
            <img src="<?php echo URL_ASSETS; ?>images/dashboard/profile/<?php echo $customer->profile_customer; ?>" onError="this.onerror=null;this.src='<?php echo URL_ASSETS; ?>images/dashboard/noavatar.png';" class="img-responsive"> 
        </div>

        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $customer->nama_customer; ?></div>
            <div style="color: #0459b7;font-size: 16px;font-weight: 600;line-height: 10px;">
                Rp. <?php echo number_format($customer->deposito_customer); ?>
            </div>
            <small style="color: #E26A6A;font-size: 13px;font-weight: 600;line-height: 50px;">
            Since: <?php echo  date('d F Y', strtotime($customer->date_customer)); ?></small>

        </div>

        <div class="profile-usermenu">
            <ul class="nav">
                <li><a href="<?php echo base_url('dashboard/'); ?>"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                <li><a href="<?php echo base_url('deposit/deposit'); ?>"><i class="fa fa-tasks"></i> Deposit </a></li>
                <li><a href="<?php echo base_url('transfer/transfer'); ?>"><i class="fa fa-retweet"></i> Transfer Dana </a></li>
                <li><a href="<?php echo base_url('nomor/list'); ?>"><i class="fa fa-ticket"></i> Nomor Kupon </a></li>
                <li><a href="<?php echo base_url('customer/profile'); ?>"><i class="fa fa-user"></i> Profile User </a></li>
                <li><a href="<?php echo base_url('auth/logoutdashboard'); ?>"><i class="fa fa-sign-out"></i> Log Out </a></li>
            </ul>
        </div>
    </div>
</div>


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
                            <form action="<?php echo base_url('customer/profile_act'); ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Nama*</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="First Name" name="nama" value="<?php echo $detail->nama_customer; ?>" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="email" class="col-md-3 control-label">Email*</label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $detail->email_customer; ?>" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Password*</label>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" placeholder="Password" name="pass" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Telepon*</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" placeholder="Telepon" name="tlp" value="<?php echo $detail->tlp_customer; ?>" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Alamat*</label>
                                                <div class="col-md-9">
                                                    <textarea name="alamat" class="form-control" required><?php echo $detail->alamat_customer; ?></textarea>
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
                                                    <input type="text" class="form-control" placeholder="Bank" name="bank" value="<?php echo $detail->bank_customer; ?>" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Pemilik Rekening*</label>
                                                <div class="col-md-9" style="margin-top:10px;">
                                                    <input type="text" class="form-control" placeholder="Pemilik Rekening" name="nmrek" value="<?php echo $detail->nmrekening_customer; ?>" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Nomor Rekening*</label>
                                                <div class="col-md-9" style="margin-top:10px;">
                                                    <input type="number" class="form-control" placeholder="Nomor Rekening" name="norek" value="<?php echo $detail->nmrrekening_customer; ?>" required> 
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