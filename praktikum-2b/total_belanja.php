
<?php
// MENANGKAP DATA YANG DI-INPUT
$nama_customer = $_POST['nama'];
$produk = $_POST['produk'];
$jumlah = $_POST['jumlah'];

// MENGHITUNG TOTAL BELANJA MENGGUNAKAN IF ELSE ATAU SWITCH
if ($produk == 'Televisi') {
    $total_belanja = 4200000 * $jumlah;
} elseif ($produk == 'Kulkas') {
    $total_belanja = 3100000 * $jumlah;
} elseif ($produk == 'Mesin Cuci') {
    $total_belanja = 3800000 * $jumlah;
}

// MENCETAK HASIL
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <style>
        body {
            font-size: 18px;
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <fieldset class="border border-dark p-3 rounded" style="background-color: lightcyan;">
            <legend class="border border-dark float-none w-auto px-3 fw-bold h3" style="background-color: lightblue;">Hasil Belanja</legend>

            <p><strong>Nama Customer:</strong> <?= htmlspecialchars($nama_customer) ?></p>
            <p><strong>Produk Pilihan:</strong> <?= htmlspecialchars($produk) ?></p>
            <p><strong>Jumlah Beli:</strong> <?= htmlspecialchars($jumlah) ?></p>
            <p><strong>Total Belanja:</strong> Rp <?= number_format($total_belanja, 0, ',', '.') ?></p>

            <a href="form_belanja.php" class="btn btn-primary mt-3">Kembali ke Form</a>
        </fieldset>
    </div>
</body>
</html>
