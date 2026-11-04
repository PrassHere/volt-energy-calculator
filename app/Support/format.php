<?php

namespace App\Support;

/**
 * Pemformat angka gaya Indonesia: titik untuk ribuan, koma untuk desimal.
 */
class Format
{
    // 1248 -> "1.248"
    public static function angka(int|float $nilai, int $desimal = 0): string
    {
        return number_format($nilai, $desimal, ',', '.');
    }

    // 1248 -> "1.248,0 kWh"
    public static function kwh(int|float $nilai, int $desimal = 1): string
    {
        return self::angka($nilai, $desimal) . ' kWh';
    }

    // 1802112 -> "Rp1.802.112"
    public static function rupiah(int|float $nilai): string
    {
        return 'Rp' . self::angka($nilai, 0);
    }
}