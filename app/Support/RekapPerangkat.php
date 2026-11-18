<?php

namespace App\Support;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Logika daftar rekap perangkat per user: pencarian, filter, urutan, pagination,
 * dan total rekap. Semua query dibatasi pada perangkat milik satu user (email).
 */
class RekapPerangkat
{
    // Pilihan urutan -> kolom database
    public const URUTAN = [
        'tanggal' => 'tanggal_input',
        'nama'    => 'nama_perangkat',
        'daya'    => 'daya',
        'kwh'     => 'kwh',
    ];

    private static function bawaan(array $filter): array
    {
        return array_merge([
            'q'           => null,
            'dari'        => null,
            'sampai'      => null,
            'urut'        => 'tanggal',
            'arah'        => 'desc',
            'per_halaman' => 10,
        ], $filter);
    }

    // Query dasar + pencarian + filter tanggal (dipakai daftar dan total)
    private static function query(string $email, array $f): Builder
    {
        $query = Perangkat::query()->where('email', $email);

        if (! empty($f['q'])) {
            // Karakter % dan _ dari pengguna dianggap huruf biasa, bukan wildcard
            $kata = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $f['q']);
            $query->whereRaw("nama_perangkat LIKE ? ESCAPE '!'", ['%' . $kata . '%']);
        }

        if (! empty($f['dari'])) {
            $query->where('tanggal_input', '>=', $f['dari']);
        }

        if (! empty($f['sampai'])) {
            $query->where('tanggal_input', '<=', $f['sampai']);
        }

        return $query;
    }

    // Daftar rekap per halaman (hasil kalkulasi terakhir ikut dimuat)
    public static function daftar(string $email, array $filter = []): LengthAwarePaginator
    {
        $f    = self::bawaan($filter);
        $arah = $f['arah'] === 'asc' ? 'asc' : 'desc';   // hanya dua nilai yang diizinkan

        $query = self::query($email, $f)->with('hasilTerakhir');

        if ($f['urut'] === 'biaya') {
            $query->orderByRaw("kwh * tarif_listrik {$arah}");
        } else {
            $query->orderBy(self::URUTAN[$f['urut']] ?? 'tanggal_input', $arah);
        }

        return $query
            ->orderByDesc('id_perangkat')   // penentu urutan agar halaman stabil
            ->paginate((int) $f['per_halaman'])
            ->withQueryString();
    }

    /**
     * Total rekap seluruh data yang cocok dengan filter (bukan hanya halaman ini):
     * jumlah perangkat, kWh dan biaya harian/mingguan/bulanan.
     */
    public static function total(string $email, array $filter = []): array
    {
        $f = self::bawaan($filter);

        $hasil = self::query($email, $f)
            ->selectRaw('COUNT(*) AS jumlah')
            ->selectRaw('COALESCE(SUM(kwh), 0) AS jumlah_kwh')
            ->selectRaw('COALESCE(SUM(kwh * tarif_listrik), 0) AS jumlah_biaya')
            ->first();;

        $kwh      = (float) $hasil->jumlah_kwh;
        $biaya    = (float) $hasil->jumlah_biaya;
        $minggu   = KalkulatorEnergi::HARI_PER_MINGGU;
        $bulan    = KalkulatorEnergi::hariPerBulan();

        return [
            'jumlah_perangkat' => (int) $hasil->jumlah,
            'kwh' => [
                'harian'   => round($kwh, 4),
                'mingguan' => round($kwh * $minggu, 4),
                'bulanan'  => round($kwh * $bulan, 4),
            ],
            'biaya' => [
                'harian'   => round($biaya, 2),
                'mingguan' => round($biaya * $minggu, 2),
                'bulanan'  => round($biaya * $bulan, 2),
            ],
            // Total biaya bulan ini menurut hasil kalkulasi tersimpan (null jika belum ada)
            'biaya_tersimpan_bulan_ini' => HasilKalkulasi::biayaPeriode($email, HasilKalkulasi::periodeBulan()),
        ];
    }
}