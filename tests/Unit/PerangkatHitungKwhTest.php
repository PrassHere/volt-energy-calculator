<?php

namespace Tests\Unit;

use App\Models\Perangkat;
use PHPUnit\Framework\TestCase;

class PerangkatHitungKwhTest extends TestCase
{
    public function test_kwh_adalah_daya_kali_jam_dibagi_seribu(): void
    {
        $this->assertEqualsWithDelta(7.2, Perangkat::hitungKwh(900, 8), 0.00001);
        $this->assertEqualsWithDelta(1.0, Perangkat::hitungKwh(1000, 1), 0.00001);
    }

    public function test_hasil_dibulatkan_empat_desimal(): void
    {
        $this->assertEqualsWithDelta(0.0333, Perangkat::hitungKwh(33.333, 1), 0.000001);
    }

    public function test_perangkat_berdaya_kecil_tidak_hilang_karena_pembulatan(): void
    {
        $this->assertEqualsWithDelta(0.015, Perangkat::hitungKwh(10, 1.5), 0.00001);
    }
}