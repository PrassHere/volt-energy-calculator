<?php

namespace Tests\Feature;

use App\Models\TipsHematEnergi;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Tests\DatabaseTestCase;

class AdminTipsTest extends DatabaseTestCase
{
    private function adminUser(): User
    {
        $this->seed(AdminUserSeeder::class);
        return User::where('email', 'admin@gmail.com')->first();
    }

    public function test_admin_berhasil_login_dengan_kredensial_yang_ditentukan(): void
    {
        $this->seed(AdminUserSeeder::class);

        $response = $this->post(route('login.process'), [
            'email'    => 'admin@gmail.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.tips'));
        $this->assertAuthenticated();
        $this->assertSame('admin@gmail.com', auth()->user()->email);
    }

    public function test_admin_mengakses_dashboard_diarahkan_ke_kelola_tips(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertRedirect(route('admin.tips'));
    }

    public function test_sidebar_admin_hanya_menampilkan_kelola_tips_dan_tidak_menampilkan_menu_lain(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->get(route('admin.tips'))
            ->assertOk()
            ->assertSee('Kelola Tips')
            ->assertDontSee('Halaman Utama')
            ->assertDontSee('Tambah Perangkat')
            ->assertDontSee('Grafik Analisis')
            ->assertDontSee('Riwayat')
            ->assertDontSee('Eco Tips');
    }

    public function test_sidebar_pengguna_biasa_menampilkan_menu_lengkap_dan_tidak_ada_kelola_tips(): void
    {
        $userBiasa = User::factory()->create(['email' => 'pengguna@gmail.com']);

        $this->actingAs($userBiasa)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Halaman Utama')
            ->assertSee('Tambah Perangkat')
            ->assertSee('Grafik Analisis')
            ->assertSee('Riwayat')
            ->assertSee('Eco Tips')
            ->assertDontSee('Kelola Tips');
    }

    public function test_tamu_diarahkan_ke_login_saat_mengakses_admin_tips(): void
    {
        $this->get(route('admin.tips'))->assertRedirect(route('login'));
    }

    public function test_user_bukan_admin_ditolak_dengan_status_403(): void
    {
        $userBiasa = User::factory()->create(['email' => 'userbiasa@gmail.com']);

        $this->actingAs($userBiasa)
            ->get(route('admin.tips'))
            ->assertForbidden();
    }

    public function test_admin_bisa_mengakses_halaman_kelola_tips(): void
    {
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->get(route('admin.tips'))
            ->assertOk()
            ->assertViewIs('pages.admin-tips')
            ->assertSee('Kelola Tips Hemat Energi')
            ->assertSee('Form Tips');
    }

    public function test_admin_bisa_menambah_tips_baru(): void
    {
        $admin = $this->adminUser();

        $response = $this->actingAs($admin)
            ->post(route('admin.tips.store'), [
                'title'       => 'Matikan Lampu Saat Tidur',
                'category'    => 'Pencahayaan',
                'savings'     => 'Hemat Rp20.000 / bulan',
                'description' => 'Mematikan lampu saat tidur tidak hanya menghemat listrik tetapi juga meningkatkan kualitas tidur.',
                'featured'    => '1',
            ]);

        $response->assertRedirect(route('admin.tips'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('tips_hemat_energis', [
            'judul_tips'  => 'Matikan Lampu Saat Tidur',
            'kategori'    => 'Pencahayaan',
            'is_featured' => 1,
        ]);
    }

    public function test_admin_bisa_mengubah_tips(): void
    {
        $admin = $this->adminUser();
        $tip = TipsHematEnergi::create([
            'judul_tips' => 'Tips Lama',
            'konten'     => 'Konten lama',
            'kategori'   => 'Lainnya',
        ]);

        $response = $this->actingAs($admin)
            ->put(route('admin.tips.update', $tip), [
                'title'       => 'Tips Baru Diperbarui',
                'description' => 'Konten baru yang sudah diperbarui.',
                'category'    => 'Efisiensi',
            ]);

        $response->assertRedirect(route('admin.tips'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('tips_hemat_energis', [
            'id_tips'    => $tip->id_tips,
            'judul_tips' => 'Tips Baru Diperbarui',
            'kategori'   => 'Efisiensi',
        ]);
    }

    public function test_admin_bisa_menghapus_tips(): void
    {
        $admin = $this->adminUser();
        $tip = TipsHematEnergi::create([
            'judul_tips' => 'Tips Yang Mau Dihapus',
            'konten'     => 'Akan dihapus',
        ]);

        $response = $this->actingAs($admin)
            ->delete(route('admin.tips.destroy', $tip));

        $response->assertRedirect(route('admin.tips'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('tips_hemat_energis', [
            'id_tips' => $tip->id_tips,
        ]);
    }

    public function test_filter_dan_pencarian_admin_tips(): void
    {
        $admin = $this->adminUser();
        TipsHematEnergi::create([
            'judul_tips' => 'Optimasi AC',
            'konten'     => 'Gunakan timer AC',
            'kategori'   => 'Efisiensi',
        ]);
        TipsHematEnergi::create([
            'judul_tips' => 'Lampu LED',
            'konten'     => 'Ganti lampu pijar',
            'kategori'   => 'Pencahayaan',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.tips', ['search' => 'Timer']))
            ->assertOk()
            ->assertSee('Optimasi AC')
            ->assertDontSee('Lampu LED');
    }
}
