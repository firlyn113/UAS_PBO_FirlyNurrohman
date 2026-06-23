<?php

require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    // Atribut spesifik untuk karyawan magang
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
    
    /**
     * Implementasi method abstract hitungGajiBersih()
     * Logika: gaji bersih = (hari_kerja_masuk * gaji_dasar_per_hari) * 0.80
     * Menerima potongan upah sebesar 20% untuk biaya orientasi, pelatihan, atau asuransi
     */
    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) * 0.80;
    }
    
    /**
     * Implementasi method abstract tampilProfilKaryawan()
     */
    public function tampilProfilKaryawan() {
        $gaji_dasar = $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
        $potongan = $gaji_dasar * 0.20;
        
        echo "<div style='border:1px solid #FF9800; padding:10px; margin:10px 0;'>";
        echo "<h3>Profil Karyawan Magang</h3>";
        $this->tampilInfoDasar();
        echo "<strong>Jenis Karyawan:</strong> Magang<br>";
        echo "<strong>Uang Saku Bulanan:</strong> Rp " . number_format($this->uang_saku_bulanan, 0, ',', '.') . "<br>";
        echo "<strong>Sertifikat Kampus Merdeka:</strong> " . $this->sertifikat_kampus_merdeka . "<br>";
        echo "<strong>Gaji Dasar:</strong> Rp " . number_format($gaji_dasar, 0, ',', '.') . "<br>";
        echo "<strong>Potongan 20%:</strong> Rp " . number_format($potongan, 0, ',', '.') . "<br>";
        echo "<strong style='color:green;'>Gaji Bersih (Setelah Potongan):</strong> Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "</div>";
    }
}
?>