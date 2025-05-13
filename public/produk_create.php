<?php
require_once '../config/database.php';
require_once '../src/models/Produk.php';

$produkModel = new Produk($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $produkModel->create($nama, $harga, $stok);
    header("Location: produk.php");
    exit;
}

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>
  <form method="POST">
    <div class="mb-3">
      <label for="nama_produk" class="form-label">Nama Produk</label>
      <input type="text" class="form-control" name="nama_produk" required>
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">Harga</label>
      <input type="number" class="form-control" name="harga" required>
    </div>
    <div class="mb-3">
      <label for="stok" class="form-label">Stok</label>
      <input type="number" class="form-control" name="stok" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="produk.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
