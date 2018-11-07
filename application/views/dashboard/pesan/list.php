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
                            <span class="caption-subject bold uppercase"> List Pesan</span>
                        </div>
                        <div class="caption font-red-sunglo pull-right">
                            <span class="caption-subject bold uppercase"> 
                                Rp. <?php echo number_format($customer->cdeposit); ?>
                            </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a class="btn sbold green" href="<?php echo base_url('dashboard/addpesan'); ?>"> PESAN BARU <i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                                <tr>
                                    <th>Pesan</th>
                                    <th>Tanggal</th>                              
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($lists as $list) { 
                            ?>
                            <tr>
                                <td><a href="<?php echo base_url('dashboard/detailpesan/'.$list->pid); ?>"><?php echo $list->ptitle; ?></a></td>
                                <td><?php echo date('d F Y', strtotime($list->pdate)); ?></td>
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