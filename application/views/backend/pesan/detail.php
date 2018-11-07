<style>
hr, p {
    margin: 10px 0;
}
blockquote .small, blockquote footer, blockquote small{
    font-size: 70% !important;
}
blockquote {
    padding: 5px 10px;
    margin: 0 0 10px;
    font-size: 15.5px;
    border-left: 5px solid red;
}
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">
                            Detail pesan <?php echo $pesan->ptitle; ?>
                            <small>Detail pesan yang dikirimkan customer 
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

                        <div class="row clearfix" style="border-bottom: 1px solid red;">
                        <div class="col-sm-12">
                        <?php 
                            foreach($lists as $list) { 
                            if($list->padmin == 1){
                                $class="<blockquote class='blockquote-reverse' >";
                                $user ="Administrator";
                            }else{
                                $class="<blockquote >";
                                $user = $list->cuser;
                            }
                        ?>
                            <?php echo $class; ?>
                              <p><?php echo $list->ppesan; ?></p>
                              <footer><?php echo $user; ?> <cite title="Source Title"><?php echo date('d F Y H:i:s', strtotime($list->pdate)); ?></cite></footer>
                            </blockquote>
                        <?php } ?>
                        </div>
                        </div><br>

                        <form action="<?php echo base_url('pesan/balaspesan_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea cols="30" rows="3" name="pesan" class="form-control no-resize" required aria-required="true"></textarea>
                                        <label class="form-label">Balas Pesan</label>
                                        <input type="hidden" name="title" value="<?php echo $pesan->ptitle; ?>">
                                        <input type="hidden" name="iduser" value="<?php echo $pesan->cid; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('pesan/listpesan'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery/jquery.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-select/js/bootstrap-select.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/node-waves/waves.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/autosize/autosize.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/momentjs/moment.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Custom Js -->
<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/basic-form-elements.js"></script>