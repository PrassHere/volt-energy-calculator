<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Tests\DatabaseTestCase;

class HasilKalkulasiSimpanTest extends DatabaseTestCase
{
    public function test_tabel_punya_kolom_kwh_durasi_dan_tanggal_input(): void
    {
        $this->assertTrue(Schema::hasColumns('hasil_kalkulasis', ['kwh', 'durasi', 'tanggal_input']));
    }

    public function test_hitung_ulang_mengisi_kwh_durasi_biaya_dan_tanggal_input(): void
    {
        $user = User::factory()->create();
        Perangkat::factory()->create([
            'email' => $user->email, 'daya' => 1000, 'waktu_penggunaan' => 2, 'tarif_listrik' => 1000,
        ]);

        HasilKalkulasi::hitungUlang($user->email, '2026-10', Carbon::parse('2026-10-28'));

        $h = HasilKalkulasi::where('email', $user->email)->first();

        $this->assertEqualsWithDelta(2.0, $h->kwh, 0.0001);                  // 1000 W x 2 jam / 1000
        $this->assertEqualsWithDelta(2.0, $h->durasi, 0.0001);               // jam per hari
        $this->assertEqualsWithDelta(60000.0, $h->biaya_perangkat, 0.01);    // 2 kWh x 30 hari x Rp1.000
        $this->assertSame('2026-10', $h->periode);
        $this->assertSame('2026-10-28', $h->tanggal_input);
    }

    public function test_hitung_ulang_mengembalikan_jumlah_perangkat(): void
    {
        $user = User::factory()->create();
        Perangkat::factory()->count(3)->create(['email' => $user->email]);

        $this->assertSame(3, HasilKalkulasi::hitungUlang($user->email));
        $this->assertSame(0, HasilKalkulasi::hitungUlang('tidak-ada@contoh.test'));
    }

    public function test_accessor_biaya_harian_dan_mingguan(): void
    {
        $user = User::factory()->create();
        $p    = Perangkat::factory()->create(['email' => $user->email]);

        $h = HasilKalkulasi::factory()->create([
            'email' => $user->email, 'id_perangkat' => $p->id_perangkat,
            'periode' => '2026-10', 'biaya_perangkat' => 30000, 'total_biaya' => 30000,
        ]);

        $this->assertEqualsWithDelta(1000.0, $h->biaya_harian, 0.01);    // 30.000 / 30 hari
        $this->assertEqualsWithDelta(7000.0, $h->biaya_mingguan, 0.01);  // x 7 hari
    }

    public function test_hasil_diperbarui_saat_perangkat_berubah(): void
    {
        $user = User::factory()->create();
        $p    = Perangkat::factory()->create([
            'email' => $user->email, 'daya' => 1000, 'waktu_penggunaan' => 1, 'tarif_listrik' => 1000,
        ]);

        HasilKalkulasi::hitungUlang($user->email, '2026-10');

        $p->update(['kwh' => 3.0, 'waktu_penggunaan' => 3.0]);
        HasilKalkulasi::hitungUlang($user->email, '2026-10');

        $h = HasilKalkulasi::where('email', $user->email)->first();

        $this->assertSame(1, HasilKalkulasi::where('email', $user->email)->count());
        $this->assertEqualsWithDelta(3.0, $h->kwh, 0.0001);
        $this->assertEqualsWithDelta(3.0, $h->durasi, 0.0001);
        $this->assertEqualsWithDelta(90000.0, $h->biaya_perangkat, 0.01);   // 3 kWh x 30 x Rp1.000
    }
}