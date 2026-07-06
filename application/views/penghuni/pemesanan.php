<div class="page-title">Pemesanan Saya</div>
<div class="page-sub">Riwayat pemesanan kamar kos</div>
<div class="card">
  <?php if (empty($pemesanan)): ?>
  <div style="text-align:center;padding:2rem;color:#aaa">
    <i class="fas fa-calendar-times" style="font-size:40px;display:block;margin-bottom:10px"></i>
    Belum ada pemesanan.
    <a href="<?= base_url('penghuni/kamar') ?>" class="btn btn-sm btn-primary" style="display:inline-flex;margin-top:10px">Lihat Kamar</a>
  </div>
  <?php else: ?>
  <div class="table-wrap">
  <table>
    <thead><tr><th>#</th><th>Kamar</th><th>Tipe</th><th>Harga</th><th>Tgl Pesan</th><th>Tgl Masuk</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($pemesanan as $i => $pm): ?>
    <tr>
      <td><?= $i+1 ?></td>
      <td><?= $pm->nomor_kamar ?></td>
      <td><?= $pm->tipe ?></td>
      <td>Rp <?= number_format($pm->harga,0,',','.') ?></td>
      <td style="font-size:12px"><?= $pm->tanggal_pesan ?></td>
      <td style="font-size:12px"><?= $pm->tanggal_masuk ?? '-' ?></td>
      <td><span class="badge <?= $pm->status==='Disetujui'?'badge-green':($pm->status==='Pending'?'badge-amber':($pm->status==='Ditolak'?'badge-red':'badge-gray')) ?>"><?= $pm->status ?></span></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <?php endif; ?>
</div>
