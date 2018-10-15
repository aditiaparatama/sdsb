<div class="form-group form-float">
    <div class="form-line">
        <input type="text" name="nama" class="form-control" value="<?php echo $customer->nama_customer; ?>" readonly>
        <input type="hidden" name="id" value="<?php echo $customer->id_customer; ?>">
    </div>
</div>

<div class="form-group form-float">
    <div class="form-line">
        <input type="text" name="saldo" class="form-control" value="Rp. <?php echo number_format($customer->deposito_customer); ?>" readonly>
        <input type="hidden" name="deposit" value="<?php echo $customer->deposito_customer; ?>">
      </div>
</div>