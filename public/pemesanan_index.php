<?php
require_once '../config/database.php';

// Ambil data pemesanan
$query = "SELECT p.*, a.nama AS nama_anggota, pr.nama_produk, pr.harga
          FROM pemesanan p
          JOIN produk pr ON p.id_produk = pr.id
          JOIN anggota a ON p.id_anggota = a.id
          ORDER BY p.tanggal DESC";

$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Daftar Pemesanan</h1>
  <a href="pemesanan_create.php" class="btn btn-primary mb-3">Tambah Pemesanan</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Produk</th>
        <th>Nama Anggota</th>
        <th>Harga Satuan</th>
        <th>Jumlah</th>
        <th>Diskon (%)</th>
        <th>Subtotal</th>
        <th>Status Bayar</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row): 
        $harga = $row['harga'];
        $jumlah = $row['jumlah'];
        $diskon = $row['diskon'];
        $subtotal = ($harga * $jumlah) * (1 - $diskon / 100);
      ?>
      <tr>
        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
        <td><?= htmlspecialchars($row['nama_anggota']) ?></td>
        <td>Rp <?= number_format($harga, 2, ',', '.') ?></td>
        <td><?= $jumlah ?></td>
        <td><?= $diskon ?>%</td>
        <td>Rp <?= number_format($subtotal, 2, ',', '.') ?></td>
        <td><?= $row['status_bayar'] ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td>
          <a href="pemesanan_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="pemesanan_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
