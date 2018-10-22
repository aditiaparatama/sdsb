<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet ">
        <div class="profile-userpic">
            <img src="<?php echo URL_ASSETS; ?>images/dashboard/profile/<?php echo $customer->cfoto; ?>" onError="this.onerror=null;this.src='<?php echo URL_ASSETS; ?>images/dashboard/noavatar.png';" class="img-responsive"> 
        </div>

        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $customer->cnama; ?></div>
            <div style="color: #0459b7;font-size: 16px;font-weight: 600;line-height: 10px;">
                Rp. <?php echo number_format($customer->cdeposit); ?>
            </div>
            <small style="color: #E26A6A;font-size: 13px;font-weight: 600;line-height: 50px;">
            Since: <?php echo  date('d F Y', strtotime($customer->cdate)); ?></small>

        </div>

        <div class="profile-usermenu">
            <ul class="nav">
                <li><a href="<?php echo base_url('dashboard/'); ?>"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                <li><a href="<?php echo base_url('dashboard/deposit'); ?>"><i class="fa fa-tasks"></i> Deposit </a></li>
                <li><a href="<?php echo base_url('dashboard/withdraw'); ?>"><i class="fa fa-retweet"></i> Withdraw / Transfer Dana</a></li>
                <li><a href="<?php echo base_url('dashboard/list'); ?>"><i class="fa fa-ticket"></i> Nomor Kupon </a></li>
                <li><a href="<?php echo base_url('dashboard/profile'); ?>"><i class="fa fa-user"></i> Profile User </a></li>
                <li><a href="<?php echo base_url('dashboard/logout'); ?>"><i class="fa fa-sign-out"></i> Log Out </a></li> 
            </ul>
        </div>
    </div>
</div>