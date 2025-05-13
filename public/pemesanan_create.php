<?php
require_once '../config/database.php';

// Ambil data produk dan anggota
$produkStmt = $pdo->query("SELECT id, nama_produk FROM produk");
$anggotaStmt = $pdo->query("SELECT id, nama FROM anggota");
$produkList = $produkStmt->fetchAll(PDO::FETCH_ASSOC);
$anggotaList = $anggotaStmt->fetchAll(PDO::FETCH_ASSOC);

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container mt-4">
  <h2>Form Tambah Pemesanan</h2>
  <form action="pemesanan_store.php" method="POST">
    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <select name="id_produk" class="form-select" required>
        <option value="">-- Pilih Produk --</option>
        <?php foreach ($produkList as $produk): ?>
          <option value="<?= $produk['id'] ?>"><?= htmlspecialchars($produk['nama_produk']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama Anggota</label>
      <select name="id_anggota" class="form-select" required>
        <option value="">-- Pilih Anggota --</option>
        <?php foreach ($anggotaList as $anggota): ?>
          <option value="<?= $anggota['id'] ?>"><?= htmlspecialchars($anggota['nama']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Jumlah</label>
      <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Diskon (%)</label>
      <input type="number" name="diskon" class="form-control" value="0">
    </div>

    <div class="mb-3">
      <label class="form-label">Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="pemesanan_index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include '../src/views/layouts/footer.php'; ?>