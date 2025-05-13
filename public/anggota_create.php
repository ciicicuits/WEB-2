<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nip = $_POST['nip'];
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $status = $_POST['status'];
  $aktif = $_POST['aktif'];
  $id_anggota = $_POST['id_anggota'];
  $kartu_diskon = $_POST['kartu_diskon'];

  $stmt = $pdo->prepare("INSERT INTO anggota (nip, nama, jabatan, jenis_kelamin, status, aktif, id_anggota, kartu_diskon) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->execute([$nip, $nama, $jabatan, $jenis_kelamin, $status, $aktif, $id_anggota, $kartu_diskon]);

  header("Location: anggota.php");
  exit;
}

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Tambah Anggota</h1>
  <form method="POST">
    <div class="mb-3">
      <label for="nip" class="form-label">NIP</label>
      <input type="text" name="nip" id="nip" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="jabatan" class="form-label">Jabatan</label>
      <input type="text" name="jabatan" id="jabatan" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki" checked>
        <label class="form-check-label" for="laki">Laki-laki</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
        <label class="form-check-label" for="perempuan">Perempuan</label>
      </div>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="status" class="form-select">
        <option value="Tetap">Tetap</option>
        <option value="Kontrak">Kontrak</option>
        <option value="Magang">Magang</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="aktif" class="form-label">Aktif</label>
      <select name="aktif" id="aktif" class="form-select">
        <option value="Ya">Ya</option>
        <option value="Tidak">Tidak</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="id_anggota" class="form-label">ID Anggota</label>
      <input type="text" name="id_anggota" id="id_anggota" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="kartu_diskon" class="form-label">Kartu Diskon</label>
      <input type="text" name="kartu_diskon" id="kartu_diskon" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="anggota.php" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
