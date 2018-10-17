<section class="content">
    <div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>EDIT CUSTOMER</h2>
                </div>
                <div class="body">
                <form id="form_validation" action="<?php echo base_url('customer/editcustomer_act'); ?>" method="POST" enctype="multipart/form-data">
                <div class="col-lg-12">
                        <div class="alert alert-warning">
                            <strong>Identitas Customer</strong>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="nama" value="<?php echo $detail->cnama; ?>" required>
                                <label class="form-label">Nama Lengkap</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="pass" required>
                                <label class="form-label">Password</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="kpass" required>
                                <label class="form-label">Konfirmasi Password</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" value="<?php echo $detail->cemail; ?>" required>
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="tlp" value="<?php echo $detail->ctlp; ?>" required>
                                <label class="form-label">Telepon</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea name="alamat" cols="10" rows="3" class="form-control no-resize" required><?php echo $detail->calamat; ?>
                                </textarea>
                                <label class="form-label">Alamat</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="file" id="photo" name="photo" class="file" accept="image/jpg, image/jpeg, image/png">
                            </div>
                        </div>
                        <a href="<?php echo URL_ASSETS; ?>images/dashboard/profile/<?php echo $detail->cfoto; ?>" target="_blank"><?php echo $detail->cfoto; ?></a><br><br>
                            
                        <div class="alert alert-danger">
                            <strong>Bank Customer</strong>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="bank" value="<?php echo $detail->cbank; ?>" required>
                                <label class="form-label">Bank</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="nmrek" value="<?php echo $detail->cnamarek; ?>" required>
                                <label class="form-label">Nama Pemilik Rekening</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="norek" value="<?php echo $detail->cnorek; ?>" required>
                                <label class="form-label">Nomor Rekening</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="alert alert-info" style="margin: -20px 0px -5px 0px;">
                            <strong>Data Tambahan</strong>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="usersbo" value="<?php echo $detail->cusersbo; ?>">
                                <label class="form-label">Username SBOBET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="ibcbet" value="<?php echo $detail->cuseribc; ?>">
                                <label class="form-label">Username IBCBET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="horey4d" value="<?php echo $detail->cuserhorey; ?>">
                                <label class="form-label">Username HOREY4D</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="tangkasnet" value="<?php echo $detail->cusertangkas; ?>">
                                <label class="form-label">Username TANGKASNET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="sdsb" value="<?php echo $detail->cuser; ?>">
                                <label class="form-label">Username SDSB Online</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dsbobet" value="<?php echo number_format($detail->cdepositsbo); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                                <label class="form-label">Deposit SBOBET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dibcbet" value="<?php echo number_format($detail->cdepositibc); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                                <label class="form-label">Deposit IBCBET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dhorey4d" value="<?php echo number_format($detail->cdeposithorey); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                                <label class="form-label">Deposit HOREY4D</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dtangkas" value="<?php echo number_format($detail->cdeposittangkas); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                                <label class="form-label">Deposit TANGKASNET</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dsdsb" value="<?php echo number_format($detail->cdeposit); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                                <label class="form-label">Deposit SDSB Online</label>
                            </div>
                        </div>
                    </div>
                    
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="hidden" name="idcus" value="<?php echo $detail->cid; ?>">
                <input type="hidden" name="olddsbo" value="<?php echo $detail->cdepositsbo; ?>">
                <input type="hidden" name="olddibc" value="<?php echo $detail->cdepositibc; ?>">
                <input type="hidden" name="olddhorey" value="<?php echo $detail->cdeposithorey; ?>">
                <input type="hidden" name="olddtangkas" value="<?php echo $detail->cdeposittangkas; ?>">
                <input type="hidden" name="olddsdsb" value="<?php echo $detail->cdeposit; ?>">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg waves-effect">UBAH</button>&nbsp;&nbsp;
                <a href="<?php echo base_url('customer/listcustomer'); ?>" class="btn btn-danger btn-lg waves-effect">BATAL</a>
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
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/jquery-steps/jquery.steps.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo URL_ASSETS; ?>vendors/backend/node-waves/waves.js"></script>

<!-- Custom Js -->
<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/form-validation.js"></script>
<script>
function tandaPemisahTitik(b){
    var _minus = false;
    if (b<0) _minus = true;
    b = b.toString();
    b=b.replace(",","");
    
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--){
         j = j + 1;
         if (((j % 3) == 1) && (j != 1)){
           c = b.substr(i-1,1) + "," + c;
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
        a = ini.value.toString().replace(",","");
        b = a.replace(/[^\d]/g,"");
        b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
        ini.value = tandaPemisahTitik(b);
        return false;
        }
        else if(e.keyCode<=105){
            if(e.keyCode>=96){
                //e.keycode = e.keycode - 47;
                a = ini.value.toString().replace(",","");
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
        a = ini.value.replace(",","") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0){
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    }else if (e.keyCode==95){
        a = ini.value.replace(",","") + String.fromCharCode(e.keyCode-48);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0){
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    }else if (e.keyCode==8 || e.keycode==46){
        a = ini.value.replace(",","");
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