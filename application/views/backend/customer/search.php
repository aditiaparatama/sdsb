<div class="col-sm-12">
    <div class="form-group form-float">
        <div class="form-line">
            <input type="text" name="deposit" class="form-control" value="<?php echo $deposit; ?>" readonly>
            <label class="form-label">Saldo Deposit</label>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group form-float">
        <div class="form-line">
            <input type="text" name="daribank" class="form-control" value="<?php echo $bank; ?>" readonly>
            <label class="form-label">Bank</label>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group form-float">
        <div class="form-line">
            <input type="text" name="pemilik" class="form-control" value="<?php echo $rekening; ?>" readonly>
            <label class="form-label">Pemilik Rekening</label>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group form-float">
        <div class="form-line">
            <input type="number" name="norek" class="form-control" value="<?php echo $norek; ?>" readonly>
            <label class="form-label">Nomor Rekening</label>
        </div>
    </div>
</div>

<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/basic-form-elements.js"></script>