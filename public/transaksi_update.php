<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id         = $_POST['id'];
  $id_anggota = $_POST['id_anggota'];
  $id_produk  = $_POST['id_produk'];
  $qty        = $_POST['qty'];
  $jumlah     = $_POST['jumlah'];
  $tanggal    = $_POST['tanggal'];

  if (!$id || !$id_anggota || !$id_produk || !$qty || !$jumlah || !$tanggal) {
    die("Data tidak lengkap.");
  }

  // Update data transaksi
  $stmt = $pdo->prepare("UPDATE transaksi 
                         SET id_anggota = :id_anggota, 
                             id_produk = :id_produk, 
                             qty = :qty, 
                             jumlah = :jumlah, 
                             tanggal = :tanggal 
                         WHERE id = :id");
  
  $stmt->execute([
    'id_anggota' => $id_anggota,
    'id_produk'  => $id_produk,
    'qty'        => $qty,
    'jumlah'     => $jumlah,
    'tanggal'    => $tanggal,
    'id'         => $id
  ]);

  header("Location: transaksi_index.php?success=update");
  exit;
} else {
  die("Akses tidak valid.");
}
