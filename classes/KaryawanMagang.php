<?php
/**
 * File: KaryawanMagang.php
 * Subclass untuk karyawan dengan status Magang
 */

require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    private $uang_saku_bulanan;
    private $sertifikat_kampus_merdeka;
    
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $uang_saku_bulanan, $sertifikat_kampus_merdeka) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        $this->uang_saku_bulanan = $uang_saku_bulanan;
        $this->sertifikat_kampus_merdeka = $sertifikat_kampus_merdeka;
    }
    
    public function getUangSakuBulanan() {
        return $this->uang_saku_bulanan;
    }
    
    public function getSertifikatKampusMerdeka() {
        return $this->sertifikat_kampus_merdeka;
    }
    
    public function setUangSakuBulanan($uang_saku_bulanan) {
        $this->uang_saku_bulanan = $uang_saku_bulanan;
    }
    
    public function setSertifikatKampusMerdeka($sertifikat_kampus_merdeka) {
        $this->sertifikat_kampus_merdeka = $sertifikat_kampus_merdeka;
    }
    
    /**
     * hitungGajiBersih() - Menggunakan jumlah hari kerja × 80%
     */
    public function hitungGajiBersih() {
        $jumlah_hari = $this->getJumlahHariKerja();
        return ($jumlah_hari * $this->gaji_dasar_per_hari) * 0.80;
    }
    
    public function tampilProfilKaryawan() {
        // Tidak digunakan di view card
    }
    
    /**
     * Method untuk mengambil data karyawan magang dari database
     */
    public static function getDataForView($koneksi, $filter = '') {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Magang'";
        
        if (!empty($filter)) {
            $filter = mysqli_real_escape_string($koneksi, $filter);
            $query .= " AND (nama_karyawan LIKE '%$filter%' OR departemen LIKE '%$filter%' OR sertifikat_kampus_merdeka LIKE '%$filter%')";
        }
        
        $query .= " ORDER BY id_karyawan DESC";
        
        $result = mysqli_query($koneksi, $query);
        $data = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        return $data;
    }
}
?>