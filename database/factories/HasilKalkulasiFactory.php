<?php

namespace Database\Factories;

use App\Models\HasilKalkulasi;
use App\Models\Perangkat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HasilKalkulasi>
 */
class HasilKalkulasiFactory extends Factory
{
    protected $model = HasilKalkulasi::class;

    public function definition(): array
    {
        $biaya = fake()->randomFloat(2, 10000, 500000);

        return [
            'email'           => User::factory(),
            // Perangkat dibuat untuk user yang sama dengan kolom email di atas
            'id_perangkat'    => fn (array $atribut) => Perangkat::factory()
                ->create(['email' => $atribut['email']])
                ->id_perangkat,
            'periode'         => HasilKalkulasi::periodeBulan(),
            'biaya_perangkat' => $biaya,
            'total_biaya'     => $biaya,
        ];
    }
}