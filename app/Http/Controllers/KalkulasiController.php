<?php

namespace App\Http\Controllers;

use App\Http\Requests\HitungKalkulasiRequest;
use App\Http\Requests\SimpanKalkulasiRequest;
use App\Models\HasilKalkulasi;
use App\Support\Format;
use App\Support\KalkulatorEnergi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class KalkulasiController extends Controller
{
    // KF-04: pratinjau hasil hitung (kWh dan biaya harian, mingguan, bulanan) TANPA menyimpan
    public function hitung(HitungKalkulasiRequest $request): JsonResponse
    {
        $hasil = KalkulatorEnergi::hitung(
            (float) $request->validated('daya'),
            (float) $request->validated('waktu_penggunaan'),
            (float) $request->validated('tarif_listrik'),
        );

        return response()->json([
            'kwh'   => $hasil['kwh'],
            'biaya' => $hasil['biaya'],
            'teks'  => [
                'kwh_harian'     => Format::kwh($hasil['kwh']['harian'], 2),
                'kwh_mingguan'   => Format::kwh($hasil['kwh']['mingguan'], 2),
                'kwh_bulanan'    => Format::kwh($hasil['kwh']['bulanan'], 2),
                'biaya_harian'   => Format::rupiah($hasil['biaya']['harian']),
                'biaya_mingguan' => Format::rupiah($hasil['biaya']['mingguan']),
                'biaya_bulanan'  => Format::rupiah($hasil['biaya']['bulanan']),
            ],
        ]);
    }

    // KF-05: hitung ulang dan simpan hasil kalkulasi bulan ini untuk semua perangkat user
    public function simpan(SimpanKalkulasiRequest $request): RedirectResponse|JsonResponse
    {
        $email   = $request->user()->email;
        $periode = HasilKalkulasi::periodeBulan();

        $jumlah = DB::transaction(fn () => HasilKalkulasi::hitungUlang($email, $periode));
        $total  = HasilKalkulasi::biayaPeriode($email, $periode);

        if ($request->expectsJson()) {
            return response()->json([
                'pesan'            => 'Hasil kalkulasi berhasil disimpan.',
                'periode'          => $periode,
                'jumlah_perangkat' => $jumlah,
                'total_biaya'      => $total,
            ]);
        }

        return redirect()
            ->route('history')
            ->with('success', "Hasil kalkulasi periode {$periode} berhasil disimpan untuk {$jumlah} perangkat.");
    }
}