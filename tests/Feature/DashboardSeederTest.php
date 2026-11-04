<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Database\Seeders\DashboardSeeder;
use Tests\DatabaseTestCase;

class DashboardSeederTest extends DatabaseTestCase
{
    public function test_seeder_membuat_data_demo_dengan_angka_yang_diharapkan(): void
    {
        $this->seed(DashboardSeeder::class);

        $email = config('dashboard.email_demo');

        $this->assertSame(1, User::where('email', $email)->count());
        $this->assertSame(12, Perangkat::where('email', $email)->count());
        $this->assertSame(12, HasilKalkulasi::where('email', $email)->count());

        $hasil = Perangkat::statistik($email);

        $this->assertSame(12, $hasil['total_perangkat']);
        $this->assertEqualsWithDelta(15.98, $hasil['kwh_harian'], 0.001);
        $this->assertEqualsWithDelta(479.4, $hasil['kwh_bulanan'], 0.001);
        $this->assertEqualsWithDelta(692253.6, $hasil['biaya_bulanan'], 0.01);
    }

    public function test_hasil_kalkulasi_demo_cocok_dengan_perangkat(): void
    {
        $this->seed(DashboardSeeder::class);

        $email = config('dashboard.email_demo');

        $biaya = HasilKalkulasi::biayaPeriode($email, HasilKalkulasi::periodeBulan());
        $this->assertEqualsWithDelta(692253.6, $biaya, 0.01);

        foreach (HasilKalkulasi::where('email', $email)->pluck('total_biaya') as $total) {
            $this->assertEqualsWithDelta(692253.6, $total, 0.01);
        }
    }

    public function test_seeder_aman_dijalankan_berulang_kali(): void
    {
        $this->seed(DashboardSeeder::class);
        $this->seed(DashboardSeeder::class);

        $email = config('dashboard.email_demo');

        $this->assertSame(1, User::where('email', $email)->count());
        $this->assertSame(12, Perangkat::where('email', $email)->count());
        $this->assertSame(12, HasilKalkulasi::where('email', $email)->count());
    }
}