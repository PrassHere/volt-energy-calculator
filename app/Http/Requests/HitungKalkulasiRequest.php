<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi input pratinjau kalkulasi:
 * daya (watt), durasi pemakaian (jam per hari), tarif listrik (Rp per kWh).
 * Jika dikirim lewat AJAX/JSON, kegagalan validasi berupa JSON status 422.
 */
class HitungKalkulasiRequest extends FormRequest
{
    // Untuk permintaan non-JSON: kembali ke halaman form
    protected $redirectRoute = 'add-device';

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    // Angka desimal berkoma ("1,5") diubah menjadi bertitik ("1.5") sebelum divalidasi
    protected function prepareForValidation(): void
    {
        $this->merge([
            'daya'             => $this->normalisasiAngka($this->input('daya')),
            'waktu_penggunaan' => $this->normalisasiAngka($this->input('waktu_penggunaan')),
            'tarif_listrik'    => $this->normalisasiAngka($this->input('tarif_listrik')),
        ]);
    }

    public function rules(): array
    {
        return [
            'daya'             => ['required', 'numeric', 'gt:0', 'max:100000'],
            'waktu_penggunaan' => ['required', 'numeric', 'gt:0', 'max:24'],
            'tarif_listrik'    => ['required', 'numeric', 'gt:0', 'max:1000000'],
        ];
    }

    public function messages(): array
    {
        return [
            'daya.required' => 'Daya perangkat wajib diisi.',
            'daya.numeric'  => 'Daya perangkat harus berupa angka.',
            'daya.gt'       => 'Daya perangkat harus lebih dari 0 watt.',
            'daya.max'      => 'Daya perangkat maksimal 100.000 watt.',

            'waktu_penggunaan.required' => 'Durasi pemakaian wajib diisi.',
            'waktu_penggunaan.numeric'  => 'Durasi pemakaian harus berupa angka.',
            'waktu_penggunaan.gt'       => 'Durasi pemakaian harus lebih dari 0 jam.',
            'waktu_penggunaan.max'      => 'Durasi pemakaian maksimal 24 jam per hari.',

            'tarif_listrik.required' => 'Tarif listrik wajib diisi.',
            'tarif_listrik.numeric'  => 'Tarif listrik harus berupa angka.',
            'tarif_listrik.gt'       => 'Tarif listrik harus lebih dari 0.',
            'tarif_listrik.max'      => 'Tarif listrik maksimal Rp1.000.000 per kWh.',
        ];
    }

    private function normalisasiAngka(mixed $nilai): mixed
    {
        if (is_string($nilai) && str_contains($nilai, ',') && ! str_contains($nilai, '.')) {
            return str_replace(',', '.', $nilai);
        }

        return $nilai;
    }
}