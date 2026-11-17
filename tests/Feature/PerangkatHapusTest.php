<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Tests\DatabaseTestCase;

class PerangkatHapusTest extends DatabaseTestCase
{
    private function perangkatMilik(User $user, string $nama = 'AC Kamar', float $daya = 1000): Perangkat
    {
        return Perangkat::factory()->create([
            'email' => $user->email, 'nama_perangkat' => $nama, 'daya' => $daya,
            'waktu_penggunaan' => 1, 'tarif_listrik' => 1000,
        ]);
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $p = $this->perangkatMilik(User::factory()->create());

        $this->delete(route('perangkat.destroy', $p), ['konfirmasi' => '1'])->assertRedirect(route('login'));

        $this->assertSame(1, Perangkat::count());
    }

    public function test_tanpa_konfirmasi_ditolak_dan_perangkat_tetap_ada(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)
            ->delete(route('perangkat.destroy', $p))
            ->assertRedirect(route('history'))
            ->assertSessionHasErrors('konfirmasi')
            ->assertSessionHas('error', 'Perangkat belum dihapus. Penghapusan harus dikonfirmasi.');

        $this->assertNotNull(Perangkat::find($p->id_perangkat));
    }

    public function test_konfirmasi_yang_salah_ditolak(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)
            ->delete(route('perangkat.destroy', $p), ['konfirmasi' => 'tidak'])
            ->assertSessionHasErrors('konfirmasi');

        $this->assertNotNull(Perangkat::find($p->id_perangkat));
    }

    public function test_dengan_konfirmasi_perangkat_dan_hasil_kalkulasinya_terhapus(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);
        HasilKalkulasi::hitungUlang($user->email);

        $this->actingAs($user)
            ->from(route('history'))
            ->delete(route('perangkat.destroy', $p), ['konfirmasi' => '1'])
            ->assertRedirect(route('history'))
            ->assertSessionHas('success')
            ->assertSessionHasNoErrors();

        $this->assertNull(Perangkat::find($p->id_perangkat));
        $this->assertSame(0, HasilKalkulasi::where('id_perangkat', $p->id_perangkat)->count());
    }

    public function test_total_hasil_kalkulasi_perangkat_lain_diperbarui(): void
    {
        $user = User::factory()->create();
        $a    = $this->perangkatMilik($user, 'AC Kamar', 1000);     // Rp30.000 per bulan
        $b    = $this->perangkatMilik($user, 'AC Ruang Tamu', 2000); // Rp60.000 per bulan
        HasilKalkulasi::hitungUlang($user->email);

        $this->actingAs($user)->delete(route('perangkat.destroy', $a), ['konfirmasi' => '1']);

        $sisa = HasilKalkulasi::where('email', $user->email)->get();

        $this->assertCount(1, $sisa);
        $this->assertSame($b->id_perangkat, $sisa->first()->id_perangkat);
        $this->assertEqualsWithDelta(60000.0, $sisa->first()->total_biaya, 0.01);   // tidak lagi 90.000
    }

    public function test_menghapus_perangkat_terakhir_tidak_menyisakan_hasil_kalkulasi(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);
        HasilKalkulasi::hitungUlang($user->email);

        $this->actingAs($user)->delete(route('perangkat.destroy', $p), ['konfirmasi' => '1']);

        $this->assertSame(0, Perangkat::where('email', $user->email)->count());
        $this->assertSame(0, HasilKalkulasi::where('email', $user->email)->count());
    }

    public function test_perangkat_milik_orang_lain_ditolak(): void
    {
        $pemilik  = User::factory()->create();
        $penyusup = User::factory()->create();
        $p        = $this->perangkatMilik($pemilik);

        $this->actingAs($penyusup)
            ->delete(route('perangkat.destroy', $p), ['konfirmasi' => '1'])
            ->assertForbidden();

        $this->assertNotNull(Perangkat::find($p->id_perangkat));
    }

    public function test_perangkat_yang_tidak_ada_menghasilkan_404(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route('perangkat.destroy', 99999), ['konfirmasi' => '1'])
            ->assertNotFound();
    }
}