<div class="page-title">Dashboard</div>
<div class="page-sub">Selamat datang, <?= $this->session->userdata('nama') ?>!</div>

<?php if ($penghuni): ?>
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem">
  <div class="stat-box">
    <div class="stat-label">Kamar Saya</div>
    <div class="stat-val" style="font-size:20px"><?= $penghuni->nomor_kamar ?? 'Belum ada' ?></div>
    <div class="stat-sub"><?= $penghuni->tipe ?? '' ?></div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Harga Sewa</div>
    <div class="stat-val" style="font-size:18px;color:#1D9E75">
      <?= $penghuni->harga ? 'Rp '.number_format($penghuni->harga,0,',','.') : '-' ?>
    </div>
    <div class="stat-sub">per bulan</div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Status Sewa</div>
    <div class="stat-val" style="font-size:18px">
      <span class="badge <?= $penghuni->status_sewa === 'Aktif' ? 'badge-green' : 'badge-gray' ?>" style="font-size:14px"><?= $penghuni->status_sewa ?></span>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">Info Saya</div>
  <table style="width:auto">
    <tr><td style="padding:6px 12px;color:#888;font-size:13px">Nama</td><td style="padding:6px 12px"><b><?= $penghuni->nama ?></b></td></tr>
    <tr><td style="padding:6px 12px;color:#888;font-size:13px">No. HP</td><td style="padding:6px 12px"><?= $penghuni->no_hp ?></td></tr>
    <tr><td style="padding:6px 12px;color:#888;font-size:13px">Alamat</td><td style="padding:6px 12px"><?= $penghuni->alamat ?></td></tr>
    <tr><td style="padding:6px 12px;color:#888;font-size:13px">Fasilitas</td><td style="padding:6px 12px"><?= $penghuni->id_kamar ? 'AC, Kasur, WiFi (sesuai tipe)' : '-' ?></td></tr>
  </table>
</div>
<?php endif; ?>
