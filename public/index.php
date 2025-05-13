<?php
require_once '../config/database.php';

function getCount($pdo, $table) {
  $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
  return $stmt->fetchColumn();
}

function getTotalTransaksi($pdo) {
  $stmt = $pdo->query("SELECT SUM(jumlah) as total FROM transaksi");
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['total'] ?? 0;
}

function getTransaksiPerTanggal($pdo) {
  $stmt = $pdo->query("
    SELECT tanggal, SUM(jumlah) as total
    FROM transaksi
    GROUP BY tanggal
    ORDER BY tanggal ASC
  ");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPemesananPerTanggal($pdo) {
  $stmt = $pdo->query("
    SELECT tanggal, SUM(jumlah) as total
    FROM pemesanan
    GROUP BY tanggal
    ORDER BY tanggal ASC
  ");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProdukTerlaris($pdo) {
  $stmt = $pdo->query("
    SELECT pr.nama_produk, SUM(p.jumlah) as total
    FROM pemesanan p
    JOIN produk pr ON p.id_produk = pr.id
    GROUP BY p.id_produk
    ORDER BY total DESC
  ");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$anggotaCount = getCount($pdo, 'anggota');
$produkCount = getCount($pdo, 'produk');
$pemesananCount = getCount($pdo, 'pemesanan');
$transaksiCount = getCount($pdo, 'transaksi');
$totalTransaksi = getTotalTransaksi($pdo);
$chartTransaksi = getTransaksiPerTanggal($pdo);
$chartPemesanan = getPemesananPerTanggal($pdo);
$produkTerlaris = getProdukTerlaris($pdo);

include '../src/views/layouts/header.php';
include '../src/views/layouts/sidebar.php';
?>

<div class="container mt-4">
  <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card border-left-primary shadow h-100 py-2 bg-primary text-white">
        <div class="card-body">
          <h5 class="card-title">Anggota</h5>
          <div class="h4"><?= $anggotaCount ?></div>
          <a href="anggota.php" class="btn btn-light btn-sm mt-2">Lihat Data</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-left-success shadow h-100 py-2 bg-success text-white">
        <div class="card-body">
          <h5 class="card-title">Produk</h5>
          <div class="h4"><?= $produkCount ?></div>
          <a href="produk.php" class="btn btn-light btn-sm mt-2">Lihat Data</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-left-warning shadow h-100 py-2 bg-warning text-dark">
        <div class="card-body">
          <h5 class="card-title">Pemesanan</h5>
          <div class="h4"><?= $pemesananCount ?></div>
          <a href="pemesanan.php" class="btn btn-light btn-sm mt-2">Lihat Data</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-left-danger shadow h-100 py-2 bg-danger text-white">
        <div class="card-body">
          <h5 class="card-title">Transaksi</h5>
          <div class="h4"><?= $transaksiCount ?></div>
          <p>Total: Rp <?= number_format($totalTransaksi, 2, ',', '.') ?></p>
          <a href="transaksi.php" class="btn btn-light btn-sm">Lihat Data</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header">Grafik Transaksi per Tanggal</div>
    <div class="card-body">
      <canvas id="transaksiChart" style="max-height: 300px;"></canvas>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header">Grafik Pemesanan per Tanggal</div>
    <div class="card-body">
      <canvas id="pemesananChart" style="max-height: 300px;"></canvas>
    </div>
  </div>

  <div class="card mb-5">
    <div class="card-header">Grafik Produk Terlaris</div>
    <div class="card-body">
      <canvas id="produkChart" style="max-height: 300px;"></canvas>
    </div>
  </div>
</div>

<?php include '../src/views/layouts/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('transaksiChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($chartTransaksi, 'tanggal')) ?>,
        datasets: [{
            label: 'Jumlah Transaksi',
            data: <?= json_encode(array_map(fn($x) => (float)$x['total'], $chartTransaksi)) ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.6)'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                  callback: value => 'Rp ' + new Intl.NumberFormat('id-ID').format(value)
                }
            }
        }
    }
});

new Chart(document.getElementById('pemesananChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($chartPemesanan, 'tanggal')) ?>,
        datasets: [{
            label: 'Jumlah Pemesanan',
            data: <?= json_encode(array_map(fn($x) => (int)$x['total'], $chartPemesanan)) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});

new Chart(document.getElementById('produkChart'), {
    type: 'pie',
    data: {
        labels: <?= json_encode(array_column($produkTerlaris, 'nama_produk')) ?>,
        datasets: [{
            label: 'Jumlah Terjual',
            data: <?= json_encode(array_map(fn($x) => (int)$x['total'], $produkTerlaris)) ?>,
            backgroundColor: ['#FF6384','#36A2EB','#FFCE56','#8BC34A','#9C27B0','#FF9800']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.raw + ' pcs';
                    }
                }
            }
        }
    }
});
</script>
