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
    
    
    public function hitungGajiBersih() {
        $gaji_kotor = $this->hitungGajiKotor();
        $potongan_bpjs = $gaji_kotor * 0.025; // Potongan BPJS 2.5%
        return ($gaji_kotor - $potongan_bpjs) + $this->tunjangan_kesehatan;
    }
   
    public function tampilProfilKaryawan() {
        echo "<div style='border:1px solid #4CAF50; padding:10px; margin:10px 0;'>";
        echo "<h3>Profil Karyawan Tetap</h3>";
        $this->tampilInfoDasar();
        echo "<strong>Jenis Karyawan:</strong> Tetap<br>";
        echo "<strong>Tunjangan Kesehatan:</strong> Rp " . number_format($this->tunjangan_kesehatan, 0, ',', '.') . "<br>";
        echo "<strong>Opsi Saham ID:</strong> " . $this->opsi_saham_id . "<br>";
        echo "<strong>Gaji Kotor:</strong> Rp " . number_format($this->hitungGajiKotor(), 0, ',', '.') . "<br>";
        echo "<strong>Potongan BPJS (2.5%):</strong> Rp " . number_format($this->hitungGajiKotor() * 0.025, 0, ',', '.') . "<br>";
        echo "<strong style='color:green;'>Gaji Bersih:</strong> Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "</div>";
    }
}
?>