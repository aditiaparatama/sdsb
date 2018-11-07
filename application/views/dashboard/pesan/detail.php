<?php $this->load->view("dashboard/global/header.php"); ?>
<style>
hr, p {
    margin: 10px 0;
}
blockquote .small, blockquote footer, blockquote small{
    font-size: 60% !important;
}
.blockquote{
    padding:0px 10px !important;
    border-left: 5px solid #4aa0ff !important;
}
</style>
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
                        <span class="caption-subject bold uppercase"> Detail Pesan <?php echo $pesan->ptitle; ?></span>
                    </div>
                </div>
                <div class="col-md-12" style="border-bottom: 2px solid #4aa0ff;"> 
                    <div class="row">
                        <?php 
                            foreach($lists as $list) { 
                            if($list->padmin == 1){
                                $class="<blockquote class='blockquote-reverse' >";
                                $user ="Administrator";
                            }else{
                                $class="<blockquote >";
                                $user = $customer->cnama;
                            }
                        ?>
                            <?php echo $class; ?>
                              <p><?php echo $list->ppesan; ?></p>
                              <footer><?php echo $user; ?> <cite title="Source Title"><?php echo date('d F Y H:i:s', strtotime($list->pdate)); ?></cite></footer>
                            </blockquote>
                        <?php } ?>
                    </div>
                </div>

                <div class="portlet-body form" style="padding-top: 30px !important;">
                <form action="<?php echo base_url('dashboard/balaspesan_act'); ?>" class="form-horizontal" method="post">
                <div class="row">
                <div class="col-md-12"> 
                    <div class="row">
                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label class="col-md-1 control-label">Pesan*</label>
                            <div class="col-md-11">
                                <textarea name="pesan" class="form-control" rows="5" placeholder="Isi Pesan" required></textarea>
                                <input type="hidden" name="title" value="<?php echo $pesan->ptitle; ?>">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-12"><hr></div>
                    <div class="col-md-12"> 
                        <button type="submit" name="submit" class="btn red btn-lg">BALAS</button>
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