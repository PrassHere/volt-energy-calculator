<?php

namespace Tests\Unit;

use App\Support\TrenDummy;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;

class TrenDummyTest extends TestCase
{
    // Tanggal acuan: Rabu, 28 Oktober 2026
    private function hariIni(): Carbon
    {
        return Carbon::parse('2026-10-28');
    }

    public function test_struktur_week_7_titik_dan_month_4_titik(): void
    {
        $t = TrenDummy::untuk(15.98, 'demo@contoh.test', $this->hariIni());

        $this->assertSame(['week', 'month'], array_keys($t));
        $this->assertCount(7, $t['week']['labels']);
        $this->assertCount(7, $t['week']['data']);
        $this->assertCount(4, $t['month']['labels']);
        $this->assertCount(4, $t['month']['data']);
        $this->assertSame(
            ['Minggu ke-1', 'Minggu ke-2', 'Minggu ke-3', 'Minggu ke-4'],
            $t['month']['labels']
        );
    }

    public function test_hasil_selalu_sama_untuk_masukan_yang_sama(): void
    {
        $a = TrenDummy::untuk(15.98, 'demo@contoh.test', $this->hariIni());
        $b = TrenDummy::untuk(15.98, 'demo@contoh.test', $this->hariIni());

        $this->assertSame($a, $b);
    }

    public function test_nilai_harian_berada_dalam_rentang_15_persen(): void
    {
        $kwh = 15.98;
        $t   = TrenDummy::untuk($kwh, 'demo@contoh.test', $this->hariIni());

        foreach ($t['week']['data'] as $nilai) {
            $this->assertGreaterThanOrEqual($kwh * 0.85 - 0.01, $nilai);
            $this->assertLessThanOrEqual($kwh * 1.15 + 0.01, $nilai);
        }
    }

    public function test_tanpa_perangkat_semua_nol(): void
    {
        $t = TrenDummy::untuk(0.0, 'kosong@contoh.test', $this->hariIni());

        $this->assertSame(0.0, array_sum($t['week']['data']));
        $this->assertSame(0.0, array_sum($t['month']['data']));
    }

    public function test_minggu_ke_4_sama_dengan_jumlah_week(): void
    {
        $t = TrenDummy::untuk(15.98, 'demo@contoh.test', $this->hariIni());

        $this->assertEqualsWithDelta(array_sum($t['week']['data']), $t['month']['data'][3], 0.05);
    }

    public function test_user_berbeda_mendapat_pola_berbeda(): void
    {
        $a = TrenDummy::untuk(15.98, 'a@contoh.test', $this->hariIni());
        $b = TrenDummy::untuk(15.98, 'b@contoh.test', $this->hariIni());

        $this->assertNotSame($a['week']['data'], $b['week']['data']);
    }

    public function test_label_week_berakhir_di_hari_ini(): void
    {
        $t = TrenDummy::untuk(15.98, 'demo@contoh.test', $this->hariIni());

        $this->assertStringContainsString('22', $t['week']['labels'][0]);
        $this->assertStringContainsString('28', $t['week']['labels'][6]);
        $this->assertCount(7, array_unique($t['week']['labels']));
    }
}