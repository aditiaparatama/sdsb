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
                        <span class="caption-subject bold uppercase"> Tambah Deposit </span>
                    </div>
                </div>
                <div class="portlet-body form">
                <form action="<?php echo base_url('dashboard/adddeposit_act'); ?>" class="form-horizontal" method="post">
                <div class="row">
                <div class="col-md-12"> 
                    <div class="row">
                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Nominal Deposit*</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Nominal Deposit" name="deposit" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required> 
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Dari Bank</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Bank" name="bank" value="<?php echo $customer->cbank; ?>" readonly> 
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Pemilik Rekening</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Pemilik Rekening" name="nmrekening" value="<?php echo $customer->cnamarek; ?>" readonly> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Nomor Rekening</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" placeholder="Nomor Rekening" name="nmrrekening" value="<?php echo $customer->cnorek; ?>" readonly> 
                            </div>
                        </div>
                        </div>

                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Bank Penerima</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="bankp" value="<?php echo $rekening->rbank; ?>" readonly> 
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">pemilik Rekening Penerima</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pemilikp" value="<?php echo $rekening->rnama; ?>" readonly> 
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Nomor Rekening Penerima</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nomorp" value="<?php echo $rekening->rno; ?>" readonly> 
                            </div>
                        </div>
                        </div>
                        
                        <div class="col-md-12" style="margin-top:15px;"> 
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"><b>Kode Voucher</b></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Kode Voucher" name="voucher"> 
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-12"><hr></div>
                    <div class="col-md-12"> 
                        <button type="submit" name="submit" class="btn red btn-lg">SIMPAN</button>
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
<script>
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