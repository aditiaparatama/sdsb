<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet ">
        <div class="profile-userpic">
            <img src="<?php echo URL_ASSETS; ?>images/dashboard/profile/<?php echo $lists->profile_customer; ?>" onError="this.onerror=null;this.src='<?php echo URL_ASSETS; ?>images/dashboard/noavatar.png';" class="img-responsive"> 
        </div>

        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $lists->nama_customer; ?></div>
            <div style="color: #0459b7;font-size: 16px;font-weight: 600;line-height: 10px;">
                Rp. <?php echo number_format($lists->deposito_customer); ?>
            </div>
            <small style="color: #E26A6A;font-size: 13px;font-weight: 600;line-height: 50px;">
            Since: <?php echo  date('d F Y', strtotime($lists->date_customer)); ?></small>

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
                                <span class="caption-subject bold uppercase"> Transfer Dana Baru </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="<?php echo base_url('transfer/tambahtransfer_act'); ?>" class="form-horizontal" method="post">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Nominal*</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" placeholder="Nominal Transfer" name="transfer" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Transfer Dari*</label>
                                                <div class="col-md-9">
                                                <select class="form-control" name="dari" required>
                                                    <option>- TRANSFER DARI -</option>
                                                    <option value="DEPOSIT">DEPOSIT</option>
                                                    <option value="SBOBET">SBOBET</option>
                                                    <option value="IBCBET">IBCBET</option>
                                                    <option value="HOREY4D">HOREY4D</option>
                                                    <option value="TANGKASNET">TANGKASNET</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Tujuan Transfer*</label>
                                                <div class="col-md-9">
                                                <select class="form-control" name="tujuan" required>
                                                    <option>- TUJUAN TRANSFER -</option>
                                                    <option value="REKENING PRIBADI">REKENING PRIBADI</option>
                                                    <option value="SBOBET">SBOBET</option>
                                                    <option value="IBCBET">IBCBET</option>
                                                    <option value="HOREY4D">HOREY4D</option>
                                                    <option value="TANGKASNET">TANGKASNET</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12"><hr></div>
                                <div class="col-md-12"> 
                                    <button type="submit" name="submit" class="btn red btn-lg">SIMPAN</button>
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