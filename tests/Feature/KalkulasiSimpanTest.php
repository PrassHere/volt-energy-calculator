<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Tests\DatabaseTestCase;

class KalkulasiSimpanTest extends DatabaseTestCase
{
    // Dua perangkat: Rp30.000 + Rp60.000 per bulan = Rp90.000
    private function userDenganDuaPerangkat(): User
    {
        $user = User::factory()->create();

        Perangkat::factory()->create([
            'email' => $user->email, 'daya' => 1000, 'waktu_penggunaan' => 1, 'tarif_listrik' => 1000,
        ]);
        Perangkat::factory()->create([
            'email' => $user->email, 'daya' => 2000, 'waktu_penggunaan' => 1, 'tarif_listrik' => 1000,
        ]);

        return $user;
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->post('/kalkulasi/simpan')->assertRedirect(route('login'));
    }

    public function test_tamu_json_ditolak(): void
    {
        $this->postJson('/kalkulasi/simpan')->assertUnauthorized();
    }

    public function test_simpan_menyimpan_hasil_semua_perangkat_user(): void
    {
        $user = $this->userDenganDuaPerangkat();

        $this->actingAs($user)
            ->post('/kalkulasi/simpan')
            ->assertRedirect(route('history'))
            ->assertSessionHas('success')
            ->assertSessionHasNoErrors();

        $periode = HasilKalkulasi::periodeBulan();

        $this->assertSame(2, HasilKalkulasi::where('email', $user->email)->where('periode', $periode)->count());
        $this->assertEqualsWithDelta(90000.0, HasilKalkulasi::biayaPeriode($user->email, $periode), 0.01);

        $h = HasilKalkulasi::where('email', $user->email)->first();
        $this->assertNotNull($h->kwh);
        $this->assertNotNull($h->durasi);
        $this->assertSame(now()->toDateString(), $h->tanggal_input);
    }

    public function test_respons_json_berisi_ringkasan_penyimpanan(): void
    {
        $user = $this->userDenganDuaPerangkat();

        $this->actingAs($user)
            ->postJson('/kalkulasi/simpan')
            ->assertOk()
            ->assertJsonPath('periode', HasilKalkulasi::periodeBulan())
            ->assertJsonPath('jumlah_perangkat', 2)
            ->assertJsonPath('total_biaya', 90000);
    }

    public function test_tanpa_perangkat_ditolak_dengan_notifikasi(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/kalkulasi/simpan')
            ->assertRedirect(route('add-device'))
            ->assertSessionHasErrors('perangkat')
            ->assertSessionHas('error', 'Hasil kalkulasi tidak dapat disimpan.');

        $this->assertSame(0, HasilKalkulasi::count());
    }

    public function test_tanpa_perangkat_json_status_422(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->postJson('/kalkulasi/simpan')
            ->assertStatus(422)
            ->assertJsonValidationErrors('perangkat');
    }

    public function test_dijalankan_berulang_tidak_menggandakan_baris(): void
    {
        $user = $this->userDenganDuaPerangkat();

        $this->actingAs($user)->post('/kalkulasi/simpan');
        $this->actingAs($user)->post('/kalkulasi/simpan');

        $this->assertSame(2, HasilKalkulasi::where('email', $user->email)->count());
        $this->assertEqualsWithDelta(
            90000.0,
            HasilKalkulasi::biayaPeriode($user->email, HasilKalkulasi::periodeBulan()),
            0.01
        );
    }

    public function test_data_user_lain_tidak_tersentuh(): void
    {
        $a = $this->userDenganDuaPerangkat();
        $b = $this->userDenganDuaPerangkat();

        $this->actingAs($a)->post('/kalkulasi/simpan');

        $this->assertSame(2, HasilKalkulasi::where('email', $a->email)->count());
        $this->assertSame(0, HasilKalkulasi::where('email', $b->email)->count());
    }
}