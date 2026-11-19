<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use App\Support\AnalisisEnergi;
use Tests\DatabaseTestCase;

class AnalyticsTest extends DatabaseTestCase
{
    private function userDenganPerangkat(): User
    {
        $user = User::factory()->create();

        Perangkat::factory()->create([
            'email'            => $user->email,
            'nama_perangkat'   => 'AC Kamar',
            'daya'             => 1000,
            'waktu_penggunaan' => 8,
            'tarif_listrik'    => 1500,
        ]);

        Perangkat::factory()->create([
            'email'            => $user->email,
            'nama_perangkat'   => 'Kulkas',
            'daya'             => 200,
            'waktu_penggunaan' => 24,
            'tarif_listrik'    => 1500,
        ]);

        HasilKalkulasi::hitungUlang($user->email);

        return $user;
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get(route('analytics'))->assertRedirect(route('login'));
    }

    public function test_analytics_menampilkan_ringkasan_dan_alokasi(): void
    {
        $user = $this->userDenganPerangkat();

        $response = $this->actingAs($user)
            ->get(route('analytics'))
            ->assertOk()
            ->assertViewIs('pages.analytics')
            ->assertViewHas('ringkasan', fn ($r) => $r['total_perangkat'] === 2
                && $r['kwh_harian'] > 0
                && $r['biaya_bulanan'] > 0)
            ->assertViewHas('alokasi', fn ($a) => count($a['items']) === 2
                && $a['items'][0]['persentase'] > 0)
            ->assertViewHas('kosong', false);

        $response->assertSee('AC Kamar');
        $response->assertSee('Kulkas');
    }

    public function test_analytics_user_kosong_menampilkan_pesan_kosong(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('analytics'))
            ->assertOk()
            ->assertViewHas('kosong', true)
            ->assertSee('Data Analisis Belum Tersedia');
    }

    public function test_total_biaya_per_minggu_dan_per_bulan(): void
    {
        $user = $this->userDenganPerangkat();

        $biayaMinggu = AnalisisEnergi::totalBiayaPerMinggu($user->email);
        $biayaBulan  = AnalisisEnergi::totalBiayaPerBulan($user->email);

        // AC (8 kWh) + Kulkas (4.8 kWh) = 12.8 kWh/hari
        // Biaya harian = 12.8 * 1500 = 19.200
        // Biaya mingguan = 19.200 * 7 = 134.400
        // Biaya bulanan = 19.200 * 30 = 576.000
        $this->assertEqualsWithDelta(134400.0, $biayaMinggu, 1.0);
        $this->assertEqualsWithDelta(576000.0, $biayaBulan, 1.0);
    }

    public function test_waktu_render_analytics_kurang_dari_dua_detik(): void
    {
        $user = $this->userDenganPerangkat();

        $mulai = microtime(true);
        $this->actingAs($user)->get(route('analytics'))->assertOk();
        $durasi = microtime(true) - $mulai;

        $this->assertLessThan(2.0, $durasi);
    }
}
