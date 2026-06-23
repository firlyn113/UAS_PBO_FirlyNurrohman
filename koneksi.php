<?php
/**
 * File koneksi.php
 * Koneksi database sederhana untuk DB_UAS_PBO_TRPL1B_FirlyNurrohman
 */

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_uas_pbo_trpl1b_firlynurrohman';

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($koneksi, "utf8");


?>