<?php

namespace Tests\Feature;

use App\Models\Perangkat;
use App\Models\User;
use Tests\DatabaseTestCase;

class DashboardStatistikTest extends DatabaseTestCase
{
    public function test_email_tanpa_perangkat_menghasilkan_nol(): void
    {
        $hasil = Perangkat::statistik('tidak-ada@contoh.test');

        $this->assertSame(0, $hasil['total_perangkat']);
        $this->assertEqualsWithDelta(0.0, $hasil['kwh_bulanan'], 0.0001);
        $this->assertEqualsWithDelta(0.0, $hasil['biaya_bulanan'], 0.0001);
    }

    public function test_statistik_dihitung_dari_perangkat_milik_user(): void
    {
        $user = User::factory()->create();

        // 1000 W x 5 jam = 5 kWh/hari ; 100 W x 10 jam = 1 kWh/hari
        Perangkat::factory()->create(['email' => $user->email, 'daya' => 1000, 'waktu_penggunaan' => 5,  'tarif_listrik' => 1000]);
        Perangkat::factory()->create(['email' => $user->email, 'daya' => 100,  'waktu_penggunaan' => 10, 'tarif_listrik' => 1000]);

        $hasil = Perangkat::statistik($user->email);

        $this->assertSame(2, $hasil['total_perangkat']);
        $this->assertEqualsWithDelta(6.0, $hasil['kwh_harian'], 0.001);         // 5 + 1 kWh per hari
        $this->assertEqualsWithDelta(180.0, $hasil['kwh_bulanan'], 0.001);      // (5 + 1) x 30 hari
        $this->assertEqualsWithDelta(180000.0, $hasil['biaya_bulanan'], 0.01);  // 180 kWh x Rp1.000
    }

    public function test_data_user_lain_tidak_ikut_terhitung(): void
    {
        $a = User::factory()->create();
        $b = User::factory()->create();

        Perangkat::factory()->create(['email' => $a->email, 'daya' => 1000, 'waktu_penggunaan' => 1]); // 1 kWh/hari
        Perangkat::factory()->count(3)->create(['email' => $b->email]);

        $hasil = Perangkat::statistik($a->email);

        $this->assertSame(1, $hasil['total_perangkat']);
        $this->assertEqualsWithDelta(30.0, $hasil['kwh_bulanan'], 0.001);
    }

    public function test_jumlah_hari_per_bulan_mengikuti_konfigurasi(): void
    {
        config(['dashboard.hari_per_bulan' => 31]);

        $user = User::factory()->create();
        Perangkat::factory()->create(['email' => $user->email, 'daya' => 1000, 'waktu_penggunaan' => 1]); // 1 kWh/hari

        $hasil = Perangkat::statistik($user->email);

        $this->assertEqualsWithDelta(31.0, $hasil['kwh_bulanan'], 0.001);
    }

    public function test_accessor_kwh_dan_biaya_bulanan_pada_model(): void
    {
        // make() tidak menyimpan ke database
        $p = Perangkat::factory()->make([
            'email' => 'x@contoh.test', 'daya' => 1000, 'waktu_penggunaan' => 2, 'tarif_listrik' => 1500,
        ]);

        $this->assertEqualsWithDelta(2.0, $p->kwh, 0.0001);             // 1000 W x 2 jam / 1000
        $this->assertEqualsWithDelta(60.0, $p->kwh_bulanan, 0.0001);    // x 30 hari
        $this->assertEqualsWithDelta(90000.0, $p->biaya_bulanan, 0.01); // 60 kWh x Rp1.500
    }

    public function test_factory_menghitung_kwh_otomatis_dari_daya_dan_jam(): void
    {
        $p = Perangkat::factory()->make(['email' => 'x@contoh.test', 'daya' => 500, 'waktu_penggunaan' => 4]);

        $this->assertEqualsWithDelta(2.0, $p->kwh, 0.0001);
    }
}