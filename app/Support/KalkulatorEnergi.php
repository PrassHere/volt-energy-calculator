<?php

namespace App\Support;

/**
 * Logika hitung konsumsi energi dan biaya listrik (tanpa database).
 *
 *  - kWh per hari = daya (watt) x jam per hari / 1000
 *  - biaya        = kWh x tarif per kWh
 * dihitung untuk periode harian, mingguan (7 hari), dan bulanan
 * (jumlah hari diatur di config/dashboard.php, bawaan 30).
 */
class KalkulatorEnergi
{
    public const HARI_PER_MINGGU = 7;

    public static function hariPerBulan(): int
    {
        return (int) config('dashboard.hari_per_bulan', 30);
    }

    // KF-04: konsumsi kWh per hari. Dibulatkan 4 desimal agar daya kecil tidak menjadi 0.
    public static function kwhHarian(float $daya, float $jamPerHari): float
    {
        return round($daya * $jamPerHari / 1000, 4);
    }

    /**
     * KF-04: rincian kWh dan biaya (harian, mingguan, bulanan)
     * dari kWh per hari dan tarif per kWh.
     */
    public static function rincian(float $kwhHarian, float $tarifPerKwh): array
    {
        $kwh = [
            'harian'   => $kwhHarian,
            'mingguan' => round($kwhHarian * self::HARI_PER_MINGGU, 4),
            'bulanan'  => round($kwhHarian * self::hariPerBulan(), 4),
        ];

        $biaya = [
            'harian'   => round($kwh['harian'] * $tarifPerKwh, 2),
            'mingguan' => round($kwh['mingguan'] * $tarifPerKwh, 2),
            'bulanan'  => round($kwh['bulanan'] * $tarifPerKwh, 2),
        ];

        return ['kwh' => $kwh, 'biaya' => $biaya];
    }

    // Dari input mentah: daya (watt), jam per hari, dan tarif per kWh
    public static function hitung(float $daya, float $jamPerHari, float $tarifPerKwh): array
    {
        return self::rincian(self::kwhHarian($daya, $jamPerHari), $tarifPerKwh);
    }
}