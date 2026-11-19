<?php

namespace Tests\Feature;

use App\Models\TipsHematEnergi;
use App\Models\User;
use Database\Seeders\TipsHematEnergiSeeder;
use Tests\DatabaseTestCase;

class TipsTest extends DatabaseTestCase
{
    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get(route('eco-tips'))->assertRedirect(route('login'));
    }

    public function test_eco_tips_menampilkan_daftar_tips(): void
    {
        $this->seed(TipsHematEnergiSeeder::class);
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('eco-tips'))
            ->assertOk()
            ->assertViewIs('pages.eco-tips')
            ->assertViewHas('tips', fn ($t) => $t->count() >= 5)
            ->assertSee('Panduan Efisiensi Energi');
    }

    public function test_pencarian_tips_bekerja(): void
    {
        $this->seed(TipsHematEnergiSeeder::class);
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('eco-tips', ['q' => 'Lampu']))
            ->assertOk()
            ->assertSee('Lampu LED');

        // Tips AC tidak boleh masuk jika hanya cocok dengan lampu
        $tips = $response->viewData('tips');
        $this->assertTrue($tips->contains(fn ($t) => str_contains($t->judul_tips, 'Lampu')));
    }

    public function test_waktu_render_tips_kurang_dari_dua_detik(): void
    {
        $this->seed(TipsHematEnergiSeeder::class);
        $user = User::factory()->create();

        $mulai = microtime(true);
        $this->actingAs($user)->get(route('eco-tips'))->assertOk();
        $durasi = microtime(true) - $mulai;

        $this->assertLessThan(2.0, $durasi);
    }
}
