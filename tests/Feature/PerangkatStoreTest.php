<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\DatabaseTestCase;

class PerangkatStoreTest extends DatabaseTestCase
{
    private function dataValid(array $ganti = []): array
    {
        return array_merge([
            'nama_perangkat'   => 'AC Kamar',
            'daya'             => '900',
            'waktu_penggunaan' => '8',
            'tarif_listrik'    => '1444',
        ], $ganti);
    }

    public function test_nama_route_input_perangkat(): void
    {
        $this->assertSame(url('/add-device'), route('add-device.store'));
        $this->assertSame(url('/add-device/reset'), route('add-device.reset'));
    }

    public function test_tamu_diarahkan_ke_login_dan_tidak_menyimpan(): void
    {
        $this->post('/add-device', $this->dataValid())->assertRedirect(route('login'));

        $this->assertSame(0, Perangkat::count());
    }

    public function test_perangkat_tersimpan_dengan_data_yang_benar(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/add-device', $this->dataValid())
            ->assertRedirect(route('add-device'))
            ->assertSessionHas('success')
            ->assertSessionHasNoErrors();

        $p = Perangkat::where('email', $user->email)->first();

        $this->assertNotNull($p);
        $this->assertSame('AC Kamar', $p->nama_perangkat);
        $this->assertEqualsWithDelta(900.0, $p->daya, 0.0001);
        $this->assertEqualsWithDelta(8.0, $p->waktu_penggunaan, 0.0001);
        $this->assertEqualsWithDelta(1444.0, $p->tarif_listrik, 0.0001);
        $this->assertEqualsWithDelta(7.2, $p->kwh, 0.0001);                // 900 W x 8 jam / 1000
        $this->assertSame(now()->toDateString(), $p->tanggal_input);
    }

    public function test_email_dan_kwh_kiriman_klien_diabaikan(): void
    {
        $user = User::factory()->create();
        $lain = User::factory()->create();

        $this->actingAs($user)->post('/add-device', $this->dataValid([
            'email' => $lain->email,
            'kwh'   => '999',
        ]));

        $this->assertSame(1, Perangkat::where('email', $user->email)->count());
        $this->assertSame(0, Perangkat::where('email', $lain->email)->count());
        $this->assertEqualsWithDelta(7.2, Perangkat::first()->kwh, 0.0001);
    }

    public function test_angka_desimal_dengan_koma_diterima(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/add-device', $this->dataValid([
                'daya' => '1000', 'waktu_penggunaan' => '1,5', 'tarif_listrik' => '1444,5',
            ]))
            ->assertSessionHasNoErrors();

        $p = Perangkat::where('email', $user->email)->first();

        $this->assertEqualsWithDelta(1.5, $p->waktu_penggunaan, 0.0001);
        $this->assertEqualsWithDelta(1.5, $p->kwh, 0.0001);                // 1000 W x 1,5 jam / 1000
        $this->assertEqualsWithDelta(1444.5, $p->tarif_listrik, 0.0001);
    }

    public static function dataTidakValid(): array
    {
        return [
            'nama kosong'          => ['nama_perangkat', ''],
            'nama terlalu pendek'  => ['nama_perangkat', 'A'],
            'nama terlalu panjang' => ['nama_perangkat', str_repeat('a', 101)],
            'daya kosong'          => ['daya', ''],
            'daya bukan angka'     => ['daya', 'abc'],
            'daya nol'             => ['daya', '0'],
            'daya negatif'         => ['daya', '-5'],
            'daya terlalu besar'   => ['daya', '100001'],
            'jam kosong'           => ['waktu_penggunaan', ''],
            'jam bukan angka'      => ['waktu_penggunaan', 'abc'],
            'jam nol'              => ['waktu_penggunaan', '0'],
            'jam lebih dari 24'    => ['waktu_penggunaan', '24.5'],
            'tarif kosong'         => ['tarif_listrik', ''],
            'tarif bukan angka'    => ['tarif_listrik', 'abc'],
            'tarif nol'            => ['tarif_listrik', '0'],
            'tarif negatif'        => ['tarif_listrik', '-100'],
        ];
    }

    #[DataProvider('dataTidakValid')]
    public function test_data_tidak_valid_ditolak_dengan_notifikasi(string $kolom, string $nilai): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/add-device', $this->dataValid([$kolom => $nilai]))
            ->assertRedirect(route('add-device'))
            ->assertSessionHasErrors($kolom)
            ->assertSessionHas('error', 'Data tidak valid. Periksa kembali isian Anda.');

        $this->assertSame(0, Perangkat::count());
        $this->assertSame(0, HasilKalkulasi::count());
    }

    public function test_isian_lama_dikembalikan_saat_data_tidak_valid(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/add-device', $this->dataValid(['nama_perangkat' => 'Kulkas', 'daya' => 'abc']))
            ->assertSessionHasInput('nama_perangkat', 'Kulkas');
    }

    public function test_simpan_memperbarui_hasil_kalkulasi_bulan_ini_untuk_semua_perangkat(): void
    {
        $user = User::factory()->create();

        // Perangkat lama (belum punya hasil kalkulasi): 1 kWh/hari x 30 x Rp1.000 = Rp30.000
        Perangkat::factory()->create([
            'email' => $user->email, 'daya' => 1000, 'waktu_penggunaan' => 1, 'tarif_listrik' => 1000,
        ]);

        // Perangkat baru lewat form: 2 kWh/hari x 30 x Rp1.000 = Rp60.000
        $this->actingAs($user)->post('/add-device', $this->dataValid([
            'daya' => '2000', 'waktu_penggunaan' => '1', 'tarif_listrik' => '1000',
        ]));

        $biaya = HasilKalkulasi::biayaPeriode($user->email, HasilKalkulasi::periodeBulan());

        $this->assertEqualsWithDelta(90000.0, $biaya, 0.01);
        $this->assertSame(2, HasilKalkulasi::where('email', $user->email)->count());
    }

    public function test_reset_membersihkan_isian_lama_dan_memberi_notifikasi(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['_old_input' => ['nama_perangkat' => 'Sisa isian']])
            ->get('/add-device/reset')
            ->assertRedirect(route('add-device'))
            ->assertSessionHas('info')
            ->assertSessionMissing('_old_input');
    }

    public function test_reset_untuk_tamu_diarahkan_ke_login(): void
    {
        $this->get('/add-device/reset')->assertRedirect(route('login'));
    }
}