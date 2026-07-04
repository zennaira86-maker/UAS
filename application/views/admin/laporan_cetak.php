<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Pembayaran - KosKu</title>
<style>
body{font-family:Arial,sans-serif;font-size:13px;margin:20px;color:#333}
h2{text-align:center;color:#1D9E75;margin:0}
p{text-align:center;color:#888;font-size:12px;margin:4px 0 20px}
table{width:100%;border-collapse:collapse;margin-top:10px}
th{background:#1D9E75;color:#fff;padding:8px 10px;text-align:left;font-size:12px}
td{padding:7px 10px;border-bottom:1px solid #eee;font-size:12px}
.total{font-weight:bold;text-align:right;padding:10px;font-size:14px}
@media print{button{display:none}}
</style>
</head>
<body>
<h2>🏠 KosKu - Laporan Pembayaran</h2>
<p>Dicetak: <?= date('d/m/Y H:i') ?></p>
<table>
  <thead><tr><th>#</th><th>Penghuni</th><th>Kamar</th><th>Bulan</th><th>Jumlah</th><th>Metode</th><th>Status</th></tr></thead>
  <tbody>
  <?php foreach ($detail as $i => $d): ?>
  <tr>
    <td><?= $i+1 ?></td>
    <td><?= $d->nama_penghuni ?></td>
    <td><?= $d->nomor_kamar ?></td>
    <td><?= $d->bulan_bayar ?></td>
    <td>Rp <?= number_format($d->jumlah_bayar,0,',','.') ?></td>
    <td><?= $d->metode_bayar ?></td>
    <td><?= $d->status ?></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<div class="total">TOTAL PENDAPATAN: Rp <?= number_format($total,0,',','.') ?></div>
<div style="margin-top:30px;display:flex;justify-content:space-around;font-size:12px">
  <div style="text-align:center">Dibuat Oleh<br><br><br>_______________<br>Admin</div>
  <div style="text-align:center">Mengetahui<br><br><br>_______________<br>Pemilik Kos</div>
</div>
<script>window.onload=()=>window.print()</script>
</body>
</html>
