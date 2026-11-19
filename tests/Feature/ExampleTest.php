<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_halaman_awal_tamu_diarahkan_ke_login(): void
    {
        $this->get('/')->assertRedirect('/login');
    }

    public function test_user_yang_sudah_login_tidak_melihat_halaman_login(): void
    {
        // User ini tidak disimpan ke database; cukup untuk simulasi sudah login
        $user = new User(['email' => 'tes@contoh.test', 'nama' => 'Tes']);

        $this->actingAs($user)->get('/login')->assertRedirect(route('dashboard'));
    }
}