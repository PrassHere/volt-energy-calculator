<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Database\Seeders\DashboardSeeder;
use Illuminate\View\FileViewFinder;
use Tests\DatabaseTestCase;

class DashboardControllerTest extends DatabaseTestCase
{
    // Login sebagai $user dan pakai view palsu (tests/Stubs/views)
    // supaya test tidak bergantung pada tampilan buatan frontend
    private function sebagai(User $user): static
    {
        /** @var FileViewFinder $finder */
        $finder = app('view')->getFinder();
        $finder->prependLocation(base_path('tests/Stubs/views'));

        return $this->actingAs($user);
    }

    private function akunDemo(): User
    {
        $this->seed(DashboardSeeder::class);

        return User::find(config('dashboard.email_demo'));
    }

    public function test_nama_route_dashboard_mengarah_ke_url_dashboard(): void
    {
        $this->assertSame(url('/dashboard'), route('dashboard'));
    }

    public function test_tamu_diarahkan_ke_halaman_login(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
    }

    public function test_dashboard_tidak_boleh_disimpan_cache_browser(): void
    {
        $respons = $this->sebagai($this->akunDemo())->get('/dashboard')->assertOk();

        $this->assertStringContainsString('no-store', $respons->headers->get('Cache-Control'));
    }

    public function test_dashboard_mengirim_data_dummy_dari_seeder_ke_view(): void
    {
        $this->sebagai($this->akunDemo())
            ->get('/dashboard')
            ->assertOk()
            ->assertViewIs('dashboard')
            ->assertViewHas('kartu', fn ($k) => $k['total_perangkat'] === '12'
                && $k['kwh_bulanan'] === '479,4 kWh'
                && $k['biaya_bulanan'] === 'Rp692.254')
            ->assertViewHas('tren', fn ($t) => count($t['week']['data']) === 7
                && count($t['month']['data']) === 4
                && array_sum($t['month']['data']) > 0)
            ->assertViewHas('akunDemo', true)
            ->assertViewHas('kosong', false);
    }

    public function test_user_baru_tanpa_data_dianggap_kosong(): void
    {
        $user = User::factory()->create();

        $this->sebagai($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertViewHas('kartu', fn ($k) => $k['total_perangkat'] === '0'
                && $k['kwh_bulanan'] === '0,0 kWh'
                && $k['biaya_bulanan'] === 'Rp0')
            ->assertViewHas('tren', fn ($t) => array_sum($t['week']['data']) == 0
                && array_sum($t['month']['data']) == 0)
            ->assertViewHas('akunDemo', false)
            ->assertViewHas('kosong', true);
    }

    public function test_dashboard_hanya_memakai_data_milik_user_yang_login(): void
    {
        $this->seed(DashboardSeeder::class);   // data demo milik akun lain
        $user = User::factory()->create();     // user ini tidak punya data

        $this->sebagai($user)
            ->get('/dashboard')
            ->assertViewHas('kartu', fn ($k) => $k['total_perangkat'] === '0');
    }

    public function test_biaya_diambil_dari_hasil_kalkulasi_bulan_ini_jika_ada(): void
    {
        $user = User::factory()->create();

        // Dihitung langsung: 1 kWh x 30 hari x Rp1.000 = Rp30.000
        $p = Perangkat::factory()->create([
            'email' => $user->email, 'daya' => 1000, 'waktu_penggunaan' => 1, 'tarif_listrik' => 1000,
        ]);

        // Hasil kalkulasi tersimpan bernilai lain, untuk membuktikan sumbernya
        HasilKalkulasi::factory()->create([
            'email'           => $user->email,
            'id_perangkat'    => $p->id_perangkat,
            'periode'         => HasilKalkulasi::periodeBulan(),
            'biaya_perangkat' => 99999,
            'total_biaya'     => 99999,
        ]);

        $this->sebagai($user)
            ->get('/dashboard')
            ->assertViewHas('kartu', fn ($k) => $k['biaya_bulanan'] === 'Rp99.999'
                && $k['kwh_bulanan'] === '30,0 kWh');
    }

    public function test_biaya_dihitung_dari_perangkat_jika_belum_ada_hasil_kalkulasi(): void
    {
        $user = User::factory()->create();

        Perangkat::factory()->create([
            'email' => $user->email, 'daya' => 1000, 'waktu_penggunaan' => 1, 'tarif_listrik' => 1000,
        ]);

        $this->sebagai($user)
            ->get('/dashboard')
            ->assertViewHas('kartu', fn ($k) => $k['biaya_bulanan'] === 'Rp30.000');
    }
}