<?php
require_once '../config/database.php';

$id_anggota = $_POST['id_anggota'] ?? null;
$id_produk = $_POST['id_produk'] ?? null;
$qty = $_POST['qty'] ?? 1;
$tanggal = $_POST['tanggal'] ?? date('Y-m-d');
$id_pemesanan = $_POST['id_pemesanan'] ?? null; // Optional

if (!$id_anggota || !$id_produk || !$qty) {
    die("Data tidak lengkap.");
}

// Ambil harga produk
$stmt = $pdo->prepare("SELECT harga FROM produk WHERE id = ?");
$stmt->execute([$id_produk]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);
$harga_satuan = $produk['harga'] ?? 0;

// Default tanpa diskon
$diskon = 0;

// Jika transaksi dari pemesanan, ambil diskon-nya
if ($id_pemesanan) {
    $stmt = $pdo->prepare("SELECT diskon FROM pemesanan WHERE id = ?");
    $stmt->execute([$id_pemesanan]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $diskon = $row['diskon'];
    }
}

// Hitung jumlah total
$jumlah = ($harga_satuan * $qty) * (1 - ($diskon / 100));

// Simpan transaksi
$stmt = $pdo->prepare("INSERT INTO transaksi (id_anggota, id_produk, qty, jumlah, tanggal, id_pemesanan)
                       VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$id_anggota, $id_produk, $qty, $jumlah, $tanggal, $id_pemesanan]);

// Jika dari pemesanan, tandai sebagai Sudah Dibayar
if ($id_pemesanan) {
    $stmt = $pdo->prepare("UPDATE pemesanan SET status_bayar = 'Sudah Dibayar' WHERE id = ?");
    $stmt->execute([$id_pemesanan]);
}

// Redirect ke halaman sukses
header("Location: transaksi_sukses.php");
exit;
