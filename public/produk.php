<?php
require_once '../config/database.php';
require_once '../src/models/Produk.php';

$produkModel = new Produk($pdo);
$data = $produkModel->getAll();

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Daftar Produk</h1>
  <a href="produk_create.php" class="btn btn-primary mb-3">Tambah Produk</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Produk</th><th>Harga</th><th>Stok</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row): ?>
      <tr>
        <td><?= $row['nama_produk'] ?></td>
        <td>Rp <?= number_format($row['harga'], 2, ',', '.') ?></td>
        <td><?= $row['stok'] ?></td>
        <td>
          <a href="produk_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="produk_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
