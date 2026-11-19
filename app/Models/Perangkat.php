<?php

namespace App\Models;

use App\Support\KalkulatorEnergi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Perangkat extends Model
{
    use HasFactory;

    // Asumsi: kolom `kwh` = konsumsi energi PER HARI (daya x jam / 1000)
    public const HARI_PER_BULAN = 30;

    protected $table = 'perangkats';
    protected $primaryKey = 'id_perangkat';

    protected $fillable = [
        'email',
        'nama_perangkat',
        'daya',
        'tarif_listrik',
        'waktu_penggunaan',
        'kwh',
        'tanggal_input',
    ];

    protected function casts(): array
    {
        return [
            'daya'             => 'float',
            'tarif_listrik'    => 'float',
            'waktu_penggunaan' => 'float',
            'kwh'              => 'float',
        ];
    }

    // Perangkat ini milik satu user (relasi lewat kolom email)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    // Satu perangkat bisa punya banyak hasil kalkulasi
    public function hasilKalkulasis(): HasMany
    {
        return $this->hasMany(HasilKalkulasi::class, 'id_perangkat', 'id_perangkat');
    }

    // Hasil kalkulasi terakhir (baris dengan id_hasil terbesar) untuk perangkat ini
    public function hasilTerakhir(): HasOne
    {
        return $this->hasOne(HasilKalkulasi::class, 'id_perangkat', 'id_perangkat')
            ->latestOfMany('id_hasil');
    }

    // `tanggal_input` sengaja TIDAK di-cast ke date. Simpan sebagai teks 'Y-m-d'
    // supaya hasilnya sama di MySQL (Aiven) dan SQLite (test).

    /**
     * Konsumsi energi PER HARI dalam kWh = daya (watt) x jam per hari / 1000.
     * Dibulatkan 4 desimal agar perangkat berdaya kecil tidak menjadi 0.
     */
    public static function hitungKwh(float $daya, float $jamPerHari): float
    {
        return KalkulatorEnergi::kwhHarian($daya, $jamPerHari);
    }

    // Jumlah hari untuk estimasi bulanan (dari config/dashboard.php)
    private static function hariPerBulan(): int
    {
        return (int) config('dashboard.hari_per_bulan', self::HARI_PER_BULAN);
    }

    /**
     * Statistik dashboard milik satu user, dihitung dengan SATU query agregat.
     * Semua perangkat dianggap aktif (tabel belum punya kolom status).
     */
    public static function statistik(string $email): array
    {
        // Nama alias (jumlah_kwh, jumlah_biaya) sengaja berbeda dari nama accessor model
        // (biaya_harian, biaya_mingguan, ...) agar tidak bentrok saat dibaca.
        $hasil = static::where('email', $email)
            ->selectRaw('COUNT(*) AS total')
            ->selectRaw('COALESCE(SUM(kwh), 0) AS jumlah_kwh')
            ->selectRaw('COALESCE(SUM(kwh * tarif_listrik), 0) AS jumlah_biaya')
            ->first();

        $hari = self::hariPerBulan();

        return [
            'total_perangkat' => (int) $hasil->total,
            'kwh_harian'      => (float) $hasil->jumlah_kwh,
            'kwh_bulanan'     => (float) $hasil->jumlah_kwh * $hari,
            'biaya_bulanan'   => (float) $hasil->jumlah_biaya * $hari,
        ];
    }

    // $perangkat->kwh_bulanan
    public function getKwhBulananAttribute(): float
    {
        return $this->kwh * self::hariPerBulan();
    }

    // $perangkat->biaya_harian dan $perangkat->biaya_mingguan (rupiah)
    public function getBiayaHarianAttribute(): float
    {
        return KalkulatorEnergi::rincian($this->kwh, $this->tarif_listrik)['biaya']['harian'];
    }

    public function getBiayaMingguanAttribute(): float
    {
        return KalkulatorEnergi::rincian($this->kwh, $this->tarif_listrik)['biaya']['mingguan'];
    }
    
    // $perangkat->biaya_bulanan (rupiah)
    public function getBiayaBulananAttribute(): float
    {
        return $this->kwh_bulanan * $this->tarif_listrik;
    }
}