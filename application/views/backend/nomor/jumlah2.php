<div class="form-group">
    <label for="" class="col-md-3 control-label">Potongan Pembelian</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="potongan" value="<?php echo $potongan; ?>%" readonly>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-md-3 control-label">Total Biaya</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="biaya" value="Rp. <?php echo number_format($jumlah); ?>" readonly>
    </div>
</div>

<input type="hidden" value="<?php echo $potongan; ?>" name="potongan"> 
<input type="hidden" value="<?php echo $jumlah; ?>" name="total"> 
