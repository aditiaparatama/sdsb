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
                <?php foreach ($brand as $brands) { ?>
                <div class="col-sm-12 col-md-4">
                    <a href="<?php echo $brands->burl; ?>" class="thumbnail" target="_blank">
                        <img src="<?php echo URL_ASSETS; ?>images/dashboard/brand/<?php echo $brands->bfoto; ?>" style="height: auto; display: block;"> </a>
                </div>
                <?php } ?>
                <table class="table table-striped table-bordered table-hover order-column" style="border-color: #3973ee">
                    <thead style="background: #3973ee;color: #fff;">
                        <tr>
                            <th></th>
                            <th>SBOBET</th>
                            <th>MAXBET</th>
                            <th>HOREY4D</th>    
                            <th>TANGKASNET</th>  
                            <th>SDSB Online</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $customer->cusersbo; ?></td>
                            <td><?php echo $customer->cusermax; ?></td>
                            <td><?php echo $customer->cuserhorey; ?></td>
                            <td><?php echo $customer->cusertangkas; ?></td>
                            <td><?php echo $customer->cuser; ?></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Saldo</td>
                            <td>Rp. <?php echo number_format($customer->cdepositsbo); ?></td>
                            <td>Rp. <?php echo number_format($customer->cdepositmax); ?></td>
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