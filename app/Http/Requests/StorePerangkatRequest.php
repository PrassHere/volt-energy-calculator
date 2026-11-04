<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi input "Tambah Perangkat":
 * nama, daya (watt), durasi pemakaian (jam per hari), tarif listrik (Rp per kWh).
 */
class StorePerangkatRequest extends FormRequest
{
    // Jika validasi gagal, kembali ke halaman form (bukan "halaman sebelumnya")
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
            'nama_perangkat'   => ['required', 'string', 'min:2', 'max:100'],
            'daya'             => ['required', 'numeric', 'gt:0', 'max:100000'],
            'waktu_penggunaan' => ['required', 'numeric', 'gt:0', 'max:24'],
            'tarif_listrik'    => ['required', 'numeric', 'gt:0', 'max:1000000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_perangkat.required' => 'Nama perangkat wajib diisi.',
            'nama_perangkat.string'   => 'Nama perangkat harus berupa teks.',
            'nama_perangkat.min'      => 'Nama perangkat minimal 2 karakter.',
            'nama_perangkat.max'      => 'Nama perangkat maksimal 100 karakter.',

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

    // Notifikasi "Data Tidak Valid" (selain daftar error per kolom)
    protected function failedValidation(Validator $validator): void
    {
        session()->flash('error', 'Data tidak valid. Periksa kembali isian Anda.');

        parent::failedValidation($validator);
    }

    private function normalisasiAngka(mixed $nilai): mixed
    {
        if (is_string($nilai) && str_contains($nilai, ',') && ! str_contains($nilai, '.')) {
            return str_replace(',', '.', $nilai);
        }

        return $nilai;
    }
}