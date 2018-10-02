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
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="caption-subject bold uppercase"> Konfirmasi Deposit </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="<?php echo base_url('deposit/konfirmasi_act'); ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="nomor" value="<?php echo $detail->nomor_deposit; ?>">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Total</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Nominal Deposit" name="deposit" value="Rp. <?php echo number_format($detail->grandtotal_deposit); ?>" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Bank</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Bank" name="bank" value="<?php echo $detail->bank_customer; ?>" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Pemilik Rekening</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Pemilik Rekening" name="nmrekening" value="<?php echo $detail->nmrekening_customer; ?>" readonly> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Nomor Rekening</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" placeholder="Nomor Rekening" name="nmrrekening" value="<?php echo $detail->nmrrekening_customer; ?>" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12" style="margin-top:15px;"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label"><b>Kode Voucher</b></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Kode Voucher" name="voucher" value="<?php echo $detail->voucher_deposit; ?>" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Upload Bukti Transfer*</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" id="photo" name="photo"  required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12"><hr></div>
                                <div class="col-md-12"> 
                                    <button type="submit" name="submit" class="btn red btn-lg">Konfirmasi</button>
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