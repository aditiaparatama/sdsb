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
                                    <span class="caption-subject bold uppercase"> List Transfer Dana</span>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <a class="btn sbold green" href="<?php echo base_url('dashboard/addtransfer'); ?>"> TRANSFER DANA BARU
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
                                            <th>Jenis</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach($lists as $list) { 
                                        if($list->tstatus == 2){
                                            $status = 'Verifikasi';
                                        }else if($list->tstatus == 1){
                                            $status = 'Berhasil';
                                        }
                                        if($list->tjenis == 2){
                                            $jenis = 'Withdraw';
                                        }else if($list->tjenis == 4){
                                            $jenis = 'Transfer Dana';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $list->tnomor; ?></td>
                                        <td><?php echo $list->tdari; ?></td>
                                        <td><?php echo $list->ttujuan; ?></td>
                                        <td>Rp. <?php echo number_format($list->tgrandtotal); ?></td>
                                        <td><?php echo $jenis; ?></td>
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

        </div>
        </div>
    </div>
</div>
</div>