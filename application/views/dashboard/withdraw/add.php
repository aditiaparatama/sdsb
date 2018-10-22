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
                                        <span class="caption-subject bold uppercase"> Transfer Dana Baru </span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form action="<?php echo base_url('dashboard/addtransfer_act'); ?>" class="form-horizontal" method="post">
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Dari*</label>
                                                        <div class="col-md-9">
                                                        <select class="form-control" id="dari" name="dari" onchange="getdeposit()" required>
                                                            <option>- Pilih Deposit -</option>
                                                            <option value="SBOBET">Deposit SBOBET</option>
                                                            <option value="IBCBET">Deposit IBCBET</option>
                                                            <option value="HOREY4D">Deposit HOREY4D</option>
                                                            <option value="TANGKASNET">Deposit TANGKASNET</option>
                                                            <option value="SDSB ONLINE">Deposit SDSB Online</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="customer"></div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Tujuan*</label>
                                                        <div class="col-md-9">
                                                        <select class="form-control" name="tujuan" required>
                                                            <option>- Tujuan Transfer -</option>
                                                            <option value="SBOBET">SBOBET</option>
                                                            <option value="IBCBET">IBCBET</option>
                                                            <option value="HOREY4D">HOREY4D</option>
                                                            <option value="TANGKASNET">TANGKASNET</option>
                                                            <option value="SDSB ONLINE">SDSB Online</option>
                                                            <option value="Rekening Pribadi">Rekening Pribadi</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <label for="" class="col-md-3 control-label">Nominal*</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder="Nominal Transfer" name="transfer" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
                                                            required> 
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
function getdeposit(){
    var dari     = $('#dari').val();
   $.ajax({
        type: "POST",
        url: "<?php echo base_url('dashboard/caridepositcustomer'); ?>",
        data: {dari:dari},
        success: function(data){
            $("#customer").show();
            $("#customer").html(data);
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