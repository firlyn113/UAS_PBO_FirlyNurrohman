<?php
/**
 * File: KaryawanTetap.php
 * Subclass untuk karyawan dengan status Tetap
 */

require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    private $tunjangan_kesehatan;
    private $opsi_saham_id;
    
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $tunjangan_kesehatan, $opsi_saham_id) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        $this->tunjangan_kesehatan = $tunjangan_kesehatan;
        $this->opsi_saham_id = $opsi_saham_id;
    }
    
    public function getTunjanganKesehatan() {
        return $this->tunjangan_kesehatan;
    }
    
    public function getOpsiSahamId() {
        return $this->opsi_saham_id;
    }
    
    public function setTunjanganKesehatan($tunjangan_kesehatan) {
        $this->tunjangan_kesehatan = $tunjangan_kesehatan;
    }
    
    public function setOpsiSahamId($opsi_saham_id) {
        $this->opsi_saham_id = $opsi_saham_id;
    }
    
    /**
     * hitungGajiBersih() - Menggunakan jumlah hari kerja + tunjangan
     */
    public function hitungGajiBersih() {
        $jumlah_hari = $this->getJumlahHariKerja();
        return ($jumlah_hari * $this->gaji_dasar_per_hari) + $this->tunjangan_kesehatan;
    }
    
    public function tampilProfilKaryawan() {
        // Tidak digunakan di view card
    }
    
    /**
     * Method untuk mengambil data karyawan tetap dari database
     */
    public static function getDataForView($koneksi, $filter = '') {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Tetap'";
        
        if (!empty($filter)) {
            $filter = mysqli_real_escape_string($koneksi, $filter);
            $query .= " AND (nama_karyawan LIKE '%$filter%' OR departemen LIKE '%$filter%' OR opsi_saham_id LIKE '%$filter%')";
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