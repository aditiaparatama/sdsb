<div class="form-group form-float">
    <div class="form-line">
        <input type="text" name="saldo" class="form-control" value="Rp. <?php echo number_format($saldo->rsaldo); ?>" readonly>
        <label class="form-label">Saldo Rekening</label>
    </div>
</div>

<script src="<?php echo URL_ASSETS; ?>js/backend/admin.js"></script>
<script src="<?php echo URL_ASSETS; ?>js/backend/pages/forms/basic-form-elements.js"></script>