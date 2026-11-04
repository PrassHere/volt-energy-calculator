<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Tests\DatabaseTestCase;

class HasilKalkulasiHitungUlangTest extends DatabaseTestCase
{
    // Biaya bulanan = kWh/hari x 30 hari x tarif
    private function buatPerangkat(User $user, float $daya, float $jam, float $tarif): Perangkat
    {
        return Perangkat::factory()->create([
            'email' => $user->email, 'daya' => $daya, 'waktu_penggunaan' => $jam, 'tarif_listrik' => $tarif,
        ]);
    }

    public function test_membuat_satu_baris_untuk_setiap_perangkat_user(): void
    {
        $user = User::factory()->create();
        $this->buatPerangkat($user, 1000, 1, 1000); // Rp30.000
        $this->buatPerangkat($user, 2000, 1, 1000); // Rp60.000
        $this->buatPerangkat($user, 500, 2, 2000);  // Rp60.000

        HasilKalkulasi::hitungUlang($user->email, '2026-10');

        $this->assertSame(3, HasilKalkulasi::where('email', $user->email)->where('periode', '2026-10')->count());
        $this->assertEqualsWithDelta(150000.0, HasilKalkulasi::biayaPeriode($user->email, '2026-10'), 0.01);
    }

    public function test_total_biaya_semua_baris_sama_dengan_jumlah_biaya_perangkat(): void
    {
        $user = User::factory()->create();
        $this->buatPerangkat($user, 1000, 1, 1000); // Rp30.000
        $this->buatPerangkat($user, 2000, 1, 1000); // Rp60.000

        HasilKalkulasi::hitungUlang($user->email, '2026-10');

        foreach (HasilKalkulasi::where('email', $user->email)->pluck('total_biaya') as $total) {
            $this->assertEqualsWithDelta(90000.0, $total, 0.01);
        }
    }

    public function test_dipanggil_berulang_tidak_menggandakan_baris(): void
    {
        $user = User::factory()->create();
        $this->buatPerangkat($user, 1000, 1, 1000);
        $this->buatPerangkat($user, 2000, 1, 1000);

        HasilKalkulasi::hitungUlang($user->email, '2026-10');
        HasilKalkulasi::hitungUlang($user->email, '2026-10');
        HasilKalkulasi::hitungUlang($user->email, '2026-10');

        $this->assertSame(2, HasilKalkulasi::where('email', $user->email)->count());
    }

    public function test_nilai_diperbarui_jika_perangkat_berubah(): void
    {
        $user = User::factory()->create();
        $p    = $this->buatPerangkat($user, 1000, 1, 1000); // Rp30.000

        HasilKalkulasi::hitungUlang($user->email, '2026-10');
        $this->assertEqualsWithDelta(30000.0, HasilKalkulasi::biayaPeriode($user->email, '2026-10'), 0.01);

        $p->update(['kwh' => 3.0]); // 3 kWh x 30 x Rp1.000 = Rp90.000
        HasilKalkulasi::hitungUlang($user->email, '2026-10');

        $this->assertEqualsWithDelta(90000.0, HasilKalkulasi::biayaPeriode($user->email, '2026-10'), 0.01);
        $this->assertSame(1, HasilKalkulasi::where('email', $user->email)->count());
    }

    public function test_hanya_menyentuh_user_dan_periode_yang_diminta(): void
    {
        $a = User::factory()->create();
        $b = User::factory()->create();
        $this->buatPerangkat($a, 1000, 1, 1000);
        $this->buatPerangkat($b, 1000, 1, 1000);

        HasilKalkulasi::hitungUlang($a->email, '2026-10');

        $this->assertNull(HasilKalkulasi::biayaPeriode($b->email, '2026-10'));  // user lain tidak tersentuh
        $this->assertNull(HasilKalkulasi::biayaPeriode($a->email, '2026-09'));  // periode lain tidak tersentuh
    }
}