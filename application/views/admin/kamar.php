<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
  <div>
    <div class="page-title">Data Kamar</div>
    <div class="page-sub">Kelola seluruh unit kamar kos</div>
  </div>
  <a href="<?= base_url('admin/kamar/tambah') ?>" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Kamar
  </a>
</div>

<div class="kamar-grid">
<?php foreach ($kamar as $k): ?>
<div class="kamar-card <?= strtolower($k->status) ?>">
  <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:4px">
    <div class="kamar-nomor">Kamar <?= $k->nomor_kamar ?></div>
    <span class="badge <?= $k->status === 'Kosong' ? 'badge-green' : 'badge-gray' ?>"><?= $k->status ?></span>
  </div>
  <div class="kamar-tipe"><?= $k->tipe ?></div>
  <div class="kamar-harga">Rp <?= number_format($k->harga,0,',','.') ?><span style="font-size:11px;color:#aaa"> /bulan</span></div>
  <div class="kamar-fasilitas"><i class="fas fa-check-circle" style="color:#1D9E75;font-size:11px"></i> <?= $k->fasilitas ?></div>
  <div style="display:flex;gap:6px;margin-top:8px">
    <a href="<?= base_url('admin/kamar/edit/'.$k->id_kamar) ?>" class="btn btn-sm">
      <i class="fas fa-edit"></i> Edit
    </a>
    <a href="<?= base_url('admin/kamar/hapus/'.$k->id_kamar) ?>" class="btn btn-sm btn-danger"
       onclick="return confirm('Yakin hapus kamar <?= $k->nomor_kamar ?>?')">
      <i class="fas fa-trash"></i> Hapus
    </a>
  </div>
</div>
<?php endforeach; ?>
</div>
