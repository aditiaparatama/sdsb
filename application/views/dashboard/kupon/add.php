<?php $this->load->view("dashboard/global/header.php"); ?>

<div class="page-container">
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
        <div class="col-md-12">


        <?php $this->load->view("dashboard/global/sidebar.php"); ?>
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
                                    <form action="<?php echo base_url('dashboard/addnomor_act'); ?>" class="form-horizontal" method="post">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Deposit</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder="Nominal Deposit" name="deposit" value="Rp. <?php echo number_format($deposit->cdeposit); ?>" readonly> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Harga Satuan Kupon</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="harga" value="Rp. <?php echo number_format($harga->gharga); ?>" readonly> 
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


        </div>
        </div>
    </div>
</div>
</div>
<script>
function getjumlah(jumlah){
   $.ajax({
        type: "POST",
        url: "<?php echo base_url('nomor/jumlah2'); ?>",
        data: "jumlah="+jumlah,
        success: function(data){
            $("#total").show();
            $("#total").html(data);
        }
    })
};
</script>