<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tests\DatabaseTestCase;

class HasilKalkulasiTest extends DatabaseTestCase
{
    private function catat(User $user, Perangkat $perangkat, string $periode, float $biaya): HasilKalkulasi
    {
        return HasilKalkulasi::factory()->create([
            'email'           => $user->email,
            'id_perangkat'    => $perangkat->id_perangkat,
            'periode'         => $periode,
            'biaya_perangkat' => $biaya,
            'total_biaya'     => $biaya,
        ]);
    }

    public function test_periode_bulan_berformat_tahun_bulan(): void
    {
        $this->assertSame('2026-10', HasilKalkulasi::periodeBulan(Carbon::parse('2026-10-28')));
        $this->assertSame('2027-01', HasilKalkulasi::periodeBulan(Carbon::parse('2027-01-05')));
    }

    public function test_biaya_periode_null_jika_belum_ada_hasil(): void
    {
        $this->assertNull(HasilKalkulasi::biayaPeriode('tidak-ada@contoh.test', '2026-10'));
    }

    public function test_biaya_periode_menjumlah_biaya_semua_perangkat(): void
    {
        $user = User::factory()->create();
        $a    = Perangkat::factory()->create(['email' => $user->email]);
        $b    = Perangkat::factory()->create(['email' => $user->email]);

        $this->catat($user, $a, '2026-10', 100000.50);
        $this->catat($user, $b, '2026-10', 50000.25);

        $this->assertEqualsWithDelta(150000.75, HasilKalkulasi::biayaPeriode($user->email, '2026-10'), 0.01);
    }

    public function test_periode_lain_dan_user_lain_tidak_ikut_terhitung(): void
    {
        $a  = User::factory()->create();
        $b  = User::factory()->create();
        $pa = Perangkat::factory()->create(['email' => $a->email]);
        $pb = Perangkat::factory()->create(['email' => $b->email]);

        $this->catat($a, $pa, '2026-10', 1000);
        $this->catat($a, $pa, '2026-09', 9999);   // periode lain
        $this->catat($b, $pb, '2026-10', 5555);   // user lain

        $this->assertEqualsWithDelta(1000.0, HasilKalkulasi::biayaPeriode($a->email, '2026-10'), 0.01);
        $this->assertNull(HasilKalkulasi::biayaPeriode($a->email, '2026-08'));
    }

    public function test_relasi_hasil_ke_perangkat_dan_user(): void
    {
        $user  = User::factory()->create();
        $p     = Perangkat::factory()->create(['email' => $user->email]);
        $hasil = $this->catat($user, $p, '2026-10', 1000);

        $this->assertSame($p->id_perangkat, $hasil->perangkat->id_perangkat);
        $this->assertSame($user->email, $hasil->user->email);
        $this->assertCount(1, $p->hasilKalkulasis);
    }
}