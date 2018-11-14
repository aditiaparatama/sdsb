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
                                    <span class="caption-subject bold uppercase"> List Nomor Kupon Customer</span>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <a class="btn sbold green" href="<?php echo base_url('dashboard/addnomor'); ?>" style="background-color: dimgrey"> BELI NOMOR KUPON
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-striped table-bordered table-hover order-column" id="">
                                    <thead>
                                        <tr>
                                            <th>Nomor Kupon</th>
                                            <th>Periode</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach($lists as $list) { 
                                        if($list->tstatus == 3){
                                            $status = 'Belum Aktif';
                                        }else if($list->tstatus == 1){
                                            $status = 'Aktif';
                                        }
                                    ?>
                                    <tr>
                                        <td><b><?php echo $list->tkupon; ?></b></td>
                                        <td><?php echo date('d F Y', strtotime($list->tperiode)); ?></td>
                                        <td><?php echo date('d F Y H:i:s', strtotime($list->tdate)); ?></td>
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


        </div>
        </div>
    </div>
</div>
</div>