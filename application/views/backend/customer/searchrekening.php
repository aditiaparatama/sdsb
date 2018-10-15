<div class="col-sm-12">
    <div class="form-group form-float">
        <div class="form-line">
            <input type="text" name="deposit" class="form-control" value="<?php echo $deposit; ?>" readonly>
            <label class="form-label">Deposit User</label>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group form-float">
        <div class="form-line">
            <input type="text" name="dari" class="form-control" value="<?php echo $sumber; ?>" readonly>
            <label class="form-label">Sumber Dana</label>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group form-float">
        <div class="form-line">
            <input type="text" name="tujuan transfer" class="form-control" value="<?php echo $tujuan; ?>" readonly>
            <label class="form-label">Tujuan Transfer</label>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo $deposio; ?>" name="deposito"> 
<input type="hidden" value="<?php echo $userid; ?>" name="userid"> 
<input type="hidden" value="<?php echo $rekening; ?>" name="tujuan"> 

<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/basic-form-elements.js"></script>