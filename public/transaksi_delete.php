<?php
require_once '../config/database.php';

// Ambil ID dari parameter URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID transaksi tidak ditemukan.";
    exit;
}

// Hapus transaksi dari database
$sql = "DELETE FROM transaksi WHERE id = ?";
$stmt = $pdo->prepare($sql);
$success = $stmt->execute([$id]);

if ($success) {
    header("Location: transaksi_index.php?status=deleted");
    exit;
} else {
    echo "Gagal menghapus transaksi.";
}
