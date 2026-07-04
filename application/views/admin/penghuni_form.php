<div style="max-width:600px">
<div class="page-title"><?= isset($penghuni) ? 'Edit Penghuni' : 'Tambah Penghuni' ?></div>
<div class="page-sub"><?= isset($penghuni) ? 'Perbarui data penghuni' : 'Daftarkan penghuni baru' ?></div>
<div class="card">
<?php
$action = isset($penghuni) ? base_url('admin/penghuni/update/'.$penghuni->id_penghuni) : base_url('admin/penghuni/simpan');
echo form_open($action);
?>
  <div class="form-row">
    <div class="form-group">
      <label class="form-label">Nama Lengkap <span style="color:red">*</span></label>
      <input type="text" name="nama" class="form-control" value="<?= $penghuni->nama ?? '' ?>" required>
    </div>
    <div class="form-group">
      <label class="form-label">Username <span style="color:red">*</span></label>
      <input type="text" name="username" class="form-control" value="<?= $penghuni->username ?? '' ?>" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label class="form-label">Password <?= isset($penghuni) ? '(kosongkan jika tidak diubah)' : '<span style="color:red">*</span>' ?></label>
      <input type="password" name="password" class="form-control" <?= isset($penghuni) ? '' : 'required' ?>>
    </div>
    <div class="form-group">
      <label class="form-label">No. HP</label>
      <input type="text" name="no_hp" class="form-control" value="<?= $penghuni->no_hp ?? '' ?>" placeholder="08xxx">
    </div>
  </div>
  <div class="form-group">
    <label class="form-label">Pilih Kamar</label>
    <select name="id_kamar" class="form-control">
      <option value="">-- Tidak ada / pilih nanti --</option>
      <?php foreach ($kamar as $k): ?>
      <option value="<?= $k->id_kamar ?>" <?= (isset($penghuni) && $penghuni->id_kamar == $k->id_kamar) ? 'selected' : '' ?>>
        <?= $k->nomor_kamar ?> - <?= $k->tipe ?> (Rp <?= number_format($k->harga,0,',','.') ?>) - <?= $k->status ?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap"><?= $penghuni->alamat ?? '' ?></textarea>
  </div>
  <?php if (isset($penghuni)): ?>
  <div class="form-group">
    <label class="form-label">Status Sewa</label>
    <select name="status_sewa" class="form-control">
      <option value="Aktif" <?= $penghuni->status_sewa === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
      <option value="Tidak Aktif" <?= $penghuni->status_sewa === 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
    </select>
  </div>
  <?php endif; ?>
  <div class="form-actions">
    <a href="<?= base_url('admin/penghuni') ?>" class="btn">Batal</a>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
  </div>
<?= form_close() ?>
</div>
</div>
