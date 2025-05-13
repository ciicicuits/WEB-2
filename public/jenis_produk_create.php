<?php
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['jenis_produk'];

    // Simpan ke database
    $stmt = $pdo->prepare("INSERT INTO jenis_produk (id, jenis_produk) VALUES (?, ?)");
    $stmt->execute([$id, $nama]);

    header("Location: jenis_produk_index.php");
    exit;
}

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Tambah Jenis Produk</h1>
  <form method="POST">
    <div class="form-group">
      <label>ID Jenis Produk</label>
      <input type="number" name="id" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Nama Jenis Produk</label>
      <input type="text" name="jenis_produk" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="jenis_produk_index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
