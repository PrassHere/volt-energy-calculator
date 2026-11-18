<?php

namespace Tests\Feature;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use App\Support\RekapPerangkat;
use Tests\DatabaseTestCase;

class RekapPerangkatTest extends DatabaseTestCase
{
    private function buat(User $user, string $nama, float $daya, float $jam, float $tarif, string $tanggal): Perangkat
    {
        return Perangkat::factory()->create([
            'email' => $user->email, 'nama_perangkat' => $nama, 'daya' => $daya,
            'waktu_penggunaan' => $jam, 'tarif_listrik' => $tarif, 'tanggal_input' => $tanggal,
        ]);
    }

    // AC Kamar: 1 kWh/hari (Rp1.000), AC Ruang Tamu: 2 kWh/hari (Rp2.000), Kulkas: 1 kWh/hari (Rp2.500)
    private function userDenganTigaPerangkat(): User
    {
        $user = User::factory()->create();

        $this->buat($user, 'AC Kamar', 1000, 1, 1000, '2026-10-01');
        $this->buat($user, 'AC Ruang Tamu', 2000, 1, 1000, '2026-10-10');
        $this->buat($user, 'Kulkas', 500, 2, 2500, '2026-10-20');

        return $user;
    }

    private function nama($daftar): array
    {
        return array_map(fn ($p) => $p->nama_perangkat, $daftar->items());
    }

    public function test_daftar_hanya_berisi_perangkat_milik_user(): void
    {
        $a = $this->userDenganTigaPerangkat();
        $this->userDenganTigaPerangkat(); // user lain

        $daftar = RekapPerangkat::daftar($a->email);

        $this->assertSame(3, $daftar->total());
        foreach ($daftar->items() as $p) {
            $this->assertSame($a->email, $p->email);
        }
    }

    public function test_pencarian_nama_tidak_peduli_huruf_besar_kecil(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $daftar = RekapPerangkat::daftar($user->email, ['q' => 'ac']);

        $this->assertSame(2, $daftar->total());
        $this->assertEqualsCanonicalizing(['AC Kamar', 'AC Ruang Tamu'], $this->nama($daftar));
    }

    public function test_karakter_khusus_pencarian_tidak_menjadi_wildcard(): void
    {
        $user = $this->userDenganTigaPerangkat();
        $this->buat($user, 'Diskon 50% Alat', 100, 1, 1000, '2026-10-25');

        $this->assertSame(1, RekapPerangkat::daftar($user->email, ['q' => '%'])->total());
        $this->assertSame(0, RekapPerangkat::daftar($user->email, ['q' => '_'])->total());
    }

    public function test_filter_tanggal_dari_dan_sampai(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $rentang = RekapPerangkat::daftar($user->email, ['dari' => '2026-10-05', 'sampai' => '2026-10-15']);
        $this->assertSame(['AC Ruang Tamu'], $this->nama($rentang));

        $this->assertSame(2, RekapPerangkat::daftar($user->email, ['dari' => '2026-10-10'])->total());
        $this->assertSame(2, RekapPerangkat::daftar($user->email, ['sampai' => '2026-10-10'])->total());
    }

    public function test_urutan_bawaan_tanggal_terbaru_dulu(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->assertSame(
            ['Kulkas', 'AC Ruang Tamu', 'AC Kamar'],
            $this->nama(RekapPerangkat::daftar($user->email))
        );
    }

    public function test_urut_berdasarkan_nama_daya_kwh_dan_biaya(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $this->assertSame(
            ['AC Kamar', 'AC Ruang Tamu', 'Kulkas'],
            $this->nama(RekapPerangkat::daftar($user->email, ['urut' => 'nama', 'arah' => 'asc']))
        );
        $this->assertSame(
            ['AC Ruang Tamu', 'AC Kamar', 'Kulkas'],
            $this->nama(RekapPerangkat::daftar($user->email, ['urut' => 'daya', 'arah' => 'desc']))
        );
        // kWh Kamar dan Kulkas sama (1): perangkat yang dibuat lebih akhir tampil lebih dulu
        $this->assertSame(
            ['AC Ruang Tamu', 'Kulkas', 'AC Kamar'],
            $this->nama(RekapPerangkat::daftar($user->email, ['urut' => 'kwh', 'arah' => 'desc']))
        );
        $this->assertSame(
            ['Kulkas', 'AC Ruang Tamu', 'AC Kamar'],
            $this->nama(RekapPerangkat::daftar($user->email, ['urut' => 'biaya', 'arah' => 'desc']))
        );
        $this->assertSame(
            ['AC Kamar', 'AC Ruang Tamu', 'Kulkas'],
            $this->nama(RekapPerangkat::daftar($user->email, ['urut' => 'biaya', 'arah' => 'asc']))
        );
    }

