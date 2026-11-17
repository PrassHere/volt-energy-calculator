<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\DatabaseTestCase;

class PerangkatUbahTest extends DatabaseTestCase
{
    private function perangkatMilik(User $user): Perangkat
    {
        return Perangkat::factory()->create([
            'email' => $user->email, 'nama_perangkat' => 'AC Kamar', 'daya' => 1000,
            'waktu_penggunaan' => 1, 'tarif_listrik' => 1000, 'tanggal_input' => '2026-10-01',
        ]);
    }

    private function dataBaru(array $ganti = []): array
    {
        return array_merge([
            'nama_perangkat'   => 'AC Kamar Utama',
            'daya'             => '1200',
            'waktu_penggunaan' => '2',
            'tarif_listrik'    => '1500',
        ], $ganti);
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        $p = $this->perangkatMilik(User::factory()->create());

        $this->put(route('perangkat.update', $p), $this->dataBaru())->assertRedirect(route('login'));
    }

    public function test_data_perangkat_berhasil_diubah(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)
            ->from(route('history'))
            ->put(route('perangkat.update', $p), $this->dataBaru())
            ->assertRedirect(route('history'))
            ->assertSessionHas('success')
            ->assertSessionHasNoErrors();

        $p->refresh();

        $this->assertSame('AC Kamar Utama', $p->nama_perangkat);
        $this->assertEqualsWithDelta(1200.0, $p->daya, 0.0001);
        $this->assertEqualsWithDelta(2.0, $p->waktu_penggunaan, 0.0001);
        $this->assertEqualsWithDelta(1500.0, $p->tarif_listrik, 0.0001);
        $this->assertEqualsWithDelta(2.4, $p->kwh, 0.0001);   // 1200 W x 2 jam / 1000
    }

    public function test_kwh_dan_email_kiriman_klien_diabaikan(): void
    {
        $user = User::factory()->create();
        $lain = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)->put(route('perangkat.update', $p), $this->dataBaru([
            'kwh' => '999', 'email' => $lain->email,
        ]));

        $p->refresh();

        $this->assertEqualsWithDelta(2.4, $p->kwh, 0.0001);
        $this->assertSame($user->email, $p->email);
    }

    public function test_tanggal_input_tidak_berubah(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)->put(route('perangkat.update', $p), $this->dataBaru());

        $this->assertSame('2026-10-01', $p->refresh()->tanggal_input);
    }

    public function test_hasil_kalkulasi_ikut_diperbarui(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)->put(route('perangkat.update', $p), $this->dataBaru());

        $h = HasilKalkulasi::where('id_perangkat', $p->id_perangkat)->first();

        $this->assertNotNull($h);
        $this->assertEqualsWithDelta(108000.0, $h->biaya_perangkat, 0.01);   // 2,4 kWh x 30 x Rp1.500
    }

    public function test_kembali_ke_halaman_asal_beserta_filter(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)
            ->from('/history?page=2&q=ac')
            ->put(route('perangkat.update', $p), $this->dataBaru())
            ->assertRedirect('/history?page=2&q=ac');
    }

    public function test_perangkat_milik_orang_lain_ditolak(): void
    {
        $pemilik = User::factory()->create();
        $penyusup = User::factory()->create();
        $p       = $this->perangkatMilik($pemilik);

        $this->actingAs($penyusup)
            ->put(route('perangkat.update', $p), $this->dataBaru())
            ->assertForbidden();

        $this->assertSame('AC Kamar', $p->refresh()->nama_perangkat);
    }

    public function test_perangkat_yang_tidak_ada_menghasilkan_404(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->put(route('perangkat.update', 99999), $this->dataBaru())
            ->assertNotFound();
    }

    public static function dataTidakValid(): array
    {
        return [
            'nama kosong'     => ['nama_perangkat', ''],
            'daya nol'        => ['daya', '0'],
            'jam lebih dari 24' => ['waktu_penggunaan', '25'],
            'tarif nol'       => ['tarif_listrik', '0'],
        ];
    }

    #[DataProvider('dataTidakValid')]
    public function test_data_tidak_valid_ditolak_dan_data_tidak_berubah(string $kolom, string $nilai): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)
            ->put(route('perangkat.update', $p), $this->dataBaru([$kolom => $nilai]))
            ->assertRedirect(route('history'))
            ->assertSessionHasErrors($kolom)
            ->assertSessionHas('error', 'Data tidak valid. Periksa kembali isian Anda.');

        $this->assertSame('AC Kamar', $p->refresh()->nama_perangkat);
        $this->assertEqualsWithDelta(1000.0, $p->daya, 0.0001);
    }

    public function test_angka_desimal_dengan_koma_diterima(): void
    {
        $user = User::factory()->create();
        $p    = $this->perangkatMilik($user);

        $this->actingAs($user)
            ->put(route('perangkat.update', $p), $this->dataBaru([
                'daya' => '1000', 'waktu_penggunaan' => '1,5', 'tarif_listrik' => '1000',
            ]))
            ->assertSessionHasNoErrors();

        $this->assertEqualsWithDelta(1.5, $p->refresh()->kwh, 0.0001);
    }
}