<?php
// File: pemesanan_edit.php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  die("ID pemesanan tidak ditemukan.");
}

// Ambil data pemesanan
$stmt = $pdo->prepare("SELECT * FROM pemesanan WHERE id = ?");
$stmt->execute([$id]);
$pemesanan = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$pemesanan) {
  die("Data pemesanan tidak ditemukan.");
}

// Ambil data produk dan anggota untuk dropdown
$produkList = $pdo->query("SELECT id, nama_produk FROM produk")->fetchAll(PDO::FETCH_ASSOC);
$anggotaList = $pdo->query("SELECT id, nama FROM anggota")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_produk = $_POST['id_produk'];
  $id_anggota = $_POST['id_anggota'];
  $jumlah = $_POST['jumlah'];
  $diskon = $_POST['diskon'];
  $status_bayar = $_POST['status_bayar'];
  $tanggal = $_POST['tanggal'];

  $stmt = $pdo->prepare("UPDATE pemesanan SET id_produk=?, id_anggota=?, jumlah=?, diskon=?, status_bayar=?, tanggal=? WHERE id=?");
  $stmt->execute([$id_produk, $id_anggota, $jumlah, $diskon, $status_bayar, $tanggal, $id]);

  header("Location: pemesanan_index.php?success=edit");
  exit;
}

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container mt-4">
  <h2>Edit Pemesanan</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Produk</label>
      <select name="id_produk" class="form-control" required>
        <?php foreach ($produkList as $produk): ?>
          <option value="<?= $produk['id'] ?>" <?= $produk['id'] == $pemesanan['id_produk'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($produk['nama_produk']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Anggota</label>
      <select name="id_anggota" class="form-control" required>
        <?php foreach ($anggotaList as $anggota): ?>
          <option value="<?= $anggota['id'] ?>" <?= $anggota['id'] == $pemesanan['id_anggota'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($anggota['nama']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Jumlah</label>
      <input type="number" name="jumlah" class="form-control" value="<?= $pemesanan['jumlah'] ?>" required>
    </div>

    <div class="mb-3">
      <label>Diskon (%)</label>
      <input type="number" name="diskon" class="form-control" value="<?= $pemesanan['diskon'] ?>">
    </div>

    <div class="mb-3">
      <label>Status Bayar</label>
      <select name="status_bayar" class="form-control">
        <option value="Belum Lunas" <?= $pemesanan['status_bayar'] == 'Belum Lunas' ? 'selected' : '' ?>>Belum Lunas</option>
        <option value="Sudah Dibayar" <?= $pemesanan['status_bayar'] == 'Sudah Dibayar' ? 'selected' : '' ?>>Sudah Dibayar</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?= $pemesanan['tanggal'] ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="pemesanan_index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include '../src/views/layouts/footer.php'; ?>