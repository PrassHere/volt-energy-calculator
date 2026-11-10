<?php

namespace App\Http\Requests;

use App\Models\Perangkat;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

/**
 * Validasi tombol "Simpan Hasil Kalkulasi".
 * Tidak ada isian dari klien (angka dihitung server dari data perangkat);
 * syaratnya: user harus punya minimal satu perangkat.
 */
class SimpanKalkulasiRequest extends FormRequest
{
    // Jika belum ada perangkat, arahkan ke halaman tambah perangkat
    protected $redirectRoute = 'add-device';

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $v) {
            $punyaPerangkat = Perangkat::where('email', $this->user()->email)->exists();

            if (! $punyaPerangkat) {
                $v->errors()->add('perangkat', 'Belum ada perangkat untuk dihitung. Tambahkan perangkat terlebih dahulu.');
            }
        });
    }

    // Notifikasi gagal (selain pesan per kolom)
    protected function failedValidation(ValidatorContract $validator): void
    {
        session()->flash('error', 'Hasil kalkulasi tidak dapat disimpan.');

        parent::failedValidation($validator);
    }
}