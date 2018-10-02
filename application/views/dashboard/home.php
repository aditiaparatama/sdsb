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
        <div class="col-sm-12 col-md-4">
            <a href="#" class="thumbnail">
                <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner1.png" style="height: auto; display: block;"> </a>
        </div>
        <div class="col-sm-12 col-md-4">
            <a href="#" class="thumbnail">
                <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner2.jpg" style="height: auto; display: block;"> </a>
        </div>
        <div class="col-sm-12 col-md-4">
            <a href="#" class="thumbnail">
                <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner3.jpg" style="height: auto; display: block;"> </a>
        </div>
        <div class="col-sm-12 col-md-4">
            <a href="#" class="thumbnail">
                <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner4.jpg" style="height: auto; display: block;"> </a>
        </div>
        <div class="col-sm-12 col-md-4">
            <a href="#" class="thumbnail">
                <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner5.jpg" style="height: auto; display: block;"> </a>
        </div>
        <div class="col-sm-12 col-md-4">
            <a href="#" class="thumbnail">
                <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner6.png" style="height: auto; display: block;"> </a>
        </div>
    </div>
</div>
</div>