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
                            <span class="caption-subject bold uppercase"> List Transfer Dana</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a class="btn sbold green" href="<?php echo base_url('transfer/tambahtransfer'); ?>"> TRANSFER DANA BARU
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Dari</th>
                                    <th>Tujuan</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($lists as $list) { 
                                if($list->status_transfer == 3){
                                    $status = 'Pending';
                                }else if($list->status_transfer == 1){
                                    $status = 'Transfer Berhasil';
                                }
                            ?>
                            <tr>
                                <td><?php echo $list->id_transfer; ?></td>
                                <td><?php echo $list->dari_transfer; ?></td>
                                <td><?php echo $list->tujuan_transfer; ?></td>
                                <td><b>Rp. <?php echo number_format($list->nominal_transfer); ?></b></td>
                                <td><?php echo $status; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>