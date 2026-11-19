<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seeder Akun Administrator Volt Energy
     * Email: admin@gmail.com
     * Password: admin123
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'nama'     => 'Admin Volt',
                'password' => 'admin123', // Otomatis di-hash oleh model User
            ]
        );
    }
}
