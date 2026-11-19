<?php

namespace Tests\Feature;

use App\Models\Perangkat;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Concerns\PakaiViewPalsu;
use Tests\DatabaseTestCase;

class RiwayatIndexTest extends DatabaseTestCase
{
    use PakaiViewPalsu;

    private function buat(User $user, string $nama, float $daya, float $jam, float $tarif, string $tanggal): void
    {
        Perangkat::factory()->create([
            'email' => $user->email, 'nama_perangkat' => $nama, 'daya' => $daya,
            'waktu_penggunaan' => $jam, 'tarif_listrik' => $tarif, 'tanggal_input' => $tanggal,
        ]);
    }

    private function userDenganTigaPerangkat(): User
    {
        $user = User::factory()->create();

        $this->buat($user, 'AC Kamar', 1000, 1, 1000, '2026-10-01');
        $this->buat($user, 'AC Ruang Tamu', 2000, 1, 1000, '2026-10-10');
        $this->buat($user, 'Kulkas', 500, 2, 2500, '2026-10-20');

        return $user;
    }

    public function test_nama_route_riwayat(): void
    {
        $this->assertSame(url('/history'), route('history'));
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $this->get('/history')->assertRedirect(route('login'));
    }

    public function test_menampilkan_perangkat_milik_user(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->sebagai($user)
            ->get('/history')
            ->assertOk()
            ->assertViewIs('pages.history')
            ->assertViewHas('daftar', fn ($d) => $d->total() === 3);
    }

    public function test_perangkat_user_lain_tidak_tampil(): void
    {
        $user = $this->userDenganTigaPerangkat();
        $this->userDenganTigaPerangkat();

        $this->sebagai($user)
            ->get('/history')
            ->assertViewHas('daftar', fn ($d) => $d->total() === 3);
    }

    public function test_pencarian_lewat_query_string(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->sebagai($user)
            ->get('/history?q=ac')
            ->assertOk()
            ->assertViewHas('daftar', fn ($d) => $d->total() === 2)
            ->assertViewHas('total', fn ($t) => $t['jumlah_perangkat'] === 2);
    }

    public function test_filter_tanggal_lewat_query_string(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->sebagai($user)
            ->get('/history?dari=2026-10-05&sampai=2026-10-15')
            ->assertViewHas('daftar', fn ($d) => $d->total() === 1);
    }

    public function test_pagination_halaman_terakhir(): void
    {
        $user = User::factory()->create();
        Perangkat::factory()->count(12)->create(['email' => $user->email]);

        $this->sebagai($user)
            ->get('/history?per_halaman=5&page=3')
            ->assertOk()
            ->assertViewHas('daftar', fn ($d) => $d->currentPage() === 3
                && $d->lastPage() === 3
                && count($d->items()) === 2
                && $d->total() === 12);
    }

    public function test_tautan_halaman_membawa_filter(): void
    {
        $user = User::factory()->create();
        Perangkat::factory()->count(3)->create(['email' => $user->email, 'nama_perangkat' => 'AC Kamar']);

        $this->sebagai($user)
            ->get('/history?q=ac&per_halaman=5')
            ->assertViewHas('daftar', fn ($d) => $d->total() === 3);

        $this->sebagai($user)
            ->get('/history?q=ac&per_halaman=5&page=1')
            ->assertViewHas('daftar', fn ($d) => str_contains((string) $d->url(2), 'q=ac'));
    }

    public function test_filter_bawaan_dikirim_ke_view(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->sebagai($user)
            ->get('/history')
            ->assertViewHas('filter', fn ($f) => $f['urut'] === 'tanggal'
                && $f['arah'] === 'desc'
                && $f['per_halaman'] === 10
                && $f['q'] === null);
    }

    public function test_total_rekap_dikirim_ke_view(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->sebagai($user)
            ->get('/history')
            ->assertViewHas('total', fn ($t) => $t['jumlah_perangkat'] === 3
                && abs($t['kwh']['harian'] - 4.0) < 0.0001
                && abs($t['biaya']['bulanan'] - 165000.0) < 0.01);
    }

    public static function dataFilterTidakValid(): array
    {
        return [
            'urut tidak dikenal'          => ['urut', 'abc'],
            'arah tidak dikenal'          => ['arah', 'naik'],
            'jumlah per halaman salah'    => ['per_halaman', '7'],
            'tanggal awal bukan tanggal'  => ['dari', 'kemarin'],
            'tanggal akhir salah format'  => ['sampai', '31-12-2026'],
            'kata kunci terlalu panjang'  => ['q', str_repeat('a', 101)],
            'halaman nol'                 => ['page', '0'],
        ];
    }

    #[DataProvider('dataFilterTidakValid')]
    public function test_filter_tidak_valid_ditolak_dengan_notifikasi(string $kolom, string $nilai): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->sebagai($user)
            ->get('/history?' . http_build_query([$kolom => $nilai]))
            ->assertRedirect(route('history'))
            ->assertSessionHasErrors($kolom)
            ->assertSessionHas('error', 'Filter tidak valid. Periksa kembali isian Anda.');
    }

    public function test_tanggal_akhir_sebelum_tanggal_awal_ditolak(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->sebagai($user)
            ->get('/history?dari=2026-10-20&sampai=2026-10-01')
            ->assertRedirect(route('history'))
            ->assertSessionHasErrors('sampai');
    }

    public function test_ekspor_riwayat_berhasil_menghasilkan_file_csv(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $response = $this->actingAs($user)
            ->get(route('history.export'))
            ->assertOk();

        $this->assertStringContainsString('text/csv', (string) $response->headers->get('Content-Type'));
        $this->assertStringContainsString('attachment;', (string) $response->headers->get('Content-Disposition'));
    }

    public function test_tampilan_riwayat_asli_berhasil_dirender(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->actingAs($user)
            ->get('/history')
            ->assertOk()
            ->assertSee('Riwayat Perangkat')
            ->assertSee('AC Kamar')
            ->assertSee('modalEdit')
            ->assertSee('modalDelete');
    }
}