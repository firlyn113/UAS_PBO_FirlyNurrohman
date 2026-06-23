<?php
/**
 * File: KaryawanKontrak.php
 * Subclass untuk karyawan dengan status Kontrak
 */

require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    private $durasi_kontrak_bulan;
    private $agensi_penyalur;
    
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $durasi_kontrak_bulan, $agensi_penyalur) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        $this->durasi_kontrak_bulan = $durasi_kontrak_bulan;
        $this->agensi_penyalur = $agensi_penyalur;
    }
    
    public function getDurasiKontrakBulan() {
        return $this->durasi_kontrak_bulan;
    }
    
    public function getAgensiPenyalur() {
        return $this->agensi_penyalur;
    }
    
    public function setDurasiKontrakBulan($durasi_kontrak_bulan) {
        $this->durasi_kontrak_bulan = $durasi_kontrak_bulan;
    }
    
    public function setAgensiPenyalur($agensi_penyalur) {
        $this->agensi_penyalur = $agensi_penyalur;
    }
    
    /**
     * hitungGajiBersih() - Menggunakan jumlah hari kerja
     */
    public function hitungGajiBersih() {
        $jumlah_hari = $this->getJumlahHariKerja();
        return $jumlah_hari * $this->gaji_dasar_per_hari;
    }
    
    public function tampilProfilKaryawan() {
        // Tidak digunakan di view card
    }
    
    /**
     * Method untuk mengambil data karyawan kontrak dari database
     */
    public static function getDataForView($koneksi, $filter = '') {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Kontrak'";
        
        if (!empty($filter)) {
            $filter = mysqli_real_escape_string($koneksi, $filter);
            $query .= " AND (nama_karyawan LIKE '%$filter%' OR departemen LIKE '%$filter%' OR agensi_penyalur LIKE '%$filter%')";
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