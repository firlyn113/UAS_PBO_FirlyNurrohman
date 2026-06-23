<?php


require_once 'classes/KaryawanKontrak.php';
require_once 'classes/KaryawanTetap.php';
require_once 'classes/KaryawanMagang.php';

echo "<h1>Demo Polimorfisme Karyawan</h1>";

// Contoh 1: Karyawan Kontrak (Budi Santoso - IT)
// Data: hari_kerja_masuk = 22 hari kerja dalam sebulan, gaji_dasar = 250000
$karyawan1 = new KaryawanKontrak(
    1, 
    "Budi Santoso", 
    "IT", 
    22,  // 22 hari kerja
    250000, 
    12, 
    "PT Teknologi Jaya"
);
$karyawan1->tampilProfilKaryawan();

// Contoh 2: Karyawan Tetap (Dr. Ir. Haryanto - Direksi)
// Data: hari_kerja_masuk = 20 hari kerja, gaji_dasar = 500000, tunjangan = 2000000
$karyawan2 = new KaryawanTetap(
    2, 
    "Dr. Ir. Haryanto", 
    "Direksi", 
    20,  // 20 hari kerja
    500000, 
    2000000, 
    "SAHAM001"
);
$karyawan2->tampilProfilKaryawan();

// Contoh 3: Karyawan Magang (Fitriana Putri - IT)
// Data: hari_kerja_masuk = 18 hari kerja, gaji_dasar = 100000
$karyawan3 = new KaryawanMagang(
    3, 
    "Fitriana Putri", 
    "IT", 
    18,  // 18 hari kerja
    100000, 
    1500000, 
    "KM-2024-001"
);
$karyawan3->tampilProfilKaryawan();

// Demonstrasi Polimorfisme
echo "<hr>";
echo "<h2>Demonstrasi Polimorfisme (Method Overriding)</h2>";
echo "<p>Method <strong>hitungGajiBersih()</strong> di-override di setiap subclass dengan logika yang berbeda:</p>";

$daftar_karyawan = [$karyawan1, $karyawan2, $karyawan3];

foreach ($daftar_karyawan as $karyawan) {
    $nama = $karyawan->getNamaKaryawan();
    $gaji = $karyawan->hitungGajiBersih();
    
    // Menentukan jenis karyawan
    if ($karyawan instanceof KaryawanKontrak) {
        $jenis = "Kontrak";
        $logika = "Gaji = Hari x Gaji Dasar";
    } elseif ($karyawan instanceof KaryawanTetap) {
        $jenis = "Tetap";
        $logika = "Gaji = (Hari x Gaji Dasar) + Tunjangan Kesehatan";
    } elseif ($karyawan instanceof KaryawanMagang) {
        $jenis = "Magang";
        $logika = "Gaji = (Hari x Gaji Dasar) x 80% (potongan 20%)";
    }
    
    echo "<div style='background:#f9f9f9; padding:10px; margin:5px 0;'>";
    echo "<strong>Nama:</strong> $nama <br>";
    echo "<strong>Jenis:</strong> $jenis <br>";
    echo "<strong>Logika:</strong> $logika <br>";
    echo "<strong style='color:blue;'>Gaji Bersih:</strong> Rp " . number_format($gaji, 0, ',', '.') . "<br>";
    echo "</div>";
}

// Tabel perbandingan
echo "<hr>";
echo "<h2>Perbandingan Metode Perhitungan Gaji</h2>";
echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse:collapse;'>";
echo "<tr style='background:#4CAF50; color:white;'>";
echo "<th>Jenis Karyawan</th>";
echo "<th>Rumus Gaji Bersih</th>";
echo "<th>Contoh Perhitungan</th>";
echo "<th>Hasil</th>";
echo "</tr>";

// Karyawan Kontrak
echo "<tr>";
echo "<td><strong>Kontrak</strong></td>";
echo "<td>hari_kerja × gaji_dasar</td>";
echo "<td>22 × 250.000</td>";
echo "<td>Rp " . number_format(22 * 250000, 0, ',', '.') . "</td>";
echo "</tr>";

// Karyawan Tetap
echo "<tr>";
echo "<td><strong>Tetap</strong></td>";
echo "<td>(hari_kerja × gaji_dasar) + tunjangan</td>";
echo "<td>(20 × 500.000) + 2.000.000</td>";
echo "<td>Rp " . number_format((20 * 500000) + 2000000, 0, ',', '.') . "</td>";
echo "</tr>";

// Karyawan Magang
echo "<tr>";
echo "<td><strong>Magang</strong></td>";
echo "<td>(hari_kerja × gaji_dasar) × 0.80</td>";
echo "<td>(18 × 100.000) × 0.80</td>";
echo "<td>Rp " . number_format((18 * 100000) * 0.80, 0, ',', '.') . "</td>";
echo "</tr>";

echo "</table>";
?>