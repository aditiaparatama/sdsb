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
                        <span class="caption-subject bold uppercase"> Pesan Baru </span>
                    </div>
                </div>
                <div class="portlet-body form">
                <form action="<?php echo base_url('dashboard/addpesan_act'); ?>" class="form-horizontal" method="post">
                <div class="row">
                <div class="col-md-12"> 
                    <div class="row">
                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label class="col-md-1 control-label">Judul*</label>
                            <div class="col-md-11">
                                <input type="text" name="title" class="form-control" placeholder="Judul Pesan" required> 
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label class="col-md-1 control-label">Pesan*</label>
                            <div class="col-md-11">
                                <textarea name="pesan" class="form-control" rows="5" placeholder="Isi Pesan" required></textarea>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-12"><hr></div>
                    <div class="col-md-12"> 
                        <button type="submit" name="submit" class="btn red btn-lg">KIRIM</button>
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