    public function test_urutan_tidak_dikenal_aman_dan_kembali_ke_bawaan(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $daftar = RekapPerangkat::daftar($user->email, ['urut' => 'nama; DROP TABLE perangkats', 'arah' => 'sembarang']);

        $this->assertSame(['Kulkas', 'AC Ruang Tamu', 'AC Kamar'], $this->nama($daftar));
        $this->assertSame(3, Perangkat::count());
    }

    public function test_pagination_membagi_halaman(): void
    {
        $user = User::factory()->create();
        Perangkat::factory()->count(12)->create(['email' => $user->email]);

        $daftar = RekapPerangkat::daftar($user->email, ['per_halaman' => 5]);

        $this->assertSame(12, $daftar->total());
        $this->assertSame(5, $daftar->perPage());
        $this->assertSame(3, $daftar->lastPage());
        $this->assertCount(5, $daftar->items());
    }

    public function test_total_rekap_harian_mingguan_dan_bulanan(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $t = RekapPerangkat::total($user->email);

        $this->assertSame(3, $t['jumlah_perangkat']);
        $this->assertEqualsWithDelta(4.0, $t['kwh']['harian'], 0.0001);
        $this->assertEqualsWithDelta(28.0, $t['kwh']['mingguan'], 0.0001);
        $this->assertEqualsWithDelta(120.0, $t['kwh']['bulanan'], 0.0001);
        $this->assertEqualsWithDelta(5500.0, $t['biaya']['harian'], 0.01);      // 1.000 + 2.000 + 2.500
        $this->assertEqualsWithDelta(38500.0, $t['biaya']['mingguan'], 0.01);
        $this->assertEqualsWithDelta(165000.0, $t['biaya']['bulanan'], 0.01);
    }

    public function test_total_mengikuti_filter_bukan_hanya_halaman_ini(): void
    {
        $user = $this->userDenganTigaPerangkat();

        $t = RekapPerangkat::total($user->email, ['q' => 'AC', 'per_halaman' => 1]);

        $this->assertSame(2, $t['jumlah_perangkat']);
        $this->assertEqualsWithDelta(3.0, $t['kwh']['harian'], 0.0001);
        $this->assertEqualsWithDelta(90000.0, $t['biaya']['bulanan'], 0.01);
    }

    public function test_total_untuk_user_tanpa_perangkat_semua_nol(): void
    {
        $user = User::factory()->create();

        $t = RekapPerangkat::total($user->email);

        $this->assertSame(0, $t['jumlah_perangkat']);
        $this->assertEqualsWithDelta(0.0, $t['kwh']['bulanan'], 0.0001);
        $this->assertEqualsWithDelta(0.0, $t['biaya']['bulanan'], 0.01);
        $this->assertNull($t['biaya_tersimpan_bulan_ini']);
    }

    public function test_biaya_tersimpan_bulan_ini_berasal_dari_hasil_kalkulasi(): void
    {
        $user = $this->userDenganTigaPerangkat();

        HasilKalkulasi::hitungUlang($user->email);

        $t = RekapPerangkat::total($user->email);

        $this->assertEqualsWithDelta(165000.0, $t['biaya_tersimpan_bulan_ini'], 0.01);
    }

    public function test_hasil_kalkulasi_terakhir_ikut_dimuat(): void
    {
        $user = User::factory()->create();
        $p    = $this->buat($user, 'AC Kamar', 1000, 1, 1000, '2026-10-01');

        foreach (['2026-09', '2026-10'] as $periode) {   // '2026-10' dibuat paling akhir
            HasilKalkulasi::factory()->create([
                'email' => $user->email, 'id_perangkat' => $p->id_perangkat, 'periode' => $periode,
                'biaya_perangkat' => 30000, 'total_biaya' => 30000,
            ]);
        }

        $baris = RekapPerangkat::daftar($user->email)->items()[0];

        $this->assertTrue($baris->relationLoaded('hasilTerakhir'));
        $this->assertSame('2026-10', $baris->hasilTerakhir->periode);
    }
}