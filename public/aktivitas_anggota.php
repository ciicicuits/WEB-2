<?php
require_once '../config/database.php';

$sql = "SELECT a.nama AS nama_anggota, pr.nama_produk, pr.harga, ps.jumlah, ps.tanggal, 
               (pr.harga * ps.jumlah) AS subtotal
        FROM pemesanan ps
        JOIN anggota a ON ps.id_anggota = a.id
        JOIN produk pr ON ps.id_produk = pr.id
        ORDER BY a.nama, ps.tanggal DESC";

$stmt = $pdo->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Aktivitas Anggota</h1>
  <p class="text-muted">Riwayat pembelian produk oleh anggota koperasi.</p>
  <table class="table table-bordered table-sm">
    <thead class="table-light">
      <tr>
        <th>Nama Anggota</th>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['nama_anggota']) ?></td>
        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
        <td>Rp <?= number_format($row['harga'], 2, ',', '.') ?></td>
        <td><?= $row['jumlah'] ?></td>
        <td>Rp <?= number_format($row['subtotal'], 2, ',', '.') ?></td>
        <td><?= $row['tanggal'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
