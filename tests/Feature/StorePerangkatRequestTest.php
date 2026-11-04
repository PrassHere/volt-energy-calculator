<?php

namespace Tests\Feature;

use App\Http\Requests\StorePerangkatRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Menguji aturan validasi saja (tanpa HTTP dan tanpa database).
 */
class StorePerangkatRequestTest extends TestCase
{
    private function dataValid(array $ganti = []): array
    {
        return array_merge([
            'nama_perangkat'   => 'AC Kamar',
            'daya'             => '900',
            'waktu_penggunaan' => '8',
            'tarif_listrik'    => '1444',
        ], $ganti);
    }

    private function validator(array $data): \Illuminate\Validation\Validator
    {
        $request = new StorePerangkatRequest();

        return Validator::make($data, $request->rules(), $request->messages());
    }

    public static function dataBatasValid(): array
    {
        return [
            'nama 2 karakter'   => ['nama_perangkat', 'AB'],
            'nama 100 karakter' => ['nama_perangkat', str_repeat('a', 100)],
            'daya 1 watt'       => ['daya', '1'],
            'daya 100000 watt'  => ['daya', '100000'],
            'jam 0,5'           => ['waktu_penggunaan', '0.5'],
            'jam 24'            => ['waktu_penggunaan', '24'],
            'tarif 1'           => ['tarif_listrik', '1'],
        ];
    }

    #[DataProvider('dataBatasValid')]
    public function test_nilai_batas_yang_masih_valid(string $kolom, string $nilai): void
    {
        $this->assertFalse($this->validator($this->dataValid([$kolom => $nilai]))->fails());
    }

    public function test_data_lengkap_dan_benar_lolos(): void
    {
        $this->assertFalse($this->validator($this->dataValid())->fails());
    }

    public function test_pesan_error_berbahasa_indonesia(): void
    {
        $v = $this->validator($this->dataValid(['daya' => '0', 'waktu_penggunaan' => '25']));

        $this->assertSame('Daya perangkat harus lebih dari 0 watt.', $v->errors()->first('daya'));
        $this->assertSame('Durasi pemakaian maksimal 24 jam per hari.', $v->errors()->first('waktu_penggunaan'));
    }

    public function test_hanya_user_login_yang_diizinkan(): void
    {
        $request = new StorePerangkatRequest();

        $request->setUserResolver(fn () => null);
        $this->assertFalse($request->authorize());

        $request->setUserResolver(fn () => new User(['email' => 'a@contoh.test', 'nama' => 'A']));
        $this->assertTrue($request->authorize());
    }
}