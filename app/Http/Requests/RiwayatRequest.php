<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validasi pencarian, filter, urutan, dan pagination halaman Riwayat (query string).
 * Contoh: /history?q=ac&dari=2026-10-01&sampai=2026-10-31&urut=biaya&arah=desc&per_halaman=10&page=2
 */
class RiwayatRequest extends FormRequest
{
    // Jika filter tidak valid, kembali ke halaman riwayat tanpa filter
    protected $redirectRoute = 'history';

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'q'           => ['nullable', 'string', 'max:100'],
            'dari'        => ['nullable', 'date_format:Y-m-d'],
            'sampai'      => ['nullable', 'date_format:Y-m-d', 'after_or_equal:dari'],
            'urut'        => ['nullable', Rule::in(['tanggal', 'nama', 'daya', 'kwh', 'biaya'])],
            'arah'        => ['nullable', Rule::in(['asc', 'desc'])],
            'per_halaman' => ['nullable', 'integer', Rule::in([5, 10, 25, 50])],
            'page'        => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'q.max'                => 'Kata kunci maksimal 100 karakter.',
            'dari.date_format'     => 'Tanggal awal harus berformat TTTT-BB-HH (contoh 2026-10-01).',
            'sampai.date_format'   => 'Tanggal akhir harus berformat TTTT-BB-HH (contoh 2026-10-31).',
            'sampai.after_or_equal' => 'Tanggal akhir tidak boleh sebelum tanggal awal.',
            'urut.in'              => 'Pilihan urutan tidak dikenal.',
            'arah.in'              => 'Arah urutan harus asc atau desc.',
            'per_halaman.in'       => 'Jumlah data per halaman harus 5, 10, 25, atau 50.',
            'per_halaman.integer'  => 'Jumlah data per halaman harus berupa angka.',
            'page.min'             => 'Nomor halaman minimal 1.',
            'page.integer'         => 'Nomor halaman harus berupa angka.',
        ];
    }

    // Filter yang sudah divalidasi, lengkap dengan nilai bawaan
    public function filter(): array
    {
        $v = $this->validated();

        return [
            'q'           => $v['q'] ?? null,
            'dari'        => $v['dari'] ?? null,
            'sampai'      => $v['sampai'] ?? null,
            'urut'        => $v['urut'] ?? 'tanggal',
            'arah'        => $v['arah'] ?? 'desc',
            'per_halaman' => (int) ($v['per_halaman'] ?? 10),
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        session()->flash('error', 'Filter tidak valid. Periksa kembali isian Anda.');

        parent::failedValidation($validator);
    }
}