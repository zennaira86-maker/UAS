<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
  <div>
    <div class="page-title">Laporan Pembayaran</div>
    <div class="page-sub">Rekap pendapatan sewa kos</div>
  </div>
  <a href="<?= base_url('admin/laporan/cetak') ?>" target="_blank" class="btn btn-primary no-print">
    <i class="fas fa-print"></i> Cetak Laporan
  </a>
</div>

<div class="stats-row" style="grid-template-columns:repeat(3,1fr)">
  <div class="stat-box">
    <div class="stat-label">Total Pendapatan</div>
    <div class="stat-val" style="font-size:20px;color:#185FA5">Rp <?= number_format($total,0,',','.') ?></div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Transaksi Lunas</div>
    <div class="stat-val" style="color:#1D9E75"><?= count(array_filter((array)$detail, function($d) { return $d->status === 'Lunas'; })) ?></div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Transaksi Pending</div>
    <div class="stat-val" style="color:#854F0B"><?= count(array_filter((array)$detail, function($d) { return $d->status === 'Pending'; })) ?></div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">
<div class="card">
  <div class="card-header">Rekap per Bulan</div>
  <table>
    <thead><tr><th>Bulan</th><th>Transaksi</th><th>Total</th></tr></thead>
    <tbody>
    <?php foreach ($rekap as $r): ?>
    <tr>
      <td><?= $r->bulan_bayar ?></td>
      <td><?= $r->jumlah_transaksi ?> tx</td>
      <td><b>Rp <?= number_format($r->total,0,',','.') ?></b></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<div class="card">
  <div class="card-header">Detail Pembayaran</div>
  <div class="table-wrap" style="max-height:300px;overflow-y:auto">
  <table>
    <thead><tr><th>Penghuni</th><th>Bulan</th><th>Jumlah</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($detail as $d): ?>
    <tr>
      <td><?= $d->nama_penghuni ?></td>
      <td style="font-size:12px"><?= $d->bulan_bayar ?></td>
      <td>Rp <?= number_format($d->jumlah_bayar,0,',','.') ?></td>
      <td><span class="badge <?= $d->status==='Lunas'?'badge-green':'badge-amber' ?>"><?= $d->status ?></span></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</div>
