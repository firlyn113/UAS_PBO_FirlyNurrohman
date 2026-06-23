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
     * Method Getter untuk mengambil nilai atribut
     */
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

    /**
     * Method Setter untuk mengubah nilai atribut
     */
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

  
    protected function hitungGajiKotor() {
        $hari_kerja_per_bulan = 22;
        return $this->gaji_dasar_per_hari * $hari_kerja_per_bulan;
    }

  
    protected function tampilInfoDasar() {
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Tanggal Masuk: " . $this->hari_kerja_masuk . "<br>";
        echo "Gaji Dasar/Hari: Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . "<br>";
    }
}
?>