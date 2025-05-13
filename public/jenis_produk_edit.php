<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM jenis_produk WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
  echo "Data tidak ditemukan!";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $stmt = $pdo->prepare("UPDATE jenis_produk SET nama = ? WHERE id = ?");
  $stmt->execute([$nama, $id]);
  header("Location: jenis_produk.php");
  exit;
}

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Edit Jenis Produk</h1>
  <form method="POST">
    <div class="mb-3">
      <label for="nama_jenis" class="form-label">Jenis Produk</label>
      <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="jenis_produk.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
