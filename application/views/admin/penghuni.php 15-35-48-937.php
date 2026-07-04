<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
  <div>
    <div class="page-title">Data Penghuni</div>
    <div class="page-sub">Kelola data penghuni kos</div>
  </div>
  <a href="<?= base_url('admin/penghuni/tambah') ?>" class="btn btn-primary">
    <i class="fas fa-user-plus"></i> Tambah Penghuni
  </a>
</div>
<div class="card">
  <div class="table-wrap">
  <table>
    <thead>
      <tr><th>#</th><th>Nama</th><th>Username</th><th>No. HP</th><th>Alamat</th><th>Kamar</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php foreach ($penghuni as $i => $p): ?>
    <tr>
      <td><?= $i+1 ?></td>
      <td><b><?= $p->nama ?></b></td>
      <td><code><?= $p->username ?></code></td>
      <td><?= $p->no_hp ?></td>
      <td style="font-size:12px;max-width:150px"><?= $p->alamat ?></td>
      <td><?= $p->nomor_kamar ? $p->nomor_kamar.' ('.$p->tipe.')' : '<span style="color:#aaa">-</span>' ?></td>
      <td><span class="badge <?= $p->status_sewa === 'Aktif' ? 'badge-green' : 'badge-gray' ?>"><?= $p->status_sewa ?></span></td>
      <td>
        <a href="<?= base_url('admin/penghuni/edit/'.$p->id_penghuni) ?>" class="btn btn-sm"><i class="fas fa-edit"></i></a>
        <a href="<?= base_url('admin/penghuni/hapus/'.$p->id_penghuni) ?>" class="btn btn-sm btn-danger"
           onclick="return confirm('Hapus penghuni <?= $p->nama ?>?')"><i class="fas fa-trash"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
