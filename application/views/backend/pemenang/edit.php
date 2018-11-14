<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">
                            Edit Pemenang
                            <small>Daftar pemenang tanggal <?php echo date('d F Y', strtotime($this->uri->segment(3))); ?> 
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

                        <form action="<?php echo base_url('pemenang/editpemenang_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="tanggal" class="form-control" value="<?php echo date('l d F Y', strtotime($detail1->pperiode)); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="pemenang1" value="<?php echo $detail1->pnomor; ?>" class="form-control">
                                        <label class="form-label">Pemenang 1</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="pemenang2" value="<?php echo $detail2->pnomor; ?>" class="form-control">
                                        <label class="form-label">Pemenang 2</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="pemenang3" value="<?php echo $detail3->pnomor; ?>" class="form-control">
                                        <label class="form-label">Pemenang 3</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="pemenang4" value="<?php echo $detail4->pnomor; ?>" class="form-control">
                                        <label class="form-label">Pemenang 4</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="pemenang5" value="<?php echo $detail5->pnomor; ?>" class="form-control">
                                        <label class="form-label">Pemenang 5</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="pemenang6" value="<?php echo $detail6->pnomor; ?>" class="form-control">
                                        <label class="form-label">Pemenang 6</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_pemenang1" value="<?php echo $detail1->pid; ?>">
                            <input type="hidden" name="id_pemenang2" value="<?php echo $detail2->pid; ?>">
                            <input type="hidden" name="id_pemenang3" value="<?php echo $detail3->pid; ?>">
                            <input type="hidden" name="id_pemenang4" value="<?php echo $detail4->pid; ?>">
                            <input type="hidden" name="id_pemenang5" value="<?php echo $detail5->pid; ?>">
                            <input type="hidden" name="id_pemenang6" value="<?php echo $detail6->pid; ?>">
                            <div class="col-sm-12">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">UBAH</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('pemenang/listpemenang'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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