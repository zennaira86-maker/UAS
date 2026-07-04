<div style="max-width:600px">
<div class="page-title">Input Pembayaran</div>
<div class="page-sub">Catat pembayaran sewa penghuni</div>
<div class="card">
<?= form_open('admin/pembayaran/simpan') ?>
  <div class="form-row">
    <div class="form-group">
      <label class="form-label">Penghuni <span style="color:red">*</span></label>
      <select name="id_penghuni" class="form-control" required>
        <option value="">-- Pilih Penghuni --</option>
        <?php foreach ($penghuni as $p): ?>
        <option value="<?= $p->id_penghuni ?>"><?= $p->nama ?> (<?= $p->nomor_kamar ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label class="form-label">Bulan Bayar <span style="color:red">*</span></label>
      <input type="text" name="bulan_bayar" class="form-control" placeholder="Contoh: Juni 2026" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label class="form-label">Jumlah Bayar <span style="color:red">*</span></label>
      <input type="number" name="jumlah_bayar" class="form-control" placeholder="500000" required>
    </div>
    <div class="form-group">
      <label class="form-label">Metode Bayar</label>
      <select name="metode_bayar" class="form-control">
        <option>Tunai</option><option>Transfer</option><option>QRIS</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label class="form-label">Tanggal Bayar <span style="color:red">*</span></label>
      <input type="date" name="tanggal_bayar" class="form-control" value="<?= date('Y-m-d') ?>" required>
    </div>
    <div class="form-group">
      <label class="form-label">Keterangan</label>
      <input type="text" name="keterangan" class="form-control" placeholder="Opsional">
    </div>
  </div>
  <div class="form-actions">
    <a href="<?= base_url('admin/pembayaran') ?>" class="btn">Batal</a>
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
  </div>
<?= form_close() ?>
</div>
</div>
