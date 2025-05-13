<?php
require_once '../config/database.php';

$sql = "SELECT * FROM jenis_produk ORDER BY id ASC";
$stmt = $pdo->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Daftar Jenis Produk</h1>
  <a href="jenis_produk_create.php" class="btn btn-primary mb-3">Tambah Jenis Produk</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Jenis Produk</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td>
          <a href="jenis_produk_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="jenis_produk_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
