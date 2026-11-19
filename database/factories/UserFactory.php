<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Disesuaikan dengan tabel users: kolom `nama` (bukan `name`), email sebagai primary key.
 *
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'email'    => fake()->unique()->safeEmail(),
            'nama'     => fake()->name(),
            'password' => 'password123', // di-hash otomatis oleh cast pada model User
        ];
    }
}