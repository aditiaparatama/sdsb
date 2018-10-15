<div class="form-group form-float">
    <div class="form-line">
        <input type="text" name="potongan" class="form-control" value="<?php echo $potongan; ?>%" readonly>
        <label class="form-label">Potongan Pembelian</label>
    </div>
</div>

<div class="form-group form-float">
    <div class="form-line">
        <input type="text" name="biaya" class="form-control" value="Rp. <?php echo number_format($jumlah); ?>" readonly>
        <label class="form-label">Total Biaya</label>
    </div>
</div>
<input type="hidden" value="<?php echo $potongan; ?>" name="potongan"> 
<input type="hidden" value="<?php echo $jumlah; ?>" name="total"> 

<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/basic-form-elements.js"></script>