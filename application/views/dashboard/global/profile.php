<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet ">
        <div class="profile-userpic">
            <img src="<?php echo URL_ASSETS; ?>images/dashboard/profile/<?php echo $this->session->userdata('foto'); ?>" onError="this.onerror=null;this.src='<?php echo URL_ASSETS; ?>images/dashboard/noavatar.png';" class="img-responsive"> 
        </div>

        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $$customer->nama_customer; ?></div>
            <div class="profile-usertitle-name"><?php echo $this->session->userdata('nama'); ?></div>
        </div>

        <div class="profile-usermenu">
            <ul class="nav">
                <li><a href="<?php echo base_url('dashboard/'); ?>"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                <li><a href="<?php echo base_url('deposit/deposit'); ?>"><i class="fa fa-tasks"></i> Deposit </a></li>
                <li><a href="<?php echo base_url('deposit/deposit'); ?>"><i class="fa fa-tasks"></i> Transfer Dana </a></li>
                <li><a href="<?php echo base_url('nomor/list'); ?>"><i class="fa fa-flag-checkered"></i> Nomor Kupon </a></li>
                <li><a href="<?php echo base_url('customer/profile'); ?>"><i class="fa fa-user"></i> Profile User </a></li>
                <li><a href="<?php echo base_url('auth/logoutdashboard'); ?>"><i class="fa fa-sign-out"></i> Log Out </a></li> 
            </ul>
        </div>
    </div>
</div>