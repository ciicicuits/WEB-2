<?php
require_once '../config/database.php';

$id_produk     = $_POST['id_produk'] ?? null;
$id_anggota    = $_POST['id_anggota'] ?? null;
$jumlah        = $_POST['jumlah'] ?? 0;
$diskon        = $_POST['diskon'] ?? 0;
$tanggal       = $_POST['tanggal'] ?? date('Y-m-d');

if (!$id_produk || !$id_anggota || !$tanggal) {
    die("Data tidak lengkap.");
}

$status_bayar = 'Belum Lunas';

$stmt = $pdo->prepare("INSERT INTO pemesanan (id_produk, id_anggota, jumlah, diskon, status_bayar, tanggal)
                       VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$id_produk, $id_anggota, $jumlah, $diskon, $status_bayar, $tanggal]);

header("Location: pemesanan_index.php?success=tambah");
exit;

