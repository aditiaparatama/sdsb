<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner">
        <div class="nav navbar-nav pull-left">
            <a href="#">
                <img src="<?php echo URL_ASSETS; ?>images/backend/favicon.ico" alt="logo" class="logo-default" style="padding: 15px 0px 0px 25px"/> 
            </a>
        </div>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="<?php echo URL_ASSETS; ?>images/dashboard/profile/<?php echo $this->session->userdata('foto'); ?>" onError="this.onerror=null;this.src='<?php echo URL_ASSETS; ?>images/dashboard/noavatar.png';" />
                        <span class="username username-hide-on-mobile"><?php echo $this->session->userdata('nama'); ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li><a href="<?php echo base_url('dashboard/updatepassword'); ?>"><i class="fa fa-lock"></i> Update Password </a></li>
                        <li><a href="<?php echo base_url('dashboard/logout'); ?>"><i class="fa fa-sign-out"></i> Log Out </a></li>
                    </ul>
                </li>
            </ul>
        </div>                
    </div>            
</div>
<div class="clearfix"> </div>