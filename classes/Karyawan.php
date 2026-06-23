<?php
/**
 * File: Karyawan.php
 * Abstract class Karyawan dengan atribut terenkapsulasi (protected)
 */
require_once 'koneksi.php';

abstract class Karyawan {
    // Atribut/properti terenkapsulasi (protected)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hari_kerja_masuk;
    protected $gaji_dasar_per_hari;

    /**
     * Constructor untuk inisialisasi atribut
     */
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari) {
        $this->id_karyawan = $id_karyawan;
        $this->nama_karyawan = $nama_karyawan;
        $this->departemen = $departemen;
        $this->hari_kerja_masuk = $hari_kerja_masuk;
        $this->gaji_dasar_per_hari = $gaji_dasar_per_hari;
    }

    /**
     * Method untuk mendapatkan jumlah hari kerja (PUBLIC agar bisa diakses dari luar)
     * Jika hari_kerja_masuk adalah tanggal, konversi ke jumlah hari
     */
    public function getJumlahHariKerja() {
        // Jika hari_kerja_masuk adalah angka (integer), langsung return
        if (is_numeric($this->hari_kerja_masuk)) {
            return (int)$this->hari_kerja_masuk;
        }
        
        // Jika hari_kerja_masuk adalah tanggal, hitung selisih hari
        // Asumsi: 1 bulan = 22 hari kerja
        $tanggal_masuk = strtotime($this->hari_kerja_masuk);
        $tanggal_sekarang = time();
        $selisih_hari = floor(($tanggal_sekarang - $tanggal_masuk) / (60 * 60 * 24));
        
        // Konversi ke hari kerja (asumsi 5 hari kerja per minggu)
        $minggu = floor($selisih_hari / 7);
        $sisa_hari = $selisih_hari % 7;
        $hari_kerja = ($minggu * 5) + min($sisa_hari, 5);
        
        // Minimal 1 hari, maksimal 30 hari
        return max(1, min(30, $hari_kerja));
    }

    // Getter
    public function getIdKaryawan() {
        return $this->id_karyawan;
    }

    public function getNamaKaryawan() {
        return $this->nama_karyawan;
    }

    public function getDepartemen() {
        return $this->departemen;
    }

    public function getHariKerjaMasuk() {
        return $this->hari_kerja_masuk;
    }

    public function getGajiDasarPerHari() {
        return $this->gaji_dasar_per_hari;
    }

    // Setter
    public function setIdKaryawan($id_karyawan) {
        $this->id_karyawan = $id_karyawan;
    }

    public function setNamaKaryawan($nama_karyawan) {
        $this->nama_karyawan = $nama_karyawan;
    }

    public function setDepartemen($departemen) {
        $this->departemen = $departemen;
    }

    public function setHariKerjaMasuk($hari_kerja_masuk) {
        $this->hari_kerja_masuk = $hari_kerja_masuk;
    }

    public function setGajiDasarPerHari($gaji_dasar_per_hari) {
        $this->gaji_dasar_per_hari = $gaji_dasar_per_hari;
    }

    /**
     * Method abstract (wajib diimplementasikan oleh class anak)
     */
    abstract public function hitungGajiBersih();
    abstract public function tampilProfilKaryawan();

    /**
     * Method untuk menampilkan info dasar karyawan
     */
    protected function tampilInfoDasar() {
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Tanggal Masuk: " . $this->hari_kerja_masuk . "<br>";
        echo "Gaji Dasar/Hari: Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . "<br>";
    }
}
?>