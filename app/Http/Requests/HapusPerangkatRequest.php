<?php

namespace App\Http\Requests;

use App\Models\Perangkat;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi hapus perangkat: harus milik user dan harus ada konfirmasi.
 * Konfirmasi dikirim sebagai konfirmasi=1 setelah pengguna menyetujui dialog di halaman.
 */
class HapusPerangkatRequest extends FormRequest
{
    protected $redirectRoute = 'history';

    public function authorize(): bool
    {
        $perangkat = $this->route('perangkat');

        return $this->user() !== null
            && $perangkat instanceof Perangkat
            && $perangkat->email === $this->user()->email;
    }

    public function rules(): array
    {
        return [
            'konfirmasi' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'konfirmasi.accepted' => 'Penghapusan harus dikonfirmasi terlebih dahulu.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        session()->flash('error', 'Perangkat belum dihapus. Penghapusan harus dikonfirmasi.');

        parent::failedValidation($validator);
    }
}