<?php
require_once '../config/database.php';

$id = $_POST['id'];
$jumlah = $_POST['jumlah'];
$diskon = $_POST['diskon'];
$status_bayar = $_POST['status_bayar'];

// Update data
$stmt = $pdo->prepare("UPDATE pemesanan SET jumlah = ?, diskon = ?, status_bayar = ? WHERE id = ?");
$stmt->execute([$jumlah, $diskon, $status_bayar, $id]);

// Redirect kembali ke halaman pemesanan
header("Location: pemesanan.php");
exit;
