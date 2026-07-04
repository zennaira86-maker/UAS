<div class="page-title">Dashboard</div>
<div class="page-sub">Selamat datang, <?= $this->session->userdata('nama') ?>!</div>

<div class="stats-row">
  <div class="stat-box">
    <div class="stat-label">Total Kamar</div>
    <div class="stat-val"><?= $total_kamar ?></div>
    <div class="stat-sub">unit</div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Kamar Terisi</div>
    <div class="stat-val" style="color:#1D9E75"><?= $kamar_terisi ?></div>
    <div class="stat-sub"><?= ($total_kamar > 0) ? round($kamar_terisi/$total_kamar*100) : 0 ?>% dari total</div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Total Penghuni</div>
    <div class="stat-val" style="color:#185FA5"><?= $total_penghuni ?></div>
    <div class="stat-sub">penghuni aktif</div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Total Pendapatan</div>
    <div class="stat-val" style="font-size:18px;color:#1D9E75">Rp <?= number_format($total_pendapatan,0,',','.') ?></div>
    <div class="stat-sub" style="color:<?= $pending_bayar > 0 ? '#854F0B' : '#aaa' ?>"><?= $pending_bayar ?> pending</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">
<div class="card">
  <div class="card-header">
    Penghuni Aktif
    <a href="<?= base_url('admin/penghuni') ?>" class="btn btn-sm">Lihat Semua</a>
  </div>
  <div class="table-wrap">
  <table>
    <thead><tr><th>Nama</th><th>No. Kamar</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach (array_slice($penghuni, 0, 5) as $p): ?>
    <tr>
      <td><?= $p->nama ?></td>
      <td><?= $p->nomor_kamar ?? '-' ?></td>
      <td><span class="badge <?= $p->status_sewa === 'Aktif' ? 'badge-green' : 'badge-gray' ?>"><?= $p->status_sewa ?></span></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>

<div class="card">
  <div class="card-header">
    Pembayaran Terbaru
    <a href="<?= base_url('admin/pembayaran') ?>" class="btn btn-sm">Lihat Semua</a>
  </div>
  <div class="table-wrap">
  <table>
    <thead><tr><th>Penghuni</th><th>Bulan</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach (array_slice($pembayaran_terbaru, 0, 5) as $pb): ?>
    <tr>
      <td><?= $pb->nama_penghuni ?></td>
      <td style="font-size:12px"><?= $pb->bulan_bayar ?></td>
      <td><span class="badge <?= $pb->status === 'Lunas' ? 'badge-green' : ($pb->status === 'Pending' ? 'badge-amber' : 'badge-red') ?>"><?= $pb->status ?></span></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</div>

<?php if ($pending_pesan > 0): ?>
<div class="alert alert-danger">
  <i class="fas fa-bell"></i>
  Ada <b><?= $pending_pesan ?></b> pemesanan kamar yang menunggu persetujuan.
  <a href="<?= base_url('admin/pemesanan') ?>" class="btn btn-sm btn-danger" style="margin-left:10px">Proses Sekarang</a>
</div>
<?php endif; ?>
