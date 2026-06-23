<?php


require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
   
    private $uang_saku_bulanan;
    private $sertifikat_kampus_merdeka;
    
    /**
     * Constructor
     */
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $uang_saku_bulanan, $sertifikat_kampus_merdeka) {
        // Panggil constructor parent
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        
        $this->uang_saku_bulanan = $uang_saku_bulanan;
        $this->sertifikat_kampus_merdeka = $sertifikat_kampus_merdeka;
    }
    
    // Getter untuk atribut spesifik
    public function getUangSakuBulanan() {
        return $this->uang_saku_bulanan;
    }
    
    public function getSertifikatKampusMerdeka() {
        return $this->sertifikat_kampus_merdeka;
    }
    
    // Setter untuk atribut spesifik
    public function setUangSakuBulanan($uang_saku_bulanan) {
        $this->uang_saku_bulanan = $uang_saku_bulanan;
    }
    
    public function setSertifikatKampusMerdeka($sertifikat_kampus_merdeka) {
        $this->sertifikat_kampus_merdeka = $sertifikat_kampus_merdeka;
    }
    
    
    public function hitungGajiBersih() {
        return $this->uang_saku_bulanan;
    }
    
   
    public function tampilProfilKaryawan() {
        echo "<div style='border:1px solid #FF9800; padding:10px; margin:10px 0;'>";
        echo "<h3>Profil Karyawan Magang</h3>";
        $this->tampilInfoDasar();
        echo "<strong>Jenis Karyawan:</strong> Magang<br>";
        echo "<strong>Uang Saku Bulanan:</strong> Rp " . number_format($this->uang_saku_bulanan, 0, ',', '.') . "<br>";
        echo "<strong>Sertifikat Kampus Merdeka:</strong> " . $this->sertifikat_kampus_merdeka . "<br>";
        echo "<strong style='color:green;'>Gaji Bersih:</strong> Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "</div>";
    }
}
?>