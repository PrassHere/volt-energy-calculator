<?php

namespace App\Http\Controllers;

use App\Http\Requests\HapusPerangkatRequest;
use App\Http\Requests\StorePerangkatRequest;
use App\Http\Requests\UpdatePerangkatRequest;
use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PerangkatController extends Controller
{
    // Tombol "Simpan": validasi dilakukan StorePerangkatRequest sebelum method ini berjalan
    public function store(StorePerangkatRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();

        $daya = (float) $data['daya'];
        $jam  = (float) $data['waktu_penggunaan'];

        DB::transaction(function () use ($user, $data, $daya, $jam) {
            Perangkat::create([
                'email'            => $user->email,   // selalu user yang login, bukan kiriman klien
                'nama_perangkat'   => $data['nama_perangkat'],
                'daya'             => $daya,
                'waktu_penggunaan' => $jam,
                'tarif_listrik'    => (float) $data['tarif_listrik'],
                'kwh'              => Perangkat::hitungKwh($daya, $jam),
                'tanggal_input'    => Carbon::today()->toDateString(),
            ]);

            // Perbarui hasil kalkulasi bulan ini untuk semua perangkat user
            HasilKalkulasi::hitungUlang($user->email);
        });

        return redirect()
            ->route('add-device')
            ->with('success', 'Perangkat "' . $data['nama_perangkat'] . '" berhasil disimpan.');
    }

    // Tombol "Reset": bersihkan isian lama, lalu kembali ke form kosong
    public function reset(Request $request): RedirectResponse
    {
        $request->session()->forget('_old_input');

        return redirect()
            ->route('add-device')
            ->with('info', 'Form berhasil direset.');
    }

    // KF-07: ubah data perangkat (milik sendiri). kWh dihitung ulang oleh server.
    public function update(UpdatePerangkatRequest $request, Perangkat $perangkat): RedirectResponse
    {
        $data = $request->validated();

        $daya = (float) $data['daya'];
        $jam  = (float) $data['waktu_penggunaan'];

        DB::transaction(function () use ($request, $perangkat, $data, $daya, $jam) {
            $perangkat->update([
                'nama_perangkat'   => $data['nama_perangkat'],
                'daya'             => $daya,
                'waktu_penggunaan' => $jam,
                'tarif_listrik'    => (float) $data['tarif_listrik'],
                'kwh'              => Perangkat::hitungKwh($daya, $jam),
            ]);

            // Hasil kalkulasi bulan ini ikut diperbarui
            HasilKalkulasi::hitungUlang($request->user()->email);
        });

        return redirect()
            ->back(fallback: route('history'))
            ->with('success', 'Perangkat "' . $data['nama_perangkat'] . '" berhasil diperbarui.');
    }

    // KF-07: hapus perangkat (milik sendiri), hanya jika ada konfirmasi
    public function destroy(HapusPerangkatRequest $request, Perangkat $perangkat): RedirectResponse
    {
        $nama  = $perangkat->nama_perangkat;
        $email = $request->user()->email;

        DB::transaction(function () use ($perangkat, $email) {
            HasilKalkulasi::where('id_perangkat', $perangkat->id_perangkat)->delete();
            $perangkat->delete();

            // Total pada hasil kalkulasi perangkat lain ikut diperbarui
            HasilKalkulasi::hitungUlang($email);
        });

        return redirect()
            ->back(fallback: route('history'))
            ->with('success', 'Perangkat "' . $nama . '" berhasil dihapus.');
    }
}
