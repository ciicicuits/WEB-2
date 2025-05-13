<?php
require_once '../config/database.php';

// Ambil data transaksi
$query = "SELECT t.*, a.nama AS nama_anggota, p.nama_produk, 
          pm.status_bayar, pm.id AS id_pemesanan
          FROM transaksi t
          JOIN anggota a ON t.id_anggota = a.id
          JOIN produk p ON t.id_produk = p.id
          LEFT JOIN pemesanan pm ON t.id_pemesanan = pm.id
          ORDER BY t.tanggal DESC";

$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Daftar Transaksi</h1>
  <a href="transaksi_create.php" class="btn btn-primary mb-3">Tambah Transaksi</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Anggota</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Jumlah Bayar (Rp)</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['nama_anggota']) ?></td>
        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
        <td><?= $row['qty'] ?></td>
        <td>Rp <?= number_format($row['jumlah'], 2, ',', '.') ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td>
          <?php if ($row['status_bayar'] === 'Sudah Dibayar'): ?>
            <span class="badge bg-success">Lunas</span>
          <?php else: ?>
            <a href="transaksi_lunas.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Lunas</a>
          <?php endif; ?>
        </td>
        <td>
          <a href="transaksi_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="transaksi_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
