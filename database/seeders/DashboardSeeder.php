<?php

namespace Database\Seeders;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Mengisi data demo untuk dashboard (tabel users, perangkats, hasil_kalkulasis).
 * Aman dijalankan berulang kali: hanya menyentuh akun demo.
 *
 * Jalankan: php artisan db:seed --class=DashboardSeeder
 */
class DashboardSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('dashboard.email_demo');

        // 1) Akun demo (dibuat sekali; password di-hash otomatis oleh model)
        $user = User::firstOrCreate(
            ['email' => $email],
            ['nama' => 'Pengguna Demo', 'password' => 'password123']
        );

        // 2) Hapus data demo lama agar jumlahnya tidak bertambah tiap seeding
        HasilKalkulasi::where('email', $user->email)->delete();
        Perangkat::where('email', $user->email)->delete();

        // 3) Perangkat tetap (angka stabil); kwh dihitung otomatis oleh factory
        $daftar = [
            ['nama_perangkat' => 'AC 1 PK',        'daya' => 900, 'waktu_penggunaan' => 8],
            ['nama_perangkat' => 'Kulkas 2 Pintu', 'daya' => 150, 'waktu_penggunaan' => 24],
            ['nama_perangkat' => 'TV LED 43"',     'daya' => 100, 'waktu_penggunaan' => 5],
            ['nama_perangkat' => 'Mesin Cuci',     'daya' => 350, 'waktu_penggunaan' => 1],
            ['nama_perangkat' => 'Kipas Angin',    'daya' => 50,  'waktu_penggunaan' => 8],
            ['nama_perangkat' => 'Lampu LED',      'daya' => 12,  'waktu_penggunaan' => 10],
            ['nama_perangkat' => 'Rice Cooker',    'daya' => 400, 'waktu_penggunaan' => 2],
            ['nama_perangkat' => 'Laptop',         'daya' => 65,  'waktu_penggunaan' => 8],
            ['nama_perangkat' => 'Dispenser',      'daya' => 350, 'waktu_penggunaan' => 4],
            ['nama_perangkat' => 'Setrika',        'daya' => 350, 'waktu_penggunaan' => 1],
            ['nama_perangkat' => 'Pompa Air',      'daya' => 250, 'waktu_penggunaan' => 2],
            ['nama_perangkat' => 'Router WiFi',    'daya' => 10,  'waktu_penggunaan' => 24],
        ];

        Perangkat::factory()
            ->count(count($daftar))
            ->sequence(...$daftar)
            ->create(['email' => $user->email]);

        // 4) Hasil kalkulasi bulan ini: satu baris per perangkat (kwh, durasi, biaya, tanggal)
        HasilKalkulasi::hitungUlang($user->email);
    }
}