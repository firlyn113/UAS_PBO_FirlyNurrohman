<?php


require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    // Atribut spesifik untuk karyawan kontrak
    private $durasi_kontrak_bulan;
    private $agensi_penyalur;
    
    /**
     * Constructor
     */
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $durasi_kontrak_bulan, $agensi_penyalur) {
        // Panggil constructor parent
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        
        $this->durasi_kontrak_bulan = $durasi_kontrak_bulan;
        $this->agensi_penyalur = $agensi_penyalur;
    }
    
    // Getter untuk atribut spesifik
    public function getDurasiKontrakBulan() {
        return $this->durasi_kontrak_bulan;
    }
    
    public function getAgensiPenyalur() {
        return $this->agensi_penyalur;
    }
    
    // Setter untuk atribut spesifik
    public function setDurasiKontrakBulan($durasi_kontrak_bulan) {
        $this->durasi_kontrak_bulan = $durasi_kontrak_bulan;
    }
    
    public function setAgensiPenyalur($agensi_penyalur) {
        $this->agensi_penyalur = $agensi_penyalur;
    }
    
   
    public function hitungGajiBersih() {
        $gaji_kotor = $this->hitungGajiKotor();
        $potongan = $gaji_kotor * 0.05; // Potongan 5%
        return $gaji_kotor - $potongan;
    }
    
    /**
     * Implementasi method abstract tampilProfilKaryawan()
     */
    public function tampilProfilKaryawan() {
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0;'>";
        echo "<h3>Profiling Karyawan Kontrak</h3>";
        $this->tampilInfoDasar();
        echo "<strong>Jenis Karyawan:</strong> Kontrak<br>";
        echo "<strong>Durasi Kontrak:</strong> " . $this->durasi_kontrak_bulan . " bulan<br>";
        echo "<strong>Agensi Penyalur:</strong> " . $this->agensi_penyalur . "<br>";
        echo "<strong>Gaji Kotor:</strong> Rp " . number_format($this->hitungGajiKotor(), 0, ',', '.') . "<br>";
        echo "<strong>Potongan (5%):</strong> Rp " . number_format($this->hitungGajiKotor() * 0.05, 0, ',', '.') . "<br>";
        echo "<strong style='color:green;'>Gaji Bersih:</strong> Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "</div>";
    }
}
?>