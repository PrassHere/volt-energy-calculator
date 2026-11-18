<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\DatabaseTestCase;

class KalkulasiHitungTest extends DatabaseTestCase
{
    private function dataValid(array $ganti = []): array
    {
        return array_merge([
            'daya'             => '900',
            'waktu_penggunaan' => '8',
            'tarif_listrik'    => '1444',
        ], $ganti);
    }

    public function test_nama_route_kalkulasi(): void
    {
        $this->assertSame(url('/kalkulasi/hitung'), route('kalkulasi.hitung'));
        $this->assertSame(url('/kalkulasi/simpan'), route('kalkulasi.simpan'));
    }

    public function test_tamu_ditolak(): void
    {
        $this->postJson('/kalkulasi/hitung', $this->dataValid())->assertUnauthorized();
    }

    public function test_hasil_hitung_kwh_dan_biaya_benar(): void
    {
        $user = User::factory()->create();

        $json = $this->actingAs($user)
            ->postJson('/kalkulasi/hitung', $this->dataValid())
            ->assertOk()
            ->json();

        $this->assertEqualsWithDelta(7.2, $json['kwh']['harian'], 0.0001);
        $this->assertEqualsWithDelta(50.4, $json['kwh']['mingguan'], 0.0001);
        $this->assertEqualsWithDelta(216.0, $json['kwh']['bulanan'], 0.0001);
        $this->assertEqualsWithDelta(10396.8, $json['biaya']['harian'], 0.01);
        $this->assertEqualsWithDelta(72777.6, $json['biaya']['mingguan'], 0.01);
        $this->assertEqualsWithDelta(311904.0, $json['biaya']['bulanan'], 0.01);
    }

    public function test_teks_siap_tampil_memakai_format_indonesia(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->postJson('/kalkulasi/hitung', $this->dataValid())
            ->assertJsonPath('teks.kwh_harian', '7,20 kWh')
            ->assertJsonPath('teks.kwh_bulanan', '216,00 kWh')
            ->assertJsonPath('teks.biaya_harian', 'Rp10.397')
            ->assertJsonPath('teks.biaya_mingguan', 'Rp72.778')
            ->assertJsonPath('teks.biaya_bulanan', 'Rp311.904');
    }

    public function test_hitung_tidak_menyimpan_apa_pun_ke_database(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson('/kalkulasi/hitung', $this->dataValid())->assertOk();

        $this->assertSame(0, Perangkat::count());
        $this->assertSame(0, HasilKalkulasi::count());
    }

    public function test_angka_desimal_dengan_koma_diterima(): void
    {
        $user = User::factory()->create();

        $json = $this->actingAs($user)
            ->postJson('/kalkulasi/hitung', $this->dataValid([
                'daya' => '1000', 'waktu_penggunaan' => '1,5', 'tarif_listrik' => '1000',
            ]))
            ->assertOk()
            ->json();

        $this->assertEqualsWithDelta(1.5, $json['kwh']['harian'], 0.0001);
        $this->assertEqualsWithDelta(1500.0, $json['biaya']['harian'], 0.01);
    }

    public static function dataTidakValid(): array
    {
        return [
            'daya kosong'        => ['daya', ''],
            'daya bukan angka'   => ['daya', 'abc'],
            'daya nol'           => ['daya', '0'],
            'daya negatif'       => ['daya', '-5'],
            'daya terlalu besar' => ['daya', '100001'],
            'jam kosong'         => ['waktu_penggunaan', ''],
            'jam bukan angka'    => ['waktu_penggunaan', 'abc'],
            'jam nol'            => ['waktu_penggunaan', '0'],
            'jam lebih dari 24'  => ['waktu_penggunaan', '24.5'],
            'tarif kosong'       => ['tarif_listrik', ''],
            'tarif bukan angka'  => ['tarif_listrik', 'abc'],
            'tarif nol'          => ['tarif_listrik', '0'],
            'tarif negatif'      => ['tarif_listrik', '-100'],
        ];
    }

    #[DataProvider('dataTidakValid')]
    public function test_data_tidak_valid_ditolak_dengan_status_422(string $kolom, string $nilai): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->postJson('/kalkulasi/hitung', $this->dataValid([$kolom => $nilai]))
            ->assertStatus(422)
            ->assertJsonValidationErrors($kolom);
    }
}