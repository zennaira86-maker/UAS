<div style="max-width:600px">
<div class="page-title"><?= isset($kamar) ? 'Edit Kamar' : 'Tambah Kamar' ?></div>
<div class="page-sub"><?= isset($kamar) ? 'Perbarui data kamar' : 'Tambah unit kamar baru' ?></div>

<div class="card">
<?php
$action = isset($kamar) ? base_url('admin/kamar/update/'.$kamar->id_kamar) : base_url('admin/kamar/simpan');
echo form_open($action);
?>
  <div class="form-row">
    <div class="form-group">
      <label class="form-label">Nomor Kamar <span style="color:red">*</span></label>
      <input type="text" name="nomor_kamar" class="form-control" value="<?= $kamar->nomor_kamar ?? '' ?>" placeholder="Contoh: A01" required>
    </div>
    <div class="form-group">
      <label class="form-label">Tipe Kamar <span style="color:red">*</span></label>
      <select name="tipe" class="form-control" required>
        <option value="">-- Pilih Tipe --</option>
        <?php foreach (['Standard','Deluxe','Premium'] as $t): ?>
        <option value="<?= $t ?>" <?= (isset($kamar) && $kamar->tipe === $t) ? 'selected' : '' ?>><?= $t ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label class="form-label">Harga Sewa/Bulan <span style="color:red">*</span></label>
      <input type="number" name="harga" class="form-control" value="<?= $kamar->harga ?? '' ?>" placeholder="500000" required>
    </div>
    <div class="form-group">
      <label class="form-label">Status</label>
      <select name="status" class="form-control">
        <?php foreach (['Kosong','Terisi'] as $s): ?>
        <option value="<?= $s ?>" <?= (isset($kamar) && $kamar->status === $s) ? 'selected' : '' ?>><?= $s ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="form-label">Fasilitas</label>
    <input type="text" name="fasilitas" class="form-control" value="<?= $kamar->fasilitas ?? '' ?>" placeholder="AC, Kasur, Lemari, WiFi">
  </div>
  <div class="form-actions">
    <a href="<?= base_url('admin/kamar') ?>" class="btn">Batal</a>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
  </div>
<?= form_close() ?>
</div>
</div>
