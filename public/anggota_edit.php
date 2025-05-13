<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  header("Location: anggota.php");
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = ?");
$stmt->execute([$id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {
  echo "Data tidak ditemukan!";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nip = $_POST['nip'];
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $status = $_POST['status'];
  $aktif = $_POST['aktif'];
  $id_anggota = $_POST['id_anggota'];
  $kartu_diskon = $_POST['kartu_diskon'];

  $stmt = $pdo->prepare("UPDATE anggota SET nip=?, nama=?, jabatan=?, jenis_kelamin=?, status=?, aktif=?, id_anggota=?, kartu_diskon=? WHERE id=?");
  $stmt->execute([$nip, $nama, $jabatan, $jenis_kelamin, $status, $aktif, $id_anggota, $kartu_diskon, $id]);

  header("Location: anggota.php");
  exit;
}

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Edit Anggota</h1>
  <form method="POST">
    <div class="mb-3">
      <label for="nip" class="form-label">NIP</label>
      <input type="text" name="nip" id="nip" class="form-control" value="<?= $anggota['nip'] ?>" required>
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" value="<?= $anggota['nama'] ?>" required>
    </div>
    <div class="mb-3">
      <label for="jabatan" class="form-label">Jabatan</label>
      <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= $anggota['jabatan'] ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" <?= $anggota['jenis_kelamin'] == 'Laki-laki' ? 'checked' : '' ?>>
        <label class="form-check-label">Laki-laki</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" <?= $anggota['jenis_kelamin'] == 'Perempuan' ? 'checked' : '' ?>>
        <label class="form-check-label">Perempuan</label>
      </div>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="Tetap" <?= $anggota['status'] == 'Tetap' ? 'selected' : '' ?>>Tetap</option>
        <option value="Kontrak" <?= $anggota['status'] == 'Kontrak' ? 'selected' : '' ?>>Kontrak</option>
        <option value="Magang" <?= $anggota['status'] == 'Magang' ? 'selected' : '' ?>>Magang</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="aktif" class="form-label">Aktif</label>
      <select name="aktif" class="form-select">
        <option value="Ya" <?= $anggota['aktif'] == 'Ya' ? 'selected' : '' ?>>Ya</option>
        <option value="Tidak" <?= $anggota['aktif'] == 'Tidak' ? 'selected' : '' ?>>Tidak</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="id_anggota" class="form-label">ID Anggota</label>
      <input type="text" name="id_anggota" id="id_anggota" class="form-control" value="<?= $anggota['id_anggota'] ?>" required>
    </div>
    <div class="mb-3">
      <label for="kartu_diskon" class="form-label">Kartu Diskon</label>
      <input type="text" name="kartu_diskon" id="kartu_diskon" class="form-control" value="<?= $anggota['kartu_diskon'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="anggota.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
