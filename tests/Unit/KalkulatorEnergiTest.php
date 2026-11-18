<?php

namespace Tests\Unit;

use App\Models\Perangkat;
use App\Support\KalkulatorEnergi;
use Tests\TestCase;

class KalkulatorEnergiTest extends TestCase
{
    public function test_kwh_harian_adalah_watt_kali_jam_dibagi_seribu(): void
    {
        $this->assertEqualsWithDelta(7.2, KalkulatorEnergi::kwhHarian(900, 8), 0.00001);
        $this->assertEqualsWithDelta(1.0, KalkulatorEnergi::kwhHarian(1000, 1), 0.00001);
    }

    public function test_kwh_dibulatkan_empat_desimal(): void
    {
        $this->assertEqualsWithDelta(0.0333, KalkulatorEnergi::kwhHarian(33.333, 1), 0.000001);
    }

    public function test_rincian_kwh_harian_mingguan_dan_bulanan(): void
    {
        $h = KalkulatorEnergi::hitung(900, 8, 1444);

        $this->assertEqualsWithDelta(7.2, $h['kwh']['harian'], 0.0001);
        $this->assertEqualsWithDelta(50.4, $h['kwh']['mingguan'], 0.0001);   // x 7 hari
        $this->assertEqualsWithDelta(216.0, $h['kwh']['bulanan'], 0.0001);   // x 30 hari
    }

    public function test_biaya_harian_mingguan_dan_bulanan(): void
    {
        $h = KalkulatorEnergi::hitung(900, 8, 1444);

        $this->assertEqualsWithDelta(10396.8, $h['biaya']['harian'], 0.01);    // 7,2 kWh x Rp1.444
        $this->assertEqualsWithDelta(72777.6, $h['biaya']['mingguan'], 0.01);  // 50,4 kWh x Rp1.444
        $this->assertEqualsWithDelta(311904.0, $h['biaya']['bulanan'], 0.01);  // 216 kWh x Rp1.444
    }

    public function test_contoh_sederhana_seribu_watt_satu_jam_tarif_seribu(): void
    {
        $h = KalkulatorEnergi::hitung(1000, 1, 1000);

        $this->assertEqualsWithDelta(1.0, $h['kwh']['harian'], 0.0001);
        $this->assertEqualsWithDelta(1000.0, $h['biaya']['harian'], 0.01);
        $this->assertEqualsWithDelta(7000.0, $h['biaya']['mingguan'], 0.01);
        $this->assertEqualsWithDelta(30000.0, $h['biaya']['bulanan'], 0.01);
    }

    public function test_jumlah_hari_per_bulan_mengikuti_konfigurasi(): void
    {
        config(['dashboard.hari_per_bulan' => 31]);

        $h = KalkulatorEnergi::hitung(1000, 1, 1000);

        $this->assertEqualsWithDelta(31.0, $h['kwh']['bulanan'], 0.0001);
        $this->assertEqualsWithDelta(31000.0, $h['biaya']['bulanan'], 0.01);
    }

    public function test_perangkat_berdaya_kecil_tetap_terhitung(): void
    {
        $h = KalkulatorEnergi::hitung(10, 1.5, 1444);

        $this->assertEqualsWithDelta(0.015, $h['kwh']['harian'], 0.00001);
        $this->assertEqualsWithDelta(21.66, $h['biaya']['harian'], 0.01);
        $this->assertEqualsWithDelta(649.8, $h['biaya']['bulanan'], 0.01);
    }

    public function test_konsisten_dengan_biaya_bulanan_pada_model_perangkat(): void
    {
        // make() tidak menyimpan ke database
        $p = Perangkat::factory()->make([
            'email' => 'x@contoh.test', 'daya' => 900, 'waktu_penggunaan' => 8, 'tarif_listrik' => 1444,
        ]);

        $h = KalkulatorEnergi::rincian($p->kwh, $p->tarif_listrik);

        $this->assertEqualsWithDelta($p->biaya_bulanan, $h['biaya']['bulanan'], 0.01);
    }
}