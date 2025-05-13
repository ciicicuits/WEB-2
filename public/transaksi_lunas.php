<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
  $stmt = $pdo->prepare("UPDATE transaksi SET status_bayar = 'Sudah Dibayar' WHERE id = ?");
  $stmt->execute([$id]);
}

header("Location: transaksi_index.php?success=lunas");
exit;
