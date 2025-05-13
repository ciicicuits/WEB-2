<?php
// File: pemesanan_delete.php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;
if ($id) {
  $stmt = $pdo->prepare("DELETE FROM pemesanan WHERE id = ?");
  $stmt->execute([$id]);
}

header("Location: pemesanan_index.php?success=hapus");
exit;
