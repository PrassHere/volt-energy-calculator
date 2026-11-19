<?php

namespace App\Http\Requests;

use App\Models\Perangkat;

/**
 * Validasi ubah data perangkat. Aturan isian sama dengan tambah perangkat
 * (nama, daya, jam per hari, tarif per kWh); tambahan: perangkat harus milik user.
 */
class UpdatePerangkatRequest extends StorePerangkatRequest
{
    // Jika validasi gagal, kembali ke halaman riwayat
    protected $redirectRoute = 'history';

    public function authorize(): bool
    {
        $perangkat = $this->route('perangkat');

        return parent::authorize()
            && $perangkat instanceof Perangkat
            && $perangkat->email === $this->user()->email;
    }
}