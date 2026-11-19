<?php

namespace App\Support;

use Illuminate\Support\Carbon;

/**
 * Data grafik tren DUMMY (sementara) untuk dashboard.
 *
 * Belum ada tabel yang mencatat konsumsi per hari, jadi tren dibuat dari
 * total kWh harian perangkat milik user dengan variasi +/- 15% per hari.
 * Variasinya TETAP (bukan acak tiap halaman dimuat): ditentukan oleh seed + tanggal.
 * Format hasilnya sama dengan data asli nanti, sehingga frontend tidak perlu berubah.
 */
class TrenDummy
{
    public static function untuk(float $kwhHarian, string $seed, ?Carbon $hariIni = null): array
    {
        $hariIni = ($hariIni ?? Carbon::today())->copy()->startOfDay();
        $awal    = $hariIni->copy()->subDays(27); // 28 hari termasuk hari ini

        // kWh per hari selama 28 hari (indeks 0 = hari terlama)
        $perHari = [];
        for ($i = 0; $i < 28; $i++) {
            $tanggal   = $awal->copy()->addDays($i)->toDateString();
            $perHari[] = $kwhHarian * self::faktor($seed, $tanggal);
        }

        // Week: 7 hari terakhir
        $labelWeek = [];
        $dataWeek  = [];
        for ($i = 21; $i < 28; $i++) {
            $labelWeek[] = $awal->copy()->addDays($i)->locale('id')->isoFormat('ddd, D MMM');
            $dataWeek[]  = round($perHari[$i], 2);
        }

        // Month: 4 minggu, tiap minggu = 7 hari
        $labelMonth = [];
        $dataMonth  = [];
        for ($m = 0; $m < 4; $m++) {
            $labelMonth[] = 'Minggu ke-' . ($m + 1);
            $dataMonth[]  = round(array_sum(array_slice($perHari, $m * 7, 7)), 2);
        }

        return [
            'week'  => ['labels' => $labelWeek,  'data' => $dataWeek],
            'month' => ['labels' => $labelMonth, 'data' => $dataMonth],
        ];
    }

    // Faktor 0,85 - 1,15; selalu sama untuk kombinasi seed + tanggal yang sama
    private static function faktor(string $seed, string $tanggal): float
    {
        return 0.85 + (crc32($seed . '|' . $tanggal) % 3001) / 10000;
    }
}