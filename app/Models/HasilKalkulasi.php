<?php

namespace App\Models;

use App\Support\KalkulatorEnergi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Hasil kalkulasi biaya per perangkat.
 *
 * KESEPAKATAN (perlu disetujui tim):
 *  - periode          : bulan perhitungan, format "YYYY-MM" (contoh "2026-10")
 *  - kwh              : konsumsi PER HARI (kWh)
 *  - durasi           : jam pemakaian per hari
 *  - biaya_perangkat  : estimasi biaya BULANAN satu perangkat (kwh x hari x tarif)
 *  - total_biaya      : total biaya bulanan SEMUA perangkat milik user saat dihitung
 *  - tanggal_input    : tanggal hasil ini disimpan / dihitung ulang
 * Satu baris per perangkat per periode; menghitung ulang memperbarui baris yang sama.
 */
class HasilKalkulasi extends Model
{
    use HasFactory;

    protected $table = 'hasil_kalkulasis';
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'email',
        'id_perangkat',
        'periode',
        'kwh',
        'durasi',
        'biaya_perangkat',
        'total_biaya',
        'tanggal_input',
    ];

    // `tanggal_input` sengaja TIDAK di-cast ke date. Simpan sebagai teks 'Y-m-d'
    // supaya hasilnya sama di MySQL (Aiven) dan SQLite (test).
    protected function casts(): array
    {
        return [
            'kwh'             => 'float',
            'durasi'          => 'float',
            'biaya_perangkat' => 'float',
            'total_biaya'     => 'float',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function perangkat(): BelongsTo
    {
        return $this->belongsTo(Perangkat::class, 'id_perangkat', 'id_perangkat');
    }

    // $hasil->biaya_harian : biaya bulanan dibagi jumlah hari per bulan
    public function getBiayaHarianAttribute(): float
    {
        return round($this->biaya_perangkat / KalkulatorEnergi::hariPerBulan(), 2);
    }

    // $hasil->biaya_mingguan : biaya harian x 7 hari
    public function getBiayaMingguanAttribute(): float
    {
        return round(
            $this->biaya_perangkat / KalkulatorEnergi::hariPerBulan() * KalkulatorEnergi::HARI_PER_MINGGU,
            2
        );
    }

    // Periode bulanan, contoh: "2026-10"
    public static function periodeBulan(?Carbon $tanggal = null): string
    {
        return ($tanggal ?? Carbon::today())->format('Y-m');
    }

    /**
     * Jumlah biaya semua perangkat milik user pada satu periode,
     * atau null jika belum ada hasil kalkulasi untuk periode itu.
     */
    public static function biayaPeriode(string $email, string $periode): ?float
    {
        $hasil = static::where('email', $email)
            ->where('periode', $periode)
            ->selectRaw('COUNT(*) AS n')
            ->selectRaw('COALESCE(SUM(biaya_perangkat), 0) AS total')
            ->first();

        return (int) $hasil->n === 0 ? null : (float) $hasil->total;
    }

    /**
     * KF-05: hitung dan simpan hasil kalkulasi satu periode untuk SEMUA perangkat milik user.
     * Satu baris per perangkat (diperbarui jika sudah ada, tidak digandakan).
     * Mengembalikan jumlah perangkat yang disimpan hasilnya.
     */
    public static function hitungUlang(string $email, ?string $periode = null, ?Carbon $tanggal = null): int
    {
        $periode ??= self::periodeBulan();
        $tanggal   = ($tanggal ?? Carbon::today())->toDateString();

        $perangkats = Perangkat::where('email', $email)->get();

        // Biaya bulanan tiap perangkat dari kWh harian tersimpan dan tarifnya
        $biaya = [];
        foreach ($perangkats as $p) {
            $biaya[$p->id_perangkat] = KalkulatorEnergi::rincian($p->kwh, $p->tarif_listrik)['biaya']['bulanan'];
        }

        $total = round(array_sum($biaya), 2);

        foreach ($perangkats as $p) {
            static::updateOrCreate(
                ['email' => $email, 'id_perangkat' => $p->id_perangkat, 'periode' => $periode],
                [
                    'kwh'             => $p->kwh,
                    'durasi'          => $p->waktu_penggunaan,
                    'biaya_perangkat' => $biaya[$p->id_perangkat],
                    'total_biaya'     => $total,
                    'tanggal_input'   => $tanggal,
                ]
            );
        }

        return $perangkats->count();
    }
}