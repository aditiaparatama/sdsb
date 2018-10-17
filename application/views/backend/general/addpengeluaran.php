<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<link href="<?php echo URL_ASSETS; ?>vendors/backend/multi-select/css/multi-select.css" rel="stylesheet">
<link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <h2 class="card-inside-title">
                            Tambah Pengeluaran Bulanan
                            <small>Tambah pengeluaran bulanan 
                            <a href="<?php echo DOMAIN_WEB; ?>" target="_blank"><?php echo DOMAIN_WEB; ?></a></small>
                        </h2><br>

                        <form action="<?php echo base_url('general/addpengeluaran_act'); ?>" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-12">                                        
                                <select class="form-control show-tick" name="transfer" required onchange="getsaldo(this.value)">
                                    <option value="<?php echo $transfer->rno; ?>" selected="selected">
                                        <?php echo $transfer->rno; ?> - <?php echo $transfer->rbank; ?> (<?php echo $transfer->rnama; ?>)
                                    </option>
                                    <?php
                                      foreach ($lists as $list) { 
                                    ?>
                                    <option value="<?php echo $list->rno; ?>">
                                        <?php echo $list->rno; ?> - <?php echo $list->rbank; ?> (<?php echo $list->rnama; ?>)
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-12" id="saldo">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="saldo" class="form-control" value="Rp. <?php echo number_format($transfer->rsaldo); ?>" readonly>
                                        <label class="form-label">Saldo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="pengeluaran" class="form-control" required>
                                        <label class="form-label">Pengeluaran</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="keterangan" class="form-control" required>
                                        <label class="form-label">Keterangan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="keterangan2" class="form-control">
                                        <label class="form-label">Keterangan 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="harga" class="form-control" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
                                        <label class="form-label">Harga US</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="rate" class="form-control" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
                                        <label class="form-label">Rate IDR</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="tanggal" class="datepicker form-control" placeholder="Periode" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect">SIMPAN</button>&nbsp;&nbsp;
                                <a href="<?php echo base_url('general/listpengeluaran'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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
<script src="<?php echo URL_ASSETS; ?>vendors/backend/multi-select/js/jquery.multi-select.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/node-waves/waves.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/autosize/autosize.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/momentjs/moment.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Custom Js -->
<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/basic-form-elements.js"></script>
<script>
function getsaldo(id){
   $.ajax({
        type: "POST",
        url: "<?php echo base_url('rekening/getsaldo'); ?>",
        data: "id="+id,
        success: function(data){
            $("#saldo").show();
            $("#saldo").html(data);
        }
    })
};

function tandaPemisahTitik(b){
    var _minus = false;
    if (b<0) _minus = true;
    b = b.toString();
    b=b.replace(".","");
    
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--){
         j = j + 1;
         if (((j % 3) == 1) && (j != 1)){
           c = b.substr(i-1,1) + "." + c;
         } else {
           c = b.substr(i-1,1) + c;
         }
    }
    if (_minus) c = "-" + c ;
    return c;
}

function numbersonly(ini, e){
    if (e.keyCode>=49){
        if(e.keyCode<=57){
        a = ini.value.toString().replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
        ini.value = tandaPemisahTitik(b);
        return false;
        }
        else if(e.keyCode<=105){
            if(e.keyCode>=96){
                //e.keycode = e.keycode - 47;
                a = ini.value.toString().replace(".","");
                b = a.replace(/[^\d]/g,"");
                b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
                ini.value = tandaPemisahTitik(b);
                //alert(e.keycode);
                return false;
                }
            else {return false;}
        }
        else {
            return false; }
    }else if (e.keyCode==48){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0){
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    }else if (e.keyCode==95){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0){
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    }else if (e.keyCode==8 || e.keycode==46){
        a = ini.value.replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = b.substr(0,b.length -1);
        if (tandaPemisahTitik(b)!=""){
            ini.value = tandaPemisahTitik(b);
        } else {
            ini.value = "";
        }
        
        return false;
    } else if (e.keyCode==9){
        return true;
    } else if (e.keyCode==17){
        return true;
    } else {
        //alert (e.keyCode);
        return false;
    }
}
</script>