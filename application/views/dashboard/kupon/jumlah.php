<div class="form-group">
    <label for="" class="col-md-3 control-label">Potongan Pembelian</label>
    <div class="col-md-9">
        <input type="text" class="form-control" placeholder="Potongan Pembelian" value="<?php echo $potongan; ?>%" name="potong" readonly> 
    </div>
</div>

<div class="form-group">
    <label for="" class="col-md-3 control-label">Total Biaya</label>
    <div class="col-md-9">
        <input type="text" class="form-control" placeholder="Total Biaya" value="Rp. <?php echo number_format($jumlah); ?>" name="tot" readonly> 
    </div>
</div>

<input type="hidden" value="<?php echo $potongan; ?>" name="potongan"> 
<input type="hidden" value="<?php echo $jumlah; ?>" name="total"> 