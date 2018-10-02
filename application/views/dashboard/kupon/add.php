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
                                <span class="caption-subject bold uppercase"> Beli Nomor Kupon </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="<?php echo base_url('nomor/addnomor_act'); ?>" class="form-horizontal" method="post">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Deposit</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Nominal Deposit" name="deposit" value="Rp. <?php echo number_format($deposit->deposito_customer); ?>" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Harga Satuan Kupon</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="harga" value="Rp. <?php echo number_format($harga->harga_general); ?>" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Jumlah Nomor Kupon*</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" placeholder="Masukan Jumlah Kupon" name="jumlah" onkeyup="getjumlah(this.value)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="total"> 
                                            <div class="form-group">
                                                <label for="" class="col-md-3 control-label">Total Biaya*</label>
                                                <div class="col-md-9">
                                                    <input type="number" class="form-control" placeholder="Total Biaya" name="total"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12"><hr></div>
                                <div class="col-md-12"> 
                                    <button type="submit" name="submit" class="btn red btn-lg">Simpan</button>
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
<script>
function getjumlah(jumlah){
   $.ajax({
        type: "POST",
        url: "<?php echo base_url('nomor/jumlah'); ?>",
        data: "jumlah="+jumlah,
        success: function(data){
            $("#total").show();
            $("#total").html(data);
        }
    })
};
</script>