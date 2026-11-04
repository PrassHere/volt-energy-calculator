<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Hasil kalkulasi biaya per perangkat.
 *
 * KESEPAKATAN (perlu disetujui tim):
 *  - periode          : bulan perhitungan, format "YYYY-MM" (contoh "2026-10")
 *  - biaya_perangkat  : estimasi biaya BULANAN satu perangkat (kwh x hari x tarif)
 *  - total_biaya      : total biaya bulanan SEMUA perangkat milik user saat dihitung
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
        'biaya_perangkat',
        'total_biaya',
    ];

    protected function casts(): array
    {
        return [
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
     * Hitung ulang hasil kalkulasi satu periode untuk SEMUA perangkat milik user.
     * Satu baris per perangkat (diperbarui jika sudah ada, tidak digandakan);
     * total_biaya diisi dengan jumlah biaya semua perangkat.
     */
    public static function hitungUlang(string $email, ?string $periode = null): void
    {
        $periode ??= self::periodeBulan();

        $perangkats = Perangkat::where('email', $email)->get();
        $total      = round($perangkats->sum(fn ($p) => $p->biaya_bulanan), 2);

        foreach ($perangkats as $p) {
            static::updateOrCreate(
                ['email' => $email, 'id_perangkat' => $p->id_perangkat, 'periode' => $periode],
                ['biaya_perangkat' => round($p->biaya_bulanan, 2), 'total_biaya' => $total]
            );
        }
    }
}