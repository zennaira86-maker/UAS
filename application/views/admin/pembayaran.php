<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
  <div>
    <div class="page-title">Pembayaran Sewa</div>
    <div class="page-sub">Input dan kelola pembayaran penghuni</div>
  </div>
  <a href="<?= base_url('admin/pembayaran/tambah') ?>" class="btn btn-primary">
    <i class="fas fa-plus"></i> Input Pembayaran
  </a>
</div>
<div class="card">
  <div class="table-wrap">
  <table>
    <thead>
      <tr><th>#</th><th>Penghuni</th><th>Kamar</th><th>Bulan</th><th>Jumlah</th><th>Metode</th><th>Tgl Bayar</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php foreach ($pembayaran as $i => $pb): ?>
    <tr>
      <td><?= $i+1 ?></td>
      <td><?= $pb->nama_penghuni ?></td>
      <td><?= $pb->nomor_kamar ?></td>
      <td style="font-size:12px"><?= $pb->bulan_bayar ?></td>
      <td><b>Rp <?= number_format($pb->jumlah_bayar,0,',','.') ?></b></td>
      <td><span class="badge badge-blue"><?= $pb->metode_bayar ?></span></td>
      <td style="font-size:12px"><?= $pb->tanggal_bayar ?></td>
      <td><span class="badge <?= $pb->status==='Lunas' ? 'badge-green' : ($pb->status==='Pending' ? 'badge-amber' : 'badge-red') ?>"><?= $pb->status ?></span></td>
      <td>
        <?= $pb->status === 'Pending' ? '<a href="'.base_url('admin/pembayaran/verifikasi/'.$pb->id_pembayaran).'" class="btn btn-sm btn-primary" onclick="return confirm(\'Verifikasi pembayaran ini?\')"><i class="fas fa-check"></i> Verifikasi</a>' : '—' ?>
      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
