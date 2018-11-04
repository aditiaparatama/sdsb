<aside id="leftsidebar" class="sidebar">
    <div class="user-info">
        <div class="image">
            <img src="<?php echo URL_ASSETS; ?>images/backend/profile/<?php echo $this->session->userdata('foto'); ?>" 
            width="50" height="50" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('nama'); ?></div>
            <div class="email"><?php echo $this->session->userdata('email'); ?></div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#"><i class="material-icons">person</i>Profile</a></li>
                    <li><a href="<?php echo base_url('user/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="<?php echo base_url('backend'); ?>">
                    <i class="material-icons">dashboard</i>
                    <span>Home</span>
                </a>
            </li>   
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">swap_horiz</i>
                    <span>Transaksi</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo base_url('transaksi/listdeposit'); ?>">Deposit</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi/listkupon'); ?>">Pembelian Kupon</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi/listtransfer'); ?>">Transfer Dana</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi/listwithdraw'); ?>">Withdraw Dana</a>
                    </li>
                </ul>
            </li> 
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">repeat</i>
                    <span>Transaksi Harian</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo base_url('transaksi/listhariandebit/1'); ?>"><span>SBOBET</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi/listhariandebit/2'); ?>"><span>MAXBET</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi/listhariandebit/3'); ?>"><span>HOREY4D</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi/listhariandebit/4'); ?>"><span>TANGKASNET</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi/listhariandebit/5'); ?>"><span>SDSB Online</span></a>
                    </li>
                </ul>
            </li>  
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">supervisor_account</i>
                    <span>Customer</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo base_url('customer/listcustomer'); ?>"><span>List Customer</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('customer/listdeposit'); ?>"><span>Deposit Customer</span></a>
                    </li>
                </ul>
            </li>  
            <li>
                <a href="<?php echo base_url('pemenang/listpemenang'); ?>">
                    <i class="material-icons">filter_1</i>
                    <span>Pemenang</span>
                </a>
            </li> 
            <li>
                <a href="<?php echo base_url('nomor/listnomor'); ?>">
                    <i class="material-icons">archive</i>
                    <span>Kupon</span>
                </a>
            </li> 
            <li>
                <a href="<?php echo base_url('voucher/listvoucher'); ?>">
                    <i class="material-icons">cast_connected</i>
                    <span>Voucher</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">layers</i>
                    <span>Rekening</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo base_url('rekening/listrekening'); ?>">Rekening</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('rekening/transferrekening'); ?>">Transfer Dana</a>
                    </li>
                </ul>
            </li>    
            <li>
                <a href="<?php echo base_url('user/listuser'); ?>">
                    <i class="material-icons">touch_app</i>
                    <span>User Access</span>
                </a>
            </li> 
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">phonelink</i>
                    <span>General Rules</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo base_url('general/harga'); ?>">Harga Kupon</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('general/periode'); ?>">Periode Kupon</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('brand/listsubbrand'); ?>">List Brand</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('general/potonganpembelian'); ?>">Potongan Pembelian</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('general/pengeluaranbulanan'); ?>">Pengeluaran Bulanan</a>
                    </li>
                </ul>
            </li>  
            <?php 
                if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 3){
            ?>
            <li class="header">REPORT</li>
            <li>
                <a href="<?php echo base_url('general/reportcustomer'); ?>">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Report Customer</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('general/reportdetailcustomer'); ?>">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Report Detail Customer</span>
                </a>
            </li>
<!--            <li>
                <a href="#">
                    <i class="material-icons col-pink">donut_large</i>
                    <span>Report User</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons col-purple">donut_large</i>
                    <span>Report Nomor</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons col-deep-purple">donut_large</i>
                    <span>Report Pemenang</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons col-blue">donut_large</i>
                    <span>Report Rekening</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons col-cyan">donut_large</i>
                    <span>Report Voucher</span>
                </a>
            </li> -->
            <li>
                <a href="<?php echo base_url('general/reportpermainanharian'); ?>">
                    <i class="material-icons col-teal">donut_large</i>
                    <span>Report Permainan Harian</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('general/reportbiayaoperasional'); ?>">
                    <i class="material-icons col-green">donut_large</i>
                    <span>Report Biaya Operasional</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('general/reportrugilaba'); ?>">
                    <i class="material-icons col-amber">donut_large</i>
                    <span>Report Rugi/Laba</span>
                </a>
            </li>
<!--             <li>
                <a href="<?php echo base_url('general/penerimaan'); ?>">
                    <i class="material-icons col-amber">donut_large</i>
                    <span>Penerimaan Dana</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('general/pengeluaran'); ?>">
                    <i class="material-icons col-orange">donut_large</i>
                    <span>Pengeluaran Dana</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('general/report'); ?>">
                    <i class="material-icons col-deep-orange">donut_large</i>
                    <span>Report</span>
                </a>
            </li> -->
            <?php } ?>
        </ul>
    </div>
</aside>