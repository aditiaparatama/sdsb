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
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                        <span class="caption-subject bold uppercase"> Update Password</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form action="<?php echo base_url('dashboard/updatepassword_act'); ?>" class="form-horizontal" method="post">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="row">                                                
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Password*</label>
                                                        <div class="col-md-9">
                                                            <input type="password" class="form-control" placeholder="Password" name="pass" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Konfirmasi password*</label>
                                                        <div class="col-md-9">
                                                            <input type="password" class="form-control" placeholder="Konfirmasi Password" name="kpass" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <button type="submit" name="submit" class="btn red btn-lg" style="background-color: dimgrey">Update Password</button>
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