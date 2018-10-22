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
                <div class="col-sm-12 col-md-4">
                    <a href="#" class="thumbnail">
                        <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner1.png" style="height: auto; display: block;"> </a>
                </div>
                <div class="col-sm-12 col-md-4">
                    <a href="#" class="thumbnail">
                        <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner2.jpg" style="height: auto; display: block;"> </a>
                </div>
                <div class="col-sm-12 col-md-4">
                    <a href="#" class="thumbnail">
                        <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner3.jpg" style="height: auto; display: block;"> </a>
                </div>
                <div class="col-sm-12 col-md-4">
                    <a href="#" class="thumbnail">
                        <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner4.jpg" style="height: auto; display: block;"> </a>
                </div>
                <div class="col-sm-12 col-md-4">
                    <a href="#" class="thumbnail">
                        <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner5.jpg" style="height: auto; display: block;"> </a>
                </div>
                <div class="col-sm-12 col-md-4">
                    <a href="#" class="thumbnail">
                        <img src="<?php echo URL_ASSETS; ?>images/dashboard/banner6.png" style="height: auto; display: block;"> </a>
                </div>
                <table class="table table-striped table-bordered table-hover order-column">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SBOBET</th>
                            <th>IBCBET</th>
                            <th>HOREY4D</th>    
                            <th>TANGKASNET</th>  
                            <th>SDSB Online</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="background: #3687e0;color: #fff;">Username</td>
                            <td><?php echo $customer->cusersbo; ?></td>
                            <td><?php echo $customer->cuseribc; ?></td>
                            <td><?php echo $customer->cuserhorey; ?></td>
                            <td><?php echo $customer->cusertangkas; ?></td>
                            <td><?php echo $customer->cuser; ?></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td style="background: #3687e0;color: #fff;">Saldo</td>
                            <td>Rp. <?php echo number_format($customer->cdepositsbo); ?></td>
                            <td>Rp. <?php echo number_format($customer->cdepositibc); ?></td>
                            <td>Rp. <?php echo number_format($customer->cdeposithorey); ?></td>
                            <td>Rp. <?php echo number_format($customer->cdeposittangkas); ?></td>
                            <td>Rp. <?php echo number_format($customer->cdeposit); ?></td>
                        </tr>
                    </tbody>
                </table>
        </div>
        </div>          


    </div>
    </div>
    </div>
</div>
</div>