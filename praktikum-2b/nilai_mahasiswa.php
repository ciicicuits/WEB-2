<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama_siswa = $_POST['nama'];
    $mata_kuliah = $_POST['matkul'];
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $nilai_tugas = $_POST['nilai_tugas'];

    // Menghitung Nilai Akhir (30% UTS, 35% UAS, 35% Tugas)
    $nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);

    // Menentukan Status Kelulusan
    $status = ($nilai_akhir >= 55) ? "Lulus" : "Tidak Lulus";

    // Menentukan Grade Nilai
    if ($nilai_akhir >= 85 && $nilai_akhir <= 100) {
        $grade = "A";
    } elseif ($nilai_akhir >= 70) {
        $grade = "B";
    } elseif ($nilai_akhir >= 56) {
        $grade = "C";
    } elseif ($nilai_akhir >= 36) {
        $grade = "D";
    } elseif ($nilai_akhir >= 0) {
        $grade = "E";
    } else {
        $grade = "I"; // Invalid jika nilai di luar rentang 0-100
    }

    // Menentukan Predikat berdasarkan Grade menggunakan switch-case
    switch ($grade) {
        case "A":
            $predikat = "Sangat Memuaskan";
            break;
        case "B":
            $predikat = "Memuaskan";
            break;
        case "C":
            $predikat = "Cukup";
            break;
        case "D":
            $predikat = "Kurang";
            break;
        case "E":
            $predikat = "Sangat Kurang";
            break;
        default:
            $predikat = "Tidak Ada";
            break;
    }

    // Menampilkan Hasil
    echo "<div style='width: 70%; max-width: 700px; margin: 30px auto; padding: 20px; 
    border: 2px solid black; border-radius: 10px; background-color: lightyellow; 
    box-shadow: 5px 5px 10px rgba(0,0,0,0.2);'>";

echo "<h3 style='text-align: center; color: black;'>Hasil Nilai Siswa</h3>";
echo "<table style='width: 100%; border-collapse: collapse;'>"; // Tabel lebar penuh
echo "<tr><td style='padding: 12px; font-weight: bold; width: 30%;'>Nama</td><td>: $nama_siswa</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Mata Kuliah</td><td>: $mata_kuliah</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Nilai UTS</td><td>: $nilai_uts</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Nilai UAS</td><td>: $nilai_uas</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Nilai Tugas</td><td>: $nilai_tugas</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Nilai Akhir</td><td>: " . number_format($nilai_akhir, 2, ',', '.') . "</td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Status</td><td>: <span style='color:" . ($status == 'Lulus' ? 'green' : 'red') . "; font-weight: bold;'>$status</span></td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Grade</td><td>: $grade</span></td></tr>";
echo "<tr><td style='padding: 12px; font-weight: bold;'>Predikat</td><td>: $predikat</td></tr>";
echo "</table>";
echo "</div>";

}
?>