<?php

namespace App\Http\Controllers;

use App\Support\AnalisisEnergi;
use App\Support\TrenDummy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    /**
     * KF-06: Menampilkan halaman Analytics dengan ringkasan konsumsi,
     * estimasi biaya, alokasi per perangkat, dan grafik tren.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $email = $user->email;

        $ringkasan = AnalisisEnergi::ringkasan($email);
        $alokasi   = AnalisisEnergi::alokasiPerangkat($email);
        $tren      = TrenDummy::untuk($ringkasan['kwh_harian'], $email);
        $kosong    = $ringkasan['total_perangkat'] === 0;

        return view('pages.analytics', compact('ringkasan', 'alokasi', 'tren', 'kosong'));
    }
}
