<div class="page-title">Riwayat Pembayaran</div>
<div class="page-sub">Detail pembayaran sewa kos saya</div>

<div class="stats-row" style="grid-template-columns:repeat(3,1fr)">
  <div class="stat-box">
    <div class="stat-label">Total Dibayar</div>
    <div class="stat-val" style="font-size:18px;color:#185FA5">Rp <?= number_format($total,0,',','.') ?></div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Pembayaran Lunas</div>
    <div class="stat-val" style="color:#1D9E75"><?= count(array_filter((array)$pembayaran, fn($p) => $p->status === 'Lunas')) ?></div>
  </div>
  <div class="stat-box">
    <div class="stat-label">Pembayaran Pending</div>
    <div class="stat-val" style="color:#854F0B"><?= count(array_filter((array)$pembayaran, fn($p) => $p->status === 'Pending')) ?></div>
  </div>
</div>

<div class="card">
  <?php if (empty($pembayaran)): ?>
  <p style="text-align:center;color:#aaa;padding:2rem">Belum ada riwayat pembayaran.</p>
  <?php else: ?>
  <div class="table-wrap">
  <table>
    <thead><tr><th>#</th><th>Bulan</th><th>Kamar</th><th>Jumlah</th><th>Metode</th><th>Tgl Bayar</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($pembayaran as $i => $pb): ?>
    <tr>
      <td><?= $i+1 ?></td>
      <td><?= $pb->bulan_bayar ?></td>
      <td><?= $pb->nomor_kamar ?></td>
      <td><b>Rp <?= number_format($pb->jumlah_bayar,0,',','.') ?></b></td>
      <td><span class="badge badge-blue"><?= $pb->metode_bayar ?></span></td>
      <td style="font-size:12px"><?= $pb->tanggal_bayar ?></td>
      <td><span class="badge <?= $pb->status==='Lunas'?'badge-green':'badge-amber' ?>"><?= $pb->status ?></span></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <?php endif; ?>
</div>
