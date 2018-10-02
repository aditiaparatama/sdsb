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
                    <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="<?php echo base_url('backend/'); ?>">
                    <i class="material-icons">dashboard</i>
                    <span>Home</span>
                </a>
            </li>   
            <li>
                <a href="<?php echo base_url('nomor/listnomor'); ?>">
                    <i class="material-icons">beenhere</i>
                    <span>Nomor Kupon</span>
                </a>
            </li>   
            <li>
                <a href="<?php echo base_url('customer/listcustomer'); ?>">
                    <i class="material-icons">person</i>
                    <span>Customer</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">swap_horiz</i>
                    <span>Transaksi</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo base_url('transaksi/listpembelian'); ?>">Deposit</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('transaksi/listpemesanan'); ?>">Penambahan Deposit</a>
                    </li>
                </ul>
            </li> 
            <li>
                <a href="<?php echo base_url('transfer/listtransfer'); ?>">
                    <i class="material-icons">repeat</i>
                    <span>Transfer Dana</span>
                </a>
            </li> 
            <li>
                <a href="<?php echo base_url('pemenang/listpemenang'); ?>">
                    <i class="material-icons">notifications_active</i>
                    <span>Pemenang</span>
                </a>
            </li>   
            <li>
                <a href="<?php echo base_url('Voucher/listvoucher'); ?>">
                    <i class="material-icons">sd_card</i>
                    <span>Voucher</span>
                </a>
            </li>     
            <?php if ($this->session->userdata('role') == 1){ ?>
            <li>
                <a href="<?php echo base_url('user/listuser'); ?>">
                    <i class="material-icons">screen_lock_portrait</i>
                    <span>User Access</span>
                </a>
            </li>     
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">build</i>
                    <span>General Rules</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="<?php echo base_url('general/harga'); ?>">Harga Kupon</a>
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
                } 
                if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 3){
            ?>
            <li class="header">REPORT</li>
            <li>
                <a href="<?php echo base_url('general/penerimaan'); ?>">
                    <i class="material-icons col-amber">donut_large</i>
                    <span>Penerimaan Dana</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('general/pengeluaran'); ?>">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Pengeluaran Dana</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('general/report'); ?>">
                    <i class="material-icons col-light-blue">donut_large</i>
                    <span>Report</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</aside>