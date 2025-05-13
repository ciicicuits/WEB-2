<?php
require_once '../config/database.php';
require_once '../src/models/Anggota.php';

$anggotaModel = new Anggota($pdo);
$data = $anggotaModel->getAll();

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container-fluid">
  <h1 class="h3 mb-3 text-gray-800">Daftar Anggota</h1>
  <p class="text-muted">
    Pendaftaran dan pengelolaan data anggota.
  </p>
  <a href="anggota_create.php" class="btn btn-primary mb-3">Tambah Anggota</a>

  <table class="table table-bordered table-sm">
    <thead class="table-light">
      <tr>
        <th>NIP</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Jenis Kelamin</th>
        <th>Status</th>
        <th>Aktif</th>
        <th>ID Anggota</th>
        <th>Kartu Diskon</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['nip']) ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['jabatan']) ?></td>
        <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td><?= htmlspecialchars($row['aktif']) ?></td>
        <td><?= htmlspecialchars($row['id_anggota']) ?></td>
        <td><?= htmlspecialchars($row['kartu_diskon']) ?></td>
        <td>
          <a href="anggota_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="anggota_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include '../src/views/layouts/footer.php'; ?>
