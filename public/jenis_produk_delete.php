<?php
require_once '../config/database.php';

$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("DELETE FROM jenis_produk WHERE id = ?");
$stmt->execute([$id]);

header("Location: jenis_produk.php");
exit;
