<?php
require_once '../config/database.php';

// Ambil data anggota
$stmtAnggota = $pdo->query("SELECT id, nama FROM anggota");
$anggotaList = $stmtAnggota->fetchAll(PDO::FETCH_ASSOC);

// Ambil data produk
$stmtProduk = $pdo->query("SELECT id, nama_produk, harga FROM produk");
$produkList = $stmtProduk->fetchAll(PDO::FETCH_ASSOC);

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Tambah Transaksi</h4>
        </div>
        <div class="card-body">
          <form action="transaksi_store.php" method="POST">
            <div class="mb-3">
              <label for="id_anggota" class="form-label">Nama Anggota</label>
              <select name="id_anggota" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <?php foreach ($anggotaList as $anggota): ?>
                  <option value="<?= $anggota['id'] ?>"><?= htmlspecialchars($anggota['nama']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="id_produk" class="form-label">Produk</label>
              <select name="id_produk" id="id_produk" class="form-select" required>
                <option value="">-- Pilih Produk --</option>
                <?php foreach ($produkList as $produk): ?>
                  <option value="<?= $produk['id'] ?>" data-harga="<?= $produk['harga'] ?>">
                    <?= htmlspecialchars($produk['nama_produk']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="qty" class="form-label">Jumlah Beli (Qty)</label>
              <input type="number" name="qty" id="qty" class="form-control" value="1" min="1" required>
            </div>

            <div class="mb-3">
              <label for="jumlah" class="form-label">Total Harga (Rp)</label>
              <input type="number" name="jumlah" id="jumlah" class="form-control" readonly required>
            </div>

            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal Transaksi</label>
              <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between">
              <a href="transaksi_index.php" class="btn btn-secondary">Batal</a>
              <button type="submit" class="btn btn-primary">Bayar</button>
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
</script>

<?php include '../src/views/layouts/footer.php'; ?>
