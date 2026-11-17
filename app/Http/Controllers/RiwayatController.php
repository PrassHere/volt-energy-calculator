<?php

namespace App\Http\Controllers;

use App\Http\Requests\RiwayatRequest;
use App\Support\RekapPerangkat;
use Illuminate\View\View;

class RiwayatController extends Controller
{
    // KF-07: daftar rekap perangkat & hasil kalkulasi milik user, lengkap dengan
    // pencarian, filter, urutan, pagination, dan total rekap
    public function index(RiwayatRequest $request): View
    {
        $email  = $request->user()->email;
        $filter = $request->filter();

        $daftar = RekapPerangkat::daftar($email, $filter);
        $total  = RekapPerangkat::total($email, $filter);

        return view('pages.history', compact('daftar', 'total', 'filter'));
    }
}