<?php
require_once '../config/database.php';
require_once '../src/models/Anggota.php';

$anggotaModel = new Anggota($pdo);
$id = $_GET['id'];

$anggotaModel->delete($id);
header("Location: anggota.php");
exit;
