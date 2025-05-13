<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  die("ID pemesanan tidak ditemukan.");
}

$stmt = $pdo->prepare("UPDATE pemesanan SET status_bayar = 'Sudah Dibayar' WHERE id = ?");
$stmt->execute([$id]);

header("Location: transaksi_index.php?status=updated");
exit;
