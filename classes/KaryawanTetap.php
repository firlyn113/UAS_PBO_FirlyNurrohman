<?php


require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    // Atribut spesifik untuk karyawan tetap
    private $tunjangan_kesehatan;
    private $opsi_saham_id;
    
    /**
     * Constructor
     */
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari, $tunjangan_kesehatan, $opsi_saham_id) {
        // Panggil constructor parent
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hari_kerja_masuk, $gaji_dasar_per_hari);
        
        $this->tunjangan_kesehatan = $tunjangan_kesehatan;
        $this->opsi_saham_id = $opsi_saham_id;
    }
    
    // Getter untuk atribut spesifik
    public function getTunjanganKesehatan() {
        return $this->tunjangan_kesehatan;
    }
    
    public function getOpsiSahamId() {
        return $this->opsi_saham_id;
    }
    
    // Setter untuk atribut spesifik
    public function setTunjanganKesehatan($tunjangan_kesehatan) {
        $this->tunjangan_kesehatan = $tunjangan_kesehatan;
    }
    
    public function setOpsiSahamId($opsi_saham_id) {
        $this->opsi_saham_id = $opsi_saham_id;
    }
    
    /**
     * Implementasi method abstract hitungGajiBersih()
     * Logika: gaji bersih = (hari_kerja_masuk * gaji_dasar_per_hari) + tunjangan_kesehatan
     * Mendapat tambahan tunjangan kesehatan
     */
    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) + $this->tunjangan_kesehatan;
    }
    
    /**
     * Implementasi method abstract tampilProfilKaryawan()
     */
    public function tampilProfilKaryawan() {
        echo "<div style='border:1px solid #4CAF50; padding:10px; margin:10px 0;'>";
        echo "<h3>Profil Karyawan Tetap</h3>";
        $this->tampilInfoDasar();
        echo "<strong>Jenis Karyawan:</strong> Tetap<br>";
        echo "<strong>Tunjangan Kesehatan:</strong> Rp " . number_format($this->tunjangan_kesehatan, 0, ',', '.') . "<br>";
        echo "<strong>Opsi Saham ID:</strong> " . $this->opsi_saham_id . "<br>";
        echo "<strong>Gaji Dasar (Hari x Gaji):</strong> Rp " . number_format($this->hari_kerja_masuk * $this->gaji_dasar_per_hari, 0, ',', '.') . "<br>";
        echo "<strong style='color:green;'>Gaji Bersih + Tunjangan:</strong> Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "</div>";
    }
}
?>