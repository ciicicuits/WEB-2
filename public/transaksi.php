<?php
require_once '../config/database.php';
require_once '../src/models/Transaksi.php';

// Query untuk mengambil data transaksi beserta nama anggota dan nama produk
$sql = "SELECT transaksi.*, anggota.nama AS nama_anggota, produk.nama_produk AS nama_produk
        FROM transaksi
        JOIN anggota ON transaksi.id_anggota = anggota.id
        LEFT JOIN produk ON transaksi.id_produk = produk.id";
$stmt = $pdo->query($sql);
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
        <th>Produk</th> <!-- Kolom untuk menampilkan produk -->
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['nama_anggota']) ?></td>
        <td><?= htmlspecialchars($row['nama_produk']) ?></td> <!-- Menampilkan nama produk -->
        <td><?= $row['tanggal'] ?></td>
        <td>Rp <?= number_format($row['jumlah'], 2, ',', '.') ?></td>
        <td>
          <a href="transaksi_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="transaksi_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
