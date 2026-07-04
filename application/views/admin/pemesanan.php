<div class="page-title">Data Pemesanan</div>
<div class="page-sub">Kelola dan setujui pemesanan kamar dari penghuni</div>
<div class="card">
  <div class="table-wrap">
  <table>
    <thead>
      <tr><th>#</th><th>Penghuni</th><th>Kamar</th><th>Tgl Pesan</th><th>Tgl Masuk</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php if (empty($pemesanan)): ?>
    <tr><td colspan="7" style="text-align:center;color:#aaa;padding:2rem">Belum ada data pemesanan</td></tr>
    <?php else: foreach ($pemesanan as $i => $pm): ?>
    <tr>
      <td><?= $i+1 ?></td>
      <td><b><?= $pm->nama_penghuni ?></b></td>
      <td><?= $pm->nomor_kamar ?> <span style="color:#aaa;font-size:12px">(<?= $pm->tipe ?>)</span></td>
      <td style="font-size:12px"><?= $pm->tanggal_pesan ?></td>
      <td style="font-size:12px"><?= $pm->tanggal_masuk ?? '-' ?></td>
      <td>
        <span class="badge <?= $pm->status==='Disetujui' ? 'badge-green' : ($pm->status==='Pending' ? 'badge-amber' : ($pm->status==='Ditolak' ? 'badge-red' : 'badge-gray')) ?>">
          <?= $pm->status ?>
        </span>
      </td>
      <td>
        <?php if ($pm->status === 'Pending'): ?>
        <a href="<?= base_url('admin/pemesanan/setujui/'.$pm->id_pemesanan) ?>" class="btn btn-sm btn-primary"
           onclick="return confirm('Setujui pemesanan ini?')">
          <i class="fas fa-check"></i> Setujui
        </a>
        <a href="<?= base_url('admin/pemesanan/tolak/'.$pm->id_pemesanan) ?>" class="btn btn-sm btn-danger"
           onclick="return confirm('Tolak pemesanan ini?')">
          <i class="fas fa-times"></i> Tolak
        </a>
        <?php else: echo '—'; endif; ?>
      </td>
    </tr>
    <?php endforeach; endif; ?>
    </tbody>
  </table>
  </div>
</div>
