<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
           
            <li class="nav-item  ">
                <a href="http://reg.rhinoxtriathlon.com/account" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title"><?php echo $this->session->userdata('nama'); ?></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="http://reg.rhinoxtriathlon.com/reg" class="nav-link nav-toggle">
                    <i class="fa fa-money"></i>
                    <span class="title">Rp. <?php echo number_format($this->session->userdata('deposito')); ?></span>
                </a>
            </li>
        </ul>
    </div>                
</div>