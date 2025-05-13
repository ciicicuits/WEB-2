<?php
require_once '../config/database.php';
require_once '../src/models/Produk.php';

$produkModel = new Produk($pdo);
$id = $_GET['id'];
$produkModel->delete($id);

header("Location: produk.php");
exit;
