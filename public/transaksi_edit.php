<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  die("ID tidak valid.");
}

$stmt = $pdo->prepare("SELECT * FROM transaksi WHERE id = ?");
$stmt->execute([$id]);
$transaksi = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$transaksi) {
  die("Transaksi tidak ditemukan.");
}

$stmtAnggota = $pdo->query("SELECT id, nama FROM anggota");
$anggotaList = $stmtAnggota->fetchAll(PDO::FETCH_ASSOC);

$stmtProduk = $pdo->query("SELECT id, nama_produk, harga FROM produk");
$produkList = $stmtProduk->fetchAll(PDO::FETCH_ASSOC);

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
          <h4 class="mb-0">Edit Transaksi</h4>
        </div>
        <div class="card-body">
          <form action="transaksi_update.php" method="POST">
            <input type="hidden" name="id" value="<?= $transaksi['id'] ?>">

            <div class="mb-3">
              <label class="form-label">Nama Anggota</label>
              <select name="id_anggota" class="form-select" required>
                <?php foreach ($anggotaList as $anggota): ?>
                  <option value="<?= $anggota['id'] ?>" <?= $anggota['id'] == $transaksi['id_anggota'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($anggota['nama']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Produk</label>
              <select name="id_produk" id="id_produk" class="form-select" required>
                <?php foreach ($produkList as $produk): ?>
                  <option value="<?= $produk['id'] ?>" data-harga="<?= $produk['harga'] ?>"
                    <?= $produk['id'] == $transaksi['id_produk'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($produk['nama_produk']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Jumlah Beli (Qty)</label>
              <input type="number" name="qty" id="qty" class="form-control"
                     value="<?= $transaksi['qty'] ?>" min="1" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Total Harga (Rp)</label>
              <input type="number" name="jumlah" id="jumlah" class="form-control"
                     value="<?= $transaksi['jumlah'] ?>" readonly required>
            </div>

            <div class="mb-3">
              <label class="form-label">Tanggal Transaksi</label>
              <input type="date" name="tanggal" class="form-control"
                     value="<?= $transaksi['tanggal'] ?>" required>
            </div>

            <div class="d-flex justify-content-between">
              <a href="transaksi_index.php" class="btn btn-secondary">Batal</a>
              <button type="submit" class="btn btn-warning">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const produkSelect = document.getElementById('id_produk');
  const qtyInput = document.getElementById('qty');
  const jumlahInput = document.getElementById('jumlah');

  function updateTotal() {
    const selectedOption = produkSelect.options[produkSelect.selectedIndex];
    const harga = parseInt(selectedOption.getAttribute('data-harga')) || 0;
    const qty = parseInt(qtyInput.value) || 1;
    jumlahInput.value = harga * qty;
  }

  produkSelect.addEventListener('change', updateTotal);
  qtyInput.addEventListener('input', updateTotal);

  // Hitung total saat halaman pertama kali dibuka
  updateTotal();
</script>

<?php include '../src/views/layouts/footer.php'; ?>
