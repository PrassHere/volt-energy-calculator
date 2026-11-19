<?php

namespace App\Http\Controllers;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Support\Format;
use App\Support\TrenDummy;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // 1) Statistik dari tabel perangkats (query agregat)
        $statistik = Perangkat::statistik($user->email);

        // 2) Estimasi biaya bulanan: pakai hasil kalkulasi bulan ini (tabel hasil_kalkulasis);
        //    jika belum ada, hitung dari perangkat
        $biayaBulanan = HasilKalkulasi::biayaPeriode($user->email, HasilKalkulasi::periodeBulan())
            ?? $statistik['biaya_bulanan'];

        // 3) Data grafik tren: sementara DUMMY (belum ada tabel konsumsi harian).
        //    Ganti baris ini dengan query asli jika sumber datanya sudah ada;
        //    bentuk hasilnya sama, jadi view tidak perlu diubah.
        $tren = TrenDummy::untuk($statistik['kwh_harian'], $user->email);

        // 4) Format angka, satuan kWh, dan mata uang untuk ditampilkan
        $kartu = [
            'total_perangkat' => Format::angka($statistik['total_perangkat']),
            'kwh_bulanan'     => Format::kwh($statistik['kwh_bulanan']),
            'biaya_bulanan'   => Format::rupiah($biayaBulanan),
        ];

        // Penanda untuk banner di view
        $akunDemo = $user->email === config('dashboard.email_demo');
        $kosong   = $statistik['total_perangkat'] === 0;

        return view('dashboard', compact('kartu', 'tren', 'akunDemo', 'kosong'));
    }
}