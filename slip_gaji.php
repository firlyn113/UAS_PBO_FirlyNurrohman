<?php
/**
 * File: slip_gaji.php
 * Halaman untuk menampilkan daftar slip gaji dan informasi karyawan
 */

require_once 'koneksi.php';
require_once 'classes/KaryawanKontrak.php';
require_once 'classes/KaryawanTetap.php';
require_once 'classes/KaryawanMagang.php';

// Ambil filter dari dropdown
$filter_jenis = isset($_GET['jenis']) ? $_GET['jenis'] : 'all';
$filter_search = isset($_GET['search']) ? $_GET['search'] : '';

// Ambil data berdasarkan filter
$data_kontrak = [];
$data_tetap = [];
$data_magang = [];

if ($filter_jenis == 'all' || $filter_jenis == 'kontrak') {
    $data_kontrak = KaryawanKontrak::getDataForView($koneksi, $filter_search);
}

if ($filter_jenis == 'all' || $filter_jenis == 'tetap') {
    $data_tetap = KaryawanTetap::getDataForView($koneksi, $filter_search);
}

if ($filter_jenis == 'all' || $filter_jenis == 'magang') {
    $data_magang = KaryawanMagang::getDataForView($koneksi, $filter_search);
}

$total_karyawan = count($data_kontrak) + count($data_tetap) + count($data_magang);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji Karyawan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            padding: 20px;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        .total-info {
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .filter-section {
            background: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }
        .filter-section label {
            font-weight: 600;
            color: #2c3e50;
        }
        .filter-section select, 
        .filter-section input {
            padding: 10px 15px;
            border: 2px solid #bdc3c7;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s;
        }
        .filter-section select:focus,
        .filter-section input:focus {
            border-color: #3498db;
            outline: none;
        }
        .filter-section button {
            padding: 10px 25px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        .filter-section button:hover {
            background: #2980b9;
        }
        .filter-section .reset-btn {
            padding: 10px 25px;
            background: #95a5a6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .filter-section .reset-btn:hover {
            background: #7f8c8d;
        }
        .section-title {
            font-size: 24px;
            color: #2c3e50;
            margin: 30px 0 15px 0;
            padding: 10px;
            border-left: 5px solid #3498db;
            background: #f8f9fa;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 4px solid #3498db;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }
        .card-header h3 {
            color: #2c3e50;
            font-size: 18px;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }
        .badge-kontrak { background: #3498db; }
        .badge-tetap { background: #27ae60; }
        .badge-magang { background: #f39c12; }
        .card-body p {
            margin: 8px 0;
            color: #555;
            font-size: 14px;
        }
        .card-body strong {
            color: #2c3e50;
        }
        .gaji-container {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px dashed #ecf0f1;
        }
        .gaji-bersih {
            font-size: 20px;
            font-weight: bold;
            color: #27ae60;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #95a5a6;
            font-size: 18px;
        }
        .statistik {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0 30px 0;
        }
        .stat-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .stat-box .number {
            font-size: 28px;
            font-weight: bold;
        }
        .stat-box .label {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }
        .stat-kontrak .number { color: #3498db; }
        .stat-tetap .number { color: #27ae60; }
        .stat-magang .number { color: #f39c12; }
        .stat-total .number { color: #2c3e50; }
        @media (max-width: 768px) {
            .card-container { grid-template-columns: 1fr; }
            .header-info { flex-direction: column; align-items: flex-start; }
            .filter-section { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Daftar Slip Gaji Karyawan</h1>
        
        <div class="header-info">
            <div class="total-info">Total Karyawan: <?= $total_karyawan ?> orang</div>
            <div style="font-size: 14px; color: #7f8c8d;"><?= date('d F Y H:i:s') ?></div>
        </div>
        
        <div class="statistik">
            <div class="stat-box stat-kontrak">
                <div class="number"><?= count($data_kontrak) ?></div>
                <div class="label">Karyawan Kontrak</div>
            </div>
            <div class="stat-box stat-tetap">
                <div class="number"><?= count($data_tetap) ?></div>
                <div class="label">Karyawan Tetap</div>
            </div>
            <div class="stat-box stat-magang">
                <div class="number"><?= count($data_magang) ?></div>
                <div class="label">Karyawan Magang</div>
            </div>
            <div class="stat-box stat-total">
                <div class="number"><?= $total_karyawan ?></div>
                <div class="label">Total Keseluruhan</div>
            </div>
        </div>
        
        <div class="filter-section">
            <form method="GET" action="" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; width: 100%;">
                <label for="jenis">Filter Kategori:</label>
                <select name="jenis" id="jenis">
                    <option value="all" <?= $filter_jenis == 'all' ? 'selected' : '' ?>>Semua Karyawan</option>
                    <option value="kontrak" <?= $filter_jenis == 'kontrak' ? 'selected' : '' ?>>Kontrak</option>
                    <option value="tetap" <?= $filter_jenis == 'tetap' ? 'selected' : '' ?>>Tetap</option>
                    <option value="magang" <?= $filter_jenis == 'magang' ? 'selected' : '' ?>>Magang</option>
                </select>
                <label for="search">Cari:</label>
                <input type="text" name="search" id="search" placeholder="Nama / Departemen..." value="<?= htmlspecialchars($filter_search) ?>">
                <button type="submit">🔍 Filter</button>
                <a href="slip_gaji.php" class="reset-btn">↺ Reset</a>
            </form>
        </div>
        
        <!-- KARYAWAN KONTRAK -->
<?php if ($filter_jenis == 'all' || $filter_jenis == 'kontrak'): ?>
<div class="section-title" style="border-left-color: #3498db;">🔵 Karyawan Kontrak (<?= count($data_kontrak) ?>)</div>
<?php if (count($data_kontrak) > 0): ?>
<div class="card-container">
    <?php foreach ($data_kontrak as $row): 
        // Buat objek untuk menghitung gaji
        $karyawan = new KaryawanKontrak(
            $row['id_karyawan'],
            $row['nama_karyawan'],
            $row['departemen'],
            $row['hari_kerja_masuk'],
            $row['gaji_dasar_per_hari'],
            $row['durasi_kontrak_bulan'],
            $row['agensi_penyalur']
        );
        $gaji_bersih = $karyawan->hitungGajiBersih();
        $jumlah_hari = $karyawan->getJumlahHariKerja(); // <- SEKARANG BISA dipanggil (public)
    ?>
    <div class="card" style="border-top-color: #3498db;">
        <div class="card-header">
            <h3><?= htmlspecialchars($row['nama_karyawan']) ?></h3>
            <span class="badge badge-kontrak">Kontrak</span>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> #<?= $row['id_karyawan'] ?></p>
            <p><strong>Departemen:</strong> <?= htmlspecialchars($row['departemen']) ?></p>
            <p><strong>Hari Kerja:</strong> <?= $jumlah_hari ?> hari</p>
            <p><strong>Gaji Dasar/Hari:</strong> Rp <?= number_format($row['gaji_dasar_per_hari'], 0, ',', '.') ?></p>
            <p><strong>Durasi Kontrak:</strong> <?= $row['durasi_kontrak_bulan'] ?> bulan</p>
            <p><strong>Agensi Penyalur:</strong> <?= htmlspecialchars($row['agensi_penyalur']) ?></p>
            <div class="gaji-container">
                <p style="font-size: 14px; color: #7f8c8d;">Rumus: Hari Kerja × Gaji Dasar</p>
                <p style="font-size: 13px; color: #555;">
                    <?= $jumlah_hari ?> × Rp <?= number_format($row['gaji_dasar_per_hari'], 0, ',', '.') ?> 
                    = Rp <?= number_format($jumlah_hari * $row['gaji_dasar_per_hari'], 0, ',', '.') ?>
                </p>
                <p class="gaji-bersih">💰 Gaji Bersih: Rp <?= number_format($gaji_bersih, 0, ',', '.') ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="empty-state">Tidak ada data karyawan kontrak</div>
<?php endif; ?>
<?php endif; ?>
        
        <!-- KARYAWAN TETAP -->
        <?php if ($filter_jenis == 'all' || $filter_jenis == 'tetap'): ?>
        <div class="section-title" style="border-left-color: #27ae60;">🟢 Karyawan Tetap (<?= count($data_tetap) ?>)</div>
        <?php if (count($data_tetap) > 0): ?>
        <div class="card-container">
            <?php foreach ($data_tetap as $row):
                $karyawan = new KaryawanTetap(
                    $row['id_karyawan'],
                    $row['nama_karyawan'],
                    $row['departemen'],
                    $row['hari_kerja_masuk'],
                    $row['gaji_dasar_per_hari'],
                    $row['tunjangan_kesehatan'],
                    $row['opsi_saham_id']
                );
                $gaji_bersih = $karyawan->hitungGajiBersih();
                $jumlah_hari = $karyawan->getJumlahHariKerja();
                $gaji_dasar_total = $jumlah_hari * $row['gaji_dasar_per_hari'];
            ?>
            <div class="card" style="border-top-color: #27ae60;">
                <div class="card-header">
                    <h3><?= htmlspecialchars($row['nama_karyawan']) ?></h3>
                    <span class="badge badge-tetap">Tetap</span>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> #<?= $row['id_karyawan'] ?></p>
                    <p><strong>Departemen:</strong> <?= htmlspecialchars($row['departemen']) ?></p>
                    <p><strong>Hari Kerja:</strong> <?= $jumlah_hari ?> hari</p>
                    <p><strong>Gaji Dasar/Hari:</strong> Rp <?= number_format($row['gaji_dasar_per_hari'], 0, ',', '.') ?></p>
                    <p><strong>Tunjangan Kesehatan:</strong> Rp <?= number_format($row['tunjangan_kesehatan'], 0, ',', '.') ?></p>
                    <p><strong>Opsi Saham ID:</strong> <?= htmlspecialchars($row['opsi_saham_id']) ?></p>
                    <div class="gaji-container">
                        <p style="font-size: 14px; color: #7f8c8d;">Rumus: (Hari Kerja × Gaji Dasar) + Tunjangan Kesehatan</p>
                        <p style="font-size: 13px; color: #555;">
                            Gaji Dasar: Rp <?= number_format($gaji_dasar_total, 0, ',', '.') ?> 
                            + Tunjangan: Rp <?= number_format($row['tunjangan_kesehatan'], 0, ',', '.') ?>
                        </p>
                        <p class="gaji-bersih">💰 Gaji Bersih: Rp <?= number_format($gaji_bersih, 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">Tidak ada data karyawan tetap</div>
        <?php endif; ?>
        <?php endif; ?>
        
        <!-- KARYAWAN MAGANG -->
        <?php if ($filter_jenis == 'all' || $filter_jenis == 'magang'): ?>
        <div class="section-title" style="border-left-color: #f39c12;">🟠 Karyawan Magang (<?= count($data_magang) ?>)</div>
        <?php if (count($data_magang) > 0): ?>
        <div class="card-container">
            <?php foreach ($data_magang as $row):
                $karyawan = new KaryawanMagang(
                    $row['id_karyawan'],
                    $row['nama_karyawan'],
                    $row['departemen'],
                    $row['hari_kerja_masuk'],
                    $row['gaji_dasar_per_hari'],
                    $row['uang_saku_bulanan'],
                    $row['sertifikat_kampus_merdeka']
                );
                $gaji_bersih = $karyawan->hitungGajiBersih();
                $jumlah_hari = $karyawan->getJumlahHariKerja();
                $gaji_dasar_total = $jumlah_hari * $row['gaji_dasar_per_hari'];
                $potongan = $gaji_dasar_total * 0.20;
            ?>
            <div class="card" style="border-top-color: #f39c12;">
                <div class="card-header">
                    <h3><?= htmlspecialchars($row['nama_karyawan']) ?></h3>
                    <span class="badge badge-magang">Magang</span>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> #<?= $row['id_karyawan'] ?></p>
                    <p><strong>Departemen:</strong> <?= htmlspecialchars($row['departemen']) ?></p>
                    <p><strong>Hari Kerja:</strong> <?= $jumlah_hari ?> hari</p>
                    <p><strong>Gaji Dasar/Hari:</strong> Rp <?= number_format($row['gaji_dasar_per_hari'], 0, ',', '.') ?></p>
                    <p><strong>Uang Saku Bulanan:</strong> Rp <?= number_format($row['uang_saku_bulanan'], 0, ',', '.') ?></p>
                    <p><strong>Sertifikat KM:</strong> <?= htmlspecialchars($row['sertifikat_kampus_merdeka']) ?></p>
                    <div class="gaji-container">
                        <p style="font-size: 14px; color: #7f8c8d;">Rumus: (Hari Kerja × Gaji Dasar) × 80% (potongan 20%)</p>
                        <p style="font-size: 13px; color: #555;">
                            Gaji Dasar: Rp <?= number_format($gaji_dasar_total, 0, ',', '.') ?> 
                            - Potongan 20%: Rp <?= number_format($potongan, 0, ',', '.') ?>
                        </p>
                        <p class="gaji-bersih">💰 Gaji Bersih: Rp <?= number_format($gaji_bersih, 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">Tidak ada data karyawan magang</div>
        <?php endif; ?>
        <?php endif; ?>
        
        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ecf0f1; text-align: center; color: #95a5a6; font-size: 14px;">
            <p>© <?= date('Y') ?> - Sistem Slip Gaji Karyawan | DB_UAS_PBO_TRPL1B_FirlyNurrohman</p>
        </div>
    </div>
</body>
</html>